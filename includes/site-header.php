<?php
$pageTitle = $pageTitle ?? 'MetroSEED-Naga | Youth Employment Program';
$activePage = $activePage ?? 'home';
$workspacePage = $workspacePage ?? false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="stylesheet.css?v=2">
  <link rel="icon" type="image/png" href="photos/favicon/fav-icon.png">
</head>
<body class="page-<?= htmlspecialchars($activePage) ?>">
  <nav class="navbar site-navbar navbar-expand-lg">
    <div class="container py-2">
      <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
        <img src="photos/metro-seed-logo.png" alt="MetroSEED-Naga logo" width="42" height="42">
        <span class="brand-copy"><strong>MetroSEED-Naga</strong><small>YOUTH EMPLOYMENT PROGRAM</small></span>
      </a>
      <?php if ($workspacePage): ?>
        <a class="nav-account ms-auto" href="login.php"><i class="bi bi-box-arrow-right"></i> Log Out</a>
      <?php else: ?>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#siteNav" aria-label="Open navigation"><i class="bi bi-list fs-2 text-navy"></i></button>
        <div class="collapse navbar-collapse" id="siteNav">
          <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
            <li class="nav-item"><a class="nav-link <?= $activePage === 'home' ? 'active' : '' ?>" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link <?= $activePage === 'about' ? 'active' : '' ?>" href="about.php">About Us</a></li>
            <li class="nav-item"><a class="nav-link <?= $activePage === 'benefits' ? 'active' : '' ?>" href="benefits.php">Benefits</a></li>
            <li class="nav-item"><a class="nav-link <?= $activePage === 'process' ? 'active' : '' ?>" href="process.php">Process</a></li>
            <li class="nav-item"><a class="nav-link <?= $activePage === 'deployment' ? 'active' : '' ?>" href="deployment.php">Deployment</a></li>
            <li class="nav-item ms-lg-2"><a class="nav-account" href="login.php"><i class="bi bi-person-circle"></i> Account</a></li>
          </ul>
        </div>
      <?php endif; ?>
    </div>
  </nav>
  <main>
