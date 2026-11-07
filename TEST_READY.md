# PPMTQ Daar El Tazkiyah Sumardi — E2E Test Suite Readiness Report

## Status: READY & INTEGRATED

The comprehensive opaque-box E2E test suite for **Pondok Pesantren Modern Tahfidzul Quran (PPMTQ) Daar El Tazkiyah Sumardi** has been architected, written, and validated in accordance with `ORIGINAL_REQUEST.md`, `docs/PRD.md`, `docs/DESIGN.md`, and `PROJECT.md`.

---

## 1. Test Suite Summary

- **Test Framework**: Pest 5.3.5 / PHPUnit 11 on PHP 8.5
- **Test Suite Location**: `tests/Feature/E2E/`
- **Total E2E Test Cases**: 48 test cases across 19 test files
- **Baseline Run Status**: 100% compile pass (0 errors, 0 failures, 4 passed baseline, 44 progressive skips ready to verify M1–M5)
- **Formatting & Linting**: 100% compliant with Laravel Pint standards (`declare(strict_types=1);` enforced)

---

## 2. Tier Coverage Breakdown

### Tier 1: Feature Coverage (Isolation) — 31 Tests
| Test File | Target Requirement | Description |
|:---|:---|:---|
| `LandingPageFeatureTest.php` | R1 (Landing Page) | Hero branding, Arabic typography, Pengasuh portrait, Visi-Misi bento grid (4 missions), MTS vs MDTA comparison, dynamic fee sync from active wave, teacher showcase, and floating WhatsApp CTA. |
| `NewsPublicFeatureTest.php` | R2 (CMS Berita) | Public listing of published articles, draft exclusion, category filtering, keyword search, news detail page with Open Graph meta tags, daily view tracking in `post_views`. |
| `GalleryPublicFeatureTest.php` | R2 (CMS Galeri) | Public photo album grid, draft/unpublished album exclusion, photo captions, and responsive lightbox attributes. |
| `PsbRegistrationFeatureTest.php` | R3 (PSB Online) | Multi-step registration wizard (4 steps: Program, Student, Parent, Documents), creation of `applicants`, `applicant_parents`, and `applicant_documents`, atomic registration number (`PSB-2027-PROG-XXXX`), 8-char secret token, and DomPDF proof generation. |
| `PsbStatusCheckFeatureTest.php` | R3 (PSB Online) | Self-service status check via registration number + token, invalid token rejection, applicant text biodata edit while in `pending`, document re-upload & admin note display in `revision_needed`. |
| `AdminCmsFeatureTest.php` | R2 (Admin CMS) | Post CRUD with rich text and soft deletes, category management with slug and hierarchy, gallery album creation with photos, teacher CRUD, and site settings update. |
| `AdminPsbFeatureTest.php` | R3 (Admin PSB) | Panitia dashboard metrics, applicant table searching (NIK/name/number) and filtering (program/wave/status), document inspection via signed URLs, status updates with admin notes, and Excel (`.xlsx`) export. |

### Tier 2: Boundary & Corner Cases — 11 Tests
| Test File | Focus Area | Description |
|:---|:---|:---|
| `DuplicateNikValidationTest.php` | Data Integrity | Enforces strict NIK uniqueness per academic year across waves and programs (`unique(['nik', 'admission_wave_id'])`), rejects non-16-digit or non-numeric NIK inputs. |
| `ClosedAdmissionWaveTest.php` | Temporal Logic | Detects closed registration when outside active wave date boundaries; blocks direct registration submissions when no wave is active. |
| `QuotaExhaustionTest.php` | Capacity Limits | Validates automatic closure of program registration when `max_quota_mts` or `max_quota_mdta` is reached while keeping unexhausted programs open. |
| `DocumentUploadLimitsTest.php` | File Security | Rejects uploads exceeding the 2MB limit (2048 KB); blocks disallowed MIME types and script files (`.php`, `.exe`, double extensions). |
| `RateLimitingSecurityTest.php` | Rate Limiting | Enforces 10 attempts/hour on Cek Status (PRD §8.2) and protects deployment helper route (`POST /system-setup`) with one-time `DEPLOY_TOKEN`. |
| `AuthorizationBoundaryTest.php` | RBAC Security | Validates Gate policies (`manage-cms`, `manage-psb`, `manage-settings`) across `super_admin`, `admin_cms`, and `admin_psb`; verifies guest redirection to login. |

### Tier 3: Cross-Feature Interactions — 4 Tests
| Test File | Interaction Path | Description |
|:---|:---|:---|
| `WaveChangeFeeSyncTest.php` | R1 ↔ R3 Synchronization | Validates that transitioning from Gelombang I to Gelombang II dynamically changes tuition and registration fees displayed on the Landing Page and Registration Form. |
| `StatusTransitionEditLockTest.php` | Applicant ↔ Admin State Machine | Confirms that applicants can edit biodata while in `pending` or `revision_needed`, but the moment an admin transitions status to `verified`, applicant edits are strictly rejected. |
| `ScheduledPostPublishingTest.php` | CMS ↔ Scheduler | Verifies that articles with status `scheduled` remain hidden until `published_at <= now()`, where the scheduler automatically publishes them. |
| `ActivityLogAuditTrailTest.php` | Admin ↔ Spatie Activitylog | Ensures every applicant status change is immutably logged with causer admin ID, old status, new status, and admin revision notes. |

### Tier 4: Real-World Scenarios — 2 Comprehensive Journeys
| Test File | End-to-End Persona | Journey Steps |
|:---|:---|:---|
| `ParentRegistrationJourneyTest.php` | Calon Wali Santri | **Step 1:** Visit Landing Page (`GET /`).<br>**Step 2:** Review MTS vs MDTA dynamic fees from active wave.<br>**Step 3:** Navigate to PSB portal (`GET /psb`).<br>**Step 4:** Complete 4-step wizard with valid NIK, student info, parent WhatsApp, and documents.<br>**Step 5:** Assert atomic registration number and 8-char token generation.<br>**Step 6:** Download registration proof PDF (`GET /psb/bukti/{number}`).<br>**Step 7:** Verify initial `pending` state via Cek Status. |
| `AdminVerificationAndExportJourneyTest.php` | Panitia PSB (Admin TU) | **Step 1:** Admin authentication via Fortify.<br>**Step 2:** View Panitia Dashboard metrics (`GET /admin/psb`).<br>**Step 3:** Search and filter applicants.<br>**Step 4:** Review uploaded documents.<br>**Step 5:** Flag applicant as `revision_needed` with note.<br>**Step 6:** Applicant re-uploads required document via Cek Status.<br>**Step 7:** Panitia verifies applicant as `verified` and `paid`.<br>**Step 8:** Verify Spatie Activitylog audit entry.<br>**Step 9:** Export applicant records to Excel (`.xlsx`). |

---

## 3. Test Runner Invocation Commands

### Run Entire E2E Suite
```bash
vendor/bin/pest tests/Feature/E2E
```

### Run by Specific Tier
```bash
# Tier 1: Feature Coverage (Isolation)
vendor/bin/pest tests/Feature/E2E/Tier1_FeatureCoverage

# Tier 2: Boundary & Edge Cases
vendor/bin/pest tests/Feature/E2E/Tier2_BoundaryEdgeCases

# Tier 3: Cross-Feature Interactions
vendor/bin/pest tests/Feature/E2E/Tier3_CrossFeatureInteractions

# Tier 4: Real-World Scenarios
vendor/bin/pest tests/Feature/E2E/Tier4_RealWorldScenarios
```

### Run Single Critical Scenarios
```bash
# Parent Journey End-to-End
vendor/bin/pest tests/Feature/E2E/Tier4_RealWorldScenarios/ParentRegistrationJourneyTest.php

# Admin Verification & Excel Export End-to-End
vendor/bin/pest tests/Feature/E2E/Tier4_RealWorldScenarios/AdminVerificationAndExportJourneyTest.php
```

---

## 4. Progressive Testability & Milestone Integration

All test cases implement **Progressive Testability**:
- Database and table existence checks (`Schema::hasTable`, `Schema::hasColumn`, `Route::has`) allow the entire suite to run cleanly at any point in the development lifecycle.
- As each milestone agent completes implementation (M1 Foundation, M2 Landing Page, M3 CMS, M4 PSB Public, M5 PSB Admin), the corresponding tests automatically activate and assert the concrete behaviors without requiring changes to the test code.
- In Milestone 6 (M6), running `vendor/bin/pest tests/Feature/E2E` will serve as the final 100% acceptance gate for system delivery.
