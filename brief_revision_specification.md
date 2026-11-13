# Spesifikasi Revisi Sistem PSB (/psb)

Dokumen ini berisi rincian teknis dan data lengkap untuk perombakan sistem PSB pada seluruh routing `/psb`.

## 1. Navigasi (Navbar)

* Tambahkan sub-menu **"Perlengkapan Santri"** di bawah dropdown menu **PSB** (routing `/psb/perlengkapan`).

## 2. Halaman Index (`/psb`)

Susun halaman menjadi 5 Section:

1. **Section 1 (Hero / CTA):** Tombol CTA "Daftar Sekarang" & "Rincian Biaya" (desain eksisting).

2. **Section 2 (Alur Pendaftaran):** Layout 2 Tab.

   * **Tab Online (Default Active):** Isi formulir online -> Simpan bukti pendaftaran -> Pembayaran -> Konfirmasi pembayaran.

   * **Tab Offline:** Datang langsung ke Sekretariat Pondok Pesantren.

3. **Section 3 (Ringkasan Biaya):** Layout 2 Card berdampingan.

   * **Card MTs (Mukim):** Putra (Rp 3.250.000) | Putri (Rp 3.350.000).

   * **Card MDTA (Non-Mukim):** Rp 52.000.

4. **Section 4 (Persyaratan):** Daftar sederhana tanpa keterangan kategori/status wajib.

   1. Fotocopy/salinan Akta Kelahiran

   2. Fotocopy/salinan Kartu Keluarga

   3. Fotocopy/salinan KTP Orang Tua/Wali

   4. Fotocopy/salinan Ijazah/SKL

   5. Pas Foto 3x4

5. **Section 5 (FAQ):** Accordion FAQ.

## 3. Halaman Biaya (`/psb/biaya`)

* **Hapus** section perlengkapan santri dari halaman ini.

* Tampilkan rincian dalam **2 Tab**:

### Tab MTs (Mukim)

| No | Rincian Biaya | Ketentuan | Biaya (Laki-laki) | Biaya (Perempuan) | 
| ----- | ----- | ----- | ----- | ----- | 
| 1 | Biaya Pendaftaran | Sekali | Rp 100.000 | Rp 100.000 | 
| 2 | Uang Ujian | Pertahun | Rp 200.000 | Rp 200.000 | 
| 3 | Seragam Olahraga | 1 Set | Rp 150.000 | Rp 150.000 | 
| 4 | Baju Muslim | 1 Set | Rp 150.000 | Rp 150.000 | 
| 5 | Sewa Lemari | Setahun | Rp 150.000 | Rp 150.000 | 
| 6 | Beli Kasur | 1 Kali | Rp 200.000 | Rp 200.000 | 
| 7 | Iuran Bulanan (Makan 3x/hari) | Perbulan | Rp 500.000 | Rp 500.000 | 
| 8 | Kitab dan Buku Pelajaran | Pertahun | Rp 1.000.000 | Rp 1.000.000 | 
| 9 | Organisasi | Pertahun | Rp 100.000 | Rp 100.000 | 
| 10 | Ekstrakurikuler | Pertahun | Rp 200.000 | Rp 200.000 | 
| 11 | Wakaf Pembangunan | 1 Kali | Rp 500.000 | Rp 500.000 | 
| 12 | Kerudung Hitam dan Putih | 1 Set | \- | Rp 100.000 | 
| **Total** |  |  | **Rp 3.250.000** | **Rp 3.350.000** | 

### Tab MDTA (Non-Mukim)

| No | Rincian Biaya | Keterangan | Biaya | 
| ----- | ----- | ----- | ----- | 
| 1 | Biaya Pendaftaran | Sekali | Rp 15.000 | 
| 2 | Infaq Shodaqoh | Perbulan | Rp 12.000 | 
| 3 | Biaya Rapor (4 Tahun) | Sekali | Rp 20.000 | 
| 4 | Kartu Santri Tahunan | Pertahun | Rp 5.000 | 
| **Total** |  |  | **Rp 52.000** | 

## 4. Halaman Baru: Perlengkapan Santri (`/psb/perlengkapan`)

Layout komparasi Putra & Putri untuk 4 kategori:

1. **Seragam Sekolah Formal:**

   * **Putra:** Celana Hitam & Baju Putih, Celana Biru & Baju Putih, Pramuka 1 Stel, Dasi Biru/Hitam & Kacu Pramuka, Gesper, Sepatu hitam (pantofel), Kaos kaki, Peci Hitam (Songkok), Buku & Alat tulis.

   * **Putri:** Rok Hitam & Baju Putih, Rok Biru & Baju Putih, Pramuka 1 Stel, Kacu Pramuka, Gesper, Sepatu hitam (pantofel), Kaos kaki, Kerudung Putih/Hitam/Coklat (segi empat tebal & besar), Buku & Alat tulis.

2. **Seragam Pondok Formal (Kegiatan Pondok):**

   * **Putra:** Celana Hitam & Baju Putih, Peci Hitam (Songkok).

   * **Putri:** Rok Hitam & Baju Putih, Kerudung Hitam/Putih (segi empat tebal & besar).

3. **Perlengkapan Sholat:**

   * **Putra:** Baju Muslim Bebas (Min. 4), Sarung (Min. 4), Sajadah (Min. 1), Koko/Gamis Putih (Min. 2), Kemeja Panjang bebas.

   * **Putri:** Mukena Warna bebas (Min. 2), Sajadah (Min. 1), Mukena Warna Putih (Min. 1).

4. **Perlengkapan Sehari-hari:**

   * **Pakaian Tidur/ Bebas Putra:** Kaos polos, Celana Training (Min. 2), Celana bahan/hitam, Gesper, Bantal/guling.

   * **Pakaian Tidur/ Bebas Putri:** Gamis menutup aurat, Kerudung hitam (bergo jumbo), Celana bahan/hitam, Gesper, Bantal/guling.

   * **Makan, Mencuci & Mandi (Putra & Putri):** Piring & sendok, Gelas/Botol, Gayung, Ember, Hanger, Alat Mandi (sabun cair), Alat mencuci pakaian & piring.

## 5. Form Pendaftaran (`/psb/form`)

Formulir multi-step (5 steps):

* **Step 1 (Santri):** Nama Lengkap, NIK (16 digit), NISN (10 digit, opsional), Tempat & Tgl Lahir, Jenis Kelamin, Anak Ke-, Dari... Bersaudara, Alamat (Provinsi, Kab/Kota, Kec, Desa/Kel, Detail Jalan/RT/RW).

* **Step 2 (Orang Tua / Wali):** Data Ayah Kandung, Data Ibu Kandung, Data Wali (Pilihan Radio: Ayah/Ibu/Lainnya. Jika Lainnya, munculkan input Wali). Field per orang tua: Nama, Status, NIK, Tempat/Tgl Lahir, Pendidikan, Checkbox Pesantren, Pekerjaan, Penghasilan, Checkbox Tanpa WA, No WA.

* **Step 3 (Sekolah & Pilihan):** Jenjang Sekolah Asal, Nama Sekolah Asal, Alamat Sekolah Asal, Opsi Jenjang Tujuan (**MTs** atau **MDTA**).

* **Step 4 (Dokumen):** Upload Dropzone (KK, Akta, KTP Ayah, KTP Ibu, Ijazah/SKL, Print NISN, Pas Foto). Max 5MB (JPG/PNG/PDF).

* **Step 5 (Review):** Ringkasan data & persetujuan submit.

## 6. Cek Status (`/psb/status`)

* **Form Cek Status:** Membutuhkan **2 Input** (`Nomor Pendaftaran` AND `NIK`).
 
* **Format Nomor Pendaftarn:** `YYNNNN` (`Tahun` + `Nomor Urut`).

* **Backend:** Query pencarian database harus mencocokkan `WHERE registration_number = ? AND nik = ?`.
