---
name: Modern Islamic Emerald & Gold
version: '1.1'
updated: 2026-11-07
reference: ./PRD.md (Section 4 — Design System)
colors:
  # --- Brand Core ---
  brand-forest: '#084C27'
  emerald-vibrant: '#059669'
  gold-amber: '#D97706'
  gold-light: '#F59E0B'

  # --- Surfaces ---
  surface-alabaster: '#FDFBF7'
  surface-card: '#FFFFFF'
  surface-slate: '#F8FAFC'

  # --- Text ---
  text-primary: '#0F291E'
  text-secondary: '#1B3A2B'
  text-muted: '#4B6358'
  text-inverse: '#FFFFFF'

  # --- Borders ---
  border-subtle: rgba(8, 76, 39, 0.10)
  border-medium: rgba(8, 76, 39, 0.20)
  border-strong: rgba(8, 76, 39, 0.35)

  # --- Material Design 3 System Tokens ---
  surface: '#fbf9f5'
  surface-dim: '#dbdad6'
  surface-bright: '#fbf9f5'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f5f3ef'
  surface-container: '#efeeea'
  surface-container-high: '#eae8e4'
  surface-container-highest: '#e4e2de'
  on-surface: '#1b1c1a'
  on-surface-variant: '#404941'
  inverse-surface: '#30312e'
  inverse-on-surface: '#f2f0ed'
  outline: '#707970'
  outline-variant: '#c0c9be'
  surface-tint: '#2d6a42'
  primary: '#003317'
  on-primary: '#ffffff'
  primary-container: '#084c27'
  on-primary-container: '#7dbc8c'
  inverse-primary: '#95d5a4'
  secondary: '#006c4a'
  on-secondary: '#ffffff'
  secondary-container: '#82f5c1'
  on-secondary-container: '#00714e'
  tertiary: '#462200'
  on-tertiary: '#ffffff'
  tertiary-container: '#663500'
  on-tertiary-container: '#fe942c'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#b0f2be'
  primary-fixed-dim: '#95d5a4'
  on-primary-fixed: '#00210d'
  on-primary-fixed-variant: '#11512c'
  secondary-fixed: '#85f8c4'
  secondary-fixed-dim: '#68dba9'
  on-secondary-fixed: '#002114'
  on-secondary-fixed-variant: '#005137'
  tertiary-fixed: '#ffdcc3'
  tertiary-fixed-dim: '#ffb77d'
  on-tertiary-fixed: '#2f1500'
  on-tertiary-fixed-variant: '#6e3900'
  background: '#fbf9f5'
  on-background: '#1b1c1a'
  surface-variant: '#e4e2de'

  # --- Semantic / Functional ---
  success: '#059669'
  success-bg: rgba(5, 150, 105, 0.12)
  warning: '#D97706'
  warning-bg: rgba(217, 119, 6, 0.12)
  info: '#0284C7'
  info-bg: rgba(2, 132, 199, 0.12)
  error-semantic: '#DC2626'
  error-bg: rgba(220, 38, 38, 0.10)

  # --- PSB Status Mapping ---
  status-pending: '#6B7280'
  status-pending-bg: rgba(107, 114, 128, 0.12)
  status-verified: '#059669'
  status-verified-bg: rgba(5, 150, 105, 0.12)
  status-revision: '#D97706'
  status-revision-bg: rgba(217, 119, 6, 0.12)
  status-accepted: '#084C27'
  status-accepted-bg: rgba(8, 76, 39, 0.12)
  status-reserve: '#6366F1'
  status-reserve-bg: rgba(99, 102, 241, 0.12)
  status-rejected: '#DC2626'
  status-rejected-bg: rgba(220, 38, 38, 0.10)
  status-unpaid: '#6B7280'
  status-unpaid-bg: rgba(107, 114, 128, 0.12)
  status-paid: '#059669'
  status-paid-bg: rgba(5, 150, 105, 0.12)

typography:
  arabic-banner:
    fontFamily: Amiri, Scheherazade New, serif
    fontSize: 28px
    fontWeight: '400'
    lineHeight: '1.8'
    letterSpacing: 0
    note: 'line-height 1.8em prevents diacritic clipping on harakat/tashkeel'
  arabic-banner-mobile:
    fontFamily: Amiri, Scheherazade New, serif
    fontSize: 20px
    fontWeight: '400'
    lineHeight: '1.8'
  display-hero:
    fontFamily: Playfair Display, serif
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  display-hero-mobile:
    fontFamily: Playfair Display, serif
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-lg:
    fontFamily: Plus Jakarta Sans, sans-serif
    fontSize: 36px
    fontWeight: '800'
    lineHeight: 44px
    letterSpacing: -0.02em
  headline-lg-mobile:
    fontFamily: Plus Jakarta Sans, sans-serif
    fontSize: 26px
    fontWeight: '700'
    lineHeight: 34px
    letterSpacing: -0.01em
  headline-md:
    fontFamily: Plus Jakarta Sans, sans-serif
    fontSize: 24px
    fontWeight: '700'
    lineHeight: 32px
    letterSpacing: -0.01em
  headline-sm:
    fontFamily: Plus Jakarta Sans, sans-serif
    fontSize: 20px
    fontWeight: '700'
    lineHeight: 28px
  title-editorial:
    fontFamily: Playfair Display, serif
    fontSize: 22px
    fontWeight: '600'
    lineHeight: 30px
    letterSpacing: -0.01em
  body-lg:
    fontFamily: Plus Jakarta Sans, sans-serif
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Plus Jakarta Sans, sans-serif
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Plus Jakarta Sans, sans-serif
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Plus Jakarta Sans, sans-serif
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.01em
  label-sm:
    fontFamily: Plus Jakarta Sans, sans-serif
    fontSize: 12px
    fontWeight: '700'
    lineHeight: 16px
    letterSpacing: 0.04em
  data-mono:
    fontFamily: Plus Jakarta Sans, sans-serif
    fontSize: 15px
    fontWeight: '600'
    lineHeight: 20px
    fontVariantNumeric: tabular-nums
    note: 'tabular-nums for aligned fee/currency columns'

rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  2xl: 1rem 1.5rem
  full: 9999px
  arch-mobile: 120px 120px 1rem 1rem
  arch-desktop: 240px 240px 1.5rem 1.5rem

spacing:
  gutter: 1rem
  gutter-desktop: 1.5rem
  margin: 1rem
  margin-tablet: 1.5rem
  margin-desktop: 3rem
  space-xs: 0.25rem
  space-sm: 0.5rem
  space-md: 1rem
  space-lg: 1.5rem
  space-xl: 2rem
  space-2xl: 3rem
  space-3xl: 4.5rem

breakpoints:
  mobile: '<640px'
  tablet: '640px - 1024px'
  desktop: '>1024px'
  max-container: 1280px

shadows:
  sm: '0 1px 3px rgba(8, 76, 39, 0.05), 0 1px 2px rgba(0, 0, 0, 0.03)'
  md: '0 4px 6px -1px rgba(8, 76, 39, 0.08), 0 2px 4px -1px rgba(8, 76, 39, 0.04)'
  lg: '0 10px 25px -5px rgba(8, 76, 39, 0.10), 0 4px 6px -2px rgba(8, 76, 39, 0.05)'
  glow-amber: '0 0 20px rgba(217, 119, 6, 0.25)'

transitions:
  fast: '150ms ease-out'
  normal: '200ms ease-in-out'
  slow: '300ms ease-in-out'
  spring: '400ms cubic-bezier(0.34, 1.56, 0.64, 1)'
---

# Design System — Daar El Tazkiyah Sumardi

**Proyek:** Portal Web, CMS Berita & Sistem PSB — PPMTQ Daar El Tazkiyah Sumardi  
**Versi:** 1.1  
**Terakhir Diperbarui:** 7 November 2026  
**Referensi:** [PRD.md](./PRD.md) Section 4

---

## Daftar Isi

1. [Brand & Style](#1-brand--style)
2. [Colors](#2-colors)
3. [Typography](#3-typography)
4. [Layout & Spacing](#4-layout--spacing)
5. [Elevation & Depth](#5-elevation--depth)
6. [Shapes](#6-shapes)
7. [Icons](#7-icons)
8. [Images & Media](#8-images--media)
9. [Animation & Transitions](#9-animation--transitions)
10. [Components](#10-components)
11. [Page-Specific Patterns](#11-page-specific-patterns)
12. [States & Feedback](#12-states--feedback)
13. [Accessibility](#13-accessibility)
14. [Print & PDF](#14-print--pdf)
15. [Dark Mode](#15-dark-mode)
16. [Tailwind CSS Configuration](#16-tailwind-css-configuration)

---

## 1. Brand & Style

The design system bridges traditional Islamic scholarship with structured modern educational excellence. Conceived for an Islamic boarding institution (Tahfidz Pesantren), the visual voice exudes spiritual reverence, academic discipline, and open hospitality. The visual identity avoids heavy skeuomorphic ornamentation and cliché gradients, instead channeling Islamic architectural heritage through precise geometric Kufic rhythm, pointed arch contours, and balanced white space.

The aesthetic blends **Modern Editorial** and **Islamic Architectural Minimalism**:

- **Dignified & Serene**: Forest green conveys grounded stability and natural purity; vibrant emerald provides energy and growth; warm amber gold provides honor, achievement, and light.
- **Warm Architectural Canvas**: Warm alabaster surfaces soften visual tension, avoiding clinical starkness and referencing natural limestone and parchment.
- **Thumb-Friendly & Accessible**: Purpose-built for parents and prospective guardians browsing on mobile devices under various connectivity contexts, prioritizing rapid comprehension, high legibility, and effortless finger-reach.

### 1.1. Font Strategy

All fonts are **self-hosted** in `public/fonts/` to eliminate external network dependencies and maximize performance on shared hosting. No Google Fonts CDN calls.

| Font Family           | Weights Loaded          | Usage                                          | Format |
| :-------------------- | :---------------------- | :--------------------------------------------- | :----- |
| **Amiri**             | 400, 700                | Arabic institutional text, Quranic citations   | WOFF2  |
| **Scheherazade New**  | 400 (fallback)          | Fallback Arabic when Amiri unavailable         | WOFF2  |
| **Playfair Display**  | 600, 700                | Hero titles, vision quotes, editorial headings | WOFF2  |
| **Plus Jakarta Sans** | 400, 500, 600, 700, 800 | UI text, body, labels, forms, navigation       | WOFF2  |

> **Subsetting:** Arabic fonts include only Arabic script + basic Latin. Latin fonts include Latin Extended-A for Indonesian diacritics (ā, ī, ū in transliterations).

---

## 2. Colors

The palette balances authoritative institution greens with inviting gold accents and organic warm neutrals.

### 2.1. Brand Core

| Token             | Hex       | Role                                            | WCAG on White               |
| :---------------- | :-------- | :---------------------------------------------- | :-------------------------- |
| `brand-forest`    | `#084C27` | Navbar, footer, hero backgrounds, headings      | **8.9:1** ✅ AAA             |
| `emerald-vibrant` | `#059669` | Progress indicators, badges, check icons, links | **3.5:1** ⚠️ AA Large only   |
| `gold-amber`      | `#D97706` | CTA buttons, active wave markers, arch borders  | **3.2:1** ⚠️ AA Large only   |
| `gold-light`      | `#F59E0B` | Hover states, subtle highlights                 | **2.1:1** ❌ decorative only |

> **Contrast note:** `emerald-vibrant` and `gold-amber` must only be used as text color on large text (≥18px bold / ≥24px regular) or paired with a dark background. For body text on white, always use `brand-forest` or `text-primary`.

### 2.2. Surfaces & Neutrals

| Token               | Hex       | Role                                  |
| :------------------ | :-------- | :------------------------------------ |
| `surface-alabaster` | `#FDFBF7` | Main page background (warm off-white) |
| `surface-card`      | `#FFFFFF` | Card backgrounds, form fields         |
| `surface-slate`     | `#F8FAFC` | Alternate section backgrounds         |
| `text-primary`      | `#0F291E` | Primary body text, headings           |
| `text-secondary`    | `#1B3A2B` | Sub-headings, secondary content       |
| `text-muted`        | `#4B6358` | Captions, hints, timestamps           |
| `text-inverse`      | `#FFFFFF` | Text on dark/brand backgrounds        |

### 2.3. Borders

| Token           | Value                   | Usage                         |
| :-------------- | :---------------------- | :---------------------------- |
| `border-subtle` | `rgba(8, 76, 39, 0.10)` | Card borders, dividers        |
| `border-medium` | `rgba(8, 76, 39, 0.20)` | Input borders (default state) |
| `border-strong` | `rgba(8, 76, 39, 0.35)` | Input borders (hover state)   |

### 2.4. Semantic Colors

| Token     | Hex       | Background             | Usage                              |
| :-------- | :-------- | :--------------------- | :--------------------------------- |
| `success` | `#059669` | `rgba(5,150,105,0.12)` | Success messages, verified status  |
| `warning` | `#D97706` | `rgba(217,119,6,0.12)` | Warnings, revision needed          |
| `info`    | `#0284C7` | `rgba(2,132,199,0.12)` | Informational alerts               |
| `error`   | `#DC2626` | `rgba(220,38,38,0.10)` | Validation errors, rejected status |

### 2.5. PSB Status Color Mapping

Each `application_status` and `payment_status` enum maps to a specific color pair for badges and indicators:

| Status Enum            | Label (ID)                | Text Color | Background               |
| :--------------------- | :------------------------ | :--------- | :----------------------- |
| `pending`              | Menunggu Verifikasi       | `#6B7280`  | `rgba(107,114,128,0.12)` |
| `verified`             | Terverifikasi             | `#059669`  | `rgba(5,150,105,0.12)`   |
| `revision_needed`      | Perlu Perbaikan           | `#D97706`  | `rgba(217,119,6,0.12)`   |
| `accepted`             | Diterima                  | `#084C27`  | `rgba(8,76,39,0.12)`     |
| `reserve`              | Cadangan                  | `#6366F1`  | `rgba(99,102,241,0.12)`  |
| `rejected`             | Ditolak                   | `#DC2626`  | `rgba(220,38,38,0.10)`   |
| `unpaid`               | Belum Bayar               | `#6B7280`  | `rgba(107,114,128,0.12)` |
| `pending_verification` | Menunggu Verifikasi Bayar | `#D97706`  | `rgba(217,119,6,0.12)`   |
| `paid`                 | Lunas                     | `#059669`  | `rgba(5,150,105,0.12)`   |
| `rejected` (payment)   | Pembayaran Ditolak        | `#DC2626`  | `rgba(220,38,38,0.10)`   |

---

## 3. Typography

The typographic hierarchy orchestrates three deliberate voices:

### 3.1. Sacred Arabic Script

Dedicated institutional banners and Quranic citations employ traditional Naskh typefaces (self-hosted **Amiri** or **Scheherazade New**).

- **Line height:** `1.8em` — prevents diacritic (harakat/tashkeel) clipping.
- **Direction:** `dir="rtl"` with `text-align: right` on Arabic text containers.
- **Desktop:** 28px.
- **Mobile:** 20px.
- **No letterspacing** on Arabic text (would break glyph connections).

### 3.2. Editorial Gravitas (Playfair Display)

Reserved for hero manifestos, vision statements, and distinguished quotes from leadership. Gives the institution an established, timeless dignity.

- **Display Hero:** 48px / 56px line-height / -0.02em tracking (desktop), 32px / 40px (mobile).
- **Title Editorial:** 22px / 30px line-height / -0.01em tracking.

### 3.3. Contemporary Functional Clarity (Plus Jakarta Sans)

Handles all structural UI titles, operational body copy, fee breakdown numbers, form elements, and navigational labels. High x-height ensures immediate legibility on smaller mobile devices.

- **Headline LG:** 36px / 44px (desktop), 26px / 34px (mobile).
- **Headline MD:** 24px / 32px.
- **Headline SM:** 20px / 28px.
- **Body LG:** 18px / 28px.
- **Body MD:** 16px / 24px (default body text).
- **Body SM:** 14px / 20px.
- **Label MD:** 14px / 20px / semibold / 0.01em tracking.
- **Label SM:** 12px / 16px / bold / 0.04em tracking.
- **Data Mono:** 15px / 20px / semibold / `font-variant-numeric: tabular-nums` — for aligned fee/currency columns in tables.

### 3.4. Currency & Number Formatting

- Rupiah amounts rendered as: **Rp 500.000,-** (with dot thousands separator, trailing `,-`).
- Registration numbers rendered in `data-mono` style with consistent character width.
- Phone numbers displayed with country prefix: `+62 812-3456-7890`.

---

## 4. Layout & Spacing

The layout is built around a mobile-first philosophy that transitions into a dynamic **Bento Grid** architecture on wide screens.

### 4.1. Breakpoints

| Name    | Range          | Tailwind Class | Max Container                  |
| :------ | :------------- | :------------- | :----------------------------- |
| Mobile  | < 640px        | default        | 100% (with 1rem margin)        |
| Tablet  | 640px – 1024px | `sm:` / `md:`  | 100% (with 1.5rem margin)      |
| Desktop | > 1024px       | `lg:` / `xl:`  | 1280px (centered, 3rem margin) |

### 4.2. Grid System

- **Mobile:** Full single-column rhythm with sticky bottom utility bars (e.g. direct WhatsApp advisor buttons) positioned within thumb reach. Section padding stays compact (`space-lg` to `space-xl`).
- **Bento Framework (Desktop):** Asymmetric 12-column grid where primary institutional highlights take 7–8 columns and auxiliary credentials or admission status cards span 4–5 columns.
- **Gap between columns:** `gutter` (1rem mobile), `gutter-desktop` (1.5rem desktop).

### 4.3. Section Spacing

| Context                      | Mobile              | Desktop              |
| :--------------------------- | :------------------ | :------------------- |
| Between major sections       | `space-2xl` (3rem)  | `space-3xl` (4.5rem) |
| Between cards within section | `space-md` (1rem)   | `space-lg` (1.5rem)  |
| Card internal padding        | `space-md` (1rem)   | `space-xl` (2rem)    |
| Form field vertical gap      | `space-md` (1rem)   | `space-lg` (1.5rem)  |
| Inline element spacing       | `space-sm` (0.5rem) | `space-sm` (0.5rem)  |

### 4.4. Responsive Behavior Summary

| Component         | Mobile (< 640px)              | Tablet (640–1024px)         | Desktop (> 1024px)        |
| :---------------- | :---------------------------- | :-------------------------- | :------------------------ |
| Navbar            | Hamburger → slide-in drawer   | Hamburger → slide-in drawer | Horizontal links          |
| Hero section      | Stacked (text above photo)    | Side-by-side                | Side-by-side (8:4 ratio)  |
| MTS vs MDTA cards | Stacked vertically            | 2-column grid               | 2-column bento            |
| Teacher cards     | Horizontal scroll (swipeable) | 2-column grid               | 3–4 column grid           |
| News grid         | Single column list            | 2-column grid               | 3-column grid             |
| Gallery grid      | 2-column masonry              | 3-column masonry            | 4-column masonry          |
| PSB form          | Full-width, single column     | Centered card (max-w-2xl)   | Centered card (max-w-2xl) |
| Admin dashboard   | Stacked metric cards          | 2-column metric grid        | 4-column metric grid      |
| Footer            | Stacked sections              | 2-column                    | 4-column                  |

---

## 5. Elevation & Depth

Visual depth follows a restrained, low-elevation philosophy rooted in crisp surfaces and subtle atmospheric light rather than dramatic drop shadows.

### 5.1. Surface Tiers

| Level                     | Background               | Border          | Shadow      | Usage                                     |
| :------------------------ | :----------------------- | :-------------- | :---------- | :---------------------------------------- |
| **Level 0 (Canvas)**      | `#FDFBF7`                | —               | —           | Page background                           |
| **Level 1 (Cards)**       | `#FFFFFF`                | `border-subtle` | `shadow-sm` | Default cards, bento modules              |
| **Level 2 (Interactive)** | `#FFFFFF`                | `border-medium` | `shadow-lg` | Hovered cards, sticky bars, dropdowns     |
| **Level 3 (Overlay)**     | `rgba(253,251,247,0.88)` | —               | —           | Modals, drawers (with `backdrop-blur-md`) |

### 5.2. Architectural Overlays

- Watermarked geometric Kufic patterns are restricted to `5%` opacity, placed strictly as background texture behind leadership portrait arches or hero focal points.
- Pattern SVGs are embedded inline (not external requests) for shared hosting compatibility.

### 5.3. Frosted Overlays

Mobile navigation drawers and dialog overlays employ:
- Backdrop: `backdrop-blur-md` (12px blur).
- Tint: `rgba(253, 251, 247, 0.88)`.
- Transition: `300ms ease-in-out` slide from left (nav) or fade + scale (dialogs).

---

## 6. Shapes

The design system incorporates geometric curves balanced with signature architectural silhouettes:

### 6.1. Border Radius Scale

| Token          | Value          | Usage                                                                    |
| :------------- | :------------- | :----------------------------------------------------------------------- |
| `rounded-sm`   | 0.25rem (4px)  | Small inline elements, tags                                              |
| `rounded`      | 0.5rem (8px)   | Buttons, input fields                                                    |
| `rounded-md`   | 0.75rem (12px) | Dropdowns, tooltips                                                      |
| `rounded-lg`   | 1rem (16px)    | Small cards, badges                                                      |
| `rounded-xl`   | 1.5rem (24px)  | Form containers, medium cards                                            |
| `rounded-2xl`  | —              | Main content cards, bento modules (use `1rem` base, `1.5rem` on desktop) |
| `rounded-full` | 9999px         | Avatars, status dots, pills                                              |

### 6.2. The Modern Islamic Arch (Qubbah Silhouettes)

High-prominence visual anchors (such as portraits of the Pondok leadership or featured institutional values) apply an asymmetric rounded arch:

- **Mobile:** `border-radius: 120px 120px 1rem 1rem`
- **Desktop:** `border-radius: 240px 240px 1.5rem 1.5rem`
- **Gold border treatment:** Inner or outer hairline ring accented with `gold-amber` (`#D97706`, 1.5px solid), honoring traditional manuscript illuminations.
- **Background:** `brand-forest` (`#084C27`) or subtle gradient `from-brand-forest to-emerald-900`.

---

## 7. Icons

### 7.1. Icon System

| Property         | Value                                                                    |
| :--------------- | :----------------------------------------------------------------------- |
| **Library**      | Heroicons (Outline variant as primary, Solid for active/selected states) |
| **Default Size** | 20×20px (`w-5 h-5`) for inline/body, 24×24px (`w-6 h-6`) for navigation  |
| **Stroke Width** | 1.5 (default Heroicons), 2.0 for emphasis (checklist icons)              |
| **Color**        | Inherits parent text color via `currentColor`                            |

### 7.2. Common Icon Mapping

| Context                  | Icon                        | Variant                   |
| :----------------------- | :-------------------------- | :------------------------ |
| WhatsApp floating button | Custom WhatsApp SVG         | Solid                     |
| Checklist (Misi items)   | `check-circle`              | Solid, `emerald-vibrant`  |
| Navigation menu (mobile) | `bars-3` / `x-mark`         | Outline                   |
| Search                   | `magnifying-glass`          | Outline                   |
| Download PDF             | `arrow-down-tray`           | Outline                   |
| Upload file              | `cloud-arrow-up`            | Outline                   |
| Status: Pending          | `clock`                     | Outline, `status-pending` |
| Status: Verified         | `check-badge`               | Solid, `status-verified`  |
| Status: Revision         | `exclamation-triangle`      | Solid, `status-revision`  |
| Status: Accepted         | `check-circle`              | Solid, `status-accepted`  |
| Status: Rejected         | `x-circle`                  | Solid, `status-rejected`  |
| External link            | `arrow-top-right-on-square` | Outline                   |
| Share WhatsApp           | Custom WhatsApp SVG         | Solid                     |
| Share Facebook           | Custom Facebook SVG         | Solid                     |
| Calendar/date            | `calendar-days`             | Outline                   |
| Location                 | `map-pin`                   | Outline                   |
| Phone                    | `phone`                     | Outline                   |
| Mail                     | `envelope`                  | Outline                   |

---

## 8. Images & Media

### 8.1. Aspect Ratios

| Context                      | Ratio             | Max Dimensions   | Format              |
| :--------------------------- | :---------------- | :--------------- | :------------------ |
| Hero background              | 16:9              | 1920×1080px      | WebP, JPEG fallback |
| Featured image (berita)      | 16:9              | 1200×675px       | WebP 85%            |
| News thumbnail (card)        | 4:3               | 600×450px        | WebP 85%            |
| Gallery thumbnail            | 1:1 (square crop) | 400×400px        | WebP 85%            |
| Gallery full view (lightbox) | Original ratio    | 1600px max-width | WebP 85%            |
| Teacher photo                | 3:4 (portrait)    | 400×533px        | JPEG 80%            |
| Pengasuh photo (arch frame)  | 3:4 (portrait)    | 600×800px        | JPEG 85%            |
| Pas foto (PSB upload)        | 3:4               | 400×533px        | JPEG 80%            |
| Document scan (KK, Akta)     | Original          | Max 2MB          | JPEG/PNG/PDF        |

### 8.2. Loading Strategy

- **Lazy loading:** All images below the fold use `loading="lazy"`.
- **Placeholder:** Low-contrast `surface-container` background with subtle pulse animation until image loads.
- **Error state:** Fallback to a branded placeholder (emerald background + institution logo silhouette at 10% opacity).
- **Hero image:** Eagerly loaded (`loading="eager"`, `fetchpriority="high"`) for LCP optimization.

### 8.3. Gallery Lightbox

- Fullscreen overlay with frosted backdrop (`backdrop-blur-md`).
- Swipe navigation on mobile, arrow keys on desktop.
- Caption displayed below image in `body-sm` style.
- Close button at top-right (`x-mark` icon, `text-inverse`).

---

## 9. Animation & Transitions

All animations respect `prefers-reduced-motion: reduce` — reduced to instant transitions when enabled.

### 9.1. Transition Durations

| Token    | Duration | Easing                            | Usage                                            |
| :------- | :------- | :-------------------------------- | :----------------------------------------------- |
| `fast`   | 150ms    | ease-out                          | Hover states, focus rings, toggle switches       |
| `normal` | 200ms    | ease-in-out                       | Dropdown open/close, accordion expand            |
| `slow`   | 300ms    | ease-in-out                       | Modal enter/exit, drawer slide, page transitions |
| `spring` | 400ms    | cubic-bezier(0.34, 1.56, 0.64, 1) | Button press feedback, notification pop-in       |

### 9.2. Common Animations

| Element                  | Animation                                             | Trigger                           |
| :----------------------- | :---------------------------------------------------- | :-------------------------------- |
| Cards on scroll          | Fade-up (`translateY(16px) → 0`, `opacity: 0 → 1`)    | Intersection Observer, `slow`     |
| Button hover             | Background darken + subtle lift (`translateY(-1px)`)  | `:hover`, `fast`                  |
| Button press             | Scale down (`scale(0.97)`)                            | `:active`, `fast`                 |
| Mobile nav drawer        | Slide from left (`translateX(-100%) → 0`)             | Toggle, `slow`                    |
| Modal                    | Fade + scale up (`scale(0.95) → 1`, `opacity: 0 → 1`) | Toggle, `slow`                    |
| Toast notification       | Slide from top + spring bounce                        | Auto, `spring`                    |
| Multi-step form progress | Step node fill + connector line extend                | Step change, `normal`             |
| WhatsApp floating button | Pulse glow every 5s                                   | `@keyframes`, infinite            |
| Image placeholder        | Subtle pulse (`opacity: 0.6 → 1.0`)                   | While loading, `normal`, infinite |
| Accordion content        | Height expand (`max-height: 0 → auto`)                | Toggle, `normal`                  |
| Skeleton loader          | Shimmer sweep (left to right gradient)                | While loading, infinite           |

### 9.3. Page Transitions (Livewire)

Livewire page navigation uses `wire:navigate` with a minimal top progress bar:
- Color: `emerald-vibrant` (`#059669`).
- Height: 3px.
- Position: fixed top.
- Animation: width `0% → 100%` over loading duration.

---

## 10. Components

### 10.1. Buttons

| Variant         | Background                              | Text           | Border          | Radius         | Usage                                   |
| :-------------- | :-------------------------------------- | :------------- | :-------------- | :------------- | :-------------------------------------- |
| **Primary CTA** | `gold-amber` → `#B45309` hover          | White, bold    | —               | `rounded-xl`   | "Daftar", submit forms                  |
| **Secondary**   | `brand-forest` → darken hover           | White          | —               | `rounded-xl`   | "Lihat Selengkapnya", secondary actions |
| **Ghost**       | Transparent → `brand-forest/5` hover    | `brand-forest` | `border-subtle` | `rounded-xl`   | "Batal", tertiary actions               |
| **Outline**     | Transparent → `brand-forest/5` hover    | `brand-forest` | `border-medium` | `rounded-xl`   | "Download PDF", "Export Excel"          |
| **Danger**      | `error` → darken hover                  | White          | —               | `rounded-xl`   | Delete/reject actions (admin only)      |
| **Icon-only**   | Transparent → `surface-container` hover | `text-muted`   | —               | `rounded-full` | Close, menu toggle                      |

**Button sizes:**

| Size | Height | Padding            | Font               |
| :--- | :----- | :----------------- | :----------------- |
| SM   | 32px   | `0.5rem 1rem`      | `label-sm`         |
| MD   | 40px   | `0.625rem 1.25rem` | `label-md`         |
| LG   | 48px   | `0.75rem 1.5rem`   | `body-md` semibold |

**WhatsApp Floating Button:**
- Persistent circular button, bottom-right corner (`bottom: 1.25rem`, `right: 1.25rem`).
- Size: 56×56px (`w-14 h-14`).
- Background: `#25D366` (WhatsApp brand green).
- Shadow: `shadow-lg` + subtle ambient glow.
- Z-index: `50`.
- Pulse animation every 5 seconds (subtle scale + shadow expansion).

### 10.2. Cards & Bento Modules

**Base card:**
- Background: `surface-card` (`#FFFFFF`).
- Border: `border-subtle` (1px).
- Radius: `rounded-2xl` (1rem mobile, 1.5rem desktop).
- Shadow: `shadow-sm`.
- Hover (if clickable): `shadow-md` + `translateY(-2px)`, transition `normal`.
- Padding: `space-md` (mobile), `space-xl` (desktop).

**Comparison Cards (MTS vs MDTA):**
- Side-by-side bento layout on desktop, stacked on mobile.
- **MTS header accent:** `emerald-vibrant` gradient strip at top.
- **MDTA header accent:** `gold-amber` gradient strip at top.
- Bullet items with `emerald-vibrant` check-circle icons.
- Prominent fee breakdowns in `headline-md` using `data-mono` for aligned numbers.
- Active wave badge in top-right corner (amber pill).

### 10.3. Badges & Chips

**Shape:** Pill (`rounded-full`), padding `0.25rem 0.75rem`.

| Variant        | Background                       | Text                    | Usage                     |
| :------------- | :------------------------------- | :---------------------- | :------------------------ |
| Program (MTS)  | `success-bg`                     | `emerald-vibrant`       | Program type badges       |
| Program (MDTA) | `warning-bg`                     | `gold-amber`            | Program type badges       |
| Wave Active    | `warning-bg`                     | `gold-amber`            | Gelombang aktif indicator |
| Status *       | See Section 2.5                  | See Section 2.5         | All PSB status badges     |
| Category       | `surface-container`              | `text-secondary`        | News category tags        |
| Featured       | `tertiary-container` → `#663500` | `on-tertiary-container` | Featured post badge       |

### 10.4. Navigation

**Desktop Navbar:**
- Background: `brand-forest` (`#084C27`).
- Height: 64px.
- Logo left-aligned (max-height 40px).
- Links: `text-inverse` (white), `body-md` semibold.
- Active link: underline (2px `gold-amber` bottom border).
- CTA button (right): "Daftar" in `gold-amber` filled pill.
- Sticky on scroll with `backdrop-blur-md` + slight transparency (`rgba(8,76,39,0.95)`).

**Mobile Navigation Drawer:**
- Trigger: Hamburger icon (`bars-3`), top-right.
- Drawer slides from left, `slow` transition.
- Frosted overlay backdrop.
- Links stacked vertically, `headline-sm` size, padded `space-lg`.
- Close button (`x-mark`) at top-right of drawer.
- CTA "Daftar" as full-width button at bottom of drawer.

**Footer:**
- Background: `brand-forest` (`#084C27`).
- Text: `text-inverse` and `rgba(255,255,255,0.7)` for secondary links.
- 4-column layout (desktop): About, Quick Links, Contact, Social Media.
- Stacked single-column on mobile.
- Bottom bar: copyright text + "Developed by..." in `label-sm`.
- Social media icons: 24×24px, `text-inverse`, hover with `gold-amber`.

### 10.5. Multi-Step Form UI

**Step Indicator Bar:**
- Horizontal connected track.
- **Completed steps:** Solid `emerald-vibrant` circle with white check icon, solid emerald connector line.
- **Current step:** `gold-amber` ring (2px) with step number, pulsing amber glow.
- **Upcoming steps:** `surface-container-high` circle with muted number, dashed `outline-variant` connector.
- Step labels below circles in `label-sm`, muted text for upcoming, `text-primary` for current/completed.

**Form Fields:**
- Background: `surface-card` (white).
- Border: `border-medium` (`rgba(8,76,39,0.20)`).
- Radius: `rounded-xl`.
- Focus: 2px ring in `emerald-vibrant` (`#059669`), zero offset.
- Error: 2px ring in `error` (`#DC2626`), error message below in `body-sm` red.
- Labels: `label-md` style, `text-primary` color, positioned above field.
- Placeholder text: `text-muted` color.
- Disabled: `surface-container` background, `text-muted` text, `cursor-not-allowed`.

**File Upload Zone:**
- Dashed border (`border-medium`, dashed style).
- `rounded-xl`.
- Center-aligned upload icon (`cloud-arrow-up`, 32×32px, `text-muted`).
- "Klik atau seret file" label in `body-sm`.
- File type & size hint in `label-sm`, `text-muted`.
- Drag-over state: `emerald-vibrant` dashed border, `success-bg` background.
- After upload: filename + file size + remove button (inline, `body-sm`).
- Progress bar during upload: `emerald-vibrant` fill, `surface-container` track.

### 10.6. Tables (Admin & Fee Breakdowns)

**Data Table (Admin Panel):**
- Header row: `surface-container` background, `label-md` bold text.
- Body rows: `surface-card` background, `body-sm` text.
- Alternating row: subtle `surface-container-low` background (optional).
- Row hover: `surface-container` background.
- Border: `border-subtle` between rows (horizontal only).
- Radius: `rounded-xl` on table container.
- Padding: `space-sm` vertical, `space-md` horizontal per cell.
- Sorting icons: `chevron-up` / `chevron-down` inline with header text.
- Pagination: at bottom, `body-sm`, emerald active page indicator.

**Fee Comparison Table (Landing Page):**
- Uses card-based layout rather than traditional table on mobile.
- `data-mono` for all currency amounts.
- Header columns: emerald (MTS) and amber (MDTA) backgrounds.
- Row dividers: `border-subtle`.

### 10.7. Alerts & Toast Notifications

**Inline Alerts (within page):**

| Variant | Left Border            | Background   | Icon                         |
| :------ | :--------------------- | :----------- | :--------------------------- |
| Success | `success` (4px)        | `success-bg` | `check-circle` solid         |
| Warning | `warning` (4px)        | `warning-bg` | `exclamation-triangle` solid |
| Info    | `info` (4px)           | `info-bg`    | `information-circle` solid   |
| Error   | `error-semantic` (4px) | `error-bg`   | `x-circle` solid             |

- Radius: `rounded-lg`.
- Padding: `space-md`.
- Text: `body-sm`, color matching variant.
- Dismissible with `x-mark` icon (optional).

**Toast Notifications:**
- Position: top-center, fixed.
- Width: max-w-md.
- Enter: slide down + spring bounce.
- Exit: fade out + slide up, after 5 seconds auto-dismiss.
- Same variant colors as inline alerts.
- Shadow: `shadow-lg`.

### 10.8. Lists & Features

**Mission & Value Lists:**
- Clean vertical spacing (`space-md`).
- Left-aligned `emerald-vibrant` `check-circle` solid icons (20×20px, stroke-width 2.0).
- Text in `body-md`, deep `text-primary`.

**Teacher Profile Cards:**
- Photo: 3:4 ratio, `rounded-xl`, `object-cover`.
- Name: `headline-sm`.
- Role title: `label-md`, `text-muted`.
- Specialization: `body-sm`, `text-muted`.
- Card: `rounded-2xl`, `shadow-sm`, hover `shadow-md`.

**News List Cards:**
- Featured image: 16:9 ratio at top, `rounded-t-2xl`.
- Category badge (pill) overlaid on image, bottom-left.
- Title: `headline-sm`, max 2 lines (line-clamp-2).
- Excerpt: `body-sm`, `text-muted`, max 3 lines (line-clamp-3).
- Date + read time: `label-sm`, `text-muted`, with `calendar-days` icon.

---

## 11. Page-Specific Patterns

### 11.1. Landing Page

- **Hero:** Full-width `brand-forest` background with Kufic geometric pattern at 5% opacity. Left: headline text + CTA buttons. Right: Pengasuh photo in modern arch frame with gold border. Mobile: stacked (text above, arch photo below).
- **Visi:** `title-editorial` (Playfair Display) for the vision quote, centered, with subtle decorative horizontal rule (gold) above and below.
- **Misi:** Emerald check-circle list, `body-lg` text, within a bento card.
- **Programs:** Side-by-side comparison cards with accent color headers. Fee tables with `data-mono` numbers.
- **Teachers:** Horizontal scrollable row (mobile) or grid (desktop) of teacher cards.
- **Latest News:** 3-column grid of news cards with "Lihat Semua Berita →" link.
- **Contact:** Map embed + contact info cards in bento grid.

### 11.2. PSB Form Page

- Centered card container (`max-w-2xl`) on `surface-alabaster` background.
- Step indicator at top.
- Form fields in single column.
- "Biaya Pendaftaran" summary box (amber-bordered card) always visible.
- Navigation buttons at bottom: "Kembali" (ghost) | "Lanjutkan" (primary CTA).
- Final step: "Kirim Pendaftaran" (primary CTA, full-width).

### 11.3. PSB Success Page

- Success illustration (check-circle icon, large, `emerald-vibrant`).
- Registration number displayed in `headline-lg`, `brand-forest`, with copy-to-clipboard button.
- Access token displayed in `headline-md` with copy-to-clipboard and warning to save.
- Two action buttons: "Unduh Bukti Pendaftaran (PDF)" (outline) | "Konfirmasi ke WhatsApp" (WhatsApp green).

### 11.4. Check Status Page

- Centered card, `max-w-md`.
- Two input fields: Nomor Registrasi + Access Token.
- Result displayed in card below with status badge, timeline of status changes, and admin notes (if any).
- Action buttons change per status (download kartu, upload ulang, edit data).

### 11.5. News Detail Page

- Max-width `prose` container (728px) centered on `surface-alabaster`.
- Featured image: full-width, 16:9, `rounded-2xl`.
- Category badge + date + read time + author below image.
- Content: `body-lg` text, generous line-height (1.75).
- Share buttons (WhatsApp, Facebook) sticky at bottom on mobile.
- Related articles: 3-column card grid below content.

### 11.6. Admin Dashboard

- Sidebar navigation (desktop), bottom tab bar (mobile) — `brand-forest` background.
- Metric cards: 4-column grid with large numbers (`headline-lg`), labels (`label-md`), and trend indicator.
- Data table with search bar, filter dropdowns, and export button.
- Status change: inline dropdown or modal confirmation with notes field.

---

## 12. States & Feedback

### 12.1. Loading States

| Context            | Pattern                                                               |
| :----------------- | :-------------------------------------------------------------------- |
| **Page load**      | Top progress bar (emerald, 3px) via Livewire `wire:navigate`          |
| **Button loading** | Spinner icon replacing button text, button disabled with `opacity-75` |
| **Table loading**  | Skeleton rows (shimmer animation, 5 rows)                             |
| **Card loading**   | Skeleton card (shimmer on image + text blocks)                        |
| **Image loading**  | `surface-container` pulse placeholder                                 |
| **File uploading** | Progress bar (emerald fill) with percentage text                      |

### 12.2. Empty States

| Context                   | Content                                                            |
| :------------------------ | :----------------------------------------------------------------- |
| **No search results**     | Illustration icon + "Tidak ada hasil untuk '[query]'" + suggestion |
| **No news articles**      | "Belum ada berita yang dipublikasikan."                            |
| **No applicants (admin)** | "Belum ada pendaftar pada gelombang ini."                          |
| **Gallery empty**         | "Belum ada album galeri."                                          |
| **PSB closed**            | Branded card: "Pendaftaran Belum/Sudah Ditutup" + WhatsApp CTA     |

### 12.3. Error States

| Context               | Pattern                                                                       |
| :-------------------- | :---------------------------------------------------------------------------- |
| **Form validation**   | Red ring on field + error message below in `body-sm` red                      |
| **File too large**    | Inline error below upload zone: "Ukuran file melebihi 2MB"                    |
| **Invalid file type** | Inline error: "Format file tidak didukung. Gunakan JPG, PNG, atau PDF."       |
| **Duplicate NIK**     | Alert banner (error variant) at top of form                                   |
| **Network error**     | Toast notification (error): "Koneksi terputus. Silakan coba lagi."            |
| **404 page**          | Branded page with arch illustration + "Halaman tidak ditemukan" + back button |
| **500 page**          | Branded page: "Terjadi kesalahan" + contact admin info                        |

### 12.4. Success States

| Context                    | Pattern                                                                     |
| :------------------------- | :-------------------------------------------------------------------------- |
| **Form submitted**         | Redirect to success page with confetti-free, dignified success illustration |
| **Status updated (admin)** | Toast notification (success): "Status pendaftar berhasil diubah."           |
| **File uploaded**          | Inline success: checkmark + filename + "Berhasil diunggah"                  |
| **Data saved**             | Toast notification (success): "Perubahan berhasil disimpan."                |

---

## 13. Accessibility

### 13.1. Standards

- Target: **WCAG 2.1 Level AA** compliance.
- All interactive elements must be keyboard navigable.
- Focus indicators: 2px `emerald-vibrant` ring with 2px offset on all focusable elements.
- Skip-to-content link at top of page (visually hidden, visible on focus).

### 13.2. Color Contrast

| Combination                           | Ratio      | Compliance           |
| :------------------------------------ | :--------- | :------------------- |
| `text-primary` on `surface-alabaster` | **13.8:1** | ✅ AAA                |
| `brand-forest` on `surface-card`      | **8.9:1**  | ✅ AAA                |
| `text-inverse` on `brand-forest`      | **8.9:1**  | ✅ AAA                |
| `text-muted` on `surface-card`        | **5.2:1**  | ✅ AA                 |
| `emerald-vibrant` on `surface-card`   | **3.5:1**  | ⚠️ AA Large text only |
| `gold-amber` on `surface-card`        | **3.2:1**  | ⚠️ AA Large text only |
| `gold-amber` on `brand-forest`        | **4.6:1**  | ✅ AA                 |

### 13.3. Form Accessibility

- All inputs have associated `<label>` elements (not placeholder-only).
- Required fields marked with `*` and `aria-required="true"`.
- Error messages linked to inputs via `aria-describedby`.
- File upload zones announce state changes to screen readers.
- Multi-step form uses `aria-current="step"` on active step.
- Tab order follows visual order.

### 13.4. Motion

- All animations respect `@media (prefers-reduced-motion: reduce)` — transitions reduced to 0ms.
- WhatsApp button pulse animation disabled under reduced motion.
- No auto-playing videos or infinite animations that cannot be stopped (except skeleton loaders, which are functional).

---

## 14. Print & PDF

### 14.1. Print Stylesheet

- Hide: navigation, footer, floating buttons, sidebars, interactive controls.
- Show: content in single-column, full-width layout.
- Force: white background, black text, visible link URLs.
- Page breaks: avoid breaking inside cards and tables.

### 14.2. PDF Generation (DomPDF)

**Bukti Pendaftaran PDF:**
- Page size: A4 portrait.
- Header: Institution logo (left) + institution name and Arabic text (center/right).
- Body: registration details in a clean table layout.
- Font: DejaVu Sans (DomPDF default, supports basic Latin — no Arabic in PDF).
- Colors: `brand-forest` for headers, black for body text.
- Footer: "Dokumen ini dibuat secara otomatis oleh sistem PSB Online" + generation timestamp.
- Border: thin `brand-forest` border around page content area.

**Kartu Peserta PDF:**
- Page size: A5 landscape or custom card size.
- Photo placeholder area (3:4 ratio).
- Registration number in large bold text.
- QR code (optional future enhancement) encoding registration number.

---

## 15. Dark Mode

**Status:** Not implemented for v1.0.

The application targets a specific audience (parents accessing via WhatsApp links on mobile) where dark mode is not a priority. The warm alabaster palette already provides reduced eye strain.

**Future consideration:** If dark mode is added post-launch:
- Surface: `#1A1A1A` canvas, `#2D2D2D` cards.
- Brand colors remain unchanged (emerald, gold — already high contrast on dark).
- White text replaces `text-primary`.
- System preference detection via `@media (prefers-color-scheme: dark)`.

---

## 16. Tailwind CSS Configuration

The design tokens above translate to Tailwind CSS v4 configuration. Key customizations in `resources/css/app.css` (Tailwind v4 CSS-first config):

```css
@import "tailwindcss";

@theme {
  /* Brand Colors */
  --color-brand-forest: #084C27;
  --color-emerald-vibrant: #059669;
  --color-gold-amber: #D97706;
  --color-gold-light: #F59E0B;

  /* Surfaces */
  --color-surface-alabaster: #FDFBF7;
  --color-surface-card: #FFFFFF;
  --color-surface-slate: #F8FAFC;

  /* Text */
  --color-text-primary: #0F291E;
  --color-text-secondary: #1B3A2B;
  --color-text-muted: #4B6358;

  /* Semantic */
  --color-success: #059669;
  --color-warning: #D97706;
  --color-info: #0284C7;

  /* PSB Status */
  --color-status-pending: #6B7280;
  --color-status-verified: #059669;
  --color-status-revision: #D97706;
  --color-status-accepted: #084C27;
  --color-status-reserve: #6366F1;
  --color-status-rejected: #DC2626;

  /* Fonts */
  --font-arabic: 'Amiri', 'Scheherazade New', serif;
  --font-display: 'Playfair Display', serif;
  --font-sans: 'Plus Jakarta Sans', system-ui, sans-serif;

  /* Shadows */
  --shadow-card: 0 1px 3px rgba(8, 76, 39, 0.05), 0 1px 2px rgba(0, 0, 0, 0.03);
  --shadow-card-hover: 0 4px 6px -1px rgba(8, 76, 39, 0.08), 0 2px 4px -1px rgba(8, 76, 39, 0.04);
  --shadow-elevated: 0 10px 25px -5px rgba(8, 76, 39, 0.10), 0 4px 6px -2px rgba(8, 76, 39, 0.05);
}
```

> **Note:** This is a reference snippet. The actual Tailwind v4 configuration will be maintained in `resources/css/app.css` as the source of truth. Refer to this DESIGN.md for token rationale and usage guidelines.
