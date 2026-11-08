@props([
    'activeWave' => null,
    'featuredPost' => null,
    'feeMts' => '100.000',
    'feeMdta' => '25.000',
])

<section class="relative bg-[#FAF8F5] pt-6 pb-12 sm:pt-10 sm:pb-16 md:pt-12 md:pb-20 border-b border-[#E5E0D8] overflow-hidden"
    x-data="{
        currentSlide: 1,
        totalSlides: 3,
        autoplayTimer: null,
        isPaused: false,
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
        }
    }"
    x-init="startAutoplay()"
    @mouseenter="isPaused = true"
    @mouseleave="isPaused = false"
    @keydown.arrow-right.window="next()"
    @keydown.arrow-left.window="prev()">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Slide 1: Hero Pesantren & Tagline -->
        <div x-show="currentSlide === 1"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-4">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 items-center">
                <!-- Left: Headline & Tagline -->
                <div class="lg:col-span-7 space-y-5 text-left">
                    <div class="space-y-1">
                        <p class="font-arabic text-2xl sm:text-3xl text-[#B89758] font-bold" dir="rtl" style="line-height: 1.8;">
                            بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                        </p>
                        <div class="flex items-center gap-2.5 pt-1">
                            <span class="editorial-label">01 / 03 — IDENTITAS PESANTREN</span>
                            <span class="w-8 h-px bg-[#B89758]"></span>
                            <span class="text-xs font-arabic text-[#084C27] font-semibold" dir="rtl" style="line-height: 1.8;">
                                معهد دار التزكية سوماردي الإسلامي لتحفيظ القرآن
                            </span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="inline-block px-3 py-1 rounded bg-amber-100/80 border border-amber-300/60 text-amber-900 text-xs font-semibold tracking-wide">
                            Tagline: "Bersama Al-Qur'an Meraih Masa Depan Gemilang."
                        </div>
                        <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-[#0D3B2E] tracking-tight leading-[1.12]">
                            Pondok Pesantren Modern Tahfidzul Quran <br class="hidden sm:block" />
                            <span class="text-[#059669]">Daar El Tazkiyah Sumardi</span>
                        </h1>
                    </div>

                    <p class="text-base sm:text-lg text-[#4B6358] max-w-2xl leading-relaxed font-sans">
                        Melahirkan generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi, dan siap mengabdi untuk umat. Memadukan kurikulum pendidikan formal dan kepesantrenan di Kabupaten Serang, Banten.
                    </p>

                    <!-- Pengasuh Citation -->
                    <div class="border-l-2 border-[#B89758] rounded-r-md pl-4 py-2 text-xs sm:text-sm text-[#18181B] italic bg-white/70 max-w-xl shadow-xs">
                        "Menghafal Al-Qur'an adalah perjalanan penyucian jiwa (tazkiyah), menyandingkan adab di atas ilmu, dan melatih kemandirian santri untuk peradaban Islam."
                        <span class="block text-[11px] font-sans font-semibold text-[#084C27] mt-1 not-italic">
                            — Ust. Ahmad Ashil Fadhil, S.H., M.H. (Pengasuh Pondok)
                        </span>
                    </div>

                    <!-- Action CTAs -->
                    <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        <a href="{{ route('psb.index') }}" class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition group border border-[#0D3B2E] shadow-xs">
                            <span>Daftar PSB Online</span>
                            <span class="group-hover:translate-x-1 transition-transform" aria-hidden="true">&rarr;</span>
                        </a>
                        <a href="{{ route('profile.index') }}" class="inline-flex items-center justify-center px-6 py-3.5 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider transition shadow-xs">
                            Jelajahi Profil
                        </a>
                        <a href="{{ route('psb.status') }}" class="inline-flex items-center justify-center px-4 py-3.5 rounded-md border border-transparent text-[#4B6358] hover:text-[#0D3B2E] text-xs font-semibold uppercase tracking-wider transition">
                            Cek Status &rarr;
                        </a>
                    </div>
                </div>

                <!-- Right Visual: Arch Frame Pengasuh -->
                <div class="lg:col-span-5 flex flex-col items-center">
                    <div class="relative w-full max-w-md">
                        <div class="relative bg-white p-3 border-gold-hairline rounded-arch shadow-md pattern-kufic">
                            <div class="w-full h-80 sm:h-96 rounded-arch overflow-hidden bg-gradient-to-b from-[#084C27] to-[#042816] relative flex flex-col justify-end border border-gold-hairline/60">
                                <!-- Islamic Calligraphy / Motif -->
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-white/20 pb-16 pointer-events-none">
                                    <img src="{{ asset('images/logo_daar_el_tazkiyah.svg') }}" alt="Logo" width="112" height="112" style="max-width: 112px; max-height: 112px;" class="w-28 h-28 object-contain opacity-25"
                                        onerror="this.onerror=null; this.src='{{ asset('images/logo_daar_el_tazkiyah.png') }}';">
                                    <span class="font-arabic text-sm text-amber-200/50 mt-2" dir="rtl" style="line-height: 1.8;">فضيلة الشيخ Pengasuh</span>
                                </div>

                                <!-- Overlay Caption -->
                                <div class="relative z-10 bg-gradient-to-t from-[#084C27] via-[#084C27]/95 to-transparent p-5 text-center text-white">
                                    <span class="editorial-label text-amber-300 block text-[10px]">PIMPINAN & PENGASUH PESANTREN</span>
                                    <h3 class="font-sans font-bold text-lg text-white tracking-tight mt-0.5">
                                        Ust. Ahmad Ashil Fadhil, S.H., M.H.
                                    </h3>
                                    <p class="text-[11px] text-emerald-100/90 font-medium">
                                        Magister Hukum & Alumni Keilmuan Syariah
                                    </p>
                                    <div class="text-[11px] text-amber-300/80 mt-0.5 font-arabic" dir="rtl" style="line-height: 1.8;">
                                        حفظه الله تعالى ورعاه
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Real-time Status Card -->
                        <div class="mt-4 bg-white border border-[#E5E0D8] rounded-md p-4 text-xs shadow-xs">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2 mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#059669] animate-pulse"></span>
                                    <span class="editorial-label text-[#0D3B2E]">PENDAFTARAN AKTIF</span>
                                </div>
                                <span class="text-[11px] font-mono text-[#059669] font-bold">
                                    TA {{ $activeWave?->academic_year ?? '2027/2028' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between text-xs text-[#18181B]">
                                <div>
                                    <span class="text-[#4B6358] block">Gelombang:</span>
                                    <strong class="text-[#0D3B2E]">{{ $activeWave?->name ?? 'Gelombang I' }} (1 Okt 2026 – 28 Feb 2027)</strong>
                                </div>
                                <a href="{{ route('psb.index') }}" class="inline-flex items-center gap-1 text-[#059669] hover:text-[#0D3B2E] font-semibold transition">
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
        <div x-show="currentSlide === 2" x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-4">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 items-center">
                <!-- Left: PSB Details -->
                <div class="lg:col-span-7 space-y-5 text-left">
                    <div class="space-y-1">
                        <span class="editorial-label text-[#059669]">02 / 03 — PENERIMAAN SANTRI BARU (PSB)</span>
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded bg-emerald-100 text-[#084C27] text-xs font-bold uppercase tracking-wider">
                                Tahun Ajaran 2027/2028
                            </span>
                            <span class="text-xs text-[#B89758] font-semibold">Telah Dibuka</span>
                        </div>
                        <div class="font-arabic text-sm text-[#084C27] font-semibold pt-1" dir="rtl" style="line-height: 1.8;">
                            خَيْرُكُمْ مَنْ تَعَلَّمَ الْقُرْآنَ وَعَلَّمَهُ
                        </div>
                    </div>

                    <h2 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#0D3B2E] tracking-tight leading-tight">
                        Penerimaan Santri Baru <br />
                        <span class="text-[#059669]">MTs Mukim & MDTA Sore</span>
                    </h2>

                    <p class="text-sm sm:text-base text-[#4B6358] max-w-2xl leading-relaxed">
                        PPMTQ Daar El Tazkiyah Sumardi membuka kesempatan bagi putra-putri untuk menimba ilmu Al-Qur'an, adab mulia, dan sains terpadu dengan biaya terjangkau serta fasilitas asrama mukim yang nyaman di Serang, Banten.
                    </p>

                    <!-- Fast Fee Comparison Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1 max-w-xl">
                        <!-- MTs Card -->
                        <div class="bg-white border-2 border-[#0D3B2E]/20 rounded-md p-4 space-y-1.5 shadow-xs">
                            <div class="flex items-center justify-between">
                                <span class="font-sans font-bold text-sm text-[#0D3B2E]">Jenjang MTs (Mukim)</span>
                                <span class="text-[10px] font-mono uppercase bg-[#0D3B2E] text-white px-2 py-0.5 rounded">24 Jam</span>
                            </div>
                            <div class="text-xs text-[#4B6358]">Biaya Syahriyah:</div>
                            <div class="text-xl font-extrabold text-[#0D3B2E] font-sans">
                                Rp 500.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                            </div>
                            <p class="text-[11px] text-[#059669] font-medium leading-tight">
                                Sudah termasuk makan 3x sehari, asrama, & pendidikan.
                            </p>
                        </div>

                        <!-- MDTA Card -->
                        <div class="bg-white border border-[#E5E0D8] rounded-md p-4 space-y-1.5 shadow-xs">
                            <div class="flex items-center justify-between">
                                <span class="font-sans font-bold text-sm text-[#0D3B2E]">Jenjang MDTA</span>
                                <span class="text-[10px] font-mono uppercase bg-[#B89758] text-white px-2 py-0.5 rounded">Non-Mukim</span>
                            </div>
                            <div class="text-xs text-[#4B6358]">Biaya Syahriyah:</div>
                            <div class="text-xl font-extrabold text-[#0D3B2E] font-sans">
                                Rp 12.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                            </div>
                            <p class="text-[11px] text-[#4B6358] font-medium leading-tight">
                                Sekolah sore tingkat SD (Pendidikan diniyah & tahsin).
                            </p>
                        </div>
                    </div>

                    <!-- Action CTAs -->
                    <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        <a href="{{ route('psb.index') }}" class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition group border border-[#0D3B2E]">
                            <span>Isi Formulir PSB Online</span>
                            <span class="group-hover:translate-x-1 transition-transform" aria-hidden="true">&rarr;</span>
                        </a>
                        <a href="{{ route('program.index') }}#program-pendidikan" class="inline-flex items-center justify-center px-6 py-3.5 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider transition">
                            Lihat Rincian Program
                        </a>
                    </div>
                </div>

                <!-- Right Visual: Waves Breakdown Card -->
                <div class="lg:col-span-5">
                    <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-4 shadow-md">
                        <div class="border-b border-[#E5E0D8] pb-3 flex items-center justify-between">
                            <span class="editorial-label text-[#0D3B2E]">JADWAL & BIAYA REGISTRASI PSB</span>
                            <span class="text-xs font-mono text-[#059669] font-bold">2027/2028</span>
                        </div>

                        <!-- Wave 1 -->
                        <div class="p-4 rounded-md bg-[#FAF8F5] border-l-4 border-[#059669] space-y-2">
                            <div class="flex items-center justify-between">
                                <h4 class="font-sans font-bold text-sm text-[#0D3B2E]">Gelombang I (Sedang Aktif)</h4>
                                <span class="text-[10px] font-mono text-[#059669] font-semibold">1 Okt 2026 – 28 Feb 2027</span>
                            </div>
                            <div class="grid grid-cols-2 gap-2 text-xs pt-1">
                                <div>
                                    <span class="text-[#4B6358] block">Registrasi MTs:</span>
                                    <strong class="text-[#0D3B2E] font-sans text-sm">Rp 100.000,-</strong>
                                </div>
                                <div>
                                    <span class="text-[#4B6358] block">Registrasi MDTA:</span>
                                    <strong class="text-[#0D3B2E] font-sans text-sm">Rp 25.000,-</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Wave 2 -->
                        <div class="p-4 rounded-md bg-[#FAF8F5] border-l-4 border-[#B89758] space-y-2">
                            <div class="flex items-center justify-between">
                                <h4 class="font-sans font-bold text-sm text-[#0D3B2E]">Gelombang II</h4>
                                <span class="text-[10px] font-mono text-[#B89758] font-semibold">1 Mar 2027 – 30 Jun 2027</span>
                            </div>
                            <div class="grid grid-cols-2 gap-2 text-xs pt-1">
                                <div>
                                    <span class="text-[#4B6358] block">Registrasi MTs:</span>
                                    <strong class="text-[#0D3B2E] font-sans text-sm">Rp 150.000,-</strong>
                                </div>
                                <div>
                                    <span class="text-[#4B6358] block">Registrasi MDTA:</span>
                                    <strong class="text-[#0D3B2E] font-sans text-sm">Rp 30.000,-</strong>
                                </div>
                            </div>
                        </div>

                        <!-- Requirements Checklist -->
                        <div class="pt-2 border-t border-[#E5E0D8] space-y-1.5 text-xs text-[#18181B]">
                            <span class="font-bold text-[#0D3B2E] block uppercase tracking-wider text-[11px]">Syarat Pendaftaran Utama:</span>
                            <div class="grid grid-cols-2 gap-1.5 text-[11px] text-[#4B6358]">
                                <span>&bull; Fotokopi Akta Lahir</span>
                                <span>&bull; Fotokopi Kartu Keluarga</span>
                                <span>&bull; Fotokopi KTP Orang Tua</span>
                                <span>&bull; Ijazah / SKL Asal</span>
                                <span>&bull; Pas Foto 3x4 (2 lembar)</span>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a href="{{ route('psb.index') }}" class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-semibold uppercase tracking-wider transition">
                                <span>Daftar Sekarang Secara Online &rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3: Latest Berita (Warta Terkini) -->
        <div x-show="currentSlide === 3" x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-4">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-8 items-center">
                <!-- Left: News Story -->
                <div class="lg:col-span-7 space-y-5 text-left">
                    <div class="space-y-1">
                        <span class="editorial-label text-[#059669]">03 / 03 — WARTA & DINAMIKA SANTRI</span>
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded bg-amber-100 text-amber-900 text-xs font-bold uppercase tracking-wider">
                                Kabar Terkini Pesantren
                            </span>
                        </div>
                        <div class="font-arabic text-sm text-[#084C27] font-semibold pt-1" dir="rtl" style="line-height: 1.8;">
                            اقْرَأْ وَارْتَقِ وَرَتِّلْ كَمَا كُنْتَ تُرَتِّلُ فِي الدُّنْيَا
                        </div>
                    </div>

                    @if($featuredPost)
                        <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#0D3B2E] tracking-tight leading-snug">
                            <a href="{{ route('news.show', $featuredPost->slug) }}" class="hover:text-[#059669] transition">
                                {{ $featuredPost->title }}
                            </a>
                        </h2>

                        <div class="flex items-center gap-4 text-xs text-[#4B6358] font-mono">
                            <span class="px-2 py-0.5 bg-emerald-50 text-[#084C27] rounded font-semibold">
                                {{ $featuredPost->category?->name ?? 'Warta Utama' }}
                            </span>
                            <time datetime="{{ $featuredPost->published_at?->toDateString() }}">
                                {{ $featuredPost->published_at?->translatedFormat('d F Y') ?? date('d M Y') }}
                            </time>
                            <span>Oleh {{ $featuredPost->author?->name ?? 'Humas Pondok' }}</span>
                        </div>

                        <p class="text-sm sm:text-base text-[#4B6358] max-w-2xl leading-relaxed line-clamp-3">
                            {{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->body ?? $featuredPost->content ?? ''), 200) }}
                        </p>

                        <!-- Action CTAs -->
                        <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            <a href="{{ route('news.show', $featuredPost->slug) }}" class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition group border border-[#0D3B2E]">
                                <span>Baca Artikel Lengkap</span>
                                <span class="group-hover:translate-x-1 transition-transform" aria-hidden="true">&rarr;</span>
                            </a>
                            <a href="{{ route('news.index') }}" class="inline-flex items-center justify-center px-6 py-3.5 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider transition">
                                Buka Seluruh Arsip Berita
                            </a>
                        </div>
                    @else
                        <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                            Warta & Kabar Kegiatan Santri Terkini
                        </h2>
                        <p class="text-sm sm:text-base text-[#4B6358] leading-relaxed">
                            Simak seluruh informasi terbaru kegiatan hafalan Al-Qur'an, agenda pengajian asatidz, dan prestasi santri Daar El Tazkiyah Sumardi.
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('news.index') }}" class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition">
                                <span>Lihat Halaman Berita &rarr;</span>
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Right Visual: News Preview Card -->
                <div class="lg:col-span-5 flex flex-col items-center">
                    <div class="w-full max-w-md bg-white border border-[#E5E0D8] rounded-md overflow-hidden shadow-md group">
                        <div class="aspect-16/10 relative overflow-hidden bg-[#FAF8F5] border-b border-[#E5E0D8]">
                            @if($featuredPost && $featuredPost->featured_image)
                                <img src="{{ asset('storage/' . $featuredPost->featured_image) }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <x-public.image-placeholder :title="$featuredPost?->title ?? 'Warta Daar El Tazkiyah'" aspect="aspect-16/10" />
                            @endif
                        </div>
                        <div class="p-6 space-y-3">
                            <span class="editorial-label text-[#059669]">SOROTAN UTAMA</span>
                            <h3 class="font-sans font-bold text-lg text-[#0D3B2E] leading-snug">
                                {{ $featuredPost?->title ?? 'Penerimaan Santri Baru TA 2027/2028 Resmi Dibuka' }}
                            </h3>
                            <p class="text-xs text-[#4B6358] line-clamp-2">
                                {{ $featuredPost?->excerpt ?? 'Informasi seputar pendaftaran santri baru, alur seleksi, serta kurikulum kepesantrenan.' }}
                            </p>
                            <div class="pt-2 border-t border-[#E5E0D8] flex items-center justify-between text-xs">
                                <span class="font-mono text-[#B89758]">PPMTQ Daar El Tazkiyah</span>
                                <a href="{{ $featuredPost ? route('news.show', $featuredPost->slug) : route('news.index') }}" class="text-[#0D3B2E] font-bold hover:text-[#059669] transition">
                                    Selengkapnya &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel Bottom Navigation & Indicators -->
        <div class="mt-8 pt-6 border-t border-[#E5E0D8] flex flex-col sm:flex-row items-center justify-between gap-4">
            <!-- Slide Indicators -->
            <div class="flex items-center gap-3">
                <button type="button" @click="goTo(1)"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold transition"
                    :class="currentSlide === 1 ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-white border border-[#E5E0D8] text-[#4B6358] hover:border-[#0D3B2E]'">
                    <span class="w-2 h-2 rounded-full" :class="currentSlide === 1 ? 'bg-[#D97706]' : 'bg-gray-300'"></span>
                    <span>1. Profil Lembaga</span>
                </button>
                <button type="button" @click="goTo(2)"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold transition"
                    :class="currentSlide === 2 ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-white border border-[#E5E0D8] text-[#4B6358] hover:border-[#0D3B2E]'">
                    <span class="w-2 h-2 rounded-full" :class="currentSlide === 2 ? 'bg-[#D97706]' : 'bg-gray-300'"></span>
                    <span>2. Info PSB</span>
                </button>
                <button type="button" @click="goTo(3)"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold transition"
                    :class="currentSlide === 3 ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-white border border-[#E5E0D8] text-[#4B6358] hover:border-[#0D3B2E]'">
                    <span class="w-2 h-2 rounded-full" :class="currentSlide === 3 ? 'bg-[#D97706]' : 'bg-gray-300'"></span>
                    <span>3. Warta Terkini</span>
                </button>
            </div>

            <!-- Prev / Next Controls -->
            <div class="flex items-center gap-2">
                <button type="button" @click="prev(); resetAutoplay()"
                    class="p-2.5 rounded-md border border-[#E5E0D8] bg-white text-[#0D3B2E] hover:border-[#0D3B2E] hover:bg-[#FAF8F5] transition shadow-xs"
                    aria-label="Slide Sebelumnya">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <div class="font-mono text-xs text-[#4B6358] px-2 font-semibold">
                    <span x-text="'0' + currentSlide"></span> / 03
                </div>

                <button type="button" @click="next(); resetAutoplay()"
                    class="p-2.5 rounded-md border border-[#E5E0D8] bg-white text-[#0D3B2E] hover:border-[#0D3B2E] hover:bg-[#FAF8F5] transition shadow-xs"
                    aria-label="Slide Berikutnya">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</section>
