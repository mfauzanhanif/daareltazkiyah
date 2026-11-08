@extends('layouts.public', ['title' => 'Sarana & Fasilitas - PPMTQ Daar El Tazkiyah Sumardi'])

@section('content')
    <!-- Page Header (Editorial Academic Banner) -->
    <section class="bg-white border-b border-[#E5E0D8] pt-12 pb-14 md:pt-16 md:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <div class="flex items-center gap-3">
                    <span class="editorial-label">01 — PROFIL INSTITUSI</span>
                    <span class="w-8 h-px bg-[#B89758]"></span>
                    <span class="text-xs font-mono text-[#4B6358] uppercase tracking-wider">Lingkungan & Prasarana</span>
                </div>
                <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-[#0D3B2E] tracking-tight leading-[1.15]">
                    Sarana & Lingkungan Kampus Tahfidz
                </h1>
                <p class="text-base sm:text-lg text-[#4B6358] leading-relaxed">
                    Menyediakan sarana ibadah, asrama, dan fasilitas belajar yang bersih, asri, hening, dan kondusif untuk menunjang kelancaran mutqin 30 juz Al-Qur'an dan pendidikan formal santri.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <section class="py-16 md:py-24 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <!-- Facilities Grid (6 Key Infrastructure Points) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Facility 1: Masjid -->
                <div class="bg-white border border-[#E5E0D8] p-8 space-y-4 hover:border-[#0D3B2E] transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="editorial-label text-[#059669]">SARANA 01</span>
                        <span class="text-xs font-mono text-[#4B6358]">Pusat Ibadah</span>
                    </div>
                    <h2 class="font-serif font-bold text-xl text-[#0D3B2E]">
                        Masjid Jami' Pesantren
                    </h2>
                    <p class="text-sm text-[#4B6358] leading-relaxed">
                        Jantung peribadatan dan pusat halaqah tahfidz 24 jam. Dilengkapi karpet tebal, sirkulasi udara alami khas kaki Gunung Salak Ciampea, dan sistem tata suara berkualitas untuk kelancaran talaqqi dan qiyamullail.
                    </p>
                    <ul class="text-xs text-[#18181B] space-y-1.5 pt-2 border-t border-[#E5E0D8]">
                        <li>&bull; Daya tampung seluruh santri & jamaah</li>
                        <li>&bull; Ruang halaqah qira'at & kajian kitab kuning</li>
                        <li>&bull; Tempat sholat fardhu 5 waktu berjamaah</li>
                    </ul>
                </div>

                <!-- Facility 2: Asrama Mukim -->
                <div class="bg-white border border-[#E5E0D8] p-8 space-y-4 hover:border-[#0D3B2E] transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="editorial-label text-[#059669]">SARANA 02</span>
                        <span class="text-xs font-mono text-[#4B6358]">Hunian Santri</span>
                    </div>
                    <h2 class="font-serif font-bold text-xl text-[#0D3B2E]">
                        Gedung Asrama Mukim 24 Jam
                    </h2>
                    <p class="text-sm text-[#4B6358] leading-relaxed">
                        Kamar asrama yang tertata rapi, bersih, dan higienis. Setiap kamar dilengkapi lemari pribadi, ranjang kokoh, ventilasi luas, dan diawasi langsung oleh musyrif asrama yang mendampingi santri.
                    </p>
                    <ul class="text-xs text-[#18181B] space-y-1.5 pt-2 border-t border-[#E5E0D8]">
                        <li>&bull; Pembinaan disiplin & kebersihan harian</li>
                        <li>&bull; Kamar mandi bersih dengan pasokan air melimpah</li>
                        <li>&bull; Area mencuci & layanan laundry terpadu</li>
                    </ul>
                </div>

                <!-- Facility 3: Ruang Kelas Formal -->
                <div class="bg-white border border-[#E5E0D8] p-8 space-y-4 hover:border-[#0D3B2E] transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="editorial-label text-[#059669]">SARANA 03</span>
                        <span class="text-xs font-mono text-[#4B6358]">Ruang Akademik</span>
                    </div>
                    <h2 class="font-serif font-bold text-xl text-[#0D3B2E]">
                        Ruang Kelas & Belajar Terpadu
                    </h2>
                    <p class="text-sm text-[#4B6358] leading-relaxed">
                        Ruang kelas berstandar madrasah formal Kemenag RI dengan pencahayaan optimal, meja kursi ergonomis, papan tulis ganda, serta proyektor multimedia untuk pembelajaran sains dan bahasa asing.
                    </p>
                    <ul class="text-xs text-[#18181B] space-y-1.5 pt-2 border-t border-[#E5E0D8]">
                        <li>&bull; Rasio santri ideal per kelas (maksimal 25 santri)</li>
                        <li>&bull; Sarana presentasi digital & audio visual</li>
                        <li>&bull; Suasana hening bebas polusi bising</li>
                    </ul>
                </div>

                <!-- Facility 4: Dapur & Ruang Makan -->
                <div class="bg-white border border-[#E5E0D8] p-8 space-y-4 hover:border-[#0D3B2E] transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="editorial-label text-[#059669]">SARANA 04</span>
                        <span class="text-xs font-mono text-[#4B6358]">Konsumsi & Nutrisi</span>
                    </div>
                    <h2 class="font-serif font-bold text-xl text-[#0D3B2E]">
                        Dapur Pesantren & Ruang Makan
                    </h2>
                    <p class="text-sm text-[#4B6358] leading-relaxed">
                        Penyediaan makanan santri 3 kali sehari (pagi, siang, malam) dengan menu gizi seimbang yang dimasak higienis oleh juru masak pesantren, menjaga stamina santri dalam beribadah dan menghafal Al-Qur'an.
                    </p>
                    <ul class="text-xs text-[#18181B] space-y-1.5 pt-2 border-t border-[#E5E0D8]">
                        <li>&bull; Menu variatif 4 sehat terjadwal</li>
                        <li>&bull; Air minum steril higienis tanpa batas</li>
                        <li>&bull; Ruang makan bersama melatih adab makan Islami</li>
                    </ul>
                </div>

                <!-- Facility 5: Perpustakaan Kitab -->
                <div class="bg-white border border-[#E5E0D8] p-8 space-y-4 hover:border-[#0D3B2E] transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="editorial-label text-[#059669]">SARANA 05</span>
                        <span class="text-xs font-mono text-[#4B6358]">Khazanah Pustaka</span>
                    </div>
                    <h2 class="font-serif font-bold text-xl text-[#0D3B2E]">
                        Perpustakaan Kitab Kuning & Sains
                    </h2>
                    <p class="text-sm text-[#4B6358] leading-relaxed">
                        Koleksi literatur kitab klasik salafiyah (tafsir, fiqih, hadits, tarikh, lughah) bersanding dengan buku referensi sains, teknologi, ensiklopedia umum, dan majalah edukasi anak.
                    </p>
                    <ul class="text-xs text-[#18181B] space-y-1.5 pt-2 border-t border-[#E5E0D8]">
                        <li>&bull; Kitab mu'tabar cetakan Timur Tengah & lokal</li>
                        <li>&bull; Area baca hening santri</li>
                        <li>&bull; Bimbingan bahtsul masail & kajian literasi</li>
                    </ul>
                </div>

                <!-- Facility 6: Area Olahraga & Panahan -->
                <div class="bg-white border border-[#E5E0D8] p-8 space-y-4 hover:border-[#0D3B2E] transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="editorial-label text-[#059669]">SARANA 06</span>
                        <span class="text-xs font-mono text-[#4B6358]">Kebugaran Santri</span>
                    </div>
                    <h2 class="font-serif font-bold text-xl text-[#0D3B2E]">
                        Area Olahraga Sunnah & Ekstrakurikuler
                    </h2>
                    <p class="text-sm text-[#4B6358] leading-relaxed">
                        Lapangan terbuka serbaguna untuk futsal, bulu tangkis, tenis meja, bela diri silat, dan arena memanah (archery) sebagai latihan ketangkasan fisik sunnah Nabi Muhammad ﷺ.
                    </p>
                    <ul class="text-xs text-[#18181B] space-y-1.5 pt-2 border-t border-[#E5E0D8]">
                        <li>&bull; Target bantalan panah standar jarak 10-30 meter</li>
                        <li>&bull; Lapangan olahraga serbaguna outdoor</li>
                        <li>&bull; Udara pegunungan segar bebas polusi</li>
                    </ul>
                </div>

            </div>

            <!-- Campus Environment & Cleanliness Note -->
            <div class="bg-white border border-[#E5E0D8] p-8 sm:p-12 space-y-4">
                <span class="editorial-label">STANDAR KESEHATAN & KEAMANAN</span>
                <h3 class="font-serif text-2xl font-bold text-[#0D3B2E]">
                    Komitmen Lingkungan Asri, Aman, dan Nyaman
                </h3>
                <p class="text-sm text-[#4B6358] leading-relaxed">
                    Kampus PPMTQ Daar El Tazkiyah menerapkan pengawasan keamanan 24 jam dengan sistem portal satu pintu (one gate system), tenaga medis siaga untuk pertolongan pertama kesehatan santri, serta larangan ketat penggunaan gawai elektronik pribadi (bebas distraksi digital) agar konsentrasi hafalan Al-Qur'an tetap murni dan terjaga.
                </p>
            </div>

        </div>
    </section>
@endsection
