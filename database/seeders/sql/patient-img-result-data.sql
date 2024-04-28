INSERT INTO "patient_img_results" ("patient_id", "physician_id", "test_name", "imaging_src", "comparison", "indication", "findings", "impressions", "created_at", "updated_at")
VALUES 
    ('QSO4322I', '5F0B87A3', 'X-Ray', 'https://example.com/xray.jpg', 'Comparison to previous X-Ray', 'Chest pain', 'No acute abnormalities', 'Normal findings', NOW(), NOW()),
    ('JG87QW5A', '0H9F3P1T', 'MRI', 'https://example.com/mri.jpg', 'Comparison to previous MRI', 'Headache', 'No significant findings', 'Normal impressions', NOW(), NOW()),
    ('K4Y7S9I8', 'W6R2P3O9', 'CT Scan', 'https://example.com/ctscan.jpg', 'Comparison to previous CT Scan', 'Abdominal pain', 'Mild inflammation', 'Further evaluation recommended', NOW(), NOW()),
    ('Z9X3D1H5', 'F2E4N6L8', 'Ultrasound', 'https://example.com/ultrasound.jpg', 'Comparison to previous Ultrasound', 'Pregnancy', 'Normal fetal development', 'Healthy pregnancy', NOW(), NOW());
