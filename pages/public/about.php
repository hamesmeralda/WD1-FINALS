<?php
$pageTitle = 'About Us | MetroSEED-Naga';
$activePage = 'about';
$siteRoot = $siteRoot ?? '../../';
require '../../includes/site-header.php';
?>

<section class="page-hero">
  <div class="container">
    <span class="eyebrow">ABOUT US</span>
    <h1>A city program built around youth potential.</h1>
    <p>Metro PESO connects Naga City residents to work opportunities and helps young people take a practical first step into the workforce.</p>
  </div>
</section>

<section class="section-space">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-5">
        <div class="about-program-card">
          <div class="about-program-card-header">
            <img src="<?= $siteRoot ?>assets/images/metro-peso-seal.png" alt="Metro PESO seal">
            <span>METRO PESO<br><small>CITY OF NAGA</small></span>
          </div>
          <div class="about-program-card-info">
            <h3>Metropolitan Naga Public Employment Office</h3>
            <p>The primary gateway for NagueÃ±os to access meaningful employment opportunities, career guidance, and workforce development initiatives.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <span class="eyebrow">YEP'S PURPOSE</span>
        <h2>Helping deserving youth earn while they learn.</h2>
        <p>Metro PESO is the lead implementing office for the Youth Employment Program (YEP). It coordinates with DOLE, city offices, schools, the CSWDO, and private employers so that eligible youth can access short-term employment and practical workplace experience.</p>
        <p>YEP is designed to ease education-related expenses, strengthen employability, and create a fair pathway into work for students, out-of-school youth, and dependents of displaced workers.</p>
      </div>
    </div>
  </div>
</section>

<section class="soft-section">
  <div class="container">
    <div class="section-heading">
      <span class="eyebrow">PROGRAMS OFFERED</span>
      <h2>Three pathways, one shared goal.</h2>
      <p>Beneficiaries are assigned according to eligibility, available slots, and funding sources.</p>
    </div>
    <div class="row g-4">
      <div class="col-lg-4"><div class="program-tile"><span class="tile-number">01</span><h3>SPES</h3><p>Special Program for Employment of Students, implemented with DOLE for qualified student beneficiaries.</p><span class="tile-tag">DOLE partnership</span></div></div>
      <div class="col-lg-4"><div class="program-tile"><span class="tile-number">02</span><h3>SEFE</h3><p>Students Employment for Enrollment, a city-funded pathway for qualified youth not accommodated by SPES slots.</p><span class="tile-tag">City-funded support</span></div></div>
      <div class="col-lg-4"><div class="program-tile"><span class="tile-number">03</span><h3>Private Sector Partnership</h3><p>Work opportunities with registered private establishments in Naga City under a formal agreement.</p><span class="tile-tag">Partner employers</span></div></div>
    </div>
  </div>
</section>

<section class="section-space">
  <div class="container">
    <div class="callout">
      <div>
        <h2>Selection is designed to reach those who need the opportunity most.</h2>
        <p class="mb-0">Priority may be given to youth ages 18â€“30, children of solo parents, youth with disabilities or children of persons with disabilities, low-income households, and applicants with strong academic standing.</p>
      </div>
      <a class="btn btn-brand" href="<?= $siteRoot ?>pages/public/process.php">View qualifications</a>
    </div>
  </div>
</section>

<section class="soft-section about-leadership">
  <div class="container">
    <div class="section-heading">
      <span class="eyebrow">METRO PESO LEADERSHIP</span>
      <h2>The people guiding the program.</h2>
      <p>Meet the head manager of the Metro PESO office and the officers supporting its implementing division.</p>
    </div>

    <div class="row g-4 justify-content-center mb-4">
      <div class="col-lg-5 col-xl-4">
        <div class="leadership-card leadership-manager h-100">
          <div class="photo-placeholder leadership-photo">
            <img src="<?= $siteRoot ?>assets/images/officers/roderickreforsado.jpg" alt="Roderick Reforsado, Metro PESO Head Manager">
          </div>
          <div class="leadership-copy">
            <span class="leadership-label">OFFICE OF THE METRO PESO</span>
            <h4>Roderick Reforsado</h4>
            <p>Head Manager, Metro Naga Public Employment Service Office</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-4 justify-content-center mb-5">
      <div class="col-12">
        <div class="leadership-intro h-100">
          <span class="eyebrow">IMPLEMENTING DIVISION</span>
          <h3>Manpower Development and Placement Division</h3>
          <p>These officers help coordinate employment services, applicant support, partner coordination, and the delivery of Metro PESO programs.</p>
        </div>
      </div>
    </div>

    <div class="row g-4">
      <div class="col-sm-6 col-xl-3"><div class="leadership-card h-100"><div class="photo-placeholder leadership-photo"><i class="bi bi-person"></i><span>Officer 1 photo</span><small>Photo placeholder</small></div><div class="leadership-copy"><h3>Division Officer 1</h3><p>Implementing Division Officer</p></div></div></div>
      <div class="col-sm-6 col-xl-3"><div class="leadership-card h-100"><div class="photo-placeholder leadership-photo"><i class="bi bi-person"></i><span>Officer 2 photo</span><small>Photo placeholder</small></div><div class="leadership-copy"><h3>Division Officer 2</h3><p>Implementing Division Officer</p></div></div></div>
      <div class="col-sm-6 col-xl-3"><div class="leadership-card h-100"><div class="photo-placeholder leadership-photo"><i class="bi bi-person"></i><span>Officer 3 photo</span><small>Photo placeholder</small></div><div class="leadership-copy"><h3>Division Officer 3</h3><p>Implementing Division Officer</p></div></div></div>
      <div class="col-sm-6 col-xl-3"><div class="leadership-card h-100"><div class="photo-placeholder leadership-photo"><i class="bi bi-person"></i><span>Officer 4 photo</span><small>Photo placeholder</small></div><div class="leadership-copy"><h3>Division Officer 4</h3><p>Implementing Division Officer</p></div></div></div>
    </div>
  </div>
</section>

<?php require '../../includes/site-footer.php'; ?>



