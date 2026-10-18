-- Set flagship atelier featured products for homepage showcase
UPDATE products SET is_featured = 0;
UPDATE products SET is_featured = 1 WHERE sku IN ('MS-610', 'WJ-661', 'FL-470', 'FD-320', 'WV-581', 'MG-841', 'F232-2', 'FS-203');
