<?php
$pageTitle = 'Admin Workspace | MetroSEED-Naga';
$activePage = 'admin-workspace';
$workspacePage = true;
require 'includes/site-header.php';
?>

<section class="workspace-hero">
  <div class="container">
    <div class="workspace-mark"><i class="bi bi-shield-check"></i></div>
    <span class="eyebrow">ADMIN WORKSPACE</span>
  </div>
</section>

<section class="section-space">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="detail-card workspace-tool-card h-100">
          <div class="workspace-tool-heading">
            <span class="card-icon"><i class="bi bi-person-badge"></i></span>
            <h3>Manage staff accounts</h3>
          </div>
          <p>Create, review, and update staff access for the Metro PESO workspace.</p>
          <button class="btn btn-brand mt-3" type="button">Open staff account management</button>
        </div>
      </div>

      <div class="col-md-6">
        <div class="detail-card workspace-tool-card h-100">
          <div class="workspace-tool-heading">
            <span class="card-icon"><i class="bi bi-shield-lock"></i></span>
            <h3>Manage admin accounts</h3>
          </div>
          <p>Overall admin access is protected by a separate password.</p>
          <form class="mt-3">
            <label class="form-label" for="overall-admin-password">Overall admin password</label>
            <input class="form-control mb-3" id="overall-admin-password" type="password" placeholder="Enter password">
            <button class="btn btn-brand" type="button">Verify and continue</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

