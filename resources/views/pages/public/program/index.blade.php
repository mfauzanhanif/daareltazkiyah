@extends('layouts.public', ['title' => 'Program Pendidikan & Kurikulum MDTA - DAAR EL TAZKIYAH SUMARDI'])

@section('content')
<div x-data="{
    showModal: false,
    modalImage: '',
    modalTitle: '',
    openModal(src, title) {
        this.modalImage = src;
        this.modalTitle = title;
        this.showModal = true;
        document.body.classList.add('overflow-hidden');
    },
    closeModal() {
        this.showModal = false;
        document.body.classList.remove('overflow-hidden');
    }
}" @keydown.escape.window="closeModal()">

    <!-- Page Header (Editorial Academic Banner with Real Santri Photo Backdrop) -->
    <section class="bg-white border-b border-[#E5E0D8] pt-12 pb-14 md:pt-16 md:pb-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">

                <div class="lg:col-span-7 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-mono font-bold text-[#059669] uppercase tracking-wider">Kurikulum Terpadu & Kegiatan Santri T.A 2026/2027</span>
                    </div>
                    <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#0D3B2E] tracking-tight leading-[1.15]">
                        Program Pendidikan & Kurikulum MDTA
                    </h1>
                    <p class="text-base sm:text-lg text-[#4B6358] leading-relaxed">
                        Memadukan tahfidzul Qur'an mutqin, pembelajaran diniyah kitab salaf, praktik ibadah harian, serta pembinaan minat bakat dan seni santri di bawah naungan Yayasan DAAR EL TAZKIYAH SUMARDI.
                    </p>
                    <div class="flex flex-wrap items-center gap-2.5 pt-2 text-xs font-bold uppercase tracking-wider">
                        <a href="#program-unggulan" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                            &darr; Program Unggulan
                        </a>
                        <a href="#program-pendidikan" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                            &darr; Jenjang MTs & MDTA
                        </a>
                        <a href="#target-hafalan" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                            &darr; Target Hafalan MDTA
                        </a>
                        <a href="#jadwal-harian" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                            &darr; Jadwal Santri MDTA
                        </a>
                        <a href="#kegiatan-seni" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                            &darr; Kegiatan Seni (Kamis)
                        </a>
                    </div>
                </div>

                <!-- Right Visual: Santri Header Image Frame -->
                <div class="lg:col-span-5">
                    <div class="border border-[#E5E0D8] rounded-xl overflow-hidden shadow-md bg-white p-2">
                        <div class="aspect-16/10 relative overflow-hidden rounded-lg bg-gray-100 cursor-pointer group"
                             @click="openModal('{{ asset('images/foto-santri-1.webp') }}', 'Potret Santri Daar El Tazkiyah Sumardi')">
                            <img src="{{ asset('images/foto-santri-1.webp') }}"
                                alt="Santri Daar El Tazkiyah Sumardi"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex items-end p-4">
                                <span class="text-white text-xs font-semibold">Generasi Berilmu, Berakhlak, Berprestasi</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION 1: 6 PROGRAM UNGGULAN -->
    <section id="program-unggulan" class="py-16 md:py-24 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-3xl">
                    <span class="editorial-label text-[#059669]">PILAR UTAMA KEUNGGULAN</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        6 Program Unggulan Pesantren
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Dirancang secara komprehensif untuk mencetak santri yang mutqin dalam hafalan Al-Qur'an, berpengetahuan luas, mandiri, dan berakhlak karimah.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Tahfidzul Qur'an -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">01</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Hafalan Mutqin</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">{{ "Tahfidz Al-Qur'an" }}</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Program menghafal Al-Qur'an secara terarah, bertahap, dan mutqin. Menerapkan bimbingan harian bersama para asatidz huffadz.
                    </p>
                </div>

                <!-- 2. Tahfidz Hadits -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">02</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Sunnah Pilihan</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">Tahfidz Hadits</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Menghafal dan memahami hadits-hadits pokok dari kitab Arbain Nawawiyah dan matan hadits pilihan sebagai pedoman pengamalan sunnah sehari-hari.
                    </p>
                </div>

                <!-- 3. Kajian Kitab Kuning -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">03</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-amber-100 text-amber-900 font-semibold">Turats Salaf</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">Kajian Kitab Kuning</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pendalaman khazanah keilmuan Islam klasik meliputi tata bahasa Arab (nahwu, sharaf), fiqih ibadah (Safinatun Najah), tauhid/aqidah, dan adab santri.
                    </p>
                </div>

                <!-- 4. Bahasa Arab & Inggris -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">04</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-blue-100 text-blue-900 font-semibold">Bilingual Daily</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">Bahasa Arab & Inggris</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pembiasaan komunikasi dwibahasa aktif sehari-hari di asrama dan madrasah melalui pengayaan kosa kata harian (mufradat) dan percakapan rutin (muhadatsah).
                    </p>
                </div>

                <!-- 5. Public Speaking -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">05</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-purple-100 text-purple-900 font-semibold">Muhadharah</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">Public Speaking & Da'wah</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pelatihan dakwah, pidato tiga bahasa (Arab, Inggris, Indonesia), kepemimpinan santri, dan retorika berwibawa di depan khalayak ramai.
                    </p>
                </div>

                <!-- 6. Pembinaan Akhlak & Kedisiplinan -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">06</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Adab 24 Jam</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">Pembinaan Akhlak &amp; Kedisiplinan</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pembentukan karakter santri melalui pembiasaan adab Islami 24 jam, ketertiban shalat fardhu berjamaah di masjid, dan kemandirian asrama.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: JENJANG PENDIDIKAN (MTS & MDTA) -->
    <section id="program-pendidikan" class="py-16 md:py-24 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label text-[#059669]">JENJANG FORMAL & DINIYAH RESMI</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Dua Jalur Pendidikan Pesantren
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Pilihan tepat sesuai kebutuhan belajar santri: jenjang MTs berasrama penuh (24 jam) atau jenjang MDTA madrasah diniyah takmiliyah sore hari.
                    </p>
                </div>
            </div>

            <!-- Program Comparison 2-Columns -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">

                <!-- 1. MTs Mukim 24 Jam -->
                <div class="bg-[#FAF8F5] border-2 border-[#0D3B2E]/20 rounded-md p-8 relative flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] hover:shadow-md transition">
                    <div class="space-y-6">
                        <div class="border-b border-[#E5E0D8] pb-4">
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <span class="editorial-label text-[#059669]">PENDIDIKAN ASRAMA 24 JAM</span>
                                <span class="text-xs font-mono bg-[#0D3B2E] text-white px-2.5 py-0.5 rounded font-bold">Mukim</span>
                            </div>
                            <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">
                                MTs (Madrasah Tsanawiyah)
                            </h3>
                            <p class="text-xs sm:text-sm text-[#4B6358] mt-2 leading-relaxed">
                                Pendidikan formal setingkat SMP terpadu asrama mukim 24 jam dengan bimbingan asatidz intensif, target hafalan Al-Qur'an mutqin, dan kurikulum resmi Kementerian Agama RI.
                            </p>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="bg-white p-5 border border-[#E5E0D8] rounded-md space-y-3">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs font-semibold text-[#4B6358]">Iuran Bulanan (Syahriyah):</span>
                                <span class="text-2xl font-extrabold text-[#0D3B2E] font-sans">
                                    Rp 500.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                                </span>
                            </div>
                            <p class="text-xs text-[#059669] font-medium leading-relaxed">
                                *Sudah termasuk biaya pendidikan asrama & makan 3x sehari. Santri membawa perlengkapan mencuci pakaian mandiri.
                            </p>
                            <div class="flex items-baseline justify-between pt-2 border-t border-[#E5E0D8] text-xs">
                                <span class="text-[#4B6358]">Biaya Pendaftaran PSB:</span>
                                <strong class="text-sm font-bold text-[#B89758] font-sans">Rp {{ $feeMts }}</strong>
                            </div>
                        </div>

                        <!-- Highlights -->
                        <div class="space-y-2 text-xs">
                            <span class="font-bold text-[#0D3B2E] uppercase tracking-wider block">Fasilitas & Keunggulan MTs:</span>
                            <ul class="space-y-2 text-[#18181B]">
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Asrama mukim 24 jam di bawah bimbingan musyrif & asatidz huffadz.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Target hafalan Al-Qur'an terarah.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Ijazah formal Kementerian Agama RI (diakui untuk lanjut ke SMA/MA/Pesantren Tinggi).</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Kajian kitab kuning (fiqih, tajwid, hadits, tauhid) & pembiasaan bahasa Arab-Inggris.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#E5E0D8]">
                        <a href="{{ route('psb.index') }}?program=MTS" class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                            <span>Daftar MTs Mukim Sekarang &rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- 2. MDTA Non-Mukim -->
                <div id="mdta-kurikulum" class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-8 relative flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] hover:shadow-md transition">
                    <div class="space-y-6">
                        <div class="border-b border-[#E5E0D8] pb-4">
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <span class="editorial-label text-[#B89758]">PENDIDIKAN DINIYAH SORE</span>
                                <span class="text-xs font-mono bg-[#B89758] text-white px-2.5 py-0.5 rounded font-bold">Tingkat Ula</span>
                            </div>
                            <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">
                                MDTA (Madrasah Diniyah Takmiliyah Awaliyah)
                            </h3>
                            <div class="text-xs font-mono font-bold text-[#059669] mt-1">
                                Unit Resmi: MDT Ula DAAR EL TAZKIYAH SUMARDI
                            </div>
                            <p class="text-xs sm:text-sm text-[#4B6358] mt-2 leading-relaxed">
                                Madrasah Diniyah Takmiliyah Ula resmi terdaftar di Kemenag Serang (No. Ijop: 0355, NSMDT: 311236041251) untuk anak usia SD/MI sore hari, Senin – Kamis pukul 13.30 – 16.10 WIB.
                            </p>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="bg-white p-5 border border-[#E5E0D8] rounded-md space-y-3">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Bulanan (Syahriyah):</span>
                                <span class="text-2xl font-extrabold text-[#0D3B2E] font-sans">
                                    Rp 12.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                                </span>
                            </div>
                            <p class="text-xs text-[#059669] font-medium leading-relaxed">
                                *Infaq pendidikan madrasah sore yang sangat terjangkau bagi masyarakat sekitar Mekar Baru, Petir.
                            </p>
                            <div class="flex items-baseline justify-between pt-2 border-t border-[#E5E0D8] text-xs">
                                <span class="text-[#4B6358]">Biaya Pendaftaran PSB:</span>
                                <strong class="text-sm font-bold text-[#B89758] font-sans">Rp {{ $feeMdta }}</strong>
                            </div>
                        </div>

                        <!-- Highlights -->
                        <div class="space-y-2 text-xs">
                            <span class="font-bold text-[#0D3B2E] uppercase tracking-wider block">Materi & Jadwal Belajar MDTA:</span>
                            <ul class="space-y-2 text-[#18181B]">
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Jadwal sekolah: Senin s/d Kamis, Pukul 13.30 – 16.10 WIB.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Tahfidzul Qur'an setiap Senin (Target berjenjang Kelas 1, 2, dan 3).</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Materi Diniyah: Aqidah, Bahasa Arab, Praktik Ibadah/Fiqh, Hadist, Akhlak, & SKI.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Pengembangan Seni bergilir: Hadroh Putra/Putri, Senam, Kaligrafi, Drama, & Tadabbur Alam.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#E5E0D8]">
                        <a href="{{ route('psb.index') }}?program=MDTA" class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md bg-[#B89758] hover:bg-[#96783e] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                            <span>Daftar MDTA Sore Sekarang &rarr;</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION 3: TARGET HAFALAN AL-QUR'AN SANTRI MDTA (T.A 2026/2027) -->
    <section id="target-hafalan" class="py-16 md:py-24 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-3xl">
                    <span class="editorial-label text-[#059669]">TARGET KURIKULUM TAHFIDZ T.A 2026 – 2027</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Target Hafalan Al-Qur'an Santri MDTA
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Mata Pelajaran Tahfidzul Qur'an diselenggarakan setiap <strong>Hari Senin, Pukul 14.00 – 14.45 WIB</strong> dengan kurikulum hafalan berjenjang dari Juz 30.
                    </p>
                </div>

                @php
                    $hafalanBrochure = 'images/Target Hafalan Qur\'an.jpg';
                    $hasHafalanBrochure = file_exists(public_path($hafalanBrochure));
                @endphp
                <div class="flex items-center gap-3 shrink-0">
                    @if($hasHafalanBrochure)
                        <button type="button"
                            @click="openModal('{{ asset($hafalanBrochure) }}', 'Brosur Target Hafalan Al-Quran Santri MDTA')"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-md bg-white border border-[#E5E0D8] hover:border-[#0D3B2E] text-xs font-semibold text-[#0D3B2E] transition shadow-xs">
                            <svg class="w-4 h-4 text-[#059669]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <span>Lihat Brosur Asli</span>
                        </button>
                    @endif
                </div>
            </div>

            <!-- Target Cards Grid for Kelas 1, 2, 3 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kelas 1 -->
                <div class="bg-white border-2 border-emerald-600/30 rounded-lg p-6 space-y-4 hover:border-emerald-600 hover:shadow-md transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="text-xs font-mono font-bold px-2.5 py-1 rounded bg-emerald-100 text-[#084C27]">
                            TINGKAT DASAR
                        </span>
                        <span class="text-xs text-[#4B6358] font-semibold">T.A 2026/2027</span>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">Kelas 1 MDTA</h3>
                        <p class="text-xs text-[#4B6358]">Fondasi makharijul huruf & hafalan surat pendek</p>
                    </div>

                    <div class="p-4 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] space-y-2">
                        <span class="editorial-label text-[#B89758] text-[10px]">TARGET HAFALAN RESMI</span>
                        <div class="font-sans font-bold text-lg text-[#0D3B2E]">
                            Surat An-Nas <span class="text-[#059669]">s/d</span> Surat Al-Ashr
                        </div>
                        <p class="text-[11px] text-[#4B6358]">
                            Mencakup 12 surat pendek Juz 'Amma dengan penekanan tajwid dasar, kelancaran pelafalan, dan keindahan bacaan.
                        </p>
                    </div>

                    <div class="text-[11px] text-[#4B6358] space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                            <span>Jadwal: Setiap Senin (14.00 – 14.45 WIB)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                            <span>Murojaah harian ba'da Dzuhur berjamaah</span>
                        </div>
                    </div>
                </div>

                <!-- Kelas 2 -->
                <div class="bg-white border-2 border-[#B89758]/40 rounded-lg p-6 space-y-4 hover:border-[#B89758] hover:shadow-md transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="text-xs font-mono font-bold px-2.5 py-1 rounded bg-amber-100 text-amber-900">
                            TINGKAT MENENGAH
                        </span>
                        <span class="text-xs text-[#4B6358] font-semibold">T.A 2026/2027</span>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">Kelas 2 MDTA</h3>
                        <p class="text-xs text-[#4B6358]">Pengembangan ketahanan hafalan & kaidah mad</p>
                    </div>

                    <div class="p-4 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] space-y-2">
                        <span class="editorial-label text-[#B89758] text-[10px]">TARGET HAFALAN RESMI</span>
                        <div class="font-sans font-bold text-lg text-[#0D3B2E]">
                            Surat At-Takasur <span class="text-[#B89758]">s/d</span> Surat Al-Fajr
                        </div>
                        <p class="text-[11px] text-[#4B6358]">
                            Mencakup surat-surat pertengahan Juz 30 dengan tartil, pemahaman wakaf wal ibtida', dan murajaah berantai.
                        </p>
                    </div>

                    <div class="text-[11px] text-[#4B6358] space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#B89758]"></span>
                            <span>Jadwal: Setiap Senin (14.00 – 14.45 WIB)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#B89758]"></span>
                            <span>Bimbingan setoran pekanan bersama asatidz</span>
                        </div>
                    </div>
                </div>

                <!-- Kelas 3 -->
                <div class="bg-white border-2 border-[#0D3B2E]/40 rounded-lg p-6 space-y-4 hover:border-[#0D3B2E] hover:shadow-md transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="text-xs font-mono font-bold px-2.5 py-1 rounded bg-emerald-900 text-white">
                            TINGKAT LANJUT
                        </span>
                        <span class="text-xs text-[#4B6358] font-semibold">T.A 2026/2027</span>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">Kelas 3 MDTA</h3>
                        <p class="text-xs text-[#4B6358]">Penyelesaian Juz 'Amma mutqin & persiapan tasmi'</p>
                    </div>

                    <div class="p-4 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] space-y-2">
                        <span class="editorial-label text-[#B89758] text-[10px]">TARGET HAFALAN RESMI</span>
                        <div class="font-sans font-bold text-lg text-[#0D3B2E]">
                            Surat Al-Ghasyiyah <span class="text-[#0D3B2E]">s/d</span> Surat An-Naba
                        </div>
                        <p class="text-[11px] text-[#4B6358]">
                            Penyelesaian surat-surat pembuka Juz 30 hingga tuntas tasmil Juz 30 secara utuh sekali duduk sebelum kelulusan tingkat Ula.
                        </p>
                    </div>

                    <div class="text-[11px] text-[#4B6358] space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#0D3B2E]"></span>
                            <span>Jadwal: Setiap Senin (14.00 – 14.45 WIB)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#0D3B2E]"></span>
                            <span>Ujian tasmi' akbar disaksikan dewan guru</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Catatan Kasih untuk Wali Santri (Quote Box) -->
            <div class="bg-gradient-to-r from-emerald-50 via-white to-amber-50 border-l-4 border-[#059669] rounded-md p-6 sm:p-8 shadow-xs">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-[#0D3B2E] text-white flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div class="space-y-1">
                        <span class="text-[10px] font-mono uppercase font-bold text-[#B89758] tracking-widest block">CATATAN PENTING WALI SANTRI</span>
                        <blockquote class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E] leading-relaxed">
                            &ldquo;Dimohon untuk ayah dan bunda di rumah agar membantu murojaah/hafalan Al-Qur'an anak-anak sholeh dan sholehahnya.&rdquo;
                        </blockquote>
                        <p class="text-xs text-[#4B6358]">
                            Sinergi cinta dan perhatian antara asatidz di madrasah dan orang tua di rumah merupakan kunci keberhasilan mutqin hafalan putra-putri tercinta.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 4: JADWAL MATA PELAJARAN HARIAN SANTRI MDTA (SENIN – KAMIS) -->
    <section id="jadwal-harian" class="py-16 md:py-24 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-3xl">
                    <span class="editorial-label text-[#059669]">RUTINITAS AKADEMIK & DINIYAH</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Jadwal Pelajaran Harian Santri MDTA
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Struktur jadwal harian santri MDTA Ula DAAR EL TAZKIYAH SUMARDI diselenggarakan secara tertib dan disiplin setiap hari <strong>Senin s/d Kamis</strong> mulai pukul 13.30 hingga 16.10 WIB.
                    </p>
                </div>

                @php
                    $jadwalBrochure = 'images/Jadwal Mata Pelajaran Santri MDTA.jpg';
                    $hasJadwalBrochure = file_exists(public_path($jadwalBrochure));
                @endphp
                <div class="flex items-center gap-3 shrink-0">
                    @if($hasJadwalBrochure)
                        <button type="button"
                            @click="openModal('{{ asset($jadwalBrochure) }}', 'Jadwal Mata Pelajaran Harian Santri MDTA')"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] hover:border-[#0D3B2E] text-xs font-semibold text-[#0D3B2E] transition shadow-xs">
                            <svg class="w-4 h-4 text-[#059669]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <span>Lihat Brosur Jadwal Asli</span>
                        </button>
                    @endif
                </div>
            </div>

            <!-- Responsive Daily Schedule Table Component -->
            <div class="border border-[#E5E0D8] rounded-xl overflow-hidden shadow-xs bg-white">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs sm:text-sm border-collapse">
                        <thead>
                            <tr class="bg-[#0D3B2E] text-white border-b border-[#0D3B2E]">
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px] w-36 sm:w-44">Waktu (WIB)</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px]">Senin</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px]">Selasa</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px]">Rabu</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px]">Kamis</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E5E0D8]">
                            <!-- Sesi 1: Dzuhur & Murojaah -->
                            <tr class="bg-emerald-50/60 font-semibold text-[#084C27]">
                                <td class="py-3 px-4 sm:px-6 font-mono font-bold whitespace-nowrap text-[#0D3B2E]">
                                    13.30 – 14.00
                                </td>
                                <td colspan="4" class="py-3 px-4 sm:px-6 text-center sm:text-left">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-[#059669]"></span>
                                        <span>Sholat Dzuhur Berjamaah &amp; Murojaah Juz 30 (Senin s/d Kamis)</span>
                                    </div>
                                </td>
                            </tr>

                            <!-- Sesi 2: Jam Pelajaran 1 -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3.5 px-4 sm:px-6 font-mono font-bold text-[#0D3B2E] whitespace-nowrap bg-gray-50/50">
                                    14.00 – 14.45
                                </td>
                                <td class="py-3.5 px-4 sm:px-6">
                                    <strong class="text-[#0D3B2E] block">Tahfidzul Quran</strong>
                                    <span class="text-[11px] text-[#4B6358]">Target Berjenjang</span>
                                </td>
                                <td class="py-3.5 px-4 sm:px-6">
                                    <strong class="text-[#0D3B2E] block">Aqidah</strong>
                                    <span class="text-[11px] text-[#4B6358]">Kaidah Tauhid</span>
                                </td>
                                <td class="py-3.5 px-4 sm:px-6">
                                    <strong class="text-[#0D3B2E] block">Bahasa Arab</strong>
                                    <span class="text-[11px] text-[#4B6358]">Mufradat & Percakapan</span>
                                </td>
                                <td class="py-3.5 px-4 sm:px-6">
                                    <strong class="text-[#0D3B2E] block">Praktik Ibadah / Fiqh</strong>
                                    <span class="text-[11px] text-[#4B6358]">Wudhu, Sholat, Thaharah</span>
                                </td>
                            </tr>

                            <!-- Sesi 3: Istirahat & Ashar -->
                            <tr class="bg-amber-50/60 font-semibold text-amber-950">
                                <td class="py-3 px-4 sm:px-6 font-mono font-bold whitespace-nowrap text-[#B89758]">
                                    14.45 – 15.15
                                </td>
                                <td colspan="4" class="py-3 px-4 sm:px-6 text-center sm:text-left">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-[#B89758]"></span>
                                        <span>Istirahat &amp; Sholat Ashar Berjamaah (Senin s/d Kamis)</span>
                                    </div>
                                </td>
                            </tr>

                            <!-- Sesi 4: Jam Pelajaran 2 -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3.5 px-4 sm:px-6 font-mono font-bold text-[#0D3B2E] whitespace-nowrap bg-gray-50/50">
                                    15.15 – 16.00
                                </td>
                                <td class="py-3.5 px-4 sm:px-6">
                                    <strong class="text-[#0D3B2E] block">Hadist</strong>
                                    <span class="text-[11px] text-[#4B6358]">Hadits Pilihan Arbain</span>
                                </td>
                                <td class="py-3.5 px-4 sm:px-6">
                                    <strong class="text-[#0D3B2E] block">Akhlak</strong>
                                    <span class="text-[11px] text-[#4B6358]">Adab Santri & Orang Tua</span>
                                </td>
                                <td class="py-3.5 px-4 sm:px-6">
                                    <strong class="text-[#0D3B2E] block">Sejarah Kebudayaan Islam (SKI)</strong>
                                    <span class="text-[11px] text-[#4B6358]">Kisah Sahabat & Sirah</span>
                                </td>
                                <td class="py-3.5 px-4 sm:px-6 bg-emerald-50/40">
                                    <strong class="text-[#084C27] block">Seni &amp; Pengembangan Bakat</strong>
                                    <span class="text-[11px] text-[#059669]">Bergilir Setiap Pekan &darr;</span>
                                </td>
                            </tr>

                            <!-- Sesi 5: Himbauan & Tandzif -->
                            <tr class="bg-gray-100/70 text-[#4B6358]">
                                <td class="py-3 px-4 sm:px-6 font-mono font-bold whitespace-nowrap text-[#0D3B2E]">
                                    16.00 – 16.10
                                </td>
                                <td colspan="4" class="py-3 px-4 sm:px-6 font-medium">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-slate-500"></span>
                                        <span>Himbauan Asatidz, Doa Kafaratul Majelis, &amp; Tandzif Jama'i (Piket Kebersihan Kelas Bersama)</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 5: PROGRAM PENGEMBANGAN BAKAT & KEGIATAN SENI (KAMIS 15.15 - 16.00 WIB) -->
    <section id="kegiatan-seni" class="py-16 md:py-24 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-3xl">
                    <span class="editorial-label text-[#059669]">ROTASI MINAT & BAKAT SETIAP KAMIS</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Program Pengembangan Bakat & Kegiatan Seni
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Dilaksanakan setiap <strong>Hari Kamis, Pukul 15.15 – 16.00 WIB</strong> secara bergilir per pekan guna menggali potensi kreativitas, keterampilan motorik, dan ukhuwah santri.
                    </p>
                </div>

                @php
                    $seniBrochure = 'images/Kegiatan Seni.jpg';
                    $hasSeniBrochure = file_exists(public_path($seniBrochure));
                @endphp
                <div class="flex items-center gap-3 shrink-0">
                    @if($hasSeniBrochure)
                        <button type="button"
                            @click="openModal('{{ asset($seniBrochure) }}', 'Jadwal Program Pengembangan Seni Santri')"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-md bg-white border border-[#E5E0D8] hover:border-[#0D3B2E] text-xs font-semibold text-[#0D3B2E] transition shadow-xs">
                            <svg class="w-4 h-4 text-[#059669]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <span>Lihat Brosur Seni Asli</span>
                        </button>
                    @endif
                </div>
            </div>

            <!-- 5 Pekan Rotation Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
                <!-- Pekan 1 -->
                <div class="bg-white border-2 border-emerald-600/20 rounded-lg p-5 space-y-3 hover:border-emerald-600 hover:shadow-xs transition flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-emerald-100 text-[#084C27]">Pekan 1</span>
                            <span class="text-[10px] text-[#4B6358] font-mono">Kamis</span>
                        </div>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E] leading-snug">
                            Hadroh Putra &amp; Senam
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Latihan tabuhan rebana sholawat untuk santri putra serta senam kebugaran jasmani bersama asatidz.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-[#E5E0D8] text-[10px] font-mono text-[#059669] font-semibold">
                        Seni Musik Islami &amp; Fisik
                    </div>
                </div>

                <!-- Pekan 2 -->
                <div class="bg-white border-2 border-amber-600/20 rounded-lg p-5 space-y-3 hover:border-amber-600 hover:shadow-xs transition flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-900">Pekan 2</span>
                            <span class="text-[10px] text-[#4B6358] font-mono">Kamis</span>
                        </div>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E] leading-snug">
                            Kaligrafi (Khat)
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Pelatihan seni menulis khat indah ayat Al-Qur'an (kaidah Naskhi &amp; Riq'ah) melatih estetika tangan santri.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-[#E5E0D8] text-[10px] font-mono text-[#B89758] font-semibold">
                        Seni Rupa Khattil Qur'an
                    </div>
                </div>

                <!-- Pekan 3 -->
                <div class="bg-white border-2 border-purple-600/20 rounded-lg p-5 space-y-3 hover:border-purple-600 hover:shadow-xs transition flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-purple-100 text-purple-900">Pekan 3</span>
                            <span class="text-[10px] text-[#4B6358] font-mono">Kamis</span>
                        </div>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E] leading-snug">
                            Hadroh Putri &amp; Muhadhoroh
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Grup hadroh qasidah khusus santriwati dipadukan latihan pidato dakwah (muhadhoroh) membina keberanian santri.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-[#E5E0D8] text-[10px] font-mono text-purple-700 font-semibold">
                        Kepenyiaran &amp; Sholawat
                    </div>
                </div>

                <!-- Pekan 4 -->
                <div class="bg-white border-2 border-blue-600/20 rounded-lg p-5 space-y-3 hover:border-blue-600 hover:shadow-xs transition flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-blue-100 text-blue-900">Pekan 4</span>
                            <span class="text-[10px] text-[#4B6358] font-mono">Kamis</span>
                        </div>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E] leading-snug">
                            Drama Colosal
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Pentas seni teater bertema sejarah Islam dan keteladanan para Nabi melatih kerja sama tim dan retorika panggung.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-[#E5E0D8] text-[10px] font-mono text-blue-700 font-semibold">
                        Seni Peran &amp; Kolaborasi
                    </div>
                </div>

                <!-- Pekan 5 -->
                <div class="bg-white border-2 border-emerald-800/20 rounded-lg p-5 space-y-3 hover:border-emerald-800 hover:shadow-xs transition flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-emerald-800 text-white">Pekan 5</span>
                            <span class="text-[10px] text-emerald-100 font-mono">Kamis</span>
                        </div>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E] leading-snug">
                            Tadabbur Alam
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Aktivitas luar ruangan menyatu dengan alam asri pedesaan Mekar Baru untuk merenungi tanda-tanda kebesaran ciptaan Allah SWT.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-[#E5E0D8] text-[10px] font-mono text-[#0D3B2E] font-semibold">
                        Eksplorasi Alam &amp; Karakter
                    </div>
                </div>
            </div>

            <!-- Santri Activity Gallery Visual Companion -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                <div class="border border-[#E5E0D8] rounded-xl overflow-hidden bg-white shadow-xs group">
                    <div class="aspect-16/10 relative overflow-hidden bg-gray-100 cursor-pointer"
                         @click="openModal('{{ asset('images/foto-santri-2.webp') }}', 'Kebersamaan Santri Putra & Putri Daar El Tazkiyah')">
                        <img src="{{ asset('images/foto-santri-2.webp') }}"
                            alt="Kegiatan Santri Daar El Tazkiyah"
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold gap-1.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            <span>Perbesar Dokumentasi Santri</span>
                        </div>
                    </div>
                    <div class="p-4 space-y-1">
                        <h4 class="font-sans font-bold text-sm text-[#0D3B2E]">Kebersamaan &amp; Disiplin Santri</h4>
                        <p class="text-xs text-[#4B6358]">Mendidik santri agar saling mendukung dalam kebaikan, tolong-menolong, dan menjaga adab ukhuwah islamiyah.</p>
                    </div>
                </div>

                <div class="border border-[#E5E0D8] rounded-xl overflow-hidden bg-white shadow-xs group">
                    <div class="aspect-16/10 relative overflow-hidden bg-gray-100 cursor-pointer"
                         @click="openModal('{{ asset('images/foto-santri-3.webp') }}', 'Keceriaan dan Prestasi Santri Daar El Tazkiyah')">
                        <img src="{{ asset('images/foto-santri-3.webp') }}"
                            alt="Prestasi Santri Daar El Tazkiyah"
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold gap-1.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            <span>Perbesar Dokumentasi Santri</span>
                        </div>
                    </div>
                    <div class="p-4 space-y-1">
                        <h4 class="font-sans font-bold text-sm text-[#0D3B2E]">Keceriaan Belajar &amp; Berprestasi</h4>
                        <p class="text-xs text-[#4B6358]">Suasana pembelajaran yang menyenangkan dan penuh keberkahan di bawah naungan Al-Qur'an.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 6: EKSTRAKURIKULER SANTRI -->
    <section id="ekstrakurikuler" class="py-16 md:py-24 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label text-[#059669]">PENGEMBANGAN MINAT & BAKAT SANTRI</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Kegiatan Ekstrakurikuler Santri
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Untuk menunjang kebugaran fisik, jiwa seni Islami, dan kepemimpinan santri di luar ruang kelas.
                    </p>
                </div>
                <span class="text-xs font-mono text-[#059669] font-bold">6 Pilihan Ekstrakurikuler</span>
            </div>

            <!-- 6 Extracurricular Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Pencak Silat -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">01</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Bela Diri</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Pencak Silat</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Seni bela diri tradisional nusantara untuk melatih ketangkasan fisik, pertahanan diri, kedisiplinan mental, dan ketangguhan jasmani santri.
                    </p>
                </div>

                <!-- 2. Hadroh -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">02</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-amber-100 text-amber-900 font-semibold">Seni Sholawat</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Hadroh &amp; Rebana</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Seni tabuh rebana dan lantunan qasidah sholawat nabi untuk menumbuhkan mahabbah kepada Rasulullah SAW dan keindahan seni Islam.
                    </p>
                </div>

                <!-- 3. Kaligrafi -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">03</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-blue-100 text-blue-900 font-semibold">Khat Al-Qur'an</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Kaligrafi (Khattil Qur'an)</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pelatihan menulis ayat-ayat Al-Qur'an dengan kaidah khat Naskhi, Tsuluts, Riq'ah, dan Diwani guna melatih ketelitian dan estetika seni santri.
                    </p>
                </div>

                <!-- 4. Tilawah / Qiro'ah -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">04</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Nagham Quran</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Seni Baca Al-Qur'an (Tilawah)</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pendalaman irama lagu tilawah Al-Qur'an (Bayyati, Shoba, Hijaz, Nahawand, Rost, Jiharkah, Sikah) untuk persiapan kafilah MTQ/MHQ.
                    </p>
                </div>

                <!-- 5. Futsal -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">05</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-orange-100 text-orange-900 font-semibold">Olahraga Fisik</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Futsal &amp; Olahraga</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Olahraga tim mingguan untuk menyegarkan pikiran, melatih kekompakan ukhuwah antar santri, dan menjaga stamina tubuh agar tetap bugar.
                    </p>
                </div>

                <!-- 6. Pramuka -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">06</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-stone-100 text-stone-900 font-semibold">Kepanduan</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Pramuka Santri</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Gerakan kepanduan untuk mengasah jiwa kepemimpinan, keterampilan bertahan di alam terbuka, tali temali, sandi, dan cinta tanah air.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- IMAGE PREVIEW / LIGHTBOX MODAL -->
    <div x-show="showModal" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4 sm:p-6"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="closeModal()">

        <div class="relative bg-white rounded-lg overflow-hidden max-w-4xl w-full max-h-[90vh] flex flex-col shadow-2xl border border-white/20"
             @click.stop>

            <!-- Modal Header -->
            <div class="flex items-center justify-between px-5 py-3.5 bg-[#FAF8F5] border-b border-[#E5E0D8]">
                <h3 class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E]" x-text="modalTitle"></h3>
                <button type="button" @click="closeModal()" class="p-1.5 rounded-md hover:bg-gray-200 text-gray-600 transition" aria-label="Tutup">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Modal Body (Scrollable Image) -->
            <div class="overflow-auto p-4 flex items-center justify-center bg-[#18181B]/5">
                <img :src="modalImage" :alt="modalTitle" class="max-h-[72vh] w-auto max-w-full object-contain rounded shadow-xs">
            </div>

            <!-- Modal Footer -->
            <div class="px-5 py-3 bg-[#FAF8F5] border-t border-[#E5E0D8] flex items-center justify-between text-xs">
                <span class="text-[#4B6358]">Dokumen Resmi DAAR EL TAZKIYAH SUMARDI</span>
                <a :href="modalImage" download class="inline-flex items-center gap-1.5 px-4 py-2 rounded-md bg-[#0D3B2E] text-white font-semibold hover:bg-[#059669] transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>Unduh Brosur</span>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
