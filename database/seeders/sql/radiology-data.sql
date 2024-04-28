

INSERT INTO "radiology_categories" ("category_name", "created_at", "updated_at") VALUES
('X-RAY',	'2024-01-10 02:21:20',	'2024-01-10 02:21:20'),
('ULTRASOUND',	'2024-01-10 02:21:30',	'2024-01-10 02:21:30');

INSERT INTO "radiologies" ("id", "test_name", "test_type", "radio_cat_id", "charge", "created_at", "updated_at") VALUES
(1,	'X-RAY',	'SCANNING',	1,	1500,	'2024-01-10 02:22:31',	'2024-01-10 02:22:31'),
(2,	'ULTRASOUND',	'SCANNING',	2,	1200,	'2024-01-10 02:22:56',	'2024-01-10 02:22:56');