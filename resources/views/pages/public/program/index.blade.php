@extends('layouts.public', ['title' => 'Program Pendidikan & Kurikulum - PPMTQ Daar El Tazkiyah Sumardi'])

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
        <!-- Dark Forest Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#042816] via-[#084C27]/90 to-[#042816]/85"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
            <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.2]">
                Program Pendidikan &amp; Kurikulum
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-emerald-100/90 max-w-3xl mx-auto leading-relaxed">
                Memadukan tahfidzul Qur'an mutqin, pembelajaran diniyah kitab salaf, praktik ibadah harian, serta pembinaan minat bakat dan seni santri di bawah naungan Yayasan DAAR EL TAZKIYAH SUMARDI.
            </p>
        </div>
    </section>

    {{-- ========================================================================= --}}
    {{-- SECTION 1: PROGRAM UNGGULAN (Tanpa anchor routing) --}}
    {{-- ========================================================================= --}}
    <section class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        PROGRAM UNGGULAN
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    Enam pilar keunggulan PPMTQ Daar El Tazkiyah Sumardi yang dirancang terintegrasi untuk mencetak generasi Qur'ani yang berilmu, bertakwa, berakhlak mulia, dan siap mengabdi.
                </p>
            </div>

            <!-- Subsection 1.1: 6 Flagship Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Tahfidz Al-Qur'an -->
                <div
                    class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-2 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div
                        class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B89758] to-[#059669] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <span class="font-mono text-xs font-bold text-[#B89758] block">01</span>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Tahfidz Al-Qur'an
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Program menghafal Al-Qur'an secara terarah, bertahap, dan mutqin bersama para asatidz huffadz melalui bimbingan talaqqi dan tasmi' berkala.
                    </p>
                </div>

                <!-- 2. Tahfidz Hadits -->
                <div
                    class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-2 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div
                        class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B89758] to-[#059669] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <span class="font-mono text-xs font-bold text-[#B89758] block">02</span>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Tahfidz Hadits
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Menghafal dan memahami hadits-hadits pokok dari matan Hadits Arbain Nawawiyah pilihan guna menanamkan dalil hukum dan akhlak nabawi.
                    </p>
                </div>

                <!-- 3. Kajian Kitab Kuning -->
                <div
                    class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-2 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div
                        class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B89758] to-[#059669] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <span class="font-mono text-xs font-bold text-[#B89758] block">03</span>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Kajian Kitab Kuning
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pendalaman khazanah keilmuan Islam klasik (Turats Salaf) meliputi Nahwu, Sharaf, Fiqih, Aqidah, dan Ushul Fiqih bersanad.
                    </p>
                </div>

                <!-- 4. Bahasa Arab & Inggris -->
                <div
                    class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-2 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div
                        class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B89758] to-[#059669] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <span class="font-mono text-xs font-bold text-[#B89758] block">04</span>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Bahasa Arab &amp; Inggris
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pembiasaan komunikasi dwibahasa aktif sehari-hari melalui mufradat harian, muhadatsah pagi, dan pembiasaan biah lughawiyyah di asrama.
                    </p>
                </div>

                <!-- 5. Public Speaking & Da'wah -->
                <div
                    class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-2 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div
                        class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B89758] to-[#059669] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <span class="font-mono text-xs font-bold text-[#B89758] block">05</span>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Public Speaking &amp; Da'wah
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pelatihan dakwah, muhadharah pidato tiga bahasa (Arab, Inggris, Indonesia), dan pengasahan retorika berwibawa di hadapan khalayak umum.
                    </p>
                </div>

                <!-- 6. Pembinaan Akhlak & Kedisiplinan -->
                <div
                    class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-2 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div
                        class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#B89758] to-[#059669] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <span class="font-mono text-xs font-bold text-[#B89758] block">06</span>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Pembinaan Akhlak &amp; Kedisiplinan
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pembentukan karakter santri melalui pembiasaan adab Islami 24 jam, sholat berjamaah tepat waktu di masjid, dan budaya bersih mandiri.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- SECTION 2: PROGRAM PENDIDIKAN (MTS & MDTA DENGAN CTA) -->
    <!-- ========================================================================= -->
    <section id="program-pendidikan" class="py-12 md:py-16 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        PROGRAM PENDIDIKAN
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    Pilihan jenjang pendidikan formal asrama 24 jam untuk tingkat MTs dan madrasah diniyah takmiliyah sore hari untuk santri usia sekolah dasar.
                </p>
            </div>

            <!-- Program Comparison 2-Columns Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
                <!-- Subsection 2.1: MTs Mukim 24 Jam -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 sm:p-8 flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] hover:shadow-md transition">
                    <div class="space-y-6">
                        <div>
                            <div class="border-b border-[#E5E0D8] pb-2 mb-2">
                                <span class="editorial-label text-[#059669]">PENDIDIKAN FORMAL ASRAMA 24 JAM</span>
                            </div>
                            <h3 class="font-sans font-bold text-2xl text-[#0D3B2E]">
                                MTs (Madrasah Tsanawiyah)
                            </h3>
                            <p class="text-xs sm:text-sm text-[#4B6358] mt-2 leading-relaxed">
                                Pendidikan formal setingkat SMP terpadu asrama mukim 24 jam dengan bimbingan asatidz intensif, target hafalan Al-Qur'an mutqin, serta integrasi kurikulum resmi Kementerian Agama RI dan kepesantrenan salaf.
                            </p>
                        </div>

                        <div class="space-y-3 text-xs sm:text-sm">
                            <span class="font-bold text-[#0D3B2E] uppercase tracking-wider block text-xs">Keunggulan Utama MTs:</span>
                            <ul class="space-y-2.5 text-[#18181B]">
                                <li class="flex items-start gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#059669] mt-1.5 shrink-0"></span>
                                    <span>Asrama mukim 24 jam di bawah bimbingan musyrif &amp; asatidz huffadz</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#059669] mt-1.5 shrink-0"></span>
                                    <span>Target hafalan Al-Qur'an terarah dan mutqin dengan bimbingan talaqqi</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#059669] mt-1.5 shrink-0"></span>
                                    <span>Ijazah formal Kementerian Agama RI (diakui lanjut ke SMA/MA/SMK)</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#059669] mt-1.5 shrink-0"></span>
                                    <span>Pembiasaan bahasa Arab &amp; Inggris harian serta kajian kitab turats</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-5 border-t border-[#E5E0D8]">
                        <a href="{{ route('mts.index') }}"
                            class="w-full inline-flex items-center justify-center gap-2 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs group">
                            <span>Pelajari Selengkapnya MTs &rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Subsection 2.2: MDTA Non-Mukim -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 sm:p-8 flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] hover:shadow-md transition">
                    <div class="space-y-6">
                        <div>
                            <div class="border-b border-[#E5E0D8] pb-2 mb-2">
                                <span class="editorial-label text-[#B89758]">PENDIDIKAN DINIYAH SORE</span>
                            </div>
                            <h3 class="font-sans font-bold text-2xl text-[#0D3B2E]">
                                MDTA (Madrasah Diniyah Takmiliyah Awaliyah)
                            </h3>
                            <div class="text-xs font-mono font-bold text-[#059669] mt-1">
                                Unit Resmi: MDT Ula DAAR EL TAZKIYAH SUMARDI
                            </div>
                            <p class="text-xs sm:text-sm text-[#4B6358] mt-2 leading-relaxed">
                                Madrasah Diniyah Takmiliyah Ula resmi terdaftar di Kemenag Serang (No. Ijop: 0355, NSMDT: 311236041251) untuk anak usia SD/MI setiap sore hari, Senin – Kamis pukul 13.30 – 16.10 WIB.
                            </p>
                        </div>

                        <div class="space-y-3 text-xs sm:text-sm">
                            <span class="font-bold text-[#0D3B2E] uppercase tracking-wider block text-xs">Keunggulan Utama MDTA:</span>
                            <ul class="space-y-2.5 text-[#18181B]">
                                <li class="flex items-start gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#B89758] mt-1.5 shrink-0"></span>
                                    <span>Jadwal sore sepulang sekolah: Senin s/d Kamis (13.30 – 16.10 WIB)</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#B89758] mt-1.5 shrink-0"></span>
                                    <span>Tahfidzul Qur'an &amp; BTQ terpadu dengan target berjenjang per kelas</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#B89758] mt-1.5 shrink-0"></span>
                                    <span>Praktik sholat berjamaah langsung di masjid dan doa harian</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#B89758] mt-1.5 shrink-0"></span>
                                    <span>Kurikulum diniyah lengkap: Aqidah, Akhlak, Fiqih, SKI, &amp; Bahasa Arab</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-5 border-t border-[#E5E0D8]">
                        <a href="{{ route('mdta.index') }}"
                            class="w-full inline-flex items-center justify-center gap-2 py-3.5 rounded-md bg-[#B89758] hover:bg-[#96783e] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs group">
                            <span>Pelajari Selengkapnya MDTA &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- SECTION 3: EKSTRAKURIKULER -->
    <!-- ========================================================================= -->
    <section id="ekstrakurikuler" class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        EKSTRAKURIKULER &amp; SENI SANTRI
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    Wadah pengembangan bakat, ketangkasan fisik, seni budaya Islam, dan kepemimpinan untuk membentuk pribadi santri yang aktif, tangguh, dan berprestasi.
                </p>
            </div>

            <!-- 6 Extracurricular Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Pencak Silat -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-2 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <span class="text-xs font-mono font-bold text-[#B89758] block">01</span>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Pencak Silat</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Seni bela diri tradisional nusantara untuk melatih ketangkasan fisik, pertahanan diri, dan kedisiplinan mental santri.
                    </p>
                </div>

                <!-- 2. Hadroh & Rebana -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-2 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <span class="text-xs font-mono font-bold text-[#B89758] block">02</span>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Hadroh &amp; Rebana</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Seni tabuh rebana dan lantunan qasidah sholawat untuk menumbuhkan mahabbah kepada baginda Rasulullah SAW.
                    </p>
                </div>

                <!-- 3. Kaligrafi -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-2 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <span class="text-xs font-mono font-bold text-[#B89758] block">03</span>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Kaligrafi (Khattil Qur'an)</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pelatihan menulis ayat Al-Qur'an dengan kaidah khat Naskhi, Tsuluts, dan Riq'ah melatih estetika seni santri.
                    </p>
                </div>

                <!-- 4. Tilawah / Nagham -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-2 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <span class="text-xs font-mono font-bold text-[#B89758] block">04</span>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Seni Baca Al-Qur'an (Tilawah)</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pendalaman irama lagu tilawah Al-Qur'an (Bayyati, Shoba, Hijaz, Nahawand, Rost) untuk persiapan ajang MTQ/MHQ.
                    </p>
                </div>

                <!-- 5. Futsal & Olahraga -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-2 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <span class="text-xs font-mono font-bold text-[#B89758] block">05</span>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Futsal &amp; Olahraga</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Olahraga tim mingguan untuk menyegarkan stamina jasmani, mempererat kekompakan ukhuwah antar santri.
                    </p>
                </div>

                <!-- 6. Pramuka Santri -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-2 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <span class="text-xs font-mono font-bold text-[#B89758] block">06</span>
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
