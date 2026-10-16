# WORKFLOW_VERIFICATION_CHECKLIST.md

## Overview
A concise checklist to validate that the Travel Agency CRM is fully functional after applying the dark‑theme refactor and ensuring all routes, seeders, and UI components work as expected.

---
### 1. Environment Setup
- [ ] Run `composer install --no-interaction`.
- [ ] Run `npm ci` (or `npm install --no-interaction`).
- [ ] Execute database migrations: `php artisan migrate --force`.
- [ ] Seed the database: `php artisan db:seed --class=PermissionSeeder` (and any other seeders you require).
- [ ] Clear caches: `php artisan view:clear`, `php artisan config:clear`, `php artisan cache:clear`.
- [ ] Build assets: `npm run build`.

---
### 2. Route Verification
| Scope | Command | Expected Outcome |
|-------|---------|------------------|
| Web routes | `php artisan route:list --path=admin` | All Filament admin routes (`/admin/*`) are listed and use the **dark** theme (no `bg‑white`). |
| Public site | `php artisan route:list --path=book` | `/book`, `/book/{code}` routes exist and point to `PackageBookingController`. |
| Customer portal | `php artisan route:list --path=portal/email-change` | Routes `GET /portal/email-change/{customer}/{hash}` and `POST …` exist and use the `customer` guard. |
| API | `php artisan route:list --path=api/v1` | `/api/v1/packages`, `/api/v1/inquiries`, `/api/v1/departures/{departure}/waitlist` are present.

---
### 3. Seeder Verification
- [ ] Verify **Super Admin** user exists: `php artisan tinker --execute "App\Models\User::where('email', 'admin@example.com')->first();"`
- [ ] Verify **Tenant Owner** role and permissions are seeded for each tenant.
- [ ] Confirm demo data (countries, packages, etc.) is present by checking a few records via Tinker or DB client.

---
### 4. Dark‑Mode UI Validation
1. **Admin Panel** (`/admin/login`)
   - Open the login page in a browser.
   - Ensure background is dark (`--vi-dark-bg`) and no white containers are visible.
   - Verify the custom gradient and glass‑morphism effects load.
2. **Admin Dashboard** (`/admin`)
   - All cards, tables, and modals should use the dark CSS variables (`var(--bg-card)`, `var(--ink)`, etc.).
   - Check the sidebar, top‑bar, and buttons for the neon‑purple/cyan styling.
3. **Public Site & Portal**
   - Visit `/` and `/book` – background should be dark with the same variable palette.
   - Open a booking flow and the payment page (`/portal/pay/...`) – verify no `bg‑white` classes remain.
   - Open the email‑change page (`/portal/email-change/...`) – confirm dark styling.
4. **Responsive Checks**
   - Resize the browser to mobile width; the dark theme must persist.
   - Verify the scrollbar styles and micro‑animations work.

---
### 5. Functional Tests (Pest)
- Run the entire test suite: `php artisan test --compact`.
- Ensure all feature tests that involve routes, authentication, and UI rendering pass.
- If any test fails, investigate the failing route or view.

---
### 6. Final Sign‑Off
- [ ] All checklist items marked ✅.
- [ ] Screenshots captured for login, dashboard, and a public page (optional for documentation).
- [ ] Commit changes and push to the repository.

---
*Generated on* **2026‑10‑16** *by Antigravity.*
