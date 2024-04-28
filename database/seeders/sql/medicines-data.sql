-- INSERT INTO medicine_forms (name) VALUES
INSERT INTO medicine_forms (name) VALUES ('Tablet'), ('Capsule'), ('Injection'), ('Syrup'), ('Cream');

-- INSERT INTO medicine_frequencies (name) VALUES
INSERT INTO medicine_frequencies (name) VALUES ('Once a day'), ('Twice a day'), ('Three times a day'), ('Every 4 hours'), ('As needed');

-- INSERT INTO patient_medications (patient_id, physician_id, medicine_id, dose, form, qty, frequency, sig, status) VALUES
INSERT INTO patient_medications (patient_id, physician_id, medicine_id, dosage, form, qty, frequency, sig, status) VALUES ('P123456789', 'D987654321', 1, '500 mg', 'Tablet', 30, 'Once a day', 'Take one tablet daily', 'AC'),
('P987654321', 'D123456789', 2, '250 mg', 'Capsule', 60, 'Twice a day', 'Take two capsules daily', 'AC'),
('P234567890', 'D789012345', 3, '5 ml', 'Syrup', 1, 'Three times a day', 'Take 5 ml three times daily', 'AC'),
('P345678901', 'D567890123', 4, '10 mg', 'Injection', 10, 'Every 4 hours', 'Take one injection every 4 hours', 'AC'),
('P456789012', 'D345678901', 5, 'Apply to affected area', 'Cream', 1, 'As needed', 'Apply cream as needed', 'AC');

-- INSERT INTO medicines (quantity, purchase_price, duration_from, duration_to, amount, brand_name, generic_name, dosage, vat, is_active) VALUES
-- INSERT INTO medicines (quantity, purchase_price, duration_from, duration_to, amount, brand_name, generic_name, dosage, vat, is_active) VALUES
INSERT INTO medicines (quantity, purchase_price, duration_from, duration_to, amount, brand_name, generic_name, dosage, vat, is_active) VALUES
(100, 10.50, '2024-04-07', '2024-04-14', 1050.00, 'Brand1', 'Generic1', '250 mg', 5.00, true),
(200, 15.25, '2024-04-08', '2024-04-15', 3050.00, 'Brand2', 'Generic2', '500 mg', 7.00, true),
(150, 20.75, '2024-04-09', '2024-04-16', 3125.00, 'Brand3', 'Generic3', '1 g', 2.50, false),
(50, NULL, '2024-04-10', '2024-04-17', 1000.00, 'Brand4', 'Generic4', '50 mg', NULL, true),
(300, 12.50, '2024-04-11', '2024-04-18', 4500.00, 'Brand5', 'Generic5', '10 mg', 5.00, false);
