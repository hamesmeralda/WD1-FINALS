
CREATE DATABASE IF NOT EXISTS `metroseed`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `metroseed`;

CREATE TABLE IF NOT EXISTS `applicants` (
    `applicant_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `last_name` VARCHAR(100) NOT NULL,
    `first_name` VARCHAR(100) NOT NULL,
    `middle_name` VARCHAR(100) NULL,
    `ext_name` VARCHAR(30) NULL,
    `date_of_birth` DATE NOT NULL,
    `gender` VARCHAR(20) NOT NULL,
    `civil_status` VARCHAR(30) NOT NULL,
    `contact_number` VARCHAR(30) NOT NULL,
    `email` VARCHAR(190) NOT NULL,
    `barangay` VARCHAR(120) NOT NULL,
    `street_address` VARCHAR(255) NOT NULL,
    `father_name` VARCHAR(190) NULL,
    `father_occupation` VARCHAR(190) NULL,
    `father_contact` VARCHAR(30) NULL,
    `mother_name` VARCHAR(190) NULL,
    `mother_occupation` VARCHAR(190) NULL,
    `mother_contact` VARCHAR(30) NULL,
    `guardian_name` VARCHAR(190) NULL,
    `guardian_occupation` VARCHAR(190) NULL,
    `guardian_contact` VARCHAR(30) NULL,
    `ofw_in_family` VARCHAR(3) NOT NULL DEFAULT 'No',
    `ofw_country` VARCHAR(100) NULL,
    `office_id` VARCHAR(20) NULL,
    `family_income` VARCHAR(50) NOT NULL,
    `household_id` VARCHAR(100) NOT NULL,
    `school_level` VARCHAR(50) NOT NULL,
    `year_level` VARCHAR(50) NOT NULL,
    `school_name` VARCHAR(190) NOT NULL,
    `course` VARCHAR(190) NULL,
    `specialization` VARCHAR(190) NULL,
    `last_year_attended` SMALLINT UNSIGNED NULL,
    `gwa` DECIMAL(5,2) NULL,
    `availment_count` TINYINT UNSIGNED NOT NULL DEFAULT 0,
    `applicant_status` VARCHAR(30) NOT NULL DEFAULT 'Under Review',
    `application_status` VARCHAR(30) NOT NULL DEFAULT 'Under Review',
    `cbms_status` VARCHAR(30) NOT NULL DEFAULT 'Pending',
    `requirements_submitted` TINYINT UNSIGNED NOT NULL DEFAULT 0,
    `requirements_status` VARCHAR(20) NOT NULL DEFAULT 'Incomplete',
    `skills` TEXT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`applicant_id`),
    KEY `idx_applicants_last_name` (`last_name`),
    KEY `idx_applicants_status` (`applicant_status`),
    KEY `idx_applicants_application_status` (`application_status`),
    KEY `idx_applicants_office_id` (`office_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `offices` (
    `officeId` VARCHAR(20) NOT NULL,
    `officeName` VARCHAR(150) NOT NULL,
    `department` VARCHAR(150) NOT NULL,
    `requiredSkills` LONGTEXT NOT NULL,
    `availableSlots` INT UNSIGNED NOT NULL DEFAULT 0,
    `assignedOfficeHead` VARCHAR(150) NOT NULL,
    `physicallyDemanding` VARCHAR(3) NOT NULL DEFAULT 'No',
    `officeDescription` TEXT NULL,
    `officeUrl` VARCHAR(500) NULL,
    `officePhoto` VARCHAR(255) NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`officeId`),
    KEY `idx_offices_name` (`officeName`),
    KEY `idx_offices_department` (`department`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Upgrade an existing offices table before the seed insert runs.
SET @office_url_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'offices' AND COLUMN_NAME = 'officeUrl');
SET @office_url_sql = IF(@office_url_exists = 0, 'ALTER TABLE `offices` ADD COLUMN `officeUrl` VARCHAR(500) NULL AFTER `officeDescription`', 'SELECT 1');
PREPARE office_url_statement FROM @office_url_sql;
EXECUTE office_url_statement;
DEALLOCATE PREPARE office_url_statement;

SET @office_photo_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'offices' AND COLUMN_NAME = 'officePhoto');
SET @office_photo_sql = IF(@office_photo_exists = 0, 'ALTER TABLE `offices` ADD COLUMN `officePhoto` VARCHAR(255) NULL AFTER `officeUrl`', 'SELECT 1');
PREPARE office_photo_statement FROM @office_photo_sql;
EXECUTE office_photo_statement;
DEALLOCATE PREPARE office_photo_statement;

-- Seed data: one row for each original deployment office card.
INSERT INTO `offices` (`officeId`, `officeName`, `department`, `requiredSkills`, `availableSlots`, `assignedOfficeHead`, `physicallyDemanding`, `officeDescription`, `officeUrl`, `officePhoto`) VALUES
('GSO', 'General Services Office', 'Metro PESO', '["organization","filing","customer service"]', 0, 'To be assigned', 'No', 'Supports city operations through facilities, records, supplies, logistics, and front-line administrative services.', 'https://www2.naga.gov.ph/office-service/general-services-office/', NULL),
('CEO', 'City Engineer’s Office', 'Metro PESO', '["technical writing","data organization","field awareness"]', 0, 'To be assigned', 'No', 'Works with public infrastructure, construction projects, inspections, plans, and technical city services.', 'https://www2.naga.gov.ph/office-service/city-engineers-office/', NULL),
('CHO', 'City Health Office', 'Metro PESO', '["careful documentation","empathy","confidentiality"]', 0, 'To be assigned', 'No', 'Helps deliver public-health programs, information campaigns, records support, and community health services.', 'https://www2.naga.gov.ph/office-service/city-health-office/', NULL),
('OLL Infirmary', 'Our Lady of Lourdes Infirmary', 'Metro PESO', '["professionalism","compassion","attention to detail"]', 0, 'To be assigned', 'No', 'A health-service setting where support work may include patient assistance, records, reception, and coordination.', 'https://www2.naga.gov.ph/office-service/our-lady-of-lourdes-infirmary/', NULL),
('CAgO', 'City Agriculturist’s Office', 'Metro PESO', '["community engagement","communication","basic data handling"]', 0, 'To be assigned', 'No', 'Promotes agriculture, food production, livelihood support, and assistance for local farmers and communities.', 'https://www2.naga.gov.ph/office-service/city-agriculturists-office/', NULL),
('BSTC', 'Bicol Science and Technology Centrum', 'Metro PESO', '["research","presentation","digital literacy"]', 0, 'To be assigned', 'No', 'Encourages science, technology, innovation, exhibitions, learning activities, and public engagement.', 'https://www2.naga.gov.ph/office-service/bicol-science-and-technology-centrum/', NULL),
('PDAO', 'Persons with Disability Affairs Office', 'Metro PESO', '["inclusive communication","patience","records management"]', 0, 'To be assigned', 'No', 'Coordinates programs and assistance that promote accessibility, inclusion, and the rights of persons with disabilities.', 'https://www2.naga.gov.ph/office-service/persons-with-disability-affairs-office/', NULL),
('RCB', 'Resource Center for the Blind', 'Metro PESO', '["accessible communication","service orientation","careful listening"]', 0, 'To be assigned', 'No', 'Provides support, resources, and accessible services for blind and visually impaired community members.', 'https://www2.naga.gov.ph/office-service/resources-for-the-blind/', NULL),
('JRCGG', 'Jesse Robredo Center for Good Governance', 'Metro PESO', '["research","writing","event support"]', 0, 'To be assigned', 'No', 'Supports learning, civic engagement, good governance initiatives, and public information activities.', 'https://www2.naga.gov.ph/office-service/jesse-robredo-center-for-good-governance/', NULL),
('OCVM', 'City Vice-Mayor’s Office', 'Metro PESO', '["professional correspondence","organization","courtesy"]', 0, 'To be assigned', 'No', 'Assists with legislative, constituent, correspondence, and public-service coordination under the Vice Mayor’s Office.', 'https://www2.naga.gov.ph/office-service/city-vice-mayors-office/', NULL),
('MNDC', 'Metro Naga Development Council', 'Metro PESO', '["coordination","minutes taking","research"]', 0, 'To be assigned', 'No', 'Coordinates development concerns and cooperation among cities, municipalities, agencies, and partners in Metro Naga.', 'https://www2.naga.gov.ph/office-service/metro-naga-development-council-2/', NULL),
('NCCDO', 'Naga City Cooperatives Development Office', 'Metro PESO', '["basic finance","documentation","facilitation"]', 0, 'To be assigned', 'No', 'Strengthens cooperatives through education, registration support, records, and community enterprise assistance.', 'https://www2.naga.gov.ph/office-service/naga-city-cooperatives-development-office/', NULL),
('HSDO / UPAO', 'Housing and Settlements Development Office', 'Metro PESO', '["mapping awareness","interviewing","data organization"]', 0, 'To be assigned', 'No', 'Works on housing, settlement planning, relocation, and community coordination for safe and inclusive neighborhoods.', 'https://www2.naga.gov.ph/office-service/housing-and-settlements-development-office-upao/', NULL),
('WSD', 'Water Services Division', 'Metro PESO', '["customer service","documentation","problem solving"]', 0, 'To be assigned', 'No', 'Supports water-service coordination, customer concerns, records, and public information related to water access.', 'https://www2.naga.gov.ph/office-service/water-services-division/', NULL),
('CCN', 'City College of Naga', 'Metro PESO', '["academic support","communication","office software"]', 0, 'To be assigned', 'No', 'An education setting where beneficiaries may support student services, offices, events, and learning activities.', 'https://www2.naga.gov.ph/office-service/city-college-of-naga-2/', NULL),
('CBO', 'City Budget Office', 'Metro PESO', '["numeracy","spreadsheets","confidentiality"]', 0, 'To be assigned', 'No', 'Supports budget preparation, records, reports, and the responsible allocation of public funds.', 'https://www2.naga.gov.ph/office-service/city-budget-office/', NULL),
('GAD', 'Gender and Development Office', 'Metro PESO', '["advocacy","respectful communication","event support"]', 0, 'To be assigned', 'No', 'Promotes gender-responsive programs, inclusion, awareness, and equitable public services.', 'https://www2.naga.gov.ph/office-service/gender-and-development-office/', NULL),
('BMEECO', 'Building Maintenance and Energy Efficiency Office', 'Metro PESO', '["workplace safety","inventory","practical problem solving"]', 0, 'To be assigned', 'No', 'Supports city facilities, building upkeep, energy conservation, and maintenance coordination.', 'https://www2.naga.gov.ph/office-service/building-and-maintenance-office/', NULL),
('MEPO', 'Market Enterprise and Promotions Office', 'Metro PESO', '["customer service","coordination","basic records"]', 0, 'To be assigned', 'No', 'Helps manage market operations, vendor coordination, promotions, and public-facing enterprise services.', 'https://www2.naga.gov.ph/office-service/market-enterprise-and-promotions-office/', NULL),
('NCYDO', 'Naga City Youth Development Office', 'Metro PESO', '["event coordination","social media","teamwork"]', 0, 'To be assigned', 'No', 'Creates youth-centered programs, events, consultations, and opportunities for civic participation.', 'https://www2.naga.gov.ph/office-service/naga-city-youth-development-office-ncydo/', NULL),
('CTO', 'City Treasurer’s Office', 'Metro PESO', '["numeracy","accuracy","confidentiality"]', 0, 'To be assigned', 'No', 'Handles public financial transactions, receipts, taxpayer assistance, and accountable records.', 'https://www2.naga.gov.ph/office-service/city-treasurers-office/', NULL),
('PSO', 'Public Safety Office', 'Metro PESO', '["alertness","calm communication","reporting"]', 0, 'To be assigned', 'No', 'Supports public safety coordination, information, incident documentation, and community preparedness.', 'https://www2.naga.gov.ph/office-service/public-safety-office/', NULL),
('i-Gov', 'i-Governance Office', 'Metro PESO', '["digital literacy","troubleshooting","data privacy"]', 0, 'To be assigned', 'No', 'Uses technology and digital systems to improve public services, information access, and government processes.', 'https://www2.naga.gov.ph/office-service/i-governance-office/', NULL),
('NCDDB', 'Naga City Dangerous Drugs Board', 'Metro PESO', '["responsible communication","documentation","teamwork"]', 0, 'To be assigned', 'No', 'Supports prevention, education, documentation, and community programs promoting a safe and healthy city.', 'https://www2.naga.gov.ph/office-service/naga-city-dangerous-drugs-board/', NULL),
('CPRFMO', 'City Parks and Recreational Facilities Management Office', 'Metro PESO', '["event support","facilities awareness","teamwork"]', 0, 'To be assigned', 'No', 'Maintains and promotes parks, recreation spaces, public activities, and community facilities.', 'https://www2.naga.gov.ph/office-service/city-parks-recreational-facilities-management-office/', NULL),
('CPNO', 'City Population and Nutrition Office', 'Metro PESO', '["interviewing","data gathering","empathy"]', 0, 'To be assigned', 'No', 'Supports population, family, nutrition, and community information programs.', 'https://www2.naga.gov.ph/office-service/city-population-and-nutrition-office/', NULL),
('NCSPO-CSWDO', 'Naga City Solo Parents Office', 'Metro PESO', '["active listening","records","service orientation"]', 0, 'To be assigned', 'No', 'Connects solo parents to support, services, referrals, and information through community assistance.', 'https://www2.naga.gov.ph/office-service/naga-city-solo-parents-office-cswdo/', NULL),
('CHRMO', 'City Human Resource Management Office', 'Metro PESO', '["confidentiality","filing","communication"]', 0, 'To be assigned', 'No', 'Supports personnel records, employee services, training coordination, and workplace administration.', 'https://www2.naga.gov.ph/office-service/city-human-resource-management-office/', NULL),
('Abattoir', 'Naga City District Abattoir', 'Metro PESO', '["safety awareness","compliance","careful records"]', 0, 'To be assigned', 'No', 'Supports regulated food-service operations, documentation, sanitation, and facility coordination.', 'https://www2.naga.gov.ph/office-service/naga-city-abattoir/', NULL),
('SWMO', 'Solid Waste Management Office and Motorpool', 'Metro PESO', '["environmental awareness","scheduling","teamwork"]', 0, 'To be assigned', 'No', 'Coordinates waste-management services, environmental programs, vehicles, routes, and community information.', 'https://www2.naga.gov.ph/office-service/solid-waste-management-office/', NULL),
('CLO', 'City Legal Office', 'Metro PESO', '["reading","writing","confidentiality"]', 0, 'To be assigned', 'No', 'Provides legal support to the city through records, research, correspondence, and document organization.', 'https://www2.naga.gov.ph/office-service/city-legal-office/', NULL),
('ITPO', 'Investment and Tourism Promotions Office', 'Metro PESO', '["writing","visual communication","customer service"]', 0, 'To be assigned', 'No', 'Promotes Naga as a place to visit, invest, do business, and participate in local economic activity.', 'https://www2.naga.gov.ph/office-service/investment-and-trade-promotion-office/', NULL),
('ITO', 'Information and Technology Office', 'Metro PESO', '["computer literacy","troubleshooting","data privacy"]', 0, 'To be assigned', 'No', 'Supports city information systems, technology services, digital records, and user assistance.', 'https://www2.naga.gov.ph/office-service/information-and-technology-office/', NULL),
('CCRO', 'City Civil Registry Office', 'Metro PESO', '["accuracy","confidentiality","customer service"]', 0, 'To be assigned', 'No', 'Maintains vital records and assists residents with civil-registration services and document requests.', 'https://www2.naga.gov.ph/office-service/city-civil-registry-office/', NULL),
('SPO', 'Sangguniang Panlungsod Office', 'Metro PESO', '["writing","filing","attention to detail"]', 0, 'To be assigned', 'No', 'Supports legislative records, committee work, sessions, resolutions, and public documents.', 'https://www2.naga.gov.ph/office-service/sangguniang-panlungsod-office/', NULL),
('ABC', 'Association of Barangay Councils', 'Metro PESO', '["coordination","public communication","organization"]', 0, 'To be assigned', 'No', 'Coordinates barangay concerns, communication, meetings, and local governance support.', 'https://www2.naga.gov.ph/office-service/association-of-barangay-councils/', NULL),
('CPDO', 'City Planning and Development Office', 'Metro PESO', '["research","spreadsheets","visual organization"]', 0, 'To be assigned', 'No', 'Supports planning, development data, maps, reports, and long-term city improvement initiatives.', 'https://www2.naga.gov.ph/office-service/city-planning-and-development-office/', NULL),
('CPO', 'City Procurement Office', 'Metro PESO', '["accuracy","compliance","organization"]', 0, 'To be assigned', 'No', 'Supports transparent purchasing, bidding records, supplier coordination, and document tracking.', 'https://www2.naga.gov.ph/office-service/city-procurement-office/', NULL),
('OSCA', 'Office for Senior Citizens Affairs', 'Metro PESO', '["patience","respectful communication","records"]', 0, 'To be assigned', 'No', 'Assists senior citizens with registration, information, referrals, and access to public services.', 'https://www2.naga.gov.ph/office-service/office-for-senior-citizens-affairs/', NULL),
('Metro PESO', 'Metro Naga Public Employment Service Office', 'Metro PESO', '["interviewing","communication","case organization"]', 0, 'To be assigned', 'No', 'Connects job seekers and employers while implementing employment programs, career services, and YEP coordination.', 'https://www2.naga.gov.ph/office-service/metro-naga-public-employment-service-office/', NULL),
('BCS', 'Bicol Central Station', 'Metro PESO', '["customer service","alertness","teamwork"]', 0, 'To be assigned', 'No', 'A public-facing transport setting where support work can involve information, coordination, and service assistance.', 'https://www2.naga.gov.ph/office-service/bicol-central-station/', NULL),
('NCMRC', 'Naga City Migrant Resource Center', 'Metro PESO', '["active listening","documentation","empathy"]', 0, 'To be assigned', 'No', 'Provides information, referrals, and assistance to migrants and their families.', 'https://www2.naga.gov.ph/office-service/naga-city-migrant-resource-center-ncmrc/', NULL),
('LBO', 'Lingkod Barangay Office', 'Metro PESO', '["community engagement","organization","communication"]', 0, 'To be assigned', 'No', 'Supports barangay-level services and community coordination close to residents.', 'https://www2.naga.gov.ph/office-service/lingkod-barangay-office/', NULL),
('DepCHArt', 'Department of Culture, Heritage, and the Arts', 'Metro PESO', '["creative work","event support","writing"]', 0, 'To be assigned', 'No', 'Supports cultural programs, heritage activities, public events, and creative city communications.', 'https://www2.naga.gov.ph/office-service/city-events-protocol-public-information-office/', NULL),
('CMO', 'City Mayor’s Office', 'Metro PESO', '["professionalism","organization","confidentiality"]', 0, 'To be assigned', 'No', 'Supports executive-office coordination, correspondence, public assistance, and city-level programs.', 'https://www2.naga.gov.ph/office-service/city-mayors-office/', NULL),
('CDRRMO', 'City Disaster Risk Reduction Management Office', 'Metro PESO', '["calm communication","reporting","teamwork"]', 0, 'To be assigned', 'No', 'Supports preparedness, response information, risk-reduction education, and community resilience work.', 'https://www2.naga.gov.ph/office-service/city-disaster-risk-reduction-management-office/', NULL),
('CENRO', 'City Environment and Natural Resources Office', 'Metro PESO', '["environmental awareness","research","field coordination"]', 0, 'To be assigned', 'No', 'Works on environmental protection, conservation, information campaigns, and community programs.', 'https://www2.naga.gov.ph/office-service/city-environment-and-natural-resources-office/', NULL),
('CVO', 'City Veterinary Office', 'Metro PESO', '["care","documentation","public communication"]', 0, 'To be assigned', 'No', 'Supports animal health, welfare, vaccination, public information, and community veterinary services.', 'https://www2.naga.gov.ph/office-service/city-veterinary-office/', NULL),
('NCGH', 'Naga City General Hospital', 'Metro PESO', '["confidentiality","empathy","accuracy"]', 0, 'To be assigned', 'No', 'A hospital setting where support assignments may include records, reception, patient guidance, and service coordination.', 'https://www2.naga.gov.ph/office-service/naga-city-hospital/', NULL),
('CAcO', 'City Accountant’s Office', 'Metro PESO', '["numeracy","spreadsheets","precision"]', 0, 'To be assigned', 'No', 'Supports accounting records, reports, documentation, and public financial accountability.', 'https://www2.naga.gov.ph/office-service/city-accountants-office/', NULL),
('ESSO', 'Education, Scholarship and Sports Office', 'Metro PESO', '["records management","communication","event support"]', 0, 'To be assigned', 'No', 'Coordinates education assistance, scholarship records, sports programs, and student-centered services.', 'https://www2.naga.gov.ph/office-service/education-scholarship-and-sports-office-naga-city-school-board/', NULL),
('IAS', 'Internal Audit Service', 'Metro PESO', '["critical thinking","confidentiality","detail"]', 0, 'To be assigned', 'No', 'Supports review, compliance, documentation, and systems that help public offices remain accountable.', 'https://www2.naga.gov.ph/office-service/internal-audit-service/', NULL),
('CSWDO', 'City Social Welfare Development Office', 'Metro PESO', '["empathy","interviewing","case documentation"]', 0, 'To be assigned', 'No', 'Provides social protection, referrals, community assistance, and support for vulnerable residents.', 'https://www2.naga.gov.ph/office-service/city-social-welfare-development-office/', NULL),
('CAsO', 'City Assessor’s Office', 'Metro PESO', '["accuracy","data entry","customer service"]', 0, 'To be assigned', 'No', 'Maintains property assessment records and assists with public requests related to real property information.', 'https://www2.naga.gov.ph/office-service/city-assessors-office/', NULL),
('RSRL', 'Raul S. Roco Library', 'Metro PESO', '["organization","research","service orientation"]', 0, 'To be assigned', 'No', 'Supports readers, learning resources, library organization, research assistance, and community learning activities.', 'https://www2.naga.gov.ph/office-service/raul-s-roco-library/', NULL),
('Educare', 'City Educare Service', 'Metro PESO', '["patience","creativity","safeguarding awareness"]', 0, 'To be assigned', 'No', 'Supports child-focused care, learning activities, family assistance, and community-based social services.', 'https://www2.naga.gov.ph/office-service/city-educare-service/', NULL)
ON DUPLICATE KEY UPDATE officeName = VALUES(officeName), department = VALUES(department), requiredSkills = VALUES(requiredSkills), officeDescription = VALUES(officeDescription), officeUrl = VALUES(officeUrl);
