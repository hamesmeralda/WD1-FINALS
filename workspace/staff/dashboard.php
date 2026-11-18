<?php
$pageTitle = 'Staff Workspace | MetroSEED-Naga';
$activePage = 'staff-workspace';
$workspacePage = true;
$siteRoot = $siteRoot ?? '../../';
require '../../includes/site-header.php';
?>

<section class="workspace-hero">
  <div class="container">
    <div class="workspace-mark"><i class="bi bi-person-workspace"></i></div>
    <span class="eyebrow">STAFF WORKSPACE</span>
  </div>
</section>

<section class="section-space">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="detail-card workspace-tool-card h-100">
          <div class="workspace-tool-heading">
            <span class="card-icon"><i class="bi bi-people"></i></span>
            <h3>Manage applicants</h3>
          </div>
          <p>Review applications, update applicant information, and manage application statuses.</p>
          <button class="btn btn-brand mt-3" type="button">Open applicant management</button>
        </div>
      </div>

      <div class="col-md-6">
        <div class="detail-card workspace-tool-card h-100">
          <div class="workspace-tool-heading">
            <span class="card-icon"><i class="bi bi-building"></i></span>
            <h3>Manage offices</h3>
          </div>
          <p>Maintain participating offices, available assignments, and workplace information.</p>
          <button class="btn btn-brand mt-3" type="button">Open office management</button>
        </div>
      </div>
    </div>
  </div>
</section>




