/* Unified staff workspace tools: applicant and office management. */
$(function () {
    if ($('#registrationForm').length) {$(document).ready(function () {

  // these lists fill the form choices
  // static lists used to fill the dropdowns / checkboxes
  var barangays = [
    "Abella", "Bagumbayan Norte", "Bagumbayan Sur", "Balatas", "Calauag", "Cararayan",
    "Carolina", "Concepcion Grande", "Concepcion PequeÃ±a", "Dayangdang", "Del Rosario",
    "Dinaga", "Igualdad Interior", "Lerma", "Liboton", "Mabolo", "Pacol", "Panicuason",
    "PeÃ±afrancia", "Sabang", "San Felipe", "San Francisco (Poblacion)", "San Isidro",
    "Santa Cruz", "Tabuco", "Tinago", "Triangulo"
  ];

  var countries = [
    "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda",
    "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas",
    "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize",
    "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil",
    "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia",
    "Cameroon", "Canada", "Central African Republic", "Chad", "Chile", "China",
    "Colombia", "Comoros", "Congo", "Costa Rica", "CÃ´te d'Ivoire", "Croatia",
    "Cuba", "Cyprus", "Czechia", "Democratic Republic of the Congo", "Denmark",
    "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador",
    "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Fiji",
    "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana",
    "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana",
    "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran",
    "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan",
    "Kazakhstan", "Kenya", "Kiribati", "Kuwait", "Kyrgyzstan", "Laos", "Latvia",
    "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania",
    "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali",
    "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico",
    "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco",
    "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands",
    "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "North Macedonia",
    "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama",
    "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal",
    "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis",
    "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino",
    "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles",
    "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands",
    "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka",
    "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan",
    "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago",
    "Tunisia", "TÃ¼rkiye", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine",
    "United Arab Emirates", "United Kingdom", "United States", "Uruguay",
    "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Yemen",
    "Zambia", "Zimbabwe"
  ];

  var skills = [
    "Computer / MS Office", "Data Encoding", "Customer Service", "Cashiering",
    "Clerical / Filing", "Graphic Design", "Web / Programming", "Social Media Management",
    "Writing / Editing", "Driving", "Carpentry", "Plumbing", "Electrical",
    "Welding", "Cooking / Food Prep", "Sewing / Tailoring", "Teaching / Tutoring", "Sales / Marketing"
  ];

  var yearLevels = {
    "Junior High School": ["Grade 7", "Grade 8", "Grade 9", "Grade 10"],
    "Senior High School": ["Grade 11", "Grade 12"],
    "College": ["1st Year", "2nd Year", "3rd Year", "4th Year", "5th Year"]
  };

  // this list keeps the form fields sent to the database together
  var formFields = [
    "applicant_id", "last_name", "first_name", "middle_name", "ext_name",
    "date_of_birth", "gender", "civil_status", "contact_number", "email",
    "barangay", "street_address",
    "father_name", "father_occupation", "father_contact",
    "mother_name", "mother_occupation", "mother_contact",
    "guardian_name", "guardian_occupation", "guardian_contact",
    "ofw_country", "family_income", "household_id",
    "school_level", "year_level", "school_name", "course", "specialization",
    "last_year_attended", "gwa", "availment_count",
    "applicant_status", "application_status", "cbms_status",
    "requirements_submitted"
  ];

  var totalSteps = 5, current = 1;
  var allApplicants = [];
  var applicantSortField = "last_name";
  var applicantSortDirection = "asc";

  // add the choices when the page is ready
  // fill the dropdowns and skill checkboxes
  $.each(barangays, function (_, b) { $("#barangay").append($("<option>", { value: b, text: b })); });
  $.each(countries, function (_, c) { $("#ofw_country").append($("<option>", { value: c, text: c })); });

  $("#skillList").empty();
  $.each(skills, function (i, s) {
    $("#skillList").append(
      '<div class="col-6 col-md-4"><div class="form-check">' +
      '<input class="form-check-input skill-check" type="checkbox" name="skills[]" id="skill' + i + '" value="' + s + '">' +
      '<label class="form-check-label" for="skill' + i + '">' + s + '</label></div></div>'
    );
  });

  // course / specialization are hidden until senior high or college is picked
  $(".college-only").hide();

  // crud: read saved records when the page opens
  LoadApplicants();

  // refresh the table when search or sorting changes
  $("#txtSearch").on("input", function () {
    renderApplicants();
  });

  $("#btnAddApplicant").on("click", function () {
    resetForm();
    $("html, body").animate({ scrollTop: 0 }, 200);
  });

  $("#sortField").on("change", function () {
    applicantSortField = $(this).val();
    renderApplicants();
  });

  $("#btnSortAsc").on("click", function () {
    applicantSortDirection = "asc";
    renderApplicants();
  });

  $("#btnSortDesc").on("click", function () {
    applicantSortDirection = "desc";
    renderApplicants();
  });


  // small helper functions used by the page

  // escapes text before it is placed inside html
  function esc(v) {
    return $('<div>').text(v == null ? '' : v).html();
  }

  function formatFullName(s) {
    var middleInitials = String(s.middle_name || '').trim().split(/\s+/)
      .filter(Boolean)
      .map(function (part) { return part.charAt(0).toUpperCase() + '.'; })
      .join('');
    var firstName = String(s.first_name || '').trim();
    var lastName = String(s.last_name || '').trim();
    var suffix = String(s.ext_name || '').trim();
    return lastName + ', ' + firstName +
      (middleInitials ? ' ' + middleInitials : '') +
      (suffix ? ' ' + suffix : '');
  }

  // computes age from the date of birth
  function calculateAge(dobString) {
    if (!dobString) return '';
    var birthDate = new Date(dobString);
    var today = new Date();
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }
    return age;
  }

  // clears the form and goes back to "add new" mode
  function resetForm() {
    $("#registrationForm")[0].reset();
    $("#applicant_id").val('');
    $(".form-section").removeClass("was-validated");
    $("#year_level").empty();
    $(".college-only").hide();
    $("#ofwCountryWrap").hide();
    $("#btnSubmit").text('Save Applicant');
    showStep(1);
  }


  // read records from the database and show them in the table
  function LoadApplicants() {
    $.post('../../../database/fetch.php', { func_name: 'GetApplicants' }, function (list) {
      allApplicants = Array.isArray(list) ? list : [];
      renderApplicants();
    }, 'json').fail(function (xhr) {
      console.error(xhr.responseText);
      $('#tableStudents tbody').html('<tr><td colspan="10" class="text-center text-danger">Could not load records from the database</td></tr>');
    });
  }

  function renderApplicants() {
    // filter first, then sort the records that will be displayed
    const $tbody = $('#tableStudents tbody').empty();
    const query = $.trim($('#txtSearch').val() || '').toLowerCase();
    var list = allApplicants.filter(function (s) {
      if (!query) return true;
      var fullName = [
        s.first_name, s.middle_name, s.last_name, s.ext_name,
        formatFullName(s)
      ].filter(Boolean).join(' ').toLowerCase();
      return fullName.includes(query) ||
        String(s.applicant_id || '').toLowerCase().includes(query);
    });

    if (applicantSortDirection && applicantSortField) {
      list.sort(function (a, b) {
        var valueA = String(a[applicantSortField] || '').toLowerCase();
        var valueB = String(b[applicantSortField] || '').toLowerCase();
        var comparison = valueA.localeCompare(valueB, undefined, { numeric: applicantSortField === 'applicant_id' });
        if (comparison === 0) {
          comparison = String(a.last_name || '').localeCompare(String(b.last_name || ''));
        }
        return applicantSortDirection === 'asc' ? comparison : -comparison;
      });
    }

    if (!list || list.length === 0) {
      // colspan is 10 to match the table layout
      $tbody.append('<tr><td colspan="10" class="text-center text-muted">No records found</td></tr>');
      return;
    }

    list.forEach(function (s) {
      const fullName = formatFullName(s);
      const contactEmail = esc(s.contact_number) + '<br><small class="text-muted">' + esc(s.email) + '</small>';

      // choose a color for the applicant status
      let badgeClass = 'bg-secondary';
      if (s.applicant_status === 'Approved') badgeClass = 'bg-success';
      else if (s.applicant_status === 'Pending') badgeClass = 'bg-warning text-dark';
      else if (s.applicant_status === 'Rejected') badgeClass = 'bg-danger';
      const applicantStatus = '<span class="badge ' + badgeClass + '">' + esc(s.applicant_status || 'Pending') + '</span>';

      // choose a color for the application status
      let appBadgeClass = 'bg-secondary';
      if (s.application_status === 'Accepted') appBadgeClass = 'bg-success';
      else if (s.application_status === 'Under Review') appBadgeClass = 'bg-info text-dark';
      else if (s.application_status === 'Waitlisted') appBadgeClass = 'bg-warning text-dark';
      else if (s.application_status === 'Disqualified') appBadgeClass = 'bg-danger';
      const applicationStatus = '<span class="badge ' + appBadgeClass + '">' + esc(s.application_status || 'Under Review') + '</span>';

      // choose a color for the cbms status
      let cbmsBadgeClass = 'bg-secondary';
      if (s.cbms_status === 'Verified') cbmsBadgeClass = 'bg-success';
      else if (s.cbms_status === 'Pending') cbmsBadgeClass = 'bg-warning text-dark';
      else if (s.cbms_status === 'Unverified') cbmsBadgeClass = 'bg-danger';
      const cbmsStatus = '<span class="badge ' + cbmsBadgeClass + '">' + esc(s.cbms_status || 'Pending') + '</span>';

      const requirementsCount = Math.max(0, Math.min(9, Number(s.requirements_submitted) || 0));
      let requirementsBadgeClass = 'border-danger text-danger';
      if (requirementsCount === 9) requirementsBadgeClass = 'border-success text-success';
      else if (requirementsCount > 0) requirementsBadgeClass = 'border-warning text-warning';
      const requirementsStatus = '<span class="badge bg-transparent border ' + requirementsBadgeClass + '">' +
        esc(requirementsCount) + ' submitted</span>';

      // use icons for the row actions
      const $actions = $('<td class="text-center">')
        .append($('<button type="button" class="btn btn-outline-info btn-sm me-1 btnView" aria-label="View applicant" title="View applicant"><i class="bi bi-eye" aria-hidden="true"></i><span class="visually-hidden">View</span></button>'))
        .append($('<button type="button" class="btn btn-outline-primary btn-sm me-1 btnEditStudent" aria-label="Edit applicant" title="Edit applicant"><i class="bi bi-pencil" aria-hidden="true"></i><span class="visually-hidden">Edit</span></button>'))
        .append($('<button type="button" class="btn btn-outline-danger btn-sm btnDeleteStudent" aria-label="Delete applicant" title="Delete applicant"><i class="bi bi-trash" aria-hidden="true"></i><span class="visually-hidden">Delete</span></button>'));

      $('<tr>')
        .data('student', s)
        .append($('<td>').addClass('fw-bold').text(s.applicant_id))
        .append($('<td>').text(fullName))
        .append($('<td>').html(contactEmail))
        .append($('<td>').text(s.barangay || ''))
        .append($('<td>').text(s.school_level || ''))
        .append($('<td>').html(applicantStatus))
        .append($('<td>').html(cbmsStatus))
        .append($('<td>').html(requirementsStatus))
        .append($('<td>').html(applicationStatus))
        .append($actions)
        .appendTo($tbody);
    });
  }

  // show the selected applicant in the details modal
  $(document).on('click', '.btnView', function () {
    const s = $(this).closest('tr').data('student');
    const age = calculateAge(s.date_of_birth);
    const fullName = formatFullName(s);
    
    const requirementsCount = Math.max(0, Math.min(9, Number(s.requirements_submitted) || 0));
    const requirementsClass = requirementsCount === 9 ? 'success' : (requirementsCount === 0 ? 'danger' : 'warning');
    const applicantStatusClass = s.applicant_status === 'Approved' ? 'success' :
      (s.applicant_status === 'Rejected' ? 'danger' : (s.applicant_status === 'Under Review' ? 'info' : 'warning'));
    const applicationStatusClass = s.application_status === 'Accepted' ? 'success' :
      (s.application_status === 'Disqualified' ? 'danger' : (s.application_status === 'Waitlisted' ? 'warning' : 'info'));
    const cbmsStatusClass = s.cbms_status === 'Verified' ? 'success' :
      (s.cbms_status === 'Unverified' ? 'danger' : 'warning');

    const html = `
      <div class="details-section">
        <div class="details-section-title"><i class="bi bi-person-vcard me-1" aria-hidden="true"></i>Personal &amp; Family Information</div>
        <div class="details-grid">
          <div class="detail-item"><span class="detail-label">Name</span><span class="detail-value">${esc(fullName)}</span></div>
          <div class="detail-item"><span class="detail-label">Date of Birth / Age</span><span class="detail-value">${esc(s.date_of_birth)} <span class="text-muted fw-normal">(${age} yrs)</span></span></div>
          <div class="detail-item"><span class="detail-label">Contact / Email</span><span class="detail-value">${esc(s.contact_number)}<br><span class="text-muted fw-normal">${esc(s.email)}</span></span></div>
          <div class="detail-item"><span class="detail-label">Address</span><span class="detail-value">${esc(s.street_address)}, Brgy. ${esc(s.barangay)}</span></div>
          <div class="detail-item"><span class="detail-label">Income / Household ID</span><span class="detail-value">${esc(s.family_income)} <span class="text-muted fw-normal">(${esc(s.household_id)})</span></span></div>
          <div class="detail-item"><span class="detail-label">OFW in Family</span><span class="detail-value">${s.ofw_in_family === 'Yes' ? 'Yes (' + esc(s.ofw_country) + ')' : 'No'}</span></div>
        </div>
      </div>
      <div class="details-section">
        <div class="details-section-title"><i class="bi bi-mortarboard me-1" aria-hidden="true"></i>Education &amp; Skills</div>
        <div class="details-grid">
          <div class="detail-item"><span class="detail-label">School</span><span class="detail-value">${esc(s.school_name)}</span></div>
          <div class="detail-item"><span class="detail-label">Level</span><span class="detail-value">${esc(s.school_level)} - ${esc(s.year_level)}</span></div>
          <div class="detail-item"><span class="detail-label">Course</span><span class="detail-value">${esc(s.course || 'N/A')}</span></div>
          <div class="detail-item"><span class="detail-label">GWA / Availed</span><span class="detail-value">${esc(s.gwa || 'N/A')} <span class="text-muted fw-normal">(${esc(s.availment_count)} times)</span></span></div>
          <div class="detail-item full-width"><span class="detail-label">Skills</span><span class="detail-value">${esc(s.skills || 'None')}</span></div>
        </div>
      </div>
      <div class="details-section">
        <div class="details-section-title"><i class="bi bi-clipboard-check me-1" aria-hidden="true"></i>Application Statuses</div>
        <div class="status-grid">
          <div class="status-card"><span class="status-label">Applicant</span><span class="status-pill ${applicantStatusClass}">${esc(s.applicant_status || 'Under Review')}</span></div>
          <div class="status-card"><span class="status-label">Application</span><span class="status-pill ${applicationStatusClass}">${esc(s.application_status || 'Under Review')}</span></div>
          <div class="status-card"><span class="status-label">CBMS</span><span class="status-pill ${cbmsStatusClass}">${esc(s.cbms_status || 'Pending')}</span></div>
          <div class="status-card"><span class="status-label">Requirements</span><span class="status-pill ${requirementsClass}">${esc(requirementsCount)} submitted</span></div>
        </div>
      </div>
    `;
    $('#viewModalBody').html(html);
    new bootstrap.Modal(document.getElementById('viewModal')).show();
  });


  // copy the selected row into the form for editing
  $(document).on('click', '.btnEditStudent', function () {
    const s = $(this).closest('tr').data('student');

    // plain text / select fields share the same id as the column name
    $.each(formFields, function (_, f) {
      if (f === 'school_level' || f === 'year_level' || f === 'availment_count') return;
      $('#' + f).val(s[f] == null ? '' : s[f]);
    });

    // ofw radio + country dropdown
    if (s.ofw_in_family === 'Yes') {
      $('#ofwYes').prop('checked', true).trigger('change');
      $('#ofw_country').val(s.ofw_country || '');
    } else {
      $('#ofwNo').prop('checked', true).trigger('change');
    }

    // school level must be set first because it rebuilds the year level options
    $('#school_level').val(s.school_level || '').trigger('change');
    $('#year_level').val(s.year_level || '');
    $('#availment_count').val(s.availment_count || 0);

    // tick the skills that match the checkboxes, the rest go to "other skills"
    $('.skill-check').prop('checked', false);
    $('#skills_other').val('');

    if (s.skills) {
      var otherSkills = [];
      s.skills.split(',').forEach(function (item) {
        var sk = $.trim(item);
        if (sk === '') return;
        var $checkbox = $('.skill-check').filter(function () { return this.value === sk; });
        if ($checkbox.length) {
          $checkbox.prop('checked', true);
        } else {
          otherSkills.push(sk);
        }
      });
      $('#skills_other').val(otherSkills.join(', '));
    }

    $(".form-section").removeClass("was-validated");
    showStep(1);
    $('#btnSubmit').text('Update Applicant');
    $('html, body').animate({ scrollTop: 0 }, 200);
  });


  // crud: ask first, then delete the selected record
  $(document).on('click', '.btnDeleteStudent', function () {
    const s = $(this).closest('tr').data('student');
    if (!confirm('Delete applicant ' + s.last_name + ', ' + s.first_name + ' (' + s.applicant_id + ')?\nThis cannot be undone.')) return;

    $.post('../../../database/fetch.php', { func_name: 'DeleteApplicant', applicant_id: s.applicant_id }, function (res) {
      alert(res.message);
      if (res.success) {
        // if the deleted record is the one being edited, clear the form
        if ($('#applicant_id').val() === s.applicant_id) resetForm();
        LoadApplicants();
      }
    }, 'json').fail(function (xhr) {
      var msg = xhr.responseText;
      try { msg = JSON.parse(xhr.responseText).error || msg; } catch (e) {}
      alert('Delete failed: ' + msg);
    });
  });


  // change parts of the form based on the selected values

  // year level options depend on the school level
  $("#school_level").change(function () {
    var lvl = $(this).val(), $yl = $("#year_level");
    $yl.empty().append('<option value="" selected disabled>Select</option>');
    $.each(yearLevels[lvl] || [], function (_, y) { $yl.append($("<option>", { value: y, text: y })); });

    var needsCourse = (lvl === "Senior High School" || lvl === "College");
    $(".college-only").toggle(needsCourse);
  });

  // show the country dropdown only when there is an ofw in the family
  $("input[name='ofw_in_family']").change(function () {
    $("#ofwCountryWrap").toggle($(this).val() === "Yes");
  });


  // check each step before moving forward
  function validateStep(step) {
    var $section = $(".form-section[data-step='" + step + "']");
    var valid = true;

    // fields that are allowed to stay empty
    var optionalIds = [
      "middle_name", "ext_name", "guardian_name", "guardian_occupation",
      "guardian_contact", "father_contact", "mother_contact", "ofw_country",
      "course", "specialization", "skills_other", "applicant_id"
    ];

    $section.find("input, select, textarea").not(".skill-check").each(function () {
      var fieldId = $(this).attr("id");

      // skip fields that are hidden on purpose
      if (this.disabled || $(this).closest("[style*='display: none']").length) {
        return;
      }

      if (optionalIds.indexOf(fieldId) === -1) {
        $(this).prop("required", true);
      }

      if (!this.checkValidity() || (optionalIds.indexOf(fieldId) === -1 && $.trim($(this).val()) === "")) {
        valid = false;
      }
    });

    // step 4 needs at least one skill
    if (step === 4) {
      var hasSkill = $(".skill-check:checked").length > 0 || $.trim($("#skills_other").val()) !== "";
      if (!hasSkill) {
        valid = false;
        alert("Please select at least one skill or describe your skills.");
      }
    }

    $section.addClass("was-validated");

    // scroll to the first invalid field
    if (!valid) {
      var $first = $section.find(":invalid").not(".skill-check").filter(":visible").first();
      if ($first.length) {
        $("html, body").animate({ scrollTop: $first.offset().top - 120 }, 250);
        $first.trigger("focus");
      }
    }

    return valid;
  }


  // control which form step is visible
  function showStep(n) {
    current = n;
    $(".form-section").removeClass("active").filter("[data-step='" + n + "']").addClass("active");
    $(".step-item").each(function () {
      var s = $(this).data("step");
      $(this).toggleClass("active", s === n).toggleClass("done", s < n);
    });
    
    var isEditMode = $("#applicant_id").val() !== '';
    
    $("#btnPrev").text("Cancel");
    $("#btnNext").toggle(n < totalSteps);
    $("#btnSubmit").toggle(n === totalSteps);
    
    // show quick save button only in edit mode on steps 1 to 4
    $("#btnQuickSave").toggle(isEditMode && n < totalSteps);
    
    if (n === totalSteps) buildReview();
  }

  $("#btnNext").click(function () {
    if (validateStep(current)) {
      showStep(current + 1);
    }
  });

  // cancel clears the form and returns to add mode
  $("#btnPrev").click(function () {
    resetForm();
  });

  $(".step-item").click(function () {
    var targetStep = $(this).data("step");
    var isEditMode = $("#applicant_id").val() !== '';
    
    // if editing, allow jumping anywhere. if adding, follow steps linearly.
    if (targetStep < current || isEditMode) {
      showStep(targetStep);
    } else if (targetStep > current) {
      if (validateStep(current)) {
        showStep(targetStep);
      }
    }
  });

  // show a short summary before saving
  function buildReview() {
    var fullName = [$("#first_name").val(), $("#middle_name").val(), $("#last_name").val()].filter(Boolean).join(" ");
    var html = '<dl class="row mb-0">' +
      '<dt class="col-sm-4">Full Name</dt><dd class="col-sm-8">' + esc(fullName) + '</dd>' +
      '<dt class="col-sm-4">Email / Contact</dt><dd class="col-sm-8">' + esc($("#email").val()) + ' / ' + esc($("#contact_number").val()) + '</dd>' +
      '<dt class="col-sm-4">School / Course</dt><dd class="col-sm-8">' + esc($("#school_name").val()) + ' (' + esc($("#course").val() || 'N/A') + ')</dd>' +
      '</dl>';
    $("#reviewContent").html(html);
  }

  // crud: update only the current section while editing
  $("#btnQuickSave").click(function () {
    if (!validateStep(current)) return;
    var applicantId = $("#applicant_id").val();
    if (!applicantId) return;
  
    var payload = { func_name: 'UpdateApplicantFields', applicant_id: applicantId };
    
    // grab only the inputs currently visible on the active step
    $(".form-section.active").find("input, select, textarea").each(function () {
      var name = $(this).attr("name");
      if (name && name !== "skills[]" && name !== "ofw_in_family") {
        payload[name] = $(this).val();
      }
    });
  
    // handle radio/checkbox data based on current step
    if (current === 2) {
      payload.ofw_in_family = $("input[name='ofw_in_family']:checked").val() || 'No';
    }
    if (current === 4) {
      var skillList = $(".skill-check:checked").map(function () { return this.value; }).get();
      var other = $.trim($("#skills_other").val());
      if (other) skillList.push(other);
      payload.skills = skillList.join(", ");
    }
  
    var $btn = $(this);
    $btn.text("Saving...").prop("disabled", true);
  
    $.post('../../../database/fetch.php', payload, function (res) {
      alert("Section updated successfully!");
      LoadApplicants(); // refresh table silently in the background
    }, 'json').fail(function (xhr) {
      alert("Error saving section.");
    }).always(function () {
      $btn.text("Save This Section").prop("disabled", false);
    });
  });


  // crud: create a new applicant or update an existing applicant
  $("#registrationForm").submit(function (e) {
    e.preventDefault();

    // validate every step before saving
    for (var s = 1; s <= totalSteps; s++) {
      if (!validateStep(s)) {
        showStep(s);
        return;
      }
    }

    var applicantId = $("#applicant_id").val();
    var fullName = [$("#first_name").val(), $("#middle_name").val(), $("#last_name").val(), $("#ext_name").val()]
      .filter(Boolean).join(" ");

    var confirmMessage = (applicantId ? "Confirm update for applicant details?" : "Confirm adding this new applicant?") + "\n\n" +
      "ID: " + (applicantId || "NEW") + "\n" +
      "Name: " + fullName + "\n" +
      "Applicant Status: " + $("#applicant_status").val() + "\n" +
      "Application Status: " + $("#application_status").val() + "\n" +
      "CBMS Status: " + $("#cbms_status").val();

    if (!confirm(confirmMessage)) return;

    // build the data to send
    var payload = { func_name: 'SaveApplicant' };
    $.each(formFields, function (_, f) {
      payload[f] = $('#' + f).val() || '';
    });
    payload.ofw_in_family = $("input[name='ofw_in_family']:checked").val() || 'No';

    // skills = checked boxes + other skills, joined by comma
    var skillList = $(".skill-check:checked").map(function () { return this.value; }).get();
    var other = $.trim($("#skills_other").val());
    if (other) skillList.push(other);
    payload.skills = skillList.join(", ");

    $("#btnSubmit").prop("disabled", true);

    $.post('../../../database/fetch.php', payload, null, 'json')
      .done(function (res) {
        alert(res.message || "Saved successfully!");
        resetForm();
        LoadApplicants(); // reload so the table shows what is really in the database
      })
      .fail(function (xhr) {
        var msg = xhr.responseText;
        try { msg = JSON.parse(xhr.responseText).error || msg; } catch (err) {}
        alert('Save failed (' + xhr.status + '): ' + msg);
      })
      .always(function () {
        $("#btnSubmit").prop("disabled", false);
      });
  });

});

    }

    if ($('#officeForm').length) {$(function () {
    const $form = $('#officeForm');
    const $other = $('#skillOther');
    const $input = $('#otherSkill');
    const $skills = $('input[name="requiredSkills"]');
    let offices = [];
    let editingId = null; let token = ''; let busy = false;

    function updateOtherSkill() {
        const checked = $other.is(':checked');
        $('#otherSkillField').prop('hidden', !checked);
        $other.attr('aria-expanded', String(checked));
        $input.prop('disabled', !checked).prop('required', checked);
        if (!checked) $input.val('').get(0).setCustomValidity('');
    }
    function validateSkills() {
        const selected = $skills.is(':checked');
        $skills.first().prop('required', !selected).get(0).setCustomValidity(
            selected ? '' : 'Please select at least one required skill.'
        );
    }
    $other.on('change', function () {
        updateOtherSkill();
        if (this.checked) $input.trigger('focus');
    });
    $input.on('input', function () {
        this.setCustomValidity(this.value.trim() ? '' : 'Please specify the other required skill.');
    });
    $skills.on('change', validateSkills);
    $form.on('reset', function () {
        setTimeout(function () { updateOtherSkill(); validateSkills(); }, 0);
    });
    updateOtherSkill();
    validateSkills();

    function message(text, error) {
        $('#officeMessage').text(text).toggleClass('text-danger', !!error)
            .toggleClass('text-success', !error);
        $('#formMessage').text(text).prop('hidden', !text).toggleClass('alert-danger', !!error).toggleClass('alert-success', !error);
    }
    function cell($row, value) {
        $('<td>').text(value == null ? '' : String(value)).appendTo($row);
    }
    function filteredOffices(records, query, key, direction) {
        const fields = ['officeId','officeName','department','requiredSkills','availableSlots','assignedOfficeHead','physicallyDemanding','officeDescription'];
        if (!fields.includes(key)) key = 'officeId';
        const text = value => Array.isArray(value) ? value.join(', ') : String(value == null ? '' : value);
        const normalize = value => text(value).normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLocaleLowerCase().replace(/[^a-z0-9]+/g, ' ').trim();
        const terms = normalize(query).split(/\s+/).filter(Boolean);
        const sign = direction === 'desc' ? -1 : 1;
        return records.filter(office => terms.every(term => normalize([office.officeId, office.officeName, office.assignedOfficeHead].join(' ')).includes(term)))
            .sort((a, b) => {
                const result = key === 'availableSlots' ? Number(a[key]) - Number(b[key]) : text(a[key]).localeCompare(text(b[key]), undefined, {numeric:true, sensitivity:'base'});
                return sign * result || text(a.officeId).localeCompare(text(b.officeId), undefined, {numeric:true});
            });
    }
    function displayOffices() {
        const $body = $('#officeTableBody').empty();
        const visible = filteredOffices(offices, $('#officeSearch').val() || '', $('#officeSort').val(), $('#officeSortDirection').val());
        $('#officeResultCount').text('Showing ' + visible.length + ' of ' + offices.length + ' offices');
        if (!visible.length) {
            $('<tr>').append($('<td colspan="10">').text(offices.length ? 'No offices match your search.' : 'No office records found.')).appendTo($body);
            return;
        }
        visible.forEach(function (office, index) {
            const $row = $('<tr>');
            cell($row, index + 1);
            cell($row, office.officeId);
            cell($row, office.officeName);
            cell($row, office.department);
            cell($row, (office.requiredSkills || []).join(', '));
            cell($row, office.availableSlots);
            cell($row, office.assignedOfficeHead);
            cell($row, office.physicallyDemanding);
            cell($row, office.officeDescription);
            const $actions = $('<td>').addClass('text-nowrap');
            $('<button type="button">').addClass('btn btn-sm btn-outline-primary me-1')
                .text('Edit').on('click', function () { editOffice(office.officeId); }).appendTo($actions);
            $('<button type="button">').addClass('btn btn-sm btn-outline-danger')
                .text('Delete').on('click', function () { deleteOffice(office); }).appendTo($actions);
            $row.append($actions).appendTo($body);
        });
    }
    function loadOffices() {
        $.getJSON('../../../database/fetch.php', { action: 'list' }).done(function (response) {
            if (!response.success) { message(response.message || 'Cannot load offices.', true); return; }
            offices = response.offices; token = response.token;
            displayOffices();
        }).fail(function () { message('Cannot connect to fetch.php. Run this project using a PHP server.', true); });
    }
    function resetEdit() {
        editingId = null;
        $form[0].reset();
        $('#officeId').val('');
        $('#submitOfficeBtn').text('+ Add Office').prop('disabled', false);
        message('');
    }
    function editOffice(id) {
        const office = offices.find(function (item) { return item.officeId === id; });
        if (!office) return;
        editingId = id;
        $('#officeId').val(office.officeId);
        $('#officeName').val(office.officeName);
        $('#officeUrl').val(office.officeUrl || '');
        $('#officePhoto').val('');
        if (!$('#Department option').toArray().some(o => o.value === office.department)) $('#Department').append($('<option>').val(office.department).text(office.department)); $('#Department').val(office.department);
        $('#officeDescription').val(office.officeDescription);
        $('#availableSlots').val(office.availableSlots);
        $('#assignedOfficeHead').val(office.assignedOfficeHead);
        $('input[name="physicallyDemanding"]').prop('checked', false)
            .filter(function () { return this.value === office.physicallyDemanding; }).prop('checked', true);
        $skills.prop('checked', false);
        const skills = office.requiredSkills || [];
        $skills.each(function () { this.checked = skills.includes(this.value); });
        const otherSkills = skills.filter(function (s) {
            return !$skills.filter(function () { return this.value === s && s !== 'Other'; }).length;
        });
        if (otherSkills.length) { $other.prop('checked', true); $input.val(otherSkills.join(', ')); }
        updateOtherSkill();
        validateSkills();
        $('#submitOfficeBtn').text('Update Office').prop('disabled', false);
        message('Editing office: ' + id);
        $form[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
    }


    async function request(data) {
        const isFormData = data instanceof FormData;
        const options = {method:'POST', headers:{'X-CSRF-Token':token}, body:isFormData ? data : JSON.stringify(data)};
        if (!isFormData) options.headers['Content-Type'] = 'application/json';
        const response = await fetch('../../../database/fetch.php', options);
        const result = await response.json();
        if (!response.ok || !result.success) throw new Error(result.message || 'Request failed.');
        return result;
    }
    const deleteElement = document.getElementById('deleteOfficeModal');
    const deleteModal = new bootstrap.Modal(deleteElement);
    let pendingDelete = null;
    let deleting = false;
    function deleteOffice(office) {
        if (busy) return;
        pendingDelete = office;
        $('#deleteOfficeName').text(office.officeName);
        $('#deleteOfficeError').text('').prop('hidden', true);
        deleteModal.show();
    }
    deleteElement.addEventListener('hide.bs.modal', function (event) {
        if (deleting) event.preventDefault();
    });
    deleteElement.addEventListener('hidden.bs.modal', function () { pendingDelete = null; });
    $('#confirmDeleteOfficeBtn').on('click', async function () {
        if (busy || !pendingDelete) return;
        const office = pendingDelete;
        busy = true; deleting = true;
        $('#deleteOfficeModal button').prop('disabled', true);
        $(this).text('Deleting...');
        $('#deleteOfficeError').prop('hidden', true);
        try {
            const result = await request({action: 'delete', officeId: office.officeId});
            if (editingId === office.officeId) resetEdit();
            message(result.message);
            deleting = false;
            deleteModal.hide();
            loadOffices();
        } catch (error) {
            $('#deleteOfficeError').text(error.message).prop('hidden', false);
        } finally {
            busy = false; deleting = false;
            $('#deleteOfficeModal button').prop('disabled', false);
            $('#confirmDeleteOfficeBtn').text('Delete Office');
        }
    });
    $form.on('submit', async function(event) {
        event.preventDefault(); validateSkills();
        if(busy || !this.reportValidity()) return;
        const skills=$skills.filter(':checked').map(function(){return this.value;}).get().filter(s=>s!=='Other');
        if($other.is(':checked')) skills.push($input.val().trim());
        busy=true; $('#submitOfficeBtn').prop('disabled',true);
        try {
            const payload = new FormData();
            payload.set('office_action', editingId ? 'update' : 'create');
            if (editingId) payload.set('officeId', editingId);
            payload.set('officeName', $('#officeName').val().trim());
            payload.set('department', $('#Department').val());
            payload.set('requiredSkills', JSON.stringify(skills));
            payload.set('availableSlots', $('#availableSlots').val());
            payload.set('assignedOfficeHead', $('#assignedOfficeHead').val().trim());
            payload.set('physicallyDemanding', $('input[name="physicallyDemanding"]:checked').val());
            payload.set('officeDescription', $('#officeDescription').val().trim());
            payload.set('officeUrl', $('#officeUrl').val().trim());
            const photo = $('#officePhoto')[0].files[0];
            if (photo) payload.set('officePhoto', photo);
            const r=await request(payload);
            const wasUpdate = editingId !== null;
            resetEdit(); message(wasUpdate ? 'Office has been updated successfully.' : r.message); loadOffices();
            if (wasUpdate) bootstrap.Modal.getOrCreateInstance(document.getElementById('updateSuccessModal')).show();
        } catch(e) { message(e.message,true); } finally {busy=false; $('#submitOfficeBtn').prop('disabled',false);}
    });
    $('#cancelOfficeBtn').on('click',function(){if(!busy)resetEdit();});
    $('#officeSearch').on('input search change', displayOffices);
    $('#officeSort, #officeSortDirection').on('change', displayOffices);
    $('#clearOfficeFilters').on('click', function () { $('#officeSearch').val(''); $('#officeSort').val('officeId'); $('#officeSortDirection').val('asc'); displayOffices(); });
    loadOffices();
});








    }
});
