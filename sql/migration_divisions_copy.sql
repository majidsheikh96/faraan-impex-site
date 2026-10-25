-- Homepage divisions: drop the saved (old, long) copy so the site falls back to the short design copy
-- defined in includes/models.php (get_divisions_data). Re-edit in Admin > Homepage afterwards if needed.
DELETE FROM site_settings WHERE setting_key = 'divisions_json';
