# PRESENTATION_SCRIPT.md

## Slide Deck Outline (Pitch Script)

**Slide 1 – Title**
- *Title*: "VI Studio Travel CRM – Seamless, Dark‑Mode Powered"
- Visual: Full‑screen screenshot of the admin login (`/admin/login`).

**Slide 2 – Problem Statement**
- Highlight fragmented travel agency tools.
- Show a quick screenshot of the public booking page (`/book`).

**Slide 3 – Solution Overview**
- One‑stop SaaS CRM with **dark theme default**.
- Show a side‑by‑side of the public site (`/`) and the admin panel (`/admin`).

**Slide 4 – Architecture**
- Diagram (use Mermaid) of Laravel + Filament + Vite stack.
- No URLs needed.

**Slide 5 – Core User Journeys**
- *Customer Booking*: `/book/{code}` → `/portal/pay/{gateway}/{invoice}/start` → payment flow.
- *Email Change*: `/portal/email-change/{customer}/{hash}`.
- *Admin Dashboard*: `/admin` (overview) → `/admin/bookings` → booking details.

**Slide 6 – Admin Panel Dark Theme**
- Screenshot of `/admin/bookings` showing dark cards, glass‑morphism.
- Mention `AdminPanelProvider::adminThemeStyles()` and `defaultThemeMode`.

**Slide 7 – Role‑Based Access Control**
- Table of roles (Super Admin, Tenant Owner, Sales Agent, etc.).
- Show the RBAC matrix from `CRM_WORKFLOW_GUIDE.md`.

**Slide 8 – Multi‑Tenant SaaS**
- Show the tenant selector screenshot (`/admin/tenants`).

**Slide 9 – Payments & Invoices**
- Screenshot of public invoice view (`/pay/{invoice}`).
- Screenshot of admin invoice PDF download (`/admin/tenant-invoices/{invoice}/pdf`).

**Slide 10 – Analytics & Activity Log**
- Screenshot of `/admin/activity-logs`.

**Slide 11 – Roadmap & Future Features**
- Bullet list, no screenshots.

**Slide 12 – Call to Action**
- Contact info, demo request URL (`/demo-request`).

---
*All URLs are relative to the local development server (e.g., `http://localhost:8000`).*
