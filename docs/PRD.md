# Product Requirements Document (PRD)

**Nama Proyek:** Portal Web, CMS Berita & Sistem PSB — PPMTQ Daar El Tazkiyah Sumardi  
**Nama Instansi:** Pondok Pesantren Modern Tahfidzul Quran (PPMTQ) Daar El Tazkiyah Sumardi  
**Pengasuh:** Ust. Ahmad Ashil Fadhil, S.H., M.H.  
**Versi Dokumen:** 1.1  
**Terakhir Diperbarui:** 7 November 2026  
**Target Deployment:** Agustus 2027 (Shared Hosting — Tanpa SSH & Tanpa Node.js)

---

## Daftar Isi

1. [Ringkasan Eksekutif](#1-ringkasan-eksekutif-executive-summary)
2. [Tujuan & Sasaran Proyek](#2-tujuan--sasaran-proyek-goals--objectives)
3. [Target Pengguna](#3-target-pengguna-user-personas)
4. [Spesifikasi Desain & UI/UX](#4-spesifikasi-desain--uiux-design-system)
5. [Arsitektur Tech Stack & Lingkungan Sistem](#5-arsitektur-tech-stack--lingkungan-sistem)
6. [Kebutuhan Fungsional](#6-kebutuhan-fungsional-functional-requirements)
7. [Rancangan Skema Database](#7-rancangan-skema-database-database-schema)
8. [Kebutuhan Non-Fungsional](#8-kebutuhan-non-fungsional-non-functional-requirements)
9. [Roadmap Pengembangan](#9-roadmap-pengembangan)
10. [Asumsi, Batasan & Risiko](#10-asumsi-batasan--risiko)
11. [Glosarium](#11-glosarium)

> **Catatan:** Prosedur deployment dipindahkan ke dokumen terpisah: [`DEPLOYMENT.md`](./DEPLOYMENT.md).

---

## 1. Ringkasan Eksekutif (Executive Summary)

Proyek ini bertujuan untuk membangun platform digital resmi **Pondok Pesantren Modern Tahfidzul Quran (PPMTQ) Daar El Tazkiyah Sumardi** (*Ma'had Dar Al-Tazkiyah Sumardi Al-Islami Li Tahfizhil Qur'an*). Sistem ini dirancang untuk memenuhi tiga kebutuhan utama dalam satu aplikasi terintegrasi:

1. **Landing Page Profil Pondok:** Menampilkan identitas pesantren, profil pengasuh, visi-misi, program pendidikan (**MTS Mukim 24 Jam** & **MDTA Sekolah Sore**), rincian biaya, daftar tenaga pendidik, serta halaman kontak.
2. **Content Management System (CMS) Berita:** Media publikasi kegiatan santri, kajian, artikel keislaman, galeri kegiatan, dan pengumuman resmi pondok.
3. **Sistem Penerimaan Santri Baru (PSB) Online:** Portal pendaftaran terpadu untuk Tahun Ajaran 2027/2028 (Gelombang I & II) lengkap dengan unggah berkas, cek status verifikasi, cetak bukti pendaftaran (PDF), dan rekapitulasi data panitia (Excel).

Mengingat infrastruktur target menggunakan **Shared Hosting standar (tanpa akses SSH dan tanpa runtime Node.js)**, aplikasi dikembangkan menggunakan **Laravel 13 + Livewire** di lingkungan lokal (Laragon) dengan mekanisme *pre-compiled static assets* (`pnpm run build` di lokal) dan *deployment helper* berbasis HTTP route.

---

## 2. Tujuan & Sasaran Proyek (Goals & Objectives)

* **Digitalisasi Informasi & Branding:** Membangun citra pesantren modern tahfidzul Qur'an yang kredibel, transparan dalam rincian biaya, serta mudah diakses oleh calon wali santri melalui perangkat *mobile* (HP).
* **Otomasi Administrasi PSB:** Memangkas proses pencatatan manual panitia PSB untuk jenjang **MTS** dan **MDTA**, termasuk otomatisasi perhitungan biaya pendaftaran berdasarkan gelombang aktif.
* **Kemandirian Pengelolaan Konten:** Memudahkan pengurus/admin pondok dalam menerbitkan berita, mengubah jadwal gelombang PSB, dan memperbarui daftar pengajar melalui *dashboard* admin tanpa menyentuh kode program.
* **Zero-Friction Shared Hosting Deployment:** Memastikan aplikasi dapat diunggah cukup melalui File Manager cPanel (`.zip`) dan phpMyAdmin (`.sql`) tanpa ketergantungan pada terminal SSH maupun server Node.js.

---

## 3. Target Pengguna (User Personas)

| Peran Pengguna                     | Deskripsi & Karakteristik                                                                    | Kebutuhan Utama                                                                                                                                                                                                                                                     |
| :--------------------------------- | :------------------------------------------------------------------------------------------- | :------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| **Calon Wali Santri / Pengunjung** | Orang tua/wali murid (mayoritas mengakses via *smartphone* dari grup WhatsApp/Media Sosial). | Membaca profil pesantren, membandingkan program MTS vs MDTA, melihat rincian biaya, mengisi formulir pendaftaran, mengunggah bukti transfer/berkas, mengecek status pendaftaran, mencetak kartu bukti daftar, serta mengedit data pendaftaran sebelum diverifikasi. |
| **Admin CMS / Humas Pondok**       | Pengurus pondok yang bertugas mengelola informasi publik. Memiliki role `admin_cms`.         | Menulis dan menerbitkan berita kegiatan, mengatur galeri foto, serta memperbarui daftar tenaga pendidik dan pengumuman.                                                                                                                                             |
| **Panitia PSB (Admin TU)**         | Staf administrasi penerimaan santri baru. Memiliki role `admin_psb`.                         | Memverifikasi data & bukti pembayaran pendaftar, mengubah status pendaftaran, mencetak kartu santri, serta mengunduh laporan rekapitulasi pendaftar ke dalam format Excel (`.xlsx`).                                                                                |
| **Super Admin**                    | Administrator utama dengan akses penuh ke seluruh modul. Memiliki role `super_admin`.        | Mengelola semua fitur Admin CMS dan Panitia PSB, mengelola pengguna admin, mengubah pengaturan situs (`site_settings`).                                                                                                                                             |

---

## 4. Spesifikasi Desain & UI/UX (Design System)

Desain mengadaptasi identitas visual dari **Logo Kufi Geometris Daar El Tazkiyah** dan **Brosur Resmi PSB**, yang diterjemahkan ke dalam antarmuka web modern (*Modern Emerald & Gold Islamic UI*).

### 4.1. Palet Warna (Tailwind CSS Color Tokens)

> **Catatan:** Warna `#084C27` bukan `emerald-950` bawaan Tailwind (yang bernilai `#022c22`). Warna ini didefinisikan sebagai **custom color** `brand-green` di `tailwind.config.js`.

* **Primary Brand (Deep Forest Green):** `#084C27` / custom `brand-green` (Digunakan untuk Navbar, Footer, dan latar utama Hero).
* **Secondary Emerald (Vibrant Green):** `#059669` / `emerald-600` (Digunakan untuk *gradient card header*, ikon *checklist* Misi, dan *badge* program).
* **Accent / Gold (Warm Amber):** `#D97706` hingga `#F59E0B` / `amber-600` s.d. `amber-500` (Digunakan sebagai pengganti pita emas pada brosur untuk tombol CTA **"Daftar"**, *border highlight*, dan penanda gelombang aktif).
* **Background & Surface:**
  * *Main Background:* `#FDFBF7` (*Warm Off-White / Alabaster*) atau `#F8FAFC` (`slate-50`).
  * *Card Surface:* `#FFFFFF` (`white`) dengan *border* halus `border-emerald-900/10` dan bayangan lembut `shadow-sm`.

### 4.2. Tipografi

Font di-*self-host* (disimpan di `public/fonts/`) untuk menghindari ketergantungan pada koneksi internet dan meningkatkan performa di shared hosting.

* **Kaligrafi / Teks Arab Header:** `Amiri` atau `Scheherazade New` — untuk teks:
  > معهد دار التزكية سوماردي الإسلامي لتحفيظ القرآن
* **Heading & Kutipan Visi:** `Playfair Display` (Serif elegan untuk menonjolkan kutipan Visi pesantren) dikombinasikan dengan `Plus Jakarta Sans` (Bold/ExtraBold) untuk judul seksi dan nama pesantren.
* **Body Text, Tabel Biaya & Form:** `Plus Jakarta Sans` atau `Inter` — memastikan keterbacaan angka nominal rupiah, tanggal gelombang, dan artikel berita di layar kecil.

### 4.3. Prinsip Tata Letak & Elemen Visual

* **Mobile-First & Thumb-Friendly:** Navigasi bawah atau tombol *floating* WhatsApp Panitia PSB yang selalu mudah dijangkau di layar HP.
* **Modern Islamic Arch & Geometric Pattern:** Foto Pengasuh (**Ust. Ahmad Ashil Fadhil, S.H., M.H.**) ditampilkan dalam bingkai lengkung kubah modern (*arch frame*) dengan *border* emas tipis, berlatar belakang pola garis geometris Kufi ber-opasitas rendah (`5%`).
* **Bento Grid & Comparison Cards:** Visi, Misi, dan Program Pendidikan (MTS vs MDTA) disusun menggunakan kartu bersih ber-sudut membulat (`rounded-2xl`) tanpa efek *3D bevel* berlebih agar tampak profesional dan modern.

### 4.4. Browser & Device Support

| Target                     | Versi Minimum |
| :------------------------- | :------------ |
| Chrome (Android & Desktop) | 90+           |
| Safari (iOS & macOS)       | 15+           |
| Firefox                    | 100+          |
| Samsung Internet           | 15+           |

---

## 5. Arsitektur Tech Stack & Lingkungan Sistem

### 5.1. Teknologi Utama

* **Framework Backend:** Laravel 13 (PHP 8.5.12)
* **Starter Kit & UI Interactivity:** Livewire 4 (dengan Alpine.js bawaan Livewire)
* **Styling Engine:** Tailwind CSS v4 (dikompilasi secara lokal via Vite menjadi aset statis CSS/JS)
* **UI Components:** Flux UI (terintegrasi dengan Livewire)
* **Admin Panel (CMS & PSB Management):** Custom Livewire Admin Panel menggunakan Flux UI components
* **Database:** MySQL 9.7.2
* **Library Pendukung (Murni PHP — Kompatibel Shared Hosting):**
  * **Generator PDF:** `barryvdh/laravel-dompdf` — untuk cetak bukti pendaftaran & kartu tes tanpa membutuhkan Node/Puppeteer.
  * **Generator Excel:** `openspout/openspout` (ringan, tanpa PhpSpreadsheet) atau Filament Native Exporter — untuk ekspor data santri baru ke `.xlsx`/`.csv`. Dipilih `openspout` karena lebih hemat memori di shared hosting dibanding `maatwebsite/excel`.
  * **Manipulasi Gambar:** `intervention/image` v3 — kompresi dan resize foto santri (maks 400×400px, format JPEG 80%) & *thumbnail* berita (maks 1200×800px, format WebP 85%) agar hemat ruang penyimpanan hosting.
  * **Activity Log:** `spatie/laravel-activitylog` — untuk audit trail perubahan status pendaftar oleh admin.

### 5.2. Strategi Khusus Tanpa SSH & Tanpa Node.js

1. **Local Build Asset:** Seluruh proses `pnpm install` dan `pnpm run build` dijalankan di komputer lokal (Laragon). Folder `public/build` (berisi `manifest.json`, file `.css`, dan `.js` hasil minifikasi) **wajib diikutsertakan** saat mengunggah file ke hosting.
2. **Pre-packaged Vendor:** Folder `vendor/` hasil `composer install --optimize-autoloader --no-dev` di lokal di-zip bersama proyek untuk diunggah ke hosting.
3. **Web-Based Deployment Helper Route:** Menyediakan *route* khusus `POST /system-setup` yang dilindungi oleh:
   * **One-time token** yang di-generate saat build (`DEPLOY_TOKEN` di `.env`), dan otomatis **non-aktif setelah digunakan sekali** (token dihapus dari `.env` setelah eksekusi).
   * **Rate limiting** 3 request per jam per IP.
   * **IP whitelist** opsional via `DEPLOY_ALLOWED_IPS` di `.env`.
   * Route ini mengeksekusi: `storage:link`, `migrate --force`, `optimize`.
4. **Cron Job via cPanel:** Untuk Laravel Scheduler (auto-publish scheduled posts, auto-detect gelombang), setup cron job melalui menu **Cron Jobs** di cPanel (tidak memerlukan SSH):

   ```bash
   * * * * * /usr/local/bin/php /home/username/daareltazkiyah_core/artisan schedule:run >> /dev/null 2>&1
   ```

---

## 6. Kebutuhan Fungsional (Functional Requirements)

### Modul 1: Landing Page Profil Pondok

1. **Header & Hero Section:**
   * Menampilkan logo resmi Daar El Tazkiyah, teks Arab yayasan, judul utama **"Pondok Pesantren Modern Tahfidzul Quran Daar El Tazkiyah Sumardi"**, serta *call-to-action* (CTA) menuju pendaftaran Tahun Ajaran 2027/2028.
   * Menampilkan foto dan nama Pengasuh: **Ust. Ahmad Ashil Fadhil, S.H., M.H.**
   * **AC:** Hero section ter-render dalam ≤ 2 detik di koneksi 3G. Tombol CTA mengarah ke form PSB atau halaman "PSB Ditutup" sesuai status gelombang.

2. **Seksi Visi & Misi:**
   * **Visi:** *"Melahirkan generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi dan siap mengabdi untuk umat."*
   * **Misi:**
     1. Menanamkan kecintaan kepada Al-Qur'an.
     2. Membentuk akhlak mulia dan disiplin.
     3. Memberikan pendidikan berkualitas berbasis Islam.
     4. Mempersiapkan santri berprestasi di tingkat nasional.

3. **Seksi Program Pendidikan & Rincian Biaya (MTS vs MDTA):**
   * Menampilkan perbandingan berdampingan yang jelas antara dua jenjang:

   | Komponen Informasi                                              | Jenjang MTS                                                                                | Jenjang MDTA                                                                            |
   | :-------------------------------------------------------------- | :----------------------------------------------------------------------------------------- | :-------------------------------------------------------------------------------------- |
   | **Sistem Pendidikan**                                           | **Mukim 24 Jam** — Pendidikan Formal setara SMP dengan pembinaan Tahfidz Al-Qur'an.        | **Sekolah Sore & Tidak Mukim** — Pendidikan Diniyah untuk anak-anak usia sekolah dasar. |
   | **Biaya Bulanan (SPP)**                                         | **Rp 500.000,- / bulan** *(Termasuk biaya makan 3x sehari, asrama, dan biaya pendidikan)*. | **Rp 12.000,- / bulan**.                                                                |
   | **Biaya Pendaftaran Gelombang I** *(1 Okt 2026 – 28 Feb 2027)*  | **Rp 100.000,-**                                                                           | **Rp 25.000,-**                                                                         |
   | **Biaya Pendaftaran Gelombang II** *(1 Mar 2027 – 30 Mei 2027)* | **Rp 150.000,-**                                                                           | **Rp 30.000,-**                                                                         |

   * **AC:** Biaya pendaftaran ditampilkan secara dinamis berdasarkan gelombang aktif. Nominal diambil dari tabel `admission_waves`.

4. **Seksi Daftar Tenaga Pendidik & Pembimbing:**
   * Menampilkan kartu profil/daftar ustadz & ustadzah pengajar (misal: *Ibu Hj. Dati Sumiyati, M.Pd.*, beserta pengajar lainnya yang dikelola secara dinamis dari database).

5. **Seksi Berita Terbaru & Galeri Kegiatan:**
   * Menampilkan 3–6 artikel berita terbaru dari modul CMS.
   * Menampilkan galeri foto kegiatan santri (dikelola via admin panel, lihat Modul 2).

6. **Halaman Kontak & Lokasi:**
   * Menampilkan alamat lengkap pesantren, nomor WhatsApp panitia, email (jika ada), embed Google Maps, dan jam operasional.
   * Data kontak diambil secara dinamis dari `site_settings`.

---

### Modul 2: CMS Berita, Galeri & Pengumuman

1. **Halaman Publik Berita:**
   * Daftar berita dengan fitur pencarian kata kunci, filter berdasarkan kategori (*Kabar Pondok, Prestasi Santri, Pengumuman PSB, Artikel Kajian*), dan *pagination* berbasis Livewire.
   * Halaman detail berita dengan URL ramah SEO (*slug*), estimasi waktu baca, berita terkait, dan tombol **Bagikan ke WhatsApp / Facebook** (dilengkapi *Open Graph Meta Tags* agar gambar *thumbnail* muncul saat link dibagikan di WhatsApp).
   * **AC:** Halaman berita memiliki tag `og:title`, `og:description`, dan `og:image` yang sesuai. Link preview muncul di WhatsApp saat di-share.

2. **Galeri Kegiatan Publik:**
   * Halaman galeri menampilkan album-album foto kegiatan (Tahfidz, Olahraga, Wisuda, dll.) dalam grid responsif.
   * Setiap album memiliki judul, deskripsi singkat, dan tanggal kegiatan.
   * **AC:** Gambar di-lazy-load. Thumbnail menggunakan format WebP. Lightbox untuk memperbesar foto.

3. **Manajemen Berita (Admin Panel):**
   * CRUD (*Create, Read, Update, Delete*) Artikel Berita dan Kategori.
   * *Rich Text Editor* untuk memformat teks, menyisipkan kutipan ayat Al-Qur'an, dan mengunggah foto di dalam badan berita.
   * Pengaturan status publikasi (`draft`, `published`, `scheduled`) dan penanda *Featured Post* (berita utama).
   * Untuk status `scheduled`: artikel otomatis ter-publish pada `published_at` melalui Laravel Scheduler yang berjalan via cron job cPanel (lihat Section 5.2 Point 4).
   * **AC:** Berita dengan status `scheduled` dan `published_at` ≤ now() otomatis berubah ke `published` pada jalannya scheduler berikutnya.

4. **Manajemen Galeri (Admin Panel):**
   * CRUD Album Galeri dan Foto di dalam album.
   * Upload multi-foto per album dengan kompresi otomatis (thumbnail WebP).
   * **AC:** Foto yang diupload otomatis di-resize dan dikompresi. Admin bisa mengatur urutan foto.

---

### Modul 3: Sistem Penerimaan Santri Baru (PSB) Online

1. **Deteksi Gelombang & Biaya Otomatis:**
   * Sistem secara otomatis mendeteksi gelombang pendaftaran yang sedang aktif berdasarkan `start_date` dan `end_date` pada tabel `admission_waves` (tanggal hari ini harus berada di antara keduanya).
   * Menampilkan nominal biaya pendaftaran yang sesuai saat calon santri memilih jenjang **MTS** atau **MDTA**.
   * **Jika tidak ada gelombang aktif** (tanggal di luar semua rentang gelombang): form pendaftaran **ditutup**, diganti halaman informasi "Pendaftaran Belum/Sudah Ditutup" dengan CTA kontak WhatsApp panitia.
   * **Constraint:** Hanya boleh ada **maksimal 1 gelombang aktif** pada satu waktu. Validasi ini diterapkan di level aplikasi saat admin membuat/mengedit gelombang.
   * **AC:** Given tanggal hari ini 15 Januari 2027, When user buka halaman PSB, Then Gelombang I aktif dan biaya MTS = Rp 100.000.
   * **AC:** Given tanggal hari ini 15 Juni 2027, When user buka halaman PSB, Then tampil halaman "Pendaftaran Ditutup".

2. **Formulir Pendaftaran Online (Multi-Step Livewire Form):**
   * **Langkah 1 — Pilihan Program:** Pilih jenjang (`MTS - Mukim 24 Jam` atau `MDTA - Sekolah Sore`). Menampilkan biaya pendaftaran berdasarkan gelombang aktif.
   * **Langkah 2 — Data Diri Calon Santri:** Nama Lengkap, NIK (16 digit), NISN (wajib untuk MTS, opsional untuk MDTA), Tempat & Tanggal Lahir, Jenis Kelamin, Anak ke- (urutan dalam keluarga), Asal Sekolah (SD/MI), Alamat Lengkap Santri.
   * **Langkah 3 — Data Orang Tua / Wali:** Nama Ayah, Nama Ibu, Pekerjaan Ayah, Pekerjaan Ibu, Penghasilan Rata-rata Keluarga, Nomor WhatsApp Aktif (Wajib), Alamat Orang Tua/Wali.
   * **Langkah 4 — Unggah Berkas & Bukti Pembayaran:** Pas Foto (3×4), Kartu Keluarga (KK), Akta Kelahiran, dan Bukti Transfer Biaya Pendaftaran. Format: JPG/PNG/PDF, maks 2MB per file. Upload satu per satu (sequential) untuk menghindari timeout di shared hosting.
   * **Validasi Duplikasi:** Sistem menolak pendaftaran jika NIK yang sama sudah terdaftar **di tahun ajaran yang sama** (lintas gelombang dan lintas program). Pesan error: "NIK ini sudah terdaftar untuk Tahun Ajaran 2027/2028."
   * **AC:** Given NIK `3201234567890123` sudah terdaftar di Gelombang I MTS, When user mencoba daftar lagi di Gelombang II MDTA, Then sistem menolak dengan pesan error.

3. **Nomor Registrasi & Notifikasi Bukti Daftar:**
   * Setelah formulir dikirim, sistem menghasilkan **Nomor Registrasi Unik** dengan format: `PSB-2027-MTS-0001` atau `PSB-2027-MDTA-0001` (tahun 4 digit, nomor urut 4 digit per program per tahun ajaran).
   * Halaman sukses menampilkan **access token unik** (8 karakter alfanumerik) yang harus disimpan oleh wali santri untuk mengakses halaman Cek Status.
   * Halaman sukses menyediakan tombol **Unduh Bukti Pendaftaran (PDF)** dan tombol **Konfirmasi ke WhatsApp Panitia** (dengan teks pesan otomatis berisi Nama & Nomor Registrasi).
   * **AC:** Nomor registrasi di-generate secara atomik (tidak duplikat meski 2 user submit bersamaan).

4. **Fitur Cek Status Pendaftaran Mandiri:**
   * Halaman khusus di mana wali santri dapat memasukkan **Nomor Registrasi** dan **Access Token** (diberikan saat pendaftaran berhasil) untuk melihat status terkini:
     * `pending` — Menunggu Verifikasi (Berkas & pembayaran sedang diperiksa).
     * `verified` — Terverifikasi / Lulus Administrasi (Dapat mengunduh Kartu Peserta).
     * `revision_needed` — Perlu Perbaikan Berkas (Menampilkan catatan dari panitia dan form unggah ulang berkas **serta form edit data teks**).
     * `accepted` — Diterima sebagai santri baru.
     * `reserve` — Cadangan (masuk daftar tunggu).
     * `rejected` — Ditolak (dengan catatan alasan dari panitia).
   * **Rate Limiting:** Maksimal 10 percobaan cek status per IP per jam.
   * **AC:** Given status `revision_needed` dengan catatan "Foto KK kurang jelas", When wali santri cek status, Then tampil catatan + form upload ulang KK + form edit data.

5. **Fitur Edit Data Pendaftar (oleh Wali Santri):**
   * Wali santri dapat mengedit data teks pendaftaran (nama, alamat, data ortu, dll.) dan mengunggah ulang berkas **selama status masih `pending` atau `revision_needed`**.
   * Setelah status `verified` atau lebih lanjut, data tidak bisa diedit oleh wali santri.
   * Akses via Nomor Registrasi + Access Token.
   * **AC:** Given status `verified`, When wali santri mencoba edit data, Then form edit tidak tersedia dengan pesan "Data sudah diverifikasi dan tidak dapat diubah."

6. **Dashboard Panitia PSB (Admin):**
   * Ringkasan metrik statistik: Total Pendaftar, Pendaftar MTS vs MDTA, Pendaftar Gelombang I vs II, distribusi status pembayaran, dan distribusi status pendaftaran.
   * Tabel manajemen pendaftar dengan fitur **pencarian** (nama/NIK/nomor registrasi), **sorting**, **filter** (jenjang, gelombang, status), dan **pagination**.
   * Pratinjau berkas/bukti transfer secara inline.
   * Ubah status verifikasi dengan catatan admin (setiap perubahan status tercatat di **audit log** dengan timestamp dan nama admin yang mengubah).
   * Tombol **Export ke Excel (`.xlsx`)** sesuai filter aktif.
   * **Kuota pendaftaran:** Setiap gelombang memiliki `max_quota_mts` dan `max_quota_mdta`. Jika kuota terisi, form pendaftaran untuk jenjang tersebut otomatis ditutup dengan pesan "Kuota pendaftaran [Jenjang] untuk [Gelombang] telah penuh."
   * **AC:** Given 50 pendaftar MTS dan `max_quota_mts` = 50, When user baru mencoba daftar MTS, Then form ditutup dengan pesan kuota penuh.

---

## 7. Rancangan Skema Database (Database Schema)

Berikut adalah rancangan tabel utama untuk migrasi Laravel. Semua tabel menggunakan `ULID` sebagai *primary key* untuk menghindari exposing auto-increment ID di URL.

### 7.1. Tabel `users` (Pengguna Admin)

| Nama Kolom          | Tipe Data                | Keterangan                                                           |
| :------------------ | :----------------------- | :------------------------------------------------------------------- |
| `id`                | `ulid` (PK)              | Primary Key                                                          |
| `name`              | `string`                 | Nama lengkap admin                                                   |
| `email`             | `string` (Unique)        | Email login                                                          |
| `email_verified_at` | `timestamp` (Nullable)   | Waktu verifikasi email                                               |
| `password`          | `string`                 | Password ter-hash                                                    |
| `role`              | `string`                 | Menggunakan PHP Backed Enum: `super_admin`, `admin_cms`, `admin_psb` |
| `remember_token`    | `string(100)` (Nullable) | Token "Remember Me"                                                  |
| `timestamps`        | `timestamp`              | `created_at`, `updated_at`                                           |

> **Strategi Auth:** Menggunakan Laravel Fortify (sudah terinstall) dengan guard `web` standar. Otorisasi berbasis `role` column menggunakan Laravel Gate/Policy. Tidak menggunakan package RBAC terpisah karena hanya ada 3 role tetap.

### 7.2. Tabel `admission_waves` (Gelombang PSB)

| Nama Kolom       | Tipe Data                    | Keterangan                                               |
| :--------------- | :--------------------------- | :------------------------------------------------------- |
| `id`             | `ulid` (PK)                  | Primary Key                                              |
| `name`           | `string`                     | Contoh: `Gelombang I`, `Gelombang II`                    |
| `slug`           | `string` (Unique)            | URL-friendly identifier, contoh: `gelombang-i-2027-2028` |
| `academic_year`  | `string`                     | Contoh: `2027/2028`                                      |
| `start_date`     | `date`                       | Tanggal mulai gelombang                                  |
| `end_date`       | `date`                       | Tanggal berakhir gelombang                               |
| `fee_mts`        | `unsignedBigInteger`         | Biaya daftar MTS dalam Rupiah (contoh: `100000`)         |
| `fee_mdta`       | `unsignedBigInteger`         | Biaya daftar MDTA dalam Rupiah (contoh: `25000`)         |
| `max_quota_mts`  | `unsignedInteger` (Nullable) | Kuota maksimal pendaftar MTS. Null = tanpa batas.        |
| `max_quota_mdta` | `unsignedInteger` (Nullable) | Kuota maksimal pendaftar MDTA. Null = tanpa batas.       |
| `timestamps`     | `timestamp`                  | `created_at`, `updated_at`                               |

> **Catatan:** Kolom `is_active` dihapus. Gelombang aktif ditentukan secara otomatis berdasarkan `start_date <= today <= end_date`. Ini mencegah konflik 2 gelombang aktif bersamaan (kecuali tanggalnya overlap, yang harus divalidasi saat admin input).

**Index:** `start_date`, `end_date`, `academic_year`.

### 7.3. Tabel `applicants` (Data Inti Pendaftar)

| Nama Kolom            | Tipe Data               | Keterangan                                                                                   |
| :-------------------- | :---------------------- | :------------------------------------------------------------------------------------------- |
| `id`                  | `ulid` (PK)             | Primary Key                                                                                  |
| `admission_wave_id`   | `foreignUlid`           | Relasi ke `admission_waves`                                                                  |
| `registration_number` | `string` (Unique)       | Format: `PSB-2027-MTS-0001`                                                                  |
| `access_token`        | `string(8)` (Unique)    | Token alfanumerik untuk akses cek status                                                     |
| `program_type`        | `string`                | PHP Backed Enum: `MTS`, `MDTA`                                                               |
| `full_name`           | `string`                | Nama lengkap calon santri                                                                    |
| `nik`                 | `string(16)`            | NIK calon santri                                                                             |
| `nisn`                | `string(10)` (Nullable) | NISN (wajib untuk MTS, opsional MDTA)                                                        |
| `gender`              | `string`                | PHP Backed Enum: `L` (Laki-laki), `P` (Perempuan)                                            |
| `birth_place`         | `string`                | Tempat lahir                                                                                 |
| `birth_date`          | `date`                  | Tanggal lahir                                                                                |
| `child_order`         | `unsignedTinyInteger`   | Anak ke- dalam keluarga                                                                      |
| `previous_school`     | `string`                | Sekolah asal (SD/MI)                                                                         |
| `address`             | `text`                  | Alamat lengkap santri                                                                        |
| `registration_fee`    | `unsignedBigInteger`    | Nominal biaya daftar saat mendaftar                                                          |
| `payment_status`      | `string`                | PHP Backed Enum: `unpaid`, `pending_verification`, `paid`, `rejected`                        |
| `application_status`  | `string`                | PHP Backed Enum: `pending`, `verified`, `revision_needed`, `accepted`, `reserve`, `rejected` |
| `admin_notes`         | `text` (Nullable)       | Catatan panitia (misal jika berkas kurang jelas)                                             |
| `timestamps`          | `timestamp`             | `created_at`, `updated_at`                                                                   |
| `deleted_at`          | `timestamp` (Nullable)  | Soft Delete                                                                                  |

**Index:** `registration_number`, `nik`, `access_token`, `program_type`, `application_status`, `payment_status`.  
**Unique Constraint:** `unique(['nik', 'admission_wave_id'])` — mencegah duplikasi NIK per tahun ajaran (lintas gelombang).

### 7.4. Tabel `applicant_parents` (Data Orang Tua/Wali)

| Nama Kolom       | Tipe Data              | Keterangan                                                                            |
| :--------------- | :--------------------- | :------------------------------------------------------------------------------------ |
| `id`             | `ulid` (PK)            | Primary Key                                                                           |
| `applicant_id`   | `foreignUlid` (Unique) | Relasi one-to-one ke `applicants`                                                     |
| `father_name`    | `string`               | Nama ayah kandung                                                                     |
| `mother_name`    | `string`               | Nama ibu kandung                                                                      |
| `father_job`     | `string` (Nullable)    | Pekerjaan ayah                                                                        |
| `mother_job`     | `string` (Nullable)    | Pekerjaan ibu                                                                         |
| `parent_income`  | `string` (Nullable)    | Rentang penghasilan keluarga (contoh: `< 1 Juta`, `1-3 Juta`, `3-5 Juta`, `> 5 Juta`) |
| `parent_phone`   | `string(20)`           | Nomor WhatsApp aktif orang tua/wali                                                   |
| `parent_address` | `text`                 | Alamat lengkap orang tua/wali                                                         |
| `timestamps`     | `timestamp`            | `created_at`, `updated_at`                                                            |

### 7.5. Tabel `applicant_documents` (Berkas Pendaftar)

| Nama Kolom      | Tipe Data     | Keterangan                                              |
| :-------------- | :------------ | :------------------------------------------------------ |
| `id`            | `ulid` (PK)   | Primary Key                                             |
| `applicant_id`  | `foreignUlid` | Relasi ke `applicants`                                  |
| `document_type` | `string`      | PHP Backed Enum: `photo`, `kk`, `akta`, `payment_proof` |
| `file_path`     | `string`      | Path file relatif ke storage disk                       |
| `original_name` | `string`      | Nama file asli saat diupload                            |
| `timestamps`    | `timestamp`   | `created_at`, `updated_at`                              |

**Index:** `applicant_id`, `document_type`.

> **Keuntungan normalisasi:** Mendukung re-upload tanpa mengubah record applicant. Mendukung multiple documents per type di masa depan. Memudahkan file cleanup (query semua file terpisah dari data pendaftar).

### 7.6. Tabel `categories` (Kategori Berita)

| Nama Kolom   | Tipe Data                | Keterangan                             |
| :----------- | :----------------------- | :------------------------------------- |
| `id`         | `ulid` (PK)              | Primary Key                            |
| `name`       | `string`                 | Nama kategori                          |
| `slug`       | `string` (Unique)        | URL-friendly identifier                |
| `parent_id`  | `foreignUlid` (Nullable) | Self-referencing FK untuk sub-kategori |
| `timestamps` | `timestamp`              | `created_at`, `updated_at`             |
| `deleted_at` | `timestamp` (Nullable)   | Soft Delete                            |

### 7.7. Tabel `posts` (Artikel Berita)

| Nama Kolom         | Tipe Data                | Keterangan                                                |
| :----------------- | :----------------------- | :-------------------------------------------------------- |
| `id`               | `ulid` (PK)              | Primary Key                                               |
| `category_id`      | `foreignUlid` (Nullable) | Relasi ke `categories`                                    |
| `author_id`        | `foreignUlid`            | Relasi ke `users`                                         |
| `title`            | `string`                 | Judul artikel                                             |
| `slug`             | `string` (Unique)        | URL-friendly identifier                                   |
| `excerpt`          | `text` (Nullable)        | Ringkasan singkat                                         |
| `content`          | `longText`               | Isi artikel (HTML dari rich text editor)                  |
| `featured_image`   | `string` (Nullable)      | Path gambar utama                                         |
| `status`           | `string`                 | PHP Backed Enum: `draft`, `published`, `scheduled`        |
| `is_featured`      | `boolean`                | Penanda berita utama. Default `false`.                    |
| `published_at`     | `timestamp` (Nullable)   | Waktu publikasi (untuk scheduled & published)             |
| `meta_title`       | `string` (Nullable)      | Custom meta title untuk SEO (fallback ke `title`)         |
| `meta_description` | `string` (Nullable)      | Custom meta description untuk SEO (fallback ke `excerpt`) |
| `timestamps`       | `timestamp`              | `created_at`, `updated_at`                                |
| `deleted_at`       | `timestamp` (Nullable)   | Soft Delete                                               |

**Index:** `slug`, `status`, `published_at`, `is_featured`.

> **Catatan `views_count`:** Dihapus dari tabel `posts` untuk menghindari write contention di setiap page view. Menggunakan **tabel terpisah** `post_views` atau **cache-based counter** yang di-flush ke database secara periodik via scheduler.

### 7.8. Tabel `post_views` (Statistik View Berita)

| Nama Kolom  | Tipe Data         | Keterangan                        |
| :---------- | :---------------- | :-------------------------------- |
| `id`        | `ulid` (PK)       | Primary Key                       |
| `post_id`   | `foreignUlid`     | Relasi ke `posts`                 |
| `viewed_at` | `date`            | Tanggal view (agregasi per hari)  |
| `count`     | `unsignedInteger` | Jumlah view pada tanggal tersebut |

**Unique Constraint:** `unique(['post_id', 'viewed_at'])`.

### 7.9. Tabel `galleries` & `gallery_photos` (Galeri Kegiatan)

* **`galleries`:** `id` (ULID), `title`, `slug` (Unique), `description` (Nullable), `event_date` (Date, Nullable), `cover_image` (Nullable), `sort_order` (Integer), `is_published` (Boolean), `timestamps`, `deleted_at`.
* **`gallery_photos`:** `id` (ULID), `gallery_id` (FK), `file_path`, `caption` (Nullable), `sort_order` (Integer), `timestamps`.

### 7.10. Tabel `teachers` (Daftar Tenaga Pendidik & Pembimbing)

* **`teachers`:** `id` (ULID), `full_name`, `role_title` (Pengasuh / Tenaga Pendidik / Pembimbing Tahfidz), `bio` (Text, Nullable), `specialization` (Nullable — mata pelajaran/bidang), `photo_path` (Nullable), `sort_order` (Integer), `is_active` (Boolean), `timestamps`, `deleted_at`.

### 7.11. Tabel `site_settings` (Pengaturan Dinamis)

| Nama Kolom   | Tipe Data           | Keterangan                                                |
| :----------- | :------------------ | :-------------------------------------------------------- |
| `id`         | `ulid` (PK)         | Primary Key                                               |
| `key`        | `string` (Unique)   | Identifier setting, contoh: `psb_whatsapp_number`         |
| `value`      | `text` (Nullable)   | Nilai setting                                             |
| `group`      | `string` (Nullable) | Grup setting: `general`, `psb`, `social_media`, `billing` |
| `timestamps` | `timestamp`         | `created_at`, `updated_at`                                |

**Setting yang harus di-seed:**

| Key                   | Group          | Contoh Value                                                     |
| :-------------------- | :------------- | :--------------------------------------------------------------- |
| `school_name`         | `general`      | Pondok Pesantren Modern Tahfidzul Quran Daar El Tazkiyah Sumardi |
| `school_address`      | `general`      | (Alamat lengkap)                                                 |
| `school_phone`        | `general`      | (Nomor telepon)                                                  |
| `school_email`        | `general`      | (Email)                                                          |
| `psb_whatsapp_number` | `psb`          | 6281234567890                                                    |
| `bank_account_name`   | `billing`      | (Nama rekening)                                                  |
| `bank_account_number` | `billing`      | (Nomor rekening)                                                 |
| `bank_name`           | `billing`      | (Nama bank)                                                      |
| `monthly_fee_mts`     | `billing`      | 500000                                                           |
| `monthly_fee_mdta`    | `billing`      | 12000                                                            |
| `facebook_url`        | `social_media` | (URL)                                                            |
| `instagram_url`       | `social_media` | (URL)                                                            |

### 7.12. Data Seeder Awal

| Tabel             | Data Awal                                                     |
| :---------------- | :------------------------------------------------------------ |
| `users`           | 1 Super Admin account                                         |
| `admission_waves` | Gelombang I & II TA 2027/2028 dengan biaya sesuai brosur      |
| `categories`      | Kabar Pondok, Prestasi Santri, Pengumuman PSB, Artikel Kajian |
| `site_settings`   | Seluruh key dari tabel di atas                                |
| `teachers`        | Data awal tenaga pendidik (minimal Pengasuh)                  |

---

## 8. Kebutuhan Non-Fungsional (Non-Functional Requirements)

### 8.1. Performa di Shared Hosting

* Penggunaan *database indexing* sebagaimana didefinisikan di setiap tabel pada Section 7.
* Gambar yang diunggah oleh pendaftar santri wajib dibatasi maksimal `2MB` per file dan divalidasi tipe MIME-nya (`jpg, jpeg, png, pdf`).
* **Validasi keamanan file upload:** Validasi ekstensi ganda (menolak `file.php.jpg`), rename file ke UUID/ULID, simpan di private disk (`storage/app/private/documents`).
* **Image optimization:** Foto di-resize dan dikompresi secara otomatis (lihat spesifikasi di Section 5.1).
* **Caching strategy:**
  * **Page cache:** Landing page (cache 1 jam, invalidate saat konten berubah).
  * **Fragment cache:** Widget berita terbaru (cache 15 menit), daftar pengajar (cache 1 jam).
  * **Query cache:** Data gelombang aktif (cache 1 jam, invalidate saat admin edit).
* **File cleanup:** Scheduled task (harian) menghapus file orphan dari `applicant_documents` yang tidak ter-link ke applicant manapun (misal upload gagal).

### 8.2. Keamanan (Security)

* Proteksi CSRF dan XSS bawaan Laravel/Blade.
* Pembatasan laju (*Rate Limiting*):
  * Formulir pendaftaran PSB: 5 submit per IP per jam.
  * Halaman Cek Status: 10 percobaan per IP per jam.
  * Deployment helper route: 3 request per IP per jam.
* Dokumen sensitif santri (KK & Akta) disimpan di **private disk** dan hanya dapat diakses oleh Admin yang terautentikasi atau melalui URL bertanda tangan (*signed URL*) dengan expiry 5 menit.
* Deployment helper route menggunakan POST method, one-time token, rate limiting, dan opsional IP whitelist (lihat Section 5.2 Point 3).
* Semua file upload di-rename ke UUID, disimpan di luar `public_html`, dan divalidasi untuk ekstensi ganda.
* **Production checklist:** `APP_ENV=production`, `APP_DEBUG=false`, `APP_KEY` di-generate dengan `php artisan key:generate`.

### 8.3. SEO & Social Sharing

* Setiap halaman berita dan halaman informasi PSB memiliki meta tag `og:title`, `og:description`, dan `og:image` dinamis agar tampil rapi saat dibagikan di grup WhatsApp.
* Halaman berita memiliki custom `meta_title` dan `meta_description` yang bisa di-override oleh admin. Fallback ke `title` dan `excerpt`.
* Favicon dan PWA manifest (untuk "Add to Home Screen" di mobile).

### 8.4. Monitoring & Logging

* Akses `storage/logs/laravel.log` via cPanel File Manager untuk troubleshooting.
* Opsional: integrasi notifikasi error ke WhatsApp/Telegram admin via custom log channel.

### 8.5. Backup Strategy

* Backup database berkala (mingguan) via fitur **Backup** di cPanel atau export manual phpMyAdmin.
* Backup folder `storage/app/private/documents` secara berkala via cPanel File Manager (download zip).
* Dokumentasi SOP backup di `DEPLOYMENT.md`.

---

## 9. Roadmap Pengembangan

| Fase                                     | Rentang Waktu           | Fokus Pengerjaan & Deliverable                                                                                                                                                                                                                                                                |
| :--------------------------------------- | :---------------------- | :-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Fase 1: Inisiasi & Fondasi**           | Bulan 1 – 2             | Setup proyek Laravel 13 + Livewire di Laragon, konfigurasi Design System Tailwind (custom color `brand-green` & Gold), pembuatan seluruh migrasi database, model Eloquent dengan relasi, PHP Backed Enums, dan *seeder* data awal. Setup Fortify auth + role-based gates.                     |
| **Fase 2: Landing Page & Profil**        | Bulan 3 – 4             | Pembangunan halaman publik utama (Hero Section, Sambutan Pengasuh, Kartu Perbandingan MTS vs MDTA, Rincian Biaya, Daftar Pengajar, Halaman Kontak, dan Footer).                                                                                                                               |
| **Fase 3: CMS Berita & Admin Panel**     | Bulan 5 – 6             | Pembangunan Admin Panel (Custom Livewire + Flux UI) untuk manajemen Berita, Kategori, Pengajar, Galeri, dan Site Settings. Pembuatan halaman baca berita publik + galeri publik.                                                                                                              |
| **Fase 4: Modul PSB End-to-End**         | Bulan 7 – 8             | Pembangunan form pendaftaran *multi-step*, fitur unggah berkas sequential, generator Nomor Registrasi + Access Token, halaman Cek Status + Edit Data, cetak bukti daftar (DomPDF), Dashboard Panitia dengan search/filter/pagination, fitur Export Excel, dan audit log.                      |
| **Fase 5: Pengujian & Optimasi Hosting** | Bulan 9                 | *User Acceptance Testing* (UAT) di berbagai ukuran layar HP & browser target. Uji coba upload berkas di shared hosting (timeout handling). Implementasi caching strategy. Pembuatan deployment helper route. Simulasi *build* produksi. Penulisan `DEPLOYMENT.md`.                            |
| **Fase 6: Deployment & Go-Live**         | Bulan 10 (Agustus 2027) | Upload paket rilis ke cPanel Shared Hosting, konfigurasi `.env` produksi (termasuk `APP_ENV=production`, `APP_DEBUG=false`), setup cron job cPanel, import database MySQL, post-deployment verification checklist, serta pelatihan singkat penggunaan *dashboard* untuk admin/panitia pondok. |

---

## 10. Asumsi, Batasan & Risiko

### 10.1. Asumsi

* Shared hosting target mendukung PHP 8.3+ dan MySQL 8.0+ / MariaDB 10.6+.
* Shared hosting menyediakan fitur **Cron Jobs** di cPanel.
* Volume pendaftar per tahun ajaran diperkirakan ≤ 500 orang (tidak memerlukan arsitektur high-concurrency).
* Admin/panitia memiliki literasi digital dasar untuk mengoperasikan dashboard.

### 10.2. Batasan (Constraints)

* Tidak ada akses SSH ke server hosting.
* Tidak ada runtime Node.js di server hosting.
* Memory limit shared hosting umumnya 256MB–512MB (mempengaruhi pilihan library Excel).
* Execution time limit shared hosting umumnya 30–120 detik (mempengaruhi strategi upload file).

### 10.3. Risiko & Mitigasi

| Risiko                                                | Dampak                                  | Probabilitas | Mitigasi                                                                              |
| :---------------------------------------------------- | :-------------------------------------- | :----------- | :------------------------------------------------------------------------------------ |
| Shared hosting tidak support PHP 8.3                  | Aplikasi tidak bisa berjalan            | Rendah       | Konfirmasi versi PHP sebelum beli hosting. Pilih hosting yang sudah support PHP 8.3+. |
| Upload file timeout di shared hosting                 | User gagal upload berkas                | Sedang       | Upload sequential (1 file per request). Kompresi client-side sebelum upload.          |
| `openspout` kehabisan memori saat export ratusan data | Export Excel gagal                      | Rendah       | Gunakan streaming export. Limit export max 1000 baris per request.                    |
| Data pendaftar terhapus tidak sengaja                 | Kehilangan data sensitif                | Rendah       | SoftDeletes di semua tabel kritis. Backup berkala.                                    |
| Deployment token bocor                                | Unauthorized access ke migrate/optimize | Rendah       | One-time token + auto-disable. Rate limiting. IP whitelist.                           |

---

## 11. Glosarium

| Istilah         | Definisi                                                                           |
| :-------------- | :--------------------------------------------------------------------------------- |
| **MTS**         | Madrasah Tsanawiyah — jenjang pendidikan formal setara SMP.                        |
| **MDTA**        | Madrasah Diniyah Takmiliyah Awaliyah — pendidikan diniyah/keagamaan non-formal.    |
| **PSB**         | Penerimaan Santri Baru — proses seleksi dan pendaftaran santri baru.               |
| **NIK**         | Nomor Induk Kependudukan — nomor identitas 16 digit pada KTP/KK.                   |
| **NISN**        | Nomor Induk Siswa Nasional — nomor identitas 10 digit siswa di sistem Kemendikbud. |
| **Mukim**       | Sistem asrama/boarding — santri tinggal di pondok pesantren 24 jam.                |
| **PPMTQ**       | Pondok Pesantren Modern Tahfidzul Quran.                                           |
| **Tahfidz**     | Program penghafalan Al-Qur'an.                                                     |
| **Gelombang**   | Periode/batch pendaftaran santri baru (umumnya 2 gelombang per tahun ajaran).      |
| **Wali Santri** | Orang tua atau wali yang bertanggung jawab atas santri.                            |
