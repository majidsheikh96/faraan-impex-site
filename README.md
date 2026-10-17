# Faraan Impex — B2B Catalog Website

PHP + HTML + CSS + TailwindCSS catalog website for Faraan Impex (leather garments exporter, Sialkot, Pakistan).

## Structure

- `public/` — web root (front controller `index.php`, `.htaccess`, assets)
- `includes/` — config, DB layer, helpers, models
- `templates/` — page templates (home, category, product, about, contact)
- `admin/` — secure admin panel (product/category CRUD)
- `sql/` — database schema + product migration

## Deployment

Deployed via Hostinger Git integration. Product images (`public/assets/images/products/`) are deployed separately via File Manager (not in this repo).

After deploy:
1. Move `public/*` contents to the domain's `public_html/` root
2. Create MySQL database and import `sql/schema.sql`, then `sql/migration_products.sql`, then `sql/migration_images.sql`
3. Set DB credentials in `includes/config.php`
4. Create admin user (see deploy guide)
