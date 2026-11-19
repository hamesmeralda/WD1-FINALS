<?php
// shared MetroPESO database connection.
$connectionName = 'MetroPESO';
$host     = '127.0.0.1';
$port     = 3307;
$username = 'root';
$password = '';
$dbname   = 'metroseed';

try {
    // use the requested MetroPESO port first, then support the default XAMPP
    // port when the local MySQL service is still configured for 3306.
    $connectionPorts = array_values(array_unique([$port, 3306]));
    $lastConnectionError = null;

    foreach ($connectionPorts as $connectionPort) {
        try {
            $pdo = new PDO(
                "mysql:host=$host;port=$connectionPort;dbname=$dbname;charset=utf8mb4",
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
            $activePort = $connectionPort;
            break;
        } catch (PDOException $e) {
            $lastConnectionError = $e;
        }
    }

    if (!isset($pdo)) {
        throw $lastConnectionError ?? new PDOException('database connection failed');
    }
} catch (PDOException $e) {
    if (!empty($allowConnectionFailure)) {
        $pdo = null;
        return;
    }

    // return a simple error when the database is unavailable
    http_response_code(500);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'error' => 'database connection failed']);
    exit;
}
