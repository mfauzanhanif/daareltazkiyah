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

    <!-- 1. PAGE HERO BANNER -->
    <section class="relative bg-cover bg-center overflow-hidden py-16 md:py-24 border-b border-[#B89758]/30"
             style="background-image: url('{{ asset('images/foto-santri-2.webp') }}');">
        <div class="absolute inset-0 bg-gradient-to-t from-[#042816] via-[#084C27]/90 to-[#042816]/85"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-amber-300 text-xs font-semibold uppercase tracking-wider">
                <span>Kurikulum &amp; Jenjang Pendidikan</span>
            </div>
            <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.2]">
                Program Pendidikan &amp; Kurikulum MDTA
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-emerald-100/90 max-w-3xl mx-auto leading-relaxed">
                Memadukan tahfidzul Qur'an mutqin, pembelajaran diniyah kitab salaf, praktik ibadah harian, serta pembinaan minat bakat dan seni santri di bawah naungan Yayasan DAAR EL TAZKIYAH SUMARDI.
            </p>
        </div>
    </section>

    <!-- 2. SECTION 1: 6 PROGRAM UNGGULAN -->
    <section id="program-unggulan" class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-2">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        PROGRAM UNGGULAN
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    6 Pilar utama keunggulan pendidikan yang membentuk santri mutqin dan berakhlakul karimah
                </p>
            </div>

            <!-- 6 Flagship Cards Grid (matching home.blade.php style) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Tahfidz Al-Qur'an -->
                <div class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-2.5 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B89758] to-[#059669] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#B89758]">01</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Hafalan Mutqin</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Tahfidz Al-Qur'an
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Program menghafal Al-Qur'an secara terarah, bertahap, dan mutqin bersama para asatidz huffadz bersanad.
                    </p>
                </div>

                <!-- 2. Tahfidz Hadits -->
                <div class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-2.5 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B89758] to-[#059669] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#B89758]">02</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Sunnah Pilihan</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Tahfidz Hadits
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Menghafal dan memahami hadits-hadits pokok dari matan hadits Arbain Nawawiyah sebagai pedoman hidup sehari-hari.
                    </p>
                </div>

                <!-- 3. Kajian Kitab Kuning -->
                <div class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-2.5 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B89758] to-[#059669] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#B89758]">03</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-amber-100 text-amber-900 font-semibold">Turats Salaf</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Kajian Kitab Kuning
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pendalaman khazanah keilmuan Islam klasik meliputi nahwu, sharaf, fiqih ibadah (Safinatun Najah), aqidah, dan adab santri.
                    </p>
                </div>

                <!-- 4. Bahasa Arab & Inggris -->
                <div class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-2.5 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B89758] to-[#059669] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#B89758]">04</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-blue-100 text-blue-900 font-semibold">Bilingual</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Bahasa Arab &amp; Inggris
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pembiasaan komunikasi dwibahasa aktif melalui pengayaan kosa kata (mufradat) dan percakapan rutin (muhadatsah).
                    </p>
                </div>

                <!-- 5. Public Speaking & Da'wah -->
                <div class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-2.5 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B89758] to-[#059669] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#B89758]">05</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-purple-100 text-purple-900 font-semibold">Muhadharah</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Public Speaking &amp; Da'wah
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pelatihan pidato dakwah tiga bahasa (Arab, Inggris, Indonesia) dan retorika berwibawa di hadapan publik.
                    </p>
                </div>

                <!-- 6. Pembinaan Akhlak & Kedisiplinan -->
                <div class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-2.5 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B89758] to-[#059669] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#B89758]">06</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Adab 24 Jam</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Pembinaan Akhlak &amp; Kedisiplinan
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pembentukan karakter santri melalui pembiasaan adab Islami 24 jam, ketertiban shalat berjamaah, dan kemandirian asrama.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. SECTION 2: JENJANG PENDIDIKAN (MTS & MDTA) -->
    <section id="program-pendidikan" class="py-12 md:py-16 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-2">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        PROGRAM PENDIDIKAN
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    Dua jalur pendidikan terpadu: jenjang MTs berasrama penuh (24 jam) dan jenjang MDTA madrasah sore hari
                </p>
            </div>

            <!-- Program Comparison 2-Columns Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
                <!-- 1. MTs Mukim 24 Jam -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 sm:p-8 flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] hover:shadow-md transition">
                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center justify-between gap-2 border-b border-[#E5E0D8] pb-2 mb-2">
                                <span class="editorial-label text-[#059669]">PENDIDIKAN FORMAL ASRAMA 24 JAM</span>
                                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold tracking-wider uppercase bg-[#0D3B2E] text-white">Mukim</span>
                            </div>
                            <h3 class="font-sans font-bold text-2xl text-[#0D3B2E]">
                                MTs (Madrasah Tsanawiyah)
                            </h3>
                            <p class="text-xs text-[#4B6358] mt-1.5 leading-relaxed">
                                Pendidikan formal setingkat SMP terpadu asrama mukim 24 jam dengan bimbingan asatidz intensif, target hafalan Al-Qur'an mutqin, dan kurikulum resmi Kementerian Agama RI.
                            </p>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="bg-white p-5 border border-[#E5E0D8] rounded-xl space-y-3 shadow-xs">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs font-semibold text-[#4B6358]">Iuran Bulanan (Syahriyah):</span>
                                <span class="text-2xl font-extrabold text-[#0D3B2E] font-sans">
                                    Rp 500.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                                </span>
                            </div>
                            <p class="text-xs text-[#059669] font-medium leading-relaxed">
                                *Sudah termasuk biaya pendidikan asrama &amp; makan 3x sehari. Santri membawa perlengkapan mencuci pakaian mandiri.
                            </p>
                            <div class="flex items-baseline justify-between pt-2 border-t border-[#E5E0D8] text-xs">
                                <span class="text-[#4B6358]">Biaya Pendaftaran PSB:</span>
                                <strong class="text-sm font-bold text-[#B89758] font-sans">Rp {{ $feeMts }}</strong>
                            </div>
                        </div>

                        <div class="space-y-2 text-xs">
                            <span class="font-bold text-[#0D3B2E] uppercase tracking-wider block">Keunggulan MTs Mukim:</span>
                            <ul class="space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                                    <span>Asrama mukim 24 jam di bawah bimbingan musyrif &amp; asatidz huffadz</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                                    <span>Target hafalan Al-Qur'an terarah dan mutqin</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                                    <span>Ijazah formal Kementerian Agama RI (diakui lanjut ke SMA/MA)</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#E5E0D8]">
                        <a href="{{ route('psb.form', ['program' => 'MTS']) }}"
                            class="w-full inline-flex items-center justify-center gap-2 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                            <span>Daftar MTs Mukim Sekarang &rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- 2. MDTA Non-Mukim -->
                <div id="mdta-kurikulum" class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 sm:p-8 flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] hover:shadow-md transition">
                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center justify-between gap-2 border-b border-[#E5E0D8] pb-2 mb-2">
                                <span class="editorial-label text-[#B89758]">PENDIDIKAN DINIYAH SORE</span>
                                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold tracking-wider uppercase bg-amber-100 text-amber-800">Tingkat Ula</span>
                            </div>
                            <h3 class="font-sans font-bold text-2xl text-[#0D3B2E]">
                                MDTA (Madrasah Diniyah Takmiliyah Awaliyah)
                            </h3>
                            <div class="text-xs font-mono font-bold text-[#059669] mt-1">
                                Unit Resmi: MDT Ula DAAR EL TAZKIYAH SUMARDI
                            </div>
                            <p class="text-xs text-[#4B6358] mt-1.5 leading-relaxed">
                                Madrasah Diniyah Takmiliyah Ula resmi terdaftar di Kemenag Serang (No. Ijop: 0355, NSMDT: 311236041251) untuk anak usia SD/MI sore hari, Senin – Kamis pukul 13.30 – 16.10 WIB.
                            </p>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="bg-white p-5 border border-[#E5E0D8] rounded-xl space-y-3 shadow-xs">
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

                        <div class="space-y-2 text-xs">
                            <span class="font-bold text-[#0D3B2E] uppercase tracking-wider block">Materi &amp; Jadwal MDTA:</span>
                            <ul class="space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#B89758]"></span>
                                    <span>Jadwal sekolah: Senin s/d Kamis, Pukul 13.30 – 16.10 WIB</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#B89758]"></span>
                                    <span>Tahfidzul Qur'an setiap Senin (Target berjenjang Kelas 1, 2, dan 3)</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#B89758]"></span>
                                    <span>Praktik Ibadah, Fiqih, Aqidah, Akhlak, Bahasa Arab, &amp; Hadist</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#E5E0D8]">
                        <a href="{{ route('psb.form', ['program' => 'MDTA']) }}"
                            class="w-full inline-flex items-center justify-center gap-2 py-3.5 rounded-md bg-[#B89758] hover:bg-[#96783e] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                            <span>Daftar MDTA Sore Sekarang &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. SECTION 3: TARGET HAFALAN AL-QUR'AN SANTRI MDTA -->
    <section id="target-hafalan" class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-2">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        TARGET HAFALAN AL-QUR'AN MDTA
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    Mata Pelajaran Tahfidzul Qur'an diselenggarakan setiap <strong>Hari Senin, Pukul 14.00 – 14.45 WIB</strong> dengan kurikulum hafalan berjenjang dari Juz 30
                </p>
            </div>

            <!-- Target Cards Grid for Kelas 1, 2, 3 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kelas 1 -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-4 hover:border-[#0D3B2E] hover:shadow-md transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="text-xs font-mono font-bold px-2.5 py-1 rounded bg-emerald-100 text-[#084C27]">
                            TINGKAT DASAR
                        </span>
                        <span class="text-xs text-[#4B6358] font-semibold">T.A 2026/2027</span>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">Kelas 1 MDTA</h3>
                        <p class="text-xs text-[#4B6358]">Fondasi makharijul huruf &amp; hafalan surat pendek</p>
                    </div>

                    <div class="p-4 rounded-xl bg-[#FAF8F5] border border-[#E5E0D8] space-y-2">
                        <span class="text-[10px] font-mono uppercase text-[#B89758] font-bold block">TARGET HAFALAN RESMI</span>
                        <div class="font-sans font-bold text-lg text-[#0D3B2E]">
                            Surat An-Nas <span class="text-[#059669]">s/d</span> Surat Al-Ashr
                        </div>
                        <p class="text-[11px] text-[#4B6358]">
                            Mencakup 12 surat pendek Juz 'Amma dengan penekanan tajwid dasar dan kelancaran pelafalan.
                        </p>
                    </div>

                    <div class="text-[11px] text-[#4B6358] space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                            <span>Jadwal: Setiap Senin (14.00 – 14.45 WIB)</span>
                        </div>
                    </div>
                </div>

                <!-- Kelas 2 -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-4 hover:border-[#0D3B2E] hover:shadow-md transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="text-xs font-mono font-bold px-2.5 py-1 rounded bg-amber-100 text-amber-900">
                            TINGKAT MENENGAH
                        </span>
                        <span class="text-xs text-[#4B6358] font-semibold">T.A 2026/2027</span>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">Kelas 2 MDTA</h3>
                        <p class="text-xs text-[#4B6358]">Pengembangan ketahanan hafalan &amp; kaidah mad</p>
                    </div>

                    <div class="p-4 rounded-xl bg-[#FAF8F5] border border-[#E5E0D8] space-y-2">
                        <span class="text-[10px] font-mono uppercase text-[#B89758] font-bold block">TARGET HAFALAN RESMI</span>
                        <div class="font-sans font-bold text-lg text-[#0D3B2E]">
                            Surat At-Takasur <span class="text-[#B89758]">s/d</span> Surat Al-Fajr
                        </div>
                        <p class="text-[11px] text-[#4B6358]">
                            Mencakup surat-surat pertengahan Juz 30 dengan tartil dan pemahaman wakaf wal ibtida'.
                        </p>
                    </div>

                    <div class="text-[11px] text-[#4B6358] space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#B89758]"></span>
                            <span>Bimbingan setoran pekanan bersama asatidz</span>
                        </div>
                    </div>
                </div>

                <!-- Kelas 3 -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-4 hover:border-[#0D3B2E] hover:shadow-md transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="text-xs font-mono font-bold px-2.5 py-1 rounded bg-emerald-900 text-white">
                            TINGKAT LANJUT
                        </span>
                        <span class="text-xs text-[#4B6358] font-semibold">T.A 2026/2027</span>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">Kelas 3 MDTA</h3>
                        <p class="text-xs text-[#4B6358]">Penyelesaian Juz 'Amma mutqin &amp; persiapan tasmi'</p>
                    </div>

                    <div class="p-4 rounded-xl bg-[#FAF8F5] border border-[#E5E0D8] space-y-2">
                        <span class="text-[10px] font-mono uppercase text-[#B89758] font-bold block">TARGET HAFALAN RESMI</span>
                        <div class="font-sans font-bold text-lg text-[#0D3B2E]">
                            Surat Al-Ghasyiyah <span class="text-[#0D3B2E]">s/d</span> Surat An-Naba
                        </div>
                        <p class="text-[11px] text-[#4B6358]">
                            Penyelesaian surat pembuka Juz 30 hingga tuntas tasmi' Juz 30 secara utuh sekali duduk.
                        </p>
                    </div>

                    <div class="text-[11px] text-[#4B6358] space-y-1">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#0D3B2E]"></span>
                            <span>Ujian tasmi' akbar disaksikan dewan guru</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. SECTION 4: JADWAL HARIAN SANTRI MDTA -->
    <section id="jadwal-harian" class="py-12 md:py-16 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-2">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        JADWAL PELAJARAN HARIAN SANTRI MDTA
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    Struktur rutinitas harian santri MDTA Ula Senin s/d Kamis pukul 13.30 – 16.10 WIB
                </p>
            </div>

            <!-- Schedule Table -->
            <div class="border border-[#E5E0D8] rounded-2xl overflow-hidden shadow-xs bg-white">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs sm:text-sm border-collapse">
                        <thead>
                            <tr class="bg-[#0D3B2E] text-white">
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px] w-36 sm:w-44">Waktu (WIB)</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px]">Senin</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px]">Selasa</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px]">Rabu</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px]">Kamis</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E5E0D8]">
                            <tr class="bg-emerald-50/60 font-semibold text-[#084C27]">
                                <td class="py-3 px-4 sm:px-6 font-mono font-bold whitespace-nowrap text-[#0D3B2E]">13.30 – 14.00</td>
                                <td colspan="4" class="py-3 px-4 sm:px-6">Sholat Dzuhur Berjamaah &amp; Murojaah Juz 30 (Senin s/d Kamis)</td>
                            </tr>
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3.5 px-4 sm:px-6 font-mono font-bold text-[#0D3B2E] whitespace-nowrap bg-gray-50/50">14.00 – 14.45</td>
                                <td class="py-3.5 px-4 sm:px-6"><strong>Tahfidzul Quran</strong></td>
                                <td class="py-3.5 px-4 sm:px-6"><strong>Aqidah</strong></td>
                                <td class="py-3.5 px-4 sm:px-6"><strong>Bahasa Arab</strong></td>
                                <td class="py-3.5 px-4 sm:px-6"><strong>Praktik Ibadah / Fiqh</strong></td>
                            </tr>
                            <tr class="bg-amber-50/60 font-semibold text-amber-950">
                                <td class="py-3 px-4 sm:px-6 font-mono font-bold whitespace-nowrap text-[#B89758]">14.45 – 15.15</td>
                                <td colspan="4" class="py-3 px-4 sm:px-6">Istirahat &amp; Sholat Ashar Berjamaah (Senin s/d Kamis)</td>
                            </tr>
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3.5 px-4 sm:px-6 font-mono font-bold text-[#0D3B2E] whitespace-nowrap bg-gray-50/50">15.15 – 16.00</td>
                                <td class="py-3.5 px-4 sm:px-6"><strong>Hadist</strong></td>
                                <td class="py-3.5 px-4 sm:px-6"><strong>Akhlak</strong></td>
                                <td class="py-3.5 px-4 sm:px-6"><strong>Sejarah Kebudayaan Islam (SKI)</strong></td>
                                <td class="py-3.5 px-4 sm:px-6 bg-emerald-50/40"><strong>Seni &amp; Pengembangan Bakat</strong></td>
                            </tr>
                            <tr class="bg-gray-100/70 text-[#4B6358]">
                                <td class="py-3 px-4 sm:px-6 font-mono font-bold whitespace-nowrap text-[#0D3B2E]">16.00 – 16.10</td>
                                <td colspan="4" class="py-3 px-4 sm:px-6 font-medium">Himbauan Asatidz, Doa Kafaratul Majelis, &amp; Tandzif Jama'i</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. SECTION 5: PENGEMBANGAN SENI (KAMIS) -->
    <section id="kegiatan-seni" class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-2">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        PENGEMBANGAN SENI SANTRI
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    Rotasi kegiatan minat, bakat, dan seni santri setiap hari Kamis pukul 15.15 – 16.00 WIB
                </p>
            </div>

            <!-- 5 Pekan Rotation Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-5 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition flex flex-col justify-between">
                    <div class="space-y-2">
                        <span class="text-xs font-mono font-bold px-2 py-0.5 rounded bg-emerald-100 text-[#084C27]">Pekan 1</span>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Hadroh Putra &amp; Senam</h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">Latihan tabuhan rebana sholawat untuk santri putra serta senam kebugaran jasmani.</p>
                    </div>
                </div>

                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-5 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition flex flex-col justify-between">
                    <div class="space-y-2">
                        <span class="text-xs font-mono font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-900">Pekan 2</span>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Kaligrafi (Khat)</h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">Pelatihan seni menulis khat indah ayat Al-Qur'an kaidah Naskhi dan Riq'ah.</p>
                    </div>
                </div>

                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-5 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition flex flex-col justify-between">
                    <div class="space-y-2">
                        <span class="text-xs font-mono font-bold px-2 py-0.5 rounded bg-purple-100 text-purple-900">Pekan 3</span>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Hadroh Putri &amp; Muhadhoroh</h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">Grup hadroh qasidah khusus santriwati dipadukan latihan pidato dakwah.</p>
                    </div>
                </div>

                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-5 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition flex flex-col justify-between">
                    <div class="space-y-2">
                        <span class="text-xs font-mono font-bold px-2 py-0.5 rounded bg-blue-100 text-blue-900">Pekan 4</span>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Drama Colosal</h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">Pentas seni teater bertema sejarah Islam melatih kerja sama tim dan retorika.</p>
                    </div>
                </div>

                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-5 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition flex flex-col justify-between">
                    <div class="space-y-2">
                        <span class="text-xs font-mono font-bold px-2 py-0.5 rounded bg-emerald-800 text-white">Pekan 5</span>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Tadabbur Alam</h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">Aktivitas luar ruangan menyatu dengan alam pedesaan Mekar Baru merenungi ciptaan Allah.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. SECTION 6: EKSTRAKURIKULER SANTRI -->
    <section id="ekstrakurikuler" class="py-12 md:py-16 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-2">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        EKSTRAKURIKULER SANTRI
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    Pengembangan bakat non-akademik untuk melatih kebugaran fisik, jiwa seni Islami, dan kepemimpinan
                </p>
            </div>

            <!-- 6 Extracurricular Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Pencak Silat -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-2.5 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#B89758]">01</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Bela Diri</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Pencak Silat</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Seni bela diri tradisional nusantara untuk melatih ketangkasan fisik, pertahanan diri, dan kedisiplinan mental santri.
                    </p>
                </div>

                <!-- 2. Hadroh & Rebana -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-2.5 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#B89758]">02</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-amber-100 text-amber-900 font-semibold">Seni Sholawat</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Hadroh &amp; Rebana</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Seni tabuh rebana dan lantunan qasidah sholawat untuk menumbuhkan mahabbah kepada baginda Rasulullah SAW.
                    </p>
                </div>

                <!-- 3. Kaligrafi -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-2.5 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#B89758]">03</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-blue-100 text-blue-900 font-semibold">Khat Al-Qur'an</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Kaligrafi (Khattil Qur'an)</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pelatihan menulis ayat Al-Qur'an dengan kaidah khat Naskhi, Tsuluts, dan Riq'ah melatih estetika seni santri.
                    </p>
                </div>

                <!-- 4. Tilawah / Nagham -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-2.5 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#B89758]">04</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Nagham Quran</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Seni Baca Al-Qur'an (Tilawah)</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pendalaman irama lagu tilawah Al-Qur'an (Bayyati, Shoba, Hijaz, Nahawand, Rost) untuk persiapan ajang MTQ/MHQ.
                    </p>
                </div>

                <!-- 5. Futsal & Olahraga -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-2.5 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#B89758]">05</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-orange-100 text-orange-900 font-semibold">Olahraga Fisik</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Futsal &amp; Olahraga</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Olahraga tim mingguan untuk menyegarkan stamina jasmani, mempererat kekompakan ukhuwah antar santri.
                    </p>
                </div>

                <!-- 6. Pramuka Santri -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-2.5 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono font-bold text-[#B89758]">06</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-stone-100 text-stone-900 font-semibold">Kepanduan</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Pramuka Santri</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Gerakan kepanduan untuk mengasah jiwa kepemimpinan, keterampilan alam terbuka, tali temali, dan kemandirian.
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

        <div class="relative bg-white rounded-2xl overflow-hidden max-w-4xl w-full max-h-[90vh] flex flex-col shadow-2xl border border-white/20"
             @click.stop>

            <div class="flex items-center justify-between px-5 py-3.5 bg-[#FAF8F5] border-b border-[#E5E0D8]">
                <h3 class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E]" x-text="modalTitle"></h3>
                <button type="button" @click="closeModal()" class="p-1.5 rounded-md hover:bg-gray-200 text-gray-600 transition" aria-label="Tutup">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="overflow-auto p-4 flex items-center justify-center bg-[#18181B]/5">
                <img :src="modalImage" :alt="modalTitle" class="max-h-[72vh] w-auto max-w-full object-contain rounded shadow-xs">
            </div>

            <div class="px-5 py-3 bg-[#FAF8F5] border-t border-[#E5E0D8] flex items-center justify-between text-xs">
                <span class="text-[#4B6358]">PPMTQ DAAR EL TAZKIYAH SUMARDI</span>
                <button type="button" @click="closeModal()" class="px-4 py-1.5 rounded bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

</div>
@endsection
