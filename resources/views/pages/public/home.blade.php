@extends('layouts.public')

@section('content')
    <!-- 1. HERO CAROUSEL SECTION -->
    <x-public.hero :activeWave="$activeWave" :featuredPost="$featuredPost" :feeMts="$feeMts" :feeMdta="$feeMdta" />

    <!-- 2. PROGRAM UNGGULAN SECTION -->
    <section id="program-unggulan" class="py-16 md:py-24 bg-white border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        PROGRAM UNGGULAN
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Kurikulum terpadu memadukan tahfidzul Qur'an mutqin, kajian khazanah turats Islam, serta keahlian
                        bahasa dan kepemimpinan masa depan.
                    </p>
                </div>
                <div class="font-arabic text-base sm:text-lg text-[#084C27] font-semibold" dir="rtl" style="line-height: 1.8;">
                    خَيْرُكُمْ مَنْ تَعَلَّمَ الْقُرْآنَ وَعَلَّمَهُ
                </div>
            </div>

            <!-- 6 Flagship Program Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Tahfidz Al-Qur'an -->
                <div
                    class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Tahfidz Al-Qur'an
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Program menghafal Al-Qur'an secara terarah, terstruktur, dan mutqin dengan bimbingan asatidz huffadz.
                    </p>
                </div>

                <!-- 2. Tahfidz Hadits -->
                <div
                    class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Tahfidz Hadits
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Menghafal dan memahami hadits-hadits pilihan (Arbain Nawawiyah & Riyadhus Shalihin) sebagai pedoman
                        pengamalan sunnah sehari-hari.
                    </p>
                </div>

                <!-- 3. Kajian Kitab Kuning -->
                <div
                    class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Kajian Kitab Kuning
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pendalaman khazanah keilmuan Islam klasik (Turats Salafiyah) meliputi ilmu nahwu, sharaf, fiqih
                        ibadah, tajwid, dan tauhid.
                    </p>
                </div>

                <!-- 4. Bahasa Arab & Inggris -->
                <div
                    class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Bahasa Arab & Inggris
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pembiasaan komunikasi dwibahasa aktif sehari-hari di asrama dan madrasah guna membekali santri
                        bersaing di kancah global.
                    </p>
                </div>

                <!-- 5. Public Speaking -->
                <div
                    class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Public Speaking & Da'wah
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pelatihan dakwah intensif, pidato tiga bahasa (Arab, Inggris, Indonesia), kepemimpinan santri, dan
                        retorika berwibawa di depan umum.
                    </p>
                </div>

                <!-- 6. Pembinaan Akhlak & Kedisiplinan -->
                <div
                    class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Pembinaan Akhlak & Kedisiplinan
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pembentukan karakter santri melalui pembiasaan adab Islami 24 jam, ketertiban shalat berjamaah,
                        kemandirian asrama, dan sopan santun.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. VISI & MISI INSTITUSI -->
    <section class="py-16 md:py-20 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <!-- Left: Visi Quote -->
                <div class="lg:col-span-5 space-y-5">
                    <div class="space-y-1">
                        <div class="font-arabic text-lg sm:text-xl text-[#B89758] font-bold" dir="rtl" style="line-height: 1.8;">
                            بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                        </div>
                        <h2 class="font-sans text-2xl sm:text-3xl font-extrabold text-[#0D3B2E] tracking-tight">
                            VISI & MISI
                        </h2>
                        <div class="border-b border-[#E5E0D8] pb-2 flex items-center justify-between">
                            <span class="editorial-label">VISI</span>
                        </div>
                    </div>

                    <div class="bg-white border-l-4 border-[#0D3B2E] rounded-md p-6 space-y-3 shadow-xs">
                        <blockquote class="font-sans text-base sm:text-lg font-bold text-[#0D3B2E] leading-relaxed">
                            "{{ "Melahirkan generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi dan siap mengabdi untuk umat." }}"
                        </blockquote>
                    </div>
                </div>

                <!-- Right: 4 Misi Cards -->
                <div class="lg:col-span-7 space-y-3" x-data="{ activeMisi: 1 }">
                    <div class="border-b border-[#E5E0D8] pb-2 flex items-center justify-between">
                        <span class="editorial-label">Misi</span>
                    </div>

                    <!-- Misi 1 -->
                    <div class="border border-[#E5E0D8] rounded-md bg-white overflow-hidden transition">
                        <button type="button" @click="activeMisi = (activeMisi === 1 ? 0 : 1)"
                            class="w-full p-4 text-left flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="font-mono text-xs font-bold text-[#B89758]">01</span>
                                <h3 class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E]">
                                    {{ "Menanamkan kecintaan kepada Al-Qur'an" }}
                                </h3>
                            </div>
                            <span class="text-xs text-[#0D3B2E] transition-transform duration-200"
                                :class="{ 'rotate-180': activeMisi === 1 }">&darr;</span>
                        </button>
                        <div x-show="activeMisi === 1"
                            class="px-5 pb-4 pt-1 text-xs text-[#4B6358] border-t border-[#E5E0D8] leading-relaxed bg-[#FAF8F5]">
                            Membimbing hafalan 30 juz Al-Qur'an dengan kaidah tahsin, tadabbur makna ayat, dan
                            pembiasaan muraja'ah harian secara disiplin melalui metode sabaq, sabqi, dan manzil.
                        </div>
                    </div>

                    <!-- Misi 2 -->
                    <div class="border border-[#E5E0D8] rounded-md bg-white overflow-hidden transition">
                        <button type="button" @click="activeMisi = (activeMisi === 2 ? 0 : 2)"
                            class="w-full p-4 text-left flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="font-mono text-xs font-bold text-[#B89758]">02</span>
                                <h3 class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E]">
                                    {{ 'Membentuk akhlak mulia dan disiplin' }}
                                </h3>
                            </div>
                            <span class="text-xs text-[#0D3B2E] transition-transform duration-200"
                                :class="{ 'rotate-180': activeMisi === 2 }">&darr;</span>
                        </button>
                        <div x-show="activeMisi === 2" x-cloak
                            class="px-5 pb-4 pt-1 text-xs text-[#4B6358] border-t border-[#E5E0D8] leading-relaxed bg-[#FAF8F5]">
                            Menegakkan keteladanan adab Islami, disiplin ibadah fardhu & sunnah berjamaah di masjid, serta
                            pembiasaan hidup mandiri dan bertanggung jawab di lingkungan asrama santri.
                        </div>
                    </div>

                    <!-- Misi 3 -->
                    <div class="border border-[#E5E0D8] rounded-md bg-white overflow-hidden transition">
                        <button type="button" @click="activeMisi = (activeMisi === 3 ? 0 : 3)"
                            class="w-full p-4 text-left flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="font-mono text-xs font-bold text-[#B89758]">03</span>
                                <h3 class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E]">
                                    {{ 'Memberikan pendidikan berkualitas berbasis Islam' }}
                                </h3>
                            </div>
                            <span class="text-xs text-[#0D3B2E] transition-transform duration-200"
                                :class="{ 'rotate-180': activeMisi === 3 }">&darr;</span>
                        </button>
                        <div x-show="activeMisi === 3" x-cloak
                            class="px-5 pb-4 pt-1 text-xs text-[#4B6358] border-t border-[#E5E0D8] leading-relaxed bg-[#FAF8F5]">
                            Menggabungkan kurikulum keagamaan muadalah pesantren dengan standar nasional Kementerian Agama
                            RI serta wawasan sains, teknologi, dan bahasa Arab-Inggris terkini.
                        </div>
                    </div>

                    <!-- Misi 4 -->
                    <div class="border border-[#E5E0D8] rounded-md bg-white overflow-hidden transition">
                        <button type="button" @click="activeMisi = (activeMisi === 4 ? 0 : 4)"
                            class="w-full p-4 text-left flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="font-mono text-xs font-bold text-[#B89758]">04</span>
                                <h3 class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E]">
                                    {{ 'Mempersiapkan santri berprestasi di tingkat nasional' }}
                                </h3>
                            </div>
                            <span class="text-xs text-[#0D3B2E] transition-transform duration-200"
                                :class="{ 'rotate-180': activeMisi === 4 }">&darr;</span>
                        </button>
                        <div x-show="activeMisi === 4" x-cloak
                            class="px-5 pb-4 pt-1 text-xs text-[#4B6358] border-t border-[#E5E0D8] leading-relaxed bg-[#FAF8F5]">
                            Mengasah potensi santri dalam Musabaqah Hifdzil Qur'an (MHQ), olimpiade sains madrasah, pidato
                            dwibahasa asing, serta kepemimpinan umat untuk masa depan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. PROGRAM PENDIDIKAN COMPARISON SECTION (MTS & MDTA) -->
    <section id="program" class="py-16 md:py-24 bg-white border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        PROGRAM PENDIDIKAN
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Dua program pendidikan terstruktur dirancang khusus untuk membina hafalan Al-Qur'an, adab mulia, dan
                        kecerdasan intelektual santri di Serang, Banten.
                    </p>
                </div>
            </div>

            <!-- 2-Column Program Comparison Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
                <!-- Program 1: MTS (Mukim 24 Jam) -->
                <div
                    class="bg-white border border-[#E5E0D8] rounded-md p-6 sm:p-8 relative flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] transition shadow-xs">
                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center justify-between gap-2 border-b border-[#E5E0D8] pb-2 mb-2">
                                <span class="editorial-label text-[#059669]">PROGRAM UNGGULAN MUKIM</span>
                                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold tracking-wider uppercase bg-[#0D3B2E] text-white">Mukim</span>
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <h3 class="font-sans font-bold text-2xl text-[#0D3B2E]">MTS</h3>
                            </div>
                        </div>

                        <!-- Price Card -->
                        <div class="bg-[#FAF8F5] p-5 border border-[#E5E0D8] rounded-md space-y-2.5">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Bulanan:</span>
                                <span class="text-2xl font-bold text-[#0D3B2E] font-sans">
                                    Rp 500.000 <span class="text-xs font-normal text-gray-500">/ bln</span>
                                </span>
                            </div>
                            <div class="flex items-baseline justify-between pt-2 border-t border-[#E5E0D8]">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Registrasi PSB:</span>
                                <span class="text-lg font-bold text-[#B89758] font-sans">
                                    Rp {{ $feeMts }}
                                </span>
                            </div>
                            <p class="text-[11px] text-[#4B6358]/80 italic">
                                *Biaya pendaftaran otomatis terhubung dengan gelombang aktif yang berlaku.
                            </p>
                        </div>

                        <!-- Features -->
                        <div class="space-y-2">
                            <div class="text-xs font-bold text-[#0D3B2E] uppercase tracking-wider">Fasilitas & Kurikulum:
                            </div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Asrama mukim 24 jam dengan bimbingan asatidz intensif</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Makan 3 kali sehari dengan menu bergizi</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Ijazah formal Madrasah Tsanawiyah (Kementerian Agama RI)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Ekstrakurikuler: Memanah, beladiri, hadroh, & pidato dwibahasa
                                        (Arab-Inggris)</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-[#E5E0D8]">
                        <a href="{{ route('psb.index') }}?program=MTS"
                            class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-semibold uppercase tracking-wider transition shadow-xs">
                            <span>Daftar MTS Sekarang</span>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Program 2: MDTA (Sekolah Sore) -->
                <div
                    class="bg-white border border-[#E5E0D8] rounded-md p-6 sm:p-8 relative flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] transition shadow-xs">
                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center justify-between gap-2 border-b border-[#E5E0D8] pb-2 mb-2">
                                <span class="editorial-label text-[#B89758]">PROGRAM SEKOLAH SORE</span>
                                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold tracking-wider uppercase bg-[#B89758] text-white">Non-Mukim</span>
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <h3 class="font-sans font-bold text-2xl text-[#0D3B2E]">MDTA</h3>
                            </div>
                        </div>

                        <!-- Price Card -->
                        <div class="bg-[#FAF8F5] p-5 border border-[#E5E0D8] rounded-md space-y-2.5">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Bulanan:</span>
                                <span class="text-2xl font-bold text-[#0D3B2E] font-sans">
                                    Rp 12.000 <span class="text-xs font-normal text-gray-500">/ bln</span>
                                </span>
                            </div>
                            <div class="flex items-baseline justify-between pt-2 border-t border-[#E5E0D8]">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Registrasi PSB:</span>
                                <span class="text-lg font-bold text-[#B89758] font-sans">
                                    Rp {{ $feeMdta }}
                                </span>
                            </div>
                            <p class="text-[11px] text-[#4B6358]/80 italic">
                                *Sesuai gelombang penerimaan santri baru yang berlaku.
                            </p>
                        </div>

                        <!-- Features -->
                        <div class="space-y-2">
                            <div class="text-xs font-bold text-[#0D3B2E] uppercase tracking-wider">Materi & Jadwal Belajar:
                            </div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Jadwal sekolah sore hari ba'da Ashar (Senin s/d Kamis & Sabtu, 14.00 – 17.00
                                        WIB)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Tahsin Al-Qur'an & hafalan Juz 30</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Praktik sholat berjamaah & doa zikir harian ma'tsurat</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Madrasah Diniyah Takmiliyah Awaliyah kurikulum Kemenag</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-[#E5E0D8]">
                        <a href="{{ route('psb.index') }}?program=MDTA"
                            class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md border border-[#0D3B2E] hover:bg-[#0D3B2E] hover:text-white text-[#0D3B2E] text-xs font-semibold uppercase tracking-wider transition shadow-xs">
                            <span>Daftar MDTA Sekarang</span>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- 6. GRID BERITA (FEATURED) -->
    <section class="py-16 md:py-24 bg-white border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <div class="font-arabic text-sm sm:text-base text-[#084C27] font-semibold" dir="rtl" style="line-height: 1.8;">
                        اقْرَأْ وَارْتَقِ وَرَتِّلْ كَمَا كُنْتَ تُرَتِّلُ فِي الدُّنْيَا
                    </div>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Warta Pesantren & Agenda Kegiatan
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Kabar terbaru seputar dinamika santri, tasmi' Al-Qur'an, dan informasi resmi lembaga.
                    </p>
                </div>
                <a href="{{ route('news.index') }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-md border border-[#E5E0D8] hover:border-[#0D3B2E] bg-white text-xs font-bold uppercase tracking-wider text-[#0D3B2E] transition shadow-xs group">
                    <span>Lihat Lebih Banyak Berita</span>
                    <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                </a>
            </div>

            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($latestPosts as $post)
                    <article
                        class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md overflow-hidden flex flex-col justify-between hover:border-[#0D3B2E] hover:shadow-md transition group">
                        <div>
                            <div class="aspect-16/10 relative overflow-hidden bg-gray-100 border-b border-[#E5E0D8]">
                                @if ($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <x-public.image-placeholder :title="$post->title" aspect="aspect-16/10" />
                                @endif
                                <span
                                    class="absolute top-3 left-3 px-2 py-0.5 bg-[#0D3B2E]/90 text-white text-[10px] font-mono uppercase tracking-wider rounded">
                                    {{ $post->category?->name ?? 'Kegiatan' }}
                                </span>
                            </div>

                            <div class="p-5 space-y-2">
                                <time datetime="{{ $post->published_at?->toDateString() }}"
                                    class="text-[11px] font-mono text-[#B89758] block">
                                    {{ $post->published_at?->translatedFormat('d F Y') ?? date('d M Y') }}
                                </time>
                                <h3
                                    class="font-sans font-bold text-base sm:text-lg text-[#0D3B2E] group-hover:text-[#059669] transition line-clamp-2 leading-snug">
                                    <a href="{{ route('news.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="text-xs text-[#4B6358] line-clamp-3 leading-relaxed">
                                    {{ $post->excerpt ?? Str::limit(strip_tags($post->content ?? ($post->body ?? '')), 120) }}
                                </p>
                            </div>
                        </div>

                        <div class="p-5 pt-0 border-t border-[#E5E0D8]/60 mt-3 flex items-center justify-between text-xs">
                            <span class="text-[#4B6358]">Oleh <strong
                                    class="text-[#0D3B2E]">{{ $post->author?->name ?? 'Humas' }}</strong></span>
                            <a href="{{ route('news.show', $post->slug) }}"
                                class="font-bold text-[#0D3B2E] group-hover:text-[#059669] transition inline-flex items-center gap-1">
                                <span>Baca</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </article>
                @empty
                    <div
                        class="col-span-full bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-8 text-center text-xs text-[#4B6358]">
                        Belum ada warta berita yang dipublikasikan.
                    </div>
                @endforelse
            </div>

            <div class="text-center pt-2">
                <a href="{{ route('news.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                    <span>Lihat Lebih Banyak Berita &rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- 7. GRID GALERI (FEATURED) -->
    <section class="py-16 md:py-24 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                     <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Potret Rutinitas & Kehidupan Santri
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Dokumentasi visual hafalan Al-Qur'an, belajar mandiri, dan kegiatan asri santri di Serang, Banten.
                    </p>
                </div>
            </div>

            <!-- Gallery Cards Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @forelse($latestGalleries as $gallery)
                    <div
                        class="bg-white border border-[#E5E0D8] rounded-md p-2.5 space-y-2 group hover:border-[#0D3B2E] hover:shadow-xs transition">
                        <div class="aspect-4/3 bg-[#FAF8F5] border border-[#E5E0D8] rounded overflow-hidden relative">
                            @if ($gallery->cover_image)
                                <img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="{{ $gallery->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @elseif($gallery->photos->isNotEmpty())
                                <img src="{{ asset('storage/' . $gallery->photos->first()->file_path) }}"
                                    alt="{{ $gallery->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <x-public.image-placeholder :title="$gallery->title" aspect="aspect-4/3" />
                            @endif

                            @if ($gallery->photos->count() > 0)
                                <span
                                    class="absolute bottom-1 right-1 px-1.5 py-0.5 bg-black/70 text-white text-[9px] font-mono rounded">
                                    {{ $gallery->photos->count() }} Foto
                                </span>
                            @endif
                        </div>
                        <h4
                            class="font-sans font-bold text-xs text-[#0D3B2E] group-hover:text-[#059669] transition line-clamp-1">
                            {{ $gallery->title }}
                        </h4>
                    </div>
                @empty
                    <div
                        class="col-span-full bg-white border border-[#E5E0D8] rounded-md p-8 text-center text-xs text-[#4B6358]">
                        Belum ada dokumentasi kegiatan yang diunggah.
                    </div>
                @endforelse
            </div>

            <div class="text-center pt-2">
                <a href="{{ route('gallery.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                    <span>Lihat Lebih Banyak Galeri &rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- 8. CARD INFORMASI PSB -->
    <section class="py-16 md:py-24 bg-white border-b border-[#E5E0D8]" id="informasi-psb">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="max-w-3xl space-y-2">
                <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                    Informasi Biaya & Persyaratan Pendaftaran
                </h2>
                <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    Sistem pendaftaran transparan terintegrasi. Calon wali santri dapat memeriksa alur pendaftaran, jadwal
                    gelombang, dan estimasi biaya secara terbuka.
                </p>
            </div>

            <!-- Two-Column PSB Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <!-- Left: Biaya Registrasi & Syahriyah -->
                <div
                    class="lg:col-span-7 bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 sm:p-8 space-y-6 flex flex-col justify-between">
                    <div class="space-y-6">
                        <div class="border-b border-[#E5E0D8] pb-3 flex items-center justify-between">
                            <span class="editorial-label text-[#0D3B2E]">RINCIAN BIAYA PENDIDIKAN</span>
                            <span class="text-xs font-mono text-[#059669] font-bold">Resmi 2027/2028</span>
                        </div>

                        <!-- MTs Section -->
                        <div class="bg-white border border-[#E5E0D8] rounded-md p-5 space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <h4 class="font-sans font-bold text-base text-[#0D3B2E]">Jenjang MTs (Mukim 24 Jam)</h4>
                                <span
                                    class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Mukim</span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                                <div>
                                    <span class="text-[#4B6358] block">Biaya Registrasi PSB:</span>
                                    <strong class="text-lg font-bold text-[#B89758] font-sans">Rp
                                        {{ $feeMts }}</strong>
                                    <span class="text-[10px] text-gray-400 block">*Sesuai gelombang berjalan</span>
                                </div>
                                <div>
                                    <span class="text-[#4B6358] block">Biaya Bulanan (Syahriyah):</span>
                                    <strong class="text-lg font-bold text-[#0D3B2E] font-sans">Rp 500.000 <span
                                            class="text-xs font-normal text-gray-500">/ bln</span></strong>
                                    <span class="text-[10px] text-gray-400 block">*Termasuk makan 3x sehari, asrama, &
                                        pendidikan</span>
                                </div>
                            </div>
                        </div>

                        <!-- MDTA Section -->
                        <div class="bg-white border border-[#E5E0D8] rounded-md p-5 space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <h4 class="font-sans font-bold text-base text-[#0D3B2E]">Jenjang MDTA (Sekolah Sore)</h4>
                                <span
                                    class="text-[10px] font-mono px-2 py-0.5 rounded bg-amber-100 text-amber-900 font-semibold">Non-Mukim</span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                                <div>
                                    <span class="text-[#4B6358] block">Biaya Registrasi PSB:</span>
                                    <strong class="text-lg font-bold text-[#B89758] font-sans">Rp
                                        {{ $feeMdta }}</strong>
                                    <span class="text-[10px] text-gray-400 block">*Sesuai gelombang berjalan</span>
                                </div>
                                <div>
                                    <span class="text-[#4B6358] block">Biaya Bulanan (Syahriyah):</span>
                                    <strong class="text-lg font-bold text-[#0D3B2E] font-sans">Rp 12.000 <span
                                            class="text-xs font-normal text-gray-500">/ bln</span></strong>
                                    <span class="text-[10px] text-gray-400 block">*Biaya pendidikan sekolah sore tingkat
                                        SD</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="pt-4 border-t border-[#E5E0D8] flex flex-col sm:flex-row items-center justify-between gap-3">
                        <a href="{{ route('psb.status') }}"
                            class="text-xs font-bold text-[#4B6358] hover:text-[#0D3B2E] transition">
                            Sudah Mendaftar? Cek Status &rarr;
                        </a>
                        <a href="{{ route('psb.index') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                            <span>Mulai Pendaftaran Online &rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Right: Syarat Pendaftaran Card -->
                <div
                    class="lg:col-span-5 bg-white border border-[#E5E0D8] rounded-md p-6 sm:p-8 space-y-6 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="border-b border-[#E5E0D8] pb-3">
                            <span class="editorial-label text-[#B89758]">BERKAS PERSYARATAN</span>
                            <h3 class="font-sans font-bold text-xl text-[#0D3B2E] mt-1">
                                5 Dokumen Pendaftaran
                            </h3>
                        </div>

                        <ul class="text-xs space-y-3 text-[#18181B]">
                            <li class="flex items-start gap-3 p-2.5 rounded bg-[#FAF8F5] border border-[#E5E0D8]">
                                <span class="font-mono font-bold text-[#0D3B2E] w-5">01</span>
                                <div>
                                    <strong class="text-[#0D3B2E] block">Fotokopi Akta Kelahiran</strong>
                                    <span class="text-[#4B6358] text-[11px]">Sebagai bukti keabsahan identitas calon santri
                                        baru.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 p-2.5 rounded bg-[#FAF8F5] border border-[#E5E0D8]">
                                <span class="font-mono font-bold text-[#0D3B2E] w-5">02</span>
                                <div>
                                    <strong class="text-[#0D3B2E] block">Fotokopi Kartu Keluarga (KK)</strong>
                                    <span class="text-[#4B6358] text-[11px]">Untuk pencatatan data kependudukan dan wali
                                        santri.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 p-2.5 rounded bg-[#FAF8F5] border border-[#E5E0D8]">
                                <span class="font-mono font-bold text-[#0D3B2E] w-5">03</span>
                                <div>
                                    <strong class="text-[#0D3B2E] block">Fotokopi KTP Orang Tua</strong>
                                    <span class="text-[#4B6358] text-[11px]">KTP ayah dan ibu / wali calon santri.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 p-2.5 rounded bg-[#FAF8F5] border border-[#E5E0D8]">
                                <span class="font-mono font-bold text-[#0D3B2E] w-5">04</span>
                                <div>
                                    <strong class="text-[#0D3B2E] block">Fotokopi Ijazah / SKL</strong>
                                    <span class="text-[#4B6358] text-[11px]">Surat Keterangan Lulus dari sekolah
                                        dasar/madrasah asal.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 p-2.5 rounded bg-[#FAF8F5] border border-[#E5E0D8]">
                                <span class="font-mono font-bold text-[#0D3B2E] w-5">05</span>
                                <div>
                                    <strong class="text-[#0D3B2E] block">Pas Foto 3x4 (2 Lembar)</strong>
                                    <span class="text-[#4B6358] text-[11px]">Foto formal santri berpakaian rapi background
                                        bebas.</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="pt-2">
                        <a href="{{ route('psb.index') }}"
                            class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md bg-[#B89758] hover:bg-[#96783e] text-white font-bold text-xs uppercase tracking-wider transition">
                            <span>Daftar & Unggah Berkas &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. SOSIAL MEDIA SECTION -->
    <section class="py-16 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-[#E5E0D8] rounded-md p-8 md:p-12 space-y-8 shadow-xs">
                <div class="max-w-2xl mx-auto text-center space-y-3">
                    <h2 class="font-sans text-2xl sm:text-3xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Terhubung dengan Kami di Media Sosial
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Ikuti dinamika santri, lantunan murottal Al-Qur'an, dan informasi resmi PPMTQ Daar El Tazkiyah
                        Sumardi melalui kanal <strong>@media_daar_eltazkiyah</strong>.
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-4xl mx-auto">
                    <!-- Instagram -->
                    <a href="https://instagram.com/media_daar_eltazkiyah" target="_blank" rel="noopener noreferrer"
                        class="p-5 border border-[#E5E0D8] rounded-md bg-[#FAF8F5] hover:border-[#0D3B2E] hover:bg-white transition flex flex-col items-center text-center space-y-2 group">
                        <div
                            class="w-10 h-10 rounded-full bg-pink-50 border border-pink-200 flex items-center justify-center text-pink-600 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </div>
                        <span class="font-sans font-bold text-xs text-[#0D3B2E]">Instagram</span>
                        <span class="text-[10px] text-[#4B6358] font-mono">@media_daar_eltazkiyah</span>
                    </a>

                    <!-- TikTok -->
                    <a href="https://tiktok.com/@media_daar_eltazkiyah" target="_blank" rel="noopener noreferrer"
                        class="p-5 border border-[#E5E0D8] rounded-md bg-[#FAF8F5] hover:border-[#0D3B2E] hover:bg-white transition flex flex-col items-center text-center space-y-2 group">
                        <div
                            class="w-10 h-10 rounded-full bg-slate-100 border border-slate-300 flex items-center justify-center text-slate-800 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.16 1.18 2.09 2.35 2.27.7.13 1.43.05 2.09-.22.95-.39 1.64-1.24 1.84-2.24.11-.6.13-1.21.13-1.82.01-4.28 0-8.56 0-12.84z" />
                            </svg>
                        </div>
                        <span class="font-sans font-bold text-xs text-[#0D3B2E]">TikTok</span>
                        <span class="text-[10px] text-[#4B6358] font-mono">@media_daar_eltazkiyah</span>
                    </a>

                    <!-- YouTube -->
                    <a href="https://youtube.com/@media_daar_eltazkiyah" target="_blank" rel="noopener noreferrer"
                        class="p-5 border border-[#E5E0D8] rounded-md bg-[#FAF8F5] hover:border-[#0D3B2E] hover:bg-white transition flex flex-col items-center text-center space-y-2 group">
                        <div
                            class="w-10 h-10 rounded-full bg-red-50 border border-red-200 flex items-center justify-center text-red-600 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </div>
                        <span class="font-sans font-bold text-xs text-[#0D3B2E]">YouTube</span>
                        <span class="text-[10px] text-[#4B6358] font-mono">@media_daar_eltazkiyah</span>
                    </a>

                    <!-- Facebook -->
                    <a href="https://facebook.com/media_daar_eltazkiyah" target="_blank" rel="noopener noreferrer"
                        class="p-5 border border-[#E5E0D8] rounded-md bg-[#FAF8F5] hover:border-[#0D3B2E] hover:bg-white transition flex flex-col items-center text-center space-y-2 group">
                        <div
                            class="w-10 h-10 rounded-full bg-blue-50 border border-blue-200 flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </div>
                        <span class="font-sans font-bold text-xs text-[#0D3B2E]">Facebook</span>
                        <span class="text-[10px] text-[#4B6358] font-mono">media_daar_eltazkiyah</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. CTA SECTION (PENUTUP) -->
    <section class="py-16 md:py-20 bg-[#084C27] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <div class="max-w-2xl mx-auto space-y-3">
                <h2
                    class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    Bersama Al-Qur'an Meraih Masa Depan Gemilang
                </h2>
                <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
                    Daftarkan putra-putri Anda sekarang atau jadwalkan silaturahmi langsung ke pondok pesantren kami di
                    Mekarbaru, Petir, Kabupaten Serang, Banten.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                <a href="{{ route('psb.index') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-md bg-[#D97706] hover:bg-[#b46304] text-white font-bold text-xs uppercase tracking-wider transition shadow-md">
                    <span>Daftar Santri Baru</span>
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waNumber) }}" target="_blank"
                    rel="noopener noreferrer"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-md border border-white/30 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs uppercase tracking-wider transition">
                    <span>Konsultasi WhatsApp</span>
                </a>
            </div>
        </div>
    </section>
@endsection
