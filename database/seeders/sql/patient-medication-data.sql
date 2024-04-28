
INSERT INTO "medicines" ("id", "quantity", "purchase_price", "duration_from", "duration_to", "amount", "brand_name", "generic_name", "vat", "is_active", "created_at", "updated_at") VALUES
(1,	5,	600,	'2024-01-10',	'2024-01-10',	500,	'paracetamol',	'paracetamol',	NULL,	't',	'2024-01-10 13:17:38',	'2024-01-10 13:17:38'),
(2,	5,	600,	'2024-01-10',	'2024-01-10',	500,	'acetaminophen',	'acetaminophen',	NULL,	't',	'2024-01-10 13:17:38',	'2024-01-10 13:17:38'),
(3,	5,	600,	'2024-01-10',	'2024-01-10',	500,	'gentamicin',	'gentamicin',	NULL,	't',	'2024-01-10 13:17:38',	'2024-01-10 13:17:38'),
(4,	5,	600,	'2024-01-10',	'2024-01-10',	500,	'ibuprofen',	'ibuprofen',	NULL,	't',	'2024-01-10 13:17:38',	'2024-01-10 13:17:38'),
(5,	5,	600,	'2024-01-10',	'2024-01-10',	500,	'ketoconazole',	'ketoconazole',	NULL,	't',	'2024-01-10 13:17:38',	'2024-01-10 13:17:38'),
(6,	5,	600,	'2024-01-10',	'2024-01-10',	500,	'rifampicin',	'rifampicin',	NULL,	't',	'2024-01-10 13:17:38',	'2024-01-10 13:17:38') ON CONFLICT DO NOTHING;

INSERT INTO "patient_medications" ("patient_id", "physician_id", "medicine_id", "dosage", "form", "qty", "frequency", "sig", "status", "created_at", "updated_at") VALUES
('QSO-240108LSG4',	'QSO-230810E8PK',	1, '500mg',	'tablet',	4,	'once a day','testtt',	'pm', now(),	now()),
('QSO-240108LSG4',	'QSO-230810E8PK',	2, '800mg',	'tablet',	4,	'once a day','testtt',	'pm', now(),	now()),
('QSO-240108LSG4',	'QSO-230810E8PK',	3, '40mg',	'tablet',	3,	'once a day','testtt',	'pm', now(),	now()),
('QSO-240108LSG4',	'QSO-230810E8PK',	4, '200mg',	'tablet',	3,	'once a day','testtt',	'pm', now(),	now()),
('QSO-240108LSG4',	'QSO-230810E8PK',	5, '200mg',	'tablet',	3,	'once a day','testtt',	'pm', now(),	now()),
('QSO-240108LSG4',	'QSO-230810E8PK',	6, '300mg',	'tablet',	3,	'once a day','testtt',	'pm', now(),	now()) ON CONFLICT DO NOTHING;