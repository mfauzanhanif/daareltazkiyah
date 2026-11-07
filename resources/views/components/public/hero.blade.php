@props([
    'activeWave' => null,
])

<section class="relative overflow-hidden bg-gradient-to-b from-white via-[#FDFBF7] to-[#FDFBF7] pt-12 pb-20 md:pt-20 md:pb-32 border-b border-[#084C27]/10">
    <!-- Background subtle geometric / arabesque accent with 5% Kufic pattern -->
    <div class="absolute inset-0 opacity-40 pattern-kufic pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Hero Left: Typography & CTAs -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <!-- Institution Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#084C27]/5 border border-[#084C27]/15 text-[#084C27] text-xs md:text-sm font-semibold tracking-wide shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-[#059669] animate-pulse"></span>
                    <span>Lembaga Pendidikan Kader Ulama & Tahfidzul Qur'an</span>
                </div>

                <!-- Arabic Sacred Calligraphy (Amiri typography, dir="rtl", line-height 1.8) -->
                <div class="space-y-1">
                    <p class="font-arabic text-2xl sm:text-3xl text-[#D97706] font-bold" dir="rtl" style="line-height: 1.8;">
                        بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                    </p>
                    <p class="font-arabic text-sm sm:text-base md:text-lg text-[#084C27]/80 font-medium" dir="rtl" style="line-height: 1.8;">
                        معهد دار التزكية سوماردي الإسلامي لتحفيظ القرآن
                    </p>
                </div>

                <!-- Main Institutional Title -->
                <div>
                    <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-[#084C27] tracking-tight leading-[1.15]">
                        Pondok Pesantren Modern Tahfidzul Quran <br class="hidden sm:block" />
                        <span class="text-[#059669]">Daar El Tazkiyah Sumardi</span>
                    </h1>
                </div>

                <p class="text-base sm:text-lg text-[#1B3A2B]/85 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-sans">
                    Mendidik generasi huffadz yang berilmu, berakhlak mulia, cerdas, berprestasi, dan siap mengabdi untuk umat dengan kurikulum terintegrasi pesantren modern, tahfidz 30 juz mutqin, dan sains modern di Ciampea, Bogor.
                </p>

                <!-- CTAs & Wave Status -->
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="{{ route('psb.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-xl bg-[#D97706] hover:bg-[#B45309] text-white font-semibold text-base shadow-elevated hover:shadow-glow-amber transition-all transform hover:-translate-y-0.5">
                        <span>Daftar PSB Online</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                    <a href="#program" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 rounded-xl border border-[#084C27]/25 text-[#084C27] hover:bg-[#084C27]/5 font-semibold text-base transition">
                        Pelajari Program
                    </a>
                </div>

                @if($activeWave)
                    <div class="pt-2 text-xs text-[#4B6358] flex items-center justify-center lg:justify-start gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>Gelombang aktif: <strong class="text-[#084C27]">{{ $activeWave->name }} (TA {{ $activeWave->academic_year }})</strong> s.d {{ \Carbon\Carbon::parse($activeWave->end_date)->translatedFormat('d F Y') }}</span>
                    </div>
                @endif
            </div>

            <!-- Hero Right: Pengasuh Portrait in Architectural Arch Frame -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative group">
                    <!-- Atmospheric Ambient Arch Glow -->
                    <div class="absolute -inset-3 bg-gradient-to-t from-[#D97706]/35 via-[#059669]/20 to-[#084C27]/25 rounded-arch blur-2xl opacity-70 group-hover:opacity-100 transition duration-500 pointer-events-none"></div>

                    <!-- Arch Frame Container with 1.5px Gold Hairline Ring and 5% Kufic Pattern -->
                    <div class="relative bg-white p-3.5 md:p-4 rounded-arch shadow-elevated border-gold-hairline pattern-kufic">
                        <!-- Architectural Arch Silhouette Container -->
                        <div class="w-64 h-84 sm:w-72 sm:h-96 md:w-80 md:h-[430px] rounded-arch overflow-hidden bg-gradient-to-br from-[#084C27] via-[#059669] to-[#084C27] relative flex flex-col justify-end border border-gold-hairline/60">
                            <!-- Subtle 5% Kufic Pattern Overlay inside arch -->
                            <div class="absolute inset-0 pattern-kufic pointer-events-none opacity-60"></div>

                            <!-- Styled Islamic Portrait Silhouette / Monogram Illustration -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-white/25 pb-16">
                                <svg class="w-36 h-36 md:w-44 md:h-44 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                </svg>
                                <span class="font-arabic text-xs text-amber-200/50 mt-1" dir="rtl">فضيلة الشيخ</span>
                            </div>

                            <!-- Leadership Identity & Credentials Card -->
                            <div class="relative z-10 bg-gradient-to-t from-[#084C27] via-[#084C27]/95 to-transparent p-6 text-center text-white">
                                <div class="inline-block px-3 py-0.5 rounded-full bg-[#D97706]/30 border border-[#D97706]/50 text-[11px] font-semibold tracking-wider text-amber-200 mb-1.5 uppercase">
                                    Pengasuh Pondok Pesantren
                                </div>
                                <h3 class="font-serif font-bold text-lg md:text-xl text-white tracking-tight">
                                    Ust. Ahmad Ashil Fadhil, S.H., M.H.
                                </h3>
                                <p class="text-xs text-emerald-100/90 mt-1 font-medium">
                                    Institut PTIQ Jakarta & Magister Hukum
                                </p>
                                <div class="text-[11px] text-amber-300/80 mt-1 font-arabic" dir="rtl" style="line-height: 1.8;">
                                    حفظه الله تعالى ورعاه
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
