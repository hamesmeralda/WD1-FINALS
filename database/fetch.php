<?php
// this file handles all database actions for the applicant page
require_once __DIR__ . '/connect.php';
header('Content-Type: application/json; charset=utf-8');

// The office tool sends JSON requests with an action; route those requests
// through the same endpoint as the applicant tool.
if (isset($_GET['action'], $_GET['func_name']) || isset($_GET['action']) || isset($_POST['office_action']) || (stripos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false)) {
    handleOfficeRequest();
    exit;
}

// only these functions can be called by the page
$allowed = ['GetApplicants', 'SaveApplicant', 'UpdateApplicantFields', 'DeleteApplicant'];

$func_name = $_POST['func_name'] ?? $_GET['func_name'] ?? '';

if (in_array($func_name, $allowed, true) && function_exists($func_name)) {
    $func_name();
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'unknown function']);
}
exit;

function officeRespond(bool $success, string $message = '', ?array $offices = null, int $status = 200): void
{
    http_response_code($status);
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'offices' => $offices,
    ]);
    exit;
}

function officeField(array $data, string $key, int $max, bool $required = true): string
{
    $value = $data[$key] ?? '';

    if (!is_string($value) || strlen($value) > $max || ($required && trim($value) === '')) {
        officeRespond(false, 'Please check ' . $key, null, 422);
    }

    return trim($value);
}

function handleOfficeRequest(): void
{
    global $pdo;

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    header('Cache-Control: no-store');

    try {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (empty($_SESSION['token'])) {
                $_SESSION['token'] = bin2hex(random_bytes(32));
            }

            $rows = $pdo->query('SELECT * FROM offices ORDER BY officeId')->fetchAll();
            foreach ($rows as &$row) {
                $row['requiredSkills'] = json_decode((string) $row['requiredSkills'], true) ?: [];
                $row['availableSlots'] = (int) $row['availableSlots'];
            }
            unset($row);

            echo json_encode([
                'success' => true,
                'offices' => $rows,
                'token' => $_SESSION['token'],
            ]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            officeRespond(false, 'Method not allowed', null, 405);
        }

        $csrfToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        if (empty($_SESSION['token']) || !hash_equals($_SESSION['token'], $csrfToken)) {
            officeRespond(false, 'Reload the page and try again.', null, 403);
        }

        $isJsonRequest = stripos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false;
        $data = $isJsonRequest ? json_decode(file_get_contents('php://input'), true) : $_POST;
        if (!$isJsonRequest && isset($_POST['office_action'])) {
            $data['action'] = $_POST['office_action'];
            if (isset($data['requiredSkills']) && is_string($data['requiredSkills'])) {
                $data['requiredSkills'] = json_decode($data['requiredSkills'], true);
            }
        }
        if (!is_array($data)) {
            officeRespond(false, 'Invalid request', null, 400);
        }

        $action = $data['action'] ?? '';
        if (!in_array($action, ['create', 'update', 'delete'], true)) {
            officeRespond(false, 'Invalid action', null, 400);
        }

        $id = $action === 'create' ? '' : officeField($data, 'officeId', 20);
        if ($action !== 'create') {
            $stmt = $pdo->prepare('SELECT officeId FROM offices WHERE officeId = ?');
            $stmt->execute([$id]);
            if (!$stmt->fetch()) {
                officeRespond(false, 'Office no longer exists. Reload the page.', null, 404);
            }
        }

        if ($action === 'delete') {
            $pdo->prepare('DELETE FROM offices WHERE officeId = ?')->execute([$id]);
            officeRespond(true, 'Office deleted.');
        }

        $name = officeField($data, 'officeName', 150);
        $department = officeField($data, 'department', 150);
        $head = officeField($data, 'assignedOfficeHead', 150);
        $description = officeField($data, 'officeDescription', 65000, false);
        $officeUrl = officeField($data, 'officeUrl', 500, false);
        $slots = filter_var($data['availableSlots'] ?? null, FILTER_VALIDATE_INT);
        $skills = $data['requiredSkills'] ?? null;
        $physical = $data['physicallyDemanding'] ?? '';

        if ($slots === false || $slots === null || $slots < 0 || $slots > 2147483647 || !is_array($skills) || !$skills || count($skills) > 50 || !in_array($physical, ['Yes', 'No'], true)) {
            officeRespond(false, 'Check slots, skills and physical demand.', null, 422);
        }

        foreach ($skills as &$skill) {
            if (!is_string($skill) || trim($skill) === '' || strlen($skill) > 500) {
                officeRespond(false, 'Invalid skill', null, 422);
            }
            $skill = trim($skill);
        }
        unset($skill);

        $photoPath = null;
        if (!empty($_FILES['officePhoto']['tmp_name'])) {
            $photo = $_FILES['officePhoto'];
            if ($photo['error'] !== UPLOAD_ERR_OK || $photo['size'] > 5 * 1024 * 1024) {
                officeRespond(false, 'The office photo must be 5 MB or smaller.', null, 422);
            }
            $imageInfo = @getimagesize($photo['tmp_name']);
            $allowedMimeTypes = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp',
            ];
            if (!$imageInfo || !isset($allowedMimeTypes[$imageInfo['mime']])) {
                officeRespond(false, 'Upload a JPG, PNG, or WEBP office photo.', null, 422);
            }
            $uploadDirectory = __DIR__ . '/../storage/uploads/offices';
            if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0755, true) && !is_dir($uploadDirectory)) {
                officeRespond(false, 'The office photo folder could not be created.', null, 500);
            }
            $photoPath = 'storage/uploads/offices/' . bin2hex(random_bytes(12)) . '.' . $allowedMimeTypes[$imageInfo['mime']];
            if (!move_uploaded_file($photo['tmp_name'], __DIR__ . '/../' . $photoPath)) {
                officeRespond(false, 'The office photo could not be saved.', null, 500);
            }
        }

        $lockAcquired = false;
        try {
            if ($action === 'create') {
                $lock = $pdo->query("SELECT GET_LOCK('office.offices.id', 10)")->fetchColumn();
                if ((int) $lock !== 1) {
                    officeRespond(false, 'Another office is being added. Please try again.', null, 409);
                }
                $lockAcquired = true;

                $year = (new DateTime('now', new DateTimeZone('Asia/Manila')))->format('Y');
                $stmt = $pdo->prepare("SELECT COALESCE(MAX(CAST(SUBSTRING(officeId, 13) AS UNSIGNED)), 0) FROM offices WHERE officeId REGEXP ?");
                $stmt->execute(['^OFFICE-' . $year . '-[0-9]+$']);
                $next = (int) $stmt->fetchColumn() + 1;
                $id = 'OFFICE-' . $year . '-' . str_pad((string) $next, 3, '0', STR_PAD_LEFT);
            }

            if ($photoPath === null && $action === 'update') {
                $existing = $pdo->prepare('SELECT officePhoto FROM offices WHERE officeId = ?');
                $existing->execute([$id]);
                $photoPath = $existing->fetchColumn() ?: null;
            }
            $values = [$name, $department, json_encode(array_values(array_unique($skills))), $slots, $head, $physical, $description, $officeUrl ?: null, $photoPath, $id];
            $sql = $action === 'create'
                ? 'INSERT INTO offices (officeName, department, requiredSkills, availableSlots, assignedOfficeHead, physicallyDemanding, officeDescription, officeUrl, officePhoto, officeId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
                : 'UPDATE offices SET officeName = ?, department = ?, requiredSkills = ?, availableSlots = ?, assignedOfficeHead = ?, physicallyDemanding = ?, officeDescription = ?, officeUrl = ?, officePhoto = ? WHERE officeId = ?';
            $pdo->prepare($sql)->execute($values);
        } finally {
            if ($lockAcquired) {
                $pdo->query("SELECT RELEASE_LOCK('office.offices.id')");
            }
        }

        officeRespond(true, $action === 'create' ? 'Office added.' : 'Office updated.');
    } catch (Throwable $e) {
        error_log($e->getMessage());
        officeRespond(false, 'Database request failed. Check connect.php and the offices table.', null, 500);
    }
}


// remove the app- text before using the id in sql
function CleanId($value)
{
    return (int) preg_replace('/\D/', '', (string) $value);
}

// trim input and change empty values to null
function PostOrNull($key)
{
    $v = trim($_POST[$key] ?? '');
    return $v === '' ? null : $v;
}


// crud: read all applicants for the table
function GetApplicants()
{
    global $pdo;

    try {
        $rows = $pdo->query("SELECT * FROM applicants ORDER BY applicant_id ASC")->fetchAll();

        foreach ($rows as &$r) {
            // add the app- label when showing the id
            $r['applicant_id'] = 'APP-' . $r['applicant_id'];
            // keep the old address name available to the page
            $r['house_address'] = $r['street_address'];
        }
        unset($r);

        echo json_encode($rows);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}


// crud: create a new applicant or update an existing one
function SaveApplicant()
{
    global $pdo;

    $id = CleanId($_POST['applicant_id'] ?? '');

    // these fields are required before saving
    $required = [
        'last_name', 'first_name', 'date_of_birth', 'gender', 'civil_status',
        'contact_number', 'email', 'barangay', 'street_address',
        'family_income', 'household_id',
        'school_level', 'year_level', 'school_name'
    ];

    // these fields are optional
    $optional = [
        'middle_name', 'ext_name',
        'father_name', 'father_occupation', 'father_contact',
        'mother_name', 'mother_occupation', 'mother_contact',
        'guardian_name', 'guardian_occupation', 'guardian_contact',
        'ofw_country', 'course', 'specialization', 'skills'
    ];

    // these lists prevent invalid values
    $enums = [
        'gender'             => ['Male', 'Female'],
        'civil_status'       => ['Single', 'Married', 'Widowed'],
        'ofw_in_family'      => ['Yes', 'No'],
        'school_level'       => ['Junior High School', 'Senior High School', 'College'],
        'applicant_status'   => ['Pending', 'Approved', 'Rejected', 'Under Review'],
        'application_status' => ['Under Review', 'Accepted', 'Waitlisted', 'Disqualified'],
        'cbms_status'        => ['Pending', 'Verified', 'Unverified'],
        'requirements_status' => ['Incomplete', 'Complete'],
    ];

    $data = [];

    // check the required fields
    foreach ($required as $col) {
        $val = trim($_POST[$col] ?? '');
        if ($val === '') {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => "$col is required"]);
            return;
        }
        $data[$col] = $val;
    }

    // collect the optional fields
    foreach ($optional as $col) {
        $data[$col] = PostOrNull($col);
    }

    // use defaults when a status is not selected
    $enumDefaults = [
        'ofw_in_family'      => 'No',
        'applicant_status'   => 'Under Review',
        'application_status' => 'Under Review',
        'cbms_status'        => 'Pending',
        'requirements_status' => 'Incomplete',
    ];
    foreach ($enums as $col => $list) {
        $val = trim($_POST[$col] ?? '');
        if ($val === '' && isset($enumDefaults[$col])) {
            $val = $enumDefaults[$col];
        }
        if (!in_array($val, $list, true)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => "invalid value for $col"]);
            return;
        }
        $data[$col] = $val;
    }

    // remove the country when there is no ofw
    if ($data['ofw_in_family'] === 'No') {
        $data['ofw_country'] = null;
    }

    // convert number inputs before saving
    $lya = PostOrNull('last_year_attended');
    $gwa = PostOrNull('gwa');
    $data['last_year_attended'] = $lya === null ? null : (int) $lya;
    $data['gwa']                = $gwa === null ? null : (float) $gwa;
    $data['availment_count']    = (int) ($_POST['availment_count'] ?? 0);
    $data['requirements_submitted'] = min(9, max(0, (int) ($_POST['requirements_submitted'] ?? 0)));
    $data['requirements_status'] = $data['requirements_submitted'] === 9 ? 'Complete' : 'Incomplete';

    try {
        if ($id > 0) {
            // crud: update the selected applicant
            $sets = [];
            foreach ($data as $col => $v) {
                $sets[] = "`$col` = :$col";
            }
            $sql  = "UPDATE applicants SET " . implode(', ', $sets) . " WHERE applicant_id = :applicant_id";
            $stmt = $pdo->prepare($sql);
            $params = [];
            foreach ($data as $col => $v) {
                $params[":$col"] = $v;
            }
            $params[':applicant_id'] = $id;
            $stmt->execute($params);

            echo json_encode([
                'success'      => true,
                'message'      => "Applicant APP-$id updated successfully.",
                'applicant_id' => "APP-$id"
            ]);
        } else {
            // crud: create a new applicant
            $cols = array_keys($data);
            $sql  = "INSERT INTO applicants (`" . implode('`, `', $cols) . "`) VALUES (:" . implode(', :', $cols) . ")";
            $stmt = $pdo->prepare($sql);
            $params = [];
            foreach ($data as $col => $v) {
                $params[":$col"] = $v;
            }
            $stmt->execute($params);
            $newId = $pdo->lastInsertId();

            echo json_encode([
                'success'      => true,
                'message'      => "Applicant APP-$newId added successfully.",
                'applicant_id' => "APP-$newId"
            ]);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}


// crud: update only the fields sent by the quick save button
function UpdateApplicantFields()
{
    global $pdo;

    $id = CleanId($_POST['applicant_id'] ?? '');
    if ($id <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'applicant_id is required']);
        return;
    }

    // these fields can be changed in a section
    $nullable = [
        'middle_name', 'ext_name',
        'father_name', 'father_occupation', 'father_contact',
        'mother_name', 'mother_occupation', 'mother_contact',
        'guardian_name', 'guardian_occupation', 'guardian_contact',
        'ofw_country', 'course', 'specialization', 'skills',
        'last_year_attended', 'gwa'
    ];
    $required = [
        'last_name', 'first_name', 'date_of_birth', 'gender', 'civil_status',
        'contact_number', 'email', 'barangay', 'street_address',
        'family_income', 'household_id',
        'school_level', 'year_level', 'school_name', 'availment_count',
        'requirements_submitted'
    ];
    $enums = [
        'gender'             => ['Male', 'Female'],
        'civil_status'       => ['Single', 'Married', 'Widowed'],
        'ofw_in_family'      => ['Yes', 'No'],
        'school_level'       => ['Junior High School', 'Senior High School', 'College'],
        'applicant_status'   => ['Pending', 'Approved', 'Rejected', 'Under Review'],
        'application_status' => ['Under Review', 'Accepted', 'Waitlisted', 'Disqualified'],
        'cbms_status'        => ['Pending', 'Verified', 'Unverified'],
        'requirements_status' => ['Incomplete', 'Complete'],
    ];

    $data = [];

    foreach (array_merge($required, $nullable, array_keys($enums)) as $col) {
        if (!array_key_exists($col, $_POST)) continue;   // missing fields stay unchanged
        $val = trim($_POST[$col]);

        if (in_array($col, $required, true) && $val === '') {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => "$col is required"]);
            return;
        }
        if (isset($enums[$col]) && !in_array($val, $enums[$col], true)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => "invalid value for $col"]);
            return;
        }

        if (in_array($col, $nullable, true) && $val === '') {
            $data[$col] = null;
        } elseif ($col === 'last_year_attended' || $col === 'availment_count' || $col === 'requirements_submitted') {
            $data[$col] = (int) $val;
        } elseif ($col === 'gwa') {
            $data[$col] = (float) $val;
        } else {
            $data[$col] = $val;
        }
    }

    if (array_key_exists('requirements_submitted', $data)) {
        $data['requirements_submitted'] = min(9, max(0, (int) $data['requirements_submitted']));
        $data['requirements_status'] = $data['requirements_submitted'] === 9 ? 'Complete' : 'Incomplete';
    }

    // no ofw means no country should be saved
    if (isset($data['ofw_in_family']) && $data['ofw_in_family'] === 'No') {
        $data['ofw_country'] = null;
    }

    if (!$data) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'nothing to update']);
        return;
    }

    try {
        $sets   = [];
        $params = [':applicant_id' => $id];
        foreach ($data as $col => $v) {
            $sets[]          = "`$col` = :$col";
            $params[":$col"] = $v;
        }
        $stmt = $pdo->prepare("UPDATE applicants SET " . implode(', ', $sets) . " WHERE applicant_id = :applicant_id");
        $stmt->execute($params);

        echo json_encode([
            'success'      => true,
            'message'      => "Applicant APP-$id updated successfully.",
            'applicant_id' => "APP-$id"
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}


// crud: delete one applicant after the page confirms it in javascript
function DeleteApplicant()
{
    global $pdo;

    $id = CleanId($_POST['applicant_id'] ?? '');

    if ($id <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'applicant_id is required']);
        return;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM applicants WHERE applicant_id = :id");
        $stmt->execute([':id' => $id]);

        echo json_encode([
            'success' => true,
            'message' => "Applicant APP-$id deleted successfully."
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => 'delete error']);
    }
}
