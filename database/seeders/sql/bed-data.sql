INSERT INTO "bed_floors" ("id", "floor", "description", "created_at", "updated_at") VALUES
(1,	'1st Floor',	NULL,	now(), now()) ON CONFLICT DO NOTHING;

INSERT INTO "bed_groups" ("id", "name", "description", "floor_id", "is_active", "created_at", "updated_at") VALUES
(2,	'Medical',	'test',	1,	't',	now(), now()),
(3,	'Intensive Care',	'test',	1,	't',	now(), now()) ON CONFLICT DO NOTHING;

INSERT INTO "bed_types" ("id", "name", "created_at", "updated_at") VALUES
(1,	'Medical Bed',	now(), now()),
(2,	'Hospital Bed',	now(), now()),
(3,	'Delivery Bed',	now(), now()) ON CONFLICT DO NOTHING;

INSERT INTO "bed_lists" ("id", "name", "bed_type_id", "bed_group_id", "is_active", "created_at", "updated_at") VALUES
(1,	'101',	1,	3,	't',	now(), now()),
(2,	'102',	1,	3,	't',	now(), now()),
(3,	'105',	2,	2,	't',	now(), now()),
(4,	'131',	3,	3,	't',	now(), now()) ON CONFLICT DO NOTHING;