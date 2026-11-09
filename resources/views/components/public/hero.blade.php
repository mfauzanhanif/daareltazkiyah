@props([
    'activeWave' => null,
    'featuredPost' => null,
    'feeMts' => '100.000',
    'feeMdta' => '25.000',
])

<section class="relative bg-[#FAF8F5] pt-6 pb-8 sm:pt-10 sm:pb-12 md:pt-12 md:pb-14 border-b border-[#E5E0D8] overflow-hidden"
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
    }"
    x-init="startAutoplay()"
    @mouseenter="isPaused = true"
    @mouseleave="isPaused = false"
    @touchstart.passive="handleTouchStart($event)"
    @touchend.passive="handleTouchEnd($event)"
    @keydown.arrow-right.window="next()"
    @keydown.arrow-left.window="prev()">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Slides Container (Equal Height & display:none Isolation) -->
        <div class="relative">

            <!-- Slide 1: Profil Pesantren & Identitas -->
            <div x-show="currentSlide === 1" x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-1"
                class="min-h-[500px] sm:min-h-[460px] md:min-h-[440px] flex flex-col justify-between">

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 items-center h-full">
                    <!-- Left: Headline & Information -->
                    <div class="md:col-span-7 flex flex-col justify-between space-y-4 text-left">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-[#059669] tracking-wider uppercase">
                                PPMTQ DAAR EL TAZKIYAH SUMARDI
                            </span>
                            <div class="font-arabic text-xl sm:text-2xl text-[#B89758] font-bold" dir="rtl" style="line-height: 1.8;">
                                بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                            </div>
                        </div>

                        <div class="space-y-2">
                            <h1 class="font-sans text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#0D3B2E] tracking-tight leading-tight">
                                Pondok Pesantren Modern Tahfidzul Quran <br class="hidden sm:inline" />
                                <span class="text-[#059669]">Daar El Tazkiyah Sumardi</span>
                            </h1>
                            <div class="inline-block text-xs sm:text-sm font-medium text-amber-900 bg-amber-50 border border-amber-200/80 px-3 py-1 rounded-md">
                                "Bersama Al-Qur'an Meraih Masa Depan Gemilang."
                            </div>
                        </div>

                        <p class="text-sm sm:text-base text-[#4B6358] max-w-xl leading-relaxed">
                            Lembaga pendidikan Islam di Kabupaten Serang, Banten yang memadukan kurikulum pendidikan formal dan kepesantrenan untuk melahirkan generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi, dan siap mengabdi kepada masyarakat.
                        </p>

                        <!-- Program Unggulan Pills -->
                        <div class="flex flex-wrap items-center gap-2 pt-1 text-xs text-[#0D3B2E]">
                            <span class="px-2.5 py-1 rounded-md bg-white border border-[#E5E0D8] font-medium shadow-2xs">Tahfidz Mutqin 30 Juz</span>
                            <span class="px-2.5 py-1 rounded-md bg-white border border-[#E5E0D8] font-medium shadow-2xs">Kajian Kitab Kuning</span>
                            <span class="px-2.5 py-1 rounded-md bg-white border border-[#E5E0D8] font-medium shadow-2xs">Bilingual Arab & Inggris</span>
                        </div>

                        <!-- Action CTAs -->
                        <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            <a href="{{ route('psb.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition group shadow-xs">
                                <span>Daftar PSB Online</span>
                                <span class="group-hover:translate-x-1 transition-transform" aria-hidden="true">&rarr;</span>
                            </a>
                            <a href="{{ route('profile.index') }}" class="inline-flex items-center justify-center px-5 py-3 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider transition shadow-xs">
                                Profil Pesantren
                            </a>
                        </div>
                    </div>

                    <!-- Right Visual: Arch Frame Pengasuh -->
                    <div class="hidden md:flex md:col-span-5 flex-col items-center">
                        <div class="relative w-full max-w-sm bg-white p-3 border-gold-hairline rounded-arch shadow-md">
                            <div class="w-full h-72 lg:h-80 rounded-arch overflow-hidden bg-[#084C27] relative flex flex-col justify-end border border-gold-hairline/60">
                                @if(file_exists(public_path('images/pengasuh daar el tazkiyah.webp')))
                                    <img src="{{ asset('images/pengasuh daar el tazkiyah.webp') }}"
                                        alt="Ust. Ahmad Ashil Fadhil, S.H., M.H."
                                        class="absolute inset-0 w-full h-full object-cover object-top">
                                @else
                                    <div class="absolute inset-0 flex flex-col items-center justify-center text-white/20 pb-12 pointer-events-none">
                                        <img src="{{ asset('images/logo_daar_el_tazkiyah.svg') }}" alt="Logo" width="96" height="96" class="w-20 lg:w-24 h-20 lg:h-24 object-contain opacity-25"
                                            onerror="this.onerror=null; this.src='{{ asset('images/logo_daar_el_tazkiyah.png') }}';">
                                        <span class="font-arabic text-xs lg:text-sm text-amber-200/50 mt-2" dir="rtl">Pengasuh Pesantren</span>
                                    </div>
                                @endif
                                <div class="relative z-10 bg-gradient-to-t from-[#084C27] via-[#084C27]/90 to-transparent p-4 text-center text-white">
                                    <span class="text-[10px] tracking-wider uppercase text-amber-300 font-bold block">PENGASUH PESANTREN</span>
                                    <h3 class="font-sans font-bold text-base text-white tracking-tight mt-0.5">
                                        Ust. Ahmad Ashil Fadhil, S.H., M.H.
                                    </h3>
                                    <p class="text-[11px] text-emerald-100 font-normal">
                                        PPMTQ Daar El Tazkiyah Sumardi
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Informasi PSB 2027/2028 -->
            <div x-show="currentSlide === 2" x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-1"
                class="min-h-[500px] sm:min-h-[460px] md:min-h-[440px] flex flex-col justify-between">

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 items-center h-full">
                    <!-- Left: PSB Details -->
                    <div class="md:col-span-7 flex flex-col justify-between space-y-4 text-left">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-[#059669] tracking-wider uppercase">
                                PENERIMAAN SANTRI BARU (PSB)
                            </span>
                            <div class="font-arabic text-sm text-[#084C27] font-semibold" dir="rtl" style="line-height: 1.8;">
                                خَيْرُكُمْ مَنْ تَعَلَّمَ الْقُرْآنَ وَعَلَّمَهُ
                            </div>
                        </div>

                        <div class="space-y-2">
                            <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#0D3B2E] tracking-tight leading-tight">
                                Pendaftaran Santri Baru <br class="hidden sm:inline" />
                                <span class="text-[#059669]">Tahun Ajaran {{ $activeWave?->academic_year ?? '2027/2028' }}</span>
                            </h2>
                            <div class="inline-block text-xs font-semibold text-emerald-800 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded">
                                {{ $activeWave?->name ?? 'Gelombang I' }} Sedang Dibuka (1 Okt 2026 – 28 Feb 2027)
                            </div>
                        </div>

                        <p class="text-sm sm:text-base text-[#4B6358] max-w-xl leading-relaxed">
                            Membuka kesempatan bagi putra-putri untuk menimba ilmu Al-Qur'an, adab mulia, dan sains terpadu dengan biaya terjangkau serta fasilitas asrama mukim yang nyaman di Serang, Banten.
                        </p>

                        <!-- Fee Comparison Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1 max-w-xl">
                            <!-- MTs Card -->
                            <div class="bg-white border border-[#E5E0D8] rounded-md p-3.5 shadow-2xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-xs text-[#0D3B2E]">Jenjang MTs (Mukim)</span>
                                    <span class="text-[9px] font-semibold bg-[#0D3B2E] text-white px-2 py-0.5 rounded">24 Jam</span>
                                </div>
                                <div class="text-lg font-extrabold text-[#0D3B2E] mt-1 font-sans">
                                    Rp 500.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                                </div>
                                <p class="text-[11px] text-[#059669] mt-0.5 leading-tight">
                                    Termasuk makan 3x sehari, asrama, & pendidikan
                                </p>
                            </div>

                            <!-- MDTA Card -->
                            <div class="bg-white border border-[#E5E0D8] rounded-md p-3.5 shadow-2xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-xs text-[#0D3B2E]">Jenjang MDTA</span>
                                    <span class="text-[9px] font-semibold bg-[#B89758] text-white px-2 py-0.5 rounded">Sekolah Sore</span>
                                </div>
                                <div class="text-lg font-extrabold text-[#0D3B2E] mt-1 font-sans">
                                    Rp 12.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                                </div>
                                <p class="text-[11px] text-[#4B6358] mt-0.5 leading-tight">
                                    Pendidikan diniyah & tahsin tingkat SD
                                </p>
                            </div>
                        </div>

                        <!-- Action CTAs -->
                        <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            <a href="{{ route('psb.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition group shadow-xs">
                                <span>Isi Formulir PSB Online</span>
                                <span class="group-hover:translate-x-1 transition-transform" aria-hidden="true">&rarr;</span>
                            </a>
                            <a href="{{ route('psb.status') }}" class="inline-flex items-center justify-center px-5 py-3 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider transition shadow-xs">
                                Cek Status Pendaftaran
                            </a>
                        </div>
                    </div>

                    <!-- Right Visual: Waves & Requirements Breakdown Card -->
                    <div class="hidden md:flex md:col-span-5 flex-col items-center">
                        <div class="w-full max-w-sm bg-white border border-[#E5E0D8] rounded-md p-5 space-y-3 shadow-sm">
                            <div class="border-b border-[#E5E0D8] pb-2 flex items-center justify-between">
                                <span class="text-xs font-bold text-[#0D3B2E] uppercase tracking-wider">JADWAL & BIAYA REGISTRASI</span>
                                <span class="text-xs font-mono text-[#059669] font-bold">2027/2028</span>
                            </div>

                            <!-- Wave 1 -->
                            <div class="p-3 rounded-md bg-[#FAF8F5] border-l-4 border-[#059669] space-y-1">
                                <h4 class="font-bold text-xs text-[#0D3B2E]">Gelombang I (Sedang Dibuka)</h4>
                                <p class="text-[11px] text-[#4B6358]">1 Oktober 2026 – 28 Februari 2027</p>
                                <div class="text-[11px] text-[#0D3B2E] font-semibold pt-0.5">
                                    Registrasi: MTs Rp {{ $feeMts }} | MDTA Rp {{ $feeMdta }}
                                </div>
                            </div>

                            <!-- Wave 2 -->
                            <div class="p-3 rounded-md bg-[#FAF8F5] border-l-4 border-[#B89758] space-y-1">
                                <h4 class="font-bold text-xs text-[#0D3B2E]">Gelombang II</h4>
                                <p class="text-[11px] text-[#4B6358]">1 Maret 2027 – 30 Juni 2027</p>
                                <div class="text-[11px] text-[#0D3B2E] font-semibold pt-0.5">
                                    Registrasi: MTs Rp 150.000 | MDTA Rp 30.000
                                </div>
                            </div>

                            <!-- Requirements Checklist -->
                            <div class="pt-2 border-t border-[#E5E0D8] text-[11px] text-[#4B6358]">
                                <span class="font-bold text-[#0D3B2E] block uppercase tracking-wider text-[10px] mb-1">Syarat Pendaftaran:</span>
                                Fotokopi Akta Lahir, KK, KTP Orang Tua, Ijazah/SKL, dan Pas Foto 3x4 (2 lembar).
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Latest Berita (Warta Terkini) -->
            <div x-show="currentSlide === 3" x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-1"
                class="min-h-[500px] sm:min-h-[460px] md:min-h-[440px] flex flex-col justify-between">

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 items-center h-full">
                    <!-- Left: News Story -->
                    <div class="md:col-span-7 flex flex-col justify-between space-y-4 text-left">
                        <div class="space-y-1">
                            <span class="text-xs font-bold text-[#059669] tracking-wider uppercase">
                                WARTA & KABAR TERKINI
                            </span>
                            <div class="font-arabic text-sm text-[#084C27] font-semibold" dir="rtl" style="line-height: 1.8;">
                                اقْرَأْ وَارْتَقِ وَرَتِّلْ كَمَا كُنْتَ تُرَتِّلُ فِي الدُّنْيَا
                            </div>
                        </div>

                        @if($featuredPost)
                            <div class="space-y-2">
                                <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight leading-tight line-clamp-2">
                                    <a href="{{ route('news.show', $featuredPost->slug) }}" class="hover:text-[#059669] transition">
                                        {{ $featuredPost->title }}
                                    </a>
                                </h2>
                                <div class="flex items-center gap-3 text-xs text-[#4B6358] font-mono">
                                    <span class="px-2 py-0.5 bg-emerald-50 text-[#084C27] rounded font-semibold text-[11px]">
                                        {{ $featuredPost->category?->name ?? 'Warta Utama' }}
                                    </span>
                                    <time datetime="{{ $featuredPost->published_at?->toDateString() }}" class="text-[11px]">
                                        {{ $featuredPost->published_at?->translatedFormat('d F Y') ?? date('d M Y') }}
                                    </time>
                                    <span class="hidden sm:inline text-[11px]">Humas Pondok</span>
                                </div>
                            </div>

                            <p class="text-sm sm:text-base text-[#4B6358] max-w-xl leading-relaxed line-clamp-3">
                                {{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->body ?? $featuredPost->content ?? ''), 180) }}
                            </p>

                            <!-- Tags -->
                            <div class="flex flex-wrap items-center gap-2 pt-1 text-xs text-[#0D3B2E]">
                                <span class="px-2.5 py-1 rounded-md bg-white border border-[#E5E0D8] font-medium shadow-2xs">Agenda Kepesantrenan</span>
                                <span class="px-2.5 py-1 rounded-md bg-white border border-[#E5E0D8] font-medium shadow-2xs">Kajian Kitab Kuning</span>
                                <span class="px-2.5 py-1 rounded-md bg-white border border-[#E5E0D8] font-medium shadow-2xs">Prestasi Santri</span>
                            </div>

                            <!-- Action CTAs -->
                            <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                <a href="{{ route('news.show', $featuredPost->slug) }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition group shadow-xs">
                                    <span>Baca Artikel Lengkap</span>
                                    <span class="group-hover:translate-x-1 transition-transform" aria-hidden="true">&rarr;</span>
                                </a>
                                <a href="{{ route('news.index') }}" class="inline-flex items-center justify-center px-5 py-3 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider transition shadow-xs">
                                    Semua Berita
                                </a>
                            </div>
                        @else
                            <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight leading-tight">
                                Warta & Dinamika Santri Daar El Tazkiyah
                            </h2>
                            <p class="text-sm sm:text-base text-[#4B6358] max-w-xl leading-relaxed">
                                Ikuti seluruh informasi terbaru kegiatan hafalan Al-Qur'an, agenda pengajian asatidz, dan prestasi santri Daar El Tazkiyah Sumardi.
                            </p>
                            <div class="pt-2">
                                <a href="{{ route('news.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition shadow-xs">
                                    <span>Lihat Halaman Berita &rarr;</span>
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Right Visual: News Preview Card -->
                    <div class="hidden md:flex md:col-span-5 flex-col items-center">
                        <div class="w-full max-w-sm bg-white border border-[#E5E0D8] rounded-md overflow-hidden shadow-sm group">
                            <div class="aspect-16/10 relative overflow-hidden bg-[#FAF8F5] border-b border-[#E5E0D8]">
                                @if($featuredPost && $featuredPost->featured_image)
                                    <img src="{{ asset('storage/' . $featuredPost->featured_image) }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <x-public.image-placeholder :title="$featuredPost?->title ?? 'Warta Daar El Tazkiyah'" aspect="aspect-16/10" />
                                @endif
                            </div>
                            <div class="p-4 space-y-2">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[#059669]">SOROTAN UTAMA</span>
                                <h3 class="font-bold text-sm text-[#0D3B2E] leading-snug line-clamp-2">
                                    {{ $featuredPost?->title ?? 'Penerimaan Santri Baru TA 2027/2028 Resmi Dibuka' }}
                                </h3>
                                <p class="text-xs text-[#4B6358] line-clamp-2 leading-relaxed">
                                    {{ $featuredPost?->excerpt ?? 'Informasi seputar pendaftaran santri baru, alur seleksi, serta kurikulum kepesantrenan.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Carousel Bottom Navigation & Indicators (No Numbers!) -->
        <div class="mt-8 pt-5 border-t border-[#E5E0D8] flex items-center justify-between gap-4">
            <!-- Slide Indicators (Clean labels, no numbers) -->
            <div class="flex items-center gap-2 sm:gap-3 overflow-x-auto py-1">
                <button type="button" @click="goTo(1)"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold transition shrink-0"
                    :class="currentSlide === 1 ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-white border border-[#E5E0D8] text-[#4B6358] hover:border-[#0D3B2E]'">
                    <span class="w-2 h-2 rounded-full" :class="currentSlide === 1 ? 'bg-[#D97706]' : 'bg-gray-300'"></span>
                    <span>Profil Pesantren</span>
                </button>
                <button type="button" @click="goTo(2)"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold transition shrink-0"
                    :class="currentSlide === 2 ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-white border border-[#E5E0D8] text-[#4B6358] hover:border-[#0D3B2E]'">
                    <span class="w-2 h-2 rounded-full" :class="currentSlide === 2 ? 'bg-[#D97706]' : 'bg-gray-300'"></span>
                    <span>Penerimaan Santri (PSB)</span>
                </button>
                <button type="button" @click="goTo(3)"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold transition shrink-0"
                    :class="currentSlide === 3 ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-white border border-[#E5E0D8] text-[#4B6358] hover:border-[#0D3B2E]'">
                    <span class="w-2 h-2 rounded-full" :class="currentSlide === 3 ? 'bg-[#D97706]' : 'bg-gray-300'"></span>
                    <span>Warta Terkini</span>
                </button>
            </div>

            <!-- Prev / Next Controls (No numbers) -->
            <div class="flex items-center gap-2 shrink-0">
                <button type="button" @click="prev(); resetAutoplay()"
                    class="p-2 sm:p-2.5 rounded-md border border-[#E5E0D8] bg-white text-[#0D3B2E] hover:border-[#0D3B2E] hover:bg-[#FAF8F5] transition shadow-xs"
                    aria-label="Slide Sebelumnya">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

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
