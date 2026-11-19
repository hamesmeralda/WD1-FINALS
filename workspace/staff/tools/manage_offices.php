<?php
$siteRoot = '../../../';
$workspaceBackUrl = '../../../workspace/staff/staff.php';
?>
<!--Name: Corrales, Fin Ahsley
    Section:BIT212L-OBb | 3105
    Group#: 6
    Entity: Office
    Attributes: officeId
                officeName
                department
                requiredSkills
                availableSlots
                assignedOfficeHead
                physicallyDemanding
                officeDescription
-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MetroSEED - Office Form</title>
    <link rel="icon" type="image/png" href="../../../assets/images/favicon/fav-icon.png">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/css/stylesheet.css?v=21">
    
    <style>body{font-family:Montserrat,sans-serif}.office-records-table{min-width:1100px}.text-navy{color:#16345a}</style>
    <style>
        .required-skills-options .skill-option { flex: 0 1 auto; max-width: 100%; }
        .required-skills-options .form-check-label { overflow-wrap: anywhere; cursor: pointer; }
        @media (max-width: 575.98px) {
            .required-skills-options .skill-option { flex-basis: calc(50% - .5rem); min-width: 0; }
        }
        @media (max-width: 359.98px) {
            .required-skills-options .skill-option { flex-basis: 100%; }
        }
        .office-records-card .table-responsive { overflow-x: auto !important; }
        .office-records-table { width: 100%; table-layout: fixed; font-size: .78rem; }
        .office-records-table th, .office-records-table td { padding: .45rem .3rem; white-space: normal !important; overflow-wrap: anywhere; vertical-align: middle; }
        .office-records-table th:nth-child(1) { width: 3%; }
        .office-records-table th:nth-child(2) { width: 10%; }
        .office-records-table th:nth-child(3) { width: 12%; }
        .office-records-table th:nth-child(4) { width: 10%; }
        .office-records-table th:nth-child(5) { width: 14%; }
        .office-records-table th:nth-child(6) { width: 7%; }
        .office-records-table th:nth-child(7) { width: 11%; }
        .office-records-table th:nth-child(8) { width: 11%; }
        .office-records-table th:nth-child(9) { width: 11%; }
        .office-records-table th:nth-child(10) { width: 11%; }
        .office-records-table td:last-child { display: table-cell; vertical-align: middle; }
        .office-records-table td:last-child .btn { padding: .2rem .35rem; font-size: .72rem; }
    </style>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="../script.js?v=<?= filemtime(__DIR__ . '/../script.js') ?>" defer></script>
</head>
<body class="dashboard-body bg-light">
<?php require __DIR__ . '/../../../includes/workspace-navbar.php'; ?>


    <main class="w-100">


        
        <div class="container py-4" style="max-width: 1400px;">


            
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="p-2 bg-white rounded-3 shadow-sm border">
                    <i class="bi bi-building fs-3 text-primary"></i>
                </div>
                <div>
                    <h2 class="fw-bold text-dark mb-0" style="font-size: 1.6rem;">Office Directory</h2>
                    <p class="text-muted mb-0 small">Manage and add Office Information for Youth deployment</p>
                </div>
            </div>


            
            <div class="card border-0 shadow-sm rounded-4 mb-3 mx-auto" style="max-width: 800px;">
                <div class="card-body p-4 p-md-5">


                    
                    <div class="border-start border-4 border-primary ps-3 mb-4">
                        <h5 class="fw-bold text-dark mb-1">Add New Office</h5>
                        <p class="text-muted small mb-0">Enter the required details below to register a new office in the Metro-SEED program</p>
                    </div>


                    
                    <div id="formMessage" class="alert rounded-3 mb-4" role="status" aria-live="polite" hidden></div>
<form action="#" method="POST" id="officeForm" enctype="multipart/form-data">


                        
                        <input type="hidden" name="officeId" id="officeId" value="">


                        
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control bg-light fs-6" id="officeName" name="officeName" placeholder="Office Name *" required>
                            <label for="officeName" class="text-muted">Office Name <span class="text-danger">*</span></label>
                        </div>


                        
                        <div class="mb-4">
                            <label for="Department" class="form-label fw-bold text-dark small">Department <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg bg-light fs-6" id="Department" name="Department" required>
                                <option value="" selected disabled>Enter Department</option>
                                <option value="Mayor's Office">Mayor's Office</option>
                                <option value="City Library">City Library</option>
                                <option value="City Engineer's Office">City Engineer's Office</option>
                                <option value="Metro PESO">Metro PESO</option>
                            </select>
                        </div>


                        
                        <fieldset class="mb-4">
                            <legend class="form-label fw-bold text-dark small mb-2">Required Skills <span class="text-danger">*</span></legend>
                            <div class="border rounded-3 p-3 bg-light">
                                <div class="d-flex flex-row flex-wrap gap-3 align-items-start required-skills-options">
<div class="form-check mb-0 skill-option">
                                            <input class="form-check-input" type="checkbox" name="requiredSkills" value="Communication" id="skillCommunication">
                                            <label class="form-check-label text-secondary small" for="skillCommunication">Communication</label>
                                        </div>
<div class="form-check mb-0 skill-option">
                                            <input class="form-check-input" type="checkbox" name="requiredSkills" value="Computer Literacy" id="skillComputerLiteracy">
                                            <label class="form-check-label text-secondary small" for="skillComputerLiteracy">Computer Literacy</label>
                                        </div>
<div class="form-check mb-0 skill-option">
                                            <input class="form-check-input" type="checkbox" name="requiredSkills" value="Data Entry" id="skillDataEntry">
                                            <label class="form-check-label text-secondary small" for="skillDataEntry">Data Entry</label>
                                        </div>
<div class="form-check mb-0 skill-option">
                                            <input class="form-check-input" type="checkbox" name="requiredSkills" value="Graphic Design" id="skillGraphicDesign">
                                            <label class="form-check-label text-secondary small" for="skillGraphicDesign">Graphic Design</label>
                                        </div>
<div class="form-check mb-0 skill-option">
                                            <input class="form-check-input" type="checkbox" name="requiredSkills" value="Teamwork" id="skillTeamwork">
                                            <label class="form-check-label text-secondary small" for="skillTeamwork">Teamwork</label>
                                        </div>
<div class="form-check mb-0 skill-option">
                                            <input class="form-check-input" type="checkbox" name="requiredSkills" value="Microsoft Office" id="skillMicrosoftOffice">
                                            <label class="form-check-label text-secondary small" for="skillMicrosoftOffice">Microsoft Office</label>
                                        </div>
<div class="form-check mb-0 skill-option">
                                            <input class="form-check-input" type="checkbox" name="requiredSkills" value="Customer Service" id="skillCustomerService">
                                            <label class="form-check-label text-secondary small" for="skillCustomerService">Customer Service</label>
                                        </div>
<div class="form-check mb-0 skill-option">
                                            <input class="form-check-input" type="checkbox" name="requiredSkills" value="Leadership" id="skillLeadership">
                                            <label class="form-check-label text-secondary small" for="skillLeadership">Leadership</label>
                                        </div>
                                    <div class="form-check mb-0 skill-option">
                                        <input class="form-check-input" type="checkbox" name="requiredSkills" value="Other" id="skillOther" aria-controls="otherSkillField" aria-expanded="false">
                                        <label class="form-check-label text-secondary small" for="skillOther">Other</label>
                                    </div>
                                </div>
                                <div class="mt-3" id="otherSkillField" hidden>
                                    <label class="form-label small" for="otherSkill">Please specify the other required skill <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="otherSkill" name="otherSkill" placeholder="Enter another required skill" disabled>
                                </div>
                            </div>
                            <div class="form-text text-muted" style="font-size: 0.72rem;">Select one or more required skills.</div>
                        </fieldset>
                        
                        <div class="mb-4">
                            <label for="officeDescription" class="form-label fw-bold text-dark small">Office Description</label>
                            <textarea class="form-control bg-light fs-6" id="officeDescription" name="officeDescription" rows="2" placeholder="Enter a short description of the office..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="officeUrl" class="form-label fw-bold text-dark small">View Office Information Link</label>
                            <input type="url" class="form-control bg-light fs-6" id="officeUrl" name="officeUrl" placeholder="https://example.gov.ph/office-information">
                        </div>

                        <div class="mb-4">
                            <label for="officePhoto" class="form-label fw-bold text-dark small">Office Photo <span class="text-muted fw-normal">(optional)</span></label>
                            <input type="file" class="form-control bg-light fs-6" id="officePhoto" name="officePhoto" accept="image/jpeg,image/png,image/webp">
                            <div class="form-text">JPG, PNG, or WEBP up to 5 MB.</div>
                        </div>


                        
                        <div class="mb-4">
                            <label for="availableSlots" class="form-label fw-bold text-dark small">Available Slots <span class="text-danger" aria-hidden="true">*</span></label>
                            <input type="number" class="form-control form-control-lg bg-light fs-6" id="availableSlots" name="availableSlots" value="0" min="0" required>
                        </div>


                        
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control bg-light fs-6" id="assignedOfficeHead" name="assignedOfficeHead" placeholder="Assigned Office Head" required>
                            <label for="assignedOfficeHead" class="text-muted">Assigned Office Head <span class="text-danger" aria-hidden="true">*</span></label>
                        </div>


                        
                        <div class="mb-5">
                            <label class="form-label fw-bold text-dark small mb-2">Physically Demanding <span class="text-danger" aria-hidden="true">*</span></label>
                            <div class="d-flex align-items-center gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="physicallyDemanding" id="demandingYes" value="Yes" required>
                                    <label class="form-check-label text-dark small" for="demandingYes">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="physicallyDemanding" id="demandingNo" value="No" checked required>
                                    <label class="form-check-label text-dark small" for="demandingNo">No</label>
                                </div>
                            </div>
                        </div>


                        
                        <div class="d-flex justify-content-end align-items-center gap-2">
                            <button type="button" id="cancelOfficeBtn" class="btn btn-outline-primary rounded-pill px-4 py-2 text-primary fw-semibold" style="font-size: 0.85rem;">Cancel</button>
                            <button type="submit" id="submitOfficeBtn" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold" style="font-size: 0.85rem;">+ Add Office</button>
                        </div>


                    </form>
                </div>
            </div>



            
            <div class="card border-0 shadow-sm rounded-4 mt-4 mb-3 office-records-card">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3">Office Records</h5>
<div class="row g-3 align-items-end mb-3">
 <div class="col-12 col-lg-5"><label for="officeSearch" class="form-label small fw-semibold">Search by Office ID, office name or office head</label><input type="search" id="officeSearch" class="form-control" placeholder="Enter Office ID, office name or last name..."></div>
 <div class="col-6 col-lg-3"><label for="officeSort" class="form-label small fw-semibold">Sort by</label><select id="officeSort" class="form-select">
 <option value="officeId">Office ID</option><option value="officeName">Office Name</option><option value="department">Department</option><option value="assignedOfficeHead">Assigned Office Head</option>
 </select></div>
 <div class="col-6 col-lg-2"><label for="officeSortDirection" class="form-label small fw-semibold">Order</label><select id="officeSortDirection" class="form-select"><option value="asc">Ascending</option><option value="desc">Descending</option></select></div>
 <div class="col-12 col-lg-2"><button type="button" id="clearOfficeFilters" class="btn btn-outline-secondary w-100">Reset</button></div>
</div>
<div id="officeResultCount" class="text-muted small mb-2" role="status" aria-live="polite"></div>
                    <div id="officeMessage" class="small mb-2" role="status" aria-live="polite"></div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle small office-records-table">
                            <thead class="table-light"><tr>
                                <th>#</th><th>Office ID</th><th>Office Name</th><th>Department</th>
                                <th>Required Skills</th><th>Available Slots</th><th>Assigned Office Head</th>
                                <th>Physically Demanding</th><th>Office Description</th><th>Actions</th>
                            </tr></thead>
                            <tbody id="officeTableBody"><tr><td colspan="10">Loading offices...</td></tr></tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            <div class="alert alert-primary border-0 rounded-4 d-flex align-items-center gap-2 py-2 px-3 mb-0 shadow-sm" style="background-color: #dbeafe;">
                <i class="bi bi-info-circle-fill text-primary fs-5"></i>
                <span class="text-primary fw-medium" style="font-size: 0.75rem;">
                    <strong>Note:</strong> The added office will be available in the deployment list for youth applicants.
                </span>
            </div>


        </div>
    </main>


   
<div class="modal fade" id="deleteOfficeModal" tabindex="-1" aria-labelledby="deleteOfficeTitle" aria-describedby="deleteOfficeWarning" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content border-0 rounded-4 shadow">
   <div class="modal-header border-0 px-4 pt-4">
    <h5 class="modal-title fw-bold" id="deleteOfficeTitle"><i class="bi bi-exclamation-triangle text-danger me-2" aria-hidden="true"></i>Delete office?</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <div class="modal-body px-4">
    <p class="mb-2">Are you sure you want to delete <strong id="deleteOfficeName"></strong>?</p>
    <p class="small text-muted mb-0" id="deleteOfficeWarning">This will permanently remove the office record. This action cannot be undone.</p>
    <div id="deleteOfficeError" class="text-danger small mt-3" role="alert" hidden></div>
   </div>
   <div class="modal-footer border-0 px-4 pb-4">
    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
    <button type="button" class="btn btn-danger rounded-pill px-4" id="confirmDeleteOfficeBtn">Delete Office</button>
   </div>
  </div>
 </div>
</div>
<div class="modal fade" id="updateSuccessModal" tabindex="-1" aria-labelledby="updateSuccessTitle" aria-describedby="updateSuccessDescription" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content border-0 rounded-4 shadow text-center">
   <div class="modal-body p-4 p-md-5">
    <i class="bi bi-check-circle-fill text-success display-4" aria-hidden="true"></i>
    <h5 class="fw-bold mt-3" id="updateSuccessTitle">Office updated successfully</h5>
    <p class="text-muted small mb-4" id="updateSuccessDescription">Your changes have been saved to the database.</p>
    <button type="button" class="btn btn-primary rounded-pill px-5" data-bs-dismiss="modal">OK</button>
   </div>
  </div>
 </div>
</div>
</body>
</html>









