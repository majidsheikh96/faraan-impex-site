# Faraan Impex — B2B Catalog Website

PHP + HTML + CSS + TailwindCSS catalog website for Faraan Impex (leather garments exporter, Sialkot, Pakistan).

## Structure

- `public/` — web root (front controller `index.php`, `.htaccess`, assets)
- `includes/` — config, DB layer, helpers, models
- `templates/` — page templates (home, category, product, about, contact)
- `admin/` — secure admin panel (product/category CRUD)
- `sql/` — database schema + product migration

## Local Development (Docker)

Run the entire stack locally with:

```bash
docker compose up -d
```

- **Website**: http://localhost:8088
- **phpMyAdmin**: http://localhost:8085 (DB: `u174045762_faraanimpex`, User: `u174045762_faraanimpex`, Pass: `H716whwfWO6Hl8LF78IR`)
- **MariaDB port**: `localhost:3308`

## Deployment

Deployed via Hostinger Git integration. All templates, assets, product images (`assets/images/products/`), and database seeds are version-controlled in this repository.
