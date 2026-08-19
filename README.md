# L&L Tenant Portal (TPPMS)

Laravel tenant portal for **L&L International Ventures LLC**.

Full step-by-step plan: [docs/PROJECT_PLAN.md](docs/PROJECT_PLAN.md)

## Local (Laragon)

1. Point a vhost at `d:\laragonv2\www\TPPMS\public` (e.g. `http://tppms.test`).
2. PHP 8.3+, Composer, Node **20+** for Vite (Laragon’s Node 18 is too old; use `C:\Program Files\nodejs\node.exe` v22 if needed).
3. Copy `.env.example` → `.env` if needed. `php artisan key:generate`
4. SQLite works out of the box. For MySQL, create database `tppms` and update `.env`.
5. `php artisan migrate --seed`
6. `npm install && npm run build` (with Node 20+)
7. Admin login from seeder: `manager@llinternationalventures.com` / `password`

`WEBFIX_LICENSE_BYPASS=true` is for local only.

## Bluehost

Step-by-step cPanel deploy (PHP 8.3, document root, MySQL, `.env`): [docs/BLUEHOST.md](docs/BLUEHOST.md)

## Production license

Do **not** edit `d:\laragonv2\www\webfixteam`. In webfixteam admin:

1. Product **L&L Tenant Portal**, slug **`tppms`**, type Laravel Application
2. Issue an active license key
3. Set `WEBFIX_LICENSE_BYPASS=false`, API URL, signing secret, and key on this app
4. Activate under **Admin → License**

## Phase 2 (not built)

Payment ledger, lease documents, messaging, card/Chase gateway, full ticket workflow.
