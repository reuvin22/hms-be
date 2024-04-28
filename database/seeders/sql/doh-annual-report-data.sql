

-- serivce capabilities
INSERT INTO "doh_service_capabilities" ("id", "description") VALUES 
(1,'General'),
(2,'Specialty'),
(3,'Infirmary');

INSERT INTO "doh_generals" ("id", "description", "code") VALUES 
(1,'Level 1 Hospital', 1),
(2,'Level 2 Hospital', 1),
(3,'Level 3 Hospital', 1);

INSERT INTO "doh_specialties" ("id", "description", "code") VALUES 
(1, 'Treats a particular disease', 2),
(2, 'Treats a particular organ', 2),
(3, 'Treats a particular class of patients', 2),
(4, 'Others', 2);

INSERT INTO "doh_traumas" ("id", "description", "code") VALUES 
(1, 'Trauma Capable', 3),
(2, 'Trauma Receiving', 3);

INSERT INTO "doh_natureofownerships" ("description") VALUES 
('Government'),
('Private');

INSERT INTO "doh_governments" ("id", "description", "code") VALUES 
(1,'National', 1),
(2,'Local', 1),
(3,'State Universities and Colleges(SUC)', 1);

INSERT INTO "doh_privates" ("id", "description", "code") VALUES 
(1,'Single Proprietorship', 2),
(2,'Partnership ', 2),
(3,'Corporation', 2),
(4,'Religious', 2),
(5,'Civic Organization', 2),
(6,'Foundation', 2),
(7,'Cooperative', 2);

INSERT INTO "doh_testings" ("test_desc", "test_code")
VALUES ('X-Ray',	1),
('Ultrasound',	1),
('CT-Scan',	1),
('MRI',	1),
('Mammography',	1),
('Angiography',	1),
('Linear Accelerator',	1),
('Dental X-Ray',	1),
('Others',	1),
('Urinalysis',	2),
('Fecalysis',	2),
('Hematology',	2),
('Clinical chemistry',	2),
('Immunology/Serology/HIV',	2),
('Microbiology (Smears/Culture & Sensitivity)',	2),
('Surgical Pathology',	2),
('Autopsy',	2),
('Cytology',	2),
('Number of Blood units Transfused',	3);

INSERT INTO "doh_quality_mgmt_types" ("id","description") VALUES 
(1,'ISO Certified'),
(2,'International Accreditation'),
(3,'PhilHealth Accreditation'),
(4,'PCAHO');

INSERT INTO "doh_philhealth_accreditations" ("id", "description", "code") VALUES 
(1,'Basic Participation', 3),
(2,'Advanced Participation', 3);

INSERT INTO "doh_specialty_services" ("id", "description") VALUES 
(1,'Medicine'),
(2,'Obstetrics'),
(3,'Gynecology'),
(4,'Pediatrics'),
(5,'Pedia'),
(6,'Adult'),
(7,'Others'),
(8,'Pathologic'),
(9,'Non-Pathologic / Well-baby');

INSERT INTO "doh_testing_groups" ("testing_desc")
VALUES ('Total number of medical imaging tests (all types including x-rays, ultrasound, CT scans, etc.)'),	
('Total number of laboratory and diagnostic tests (all types, excluding medical imaging)'),
('Blood Service Facilities');	



-- info classification
INSERT INTO "doh_info_classifications" ("service_capability_id", "general_id", "specialty_id", "specialty_specify", "trauma_capability_id", "nature_of_ownership_id", "government_id", "national_id", "local_id", "private_id", "ownership_other") VALUES
(1,	1,	0,	'',	0,	1,	0,	0,	0,	0,	'');

-- info quality managements
INSERT INTO "doh_info_quality_mgmts" ("quality_mgmt_type_id", "description", "philhealth_accreditation_id", "validity_from", "validity_to") VALUES 
(3, 'Quality Management/Quality Assurance: Organized set of activities designed to demostrate on-going assessment of important aspects of patient and services', 1, '2022-01-01', '2022-12-31');

-- bed capacities
INSERT INTO "doh_info_bed_capacities" ("abc", "implementing_beds") VALUES 
(20, 20);

-- hospital operation summary of patients
INSERT INTO "doh_hosp_opt_summary_patients" ("total_number_inpatient", "total_discharge", "total_ibd", "total_inpatient_transfrom") 
VALUES (183, 183, 425, 1);

-- hospital operation discharges specialties
INSERT INTO "doh_hosp_opt_discharges_specialties" ("id","type_of_service_id", "no_patients", "total_length_stay", "np_pay", "nph_service_charity", "nph_total", "ph_pay", "ph_service", "ph_total", "hmo", "owwa", "recovered_improved", "transferred", "hama", "absconded", "unimproved", "deaths_below48", "deaths_over48", "total_deaths", "total_discharges") 
VALUES (1, 1,	140,	319,	9,	0,	9,	131,	0,	131,	0,	0,	136,	1,	3,	0,	0,	0,	0,	0,	140),
(2, 2,	4,	5,	0,	0,	0,	4,	0,	4,	0,	0,	4,	0,	0,	0,	0,	0,	0,	0,	4),
(3, 3,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(4, 4,	34,	85,	2,	0,	2,	32,	0,	32,	0,	0,	33,	0,	1,	0,	0,	0,	0,	0,	34),
(5, 5, 1,	5,	0,	0,	1,	1,	0,	1,	0,	0,	1,	0,	0,	0,	0,	0,	0,	0,	1),
(6, 6,	4,	11,	0,	0,	4,	4,	0,	4,	0,	0,	4,	0,	0,	0,	0,	0,	0,	0,	4),
(7, 8,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0),
(8, 9,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0);

-- hospital operation discharges morbidities
INSERT INTO "doh_hosp_opt_discharges_morbidities" ("id","icd10_desc", "m_under1", "f_under1", "m_1to4", "f_1to4", "m_5to9", "f_5to9", "m_10to14", "f_10to14", "m_15to19", "f_15to19", "m_20to24", "f_20to24", "m_25to29", "f_25to29", "m_30to34", "f_30to34", "m_35to39", "f_35to39", "m_40to44", "f_40to44", "m_45to49", "f_45to49", "m_50to54", "f_50to54", "m_55to59", "f_55to59", "m_60to64", "f_60to64", "m_65to69", "f_65to69", "m_70over", "f_70over", "m_sub_total", "f_sub_total", "grand_total", "icd10_code", "icd10_cat")
VALUES (1,'Other diseases of stomach and duodenum',	0,	0,	0,	0,	1,	1,	0,	1,	0,	1,	1,	0,	1,	1,	2,	1,	1,	1,	1,	2,	1,	2,	0,	0,	0,	0,	0,	0,	0,	1,	3,	2,	11,	13,	24,	'K31',	'K20-K31'),
(2,'Other specified local infections of the skin and subcutaneous tissue',	0,	0,	0,	0,	1,	0,	0,	0,	1,	2,	0,	0,	0,	0,	0,	0,	1,	0,	1,	0,	1,	0,	1,	1,	2,	0,	1,	0,	0,	0,	2,	0,	11,	3,	14,	'L08.8',	'L00-L08'),
(3,'Chronic asthmatic bronchitis with acute lower respiratory infection',	1,	0,	0,	1,	0,	1,	0,	1,	1,	0,	0,	0,	0,	0,	0,	1,	0,	0,	0,	0,	0,	0,	1,	1,	0,	0,	0,	2,	0,	1,	1,	1,	4,	9,	13,	'J44.0/1',	'J40-J47'),
(4,'Other specified diseases of upper respiratory tract',	0,	0,	0,	0,	0,	0,	1,	0,	4,	4,	1,	0,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	1,	0,	0,	0,	0,	0,	0,	0,	8,	4,	12,	'J39.8',	'J30-J39'),
(5,'Hypertensive heart disease', 0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	3,	0,	3,	0,	0,	0,	0,	1,	0,	0,	1,	1,	2,	2,	9,	11,	'I11',	'I10-I15'),
(6,'Type I diabetes mellitus', 0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	2,	0,	3,	2,	1,	0,	2,	0,	0,	0,	0,	0,	8,	0,	8,	'E10',	'E09-E14'),
(7,'Renal tubulo-interstitial disease, unspecified',	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	3,	0,	0,	0,	1,	1,	0,	0,	0,	1,	0,	1,	0,	0,	0,	0,	1,	0,	0,	3,	5,	8,	'N15.9',	'N10-N16'),
(8,'Influenza with pneumonia, virus not identified(INFLUENZAL BRONCHOPNEUMONIA)(INFLUENZAL PNEUMONIA)(BRONCHOPNEUMONIA)',	1,	0,	0,	0,	0,	0,	0,	0,	1,	2,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	1,	2,	3,	5,	'J11.0',	'J10-J18'),
(9,'Other disorders of middle ear mastoid',	0,	0,	0,	0,	0,	1,	0,	0,	0,	0,	1,	0,	0,	0,	1,	0,	0,	0,	0,	0,	0,	0,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	3,	2,	5,	'H74',	'H65-H75'),
(10,'Burn and corrosion, body region unspecified(SCALD)',	0,	0,	0,	0,	2,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	1,	0,	0,	0,	1,	0,	4,	1,	5,	'T30',	'T20-T32');

-- hospital operation discharges number deliveries
-- INSERT INTO "doh_hosp_opt_discharges_number_deliveries" ("total_ifdelivery", "toal_lbvdelivery", "total_lbcdelivery", "total_otherdelivery")
-- VALUES ()

-- hospital operation discharges opv
INSERT INTO "doh_hosp_opt_discharges_opvs" ("new_patient", "re_visit", "adult", "pediatric", "adult_general_medicine", "specialty_non_surgical", "surgical", "antenatal", "postnatal")
VALUES (477,	428,	838,	76,	200,	595,	110,	0,	0);

-- hospital operation discharges opd
INSERT INTO "doh_hosp_opt_discharges_opds" ("opd_consultations", "number", "icd10_code", "icd10_cat")
VALUES ('Other disorders of male genital organs  in diseases classified elsewhere',	180,	'N50',	'N40-N51'),
('Urolithiasis',	164,	'N20.9/1',	'N20-N23'),
('Other disorders of urinary system',	129,	'N39',	'N30-N39'),
('Other diseases of stomach and duodenum',	54,	'K31',	'K20-K31'),
('Type I diabetes mellitus',	43,	'E10',	'E09-E14'),
('Upper respiratory infection',	27,	'J06.9/1',	'J00-J06'),
('Hypertensive heart disease',	24,	'I11',	'I10-I15'),
('Other specified predominantly sexually transmitted diseases',	4,	'A63.8',	'A50-A64'),
('Chronic obstructive pulmonary disease with acute lower respiratory infection(CHRONIC ASTHMATIC/EMPHYSEMATOUS BRONCHITIS WITH ACUTE LOWER RESPIRATORY INFECTION)(CHRONIC BRONCHITIS PRIMARILY EMPHYSEMATOUS COMPONENT WITH ACUTE LOWER RESPIRATORY INFECTION)',	4,	'J44.0',	'J40-J47'),
('Influenza with pneumonia, influenza virus identified(AVIAN INFLUENZA WITH PNEUMONIA)(BRONCHOPNEUMONIA, INFLUENZAL BRONCHOPNEUMONIA, INFLUENZAL PNEUMONIA [EXCEPT H.INFLUENZAE])',	3,	'J10.0',	'J10-J18');

-- hospital operation discharges er
INSERT INTO "doh_hosp_opt_discharges_ers" ("id","er_consultations", "number", "icd10_code", "icd10_cat")
VALUES (1,'Other injuries of unspecified body region',	49,	'T14.8',	'T08-T14'),
(2,'Hypertensive heart disease',	8,	'I11',	'I10-I15'),
(3,'Other diseases of stomach and duodenum',	7,	'K31',	'K20-K31'),
(4,'Foreign body in other and multiple parts of respiratory tract',	5,	'T17.8',	'T15-T19'),
(5,'Type I diabetes mellitus',	3,	'E10',	'E09-E14'),
(6,'Disorder of lens, unspecified',	3,	'H27.9',	'H25-H28'),
(7,'Burn and corrosion, body region unspecified(SCALD)',	3,	'T30',	'T20-T32'),
(8,'Other disorders of urinary system',	2,	'N39',	'N30-N39'),
(9,'Chronic ischemic heart disease',	1,	'I25',	'I20-I25'),
(10,'Urolithiasis',	1,	'N20.9/1',	'N20-N23');

-- hospital operation discharges testings
INSERT INTO "doh_hosp_opt_discharges_testings" ("testing_group_id", "testing_id", "number")
VALUES (1,	1,	270),
(1,	2,	151),
(1,	3,	0),
(1,	4,	0),
(1,	5,	0),
(1,	6,	0),
(1,	7,	0),
(1,	8,	0),
(1,	9,	0),
(2,	10,	434),
(2,	11,	13),
(2,	12,	605),
(2,	13,	267),
(2,	14,	10),
(2,	15,	2),
(2,	16,	0),
(2,	17,	0),
(2,	18,	0),
(3,	19,	17);

INSERT INTO "doh_hosp_discharges_ev" ("er_visit", "er_visits_adult", "er_visits_pediatric", "ev_from_facil_to_another", "ev_to_facil_to_another") VALUES 
(322, 170, 152, 0, 0);

-- hospital operation deaths
INSERT INTO "doh_hosp_opt_deaths" ("total_deaths",	"total_deaths48down", "total_deaths48up",	"total_erdeaths",	"total_doa",	"total_stillbirths",	"total_neonatal_deaths",	"total_maternal_deaths", "total_deaths_newborn", "total_discharge_deaths", "gross_deathrate", "ndr_numerator", "ndr_denominator", "net_deathrate")
VALUES (1,	0,	0,	1,	0,	0,	0,	0, 0, 0, 0, 0, 0, 0.00);

-- hospital operation mortality deaths
INSERT INTO "doh_hosp_opt_mortality_deaths" ("icd10_desc", "m_under1", "f_under1", "m_1to4", "f_1to4", "m_5to9", "f_5to9", "m_10to14", "f_10to14", "m_15to19", "f_15to19", "m_20to24", "f_20to24", "m_25to29", "f_25to29", "m_30to34", "f_30to34", "m_35to39", "f_35to39", "m_40to44", "f_40to44", "m_45to49", "f_45to49", "m_50to54", "f_50to54", "m_55to59", "f_55to59", "m_60to64", "f_60to64", "m_65to69", "f_65to69", "m_70over", "f_70over", "m_sub_total", "f_sub_total", "grand_total", "icd10_code", "icd10_cat")
VALUES ('Other cerebrovascular diseases',	0,	0,	0, 0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	1,	0,	0,	0,	0,	0,	1,	0,	1,	'I67',	'I60-I69');

-- hospital operation hai
INSERT INTO "doh_hosp_opt_hai" ("num_hai",	"num_discharges",	"infection_rate",	"patient_num_vap",	"total_ventilator_days",	"result_vap",	"patient_num_bsi",	"total_num_centralline",	"result_bsi",	"patient_num_uti",	"total_catheter_days",	"result_uti",	"num_ssi",	"total_procedures_done",	"result_ssi")
VALUES (0.00,	0.00,	0.00,	0.00,	0.00,	0.00,	0.00,	0.00,	0.00,	0.00, 0.00,	0.00,	0.00,	0.00,	0.00);

-- hospital operation major opt
INSERT INTO "doh_hosp_opt_major_opts" ("operation_code",	"surgical_operation",	"number")
VALUES ('OPERA96498',	'CYSTOSCOPY',	3),
('OPERA97322',	'APENDECTOMY',	1),
('OPERA97098',	'VARICOCELECTOMY',	1),
('OPERA96838',	'Not Applicable',	0);

-- hospital operation minor opt
INSERT INTO "doh_hosp_opt_minor_opts" ("operation_code","surgical_operation","number")
VALUES ('OPERA96526',	'Repair of lacerated wound',	56),
('OPERA97071',	'PHACOEMULSIFICATION',	36),
('OPERA65235',	'Removal of foreign body, intraocular; from anterior chamber or lens',	18),
('OPERA98110',	'Pterygium Excision',	17),
('OPERA96872',	'Repair of Scleral Laceration',	15),
('OPERA98611',	'Repair of corneal laceration',	9),
('OPERA97042',	'Ocular surface reconstruction',	7),
('OPERA65285',	'Repair of laceration; cornea and/or sclera, perforating, w/ reposition or resection of uveal tissue',	6),
('OPERA98897',	'TRABECULECTOMY',	5),
('OPERA10060',	'Incision and drainage of abscess (eg, carbuncle, suppurative hidradenitis, cutaneous or subcutaneous abscess, cyst, furuncle, or paronychia)',	4);

INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (1,2,2,1,0,0,0,1,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (2,3,0,4,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (3,5,1,0,0,0,0,1,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (4,10,3,0,0,0,0,3,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (5,11,3,0,0,0,0,3,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (6,12,3,2,0,0,0,2,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (7,13,1,2,0,0,0,1,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (8,14,1,0,0,0,0,1,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (9,15,1,0,0,0,0,1,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (10,18,1,1,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (11,21,0,1,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (12,22,0,12,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (13,24,0,4,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (14,25,0,1,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (15,28,0,3,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (16,29,0,5,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (17,30,0,1,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (18,31,0,2,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (19,33,0,2,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (20,34,0,2,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (21,35,0,1,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (22,36,0,0,1,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (23,37,0,1,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (24,38,0,2,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (25,40,0,0,1,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (26,39,0,1,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (27,43,0,3,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (28,44,0,1,0,0,0,0,0);
INSERT INTO doh_staffing_patterns (id,profession_designation,specialty_board_certified,fulltime_40permament,fulltime_40contructual,parttime_permanent,parttime_contructual,active_rotating_affiliate,outsourced) VALUES (29,45,0,2,0,0,0,0,0);

INSERT INTO "doh_hospital_expenses"("salaries_wages", "employee_benebits", "allowances", "total_ps", "total_amount_medicine", "total_amount_medical_supp", "total_amount_util", "total_amount_nonmedserv", "total_mooe", "amount_infras", "amount_equip", "total_co" ,"grand_total")
VALUES (2600034.05,	121642.00,	75000.00,	2796676.05,	432729.02,	477182.37,	377554.42,	207066.64,	1494532.45,	198603.00,	2900000.00,	3098603.00,	7389811.50);

INSERT INTO "doh_hospital_revenues" ("amount_fromdoh",	"amount_fromlgu",	"amount_fromdonor",	"amount_fromprivorg",	"amount_from_phealth",	"amount_from_patient",	"amount_from_reimbursement",	"amount_from_othersources",	"grand_total")
VALUES (0,	12000.00,	65500.00,	0,	4110869.99,	3060594.40,	0,	0,	7248964.39);

INSERT INTO "doh_submitted_reports" ("reporting_year",	"reporting_status",	"reported_by",	"designation",	"section",	"department",	"date_reported")
VALUES (2023, 'S', 'Jicoy Cortejo', 'Senior Developer', 'IT', 'IT', now());











