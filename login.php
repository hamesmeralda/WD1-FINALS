<?php
$pageTitle = 'Account | MetroSEED-Naga';
$activePage = '';
require 'includes/site-header.php';
?>

<section class="page-hero">
  <div class="container">
    <span class="eyebrow">WORKSPACE ACCESS</span>
    <h1>Choose your workspace.</h1>
    <p>Use a sample role below to preview the staff or admin workspace.</p>
  </div>
</section>

<section class="section-space">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="detail-card">
          <form>
            <label class="form-label">Email address</label>
            <input class="form-control mb-3" type="email" placeholder="you@example.com">

            <label class="form-label">Password</label>
            <input class="form-control mb-3" type="password" placeholder="Enter your password">

            <div class="d-flex justify-content-between align-items-center mb-4">
              <a href="#" class="text-link">Forgot password?</a>
              <span class="small text-muted">Staff and admin access only</span>
            </div>

            <button class="btn btn-brand w-100" type="button">
              Sign in <i class="bi bi-arrow-right"></i>
            </button>

            <div class="mt-3">
              <p class="small text-muted mb-2">Sample role</p>
              <div class="d-flex gap-2">
                <a class="btn btn-soft flex-fill" href="staff.php">Staff</a>
                <a class="btn btn-soft flex-fill" href="admin.php">Admin</a>
              </div>
            </div>
          </form>

          <p class="text-center mt-4 mb-0 small text-muted">
            Applicant and beneficiary access will be available in a future update.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require 'includes/site-footer.php'; ?>
