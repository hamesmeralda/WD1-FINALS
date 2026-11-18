<?php $pageTitle = 'Register | MetroSEED-Naga'; $activePage = 'registration'; $siteRoot = $siteRoot ?? '../../';
require '../../includes/site-header.php'; ?>

<section class="page-hero"><div class="container"><span class="eyebrow">GET STARTED</span><h1>Register your interest in YEP.</h1><p>Complete the application details below. Metro PESO staff will validate your information and update your application status.</p></div></section>

<section class="section-space registration-section">
  <div class="container">
    <div class="registration-card">
      <div class="registration-stepper" id="registrationStepper">
        <button type="button" class="registration-step active" data-step="1"><span>1</span>Personal</button>
        <button type="button" class="registration-step" data-step="2"><span>2</span>Family</button>
        <button type="button" class="registration-step" data-step="3"><span>3</span>Education</button>
        <button type="button" class="registration-step" data-step="4"><span>4</span>Skills</button>
        <button type="button" class="registration-step" data-step="5"><span>5</span>Review</button>
      </div>

      <form id="registrationForm" novalidate>
        <section class="registration-form-section active" data-step="1">
          <div class="registration-section-heading"><span>01</span><div><h2>Personal Information</h2><p>Tell us how we can identify and contact you.</p></div></div>
          <div class="row g-3">
            <div class="col-md-3"><label class="form-label" for="last_name">Last Name *</label><input class="form-control" id="last_name" name="last_name" required></div>
            <div class="col-md-3"><label class="form-label" for="first_name">First Name *</label><input class="form-control" id="first_name" name="first_name" required></div>
            <div class="col-md-3"><label class="form-label" for="middle_name">Middle Name</label><input class="form-control" id="middle_name" name="middle_name"></div>
            <div class="col-md-3"><label class="form-label" for="ext_name">Suffix</label><input class="form-control" id="ext_name" name="ext_name"></div>
            <div class="col-md-4"><label class="form-label" for="date_of_birth">Date of Birth *</label><input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required></div>
            <div class="col-md-4"><label class="form-label" for="gender">Gender *</label><select class="form-select" id="gender" name="gender" required><option value="">Select</option><option>Male</option><option>Female</option></select></div>
            <div class="col-md-4"><label class="form-label" for="civil_status">Civil Status *</label><select class="form-select" id="civil_status" name="civil_status" required><option value="">Select</option><option>Single</option><option>Married</option><option>Widowed</option></select></div>
            <div class="col-md-6"><label class="form-label" for="contact_number">Contact Number *</label><input type="tel" class="form-control" id="contact_number" name="contact_number" required></div>
            <div class="col-md-6"><label class="form-label" for="email">Email Address *</label><input type="email" class="form-control" id="email" name="email" required></div>
            <div class="col-md-6"><label class="form-label" for="barangay">Barangay *</label><select class="form-select" id="barangay" name="barangay" required><option value="">Select barangay</option></select></div>
            <div class="col-md-6"><label class="form-label" for="street_address">Street Address / House No. *</label><input class="form-control" id="street_address" name="street_address" required></div>
          </div>
        </section>

        <section class="registration-form-section" data-step="2">
          <div class="registration-section-heading"><span>02</span><div><h2>Family Background</h2><p>Provide household information for eligibility assessment.</p></div></div>
          <h3>Father</h3><div class="row g-3"><div class="col-md-4"><label class="form-label" for="father_name">Name *</label><input class="form-control" id="father_name" name="father_name" required></div><div class="col-md-4"><label class="form-label" for="father_occupation">Occupation *</label><input class="form-control" id="father_occupation" name="father_occupation" required></div><div class="col-md-4"><label class="form-label" for="father_contact">Contact Number</label><input class="form-control" id="father_contact" name="father_contact"></div></div>
          <h3>Mother</h3><div class="row g-3"><div class="col-md-4"><label class="form-label" for="mother_name">Name *</label><input class="form-control" id="mother_name" name="mother_name" required></div><div class="col-md-4"><label class="form-label" for="mother_occupation">Occupation *</label><input class="form-control" id="mother_occupation" name="mother_occupation" required></div><div class="col-md-4"><label class="form-label" for="mother_contact">Contact Number</label><input class="form-control" id="mother_contact" name="mother_contact"></div></div>
          <h3>Guardian <small>(if applicable)</small></h3><div class="row g-3"><div class="col-md-4"><label class="form-label" for="guardian_name">Name</label><input class="form-control" id="guardian_name" name="guardian_name"></div><div class="col-md-4"><label class="form-label" for="guardian_occupation">Occupation</label><input class="form-control" id="guardian_occupation" name="guardian_occupation"></div><div class="col-md-4"><label class="form-label" for="guardian_contact">Contact Number</label><input class="form-control" id="guardian_contact" name="guardian_contact"></div></div>
          <h3>Household Details</h3><div class="row g-3"><div class="col-md-4"><label class="form-label d-block">OFW in Family? *</label><label class="me-3"><input type="radio" name="ofw_in_family" value="Yes"> Yes</label><label><input type="radio" name="ofw_in_family" value="No" checked> No</label></div><div class="col-md-8" id="ofwCountryWrap" hidden><label class="form-label" for="ofw_country">OFW Country</label><select class="form-select" id="ofw_country" name="ofw_country"><option value="">Select country</option></select></div><div class="col-md-6"><label class="form-label" for="family_income">Family Income *</label><select class="form-select" id="family_income" name="family_income" required><option value="">Select income range</option><option>Below â‚±100,000</option><option>â‚±100,000 â€“ â‚±149,999</option><option>â‚±150,000 and above</option></select></div><div class="col-md-6"><label class="form-label" for="household_id">Parent's TIN / Household ID *</label><input class="form-control" id="household_id" name="household_id" required></div></div>
        </section>

        <section class="registration-form-section" data-step="3">
          <div class="registration-section-heading"><span>03</span><div><h2>Educational Background</h2><p>Share your current or most recent school information.</p></div></div>
          <div class="row g-3"><div class="col-md-6"><label class="form-label" for="school_level">School Level *</label><select class="form-select" id="school_level" name="school_level" required><option value="">Select level</option><option>Junior High School</option><option>Senior High School</option><option>College</option></select></div><div class="col-md-6"><label class="form-label" for="year_level">Year Level *</label><select class="form-select" id="year_level" name="year_level" required><option value="">Select year level</option></select></div><div class="col-12"><label class="form-label" for="school_name">School Name *</label><input class="form-control" id="school_name" name="school_name" required></div><div class="col-md-6 college-only" hidden><label class="form-label" for="course">Course</label><input class="form-control" id="course" name="course"></div><div class="col-md-6 college-only" hidden><label class="form-label" for="specialization">Specialization</label><input class="form-control" id="specialization" name="specialization"></div><div class="col-md-4"><label class="form-label" for="last_year_attended">Last Year Attended *</label><input type="number" class="form-control" id="last_year_attended" name="last_year_attended" required></div><div class="col-md-4"><label class="form-label" for="gwa">GWA *</label><input type="number" step="0.01" class="form-control" id="gwa" name="gwa" required></div><div class="col-md-4"><label class="form-label" for="availment_count">Times Availed *</label><input type="number" min="0" class="form-control" id="availment_count" name="availment_count" value="0" required></div></div>
        </section>

        <section class="registration-form-section" data-step="4">
          <div class="registration-section-heading"><span>04</span><div><h2>Skill Profiling</h2><p>Select the skills you can practice or contribute during placement.</p></div></div>
          <div class="row g-2" id="skillList"></div><label class="form-label mt-4" for="skills_other">Other Skills</label><textarea class="form-control" id="skills_other" name="skills_other" rows="4" placeholder="Add other skills, training, or experience"></textarea>
        </section>

        <section class="registration-form-section" data-step="5">
          <div class="registration-section-heading"><span>05</span><div><h2>Review &amp; Submit</h2><p>Check your information before sending your application.</p></div></div>
          <div id="reviewContent" class="review-panel"></div><div class="staff-status-note"><strong>Status updates are staff-managed.</strong><br>Metro PESO staff will review your submission and update the applicant, application, and CBMS statuses after validation.</div><label class="form-check mt-4"><input class="form-check-input" type="checkbox" id="privacy" required><span class="form-check-label">I confirm that the information provided is accurate and I understand that Metro PESO will validate my eligibility and documentary requirements. *</span></label>
        </section>

        <div class="registration-actions"><button type="button" class="btn btn-outline-secondary" id="btnPrev">Back</button><div><button type="button" class="btn btn-brand" id="btnNext">Continue <i class="bi bi-arrow-right"></i></button><button type="submit" class="btn btn-brand" id="btnSubmit" hidden>Submit application <i class="bi bi-check2"></i></button></div></div>
        <div id="registrationMessage" class="alert mt-4" hidden></div>
      </form>
    </div>
  </div>
</section>

<style>
.registration-card{max-width:1000px;margin:auto;background:#fff;border:1px solid #d7e0ec;border-radius:12px;padding:1.5rem;box-shadow:0 16px 38px rgba(23,61,120,.1)}
.registration-stepper{display:flex;gap:.5rem;margin-bottom:1.5rem;background:#f3f6fb;border:1px solid #dce4ef;border-radius:10px;padding:.75rem}.registration-step{flex:1;border:0;background:transparent;color:#66748a;font-size:.78rem;font-weight:700;padding:.35rem;border-radius:7px}.registration-step span{display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;margin-right:.35rem;border-radius:50%;background:#dce4ef;color:#66748a}.registration-step.active,.registration-step.done{color:#173d78}.registration-step.active span,.registration-step.done span{background:#173d78;color:#fff}.registration-form-section{display:none}.registration-form-section.active{display:block}.registration-section-heading{display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid #e7e9ed}.registration-section-heading>span{display:flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:50%;background:#173d78;color:#fff;font-weight:800}.registration-section-heading h2{font-size:1.35rem;margin:0;color:#173d78}.registration-section-heading p{margin:.2rem 0 0;font-size:.82rem}.registration-form-section h3{font-size:.95rem;color:#2f64ad;border-bottom:1px solid #e7e9ed;padding-bottom:.35rem;margin:1.4rem 0 .8rem}.registration-form-section h3 small{font-size:.72rem;color:#66748a;font-weight:400}.registration-actions{display:flex;justify-content:space-between;margin-top:1.75rem}.review-panel{background:#f3f6fb;border:1px solid #dce4ef;border-radius:8px;padding:1rem}.review-panel dl{margin:0}.review-panel dt{color:#66748a;font-size:.78rem}.review-panel dd{font-weight:600;margin-bottom:.65rem}.staff-status-note{margin-top:1rem;padding:1rem;background:#fff5e8;border:1px solid #f0d39d;border-radius:8px;color:#725b35;font-size:.84rem}.staff-status-note strong{color:#8c5a0b}@media(max-width:575px){.registration-card{padding:1rem}.registration-step{font-size:0}.registration-step span{margin:0}.registration-section-heading h2{font-size:1.1rem}}
</style>

<style>
.registration-card{padding:2.25rem}
.registration-form-section .row>[class*="col-"]{position:relative}
.registration-form-section .row>[class*="col-"]>.form-label{position:absolute;top:-.55rem;left:1.35rem;z-index:2;margin:0;padding:0 .4rem;background:#fff;color:#5f718b;font-size:.72rem;font-weight:600;line-height:1.2}
.registration-form-section .form-control,.registration-form-section .form-select{min-height:52px;padding:1.05rem .85rem .45rem}
.registration-form-section textarea.form-control{min-height:120px;padding-top:1.05rem}
@media(max-width:575px){.registration-card{padding:1.35rem}.registration-form-section .row>[class*="col-"]>.form-label{left:1.15rem}}
.floating-field{position:relative}.floating-field>.form-label{position:absolute;top:50%;left:.85rem;z-index:2;margin:0;padding:0 .25rem;background:#fff;color:#6b7a90;font-size:.86rem;font-weight:500;line-height:1;pointer-events:none;transform:translateY(-50%);transition:all .16s ease}.floating-field:focus-within>.form-label,.floating-field.has-value>.form-label{top:0;left:.7rem;color:#2f64ad;font-size:.68rem;font-weight:700;transform:translateY(-50%)}.floating-field>.form-control,.floating-field>.form-select{padding-top:.85rem;padding-bottom:.65rem}.floating-field:focus-within>.form-control,.floating-field:focus-within>.form-select,.floating-field.has-value>.form-control,.floating-field.has-value>.form-select{padding-top:1.05rem}
.registration-form-section .row>[class*="col-"]>.form-label{position:static;display:block;margin-bottom:.5rem;padding:0;background:transparent;color:#5f718b;font-size:.8rem;line-height:1.2;transform:none}
.floating-field:has(#street_address){margin-top:1.45rem}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('registrationForm');
  const sections = [...document.querySelectorAll('.registration-form-section')];
  const steps = [...document.querySelectorAll('.registration-step')];
  const next = document.getElementById('btnNext');
  const prev = document.getElementById('btnPrev');
  const submit = document.getElementById('btnSubmit');
  const message = document.getElementById('registrationMessage');
  let current = 1;

  document.querySelectorAll('.registration-form-section .row>[class*="col-"]>.form-label').forEach(label => {
    const field = label.nextElementSibling;
    if (!field || field.tagName === 'SELECT' || (field.tagName === 'INPUT' && !['text','email','tel','number'].includes(field.type)) || !/^(INPUT|TEXTAREA)$/.test(field.tagName)) return;
    const wrapper = document.createElement('div');
    wrapper.className = 'floating-field';
    label.parentNode.insertBefore(wrapper, label);
    wrapper.append(label, field);
    const updateFloatingState = () => wrapper.classList.toggle('has-value', field.value !== '');
    field.addEventListener('input', updateFloatingState);
    field.addEventListener('change', updateFloatingState);
    updateFloatingState();
  });

  const barangays = ['Abella','Bagumbayan Norte','Bagumbayan Sur','Balatas','Calauag','Cararayan','Carolina','Concepcion Grande','Concepcion PequeÃ±a','Dayangdang','Del Rosario','Dinaga','Igualdad Interior','Lerma','Liboton','Mabolo','Pacol','Panicuason','PeÃ±afrancia','Sabang','San Felipe','San Francisco (Poblacion)','San Isidro','Santa Cruz','Tabuco','Tinago','Triangulo'];
  const countries = ['Saudi Arabia','United Arab Emirates','Singapore','Japan','United States','Canada'];
  const skills = ['Computer / MS Office','Data Encoding','Customer Service','Cashiering','Clerical / Filing','Graphic Design','Web / Programming','Social Media Management','Writing / Editing','Driving','Carpentry','Plumbing','Electrical','Welding','Cooking / Food Prep','Sewing / Tailoring','Teaching / Tutoring','Sales / Marketing'];
  const yearLevels = {'Junior High School':['Grade 7','Grade 8','Grade 9','Grade 10'],'Senior High School':['Grade 11','Grade 12'],'College':['1st Year','2nd Year','3rd Year','4th Year','5th Year']};

  barangays.forEach(value => document.getElementById('barangay').add(new Option(value, value)));
  countries.forEach(value => document.getElementById('ofw_country').add(new Option(value, value)));
  skills.forEach((value, index) => { document.getElementById('skillList').insertAdjacentHTML('beforeend', `<div class="col-6 col-md-4"><label class="form-check"><input class="form-check-input skill-check" type="checkbox" value="${value}" id="skill${index}"><span class="form-check-label">${value}</span></label></div>`); });

  function showStep(step) {
    current = step;
    sections.forEach(section => section.classList.toggle('active', Number(section.dataset.step) === step));
    steps.forEach(item => { const number = Number(item.dataset.step); item.classList.toggle('active', number === step); item.classList.toggle('done', number < step); });
    prev.textContent = step === 1 ? 'Clear' : 'Back';
    next.hidden = step === 5;
    submit.hidden = step !== 5;
    if (step === 5) buildReview();
    window.scrollTo({top: document.querySelector('.registration-card').offsetTop - 24, behavior:'smooth'});
  }

  function validateCurrent() {
    const section = sections[current - 1];
    let valid = true;
    section.querySelectorAll('input,select,textarea').forEach(field => { if (!field.checkValidity()) { field.classList.add('is-invalid'); valid = false; } else field.classList.remove('is-invalid'); });
    if (current === 4 && !document.querySelector('.skill-check:checked') && !document.getElementById('skills_other').value.trim()) { valid = false; alert('Please select at least one skill or describe your skills.'); }
    return valid;
  }

  const escapeHtml = value => String(value ?? '').replace(/[&<>"']/g, character => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[character]));

  function buildReview() {
    const value = id => document.getElementById(id).value || 'â€”';
    const fullName = [value('first_name'),value('middle_name'),value('last_name'),value('ext_name')].filter(item => item !== 'â€”').join(' ');
    const skillsValue = [...document.querySelectorAll('.skill-check:checked')].map(item => item.value).concat(document.getElementById('skills_other').value.trim() || []).join(', ') || 'â€”';
    document.getElementById('reviewContent').innerHTML = `<dl class="row"><dt class="col-sm-4">Full Name</dt><dd class="col-sm-8">${escapeHtml(fullName)}</dd><dt class="col-sm-4">Date of Birth</dt><dd class="col-sm-8">${escapeHtml(value('date_of_birth'))}</dd><dt class="col-sm-4">Contact</dt><dd class="col-sm-8">${escapeHtml(value('contact_number'))} / ${escapeHtml(value('email'))}</dd><dt class="col-sm-4">Address</dt><dd class="col-sm-8">${escapeHtml(value('street_address'))}, Brgy. ${escapeHtml(value('barangay'))}</dd><dt class="col-sm-4">School</dt><dd class="col-sm-8">${escapeHtml(value('school_name'))} (${escapeHtml(value('school_level'))} - ${escapeHtml(value('year_level'))})</dd><dt class="col-sm-4">Skills</dt><dd class="col-sm-8">${escapeHtml(skillsValue)}</dd></dl>`;
  }

  document.getElementById('school_level').addEventListener('change', event => { const level = event.target.value; const year = document.getElementById('year_level'); year.innerHTML = '<option value="">Select year level</option>'; (yearLevels[level] || []).forEach(value => year.add(new Option(value, value))); document.querySelectorAll('.college-only').forEach(item => { item.hidden = !(level === 'Senior High School' || level === 'College'); }); });
  form.querySelectorAll('input,select,textarea').forEach(field => field.addEventListener('input', () => field.classList.remove('is-invalid')));
  form.querySelectorAll('input[name="ofw_in_family"]').forEach(radio => radio.addEventListener('change', event => { document.getElementById('ofwCountryWrap').hidden = event.target.value !== 'Yes'; }));
  steps.forEach(item => item.addEventListener('click', () => { const target = Number(item.dataset.step); if (target < current || (target > current && validateCurrent())) showStep(target); }));
  next.addEventListener('click', () => { if (validateCurrent()) showStep(current + 1); });
  prev.addEventListener('click', () => {
    if (current !== 1) return showStep(current - 1);
    form.reset();
    document.getElementById('ofwCountryWrap').hidden = true;
    document.querySelectorAll('.college-only').forEach(item => { item.hidden = true; });
    document.getElementById('year_level').innerHTML = '<option value="">Select year level</option>';
  });

  form.addEventListener('submit', async event => {
    event.preventDefault();
    if (!validateCurrent() || !document.getElementById('privacy').checked) { if (!document.getElementById('privacy').checked) alert('Please confirm the privacy and accuracy statement.'); return; }
    const payload = new FormData(form);
    payload.append('func_name', 'SaveApplicant');
    payload.set('skills', [...document.querySelectorAll('.skill-check:checked')].map(item => item.value).concat(document.getElementById('skills_other').value.trim() || []).join(', '));
    payload.set('ofw_in_family', document.querySelector('input[name="ofw_in_family"]:checked').value);
    submit.disabled = true; submit.textContent = 'Submitting...';
    try {
      const response = await fetch('../connection/fetch.php', {method:'POST', body:payload});
      const result = await response.json();
      if (!response.ok || !result.success) throw new Error(result.error || 'Unable to submit application.');
      message.hidden = false; message.className = 'alert alert-success mt-4'; message.textContent = `${result.message} Metro PESO staff will review and update your statuses.`;
      form.reset();
      document.getElementById('ofwCountryWrap').hidden = true;
      document.querySelectorAll('.college-only').forEach(item => { item.hidden = true; });
      document.getElementById('year_level').innerHTML = '<option value="">Select year level</option>';
      showStep(1);
    } catch (error) { message.hidden = false; message.className = 'alert alert-danger mt-4'; message.textContent = error.message; }
    finally { submit.disabled = false; submit.innerHTML = 'Submit application <i class="bi bi-check2"></i>'; }
  });
});
</script>

<?php require '../../includes/site-footer.php'; ?>



