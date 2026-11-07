# Prosedur Standar Deployment (SOP Shared Hosting Non-SSH)

**Proyek:** Portal Web, CMS Berita & Sistem PSB — PPMTQ Daar El Tazkiyah Sumardi  
**Terakhir Diperbarui:** 7 November 2026  
**Referensi:** [PRD.md](./PRD.md) Section 5.2

---

## Daftar Isi

1. [Prasyarat Hosting](#1-prasyarat-hosting)
2. [Persiapan Build Lokal](#2-persiapan-build-lokal-laragon)
3. [Upload ke cPanel](#3-upload-ke-cpanel)
4. [Konfigurasi Database](#4-konfigurasi-database)
5. [Konfigurasi Environment](#5-konfigurasi-environment-env)
6. [Deployment Helper Route](#6-deployment-helper-route)
7. [Setup Cron Job](#7-setup-cron-job-cpanel)
8. [Post-Deployment Checklist](#8-post-deployment-checklist)
9. [Prosedur Update / Re-deploy](#9-prosedur-update--re-deploy)
10. [Prosedur Backup Berkala](#10-prosedur-backup-berkala)
11. [Troubleshooting](#11-troubleshooting)

---

## 1. Prasyarat Hosting

Pastikan shared hosting yang dipilih memenuhi spesifikasi berikut **sebelum membeli**:

| Komponen | Minimum | Direkomendasikan |
| :--- | :--- | :--- |
| **PHP** | 8.3 | 8.4+ |
| **MySQL / MariaDB** | MySQL 8.0 / MariaDB 10.6 | MySQL 8.4 / MariaDB 11+ |
| **Disk Space** | 1 GB | 2 GB+ |
| **Memory Limit** | 256 MB | 512 MB |
| **Max Execution Time** | 60 detik | 120 detik |
| **Max Upload Size** | 8 MB | 16 MB+ |
| **Cron Jobs** | ✅ Tersedia di cPanel | — |
| **SSL/HTTPS** | ✅ (Let's Encrypt / AutoSSL) | — |

### Ekstensi PHP Wajib

Pastikan ekstensi berikut aktif di **Select PHP Version** cPanel:

```
bcmath, ctype, curl, dom, fileinfo, gd (atau imagick), json,
mbstring, openssl, pdo, pdo_mysql, tokenizer, xml, zip
```

---

## 2. Persiapan Build Lokal (Laragon)

Jalankan perintah berikut di terminal Laragon (Cmder / PowerShell) dari root proyek:

```bash
# 1. Build frontend assets (Tailwind CSS + Vite)
pnpm run build

# 2. Install PHP dependencies (production only)
composer install --optimize-autoloader --no-dev

# 3. Clear semua cache lokal
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

# 4. Generate one-time deployment token
php artisan tinker --execute "echo 'DEPLOY_TOKEN=' . Str::random(40);"
```

> **Catat** output `DEPLOY_TOKEN=...` — ini akan digunakan di langkah 6.

### Buat Archive Release

```bash
# 5. Kompres seluruh proyek menjadi zip
#    WAJIB termasuk: vendor/, public/build/, public/fonts/
#    JANGAN termasuk: node_modules/, .git/, tests/, .env
```

**Struktur zip `daareltazkiyah-release.zip`:**

```
daareltazkiyah-release/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
│   ├── build/          ← WAJIB (hasil npm run build)
│   ├── fonts/          ← WAJIB (self-hosted Google Fonts)
│   ├── index.php
│   ├── .htaccess
│   └── ...
├── resources/
├── routes/
├── storage/
├── vendor/             ← WAJIB (hasil composer install)
├── .env.example
├── artisan
├── composer.json
└── composer.lock
```

> ⚠️ **Jangan sertakan** file `.env` lokal. File `.env` produksi akan dibuat manual di hosting.

---

## 3. Upload ke cPanel

### Opsi A — Direkomendasikan (Core di Luar `public_html`)

Struktur ini lebih aman karena source code Laravel tidak bisa diakses langsung via browser.

```
/home/username/
├── daareltazkiyah_core/     ← Inti Laravel (semua kecuali isi public/)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   ├── .env                 ← File environment produksi
│   ├── artisan
│   └── ...
│
└── public_html/             ← Document root (isi folder public/)
    ├── build/
    ├── fonts/
    ├── index.php            ← EDIT path (lihat di bawah)
    ├── .htaccess
    └── ...
```

**Langkah-langkah:**

1. Upload `daareltazkiyah-release.zip` ke `/home/username/` via **File Manager** cPanel.
2. **Extract** zip tersebut → muncul folder `daareltazkiyah-release/`.
3. **Rename** folder menjadi `daareltazkiyah_core`.
4. **Pindahkan** seluruh isi `daareltazkiyah_core/public/*` ke `public_html/`.
5. **Edit** `public_html/index.php` — ubah path bootstrap:

```php
// SEBELUM (default Laravel):
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// SESUDAH (sesuaikan path ke core):
require __DIR__.'/../daareltazkiyah_core/vendor/autoload.php';
$app = require_once __DIR__.'/../daareltazkiyah_core/bootstrap/app.php';
```

6. **Edit** `daareltazkiyah_core/bootstrap/app.php` — tambahkan public path override:

```php
// Tambahkan setelah Application instance dibuat:
$app->usePublicPath(base_path('../public_html'));
```

### Opsi B — Alternatif (Semua di `public_html`)

Jika hosting tidak memperbolehkan folder di luar `public_html`:

1. Extract seluruh proyek ke `public_html/`.
2. Tambahkan `.htaccess` di root `public_html/` untuk redirect ke `public/`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

3. Tambahkan `.htaccess` tambahan untuk **memblokir akses** ke folder sensitif:

```apache
# public_html/.htaccess (tambahan keamanan)
<IfModule mod_rewrite.c>
    RewriteEngine On

    # Block direct access to sensitive directories
    RewriteRule ^(app|bootstrap|config|database|resources|routes|storage|vendor|\.env)(/|$) - [F,L]
</IfModule>
```

> ⚠️ **Opsi A jauh lebih aman.** Gunakan Opsi B hanya jika terpaksa.

---

## 4. Konfigurasi Database

1. Buka **MySQL® Databases** di cPanel.
2. **Create Database:** `username_daareltazkiyah` (atau nama sesuai kebijakan hosting).
3. **Create User:** `username_dtapp` dengan password yang kuat (min 16 karakter, campuran huruf/angka/simbol).
4. **Add User to Database** dengan privilege **ALL PRIVILEGES**.
5. Buka **phpMyAdmin** → pilih database yang baru dibuat.
6. **Import** file SQL jika ada data awal, atau biarkan kosong (migration akan membuat tabel via deployment helper).

---

## 5. Konfigurasi Environment (`.env`)

Buat file `.env` di root proyek (`daareltazkiyah_core/.env` untuk Opsi A, atau `public_html/.env` untuk Opsi B) via **File Manager** cPanel:

```env
# ============================================================
# APPLICATION
# ============================================================
APP_NAME="PPMTQ Daar El Tazkiyah Sumardi"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_TIMEZONE=Asia/Jakarta
APP_URL=https://www.namadomain.com

# ============================================================
# DATABASE
# ============================================================
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=username_daareltazkiyah
DB_USERNAME=username_dtapp
DB_PASSWORD=password_kuat_disini

# ============================================================
# SESSION & CACHE
# ============================================================
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync

# ============================================================
# MAIL (opsional — untuk notifikasi error)
# ============================================================
MAIL_MAILER=smtp
MAIL_HOST=mail.namadomain.com
MAIL_PORT=465
MAIL_USERNAME=admin@namadomain.com
MAIL_PASSWORD=password_email
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=admin@namadomain.com
MAIL_FROM_NAME="${APP_NAME}"

# ============================================================
# DEPLOYMENT (one-time, hapus setelah digunakan)
# ============================================================
DEPLOY_TOKEN=paste_token_dari_langkah_2_disini
DEPLOY_ALLOWED_IPS=

# ============================================================
# LOGGING
# ============================================================
LOG_CHANNEL=single
LOG_LEVEL=error
```

> ⚠️ **KRITIS:**
> - `APP_DEBUG` **HARUS** `false` di production. Jika `true`, error akan menampilkan database credentials, file paths, dan informasi sensitif lainnya.
> - `APP_KEY` akan di-generate otomatis oleh deployment helper route, atau bisa di-generate lokal lalu copy paste: `php artisan key:generate --show`

---

## 6. Deployment Helper Route

Setelah file `.env` dikonfigurasi, akses deployment helper **satu kali** via browser:

### Request

```
POST https://www.namadomain.com/system-setup
Content-Type: application/x-www-form-urlencoded

token=PASTE_DEPLOY_TOKEN_DISINI
```

> 💡 **Cara paling mudah:** Gunakan form HTML sederhana. Buka browser, ketik di address bar:
> ```
> javascript:void(document.write('<form method="POST" action="https://www.namadomain.com/system-setup"><input name="token" value="PASTE_TOKEN"><button>Deploy</button></form>'))
> ```
> Atau gunakan tool seperti [Hoppscotch](https://hoppscotch.io/) / Postman.

### Apa yang Dieksekusi

Route ini akan menjalankan secara berurutan:

1. `php artisan key:generate` (jika `APP_KEY` kosong)
2. `php artisan storage:link` (atau copy files jika symlink gagal)
3. `php artisan migrate --force` (membuat semua tabel)
4. `php artisan db:seed --force` (seed data awal)
5. `php artisan optimize` (cache config, routes, views)
6. **Auto-disable:** Menghapus `DEPLOY_TOKEN` dari `.env` agar route tidak bisa diakses lagi.

### Response

```json
{
  "status": "success",
  "message": "Deployment completed. Token has been invalidated.",
  "steps": [
    "✅ APP_KEY generated",
    "✅ Storage linked",
    "✅ Migrations executed (12 tables created)",
    "✅ Seeders executed",
    "✅ Optimized cache created",
    "✅ Deploy token invalidated"
  ]
}
```

> ⚠️ Jika muncul error, catat pesan errornya dan periksa Section 11 (Troubleshooting).

---

## 7. Setup Cron Job (cPanel)

Laravel Scheduler diperlukan untuk:
- Auto-publish artikel dengan status `scheduled`.
- File cleanup (hapus file orphan harian).

### Langkah-langkah

1. Buka **Cron Jobs** di cPanel.
2. Set frequency: **Once Per Minute** (`* * * * *`).
3. Masukkan command:

**Opsi A (core di luar public_html):**
```
/usr/local/bin/php /home/username/daareltazkiyah_core/artisan schedule:run >> /dev/null 2>&1
```

**Opsi B (semua di public_html):**
```
/usr/local/bin/php /home/username/public_html/artisan schedule:run >> /dev/null 2>&1
```

> 💡 Jika tidak yakin path PHP, coba `/usr/bin/php` atau tanyakan ke support hosting.

4. Klik **Add New Cron Job**.

### Verifikasi

Setelah menunggu 1-2 menit, periksa apakah cron berjalan:
- Buat artikel berita dengan status `scheduled` dan `published_at` = 1 menit yang lalu.
- Refresh halaman berita publik — artikel seharusnya muncul.

---

## 8. Post-Deployment Checklist

Setelah deployment selesai, **wajib verifikasi** setiap item berikut:

### Halaman Publik

- [ ] Landing page ter-load sempurna (gambar, font, styling).
- [ ] Font Arab (Amiri/Scheherazade) ter-render dengan benar.
- [ ] Navigasi dan semua link berfungsi.
- [ ] Halaman berita ter-load (meskipun masih kosong).
- [ ] Halaman galeri ter-load.
- [ ] Halaman kontak menampilkan data dari `site_settings`.
- [ ] Tombol floating WhatsApp berfungsi (buka WhatsApp).
- [ ] Meta OG tags muncul saat share link di WhatsApp (test dengan [metatags.io](https://metatags.io/)).
- [ ] Responsif di mobile (test di HP langsung + Chrome DevTools).
- [ ] Favicon muncul di tab browser.
- [ ] HTTPS aktif dan redirect dari HTTP berfungsi.

### Modul PSB

- [ ] Form pendaftaran terbuka (jika gelombang aktif) atau tertutup (jika di luar gelombang).
- [ ] Multi-step form bisa dilalui dari Step 1 sampai Step 4.
- [ ] Upload file (foto, KK, akta, bukti transfer) berhasil — maks 2MB.
- [ ] Nomor registrasi ter-generate dengan format benar (`PSB-2027-MTS-0001`).
- [ ] Halaman sukses + download PDF bukti pendaftaran berfungsi.
- [ ] Tombol konfirmasi WhatsApp berfungsi.
- [ ] Cek status pendaftaran berfungsi (Nomor Registrasi + Access Token).

### Admin Panel

- [ ] Login admin berhasil (email + password).
- [ ] Dashboard admin menampilkan metrik statistik.
- [ ] CRUD berita berfungsi (buat, edit, hapus, publish).
- [ ] CRUD galeri berfungsi.
- [ ] CRUD pengajar berfungsi.
- [ ] Manajemen pendaftar: search, filter, sort, pagination.
- [ ] Pratinjau berkas pendaftar berfungsi (signed URL).
- [ ] Ubah status pendaftar berfungsi + audit log tercatat.
- [ ] Export Excel berfungsi.
- [ ] Manajemen site settings berfungsi.

### Keamanan

- [ ] `APP_DEBUG=false` — buka URL yang tidak ada, harus tampil halaman error umum (bukan stack trace).
- [ ] `DEPLOY_TOKEN` sudah terhapus dari `.env`.
- [ ] File `.env` tidak bisa diakses via browser (`https://domain.com/.env` → 403/404).
- [ ] Folder `storage/`, `vendor/`, `app/` tidak bisa diakses via browser (khusus Opsi B).
- [ ] Rate limiting berfungsi (submit form PSB >5x → blocked).
- [ ] Signed URL untuk dokumen santri: buka URL langsung tanpa signature → 403.

---

## 9. Prosedur Update / Re-deploy

Untuk mengunggah versi baru aplikasi:

### 9.1. Persiapan Lokal

```bash
# 1. Build ulang assets
pnpm run build

# 2. Install dependencies production
composer install --optimize-autoloader --no-dev

# 3. Clear cache
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 4. Generate deploy token baru (jika ada migration baru)
php artisan tinker --execute "echo 'DEPLOY_TOKEN=' . Str::random(40);"
```

### 9.2. Upload Perubahan

**Jika perubahan kecil (beberapa file):**
- Upload file yang berubah satu per satu via File Manager cPanel.
- Jika ada file di `public/build/`, upload ulang seluruh folder `build/`.

**Jika perubahan besar:**
- Buat zip baru, upload, dan extract (overwrite).
- Pastikan `.env` produksi **tidak tertimpa**.

### 9.3. Post-Update

Jika ada **migration baru**:
1. Tambahkan `DEPLOY_TOKEN=token_baru` ke `.env` via File Manager.
2. Akses deployment helper route (POST `/system-setup` dengan token).
3. Token otomatis terhapus setelah digunakan.

Jika **tidak ada migration baru**:
- Cukup hapus cache via browser bookmark: `POST /system-setup` dengan action `optimize-only` (jika diimplementasikan), atau biarkan cache expire secara natural.

---

## 10. Prosedur Backup Berkala

### 10.1. Backup Database (Mingguan)

1. Buka **phpMyAdmin** di cPanel.
2. Pilih database `username_daareltazkiyah`.
3. Klik tab **Export** → Method: **Quick** → Format: **SQL**.
4. Klik **Go** → simpan file `.sql` ke komputer lokal.
5. Beri nama file: `backup_db_YYYY-MM-DD.sql`.

### 10.2. Backup File Upload (Bulanan)

1. Buka **File Manager** cPanel.
2. Navigasi ke `daareltazkiyah_core/storage/app/private/documents/`.
3. **Compress** folder `documents/` → download zip ke komputer lokal.
4. Beri nama file: `backup_documents_YYYY-MM-DD.zip`.

### 10.3. Full Backup (Sebelum Update Major)

1. Buka **Backup** atau **Backup Wizard** di cPanel.
2. Buat **Full Backup** → download ke komputer lokal.

> 💡 **Tips:** Simpan backup di Google Drive / Dropbox dengan struktur folder per tanggal.

---

## 11. Troubleshooting

### Error: "500 Internal Server Error"

1. Periksa `APP_DEBUG` → set `true` **sementara** untuk melihat pesan error detail.
2. Periksa `storage/logs/laravel.log` via File Manager.
3. Penyebab umum:
   - `APP_KEY` kosong → generate via deployment helper.
   - Permission folder `storage/` salah → set `755` untuk folder, `644` untuk file.
   - PHP version salah → cek **Select PHP Version** di cPanel.
4. **Setelah selesai debug, kembalikan `APP_DEBUG=false`.**

### Error: "Unable to locate file in Vite manifest"

- Folder `public/build/` belum ter-upload atau path-nya salah.
- Pastikan `public/build/manifest.json` ada dan bisa diakses.

### Error: Upload File Gagal / Timeout

- Periksa `upload_max_filesize` dan `post_max_size` di PHP Settings cPanel.
- Set minimum: `upload_max_filesize = 8M`, `post_max_size = 16M`.
- Periksa `max_execution_time` — set minimum `120`.

### Error: "SQLSTATE[HY000] [2002] Connection refused"

- Periksa kredensial database di `.env` (`DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
- Pastikan user database sudah di-assign ke database dengan ALL PRIVILEGES.

### Error: Symlink Gagal (storage:link)

- Beberapa shared hosting tidak support `symlink()`.
- Deployment helper route secara otomatis akan **menyalin file** dari `storage/app/public` ke `public/storage` sebagai fallback.
- Jika fallback juga gagal, salin manual via File Manager.

### Cron Job Tidak Berjalan

- Periksa path PHP: coba `/usr/bin/php` atau `/usr/local/bin/php`.
- Periksa path artisan: harus absolute path lengkap.
- Test manual di cPanel terminal (jika ada): `php /path/to/artisan schedule:run`.
- Periksa cPanel error log untuk output cron.

### Font Arab Tidak Muncul

- Pastikan folder `public/fonts/` ter-upload dengan benar.
- Periksa path `@font-face` di CSS sesuai dengan struktur folder di hosting.
- Clear browser cache.

