<?php
$siteRoot = $siteRoot ?? '../../';
$workspaceBackUrl = $workspaceBackUrl ?? ($siteRoot . 'workspace/staff/staff.php');
?>
<nav class="navbar site-navbar navbar-expand-lg">
  <div class="container py-2">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= $siteRoot ?>index.php">
      <img src="<?= $siteRoot ?>assets/images/metro-seed-logo.png" alt="MetroSEED-Naga logo" width="42" height="42">
      <span class="brand-copy"><strong>MetroSEED-Naga</strong><small>YOUTH EMPLOYMENT PROGRAM</small></span>
    </a>
    <div class="ms-auto d-flex align-items-center gap-3">
      <a class="nav-account" href="<?= htmlspecialchars($workspaceBackUrl) ?>"><i class="bi bi-arrow-left"></i> Back to workspace</a>
      <a class="nav-account" href="<?= $siteRoot ?>pages/account/login.php"><i class="bi bi-box-arrow-right"></i> Log Out</a>
    </div>
  </div>
</nav>
