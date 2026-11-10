@extends('layouts.public')

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

    <!-- 1. HERO CAROUSEL SECTION -->
    <x-public.hero :activeWave="$activeWave" :featuredPost="$featuredPost" :feeMts="$feeMts" :feeMdta="$feeMdta" />

    <!-- 2. PROGRAM UNGGULAN SECTION -->
    <section id="program-unggulan" class="py-10 md:py-16 bg-white border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 md:space-y-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        PROGRAM UNGGULAN
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Kurikulum terpadu memadukan tahfidzul Qur'an mutqin, kajian khazanah turats Islam, serta keahlian bahasa Arab-Inggris dan kepemimpinan masa depan.
                    </p>
                </div>
                <div class="font-arabic text-base sm:text-lg text-[#084C27] font-semibold" dir="rtl" style="line-height: 1.8;">
                    خَيْرُكُمْ مَنْ تَعَلَّمَ الْقُرْآنَ وَعَلَّمَهُ
                </div>
            </div>

            <!-- 6 Flagship Program Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Tahfidzul Qur'an -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Tahfidzul Qur'an
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Program menghafal Al-Qur'an secara terarah, bertahap, dan mutqin dengan bimbingan asatidz huffadz melalui metode sabaq, sabqi, dan manzil.
                    </p>
                </div>

                <!-- 2. Tahfidz Hadits -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Tahfidz Hadits
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Menghafal dan memahami hadits-hadits pilihan (Arbain Nawawiyah & Riyadhus Shalihin) sebagai pedoman pengamalan sunnah sehari-hari.
                    </p>
                </div>

                <!-- 3. Kajian Kitab Kuning -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Kajian Kitab Kuning
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pendalaman khazanah keilmuan Islam klasik (Turats Salafiyah) meliputi ilmu nahwu, sharaf, fiqih ibadah, tajwid, dan tauhid.
                    </p>
                </div>

                <!-- 4. Bahasa Arab & Inggris -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Bahasa Arab &amp; Inggris
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pembiasaan komunikasi dwibahasa aktif sehari-hari di asrama dan madrasah guna membekali santri bersaing di kancah global.
                    </p>
                </div>

                <!-- 5. Public Speaking -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Public Speaking &amp; Da'wah
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pelatihan dakwah intensif, pidato tiga bahasa (Arab, Inggris, Indonesia), kepemimpinan santri, dan retorika berwibawa di depan umum.
                    </p>
                </div>

                <!-- 6. Pembinaan Akhlak & Kedisiplinan -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Pembinaan Akhlak &amp; Kedisiplinan
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pembentukan karakter santri melalui pembiasaan adab Islami 24 jam, ketertiban shalat berjamaah, kemandirian asrama, dan sopan santun.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. VISI & MISI INSTITUSI -->
    <section class="py-10 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <!-- Left: Visi Quote -->
                <div class="lg:col-span-5 space-y-5">
                    <div class="space-y-1">
                        <div class="font-arabic text-lg sm:text-xl text-[#B89758] font-bold" dir="rtl" style="line-height: 1.8;">
                            بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                        </div>
                        <h2 class="font-sans text-2xl sm:text-3xl font-extrabold text-[#0D3B2E] tracking-tight">
                            VISI &amp; MISI
                        </h2>
                        <div class="border-b border-[#E5E0D8] pb-2 flex items-center justify-between">
                            <span class="editorial-label text-[#059669]">VISI LEMBAGA</span>
                        </div>
                    </div>

                    <div class="bg-white border-l-4 border-[#0D3B2E] rounded-md p-6 space-y-3 shadow-xs">
                        <blockquote class="font-sans text-base sm:text-lg font-bold text-[#0D3B2E] leading-relaxed">
                            "{{ "Melahirkan generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi dan siap mengabdi untuk umat." }}"
                        </blockquote>
                        <div class="pt-2 text-xs font-mono text-[#4B6358]">
                            &bull; DAAR EL TAZKIYAH SUMARDI &bull;
                        </div>
                    </div>
                </div>

                <!-- Right: 4 Misi Cards -->
                <div class="lg:col-span-7 space-y-3" x-data="{ activeMisi: 1 }">
                    <div class="border-b border-[#E5E0D8] pb-2 flex items-center justify-between">
                        <span class="editorial-label text-[#0D3B2E]">4 PILAR MISI PENDIDIKAN</span>
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
                            Membimbing hafalan Al-Qur'an dengan kaidah tahsin, tadabbur makna ayat, dan pembiasaan muraja'ah harian secara disiplin melalui metode sabaq, sabqi, dan manzil.
                        </div>
                    </div>

                    <!-- Misi 2 -->
                    <div class="border border-[#E5E0D8] rounded-md bg-white overflow-hidden transition">
                        <button type="button" @click="activeMisi = (activeMisi === 2 ? 0 : 2)"
                            class="w-full p-4 text-left flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="font-mono text-xs font-bold text-[#B89758]">02</span>
                                <h3 class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E]">
                                    Membentuk akhlak mulia dan disiplin
                                </h3>
                            </div>
                            <span class="text-xs text-[#0D3B2E] transition-transform duration-200"
                                :class="{ 'rotate-180': activeMisi === 2 }">&darr;</span>
                        </button>
                        <div x-show="activeMisi === 2" x-cloak
                            class="px-5 pb-4 pt-1 text-xs text-[#4B6358] border-t border-[#E5E0D8] leading-relaxed bg-[#FAF8F5]">
                            Menegakkan keteladanan adab Islami, disiplin ibadah fardhu &amp; sunnah berjamaah di masjid, serta pembiasaan hidup mandiri dan bertanggung jawab di lingkungan asrama santri.
                        </div>
                    </div>

                    <!-- Misi 3 -->
                    <div class="border border-[#E5E0D8] rounded-md bg-white overflow-hidden transition">
                        <button type="button" @click="activeMisi = (activeMisi === 3 ? 0 : 3)"
                            class="w-full p-4 text-left flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="font-mono text-xs font-bold text-[#B89758]">03</span>
                                <h3 class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E]">
                                    Memberikan pendidikan berkualitas berbasis Islam
                                </h3>
                            </div>
                            <span class="text-xs text-[#0D3B2E] transition-transform duration-200"
                                :class="{ 'rotate-180': activeMisi === 3 }">&darr;</span>
                        </button>
                        <div x-show="activeMisi === 3" x-cloak
                            class="px-5 pb-4 pt-1 text-xs text-[#4B6358] border-t border-[#E5E0D8] leading-relaxed bg-[#FAF8F5]">
                            Menggabungkan kurikulum keagamaan muadalah pesantren dengan standar nasional Kementerian Agama RI serta wawasan sains, teknologi, dan bahasa Arab-Inggris terkini.
                        </div>
                    </div>

                    <!-- Misi 4 -->
                    <div class="border border-[#E5E0D8] rounded-md bg-white overflow-hidden transition">
                        <button type="button" @click="activeMisi = (activeMisi === 4 ? 0 : 4)"
                            class="w-full p-4 text-left flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="font-mono text-xs font-bold text-[#B89758]">04</span>
                                <h3 class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E]">
                                    Mempersiapkan santri berprestasi di tingkat nasional
                                </h3>
                            </div>
                            <span class="text-xs text-[#0D3B2E] transition-transform duration-200"
                                :class="{ 'rotate-180': activeMisi === 4 }">&darr;</span>
                        </button>
                        <div x-show="activeMisi === 4" x-cloak
                            class="px-5 pb-4 pt-1 text-xs text-[#4B6358] border-t border-[#E5E0D8] leading-relaxed bg-[#FAF8F5]">
                            Mengasah potensi santri dalam Musabaqah Hifdzil Qur'an (MHQ), olimpiade sains madrasah, pidato dwibahasa asing, serta kepemimpinan umat untuk masa depan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. SECTION TENTANG KAMI & PROFIL ASATIDZ (WITH NEW ASATIDZ IMAGES) -->
    <section class="py-10 md:py-16 bg-white border-b border-[#E5E0D8]" id="tentang-kami">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 md:space-y-10">

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label text-[#059669]">PENGASUH &amp; DEWAN PENDIDIK</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Tentang Kami &amp; Dewan Pendidik
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Dibina langsung oleh dewan pengajar, asatidz huffadz Al-Qur'an, dan para pendidik berdedikasi membimbing akhlak serta kecerdasan santri.
                    </p>
                </div>
                <a href="{{ route('profile.index') }}#pendidik"
                    class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-md border border-[#E5E0D8] hover:border-[#0D3B2E] bg-[#FAF8F5] text-xs font-bold uppercase tracking-wider text-[#0D3B2E] transition shadow-xs group">
                    <span>Lihat Seluruh Dewan Guru</span>
                    <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                </a>
            </div>

            <!-- Grand Educator Showcase Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-6 sm:p-8 shadow-xs">

                <!-- Left 6 Cols: Dewan Pengajar Transparan with Islamic Green Background -->
                <div class="lg:col-span-6 bg-gradient-to-br from-[#084C27] via-[#0D3B2E] to-[#14532D] rounded-lg p-6 sm:p-8 text-white relative overflow-hidden shadow-inner flex flex-col items-center justify-between min-h-[300px]">
                    <div class="absolute inset-0 opacity-15 bg-[radial-gradient(circle_at_top,#B89758,transparent_70%)] pointer-events-none"></div>

                    <div class="text-center space-y-1 relative z-10">
                        <span class="editorial-label text-amber-300 text-[10px]">DEWAN ASATIDZ PESANTREN</span>
                        <h3 class="font-sans font-extrabold text-xl text-white tracking-tight">
                            Bimbingan Intensif Penuh Kehangatan
                        </h3>
                        <p class="text-xs text-emerald-100/90 max-w-sm mx-auto">
                            Menemani santri dalam halaqah Al-Qur'an, shalat berjamaah, dan pendalaman ilmu agama.
                        </p>
                    </div>

                    <div class="relative z-10 w-full mt-4 flex justify-center">
                        <img src="{{ asset('images/dewan-pengajar-transparan.webp') }}"
                            alt="Dewan Pengajar Daar El Tazkiyah"
                            loading="lazy"
                            class="max-h-56 sm:max-h-64 w-auto object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-300">
                    </div>
                </div>

                <!-- Right 6 Cols: Foto Pengajar Card with Preview -->
                <div class="lg:col-span-6 space-y-4">
                    <div class="border border-[#E5E0D8] rounded-lg overflow-hidden group shadow-xs">
                        <div class="aspect-16/10 relative overflow-hidden bg-gray-100 cursor-pointer"
                             @click="openModal('{{ asset('images/foto-pengajar.webp') }}', 'Foto Dewan Pengajar PPMTQ Daar El Tazkiyah')">
                            <img src="{{ asset('images/foto-pengajar.webp') }}"
                                alt="Dewan Pengajar PPMTQ Daar El Tazkiyah"
                                loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold gap-1.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                <span>Perbesar Foto Asatidz</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-mono font-bold text-[#059669] uppercase">Keteladanan Nyata</span>
                            <span class="text-xs text-[#B89758]">&bull;</span>
                            <span class="text-xs text-[#4B6358]">Serang, Banten</span>
                        </div>
                        <h4 class="font-sans font-bold text-lg text-[#0D3B2E]">Mendidik dengan Hati dan Keteladanan</h4>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Pengasuh dan dewan pendidik berkomitmen menghadirkan kurikulum yang mengedepankan kualitas hafalan Al-Qur'an mutqin, pembiasaan adab mulia santri, dan keharmonisan lingkungan pesantren.
                        </p>
                        @if(isset($teachers) && $teachers->isNotEmpty())
                            <div class="pt-3 border-t border-[#E5E0D8] space-y-2">
                                <span class="text-[11px] font-mono uppercase tracking-wider text-[#059669] font-bold block">Dewan Asatidz &amp; Tenaga Pendidik:</span>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                                    @foreach($teachers->take(4) as $teacher)
                                        <div class="flex items-center gap-2 bg-white p-2 rounded border border-[#E5E0D8]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#059669] shrink-0"></span>
                                            <div class="min-w-0">
                                                <div class="font-bold text-[#0D3B2E] truncate">{{ $teacher->full_name }}</div>
                                                <div class="text-[10px] text-[#4B6358] truncate">{{ $teacher->role_title }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="pt-2">
                            <a href="{{ route('profile.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0D3B2E] hover:text-[#059669] transition">
                                <span>Baca Selayang Pandang &amp; Legalitas Lembaga</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 5. PROGRAM PENDIDIKAN COMPARISON SECTION (MTS & MDTA) -->
    <section id="program" class="py-10 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 md:space-y-10">
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label text-[#059669]">DUA PILIHAN JALUR RESMI</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        PROGRAM PENDIDIKAN
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Dua program pendidikan terstruktur dirancang khusus untuk membina hafalan Al-Qur'an, adab mulia, dan kecerdasan intelektual santri di Serang, Banten.
                    </p>
                </div>
                <a href="{{ route('program.index') }}"
                    class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0D3B2E] hover:text-[#059669] transition uppercase tracking-wider">
                    <span>Lihat Kurikulum Lengkap MDTA &rarr;</span>
                </a>
            </div>

            <!-- 2-Column Program Comparison Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
                <!-- Program 1: MTS (Mukim 24 Jam) -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 sm:p-8 relative flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] transition shadow-xs">
                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center justify-between gap-2 border-b border-[#E5E0D8] pb-2 mb-2">
                                <span class="editorial-label text-[#059669]">PROGRAM UNGGULAN MUKIM</span>
                                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold tracking-wider uppercase bg-[#0D3B2E] text-white">Mukim 24 Jam</span>
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <h3 class="font-sans font-bold text-2xl text-[#0D3B2E]">MTS (Madrasah Tsanawiyah)</h3>
                            </div>
                        </div>

                        <!-- Price Card -->
                        <div class="bg-[#FAF8F5] p-5 border border-[#E5E0D8] rounded-md space-y-2.5">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Bulanan (Syahriyah):</span>
                                <span class="text-2xl font-bold text-[#0D3B2E] font-sans">
                                    Rp 500.000 <span class="text-xs font-normal text-gray-500">/ bln</span>
                                </span>
                            </div>
                            <div class="flex items-baseline justify-between pt-2 border-t border-[#E5E0D8]">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Registrasi Pendaftaran:</span>
                                <span class="text-lg font-bold text-[#B89758] font-sans">
                                    Rp {{ $feeMts }}
                                </span>
                            </div>
                            <p class="text-[11px] text-[#059669] leading-tight">
                                *Sudah mencakup pendidikan asrama dan konsumsi makan 3x sehari. Santri membawa alat mencuci mandiri.
                            </p>
                        </div>

                        <!-- Features -->
                        <div class="space-y-2">
                            <div class="text-xs font-bold text-[#0D3B2E] uppercase tracking-wider">Fasilitas &amp; Kurikulum:</div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Asrama mukim 24 jam dengan bimbingan asatidz intensif</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Konsumsi makan 3 kali sehari dengan menu bergizi higienis</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Ijazah formal Madrasah Tsanawiyah (Kementerian Agama RI)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Tahfidzul Qur'an mutqin &amp; kajian kitab kuning</span>
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
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 sm:p-8 relative flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] transition shadow-xs">
                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center justify-between gap-2 border-b border-[#E5E0D8] pb-2 mb-2">
                                <span class="editorial-label text-[#B89758]">PROGRAM SEKOLAH SORE</span>
                                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold tracking-wider uppercase bg-[#B89758] text-white">Non-Mukim</span>
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <h3 class="font-sans font-bold text-2xl text-[#0D3B2E]">MDTA (Madrasah Diniyah Takmiliyah Awaliyah)</h3>
                            </div>
                            <div class="text-xs font-mono text-[#059669] font-bold mt-1">MDT Ula DAAR EL TAZKIYAH SUMARDI (Tingkat Ula)</div>
                        </div>

                        <!-- Price Card -->
                        <div class="bg-[#FAF8F5] p-5 border border-[#E5E0D8] rounded-md space-y-2.5">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Bulanan (Syahriyah):</span>
                                <span class="text-2xl font-bold text-[#0D3B2E] font-sans">
                                    Rp 12.000 <span class="text-xs font-normal text-gray-500">/ bln</span>
                                </span>
                            </div>
                            <div class="flex items-baseline justify-between pt-2 border-t border-[#E5E0D8]">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Registrasi Pendaftaran:</span>
                                <span class="text-lg font-bold text-[#B89758] font-sans">
                                    Rp {{ $feeMdta }}
                                </span>
                            </div>
                            <p class="text-[11px] text-[#4B6358]/80 italic">
                                *Izin Operasional Resmi Kemenag Kab. Serang No. 0355 (NSMDT: 311236041251).
                            </p>
                        </div>

                        <!-- Features -->
                        <div class="space-y-2">
                            <div class="text-xs font-bold text-[#0D3B2E] uppercase tracking-wider">Materi &amp; Jadwal Belajar MDTA:</div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Jadwal sekolah sore hari ba'da Ashar &amp; Dhuhur: Senin s/d Kamis (Pukul 13.30 – 16.10 WIB)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Tahfidzul Qur'an setiap Senin dengan target berjenjang Kelas 1-3</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Materi Diniyah: Aqidah, Bahasa Arab, Hadist, Akhlak, Fiqh, &amp; SKI</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Pengembangan Seni bergilir: Hadroh, Senam, Kaligrafi, Drama, &amp; Alam</span>
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

    <!-- 6. SECTION KEHIDUPAN SANTRI & DOKUMENTASI (WITH SANTRI IMAGES) -->
    <section class="py-10 md:py-16 bg-white border-b border-[#E5E0D8]" id="kehidupan-santri">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 md:space-y-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label text-[#059669]">DINAMIKA SANTRI</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Potret Rutinitas &amp; Kehidupan Santri
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Dokumentasi nyata kegiatan belajar mengajar, lantunan hafalan Al-Qur'an, dan pembiasaan adab mulia santri putra &amp; putri.
                    </p>
                </div>
                <a href="{{ route('gallery.index') }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-md border border-[#E5E0D8] hover:border-[#0D3B2E] bg-white text-xs font-bold uppercase tracking-wider text-[#0D3B2E] transition shadow-xs group">
                    <span>Buka Galeri Foto Lengkap</span>
                    <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                </a>
            </div>

            @if(isset($latestGalleries) && $latestGalleries->isEmpty())
                <div class="col-span-full text-center py-12 text-[#4B6358] bg-[#FAF8F5] rounded-md border border-[#E5E0D8] p-8">
                    Belum ada dokumentasi kegiatan yang diunggah.
                </div>
            @endif

            <!-- Santri 3-Card Grid with Real Photos & Lightbox -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Foto Santri 1 -->
                <div class="border border-[#E5E0D8] rounded-xl overflow-hidden bg-[#FAF8F5] shadow-xs group">
                    <div class="aspect-16/10 relative overflow-hidden bg-gray-100 cursor-pointer"
                         @click="openModal('{{ asset('images/foto-santri-1.webp') }}', 'Kebersamaan Santri Daar El Tazkiyah Sumardi')">
                        <img src="{{ asset('images/foto-santri-1.webp') }}"
                            alt="Santri Daar El Tazkiyah Sumardi"
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold gap-1.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            <span>Klik untuk Memperbesar</span>
                        </div>
                    </div>
                    <div class="p-5 space-y-1.5">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-[#059669] font-bold">DISIPLIN &amp; UKHUWAH</span>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Kebersamaan Santri Putra &amp; Putri</h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Membangun ikatan persaudaraan yang erat atas dasar kecintaan kepada Al-Qur'an dan saling menasihati dalam kebaikan.
                        </p>
                    </div>
                </div>

                <!-- Foto Santri 2 -->
                <div class="border border-[#E5E0D8] rounded-xl overflow-hidden bg-[#FAF8F5] shadow-xs group">
                    <div class="aspect-16/10 relative overflow-hidden bg-gray-100 cursor-pointer"
                         @click="openModal('{{ asset('images/foto-santri-2.webp') }}', 'Aktivitas Belajar dan Mengaji Santri')">
                        <img src="{{ asset('images/foto-santri-2.webp') }}"
                            alt="Aktivitas Santri Daar El Tazkiyah"
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold gap-1.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            <span>Klik untuk Memperbesar</span>
                        </div>
                    </div>
                    <div class="p-5 space-y-1.5">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-[#B89758] font-bold">HALAQAH TAHFIDZ</span>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Lantunan Ziyadah &amp; Murojaah</h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Setiap hari diisi dengan setoran ayat Al-Qur'an dan bimbingan tahsin makhraj bersama asatidz pengampu halaqah.
                        </p>
                    </div>
                </div>

                <!-- Foto Santri 3 -->
                <div class="border border-[#E5E0D8] rounded-xl overflow-hidden bg-[#FAF8F5] shadow-xs group">
                    <div class="aspect-16/10 relative overflow-hidden bg-gray-100 cursor-pointer"
                         @click="openModal('{{ asset('images/foto-santri-3.webp') }}', 'Keceriaan dan Semangat Prestasi Santri')">
                        <img src="{{ asset('images/foto-santri-3.webp') }}"
                            alt="Prestasi Santri Daar El Tazkiyah"
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold gap-1.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            <span>Klik untuk Memperbesar</span>
                        </div>
                    </div>
                    <div class="p-5 space-y-1.5">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-[#0D3B2E] font-bold">KEMANDIRIAN &amp; SENI</span>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Keceriaan Belajar &amp; Berbakat</h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Mengasah potensi non-akademik melalui ekstrakurikuler hadroh, kaligrafi, pencak silat, senam, dan eksplorasi tadabbur alam.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 7. GRID BERITA (FEATURED) -->
    <section class="py-10 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 md:space-y-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label text-[#059669]">WARTA &amp; KABAR TERKINI</span>
                    <div class="font-arabic text-sm sm:text-base text-[#084C27] font-semibold" dir="rtl" style="line-height: 1.8;">
                        اقْرَأْ وَارْتَقِ وَرَتِّلْ كَمَا كُنْتَ تُرَتِّلُ فِي الدُّنْيَا
                    </div>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Warta Pesantren &amp; Agenda Kegiatan
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
                        class="bg-white border border-[#E5E0D8] rounded-md overflow-hidden flex flex-col justify-between hover:border-[#0D3B2E] hover:shadow-md transition group">
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
                        class="col-span-full bg-white border border-[#E5E0D8] rounded-md p-8 text-center text-xs text-[#4B6358]">
                        Belum ada warta berita yang dipublikasikan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 8. HIGHLIGHT INFORMASI BIAYA PSB (T.A 2027/2028) -->
    <section class="py-10 md:py-16 bg-white border-b border-[#E5E0D8]" id="informasi-psb">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 md:space-y-10">

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="max-w-3xl space-y-2">
                    <span class="editorial-label text-[#059669]">PENERIMAAN SANTRI BARU (PSB)</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Informasi Biaya &amp; Persyaratan Pendaftaran
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Tingkat SLTP/SMP Sederajat (MTs Mukim 24 Jam) transparan dan terjangkau untuk putra &amp; putri.
                    </p>
                </div>
                <a href="{{ route('psb.index') }}#tabel-biaya"
                    class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-md bg-[#0D3B2E] text-white text-xs font-bold uppercase tracking-wider hover:bg-[#059669] transition shadow-xs">
                    <span>Lihat Tabel Lengkap 12 Biaya &rarr;</span>
                </a>
            </div>

            <!-- Two-Column PSB Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <!-- Left: Biaya Registrasi & Syahriyah -->
                <div class="lg:col-span-7 bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 sm:p-8 space-y-6 flex flex-col justify-between">
                    <div class="space-y-6">
                        <div class="border-b border-[#E5E0D8] pb-3 flex items-center justify-between">
                            <span class="editorial-label text-[#0D3B2E]">TOTAL ESTIMASI BIAYA MASUK</span>
                            <span class="text-xs font-mono text-[#059669] font-bold">SLTP / SMP Sederajat</span>
                        </div>

                        <!-- 2-Box Summary for Putra & Putri -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="bg-white border-2 border-emerald-600/30 rounded-lg p-5 space-y-2">
                                <span class="text-[10px] font-mono uppercase tracking-wider text-[#4B6358] block">Santri Laki-Laki</span>
                                <div class="font-sans font-extrabold text-2xl text-[#0D3B2E]">
                                    Rp 3.250.000
                                </div>
                                <p class="text-[11px] text-[#4B6358] leading-tight">
                                    Total 11 komponen (Pendaftaran, Ujian, Seragam Olahraga &amp; Muslim, Kasur, Lemari, Kitab, Organisasi, Ekskul, Wakaf, &amp; Iuran Bulan 1).
                                </p>
                            </div>

                            <div class="bg-white border-2 border-amber-600/30 rounded-lg p-5 space-y-2">
                                <span class="text-[10px] font-mono uppercase tracking-wider text-[#4B6358] block">Santri Perempuan</span>
                                <div class="font-sans font-extrabold text-2xl text-[#0D3B2E]">
                                    Rp 3.350.000
                                </div>
                                <p class="text-[11px] text-[#4B6358] leading-tight">
                                    Total 12 komponen (Termasuk tambahan 1 set kerudung hitam + putih khusus santri putri).
                                </p>
                            </div>
                        </div>

                        <!-- Iuran Bulanan Note -->
                        <div class="bg-white border border-[#E5E0D8] rounded-md p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div>
                                <span class="text-xs text-[#4B6358] block">Iuran Bulanan (Syahriyah MTs):</span>
                                <strong class="text-lg font-bold text-[#0D3B2E] font-sans">Rp 500.000 <span class="text-xs font-normal text-gray-500">/ bulan</span></strong>
                            </div>
                            <div class="text-xs text-[#059669] font-semibold sm:text-right">
                                &check; Sudah termasuk biaya pendidikan &amp; makan 3x sehari
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#E5E0D8] flex flex-col sm:flex-row items-center justify-between gap-3">
                        <a href="{{ route('psb.status') }}"
                            class="text-xs font-bold text-[#4B6358] hover:text-[#0D3B2E] transition">
                            Sudah Mendaftar? Cek Status &rarr;
                        </a>
                        <a href="{{ route('psb.index') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                            <span>Buka Formulir Pendaftaran Online &rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Right: Berkas & Perlengkapan Quick Summary -->
                <div class="lg:col-span-5 bg-white border border-[#E5E0D8] rounded-md p-6 sm:p-8 space-y-6 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="border-b border-[#E5E0D8] pb-3">
                            <span class="editorial-label text-[#B89758]">DOKUMEN &amp; PERLENGKAPAN</span>
                            <h3 class="font-sans font-bold text-xl text-[#0D3B2E] mt-1">
                                Persyaratan Santri Baru
                            </h3>
                        </div>

                        <ul class="text-xs space-y-2.5 text-[#18181B]">
                            <li class="flex items-start gap-2.5 p-2 rounded bg-[#FAF8F5] border border-[#E5E0D8]">
                                <span class="font-mono font-bold text-[#0D3B2E]">01</span>
                                <span>Fotokopi Akta Kelahiran Calon Santri</span>
                            </li>
                            <li class="flex items-start gap-2.5 p-2 rounded bg-[#FAF8F5] border border-[#E5E0D8]">
                                <span class="font-mono font-bold text-[#0D3B2E]">02</span>
                                <span>Fotokopi Kartu Keluarga (KK) &amp; KTP Orang Tua</span>
                            </li>
                            <li class="flex items-start gap-2.5 p-2 rounded bg-[#FAF8F5] border border-[#E5E0D8]">
                                <span class="font-mono font-bold text-[#0D3B2E]">03</span>
                                <span>Fotokopi Ijazah / SKL SD/MI</span>
                            </li>
                            <li class="flex items-start gap-2.5 p-2 rounded bg-[#FAF8F5] border border-[#E5E0D8]">
                                <span class="font-mono font-bold text-[#0D3B2E]">04</span>
                                <span>Pas Foto Formal 3x4 (2 Lembar)</span>
                            </li>
                            <li class="flex items-start gap-2.5 p-2 rounded bg-[#FAF8F5] border border-[#E5E0D8]">
                                <span class="font-mono font-bold text-[#0D3B2E]">05</span>
                                <span>Perlengkapan Pribadi (Seragam, Sholat, Makan &amp; Mandi)</span>
                            </li>
                        </ul>
                    </div>

                    <div class="pt-2">
                        <a href="{{ route('psb.index') }}#perlengkapan-santri"
                            class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md bg-[#B89758] hover:bg-[#96783e] text-white font-bold text-xs uppercase tracking-wider transition">
                            <span>Lihat Daftar Perlengkapan Santri &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. SOSIAL MEDIA SECTION -->
    <section class="py-10 md:py-14 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-[#E5E0D8] rounded-md p-8 md:p-12 space-y-8 shadow-xs">
                <div class="max-w-2xl mx-auto text-center space-y-3">
                    <span class="editorial-label text-[#059669]">KONTEN &amp; MEDIA RESMI</span>
                    <h2 class="font-sans text-2xl sm:text-3xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Terhubung dengan Kami di Media Sosial
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Ikuti dinamika santri, lantunan murottal Al-Qur'an, dan informasi resmi PPMTQ Daar El Tazkiyah Sumardi melalui kanal <strong>@media_daar_eltazkiyah</strong>.
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-4xl mx-auto">
                    <!-- Instagram -->
                    <a href="https://instagram.com/media_daar_eltazkiyah" target="_blank" rel="noopener noreferrer"
                        class="p-5 border border-[#E5E0D8] rounded-md bg-[#FAF8F5] hover:border-[#0D3B2E] hover:bg-white transition flex flex-col items-center text-center space-y-2 group">
                        <div class="w-10 h-10 rounded-full bg-pink-50 border border-pink-200 flex items-center justify-center text-pink-600 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </div>
                        <span class="font-sans font-bold text-xs text-[#0D3B2E]">Instagram</span>
                        <span class="text-[10px] text-[#4B6358] font-mono">@media_daar_eltazkiyah</span>
                    </a>

                    <!-- TikTok -->
                    <a href="https://tiktok.com/@media_daar_eltazkiyah" target="_blank" rel="noopener noreferrer"
                        class="p-5 border border-[#E5E0D8] rounded-md bg-[#FAF8F5] hover:border-[#0D3B2E] hover:bg-white transition flex flex-col items-center text-center space-y-2 group">
                        <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-300 flex items-center justify-center text-slate-800 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.16 1.18 2.09 2.35 2.27.7.13 1.43.05 2.09-.22.95-.39 1.64-1.24 1.84-2.24.11-.6.13-1.21.13-1.82.01-4.28 0-8.56 0-12.84z"/></svg>
                        </div>
                        <span class="font-sans font-bold text-xs text-[#0D3B2E]">TikTok</span>
                        <span class="text-[10px] text-[#4B6358] font-mono">@media_daar_eltazkiyah</span>
                    </a>

                    <!-- Facebook -->
                    <a href="https://facebook.com/media_daar_eltazkiyah" target="_blank" rel="noopener noreferrer"
                        class="p-5 border border-[#E5E0D8] rounded-md bg-[#FAF8F5] hover:border-[#0D3B2E] hover:bg-white transition flex flex-col items-center text-center space-y-2 group">
                        <div class="w-10 h-10 rounded-full bg-blue-50 border border-blue-200 flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </div>
                        <span class="font-sans font-bold text-xs text-[#0D3B2E]">Facebook</span>
                        <span class="text-[10px] text-[#4B6358] font-mono">media_daar_eltazkiyah</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. CTA SECTION (PENUTUP) -->
    <section class="py-10 md:py-16 bg-[#084C27] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <div class="max-w-2xl mx-auto space-y-3">
                <span class="editorial-label text-amber-300">PENDAFTARAN &amp; SILATURAHMI</span>
                <h2 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    Bersama Al-Qur'an Meraih Ridha Allah &amp; Masa Depan Gemilang
                </h2>
                <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
                    Daftarkan putra-putri Anda sekarang atau jadwalkan silaturahmi langsung ke pondok pesantren kami di Kp. Lembur Sawah, Mekar Baru, Petir, Kabupaten Serang, Banten.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                <a href="{{ route('psb.index') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-md bg-[#D97706] hover:bg-[#b46304] text-white font-bold text-xs uppercase tracking-wider transition shadow-md">
                    <span>Daftar Santri Baru (Online)</span>
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waNumber) }}" target="_blank"
                    rel="noopener noreferrer"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-md border border-white/30 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs uppercase tracking-wider transition">
                    <span>Konsultasi WhatsApp</span>
                </a>
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
