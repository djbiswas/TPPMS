# L&L Tenant Portal (TPPMS) — Step-by-Step Project Plan

**Product:** Tenant Portal for L&L International Ventures LLC  
**Stack:** Laravel 12, PHP 8.3+, MySQL, Blade, Tailwind CSS, Alpine.js  
**Path:** `d:\laragonv2\www\TPPMS`  
**License server:** WebFix Team (`d:\laragonv2\www\webfixteam`) — **do not modify that project**

This document is the working plan. Phase 1 is the first build. Phase 2 is later.

---

## Locked client facts

| Item | Value |
|------|--------|
| Company | L&L International Ventures LLC |
| Tagline | Professional management. Simple living. |
| Property | 317 Freedom Park, Liberty Hill, TX 78642 (Single Family Home) |
| Manager | Angie Ojeda |
| Email | manager@llinternationalventures.com |
| Phone | (512) 806-3630 |
| Hours | Mon–Fri 9:00 AM – 5:00 PM |
| Zelle | @LLInternationalVentures |
| House photo | `public/images/property-hero.jpg` (from client Lightshot) |
| Colors | Dark forest green, gold, cream/beige, white |
| Fonts | Playfair Display (headings), Inter (body) |
| Copyright | 2026 |

**Payments:** Zelle handle may appear on the public homepage. Full wire/bank numbers stay behind login (or emailed). No card/ACH gateway in Phase 1.

---

## Phase overview

### Phase 1 (this build)

1. Laravel app + branding layouts
2. Public homepage + Contact Us (design match)
3. Contact / maintenance request form + email to manager
4. Tenant activate + login + simple dashboard
5. Admin request inbox + tenant create + settings
6. Tests / responsive pass
7. WebFix Team license lock (TPPMS client only)

### Phase 2 (later — do not build now)

- Balance / charges ledger
- Payment history + receipt upload/verify
- Lease documents
- Full maintenance ticket workflow
- In-app messages
- Chase/card gateway
- Multi-property admin PMS

---

## Step-by-step build order

### Step 1 — Create the Laravel 12 project

1. Create the app in `d:\laragonv2\www\TPPMS` with Composer (`laravel/laravel`).
2. Create MySQL database `tppms` and set `.env`.
3. Install Laravel Breeze (Blade stack) for auth scaffolding.
4. Install Tailwind + Alpine (Breeze includes this).
5. Add theme tokens: forest green, gold, cream.
6. Create three layouts: public, tenant, admin.

**Done when:** `php artisan serve` / Laragon vhost loads a themed app.

---

### Step 2 — Branding and seed data

1. Copy house photo to `public/images/property-hero.jpg`.
2. Add SVG L&L monogram logo.
3. Migrations: `users` extras (`role`, `phone`, `status`), `properties`, `requests`, `request_attachments`, `settings`, `activity_logs`.
4. Seed one property, manager settings, Zelle handle, admin user.

**Done when:** Seeder runs cleanly and assets load.

---

### Step 3 — Public pages (match mockups)

1. Homepage: Welcome Home hero, login/activate cards, portal includes, Zelle, help strip, footer.
2. Contact Us: two-column form + property / pay rent / manager cards.
3. Login and Activate pages restyled to the same system.
4. Privacy / terms stubs.

**Done when:** Pages match the supplied designs on desktop and mobile.

---

### Step 4 — Contact / maintenance form

Request types:

- General inquiry
- Maintenance request
- Work order
- Rent payment / payment issue
- Late rent
- Urgent request
- Other

Fields: name, email, phone, property/unit, subject, description, preferred contact, optional attachment. Extra fields (priority, permission to enter) when type is maintenance / work order / urgent.

On submit:

1. Save request + attachment (private disk).
2. Email Angie.
3. Email confirmation to sender.
4. Show success banner.

Guests and logged-in tenants can submit. Tenants get name/email prefilled.

**Done when:** Form stores data and emails fire (or log to mailpit/log locally).

---

### Step 5 — Auth (invite / activate, not public signup)

1. Admin creates tenant (name, email, property).
2. Tenant gets activation link, sets password, verifies email.
3. Login: email + password + password reset.
4. Roles: `admin` and `tenant` only.

Simple tenant home (sidebar): Home, Pay Rent (instructions), My Requests, My Profile, Log out.

**Done when:** Tenant can activate, log in, see only their own requests.

---

### Step 6 — Admin

1. Dashboard with new-request count.
2. Request inbox: filter, attachments, internal note, status (`new` / `in_review` / `closed`).
3. Tenants: create / activate / suspend.
4. Settings: Zelle, private wire copy, hours, manager contact.

**Done when:** Admin can process a request end to end.

---

### Step 7 — QA

1. Feature tests: form submit; tenant A cannot see tenant B.
2. Responsive check vs mockups.
3. README: Laragon runbook + Phase 2 backlog.

---

### Step 8 — WebFix Team license (after product works)

**Do not modify `webfixteam` source.**

In webfixteam **admin UI only:**

1. Product: L&L Tenant Portal, slug `tppms`, type Laravel Application.
2. Package with domain seats.
3. Issue Active license key.

In **TPPMS only:**

1. Env: `WEBFIX_LICENSE_API`, `WEBFIX_LICENSE_SECRET`, `WEBFIX_LICENSE_KEY`, `WEBFIX_LICENSE_ITEM=tppms`, `WEBFIX_LICENSE_VERSION`.
2. Client: POST `/v1/activate`, `/validate`, `/deactivate` with `key`, `domain`, `item`, `version`.
3. Verify HMAC-SHA256 signature.
4. Cache validity; grace if server down.
5. Admin license screen.
6. Middleware `EnsureWebfixLicense` locks the app until valid (except license page + assets).
7. Local: `WEBFIX_LICENSE_BYPASS=true` on Laragon only. Production must be `false`.

**Done when:** Unlicensed production install cannot use the portal; licensed domain can.

---

## Data model (Phase 1)

- `users` — name, email, password, role, phone, status
- `properties` — address, type, image, manager fields
- `requests` — type, subject, body, contact method, status, user/guest, property_id
- `request_attachments`
- `settings` — key/value
- `activity_logs`

---

## Security rules

- HTTPS in production.
- Tenants never see another tenant’s records (policies).
- Private file storage for attachments.
- No card or bank credentials stored.
- Wire details not on the public homepage.

---

## Hosting

- Local: Laragon (`tppms.test` or project vhost).
- Production: VPS/Cloudways, SSL, SMTP, queue worker, backups.

---

## Definition of done (Phase 1)

A guest or tenant can use the branded site, pay via published Zelle instructions, submit a request with a photo, and the manager receives email and can close it in admin. Logged-in tenants see only their data. Production delivery also requires a valid WebFix license for item `tppms`.
