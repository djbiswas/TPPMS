# Deploy TPPMS on Bluehost

This app is **Laravel 13** and needs **PHP 8.3**. Shared hosting works if you point the site document root at Laravel’s `public` folder (or use the `public_html` shim below).

You cannot finish the live deploy from Cursor without Bluehost login. Use this runbook in cPanel, or send SSH/cPanel details to complete it remotely.

## Before upload (on your PC)

1. PHP 8.3 locally, then:

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate --show
```

Save the generated `APP_KEY`. Do not upload `.env` from Laragon (it has `WEBFIX_LICENSE_BYPASS=true` and debug on).

2. Build front-end with **Node 20+**:

```bash
npm ci
npm run build
```

3. Zip the project **excluding** `.env`, `node_modules`, `tests`, `.git`. **Include** `vendor/` and `public/build/`.

## Bluehost cPanel

### 1. PHP 8.3

**cPanel → MultiPHP Manager** → select the domain → **PHP 8.3**.

If 8.3 is missing, this hosting plan cannot run this app until PHP is upgraded (or use a VPS).

### 2. MySQL

**cPanel → MySQL Databases**

- Database: `something_tppms`
- User with full privileges
- Note host (usually `localhost`), name, user, password

### 3. Files (pick one)

**Option A — change document root (preferred)**  
Upload the project to e.g. `/home/USER/tppms`.  
**Domains → document root** = `/home/USER/tppms/public`.

**Option B — keep `public_html`**  
1. Upload the Laravel app to `/home/USER/tppms` (sibling of `public_html`, not inside it).  
2. Copy `deploy/bluehost/public_html/index.php` and `deploy/bluehost/public_html/.htaccess` into `public_html`.  
3. Copy `public/build`, `public/images`, `public/favicon.ico`, `public/robots.txt` into `public_html`.

If the folder is not named `tppms`, edit the two `../tppms/` paths in that `index.php`.

### 4. `.env` on the server

In `/home/USER/tppms/.env` (never in `public_html`):

```env
APP_NAME="L&L Tenant Portal"
APP_ENV=production
APP_KEY=base64:...paste from key:generate...
APP_DEBUG=false
APP_URL=https://YOUR-DOMAIN.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cpanel_db_name
DB_USERNAME=cpanel_db_user
DB_PASSWORD=cpanel_db_password

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=587
MAIL_USERNAME=you@YOUR-DOMAIN.com
MAIL_PASSWORD=mailbox-password
MAIL_FROM_ADDRESS=you@YOUR-DOMAIN.com
MAIL_FROM_NAME="L&L International Ventures LLC"
MAIL_ENCRYPTION=tls

WEBFIX_LICENSE_BYPASS=false
WEBFIX_LICENSE_API=https://webfixteam.com/v1
WEBFIX_LICENSE_SECRET=
WEBFIX_LICENSE_KEY=
WEBFIX_LICENSE_ITEM=tppms
```

Create a mailbox in cPanel for `MAIL_USERNAME`.

### 5. Permissions

```text
storage/          775
bootstrap/cache/  775
```

### 6. Terminal (cPanel → Terminal or SSH)

```bash
cd ~/tppms
php artisan migrate --seed --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

If Terminal is unavailable, use **phpMyAdmin** only for schema as a last resort; prefer SSH.

### 7. SSL

**cPanel → SSL/TLS Status** → AutoSSL for the domain. Set `APP_URL` to `https://`.

### 8. License (production)

Keep `WEBFIX_LICENSE_BYPASS=false`. Issue a `tppms` key in WebFix Team admin, then **Admin → License** on this site.

**Change the seeder password** after first login (`manager@llinternationalventures.com` / `password`).

## Checks

- `https://YOUR-DOMAIN.com/` — Welcome Home
- `/contact` — form
- `/login` — tenant `tenant@example.com` only if you seeded demo users; disable or change in production
- No `.env` reachable in the browser

## Common failures

| Symptom | Fix |
| --- | --- |
| 500 / blank | `storage/logs/laravel.log`; `APP_DEBUG=false` still logs there |
| PHP version error | MultiPHP 8.3 |
| CSS missing | `public/build` uploaded; `npm run build` before zip |
| Site shows directory listing | Document root must be `public` (or Option B shim) |
| Mail not sending | cPanel mailbox + SMTP, not `MAIL_MAILER=log` |
