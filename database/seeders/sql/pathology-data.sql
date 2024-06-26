INSERT INTO "pathologies" ("test_name", "short_name", "patho_category_id", "patho_param_id", "unit", "sub_category", "report_days", "methods", "charge", "created_at", "updated_at") VALUES
('Complete Blood Count with platelet count(CBC with platelet)',	'CBC with platelet',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	500,	now(), now()),
('Peripheral Blood Smear',	'Peripheral Blood Smear',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	1200,	now(), now()),
('Clotting Time(CT)',	'Clotting Time(CT)',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	1300,	now(), now()),
('Bleeding Time(BT)',	'Bleeding Time(BT)',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	600,	now(), now()),
('Prothrombin Time(PT)',	'Prothrombin Time(PT)',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	600,	now(), now()),
('Partial Thromboplastin Time(PTT)',	'Partial Thromboplastin Time(PTT)',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	600,	now(), now()),
('Dengue NS1',	'Dengue NS1',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	600, now(), now()),
('Crossmatching',	'Crossmatching',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	600, now(), now()),
('Blood Typing',	'Blood Typing',	1,	NULL,	NULL,	NULL,	NULL,	NULL,	600, now(), now()),
('Urinalysis(midstream, clean catch)',	'Urinalysis(midstream, clean catch)',	2,	NULL,	NULL,	NULL,	NULL,	NULL,	1400, now(), now()),
('Pregnancy Test',	'Pregnancy Test',	2,	NULL,	NULL,	NULL,	NULL,	NULL,	1400, now(), now()),
('Fecalysis',	'Fecalysis',	2,	NULL,	NULL,	NULL,	NULL,	NULL,	1400, now(), now()),
('Electrocardiogram(ECG)',	'Electrocardiogram(ECG)',	3,	NULL,	NULL,	NULL,	NULL,	NULL,	1400, now(), now()),
('Lipid Profile',	'Lipid Profile',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	1400, now(), now()),
('Serum Sodium(Na)',	'Serum Sodium(Na)',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	1400, now(), now()),
('Serum Potassium(K)',	'Serum Potassium(K)',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	1400, now(), now()),
('Blood Urea Nitrogen(BUN)',	'Blood Urea Nitrogen(BUN)',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	500, now(), now()),
('Ionized Calcium(iCa)',	'Ionized Calcium(iCa)',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	500, now(), now()),
('Uric Acid',	'Uric Acid',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	500, now(), now()),
('ALT/SGPT',	'ALT/SGPT',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	500, now(), now()),
('AST/SGOT',	'AST/SGOT',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	500, now(), now()),
('Hepatitis Test',	'Hepatitis Test',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	500, now(), now()),
('Syphilis',	'Syphilis',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	500, now(), now()),
('TSH',	'TSH',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	1000, now(), now()),
('Ft4',	'Ft4',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	1000, now(), now()),
('Ft3',	'Ft3',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	1000, now(), now()),
('TT4',	'TT4',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	1000, now(), now()),
('TT3',	'TT3',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	1000, now(), now()),
('PSA',	'PSA',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	1000, now(), now()),
('Rapid Antigen Test(COVID-19)',	'Rapid Antigen Test(COVID-19)',	4,	NULL,	NULL,	NULL,	NULL,	NULL,	800, now(), now()),
('Fasting Blood Sugar(FBS)',	'Fasting Blood Sugar(FBS)',	5,	NULL,	NULL,	NULL,	NULL,	NULL,	800, now(), now()),
('Hba1c',	'Hba1c',	5,	NULL,	NULL,	NULL,	NULL,	NULL,	800, now(), now()),
('Random Blood Sugar',	'Random Blood Sugar',	5,	NULL,	NULL,	NULL,	NULL,	NULL,	800, now(), now()),
('75g Oral Glucose Tolerance Test(OGTT)',	'75g Oral Glucose Tolerance Test(OGTT)',	5,	NULL,	NULL,	NULL,	NULL,	NULL,	800, now(), now());

INSERT INTO "pathology_categories" ("category_name", "created_at", "updated_at") VALUES
('hematology',	now(), now()),
('urine stool studies',	now(), now()),
('cardiac studies',	now(), now()),
('chemistry',	now(), now()),
('glucose',	now(), now()) ON CONFLICT DO NOTHING;