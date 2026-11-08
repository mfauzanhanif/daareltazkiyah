# PPMTQ Daar El Tazkiyah Sumardi — E2E Test Infrastructure & Specification

## 1. Test Philosophy

The testing framework for PPMTQ Daar El Tazkiyah Sumardi adheres to three fundamental tenets:

1. **Opaque-Box Testing**:
   Tests interact with the application strictly from the exterior — via HTTP requests, Livewire component interactions, public contracts, DOM/HTML inspection, database state verification, and storage/download assertions. Tests do not rely on private internal methods, ensuring tests remain valid through refactorings.

2. **Requirement-Driven Assertions**:
   Every assertion, boundary value, and validation expectation is derived directly from authoritative specification documents:
   - `docs/PRD.md` (Product Requirements Document v1.1)
   - `docs/DESIGN.md` (Design System v1.1)
   - `PROJECT.md` (System Architecture & Feature Inventory)
   - `ORIGINAL_REQUEST.md` (Authoritative Client Mandate)

3. **Progressive Testability & Tiered Architecture**:
   Tests are segregated into 4 progressive tiers. As milestones M1 through M5 are developed, corresponding tiers and feature modules become testable incrementally, culminating in the comprehensive end-to-end acceptance in M6.

---

## 2. Test Architecture & Directory Layout

The E2E test suite resides exclusively in `tests/Feature/E2E/`:

```
tests/Feature/E2E/
├── Tier1_FeatureCoverage/              # Happy-path isolation tests for every requirement
│   ├── LandingPageFeatureTest.php      # R1: Hero, Visi-Misi, Programs, Teachers, Widgets, WhatsApp
│   ├── NewsPublicFeatureTest.php       # R2: Search, category filter, pagination, slug, OG tags
│   ├── GalleryPublicFeatureTest.php    # R2: Responsive album grid, photos, lightbox data
│   ├── PsbRegistrationFeatureTest.php  # R3: 4-step wizard, atomic reg number, 8-char token
│   ├── PsbStatusCheckFeatureTest.php   # R3: Status check portal, applicant self-correction/edit
│   ├── AdminCmsFeatureTest.php         # R2: Post CRUD, category CRUD, gallery CRUD, teacher CRUD
│   └── AdminPsbFeatureTest.php         # R3: Panitia dashboard, applicant management, status updates
│
├── Tier2_BoundaryEdgeCases/            # Limits, invalid inputs, security, boundary stress
│   ├── DuplicateNikValidationTest.php  # NIK uniqueness per academic year across waves & programs
│   ├── ClosedAdmissionWaveTest.php     # Date ranges (before, between, after waves), no active wave
│   ├── QuotaExhaustionTest.php         # max_quota_mts & max_quota_mdta full limit handling
│   ├── DocumentUploadLimitsTest.php    # >2MB rejection, invalid MIME types, double extensions
│   ├── RateLimitingSecurityTest.php    # Registration (5/hr), Status check (10/hr), System setup (3/hr)
│   └── AuthorizationBoundaryTest.php   # RBAC gates: super_admin, admin_cms, admin_psb, guest redirects
│
├── Tier3_CrossFeatureInteractions/     # Dynamic synchronization and multi-module state transitions
│   ├── WaveChangeFeeSyncTest.php       # Active wave change immediately updating Landing Page & Form fees
│   ├── StatusTransitionEditLockTest.php# Editing allowed on pending/revision_needed, locked on verified
│   ├── ScheduledPostPublishingTest.php # Scheduler transition of scheduled articles to published at published_at
│   └── ActivityLogAuditTrailTest.php   # Spatie Activitylog tracking causer admin, old/new status, notes
│
└── Tier4_RealWorldScenarios/           # Complete end-to-end user journeys
    ├── ParentRegistrationJourneyTest.php # Landing -> Fee Check -> Multi-step Reg -> PDF Proof -> Status Check
    └── AdminVerificationAndExportJourneyTest.php # Login -> Review -> Notes & Status -> Audit -> Excel Export
```

---

## 3. Feature Inventory Coverage Matrix

| Feature # | Feature Name | Requirement Ref | Test File | Test Tier |
|:---:|:---|:---:|:---|:---:|
| 1-6 | Database, Enums, Models, Seeders, Fortify RBAC | M1 / PRD §7 | `Tier2_BoundaryEdgeCases/AuthorizationBoundaryTest.php` | Tier 2 |
| 7-10 | Brand Tokens, Hero Arch, Visi-Misi Bento | R1 / DESIGN §2, 6, 10 | `Tier1_FeatureCoverage/LandingPageFeatureTest.php` | Tier 1 |
| 11 | Dynamic Program & Fee Comparison | R1 / PRD §6.1 | `Tier1_FeatureCoverage/LandingPageFeatureTest.php` | Tier 1 |
| 12-14 | Teachers Showcase, News/Gallery Previews | R1 / PRD §6.1 | `Tier1_FeatureCoverage/LandingPageFeatureTest.php` | Tier 1 |
| 15-16 | Contact Section & Floating WhatsApp CTA | R1 / PRD §6.1 | `Tier1_FeatureCoverage/LandingPageFeatureTest.php` | Tier 1 |
| 17-18 | Public News Search, Filter, Detail & OG Tags | R2 / PRD §6.2 | `Tier1_FeatureCoverage/NewsPublicFeatureTest.php` | Tier 1 |
| 19 | Post View Daily Aggregated Tracking | R2 / PRD §7.8 | `Tier1_FeatureCoverage/NewsPublicFeatureTest.php` | Tier 1 |
| 20-22 | Admin Posts, Categories & Rich Text | R2 / PRD §6.2 | `Tier1_FeatureCoverage/AdminCmsFeatureTest.php` | Tier 1 |
| 23-24 | Public & Admin Gallery with Lightbox | R2 / PRD §6.2 | `Tier1_FeatureCoverage/GalleryPublicFeatureTest.php` | Tier 1 |
| 25-26 | Admin Teachers & Site Settings CRUD | R2 / PRD §7.10-11 | `Tier1_FeatureCoverage/AdminCmsFeatureTest.php` | Tier 1 |
| 27 | Admission Wave & Quota Detection | R3 / PRD §6.3 | `Tier2_BoundaryEdgeCases/ClosedAdmissionWaveTest.php` | Tier 2 |
| 28 | Multi-Step Registration Wizard (4 Steps) | R3 / PRD §6.3 | `Tier1_FeatureCoverage/PsbRegistrationFeatureTest.php` | Tier 1 |
| 29 | NIK Uniqueness per Academic Year | R3 / PRD §6.3, 7.3 | `Tier2_BoundaryEdgeCases/DuplicateNikValidationTest.php` | Tier 2 |
| 30 | Document & Payment Proof Upload (2MB limit) | R3 / PRD §6.3, 7.5 | `Tier2_BoundaryEdgeCases/DocumentUploadLimitsTest.php` | Tier 2 |
| 31-32 | Atomic ID (`PSB-2027-...`) & 8-Char Token | R3 / PRD §6.3 | `Tier1_FeatureCoverage/PsbRegistrationFeatureTest.php` | Tier 1 |
| 33 | Download Registration Proof PDF (DomPDF) | R3 / PRD §6.3 | `Tier1_FeatureCoverage/PsbRegistrationFeatureTest.php` | Tier 1 |
| 34-35 | Self-Service Status Check & Applicant Edit | R3 / PRD §6.3 | `Tier1_FeatureCoverage/PsbStatusCheckFeatureTest.php` | Tier 1 |
| 36-37 | Panitia Dashboard & Applicant Table | R3 / PRD §6.3 | `Tier1_FeatureCoverage/AdminPsbFeatureTest.php` | Tier 1 |
| 38 | Secure Document Review (Signed URLs) | R3 / PRD §8.2 | `Tier1_FeatureCoverage/AdminPsbFeatureTest.php` | Tier 1 |
| 39 | Status Transition & Spatie ActivityLog | R3 / PRD §6.3, 5.1 | `Tier3_CrossFeatureInteractions/ActivityLogAuditTrailTest.php` | Tier 3 |
| 40 | Applicant Data Export to Excel (`.xlsx`) | R3 / PRD §6.3, 5.1 | `Tier1_FeatureCoverage/AdminPsbFeatureTest.php` | Tier 1 |
| 41 | Web-Based Deployment Helper (`POST /system-setup`) | R4 / PRD §5.2 | `Tier2_BoundaryEdgeCases/RateLimitingSecurityTest.php` | Tier 2 |
| 42-43 | Comprehensive E2E & Real-World Journeys | R1-R4 / All | `Tier4_RealWorldScenarios/*` | Tier 4 |

---

## 4. Test Runner Invocation & Commands

The project uses **Pest 5** with Laravel testing plugins and SQLite `:memory:` database.

### 4.1 Running the Complete E2E Suite
```bash
vendor/bin/pest tests/Feature/E2E
```
or via Artisan:
```bash
php artisan test tests/Feature/E2E
```

### 4.2 Running Specific Tiers
```bash
# Tier 1: Feature Coverage
vendor/bin/pest tests/Feature/E2E/Tier1_FeatureCoverage

# Tier 2: Boundary & Edge Cases
vendor/bin/pest tests/Feature/E2E/Tier2_BoundaryEdgeCases

# Tier 3: Cross-Feature Interactions
vendor/bin/pest tests/Feature/E2E/Tier3_CrossFeatureInteractions

# Tier 4: Real-World Scenarios
vendor/bin/pest tests/Feature/E2E/Tier4_RealWorldScenarios
```

### 4.3 Running Single Feature Tests
```bash
vendor/bin/pest tests/Feature/E2E/Tier1_FeatureCoverage/LandingPageFeatureTest.php
vendor/bin/pest tests/Feature/E2E/Tier1_FeatureCoverage/PsbRegistrationFeatureTest.php
vendor/bin/pest tests/Feature/E2E/Tier4_RealWorldScenarios/ParentRegistrationJourneyTest.php
```

---

## 5. Real-World Application Scenarios (Tier 4)

### Scenario 1: Complete Parent Registration Journey (`ParentRegistrationJourneyTest.php`)
1. **Visit Landing Page**: Parent visits `GET /`. System verifies brand colors, Islamic arch framing, Pengasuh portrait, Visi-Misi bento cards, and program comparison.
2. **Dynamic Fee Verification**: Verifies active Gelombang I fees (MTS: Rp 100.000, MDTA: Rp 25.000) and SPP (MTS: Rp 500.000, MDTA: Rp 12.000).
3. **Navigate to Registration**: Parent clicks CTA and lands on `GET /psb`.
4. **Step 1 - Program**: Selects `MTS - Mukim 24 Jam`.
5. **Step 2 - Student Biodata**: Enters full name, valid 16-digit NIK, 10-digit NISN, birth date/place, gender `L`, child order, previous school, address.
6. **Step 3 - Parent Details**: Enters father name, mother name, jobs, income range, active WhatsApp number, address.
7. **Step 4 - Document Upload**: Uploads Photo (3x4), Kartu Keluarga, Akta Kelahiran, and Transfer Receipt (all valid <= 2MB).
8. **Atomic Generation**: Asserts generated registration number matches `PSB-2027-MTS-XXXX` and secret token is 8 alphanumeric characters.
9. **Proof PDF Generation**: Parent downloads proof PDF via `GET /psb/bukti/{registration_number}`. Asserts PDF headers (`application/pdf`) and content.
10. **Self-Service Status Verification**: Parent visits `GET /psb/status`, authenticates with registration number + token, and confirms initial status is `pending`.

### Scenario 2: Complete Panitia Verification & Export Journey (`AdminVerificationAndExportJourneyTest.php`)
1. **Admin Authentication**: Admin logs in with `admin_psb` credentials via Fortify.
2. **Access Dashboard**: Panitia views `GET /admin/psb`, verifying statistics counters (total applicants, MTS vs MDTA split, wave metrics).
3. **Manage Applicants**: Navigates to applicant list, searches by NIK / name, filters by program `MTS` and status `pending`.
4. **Document Inspection**: Inspects uploaded KK and payment proof via temporary signed URLs (valid 5 minutes).
5. **Request Revision**: Panitia sets status to `revision_needed` with note: *"Foto Kartu Keluarga buram, mohon unggah ulang."*
6. **Parent Revision**: Parent logs into Cek Status, sees the revision note, re-uploads valid KK, and resubmits. Status reverts to `pending`.
7. **Final Verification**: Panitia reviews resubmission, updates `payment_status` to `paid` and `application_status` to `verified`.
8. **Audit Trail Verification**: System checks `activity_log` table, confirming every status change, causer ID, old/new attributes, and notes are immutably logged.
9. **Data Export**: Panitia executes Excel export. Asserts downloaded `.xlsx` binary stream contains the verified applicant records.

---

## 6. Coverage & Quality Thresholds

- **Requirement Coverage**: 100% of functional requirements (R1, R2, R3, R4) mapped and tested.
- **Strict Typing**: All test files must declare `declare(strict_types=1);`.
- **Database & Storage Isolation**: SQLite `:memory:` and `Storage::fake('private')` on every run.
- **Zero Facade Policy**: Every test executes genuine HTTP requests, Livewire lifecycle actions, or Eloquent queries asserting concrete state and responses.
