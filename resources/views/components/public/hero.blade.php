@props([
    'activeWave' => null,
    'featuredPost' => null,
    'feeMts' => '100.000',
    'feeMdta' => '25.000',
])

<section
    class="relative bg-[#FAF8F5] pt-6 pb-10 sm:pt-10 sm:pb-14 md:pt-12 md:pb-16 border-b border-[#E5E0D8] overflow-hidden"
    x-data="{
        currentSlide: 1,
        totalSlides: 3,
        autoplayTimer: null,
        isPaused: false,
        touchStartX: 0,
        touchEndX: 0,
        next() {
            this.currentSlide = this.currentSlide === this.totalSlides ? 1 : this.currentSlide + 1;
        },
        prev() {
            this.currentSlide = this.currentSlide === 1 ? this.totalSlides : this.currentSlide - 1;
        },
        goTo(slide) {
            this.currentSlide = slide;
            this.resetAutoplay();
        },
        startAutoplay() {
            this.autoplayTimer = setInterval(() => {
                if (!this.isPaused) {
                    this.next();
                }
            }, 7000);
        },
        stopAutoplay() {
            if (this.autoplayTimer) {
                clearInterval(this.autoplayTimer);
                this.autoplayTimer = null;
            }
        },
        resetAutoplay() {
            this.stopAutoplay();
            this.startAutoplay();
        },
        handleTouchStart(e) {
            this.touchStartX = e.changedTouches[0].screenX;
        },
        handleTouchEnd(e) {
            this.touchEndX = e.changedTouches[0].screenX;
            if (this.touchStartX - this.touchEndX > 50) {
                this.next();
                this.resetAutoplay();
            } else if (this.touchEndX - this.touchStartX > 50) {
                this.prev();
                this.resetAutoplay();
            }
        }
    }" x-init="startAutoplay()" @mouseenter="isPaused = true" @mouseleave="isPaused = false"
    @touchstart.passive="handleTouchStart($event)" @touchend.passive="handleTouchEnd($event)"
    @keydown.arrow-right.window="next()" @keydown.arrow-left.window="prev()">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Slides Equal-Height Stack Container (Single Grid Cell) -->
        <div class="relative grid grid-cols-1 grid-rows-1 items-stretch">

            <!-- Slide 1: Hero Pesantren & Tagline -->
            <div class="col-start-1 row-start-1 w-full h-full flex flex-col justify-between transition-all duration-300 ease-in-out opacity-100 visible z-10 pointer-events-auto transform-none"
                :class="currentSlide === 1 ? 'opacity-100 visible z-10 pointer-events-auto transform-none' :
                    'opacity-0 invisible z-0 pointer-events-none translate-x-4'"
                :aria-hidden="currentSlide !== 1 ? 'true' : 'false'">

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 items-center h-full">
                    <!-- Left: Headline & Tagline -->
                    <div class="md:col-span-7 flex flex-col justify-between space-y-4 text-left">
                        <div class="space-y-1">
                            <p class="font-arabic text-xl sm:text-2xl lg:text-3xl text-[#B89758] font-bold"
                                dir="rtl" style="line-height: 1.8;">
                                بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                            </p>
                            <div class="flex items-center gap-2 pt-0.5">
                                <span class="editorial-label text-[10px] sm:text-xs">01 / 03 — IDENTITAS
                                    PESANTREN</span>
                                <span class="w-6 sm:w-8 h-px bg-[#B89758]"></span>
                                <span class="text-[11px] sm:text-xs font-arabic text-[#084C27] font-semibold truncate"
                                    dir="rtl">
                                    معهد دار التزكية سوماردي الإسلامي لتحفيظ القرآن
                                </span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div
                                class="inline-block px-2.5 py-0.5 sm:px-3 sm:py-1 rounded bg-amber-100/80 border border-amber-300/60 text-amber-900 text-[11px] sm:text-xs font-semibold tracking-wide">
                                Tagline: "Bersama Al-Qur'an Meraih Masa Depan Gemilang."
                            </div>
                            <h1
                                class="font-sans text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#0D3B2E] tracking-tight leading-[1.15]">
                                Pondok Pesantren Modern Tahfidzul Quran <br class="hidden sm:block" />
                                <span class="text-[#059669]">Daar El Tazkiyah Sumardi</span>
                            </h1>
                        </div>

                        <p class="text-xs sm:text-sm md:text-base text-[#4B6358] max-w-2xl leading-relaxed font-sans">
                            Melahirkan generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi, dan siap mengabdi
                            untuk umat. Memadukan kurikulum pendidikan formal dan kepesantrenan di Kabupaten Serang,
                            Banten.
                        </p>

                        <!-- Mobile Status Callout -->
                        <div
                            class="md:hidden flex items-center justify-between p-3 bg-emerald-50/80 border border-emerald-200/60 rounded-md text-xs">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-[#059669] animate-pulse"></span>
                                <span class="font-semibold text-[#0D3B2E]">PSB TA
                                    {{ $activeWave?->academic_year ?? '2027/2028' }}</span>
                            </div>
                            <span
                                class="text-[#059669] font-medium text-[11px]">{{ $activeWave?->name ?? 'Gelombang I Aktif' }}</span>
                        </div>

                        <!-- Pengasuh Citation -->
                        <div
                            class="border-l-2 border-[#B89758] rounded-r-md pl-3.5 py-2 text-xs sm:text-sm text-[#18181B] italic bg-white/80 max-w-xl shadow-xs">
                            "Menghafal Al-Qur'an adalah perjalanan penyucian jiwa (tazkiyah), menyandingkan adab di atas
                            ilmu, dan melatih kemandirian santri untuk peradaban Islam."
                            <span class="block text-[11px] font-sans font-semibold text-[#084C27] mt-1 not-italic">
                                — Ust. Ahmad Ashil Fadhil, S.H., M.H. (Pengasuh Pondok)
                            </span>
                        </div>

                        <!-- Action CTAs -->
                        <div class="pt-1 flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 sm:gap-3">
                            <a href="{{ route('psb.index') }}"
                                class="inline-flex items-center justify-center gap-2 px-5 sm:px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition group border border-[#0D3B2E] shadow-xs">
                                <span>Daftar PSB Online</span>
                                <span class="group-hover:translate-x-1 transition-transform"
                                    aria-hidden="true">&rarr;</span>
                            </a>
                            <a href="{{ route('profile.index') }}"
                                class="inline-flex items-center justify-center px-4 sm:px-5 py-3 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider transition shadow-xs">
                                Jelajahi Profil
                            </a>
                            <a href="{{ route('psb.status') }}"
                                class="inline-flex items-center justify-center px-3 py-3 rounded-md border border-transparent text-[#4B6358] hover:text-[#0D3B2E] text-xs font-semibold uppercase tracking-wider transition">
                                Cek Status &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- Right Visual: Arch Frame Pengasuh (Tablet & Desktop) -->
                    <div class="hidden md:flex md:col-span-5 flex-col items-center">
                        <div class="relative w-full max-w-sm lg:max-w-md">
                            <div
                                class="relative bg-white p-3 border-gold-hairline rounded-arch shadow-md pattern-kufic">
                                <div
                                    class="w-full h-64 lg:h-80 rounded-arch overflow-hidden bg-gradient-to-b from-[#084C27] to-[#042816] relative flex flex-col justify-end border border-gold-hairline/60">
                                    @if (file_exists(public_path('images/pengasuh daar el tazkiyah.webp')))
                                        <img src="{{ asset('images/pengasuh daar el tazkiyah.webp') }}"
                                            alt="Ust. Ahmad Ashil Fadhil, S.H., M.H."
                                            class="absolute inset-0 w-full h-full object-cover object-top">
                                    @else
                                        <!-- Islamic Calligraphy / Motif Fallback -->
                                        <div
                                            class="absolute inset-0 flex flex-col items-center justify-center text-white/20 pb-12 pointer-events-none">
                                            <img src="{{ asset('images/logo_daar_el_tazkiyah.svg') }}" alt="Logo"
                                                width="96" height="96" style="max-width: 96px; max-height: 96px;"
                                                class="w-20 lg:w-24 h-20 lg:h-24 object-contain opacity-25"
                                                onerror="this.onerror=null; this.src='{{ asset('images/logo_daar_el_tazkiyah.png') }}';">
                                            <span class="font-arabic text-xs lg:text-sm text-amber-200/50 mt-2"
                                                dir="rtl">فضيلة الشيخ Pengasuh</span>
                                        </div>
                                    @endif

                                    <!-- Overlay Caption -->
                                    <div
                                        class="relative z-10 bg-gradient-to-t from-[#084C27] via-[#084C27]/95 to-transparent p-4 text-center text-white">
                                        <span
                                            class="editorial-label text-amber-300 block text-[9px] lg:text-[10px]">PIMPINAN
                                            & PENGASUH PESANTREN</span>
                                        <h3
                                            class="font-sans font-bold text-base lg:text-lg text-white tracking-tight mt-0.5">
                                            Ust. Ahmad Ashil Fadhil, S.H., M.H.
                                        </h3>
                                        <p class="text-[11px] text-emerald-100/90 font-medium">
                                            Magister Hukum & Alumni Keilmuan Syariah
                                        </p>
                                        <div class="text-[10px] text-amber-300/80 mt-0.5 font-arabic" dir="rtl">
                                            حفظه الله تعالى ورعاه
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Real-time Status Card -->
                            <div class="mt-3 bg-white border border-[#E5E0D8] rounded-md p-3 text-xs shadow-xs">
                                <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-1.5 mb-1.5">
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-[#059669] animate-pulse"></span>
                                        <span class="editorial-label text-[#0D3B2E] text-[10px]">PENDAFTARAN
                                            AKTIF</span>
                                    </div>
                                    <span class="text-[11px] font-mono text-[#059669] font-bold">
                                        TA {{ $activeWave?->academic_year ?? '2027/2028' }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between text-xs text-[#18181B]">
                                    <div>
                                        <span class="text-[#4B6358] block text-[11px]">Gelombang:</span>
                                        <strong class="text-[#0D3B2E] text-xs">{{ $activeWave?->name ?? 'Gelombang I' }}
                                            (1 Okt 2026 – 28 Feb 2027)</strong>
                                    </div>
                                    <a href="{{ route('psb.index') }}"
                                        class="inline-flex items-center gap-1 text-[#059669] hover:text-[#0D3B2E] font-semibold text-xs transition">
                                        <span>Daftar</span>
                                        <span aria-hidden="true">&rarr;</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Informasi PSB 2027/2028 -->
            <div class="col-start-1 row-start-1 w-full h-full flex flex-col justify-between transition-all duration-300 ease-in-out opacity-0 invisible z-0 pointer-events-none translate-x-4"
                :class="currentSlide === 2 ? 'opacity-100 visible z-10 pointer-events-auto transform-none' :
                    'opacity-0 invisible z-0 pointer-events-none translate-x-4'"
                :aria-hidden="currentSlide !== 2 ? 'true' : 'false'">

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 items-center h-full">
                    <!-- Left: PSB Details -->
                    <div class="md:col-span-7 flex flex-col justify-between space-y-4 text-left">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="editorial-label text-[10px] sm:text-xs text-[#059669]">02 / 03 — PENERIMAAN
                                    SANTRI BARU (PSB)</span>
                                <span
                                    class="px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] text-[10px] font-bold uppercase tracking-wider">
                                    TA {{ $activeWave?->academic_year ?? '2027/2028' }}
                                </span>
                                <span class="text-xs text-[#B89758] font-semibold">Telah Dibuka</span>
                            </div>
                            <div class="font-arabic text-xs sm:text-sm text-[#084C27] font-semibold pt-0.5"
                                dir="rtl" style="line-height: 1.8;">
                                خَيْرُكُمْ مَنْ تَعَلَّمَ الْقُرْآنَ وَعَلَّمَهُ
                            </div>
                        </div>

                        <h2
                            class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight leading-tight">
                            Penerimaan Santri Baru <br />
                            <span class="text-[#059669]">MTs Mukim & MDTA Sore</span>
                        </h2>

                        <p class="text-xs sm:text-sm md:text-base text-[#4B6358] max-w-2xl leading-relaxed">
                            PPMTQ Daar El Tazkiyah Sumardi membuka kesempatan bagi putra-putri untuk menimba ilmu
                            Al-Qur'an, adab mulia, dan sains terpadu dengan biaya terjangkau serta fasilitas asrama
                            mukim yang nyaman di Serang, Banten.
                        </p>

                        <!-- Fast Fee Comparison Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-0.5 max-w-xl">
                            <!-- MTs Card -->
                            <div class="bg-white border-2 border-[#0D3B2E]/20 rounded-md p-3.5 space-y-1 shadow-xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-sans font-bold text-xs sm:text-sm text-[#0D3B2E]">Jenjang MTs
                                        (Mukim)</span>
                                    <span
                                        class="text-[9px] sm:text-[10px] font-mono uppercase bg-[#0D3B2E] text-white px-2 py-0.5 rounded">24
                                        Jam</span>
                                </div>
                                <div class="text-[11px] text-[#4B6358]">Biaya Syahriyah:</div>
                                <div class="text-lg sm:text-xl font-extrabold text-[#0D3B2E] font-sans">
                                    Rp 500.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                                </div>
                                <p class="text-[10px] sm:text-[11px] text-[#059669] font-medium leading-tight">
                                    Sudah termasuk makan 3x sehari, asrama, & pendidikan.
                                </p>
                            </div>

                            <!-- MDTA Card -->
                            <div class="bg-white border border-[#E5E0D8] rounded-md p-3.5 space-y-1 shadow-xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-sans font-bold text-xs sm:text-sm text-[#0D3B2E]">Jenjang
                                        MDTA</span>
                                    <span
                                        class="text-[9px] sm:text-[10px] font-mono uppercase bg-[#B89758] text-white px-2 py-0.5 rounded">Non-Mukim</span>
                                </div>
                                <div class="text-[11px] text-[#4B6358]">Biaya Syahriyah:</div>
                                <div class="text-lg sm:text-xl font-extrabold text-[#0D3B2E] font-sans">
                                    Rp 12.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                                </div>
                                <p class="text-[10px] sm:text-[11px] text-[#4B6358] font-medium leading-tight">
                                    Sekolah sore tingkat SD (Pendidikan diniyah & tahsin).
                                </p>
                            </div>
                        </div>

                        <!-- Mobile Wave Note -->
                        <div
                            class="md:hidden flex items-center justify-between p-2.5 bg-amber-50/80 border border-amber-200/60 rounded-md text-[11px]">
                            <span class="text-[#0D3B2E] font-medium">Registrasi: MTs Rp {{ $feeMts }} | MDTA Rp
                                {{ $feeMdta }}</span>
                            <span class="text-[#B89758] font-bold">Gel. I Aktif</span>
                        </div>

                        <!-- Action CTAs -->
                        <div class="pt-1 flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 sm:gap-3">
                            <a href="{{ route('psb.index') }}"
                                class="inline-flex items-center justify-center gap-2 px-5 sm:px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition group border border-[#0D3B2E] shadow-xs">
                                <span>Isi Formulir PSB Online</span>
                                <span class="group-hover:translate-x-1 transition-transform"
                                    aria-hidden="true">&rarr;</span>
                            </a>
                            <a href="{{ route('program.index') }}#program-pendidikan"
                                class="inline-flex items-center justify-center px-4 sm:px-5 py-3 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider transition shadow-xs">
                                Lihat Rincian Program
                            </a>
                        </div>
                    </div>

                    <!-- Right Visual: Waves Breakdown Card (Tablet & Desktop) -->
                    <div class="hidden md:block md:col-span-5">
                        <div class="bg-white border border-[#E5E0D8] rounded-md p-5 space-y-3.5 shadow-md">
                            <div class="border-b border-[#E5E0D8] pb-2.5 flex items-center justify-between">
                                <span class="editorial-label text-[#0D3B2E] text-[10px]">JADWAL & BIAYA REGISTRASI
                                    PSB</span>
                                <span class="text-xs font-mono text-[#059669] font-bold">2027/2028</span>
                            </div>

                            <!-- Wave 1 -->
                            <div class="p-3.5 rounded-md bg-[#FAF8F5] border-l-4 border-[#059669] space-y-1.5">
                                <div class="flex items-center justify-between">
                                    <h4 class="font-sans font-bold text-xs sm:text-sm text-[#0D3B2E]">Gelombang I
                                        (Sedang Aktif)</h4>
                                    <span class="text-[10px] font-mono text-[#059669] font-semibold">1 Okt 2026 – 28
                                        Feb 2027</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-xs pt-0.5">
                                    <div>
                                        <span class="text-[#4B6358] block text-[10px]">Registrasi MTs:</span>
                                        <strong class="text-[#0D3B2E] font-sans text-xs sm:text-sm">Rp
                                            {{ $feeMts }},-</strong>
                                    </div>
                                    <div>
                                        <span class="text-[#4B6358] block text-[10px]">Registrasi MDTA:</span>
                                        <strong class="text-[#0D3B2E] font-sans text-xs sm:text-sm">Rp
                                            {{ $feeMdta }},-</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Wave 2 -->
                            <div class="p-3.5 rounded-md bg-[#FAF8F5] border-l-4 border-[#B89758] space-y-1.5">
                                <div class="flex items-center justify-between">
                                    <h4 class="font-sans font-bold text-xs sm:text-sm text-[#0D3B2E]">Gelombang II</h4>
                                    <span class="text-[10px] font-mono text-[#B89758] font-semibold">1 Mar 2027 – 30
                                        Jun 2027</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-xs pt-0.5">
                                    <div>
                                        <span class="text-[#4B6358] block text-[10px]">Registrasi MTs:</span>
                                        <strong class="text-[#0D3B2E] font-sans text-xs sm:text-sm">Rp
                                            150.000,-</strong>
                                    </div>
                                    <div>
                                        <span class="text-[#4B6358] block text-[10px]">Registrasi MDTA:</span>
                                        <strong class="text-[#0D3B2E] font-sans text-xs sm:text-sm">Rp
                                            30.000,-</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Requirements Checklist -->
                            <div class="pt-2 border-t border-[#E5E0D8] space-y-1 text-xs text-[#18181B]">
                                <span
                                    class="font-bold text-[#0D3B2E] block uppercase tracking-wider text-[10px]">Syarat
                                    Pendaftaran Utama:</span>
                                <div class="grid grid-cols-2 gap-1 text-[10px] sm:text-[11px] text-[#4B6358]">
                                    <span>&bull; Fotokopi Akta Lahir</span>
                                    <span>&bull; Fotokopi Kartu Keluarga</span>
                                    <span>&bull; Fotokopi KTP Orang Tua</span>
                                    <span>&bull; Ijazah / SKL Asal</span>
                                    <span>&bull; Pas Foto 3x4 (2 lembar)</span>
                                </div>
                            </div>

                            <div class="pt-1">
                                <a href="{{ route('psb.index') }}"
                                    class="w-full inline-flex items-center justify-center gap-1.5 py-2.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-semibold uppercase tracking-wider transition">
                                    <span>Daftar Secara Online &rarr;</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Latest Berita (Warta Terkini) -->
            <div class="col-start-1 row-start-1 w-full h-full flex flex-col justify-between transition-all duration-300 ease-in-out opacity-0 invisible z-0 pointer-events-none translate-x-4"
                :class="currentSlide === 3 ? 'opacity-100 visible z-10 pointer-events-auto transform-none' :
                    'opacity-0 invisible z-0 pointer-events-none translate-x-4'"
                :aria-hidden="currentSlide !== 3 ? 'true' : 'false'">

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 items-center h-full">
                    <!-- Left: News Story -->
                    <div class="md:col-span-7 flex flex-col justify-between space-y-4 text-left">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="editorial-label text-[10px] sm:text-xs text-[#059669]">03 / 03 — WARTA &
                                    DINAMIKA SANTRI</span>
                                <span
                                    class="px-2 py-0.5 rounded bg-amber-100 text-amber-900 text-[10px] font-bold uppercase tracking-wider">
                                    Kabar Terkini Pesantren
                                </span>
                            </div>
                            <div class="font-arabic text-xs sm:text-sm text-[#084C27] font-semibold pt-0.5"
                                dir="rtl" style="line-height: 1.8;">
                                اقْرَأْ وَارْتَقِ وَرَتِّلْ كَمَا كُنْتَ تُرَتِّلُ فِي الدُّنْيَا
                            </div>
                        </div>

                        @if ($featuredPost)
                            <h2
                                class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight leading-snug">
                                <a href="{{ route('news.show', $featuredPost->slug) }}"
                                    class="hover:text-[#059669] transition line-clamp-2">
                                    {{ $featuredPost->title }}
                                </a>
                            </h2>

                            <div class="flex items-center gap-3 text-xs text-[#4B6358] font-mono">
                                <span
                                    class="px-2 py-0.5 bg-emerald-50 text-[#084C27] rounded font-semibold text-[11px]">
                                    {{ $featuredPost->category?->name ?? 'Warta Utama' }}
                                </span>
                                <time datetime="{{ $featuredPost->published_at?->toDateString() }}"
                                    class="text-[11px]">
                                    {{ $featuredPost->published_at?->translatedFormat('d F Y') ?? date('d M Y') }}
                                </time>
                                <span class="hidden sm:inline text-[11px]">Oleh
                                    {{ $featuredPost->author?->name ?? 'Humas Pondok' }}</span>
                            </div>

                            <p
                                class="text-xs sm:text-sm md:text-base text-[#4B6358] max-w-2xl leading-relaxed line-clamp-3">
                                {{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->body ?? ($featuredPost->content ?? '')), 200) }}
                            </p>

                            <!-- Highlights Banner -->
                            <div class="grid grid-cols-2 gap-3 pt-0.5 max-w-xl text-xs">
                                <div class="bg-white border border-[#E5E0D8] rounded-md p-3">
                                    <span class="editorial-label text-[9px] text-[#059669] block">AGENDA
                                        KEPESANTRENAN</span>
                                    <p class="text-[11px] text-[#18181B] font-semibold mt-0.5 line-clamp-1">Kajian
                                        Kitab & Tahsin Al-Qur'an</p>
                                </div>
                                <div class="bg-white border border-[#E5E0D8] rounded-md p-3">
                                    <span class="editorial-label text-[9px] text-[#B89758] block">PRESTASI
                                        SANTRI</span>
                                    <p class="text-[11px] text-[#18181B] font-semibold mt-0.5 line-clamp-1">Hafalan
                                        Mutqin 30 Juz & Hadits</p>
                                </div>
                            </div>

                            <!-- Action CTAs -->
                            <div class="pt-1 flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 sm:gap-3">
                                <a href="{{ route('news.show', $featuredPost->slug) }}"
                                    class="inline-flex items-center justify-center gap-2 px-5 sm:px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition group border border-[#0D3B2E] shadow-xs">
                                    <span>Baca Artikel Lengkap</span>
                                    <span class="group-hover:translate-x-1 transition-transform"
                                        aria-hidden="true">&rarr;</span>
                                </a>
                                <a href="{{ route('news.index') }}"
                                    class="inline-flex items-center justify-center px-4 sm:px-5 py-3 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider transition shadow-xs">
                                    Buka Seluruh Arsip Berita
                                </a>
                            </div>
                        @else
                            <h2
                                class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                                Warta & Kabar Kegiatan Santri Terkini
                            </h2>
                            <p class="text-xs sm:text-sm md:text-base text-[#4B6358] leading-relaxed">
                                Simak seluruh informasi terbaru kegiatan hafalan Al-Qur'an, agenda pengajian asatidz,
                                dan prestasi santri Daar El Tazkiyah Sumardi.
                            </p>
                            <div class="grid grid-cols-2 gap-3 pt-0.5 max-w-xl text-xs">
                                <div class="bg-white border border-[#E5E0D8] rounded-md p-3">
                                    <span class="editorial-label text-[9px] text-[#059669] block">AGENDA
                                        KEPESANTRENAN</span>
                                    <p class="text-[11px] text-[#18181B] font-semibold mt-0.5">Kajian Kitab & Tahsin
                                        Al-Qur'an</p>
                                </div>
                                <div class="bg-white border border-[#E5E0D8] rounded-md p-3">
                                    <span class="editorial-label text-[9px] text-[#B89758] block">PRESTASI
                                        SANTRI</span>
                                    <p class="text-[11px] text-[#18181B] font-semibold mt-0.5">Hafalan Mutqin 30 Juz &
                                        Hadits</p>
                                </div>
                            </div>
                            <div class="pt-1">
                                <a href="{{ route('news.index') }}"
                                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition shadow-xs">
                                    <span>Lihat Halaman Berita &rarr;</span>
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Right Visual: News Preview Card (Tablet & Desktop) -->
                    <div class="hidden md:flex md:col-span-5 flex-col items-center">
                        <div
                            class="w-full max-w-sm lg:max-w-md bg-white border border-[#E5E0D8] rounded-md overflow-hidden shadow-md group">
                            <div class="aspect-16/10 relative overflow-hidden bg-[#FAF8F5] border-b border-[#E5E0D8]">
                                @if ($featuredPost && $featuredPost->featured_image)
                                    <img src="{{ asset('storage/' . $featuredPost->featured_image) }}"
                                        alt="{{ $featuredPost->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <x-public.image-placeholder :title="$featuredPost?->title ?? 'Warta Daar El Tazkiyah'" aspect="aspect-16/10" />
                                @endif
                            </div>
                            <div class="p-5 space-y-2.5">
                                <span class="editorial-label text-[#059669] text-[10px]">SOROTAN UTAMA</span>
                                <h3
                                    class="font-sans font-bold text-base lg:text-lg text-[#0D3B2E] leading-snug line-clamp-2">
                                    {{ $featuredPost?->title ?? 'Penerimaan Santri Baru TA 2027/2028 Resmi Dibuka' }}
                                </h3>
                                <p class="text-xs text-[#4B6358] line-clamp-2 leading-relaxed">
                                    {{ $featuredPost?->excerpt ?? 'Informasi seputar pendaftaran santri baru, alur seleksi, serta kurikulum kepesantrenan.' }}
                                </p>
                                <div class="pt-2 border-t border-[#E5E0D8] flex items-center justify-between text-xs">
                                    <span class="font-mono text-[#B89758] text-[11px]">PPMTQ Daar El Tazkiyah</span>
                                    <a href="{{ $featuredPost ? route('news.show', $featuredPost->slug) : route('news.index') }}"
                                        class="text-[#0D3B2E] font-bold hover:text-[#059669] transition text-xs">
                                        Selengkapnya &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Carousel Bottom Navigation & Indicators -->
        <div
            class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-[#E5E0D8] flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-4">
            <!-- Slide Indicators -->
            <div class="flex items-center justify-center gap-1.5 sm:gap-3 w-full sm:w-auto">
                <button type="button" @click="goTo(1)"
                    class="flex items-center gap-1.5 sm:gap-2 px-2.5 sm:px-3 py-1.5 rounded-full text-[11px] sm:text-xs font-semibold transition"
                    :class="currentSlide === 1 ? 'bg-[#0D3B2E] text-white shadow-xs' :
                        'bg-white border border-[#E5E0D8] text-[#4B6358] hover:border-[#0D3B2E]'">
                    <span class="w-2 h-2 rounded-full shrink-0"
                        :class="currentSlide === 1 ? 'bg-[#D97706]' : 'bg-gray-300'"></span>
                    <span class="sm:hidden">1. Profil</span>
                    <span class="hidden sm:inline">1. Profil Lembaga</span>
                </button>
                <button type="button" @click="goTo(2)"
                    class="flex items-center gap-1.5 sm:gap-2 px-2.5 sm:px-3 py-1.5 rounded-full text-[11px] sm:text-xs font-semibold transition"
                    :class="currentSlide === 2 ? 'bg-[#0D3B2E] text-white shadow-xs' :
                        'bg-white border border-[#E5E0D8] text-[#4B6358] hover:border-[#0D3B2E]'">
                    <span class="w-2 h-2 rounded-full shrink-0"
                        :class="currentSlide === 2 ? 'bg-[#D97706]' : 'bg-gray-300'"></span>
                    <span class="sm:hidden">2. PSB</span>
                    <span class="hidden sm:inline">2. Info PSB</span>
                </button>
                <button type="button" @click="goTo(3)"
                    class="flex items-center gap-1.5 sm:gap-2 px-2.5 sm:px-3 py-1.5 rounded-full text-[11px] sm:text-xs font-semibold transition"
                    :class="currentSlide === 3 ? 'bg-[#0D3B2E] text-white shadow-xs' :
                        'bg-white border border-[#E5E0D8] text-[#4B6358] hover:border-[#0D3B2E]'">
                    <span class="w-2 h-2 rounded-full shrink-0"
                        :class="currentSlide === 3 ? 'bg-[#D97706]' : 'bg-gray-300'"></span>
                    <span class="sm:hidden">3. Warta</span>
                    <span class="hidden sm:inline">3. Warta Terkini</span>
                </button>
            </div>

            <!-- Prev / Next Controls -->
            <div class="flex items-center justify-center gap-2">
                <button type="button" @click="prev(); resetAutoplay()"
                    class="p-2 sm:p-2.5 rounded-md border border-[#E5E0D8] bg-white text-[#0D3B2E] hover:border-[#0D3B2E] hover:bg-[#FAF8F5] transition shadow-xs"
                    aria-label="Slide Sebelumnya">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <div class="font-mono text-xs text-[#4B6358] px-2 font-semibold">
                    <span x-text="'0' + currentSlide">01</span> / 03
                </div>

                <button type="button" @click="next(); resetAutoplay()"
                    class="p-2 sm:p-2.5 rounded-md border border-[#E5E0D8] bg-white text-[#0D3B2E] hover:border-[#0D3B2E] hover:bg-[#FAF8F5] transition shadow-xs"
                    aria-label="Slide Berikutnya">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</section>
