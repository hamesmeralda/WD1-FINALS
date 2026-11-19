<?php
// this page contains the form and table layout
$siteRoot = '../../../';
$workspaceBackUrl = '../../../workspace/staff/staff.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register | YEP SPES &amp; SEFE</title>
  <link rel="icon" type="image/png" href="../../../assets/images/favicon/fav-icon.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="../../../assets/css/stylesheet.css?v=21" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../script.js"></script>

  <style>
    :root { --brand: #1e50a2; --brand-dark: #163c7a; --soft: #f4f6fb; }
    body { background: linear-gradient(#f8f9fc 0 55%, var(--brand) 55% 100%) fixed; font-family: "Poppins", system-ui, sans-serif; }
    .reg-card { max-width: 950px; border: 0; border-radius: 1.25rem; box-shadow: 0 .75rem 2.5rem rgba(0,0,0,.15); border-top: 4px solid var(--brand); font-size: .88rem; }
    .reg-card .card-body { padding: 1rem 1.75rem !important; }
    .reg-card .stepper { padding: .8rem 1.25rem; }
    .reg-card .form-section { min-height: 390px; }
    .reg-card .form-control, .reg-card .form-select { font-size: .86rem; min-height: 46px; }
    .reg-card .form-floating > label { font-size: .8rem; }
    .reg-card .section-head { padding: .6rem 1.75rem !important; }
    .reg-card .section-head h2 { font-size: .95rem !important; }
    .reg-card .section-badge { width: 36px; height: 36px; font-size: .85rem; }
    .reg-card .step-item { font-size: .68rem; }
    .reg-card .step-circle { width: 28px; height: 28px; font-size: .8rem; }
    .reg-card .sub-title { font-size: .82rem; margin: .9rem 0 .55rem; }
    .reg-card .btn { font-size: .82rem; padding: .5rem .75rem; }
    @media (max-width: 576px) {
      .reg-card .card-body { padding-left: 1rem !important; padding-right: 1rem !important; }
      .reg-card .section-head { padding-left: 1rem !important; padding-right: 1rem !important; }
      .reg-card .stepper { padding-left: .75rem; padding-right: .75rem; }
    }
    .container-fluid > .text-center h1 { font-size: 1.65rem; }
    .container-fluid > .text-center p { font-size: .85rem; }
    .btn-brand { background: var(--brand); border-color: var(--brand); color: #fff; }
    .btn-brand:hover { background: var(--brand-dark); border-color: var(--brand-dark); color: #fff; }

    .stepper { background: var(--soft); border: 1px solid #dde3f0; border-radius: 1rem; padding: 1.5rem 1rem; }
    .step-item { text-align: center; flex: 1; position: relative; font-size: .75rem; color: #5a6682; font-weight: 600; cursor: pointer; }
    .step-item::before { content: ""; position: absolute; top: 15px; left: -50%; width: 100%; height: 2px; background: #cfd6e6; z-index: 0; }
    .step-item:first-child::before { display: none; }
    .step-circle { width: 32px; height: 32px; border-radius: 50%; background: #dfe4f0; color: #5a6682; display: inline-flex; align-items: center; justify-content: center; position: relative; z-index: 1; margin-bottom: .25rem; }
    .step-item.active .step-circle, .step-item.done .step-circle { background: var(--brand); color: #fff; }
    .step-item.active, .step-item.done { color: var(--brand); }
    .step-item.done::before, .step-item.active::before { background: var(--brand); }

    .section-head { background: var(--soft); border-bottom: 1px solid #dde3f0; }
    .section-badge { width: 44px; height: 44px; border-radius: 50%; background: var(--brand); color: #fff; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    
    /* min-height keeps the card size consistent so it doesn't jump around */
    .form-section { display: none; min-height: 480px; }
    .form-section.active { display: block; animation: fade .3s ease; }
    @keyframes fade { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: none; } }

    .form-control, .form-select { background-color: var(--soft); }
    .sub-title { font-weight: 600; color: var(--brand); font-size: .9rem; border-bottom: 1px solid #e3e8f3; padding-bottom: .25rem; margin: 1.25rem 0 .75rem; }
    .review-block dt { font-weight: 500; color: #5a6682; font-size: .8rem; }
    .review-block dd { font-weight: 600; margin-bottom: .5rem; }

    .table-container { width: 100%; max-width: 1700px; background: #fff; border: 1px solid #e2e8f2; border-radius: 1rem; padding: 1.25rem 1.5rem; margin: 2rem auto 0; box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.08); }
    .applicants-heading { display: flex; align-items: center; gap: .75rem; }
    .applicants-heading .btn { margin-left: auto; }
    .applicants-heading-icon { width: 2.25rem; height: 2.25rem; display: inline-flex; align-items: center; justify-content: center; border-radius: .65rem; color: #fff; background: var(--brand); font-size: 1.1rem; flex-shrink: 0; }
    .applicants-heading h3 { font-size: 1.05rem; }
    .applicants-heading p { color: #71809a; font-size: .78rem; margin: .15rem 0 0; }
    .applicants-toolbar { background: var(--soft); border: 1px solid #e2e8f2; border-radius: .75rem; padding: .75rem; }
    .search-wrap { position: relative; flex: 1 1 280px; max-width: 380px; }
    .search-wrap .bi-search { position: absolute; top: 50%; left: .8rem; color: #71809a; transform: translateY(-50%); pointer-events: none; }
    .search-wrap input { padding-left: 2.25rem; background: #fff; }
    .sort-group { display: flex; flex-wrap: nowrap; align-items: center; gap: .5rem; margin-left: auto; white-space: nowrap; }
    .sort-group .form-label { color: #52617a; font-size: .8rem; font-weight: 600; white-space: nowrap; }
    .sort-group .form-select { min-width: 190px; background: #fff; }
    .sort-button { width: 2.35rem; height: 2.35rem; padding: 0; display: inline-flex; align-items: center; justify-content: center; font-weight: 700; }
    .table-container .table-responsive { border: 1px solid #e2e8f2; border-radius: .75rem; }
    .table-container .table { margin-bottom: 0; }
    .table-container .table th, .table-container .table td { padding: .65rem .75rem; }
    /* white-space nowrap prevents the table columns from squeezing awkwardly */
    .table th { font-size: 0.78rem; background-color: var(--soft); text-transform: uppercase; white-space: nowrap; }
    .table td { font-size: 0.8rem; white-space: nowrap; }

    #viewModal .modal-content { border: 0; border-radius: 1rem; overflow: hidden; }
    #viewModal .modal-header { background: var(--soft); border-bottom: 1px solid #dde3f0; padding: 1.25rem 1.5rem; }
    #viewModal .modal-body { background: #f8f9fc; padding: 1.25rem 1.5rem; }
    #viewModal .modal-footer { background: #fff; border-top: 1px solid #dde3f0; }
    .details-section { background: #fff; border: 1px solid #e1e6f0; border-radius: .75rem; padding: 1rem; margin-bottom: 1rem; }
    .details-section:last-child { margin-bottom: 0; }
    .details-section-title { color: var(--brand); font-size: .95rem; font-weight: 700; margin-bottom: .85rem; padding-bottom: .5rem; border-bottom: 2px solid #e8edf6; }
    .details-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: .75rem 1.25rem; }
    .detail-item { min-width: 0; }
    .detail-item.full-width { grid-column: 1 / -1; }
    .detail-label { display: block; color: #68758d; font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .03em; margin-bottom: .15rem; }
    .detail-value { display: block; color: #202b3c; font-size: .9rem; font-weight: 600; overflow-wrap: anywhere; }
    .status-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: .75rem; }
    .status-card { border: 1px solid #dfe5ef; border-radius: .65rem; padding: .75rem; background: #fbfcfe; }
    .status-card .status-label { display: block; color: #68758d; font-size: .72rem; font-weight: 700; text-transform: uppercase; margin-bottom: .35rem; }
    .status-pill { display: inline-block; border: 1px solid currentColor; border-radius: 999px; padding: .25rem .55rem; font-size: .78rem; font-weight: 700; }
    .status-pill.success { color: #198754; background: #f0fff7; }
    .status-pill.info { color: #0d6efd; background: #f2f7ff; }
    .status-pill.warning { color: #a66b00; background: #fff9e8; }
    .status-pill.danger { color: #dc3545; background: #fff5f5; }
    .status-pill.neutral { color: #657188; background: #f5f7fa; }
    @media (max-width: 576px) {
      .details-grid, .status-grid { grid-template-columns: 1fr; }
      .detail-item.full-width { grid-column: auto; }
      .table-container { padding: 1rem; }
      .applicants-heading { align-items: flex-start; flex-wrap: wrap; }
      .applicants-heading .btn { margin-left: auto; }
      .sort-group { width: 100%; margin-left: 0; }
      .sort-group .form-select { min-width: 0; flex: 1; }
    }
  </style>
</head>
<body>
<?php require __DIR__ . '/../../../includes/workspace-navbar.php'; ?>
<div class="container-fluid px-md-4 py-4">

  <div class="card reg-card mx-auto">
    <div class="card-body p-3 p-md-4">

      <div class="text-center mb-4 mt-2">
        <h1 class="h2 fw-bold mb-1">Applicant Registration &amp; Management</h1>
        <p class="text-secondary mb-0">Add a new applicant, or select one from the table below to edit. Changes are saved to the database.</p>
      </div>

      <div class="stepper d-flex mb-4" id="stepper">
        <div class="step-item active" data-step="1"><span class="step-circle">1</span><div class="step-label">Personal Info</div></div>
        <div class="step-item" data-step="2"><span class="step-circle">2</span><div class="step-label">Family Background</div></div>
        <div class="step-item" data-step="3"><span class="step-circle">3</span><div class="step-label">Education</div></div>
        <div class="step-item" data-step="4"><span class="step-circle">4</span><div class="step-label">Skills</div></div>
        <div class="step-item" data-step="5"><span class="step-circle">5</span><div class="step-label">Review</div></div>
      </div>

      <!-- crud: this form collects data for creating or updating applicants -->
      <form id="registrationForm" class="needs-validation" novalidate>
        <!-- empty id means add mode, filled id means edit mode -->
        <input type="hidden" id="applicant_id" name="applicant_id">

        <!-- step 1 collects personal information -->
        <section class="form-section active card mb-4" data-step="1">
          <div class="section-head d-flex align-items-center gap-3 p-3">
            <div class="section-badge">01</div>
            <h2 class="h6 fw-bold mb-0" style="color:var(--brand)">Personal Information</h2>
          </div>
          <div class="card-body p-3 p-md-4">
            <div class="row g-3">
              <div class="col-md-3">
                <div class="form-floating">
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                  <label for="last_name">Last Name</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating">
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                  <label for="first_name">First Name</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating">
                  <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name">
                  <label for="middle_name">Middle Name</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating">
                  <input type="text" class="form-control" id="ext_name" name="ext_name" placeholder="Suffix">
                  <label for="ext_name">Suffix</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-floating">
                  <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                  <label for="date_of_birth">Date of Birth</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating">
                  <select class="form-select" id="gender" name="gender" required>
                    <option value="" selected disabled>Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                  <label for="gender">Gender</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating">
                  <select class="form-select" id="civil_status" name="civil_status" required>
                    <option value="" selected disabled>Select</option>
                    <option>Single</option>
                    <option>Married</option>
                    <option>Widowed</option>
                  </select>
                  <label for="civil_status">Civil Status</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating">
                  <input type="tel" class="form-control" id="contact_number" name="contact_number" required>
                  <label for="contact_number">Contact Number</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="email" class="form-control" id="email" name="email" required>
                  <label for="email">Email Address</label>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-floating">
                  <select class="form-select" id="barangay" name="barangay" required></select>
                  <label for="barangay">Barangay</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" id="street_address" name="street_address" required>
                  <label for="street_address">Street Address / House No.</label>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- step 2 collects family information -->
        <section class="form-section card mb-4" data-step="2">
          <div class="section-head d-flex align-items-center gap-3 p-3">
            <div class="section-badge">02</div>
            <h2 class="h6 fw-bold mb-0" style="color:var(--brand)">Family Background</h2>
          </div>
          <div class="card-body p-3 p-md-4">
            <h3 class="sub-title mt-0">Father</h3>
            <div class="row g-3">
              <div class="col-md-4"><div class="form-floating"><input type="text" class="form-control" id="father_name" name="father_name" required><label>Father's Name</label></div></div>
              <div class="col-md-4"><div class="form-floating"><input type="text" class="form-control" id="father_occupation" name="father_occupation" required><label>Occupation</label></div></div>
              <div class="col-md-4"><div class="form-floating"><input type="tel" class="form-control" id="father_contact" name="father_contact"><label>Contact No.</label></div></div>
            </div>

            <h3 class="sub-title">Mother</h3>
            <div class="row g-3">
              <div class="col-md-4"><div class="form-floating"><input type="text" class="form-control" id="mother_name" name="mother_name" required><label>Mother's Name</label></div></div>
              <div class="col-md-4"><div class="form-floating"><input type="text" class="form-control" id="mother_occupation" name="mother_occupation" required><label>Occupation</label></div></div>
              <div class="col-md-4"><div class="form-floating"><input type="tel" class="form-control" id="mother_contact" name="mother_contact"><label>Contact No.</label></div></div>
            </div>

            <h3 class="sub-title">Guardian</h3>
            <div class="row g-3">
              <div class="col-md-4"><div class="form-floating"><input type="text" class="form-control" id="guardian_name" name="guardian_name"><label>Guardian's Name</label></div></div>
              <div class="col-md-4"><div class="form-floating"><input type="text" class="form-control" id="guardian_occupation" name="guardian_occupation"><label>Occupation</label></div></div>
              <div class="col-md-4"><div class="form-floating"><input type="tel" class="form-control" id="guardian_contact" name="guardian_contact"><label>Contact No.</label></div></div>
            </div>

            <h3 class="sub-title">Household Details</h3>
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label d-block">OFW in Family?</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="ofw_in_family" id="ofwYes" value="Yes">
                  <label for="ofwYes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="ofw_in_family" id="ofwNo" value="No" checked>
                  <label for="ofwNo">No</label>
                </div>
              </div>
              <div class="col-md-8" id="ofwCountryWrap" style="display:none">
                <div class="form-floating"><select class="form-select" id="ofw_country" name="ofw_country"></select><label>OFW Country</label></div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <select class="form-select" id="family_income" name="family_income" required>
                    <option value="" disabled selected>Select</option>
                    <option>Below ₱100,000</option>
                    <option>₱100,000 – ₱149,999</option>
                    <option>₱150,000 and above</option>
                  </select>
                  <label>Family Income</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control" id="household_id" name="household_id" required>
                  <label>Parent's TIN Number (Household ID)</label>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- step 3 collects school information -->
        <section class="form-section card mb-4" data-step="3">
          <div class="section-head d-flex align-items-center gap-3 p-3">
            <div class="section-badge">03</div>
            <h2 class="h6 fw-bold mb-0" style="color:var(--brand)">Educational Background</h2>
          </div>
          <div class="card-body p-3 p-md-4">
            <div class="row g-3">
              <div class="col-md-6">
                <div class="form-floating">
                  <select class="form-select" id="school_level" name="school_level" required>
                    <option value="" selected disabled>Select</option>
                    <option>Junior High School</option>
                    <option>Senior High School</option>
                    <option>College</option>
                  </select>
                  <label>School Level</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating"><select class="form-select" id="year_level" name="year_level" required></select><label>Year Level</label></div>
              </div>
              <div class="col-12">
                <div class="form-floating"><input type="text" class="form-control" id="school_name" name="school_name" required><label>School Name</label></div>
              </div>
              <div class="col-md-6 college-only">
                <div class="form-floating"><input type="text" class="form-control" id="course" name="course"><label id="courseLabel">Course</label></div>
              </div>
              <div class="col-md-6 college-only">
                <div class="form-floating"><input type="text" class="form-control" id="specialization" name="specialization"><label>Specialization</label></div>
              </div>
              <div class="col-md-4">
                <div class="form-floating"><input type="number" class="form-control" id="last_year_attended" name="last_year_attended" required><label>Last Year Attended</label></div>
              </div>
              <div class="col-md-4">
                <div class="form-floating"><input type="number" step="0.01" class="form-control" id="gwa" name="gwa" required><label>GWA</label></div>
              </div>
              <div class="col-md-4">
                <div class="form-floating"><input type="number" class="form-control" id="availment_count" name="availment_count" value="0" required><label>Times Availed</label></div>
              </div>
            </div>
          </div>
        </section>

        <!-- step 4 collects the applicant skills -->
        <section class="form-section card mb-4" data-step="4">
          <div class="section-head d-flex align-items-center gap-3 p-3">
            <div class="section-badge">04</div>
            <h2 class="h6 fw-bold mb-0" style="color:var(--brand)">Skill Profiling</h2>
          </div>
          <div class="card-body p-3 p-md-4">
            <div class="row g-2" id="skillList"></div>
            <div class="form-floating mt-3">
              <textarea class="form-control" id="skills_other" name="skills_other" style="height:90px"></textarea>
              <label for="skills_other">Other Skills</label>
            </div>
          </div>
        </section>

        <!-- step 5 reviews the data and statuses -->
        <section class="form-section card mb-4" data-step="5">
          <div class="section-head d-flex align-items-center gap-3 p-3">
            <div class="section-badge">05</div>
            <h2 class="h6 fw-bold mb-0" style="color:var(--brand)">Review &amp; Status Management</h2>
          </div>
          <div class="card-body p-3 p-md-4">
            <div id="reviewContent" class="review-block"></div>

            <h3 class="sub-title">Administrative Status Update</h3>
            <div class="row g-3">
              <div class="col-md-4">
                <div class="form-floating">
                  <select class="form-select" id="applicant_status" name="applicant_status" required>
                    <option value="Under Review" selected>Under Review</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                    <option value="Pending">Pending</option>
                  </select>
                  <label for="applicant_status">Applicant Status</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating">
                  <select class="form-select" id="application_status" name="application_status" required>
                    <option value="Under Review">Under Review</option>
                    <option value="Accepted">Accepted</option>
                    <option value="Waitlisted">Waitlisted</option>
                    <option value="Disqualified">Disqualified</option>
                  </select>
                  <label for="application_status">Application Status</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating">
                  <select class="form-select" id="cbms_status" name="cbms_status" required>
                    <option value="Pending">Pending</option>
                    <option value="Verified">Verified</option>
                    <option value="Unverified">Unverified</option>
                  </select>
                  <label for="cbms_status">CBMS Status</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating">
                  <input type="number" class="form-control" id="requirements_submitted" name="requirements_submitted" min="0" max="9" value="0" required>
                  <label for="requirements_submitted">Requirements Submitted</label>
                </div>
              </div>
            </div>

          </div>
        </section>

        <!-- these buttons control the form steps and saving -->
        <div class="d-flex justify-content-between mt-4">
          <button type="button" class="btn btn-outline-secondary px-4" id="btnPrev">Cancel</button>
          <div>
            <button type="button" class="btn btn-success px-4 me-2" id="btnQuickSave" style="display:none">Save This Section</button>
            <button type="button" class="btn btn-brand px-4" id="btnNext">Continue &rarr;</button>
            <button type="submit" class="btn btn-brand px-4" id="btnSubmit" style="display:none">Save Applicant</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- crud: this table displays the applicants read from the database -->
  <div class="table-container applicants-card">
    <div class="applicants-heading mb-3">
      <div class="applicants-heading-icon"><i class="bi bi-people" aria-hidden="true"></i></div>
      <div>
        <h3 class="fw-bold mb-0" style="color:var(--brand)">Registered Applicants</h3>
        <p>Search, sort, and manage all saved applicant records.</p>
      </div>
      <button type="button" id="btnAddApplicant" class="btn btn-brand btn-sm">
        <i class="bi bi-person-plus" aria-hidden="true"></i> Add Applicant
      </button>
    </div>
    <div class="applicants-toolbar d-flex flex-wrap align-items-center gap-2 mb-3">
      <div class="search-wrap">
        <i class="bi bi-search" aria-hidden="true"></i>
        <input type="search" id="txtSearch" class="form-control" placeholder="Search any name or applicant ID" aria-label="Search any name or applicant ID">
      </div>
      <div class="sort-group">
        <label for="sortField" class="form-label mb-0">Sort by</label>
        <select id="sortField" class="form-select" aria-label="Sort applicants by">
          <option value="last_name">Last Name</option>
          <option value="applicant_status">Applicant Status</option>
          <option value="application_status">Application Status</option>
          <option value="cbms_status">CBMS Status</option>
          <option value="requirements_status">Requirements Status</option>
          <option value="applicant_id">ID</option>
          <option value="barangay">Barangay</option>
        </select>
        <button type="button" id="btnSortAsc" class="btn btn-outline-primary sort-button" aria-label="Sort ascending" title="Sort ascending">&uarr;</button>
        <button type="button" id="btnSortDesc" class="btn btn-outline-primary sort-button" aria-label="Sort descending" title="Sort descending">&darr;</button>
      </div>
    </div>
    <div class="table-responsive">
      <table id="tableStudents" class="table table-striped table-bordered table-hover align-middle" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Contact &amp; Email</th>
            <th>Barangay</th>
            <th>Education Level</th>
            <th>Applicant Status</th>
            <th>CBMS Status</th>
            <th>Requirements</th>
            <th>Application Status</th>
            <th class="text-center"></th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>

</div>

<!-- this modal shows one applicant in a cleaner layout -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" style="color:var(--brand)">Applicant Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="viewModalBody">
        <!-- data is injected here by javascript -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>
