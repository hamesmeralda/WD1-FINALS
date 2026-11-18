<?php
$pageTitle = 'Deployment | MetroSEED-Naga';
$activePage = 'deployment';
$siteRoot = $siteRoot ?? '../../';
require '../../includes/site-header.php';

$offices = [
  ['General Services Office', 'GSO', 'https://www2.naga.gov.ph/office-service/general-services-office/', 'Supports city operations through facilities, records, supplies, logistics, and front-line administrative services.', 'organization · filing · customer service'],
  ['City Engineer’s Office', 'CEO', 'https://www2.naga.gov.ph/office-service/city-engineers-office/', 'Works with public infrastructure, construction projects, inspections, plans, and technical city services.', 'technical writing · data organization · field awareness'],
  ['City Health Office', 'CHO', 'https://www2.naga.gov.ph/office-service/city-health-office/', 'Helps deliver public-health programs, information campaigns, records support, and community health services.', 'careful documentation · empathy · confidentiality'],
  ['Our Lady of Lourdes Infirmary', 'OLL Infirmary', 'https://www2.naga.gov.ph/office-service/our-lady-of-lourdes-infirmary/', 'A health-service setting where support work may include patient assistance, records, reception, and coordination.', 'professionalism · compassion · attention to detail'],
  ['City Agriculturist’s Office', 'CAgO', 'https://www2.naga.gov.ph/office-service/city-agriculturists-office/', 'Promotes agriculture, food production, livelihood support, and assistance for local farmers and communities.', 'community engagement · communication · basic data handling'],
  ['Bicol Science and Technology Centrum', 'BSTC', 'https://www2.naga.gov.ph/office-service/bicol-science-and-technology-centrum/', 'Encourages science, technology, innovation, exhibitions, learning activities, and public engagement.', 'research · presentation · digital literacy'],
  ['Persons with Disability Affairs Office', 'PDAO', 'https://www2.naga.gov.ph/office-service/persons-with-disability-affairs-office/', 'Coordinates programs and assistance that promote accessibility, inclusion, and the rights of persons with disabilities.', 'inclusive communication · patience · records management'],
  ['Resource Center for the Blind', 'RCB', 'https://www2.naga.gov.ph/office-service/resources-for-the-blind/', 'Provides support, resources, and accessible services for blind and visually impaired community members.', 'accessible communication · service orientation · careful listening'],
  ['Jesse Robredo Center for Good Governance', 'JRCGG', 'https://www2.naga.gov.ph/office-service/jesse-robredo-center-for-good-governance/', 'Supports learning, civic engagement, good governance initiatives, and public information activities.', 'research · writing · event support'],
  ['City Vice-Mayor’s Office', 'OCVM', 'https://www2.naga.gov.ph/office-service/city-vice-mayors-office/', 'Assists with legislative, constituent, correspondence, and public-service coordination under the Vice Mayor’s Office.', 'professional correspondence · organization · courtesy'],
  ['Metro Naga Development Council', 'MNDC', 'https://www2.naga.gov.ph/office-service/metro-naga-development-council-2/', 'Coordinates development concerns and cooperation among cities, municipalities, agencies, and partners in Metro Naga.', 'coordination · minutes taking · research'],
  ['Naga City Cooperatives Development Office', 'NCCDO', 'https://www2.naga.gov.ph/office-service/naga-city-cooperatives-development-office/', 'Strengthens cooperatives through education, registration support, records, and community enterprise assistance.', 'basic finance · documentation · facilitation'],
  ['Housing and Settlements Development Office', 'HSDO / UPAO', 'https://www2.naga.gov.ph/office-service/housing-and-settlements-development-office-upao/', 'Works on housing, settlement planning, relocation, and community coordination for safe and inclusive neighborhoods.', 'mapping awareness · interviewing · data organization'],
  ['Water Services Division', 'WSD', 'https://www2.naga.gov.ph/office-service/water-services-division/', 'Supports water-service coordination, customer concerns, records, and public information related to water access.', 'customer service · documentation · problem solving'],
  ['City College of Naga', 'CCN', 'https://www2.naga.gov.ph/office-service/city-college-of-naga-2/', 'An education setting where beneficiaries may support student services, offices, events, and learning activities.', 'academic support · communication · office software'],
  ['City Budget Office', 'CBO', 'https://www2.naga.gov.ph/office-service/city-budget-office/', 'Supports budget preparation, records, reports, and the responsible allocation of public funds.', 'numeracy · spreadsheets · confidentiality'],
  ['Gender and Development Office', 'GAD', 'https://www2.naga.gov.ph/office-service/gender-and-development-office/', 'Promotes gender-responsive programs, inclusion, awareness, and equitable public services.', 'advocacy · respectful communication · event support'],
  ['Building Maintenance and Energy Efficiency Office', 'BMEECO', 'https://www2.naga.gov.ph/office-service/building-and-maintenance-office/', 'Supports city facilities, building upkeep, energy conservation, and maintenance coordination.', 'workplace safety · inventory · practical problem solving'],
  ['Market Enterprise and Promotions Office', 'MEPO', 'https://www2.naga.gov.ph/office-service/market-enterprise-and-promotions-office/', 'Helps manage market operations, vendor coordination, promotions, and public-facing enterprise services.', 'customer service · coordination · basic records'],
  ['Naga City Youth Development Office', 'NCYDO', 'https://www2.naga.gov.ph/office-service/naga-city-youth-development-office-ncydo/', 'Creates youth-centered programs, events, consultations, and opportunities for civic participation.', 'event coordination · social media · teamwork'],
  ['City Treasurer’s Office', 'CTO', 'https://www2.naga.gov.ph/office-service/city-treasurers-office/', 'Handles public financial transactions, receipts, taxpayer assistance, and accountable records.', 'numeracy · accuracy · confidentiality'],
  ['Public Safety Office', 'PSO', 'https://www2.naga.gov.ph/office-service/public-safety-office/', 'Supports public safety coordination, information, incident documentation, and community preparedness.', 'alertness · calm communication · reporting'],
  ['i-Governance Office', 'i-Gov', 'https://www2.naga.gov.ph/office-service/i-governance-office/', 'Uses technology and digital systems to improve public services, information access, and government processes.', 'digital literacy · troubleshooting · data privacy'],
  ['Naga City Dangerous Drugs Board', 'NCDDB', 'https://www2.naga.gov.ph/office-service/naga-city-dangerous-drugs-board/', 'Supports prevention, education, documentation, and community programs promoting a safe and healthy city.', 'responsible communication · documentation · teamwork'],
  ['City Parks and Recreational Facilities Management Office', 'CPRFMO', 'https://www2.naga.gov.ph/office-service/city-parks-recreational-facilities-management-office/', 'Maintains and promotes parks, recreation spaces, public activities, and community facilities.', 'event support · facilities awareness · teamwork'],
  ['City Population and Nutrition Office', 'CPNO', 'https://www2.naga.gov.ph/office-service/city-population-and-nutrition-office/', 'Supports population, family, nutrition, and community information programs.', 'interviewing · data gathering · empathy'],
  ['Naga City Solo Parents Office', 'NCSPO-CSWDO', 'https://www2.naga.gov.ph/office-service/naga-city-solo-parents-office-cswdo/', 'Connects solo parents to support, services, referrals, and information through community assistance.', 'active listening · records · service orientation'],
  ['City Human Resource Management Office', 'CHRMO', 'https://www2.naga.gov.ph/office-service/city-human-resource-management-office/', 'Supports personnel records, employee services, training coordination, and workplace administration.', 'confidentiality · filing · communication'],
  ['Naga City District Abattoir', 'Abattoir', 'https://www2.naga.gov.ph/office-service/naga-city-abattoir/', 'Supports regulated food-service operations, documentation, sanitation, and facility coordination.', 'safety awareness · compliance · careful records'],
  ['Solid Waste Management Office and Motorpool', 'SWMO', 'https://www2.naga.gov.ph/office-service/solid-waste-management-office/', 'Coordinates waste-management services, environmental programs, vehicles, routes, and community information.', 'environmental awareness · scheduling · teamwork'],
  ['City Legal Office', 'CLO', 'https://www2.naga.gov.ph/office-service/city-legal-office/', 'Provides legal support to the city through records, research, correspondence, and document organization.', 'reading · writing · confidentiality'],
  ['Investment and Tourism Promotions Office', 'ITPO', 'https://www2.naga.gov.ph/office-service/investment-and-trade-promotion-office/', 'Promotes Naga as a place to visit, invest, do business, and participate in local economic activity.', 'writing · visual communication · customer service'],
  ['Information and Technology Office', 'ITO', 'https://www2.naga.gov.ph/office-service/information-and-technology-office/', 'Supports city information systems, technology services, digital records, and user assistance.', 'computer literacy · troubleshooting · data privacy'],
  ['City Civil Registry Office', 'CCRO', 'https://www2.naga.gov.ph/office-service/city-civil-registry-office/', 'Maintains vital records and assists residents with civil-registration services and document requests.', 'accuracy · confidentiality · customer service'],
  ['Sangguniang Panlungsod Office', 'SPO', 'https://www2.naga.gov.ph/office-service/sangguniang-panlungsod-office/', 'Supports legislative records, committee work, sessions, resolutions, and public documents.', 'writing · filing · attention to detail'],
  ['Association of Barangay Councils', 'ABC', 'https://www2.naga.gov.ph/office-service/association-of-barangay-councils/', 'Coordinates barangay concerns, communication, meetings, and local governance support.', 'coordination · public communication · organization'],
  ['City Planning and Development Office', 'CPDO', 'https://www2.naga.gov.ph/office-service/city-planning-and-development-office/', 'Supports planning, development data, maps, reports, and long-term city improvement initiatives.', 'research · spreadsheets · visual organization'],
  ['City Procurement Office', 'CPO', 'https://www2.naga.gov.ph/office-service/city-procurement-office/', 'Supports transparent purchasing, bidding records, supplier coordination, and document tracking.', 'accuracy · compliance · organization'],
  ['Office for Senior Citizens Affairs', 'OSCA', 'https://www2.naga.gov.ph/office-service/office-for-senior-citizens-affairs/', 'Assists senior citizens with registration, information, referrals, and access to public services.', 'patience · respectful communication · records'],
  ['Metro Naga Public Employment Service Office', 'Metro PESO', 'https://www2.naga.gov.ph/office-service/metro-naga-public-employment-service-office/', 'Connects job seekers and employers while implementing employment programs, career services, and YEP coordination.', 'interviewing · communication · case organization'],
  ['Bicol Central Station', 'BCS', 'https://www2.naga.gov.ph/office-service/bicol-central-station/', 'A public-facing transport setting where support work can involve information, coordination, and service assistance.', 'customer service · alertness · teamwork'],
  ['Naga City Migrant Resource Center', 'NCMRC', 'https://www2.naga.gov.ph/office-service/naga-city-migrant-resource-center-ncmrc/', 'Provides information, referrals, and assistance to migrants and their families.', 'active listening · documentation · empathy'],
  ['Lingkod Barangay Office', 'LBO', 'https://www2.naga.gov.ph/office-service/lingkod-barangay-office/', 'Supports barangay-level services and community coordination close to residents.', 'community engagement · organization · communication'],
  ['Department of Culture, Heritage, and the Arts', 'DepCHArt', 'https://www2.naga.gov.ph/office-service/city-events-protocol-public-information-office/', 'Supports cultural programs, heritage activities, public events, and creative city communications.', 'creative work · event support · writing'],
  ['City Mayor’s Office', 'CMO', 'https://www2.naga.gov.ph/office-service/city-mayors-office/', 'Supports executive-office coordination, correspondence, public assistance, and city-level programs.', 'professionalism · organization · confidentiality'],
  ['City Disaster Risk Reduction Management Office', 'CDRRMO', 'https://www2.naga.gov.ph/office-service/city-disaster-risk-reduction-management-office/', 'Supports preparedness, response information, risk-reduction education, and community resilience work.', 'calm communication · reporting · teamwork'],
  ['City Environment and Natural Resources Office', 'CENRO', 'https://www2.naga.gov.ph/office-service/city-environment-and-natural-resources-office/', 'Works on environmental protection, conservation, information campaigns, and community programs.', 'environmental awareness · research · field coordination'],
  ['City Veterinary Office', 'CVO', 'https://www2.naga.gov.ph/office-service/city-veterinary-office/', 'Supports animal health, welfare, vaccination, public information, and community veterinary services.', 'care · documentation · public communication'],
  ['Naga City General Hospital', 'NCGH', 'https://www2.naga.gov.ph/office-service/naga-city-hospital/', 'A hospital setting where support assignments may include records, reception, patient guidance, and service coordination.', 'confidentiality · empathy · accuracy'],
  ['City Accountant’s Office', 'CAcO', 'https://www2.naga.gov.ph/office-service/city-accountants-office/', 'Supports accounting records, reports, documentation, and public financial accountability.', 'numeracy · spreadsheets · precision'],
  ['Education, Scholarship and Sports Office', 'ESSO', 'https://www2.naga.gov.ph/office-service/education-scholarship-and-sports-office-naga-city-school-board/', 'Coordinates education assistance, scholarship records, sports programs, and student-centered services.', 'records management · communication · event support'],
  ['Internal Audit Service', 'IAS', 'https://www2.naga.gov.ph/office-service/internal-audit-service/', 'Supports review, compliance, documentation, and systems that help public offices remain accountable.', 'critical thinking · confidentiality · detail'],
  ['City Social Welfare Development Office', 'CSWDO', 'https://www2.naga.gov.ph/office-service/city-social-welfare-development-office/', 'Provides social protection, referrals, community assistance, and support for vulnerable residents.', 'empathy · interviewing · case documentation'],
  ['City Assessor’s Office', 'CAsO', 'https://www2.naga.gov.ph/office-service/city-assessors-office/', 'Maintains property assessment records and assists with public requests related to real property information.', 'accuracy · data entry · customer service'],
  ['Raul S. Roco Library', 'RSRL', 'https://www2.naga.gov.ph/office-service/raul-s-roco-library/', 'Supports readers, learning resources, library organization, research assistance, and community learning activities.', 'organization · research · service orientation'],
  ['City Educare Service', 'Educare', 'https://www2.naga.gov.ph/office-service/city-educare-service/', 'Supports child-focused care, learning activities, family assistance, and community-based social services.', 'patience · creativity · safeguarding awareness']
];

function cleanOfficeText(string $text): string
{
  return $text;
}
?>
<section class="page-hero">
<div class="container">
<span class="eyebrow">DEPLOYMENT</span>
<h1>See where your work can take you.</h1>
<p>Placements are matched with available slots, funding, and the needs of participating offices and employers across Naga City.</p>
</div>
</section>
<nav class="deployment-nav" aria-label="Deployment page sections">
<div class="container">
<div class="deployment-nav-grid">
<a href="#workplaces">
<span class="deployment-nav-arrow">&larr;</span>
<span>
<strong>Workplaces</strong>
<small>Where you may be assigned.</small>
</span>
</a>
<a href="#office-directory">
<span class="deployment-nav-arrow">&larr;</span>
<span>
<strong>Office directory</strong>
<small>Explore public offices.</small>
</span>
</a>
<a href="#private-sector">
<span class="deployment-nav-arrow">&larr;</span>
<span>
<strong>Private sector</strong>
<small>Partner workplace opportunities.</small>
</span>
</a>
<a href="#responsibilities">
<span class="deployment-nav-arrow">&larr;</span>
<span>
<strong>Responsibilities</strong>
<small>What deployment expects.</small>
</span>
</a>
</div>
</div>
</nav>
<section id="workplaces" class="section-space">
<div class="container">
<div class="row g-5 align-items-center">
<div class="col-lg-7">
<span class="eyebrow">POSSIBLE WORKPLACES</span>
<h2>Learn in places that serve the community.</h2>
<p>YEP assignments can happen in city offices, community facilities, schools, public-service centers, health settings, and registered private establishments. Each placement is a chance to understand how a real organization works.</p>
<div class="location-list">
<div>
<i class="bi bi-buildings">
</i>
<span>
<strong>Public service offices</strong>
<small>Administrative support, records, public assistance, and community programs.</small>
</span>
</div>
<div>
<i class="bi bi-shop">
</i>
<span>
<strong>Private sector partners</strong>
<small>Work experience with registered establishments under a formal partnership agreement.</small>
</span>
</div>
<div>
<i class="bi bi-people">
</i>
<span>
<strong>Service-oriented teams</strong>
<small>Assignments where professionalism, courtesy, and careful coordination matter.</small>
</span>
</div>
</div>
</div>
<div class="col-lg-5">
<div class="detail-card workplace-note">
<span class="eyebrow">YOUR MATCH</span>
<h3>Find a placement where your strengths can grow.</h3>
<p>Use the office cards below to explore the kinds of work, service environments, and skills you may encounter during deployment.</p>
<a class="text-link" href="#office-directory">Explore office cards <i class="bi bi-arrow-down">
</i>
</a>
</div>
</div>
</div>
</div>
</section>
<section id="office-directory" class="soft-section">
<div class="container">
<div class="section-heading">
<span class="eyebrow">OFFICE DIRECTORY</span>
<h2>Find a workplace that fits your strengths.</h2>
<p>Each card shows the kind of environment and skills a beneficiary may practice. Actual deployment depends on approved slots and program needs.</p>
</div>
<div class="office-card-grid">
<?php foreach ($offices as [$name, $abbr, $url, $description, $skills]): ?>
<article class="office-card">
<div class="office-photo-placeholder">
<i class="bi bi-image">
</i>
<span>
<?= htmlspecialchars(cleanOfficeText($abbr)) ?> workplace photo</span>
<small>Approved office photo placeholder</small>
</div>
<div class="office-card-top">
<span class="office-icon">
<i class="bi bi-building">
</i>
</span>
<span class="office-code">
<?= htmlspecialchars(cleanOfficeText($abbr)) ?>
</span>
</div>
<h3>
<?= htmlspecialchars(cleanOfficeText($name)) ?>
</h3>
<p>
<?= htmlspecialchars(cleanOfficeText($description)) ?>
</p>
<div class="skills">
<strong>Skills to practice</strong>
<span>
<?= htmlspecialchars(cleanOfficeText($skills)) ?>
</span>
</div>
<a href="<?= htmlspecialchars($url) ?>" target="_blank" rel="noopener" class="text-link">View office information <i class="bi bi-arrow-up-right">
</i>
</a>
</article>
<?php endforeach; ?>
</div>
</div>
</section>
<section id="private-sector" class="section-space">
<div class="container">
<div class="section-heading">
<span class="eyebrow">PRIVATE SECTOR PARTNERSHIPS</span>
<h2>Work beyond the city office.</h2>
<p>Private establishments may participate as YEP partners through a formal agreement with the City Government. These placements can introduce beneficiaries to customer service, operations, administration, retail, hospitality, technology, and other real workplace environments.</p>
</div>
<div class="row g-4">
<div class="col-md-4">
<div class="benefit-card">
<span class="card-icon">
<i class="bi bi-person-badge">
</i>
</span>
<h3>Customer-facing work</h3>
<p>Practice courtesy, clear communication, product or service knowledge, and responsible handling of customer concerns.</p>
<span class="tile-tag">Communication · patience · service</span>
</div>
</div>
<div class="col-md-4">
<div class="benefit-card">
<span class="card-icon">
<i class="bi bi-kanban">
</i>
</span>
<h3>Operations and administration</h3>
<p>Build experience in scheduling, inventory, records, data entry, coordination, and daily task management.</p>
<span class="tile-tag">Organization · accuracy · teamwork</span>
</div>
</div>
<div class="col-md-4">
<div class="benefit-card">
<span class="card-icon">
<i class="bi bi-lightbulb">
</i>
</span>
<h3>Growing local businesses</h3>
<p>Support marketing, digital tools, basic finance, hospitality, food service, creative work, or other partner-defined assignments.</p>
<span class="tile-tag">Adaptability · initiative · learning</span>
</div>
</div>
</div>
<div class="callout mt-5">
<div>
<span class="eyebrow">FOR PARTNER EMPLOYERS</span>
<h2>Offer young people a structured first work experience.</h2>
<p class="mb-0">Registered partners are expected to provide safe working conditions, honor the agreed wage-sharing arrangement, maintain records, and protect beneficiary information.</p>
</div>
<a href="<?= $siteRoot ?>pages/public/process.php" class="btn btn-brand">Review the guidelines</a>
</div>
</div>
</section>
<section id="responsibilities" class="soft-section">
<div class="container">
<div class="row g-4">
<div class="col-lg-7">
<span class="eyebrow">YOUR RESPONSIBILITIES</span>
<h2>Show up ready to contribute.</h2>
<div class="responsibility-list">
<div>
<span>01</span>
<p>Follow your approved schedule and complete the required hours. First-semester placements may require four hours per day for 40 working days.</p>
</div>
<div>
<span>02</span>
<p>Observe workplace rules, safety standards, confidentiality, and respectful conduct.</p>
</div>
<div>
<span>03</span>
<p>Keep accurate daily time records and submit reports or documents requested by your supervisor.</p>
</div>
<div>
<span>04</span>
<p>Complete assigned tasks, communicate early, and ask for guidance when needed.</p>
</div>
</div>
</div>
<div class="col-lg-5">
<div class="detail-card">
<span class="eyebrow">IMPORTANT</span>
<h3>Attendance is part of the program.</h3>
<p>Absences, late reporting, dropping subjects, or failure to follow the approved work schedule may affect continued participation or result in removal.</p>
<a href="<?= $siteRoot ?>pages/public/process.php" class="text-link">Review the full process <i class="bi bi-arrow-right">
</i>
</a>
</div>
</div>
</div>
</div>
</section>
<section class="soft-section compensation-section">
<div class="container">
<div class="section-heading">
<span class="eyebrow">COMPENSATION</span>
<h2>How support is funded.</h2>
<p>All compensation follows the applicable rules and approved arrangements for the program component.</p>
</div>
<div class="row g-4">
<div class="col-md-4">
<div class="program-tile">
<span class="tile-number">SPES</span>
<h3>Shared support</h3>
<p>60% may be paid by the city government or private employer and 40% reimbursed by DOLE, based on the applicable rate.</p>
</div>
</div>
<div class="col-md-4">
<div class="program-tile">
<span class="tile-number">SEFE</span>
<h3>City-funded</h3>
<p>Qualified youth not accommodated by SPES may receive support fully funded by the City Government of Naga.</p>
</div>
</div>
<div class="col-md-4">
<div class="program-tile">
<span class="tile-number">PARTNER</span>
<h3>Private sector</h3>
<p>Under a partnership, 60% of the salary is paid by the private employer and 40% is shouldered by the city government.</p>
</div>
</div>
</div>
</div>
</section>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const grid = document.querySelector('.office-card-grid');
  if (!grid) return;

  const cards = Array.from(grid.querySelectorAll('.office-card'));
  if (cards.length <= 3) return;

  const hiddenCards = cards.slice(3);
  hiddenCards.forEach(card => { card.hidden = true; });

  const actions = document.createElement('div');
  actions.className = 'office-directory-actions';
  const button = document.createElement('button');
  button.type = 'button';
  button.className = 'btn btn-soft';
  button.textContent = 'View more offices';
  button.addEventListener('click', () => {
    const isExpanded = hiddenCards[0].hidden;
    hiddenCards.forEach(card => { card.hidden = !isExpanded; });
    button.textContent = isExpanded ? 'View fewer offices' : 'View more offices';
  });
  actions.appendChild(button);
  grid.parentElement.appendChild(actions);
});
</script>

<?php require '../../includes/site-footer.php'; ?>







