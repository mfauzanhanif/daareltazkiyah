# Project: PPMTQ Daar El Tazkiyah Sumardi (Web Portal, CMS & PSB Online)

## Architecture
- **Framework & Runtime**: Laravel 13.40, PHP 8.5.12 (Laragon Windows)
- **Frontend & UI**: Livewire 4.4.8, Flux UI 2.21, Livewire Blaze 1.0.21, Tailwind CSS v4.3.4
- **Auth & Access Control**: Laravel Fortify 1.41 with RBAC Gates (`super_admin`, `admin_cms`, `admin_psb`)
- **Document & Media**: Barryvdh DomPDF 3.1.2, Maatwebsite Excel 4.0.6, OpenSpout 5.13, Intervention Image 4.4.1
- **Audit & Logging**: Spatie Activitylog 5.1.4
- **Testing**: Pest 5.3.5 (feature & unit tests, SQLite `:memory:` for isolated fast testing)
- **Primary Keys**: ULID across all domain entities

```
+-----------------------------------------------------------------------------------------+
|                                    HTTP ROUTING LAYER                                   |
|   GET / (Landing)   |   GET /berita, /galeri (CMS)   |   GET /psb/* (Admission Portal)  |
+---------------------+--------------------------------+----------------------------------+
          |                            |                                   |
          v                            v                                   v
+---------------------+  +-----------------------------+  +-------------------------------+
|  MODULE R1: LANDING |  |      MODULE R2: CMS         |  |       MODULE R3: PSB ONLINE   |
|---------------------|  |-----------------------------|  |-------------------------------|
| - Hero & Leadership |  | - Public News (Search/Filter|  | - Active Wave & Quota Check   |
| - Visi & Misi Bento |  | - News Detail + OG Meta Tags|  | - 4-Step Multi-Step Form      |
| - Program Comparison|  | - Public Gallery & Lightbox |  | - Atomic ID: PSB-2027-PROG-XXX|
| - Dynamic Fee Sync  |  | - Admin Posts & Categories  |  | - 8-Char Secret Access Token  |
| - Teacher Showcase  |  | - Admin Albums & Multi-Photo|  | - Cek Status & Edit Revision  |
| - News/Gallery Feed |  | - Image Optimization (WebP) |  | - Proof PDF Generator (DomPDF)|
| - Sticky WhatsApp   |  | - Teachers & Settings Admin |  | - Panitia Dashboard & Excel   |
+---------------------+  +-----------------------------+  +-------------------------------+
          |                            |                                   |
          +----------------------------+-----------------------------------+
                                       |
                                       v
         +-----------------------------------------------------------+
         |               SHARED DOMAIN & DATA ACCESS LAYER           |
         | - Models: AdmissionWave, Applicant, Post, Gallery, etc.   |
         | - Enums: UserRole, ProgramType, ApplicationStatus, etc.   |
         | - Disks: 'local' (private documents) vs 'public' (assets) |
         | - Audit Log: Spatie Activitylog on Applicant transitions  |
         +-----------------------------------------------------------+
```

## Feature Inventory
| # | Feature | Description | Milestone | Source |
|---|---------|-------------|-----------|--------|
| 1 | Database & Storage Initialization | Provision MySQL `daareltazkiyah` database and `public/storage` symlink | M1 | DEPLOYMENT §4 |
| 2 | Domain Enums Definition | PHP Backed Enums: `UserRole`, `ProgramType`, `Gender`, `ApplicationStatus`, `PaymentStatus`, `DocumentType`, `PostStatus`, `SettingGroup` | M1 | PRD §7.1 |
| 3 | Core Database Schema & Migrations | 12 ULID tables with foreign keys, indexes, unique constraints, and soft deletes | M1 | PRD §7 |
| 4 | Eloquent Domain Models | Models with casts, relationships, local scopes, and Spatie LogsActivity | M1 | PRD §7 |
| 5 | Database Seeders | SuperAdmin, AdmissionWaves (I & II), SiteSettings, Categories, Teachers, Sample Content | M1 | PRD §7.12 |
| 6 | Fortify & RBAC Gates | Role-based authorization policies (`manage-cms`, `manage-psb`, `manage-settings`) in AppServiceProvider | M1 | PRD §7.1 |
| 7 | Design System Tokens & Typography | Tailwind v4 `@theme` configuration with `#084C27`, `#059669`, `#D97706`, fonts, and `rounded-arch` | M1 | DESIGN §2, §6 |
| 8 | Public Layout & Navigation | Responsive Islamic header, brand logo, navigation links, and announcement banner | M2 | PRD §6.1, DESIGN §10.4 |
| 9 | Hero Section & Pengasuh Arch | Hero banner, Kufic pattern overlay (5%), portrait of Ust. Ahmad Ashil Fadhil with `rounded-arch` and gold hairline | M2 | PRD §6.1, DESIGN §6.2 |
| 10 | Visi & Misi Bento Grid | Institutional vision quote in Playfair Display and 4 mission points with emerald checkmark icons | M2 | PRD §6.1, DESIGN §10.8 |
| 11 | Dynamic Program & Fee Comparison | Comparison cards for MTS (Mukim 24h) and MDTA (Sekolah Sore) with live fee sync from active wave | M2 | PRD §6.1, DESIGN §10.2 |
| 12 | Teachers & Educators Showcase | Dynamic grid/carousel of active teachers loaded from database seeders | M2 | PRD §6.1, DESIGN §10.8 |
| 13 | Latest News Preview Widget | 3-column card grid displaying published articles with category badges and read time | M2 | PRD §6.1, PRD §7.8 |
| 14 | Gallery Preview Grid | Grid preview of latest published photo albums linking to full gallery page | M2 | PRD §6.1, PRD §7.9 |
| 15 | Contact Section & Map Embed | Institution address, contact cards, and Google Maps iframe embed from site settings | M2 | PRD §6.1, PRD §7.11 |
| 16 | Floating WhatsApp CTA Button | 56x56px fixed button with pulsing glow linking to Panitia WhatsApp number from site settings | M2 | PRD §6.1, DESIGN §10.1 |
| 17 | Public News Listing & Filter | Searchable, category-filtered, paginated news list powered by Livewire | M3 | PRD §6.2, DESIGN §11.5 |
| 18 | Public News Detail & OG Tags | Full article view with slug URL, estimated read time, rich text content, and Open Graph tags | M3 | PRD §6.2, DESIGN §11.5 |
| 19 | Post View Tracking | Daily aggregation counter recording article views in `post_views` | M3 | PRD §7.8 |
| 20 | Admin Post CRUD & Rich Text | Management interface for creating, updating, soft-deleting articles with rich text editor | M3 | PRD §6.2 |
| 21 | Post Status & Scheduled Publishing | Support for draft, published, scheduled statuses with `published_at` scheduling | M3 | PRD §6.2 |
| 22 | Admin Category Management | CRUD for news categories with slug generation and parent-child hierarchy | M3 | PRD §7.6 |
| 23 | Public Gallery & Lightbox | Responsive album grid with WebP thumbnails and fullscreen modal lightbox | M3 | PRD §6.2, DESIGN §8.3 |
| 24 | Admin Album & Photo Upload | Management of albums and sequential upload of multiple photos with WebP conversion | M3 | PRD §6.2, PRD §7.9 |
| 25 | Admin Teacher Management | CRUD for teachers, including role title, bio, specialization, and photo upload | M3 | PRD §7.10 |
| 26 | Admin Site Settings Editor | Configuration interface for contact details, social media, bank accounts, tuition fees | M3 | PRD §7.11 |
| 27 | Admission Wave & Quota Detection | Evaluates current date against `admission_waves` date ranges and checks program quotas | M4 | PRD §6.3 |
| 28 | Multi-Step Registration Wizard | 4-step wizard: 1. Program, 2. Student biodata, 3. Parent data, 4. Document uploads | M4 | PRD §6.3, DESIGN §10.5 |
| 29 | NIK Uniqueness per Academic Year | Enforces student NIK uniqueness per academic year across waves and programs | M4 | PRD §6.3, PRD §7.3 |
| 30 | Document & Payment Proof Upload | Sequential upload for Photo, KK, Akta, and Payment proof with 2MB limit and private storage | M4 | PRD §6.3, PRD §7.5 |
| 31 | Atomic Registration Number & Token | Pessimistic-locked unique registration number (`PSB-2027-[PROGRAM]-[NUMBER]`) and 8-char token | M4 | PRD §6.3 |
| 32 | Registration Success Page | Confirmation view displaying registration number, token, copy buttons, and actions | M4 | PRD §6.3, DESIGN §11.3 |
| 33 | Download Registration Proof PDF | Generates official A4 PDF confirmation document containing student and fee details via DomPDF | M4 | PRD §6.3, DESIGN §14.2 |
| 34 | Self-Service Status Check | Public portal querying registration status using registration number and access token (rate limited) | M4 | PRD §6.3, DESIGN §11.4 |
| 35 | Applicant Self-Correction & Edit | Allows editing text and re-uploading documents strictly while in `pending` or `revision_needed` | M4 | PRD §6.3 |
| 36 | Panitia Admission Dashboard | Statistical overview of total applicants, MTS vs MDTA split, wave distribution, status metrics | M5 | PRD §6.3, DESIGN §11.6 |
| 37 | Applicant Management Table | Searchable, filterable (program/wave/status), sorted, paginated table of all applicants | M5 | PRD §6.3, DESIGN §10.6 |
| 38 | Secure Document Inline Review | Viewing uploaded applicant documents via temporary signed URLs (5-minute expiry) | M5 | PRD §8.2 |
| 39 | Status Transition & Audit Trail | Changing application/payment status with notes and Spatie Activitylog audit trail | M5 | PRD §6.3, PRD §5.1 |
| 40 | Applicant Data Export to Excel | Exports active filtered applicant data into `.xlsx` using Maatwebsite Excel | M5 | PRD §6.3, PRD §5.1 |
| 41 | Web-Based Deployment Helper | One-time setup route `POST /system-setup` executing migrations, storage link, optimizations | M6 | PRD §5.2, DEPLOYMENT §6 |
| 42 | E2E Testing Suite (Tiers 1-4) | Comprehensive opaque-box and feature tests covering all requirements | M6 | ORIGINAL_REQUEST §Acceptance |
| 43 | Adversarial Coverage Hardening (Tier 5) | White-box stress tests, edge case verification, boundary validation | M6 | Pattern Requirement |

## Milestones
| # | Name | Scope | Dependencies | Status |
|---|------|-------|-------------|--------|
| M1 | Domain Foundation & Architecture Setup | Database schema, ULID migrations, Enums, Models, Seeders, Fortify RBAC, Tailwind v4 design tokens | None | DONE |
| M2 | Module R1: Landing Page & Visual Identity | Public master layout, Hero with arch, Visi-Misi bento, Dynamic program/fee comparison, Teachers, News/Gallery widgets, WhatsApp button | M1 | DONE |
| M3 | Module R2: CMS Berita, Galeri & Admin Content | Public news listing/detail with OG tags, Public gallery & lightbox, Admin Posts/Categories/Galleries/Teachers/Settings CRUD | M1 | DONE |
| M4 | Module R3: Sistem PSB Online (Public Portal) | Wave auto-detection, Multi-step wizard, NIK uniqueness validation, Atomic ID & token generator, PDF proof, Cek Status & Edit | M1 | DONE |
| M5 | Module R3 Admin: PSB Dashboard & Reporting | Panitia dashboard, applicant management table, document preview with signed URLs, status updates, ActivityLog, Excel export | M1, M4 | IN_PROGRESS |
| M6 | Final Milestone: Full E2E Pass, Hardening & Deployment Helper | Pass 100% E2E test suite (Tiers 1-4), Tier 5 adversarial hardening, POST /system-setup helper, final asset compilation | M1, M2, M3, M4, M5 | PLANNED |

## Interface Contracts

### M1 Foundation ↔ M2 Landing Page
- `AdmissionWave::currentActive(): ?AdmissionWave` — Returns active wave for fee comparison.
- `SiteSetting::get(string $key, mixed $default = null): mixed` — Cached site settings.
- `Teacher::active(): Builder` — Active teachers ordered by `sort_order`.
- `Post::published(): Builder` — Published posts with `published_at <= now()`.
- `Gallery::published(): Builder` — Published galleries with `photos` relationship.

### M1 Foundation ↔ M3 CMS
- `Post::publishSchedule(): void` — Publishes scheduled posts when `published_at <= now()`.
- `PostView::recordView(string $postId): void` — Records daily aggregated view.
- Gates: `can('manage-cms')` for posts, categories, galleries, teachers.

### M1 Foundation ↔ M4 PSB Online
- `RegistrationService::register(array $data): Applicant` — Atomic creation within DB transaction with pessimistic lock.
- `RegistrationNumberService::generate(ProgramType $program): string` — Format: `PSB-2027-[PROGRAM]-[NUMBER]`.
- `TokenService::generate(): string` — 8-character uppercase alphanumeric string.
- `PdfService::generateProof(Applicant $applicant): Response` — Generates DomPDF stream.
- Form validation: `UniqueNikPerAcademicYear` rule.

### M4 PSB Online ↔ M5 PSB Admin
- Status modification: `Applicant::updateStatus(ApplicationStatus $status, ?string $notes = null): void` — Triggers Spatie Activitylog with causer.
- Signed URLs: `URL::temporarySignedRoute('admin.psb.document', now()->addMinutes(5), ['document' => $doc->id])`.
- Export: `App\Exports\ApplicantsExport(Builder $query)` via `Maatwebsite\Excel`.

## Code Layout
- `app/Enums/`: PHP Backed Enums (`UserRole`, `ProgramType`, `Gender`, `ApplicationStatus`, `PaymentStatus`, `DocumentType`, `PostStatus`, `SettingGroup`)
- `app/Models/`: Eloquent Models (`User`, `AdmissionWave`, `Applicant`, `ApplicantParent`, `ApplicantDocument`, `Category`, `Post`, `PostView`, `Gallery`, `GalleryPhoto`, `Teacher`, `SiteSetting`)
- `app/Services/`: Domain Services (`RegistrationService`, `RegistrationNumberService`, `PdfService`, `ImageService`)
- `app/Exports/`: Excel Export Classes (`ApplicantsExport`)
- `app/Livewire/`: Livewire Components for Public & Admin interfaces
  - `app/Livewire/Public/`: `LandingPage`, `NewsIndex`, `NewsDetail`, `GalleryIndex`, `PsbRegistration`, `PsbCheckStatus`
  - `app/Livewire/Admin/`: `PsbDashboard`, `ApplicantList`, `ApplicantDetail`, `PostManager`, `CategoryManager`, `GalleryManager`, `TeacherManager`, `SettingManager`
- `app/Rules/`: Custom Validation Rules (`UniqueNikPerAcademicYear`)
- `database/migrations/`: ULID-based database migrations
- `database/seeders/`: Database seeders (`SuperAdminSeeder`, `AdmissionWaveSeeder`, `SiteSettingSeeder`, `CategorySeeder`, `TeacherSeeder`, `SampleContentSeeder`)
- `resources/css/app.css`: Tailwind v4 theme configuration and custom styling
- `resources/views/`:
  - `layouts/`: `public.blade.php`, `admin.blade.php`, `pdf/`
  - `livewire/`: Blade views matching Livewire components
- `tests/Feature/`: Pest Feature Test Suite
- `tests/Unit/`: Pest Unit Test Suite
