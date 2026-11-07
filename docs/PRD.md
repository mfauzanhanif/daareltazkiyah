# Product Requirements Document (PRD)
**Nama Proyek:** Portal Web, CMS Berita & Sistem PSB — PPMTQ Daar El Tazkiyah Sumardi  
**Nama Instansi:** Pondok Pesantren Modern Tahfidzul Quran (PPMTQ) Daar El Tazkiyah Sumardi  
**Pengasuh:** Ust. Ahmad Ashil Fadhil, S.H., M.H.  
**Versi Dokumen:** 1.0  
**Target Deployment:** Agustus 2027 (Shared Hosting — Tanpa SSH & Tanpa Node.js)

---

## 1. Ringkasan Eksekutif (Executive Summary)
Proyek ini bertujuan untuk membangun platform digital resmi **Pondok Pesantren Modern Tahfidzul Quran (PPMTQ) Daar El Tazkiyah Sumardi** (*Ma'had Dar Al-Tazkiyah Sumardi Al-Islami Li Tahfizhil Qur'an*). Sistem ini dirancang untuk memenuhi tiga kebutuhan utama dalam satu aplikasi terintegrasi:
1. **Landing Page Profil Pondok:** Menampilkan identitas pesantren, profil pengasuh, visi-misi, program pendidikan (**MTS Mukim 24 Jam** & **MDTA Sekolah Sore**), rincian biaya, serta daftar tenaga pendidik.
2. **Content Management System (CMS) Berita:** Media publikasi kegiatan santri, kajian, artikel keislaman, dan pengumuman resmi pondok.
3. **Sistem Penerimaan Santri Baru (PSB) Online:** Portal pendaftaran terpadu untuk Tahun Ajaran 2027/2028 (Gelombang I & II) lengkap dengan unggah berkas, cek status kelulusan/verifikasi, cetak kartu bukti pendaftaran (PDF), dan rekapitulasi data panitia (Excel).

Mengingat infrastruktur target menggunakan **Shared Hosting standar (tanpa akses SSH dan tanpa runtime Node.js)**, aplikasi dikembangkan menggunakan **Laravel 13 + Livewire** di lingkungan lokal (Laragon) dengan mekanisme *pre-compiled static assets* (`npm run build` di lokal) dan *deployment helper* berbasis HTTP route.

---

## 2. Tujuan & Sasaran Proyek (Goals & Objectives)
* **Digitalisasi Informasi & Branding:** Membangun citra pesantren modern tahfidzul Qur'an yang kredibel, transparan dalam rincian biaya, serta mudah diakses oleh calon wali santri melalui perangkat *mobile* (HP).
* **Otomasi Administrasi PSB:** Memangkas proses pencatatan manual panitia PSB untuk jenjang **MTS** dan **MDTA**, termasuk otomatisasi perhitungan biaya pendaftaran berdasarkan gelombang aktif.
* **Kemandirian Pengelolaan Konten:** Memudahkan pengurus/admin pondok dalam menerbitkan berita, mengubah jadwal gelombang PSB, dan memperbarui daftar pengajar melalui *dashboard* admin tanpa menyentuh kode program.
* **Zero-Friction Shared Hosting Deployment:** Memastikan aplikasi dapat diunggah cukup melalui File Manager cPanel (`.zip`) dan phpMyAdmin (`.sql`) tanpa ketergantungan pada terminal SSH maupun server Node.js.

---

## 3. Target Pengguna (User Personas)

| Peran Pengguna | Deskripsi & Karakteristik | Kebutuhan Utama |
| :--- | :--- | :--- |
| **Calon Wali Santri / Pengunjung** | Orang tua/wali murid (mayoritas mengakses via *smartphone* dari grup WhatsApp/Media Sosial). | Membaca profil pesantren, membandingkan program MTS vs MDTA, melihat rincian biaya, mengisi formulir pendaftaran, mengunggah bukti transfer/berkas, serta mengecek status pendaftaran & mencetak kartu bukti daftar. |
| **Admin CMS / Humas Pondok** | Pengurus pondok yang bertugas mengelola informasi publik. | Menulis dan menerbitkan berita kegiatan, mengatur galeri foto, serta memperbarui daftar tenaga pendidik dan pengumuman. |
| **Panitia PSB (Admin TU)** | Staf administrasi penerimaan santri baru. | Memverifikasi data & bukti pembayaran pendaftar, mengubah status pendaftaran, mencetak kartu santri, serta mengunduh laporan rekapitulasi pendaftar ke dalam format Excel (`.xlsx`). |

---

## 4. Spesifikasi Desain & UI/UX (Design System)

Desain mengadaptasi identitas visual dari **Logo Kufi Geometris Daar El Tazkiyah** dan **Brosur Resmi PSB**, yang diterjemahkan ke dalam antarmuka web modern (*Modern Emerald & Gold Islamic UI*).

### 4.1. Palet Warna (Tailwind CSS Color Tokens)
* **Primary Brand (Deep Forest Green):** `#084C27` / `emerald-950` hingga `emerald-800` (Digunakan untuk Navbar, Footer, dan latar utama Hero).
* **Secondary Emerald (Vibrant Green):** `#059669` / `emerald-600` (Digunakan untuk *gradient card header*, ikon *checklist* Misi, dan *badge* program).
* **Accent / Gold (Warm Amber):** `#D97706` hingga `#F59E0B` / `amber-500` (Digunakan sebagai pengganti pita emas pada brosur untuk tombol CTA **"Daftar Sekarang"**, *border highlight*, dan penanda gelombang aktif).
* **Background & Surface:**
  * *Main Background:* `#FDFBF7` (*Warm Off-White / Alabaster*) atau `#F8FAFC` (`slate-50`).
  * *Card Surface:* `#FFFFFF` (`white`) dengan *border* halus `border-emerald-900/10` dan bayangan lembut `shadow-sm`.

### 4.2. Tipografi
* **Kaligrafi / Teks Arab Header:** `Amiri` atau `Scheherazade New` — untuk teks:
  > معهد دار التزكية سوماردي الإسلامي لتحفيظ القرآن
* **Heading & Kutipan Visi:** `Playfair Display` (Serif elegan untuk menonjolkan kutipan Visi pesantren) dikombinasikan dengan `Plus Jakarta Sans` (Bold/ExtraBold) untuk judul seksi dan nama pesantren.
* **Body Text, Tabel Biaya & Form:** `Plus Jakarta Sans` atau `Inter` — memastikan keterbacaan angka nominal rupiah, tanggal gelombang, dan artikel berita di layar kecil.

### 4.3. Prinsip Tata Letak & Elemen Visual
* **Mobile-First & Thumb-Friendly:** Navigasi bawah atau tombol *floating* WhatsApp Panitia PSB yang selalu mudah dijangkau di layar HP.
* **Modern Islamic Arch & Geometric Pattern:** Foto Pengasuh (**Ust. Ahmad Ashil Fadhil, S.H., M.H.**) ditampilkan dalam bingkai lengkung kubah modern (*arch frame*) dengan *border* emas tipis, berlatar belakang pola garis geometris Kufi ber-opasitas rendah (`5%`).
* **Bento Grid & Comparison Cards:** Visi, Misi, dan Program Pendidikan (MTS vs MDTA) disusun menggunakan kartu bersih ber-sudut membulat (`rounded-2xl`) tanpa efek *3D bevel* berlebih agar tampak profesional dan modern.

---

## 5. Arsitektur Tech Stack & Lingkungan Sistem

### 5.1. Teknologi Utama
* **Framework Backend:** Laravel 13 (PHP 8.2 / 8.3+)
* **Starter Kit & UI Interactivity:** Livewire (dengan Alpine.js bawaan Livewire)
* **Styling Engine:** Tailwind CSS (dikompilasi secara lokal via Vite menjadi aset statis CSS/JS)
* **Admin Panel (CMS & PSB Management):** FilamentPHP v3/v4 (terintegrasi penuh dengan tumpukan Livewire) atau Custom Livewire Admin Panel
* **Database:** MySQL / MariaDB
* **Library Pendukung (Murni PHP — Kompatibel Shared Hosting):**
  * **Generator PDF:** `barryvdh/laravel-dompdf` (untuk cetak bukti pendaftaran & kartu tes tanpa membutuhkan Node/Puppeteer).
  * **Generator Excel:** `maatwebsite/excel` atau Filament Native Exporter (untuk ekspor data santri baru ke `.xlsx`/`.csv`).
  * **Manipulasi Gambar:** `intervention/image` atau optimasi *upload* bawaan Filament (kompresi ukuran foto santri & *thumbnail* berita agar hemat ruang penyimpanan hosting).

### 5.2. Strategi Khusus Tanpa SSH & Tanpa Node.js
1. **Local Build Asset:** Seluruh proses `npm install` dan `npm run build` dijalankan di komputer lokal (Laragon). Folder `public/build` (berisi `manifest.json`, file `.css`, dan `.js` hasil minifikasi) **wajib diikutsertakan** saat mengunggah file ke hosting.
2. **Pre-packaged Vendor:** Folder `vendor/` hasil `composer install --optimize-autoloader --no-dev` di локаl di-zip bersama proyek untuk diunggah ke hosting.
3. **Web-Based Utility Route (Pengganti Terminal SSH):** Menyediakan *route* khusus yang dilindungi `SECRET_DEPLOY_KEY` pada file `.env` untuk mengeksekusi perintah penting via browser:
   * Membuat *symlink* folder penyimpanan (`Artisan::call('storage:link')`) atau menyalin *file* ke `public/storage`.
   * Menjalankan migrasi database (`Artisan::call('migrate', ['--force' => true])`).
   * Membersihkan *cache* (`Artisan::call('optimize:clear')`).

---

## 6. Kebutuhan Fungsional (Functional Requirements)

### Modul 1: Landing Page Profil Pondok
1. **Header & Hero Section:**
   * Menampilkan logo resmi Daar El Tazkiyah, teks Arab yayasan, judul utama **"Pondok Pesantren Modern Tahfidzul Quran Daar El Tazkiyah Sumardi"**, serta *call-to-action* (CTA) menuju pendaftaran Tahun Ajaran 2027/2028.
   * Menampilkan foto dan nama Pengasuh: **Ust. Ahmad Ashil Fadhil, S.H., M.H.**
2. **Seksi Visi & Misi:**
   * **Visi:** *"Melahirkan generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi dan siap mengabdi untuk umat."*
   * **Misi:**
     1. Menanamkan kecintaan kepada Al-Qur'an.
     2. Membentuk akhlak mulia dan disiplin.
     3. Memberikan pendidikan berkualitas berbasis Islam.
     4. Mempersiapkan santri berprestasi di tingkat nasional.
3. **Seksi Program Pendidikan & Rincian Biaya (MTS vs MDTA):**
   * Menampilkan perbandingan berdampingan yang jelas antara dua jenjang:

| Komponen Informasi | Jenjang MTS | Jenjang MDTA |
| :--- | :--- | :--- |
| **Sistem Pendidikan** | **Mukim 24 Jam** — Pendidikan Formal setara SMP dengan pembinaan Tahfidz Al-Qur'an. | **Sekolah Sore & Tidak Mukim** — Pendidikan Diniyah untuk anak-anak usia sekolah dasar. |
| **Biaya Bulanan (SPP)** | **Rp 500.000,- / bulan** *(Termasuk biaya makan 3x sehari, asrama, dan biaya pendidikan)*. | **Rp 12.000,- / bulan**. |
| **Biaya Pendaftaran Gelombang I** *(1 Okt 2026 – 28 Feb 2027)* | **Rp 100.000,-** | **Rp 25.000,-** |
| **Biaya Pendaftaran Gelombang II** *(1 Mar 2027 – 30 Mei 2027)* | **Rp 150.000,-** | **Rp 30.000,-** |

4. **Seksi Daftar Tenaga Pendidik & Pembimbing:**
   * Menampilkan kartu profil/daftar ustadz & ustadzah pengajar (misal: *Ibu Hj. Dati Sumiyati, M.Pd.*, beserta pengajar lainnya yang dikelola secara dinamis dari database).
5. **Seksi Berita Terbaru & Galeri Kegiatan:**
   * Menampilkan 3–6 artikel berita terbaru dari modul CMS serta dokumentasi aktivitas santri.

---

### Modul 2: CMS Berita & Pengumuman
1. **Halaman Publik Berita:**
   * Daftar berita dengan fitur pencarian kata kunci, filter berdasarkan kategori (*Kabar Pondok, Prestasi Santri, Pengumuman PSB, Artikel Kajian*), dan *pagination* berbasis Livewire.
   * Halaman detail berita dengan URL ramah SEO (*slug*), estimasi waktu baca, berita terkait, dan tombol **Bagikan ke WhatsApp / Facebook** (dilengkapi *Open Graph Meta Tags* agar gambar *thumbnail* muncul saat link dibagikan di WhatsApp).
2. **Manajemen Berita (Admin Panel):**
   * CRUD (*Create, Read, Update, Delete*) Artikel Berita dan Kategori.
   * *Rich Text Editor* untuk memformat teks, menyisipkan kutipan ayat Al-Qur'an, dan mengunggah foto di dalam badan berita.
   * Pengaturan status publikasi (*Draft*, *Published*, *Scheduled*) dan penanda *Featured Post* (berita utama).

---

### Modul 3: Sistem Penerimaan Santri Baru (PSB) Online
1. **Deteksi Gelombang & Biaya Otomatis:**
   * Sistem secara otomatis mendeteksi gelombang pendaftaran yang sedang aktif berdasarkan tanggal hari ini (Gelombang I atau Gelombang II) dan menampilkan nominal biaya pendaftaran yang sesuai saat calon santri memilih jenjang **MTS** atau **MDTA**.
2. **Formulir Pendaftaran Online (Multi-Step Livewire Form):**
   * **Langkah 1 — Pilihan Program:** Pilih jenjang (`MTS - Mukim 24 Jam` atau `MDTA - Sekolah Sore`).
   * **Langkah 2 — Data Diri Calon Santri:** Nama Lengkap, NIK, NISN (opsional untuk MDTA), Tempat & Tanggal Lahir, Jenis Kelamin, Anak ke-, Asal Sekolah, Alamat Lengkap.
   * **Langkah 3 — Data Orang Tua / Wali:** Nama Ayah & Ibu, Pekerjaan, Penghasilan Rata-rata, Nomor WhatsApp Aktif (Wajib), Alamat Orang Tua.
   * **Langkah 4 — Unggah Berkas & Bukti Pembayaran:** Pas Foto, Kartu Keluarga (KK), Akta Kelahiran, dan Bukti Transfer Biaya Pendaftaran (format JPG/PNG/PDF, maks 2MB per file).
3. **Nomor Registrasi & Notifikasi Bukti Daftar:**
   * Setelah formulir dikirim, sistem menghasilkan **Nomor Registrasi Unik** (contoh: `PSB-2027-MTS-0001` atau `PSB-2027-MDTA-0001`).
   * Halaman sukses menyediakan tombol **Unduh Bukti Pendaftaran (PDF)** dan tombol **Konfirmasi ke WhatsApp Panitia** (dengan teks pesan otomatis berisi Nama & Nomor Registrasi).
4. **Fitur Cek Status Pendaftaran Mandiri:**
   * Halaman khusus di mana wali santri dapat memasukkan **Nomor Registrasi** dan **NIK / Nomor WhatsApp** untuk melihat status terkini:
     * `Menunggu Verifikasi` (Berkas & pembayaran sedang diperiksa).
     * `Terverifikasi / Lulus Administrasi` (Dapat mengunduh Kartu Peserta / Bukti Diterima).
     * `Perlu Perbaikan Berkas` (Menampilkan catatan dari panitia dan form unggah ulang berkas).
     * `Diterima` / `Cadangan`.
5. **Dashboard Panitia PSB (Admin):**
   * Ringkasan metrik statistik: Total Pendaftar, Pendaftar MTS vs MDTA, Pendaftar Gelombang I vs II, dan status pembayaran.
   * Tabel manajemen pendaftar dengan fitur pratinjau berkas/bukti transfer, ubah status verifikasi satu klik, dan tombol **Export ke Excel (`.xlsx`)** sesuai filter jenjang atau gelombang.

---

## 7. Rancangan Skema Database (Database Schema)

Berikut adalah rancangan tabel utama untuk migrasi Laravel:

### 7.1. Tabel `admission_waves` (Gelombang PSB)
| Nama Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | `bigint` (PK) | Primary Key |
| `name` | `string` | Contoh: `Gelombang I`, `Gelombang II` |
| `academic_year` | `string` | Contoh: `2027/2028` |
| `start_date` | `date` | Tanggal mulai gelombang |
| `end_date` | `date` | Tanggal berakhir gelombang |
| `fee_mts` | `unsignedInteger` | Biaya daftar MTS (Contoh: `100000` atau `150000`) |
| `fee_mdta` | `unsignedInteger` | Biaya daftar MDTA (Contoh: `25000` atau `30000`) |
| `is_active` | `boolean` | Status gelombang aktif |
| `timestamps` | `timestamp` | `created_at`, `updated_at` |

### 7.2. Tabel `applicants` (Data Pendaftar Santri Baru)
| Nama Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | `bigint` (PK) | Primary Key |
| `admission_wave_id` | `foreignId` | Relasi ke `admission_waves` |
| `registration_number` | `string` (Unique) | Contoh: `PSB-27-MTS-0001` |
| `program_type` | `enum('MTS', 'MDTA')` | Pilihan jenjang pendidikan |
| `full_name` | `string` | Nama lengkap calon santri |
| `nik` | `string(16)` | NIK calon santri |
| `nisn` | `string(10)` (Nullable) | NISN (wajib untuk MTS, opsional MDTA) |
| `gender` | `enum('L', 'P')` | Jenis kelamin |
| `birth_place` | `string` | Tempat lahir |
| `birth_date` | `date` | Tanggal lahir |
| `previous_school` | `string` | Sekolah asal (SD/MI) |
| `address` | `text` | Alamat lengkap santri |
| `father_name` | `string` | Nama ayah kandung |
| `mother_name` | `string` | Nama ibu kandung |
| `parent_phone` | `string(20)` | Nomor WhatsApp aktif orang tua/wali |
| `parent_job` | `string` (Nullable) | Pekerjaan orang tua |
| `registration_fee` | `unsignedInteger` | Nominal biaya daftar saat mendaftar |
| `payment_proof_path` | `string` (Nullable) | Path file bukti pembayaran |
| `payment_status` | `enum` | `unpaid`, `pending_verification`, `paid`, `rejected` |
| `photo_path` | `string` (Nullable) | Path pas foto santri |
| `kk_path` | `string` (Nullable) | Path scan/foto Kartu Keluarga |
| `akta_path` | `string` (Nullable) | Path scan/foto Akta Kelahiran |
| `application_status` | `enum` | `pending`, `verified`, `revision_needed`, `accepted`, `rejected` |
| `admin_notes` | `text` (Nullable) | Catatan panitia (misal jika berkas kurang jelas) |
| `timestamps` | `timestamp` | `created_at`, `updated_at` |

### 7.3. Tabel `posts` & `categories` (CMS Berita)
* **`categories`:** `id`, `name`, `slug`, `timestamps`.
* **`posts`:** `id`, `category_id` (FK), `author_id` (FK to `users`), `title`, `slug` (Unique), `excerpt`, `content` (LongText), `featured_image`, `is_published` (Boolean), `published_at` (Timestamp), `views_count` (Integer), `timestamps`.

### 7.4. Tabel `teachers` (Daftar Tenaga Pendidik & Pembimbing)
* **`teachers`:** `id`, `full_name` (Contoh: *Ibu Hj. Dati Sumiyati, M.Pd.*), `role_title` (Pengasuh / Tenaga Pendidik / Pembimbing Tahfidz), `photo_path` (Nullable), `sort_order` (Integer), `is_active` (Boolean), `timestamps`.

### 7.5. Tabel `site_settings` (Pengaturan Dinamis)
* **`site_settings`:** Menyimpan konfigurasi seperti nomor rekening pondok, nomor WhatsApp panitia PSB, biaya bulanan MTS (`500000`), biaya bulanan MDTA (`12000`), alamat lengkap pondok, dan link media sosial.

---

## 8. Kebutuhan Non-Fungsional (Non-Functional Requirements)
1. **Performa di Shared Hosting:**
   * Penggunaan *database indexing* pada kolom `registration_number`, `nik`, `slug`, dan `program_type`.
   * Gambar yang diunggah oleh pendaftar santri wajib dibatasi maksimal `2MB` dan divalidasi tipe MIME-nya (`jpg, jpeg, png, pdf`) agar tidak menghabiskan *disk quota* cPanel.
2. **Keamanan (Security):**
   * Proteksi CSRF dan XSS bawaan Laravel/Blade.
   * Pembatasan laju (*Rate Limiting*) pada formulir pendaftaran PSB dan halaman Cek Status untuk mencegah *spam bot*.
   * Dokumen sensitif santri (KK & Akta) hanya dapat diakses oleh Admin yang terautentikasi atau melalui URL bertanda tangan (*signed URL*).
3. **SEO & Social Sharing:**
   * Setiap halaman berita dan halaman informasi PSB memiliki meta tag `og:title`, `og:description`, dan `og:image` dinamis agar tampil rapi saat dibagikan di grup WhatsApp.

---

## 9. Roadmap Pengembangan (10 Bulan Menuju Agustus 2027)

| Fase | Rentang Waktu | Fokus Pengerjaan & Deliverable |
| :--- | :--- | :--- |
| **Fase 1: Inisiasi & Fondasi** | Bulan 1 – 2 | Setup proyek Laravel 13 + Livewire di Laragon, konfigurasi Design System Tailwind (warna Emerald & Gold), pembuatan migrasi database, dan *seeder* data awal (Gelombang PSB, Tenaga Pendidik, Visi-Misi). |
| **Fase 2: Landing Page & Profil** | Bulan 3 – 4 | Pembangunan halaman publik utama (Hero Section, Sambutan Pengasuh, Kartu Perbandingan MTS vs MDTA, Rincian Biaya, Daftar Pengajar, dan Footer). |
| **Fase 3: CMS Berita & Admin Panel** | Bulan 5 – 6 | Integrasi Admin Panel (Filament/Livewire) untuk manajemen Berita, Kategori, Pengajar, dan Galeri. Pembuatan halaman baca berita publik. |
| **Fase 4: Modul PSB End-to-End** | Bulan 7 – 8 | Pembangunan form pendaftaran *multi-step*, fitur unggah berkas, generator Nomor Registrasi, halaman Cek Status, cetak bukti daftar (DomPDF), dan fitur Export Excel untuk panitia. |
| **Fase 5: Pengujian & Optimasi Hosting** | Bulan 9 | *User Acceptance Testing* (UAT) di berbagai ukuran layar HP, uji coba kompresi berkas, pembuatan *route helper* non-SSH, dan simulasi *build* produksi (`npm run build`). |
| **Fase 6: Deployment & Go-Live** | Bulan 10 (Agustus 2027) | Upload paket rilis ke cPanel Shared Hosting, konfigurasi `.env` produksi & database MySQL, serta pelatihan singkat penggunaan *dashboard* untuk admin/panitia pondok. |

---

## 10. Prosedur Standar Deployment (SOP Shared Hosting Non-SSH)
Ketika aplikasi siap diunggah ke hosting, ikuti langkah berikut:
1. Di komputer lokal (Laragon), jalankan perintah:
   ```bash
   npm run build
   composer install --optimize-autoloader --no-dev
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```
2. Kompres seluruh isi proyek Laravel (termasuk folder `vendor/` dan `public/build/`) menjadi `daareltazkiyah-release.zip`.
3. Buat database dan pengguna MySQL baru melalui **MySQL® Databases** di cPanel, lalu impor struktur dan data awal melalui **phpMyAdmin**.
4. Unggah `daareltazkiyah-release.zip` ke cPanel File Manager:
   * **Opsi A (Direkomendasikan):** Letakkan inti Laravel di luar `public_html` (misal: `/home/username/daareltazkiyah_core`), lalu pindahkan isi folder `public/` ke dalam `public_html/` dan sesuaikan path di `public_html/index.php`.
   * **Opsi B:** Ekstrak di `public_html/` dan tambahkan `.htaccess` di *root* untuk mengarahkan seluruh *request* ke folder `public/`.
5. Sesuaikan kredensial database dan `APP_URL` pada file `.env` melalui File Manager cPanel.
6. Akses URL *deployment helper* satu kali (contoh: `https://namadomainpondok.com/system-setup?key=SECRET_KEY`) untuk membuat *symlink* `storage` dan mengaktifkan *cache* produksi.