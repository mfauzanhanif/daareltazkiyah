@props([
    'activeWave' => null,
])

<section class="relative bg-[#FAF8F5] pt-10 pb-16 md:pt-16 md:pb-24 border-b border-[#E5E0D8] overflow-hidden">
    <!-- Subtle architectural hairline grid accent -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">

            <!-- Hero Left: Editorial Academic Typography & Actions -->
            <div class="lg:col-span-7 space-y-6 text-left">
                
                <!-- Arabic Sacred Invocation -->
                <div class="space-y-1">
                    <p class="font-arabic text-2xl sm:text-3xl text-[#B89758] font-bold" dir="rtl" style="line-height: 1.8;">
                        بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                    </p>
                    <div class="flex items-center gap-3 pt-1">
                        <span class="editorial-label">00 — GERBANG PESANTREN MODERN TAHFIDZ</span>
                        <span class="w-8 h-px bg-[#B89758]"></span>
                        <span class="text-xs font-arabic text-[#084C27] font-medium" dir="rtl" style="line-height: 1.8;">
                            معهد دار التزكية سوماردي الإسلامي لتحفيظ القرآن
                        </span>
                    </div>
                </div>

                <!-- Main Institutional Title -->
                <div class="space-y-2">
                    <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-[#0D3B2E] tracking-tight leading-[1.12]">
                        Pondok Pesantren Modern Tahfidzul Quran <br class="hidden sm:block" />
                        <span class="text-[#059669]">Daar El Tazkiyah Sumardi</span>
                    </h1>
                </div>

                <p class="text-base sm:text-lg text-[#4B6358] max-w-2xl leading-relaxed font-sans">
                    Membina generasi huffadz 30 juz Al-Qur'an yang mutqin bersanad, berakhlak mulia, cerdas, berprestasi, dan siap mengabdi untuk umat melalui kurikulum terpadu pesantren salafiyah dan sains modern di Ciampea, Bogor.
                </p>

                <!-- Brief Pengasuh Quote Citation -->
                <div class="border-l-2 border-[#B89758] rounded-r-md pl-4 py-1.5 text-xs sm:text-sm text-[#18181B] italic bg-white/60 max-w-xl">
                    "Menghafal Al-Qur'an adalah perjalanan penyucian jiwa (tazkiyah), menyandingkan adab di atas ilmu, dan melatih kemandirian santri untuk peradaban Islam."
                    <span class="block text-[11px] font-sans font-semibold text-[#084C27] mt-1 not-italic">
                        — Ust. Ahmad Ashil Fadhil, S.H., M.H. (Pengasuh Pondok)
                    </span>
                </div>

                <!-- Dual Action CTAs (No generic badges, subtly rounded dignified buttons) -->
                <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    <a href="{{ route('psb.index') }}" class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition group border border-[#0D3B2E]">
                        <span>Daftar PSB Online</span>
                        <span class="group-hover:translate-x-1 transition-transform" aria-hidden="true">&rarr;</span>
                    </a>
                    <a href="{{ route('academic.mts') }}" class="inline-flex items-center justify-center px-6 py-3.5 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider transition">
                        Eksplorasi Kurikulum
                    </a>
                    <a href="{{ route('psb.status') }}" class="inline-flex items-center justify-center px-5 py-3.5 rounded-md border border-transparent text-[#4B6358] hover:text-[#0D3B2E] text-xs font-semibold uppercase tracking-wider transition">
                        Cek Status &rarr;
                    </a>
                </div>
            </div>

            <!-- Hero Right: Architectural Arch Frame & Integrated Real-time PSB Status Bar -->
            <div class="lg:col-span-5 flex flex-col items-center">
                <div class="relative w-full max-w-md">

                    <!-- Architectural Arch Frame Container (rounded-arch + border-gold-hairline for test requirements) -->
                    <div class="relative bg-white p-3 border-gold-hairline rounded-arch shadow-xs pattern-kufic">
                        <!-- Arch Silhouette Photo Window -->
                        <div class="w-full h-80 sm:h-96 rounded-arch overflow-hidden bg-[#084C27] relative flex flex-col justify-end border border-gold-hairline/60">
                            <!-- Subtle Islamic Silhouette Graphic -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-white/20 pb-16 pointer-events-none">
                                <svg class="w-32 h-32 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                </svg>
                                <span class="font-arabic text-xs text-amber-200/50 mt-1" dir="rtl" style="line-height: 1.8;">فضيلة الشيخ Pengasuh</span>
                            </div>

                            <!-- Leadership Identity Overlay -->
                            <div class="relative z-10 bg-gradient-to-t from-[#084C27] via-[#084C27]/95 to-transparent p-5 text-center text-white">
                                <span class="editorial-label text-amber-300 block text-[10px]">PIMPINAN & PENGASUH PONDOK</span>
                                <h3 class="font-sans font-bold text-lg text-white tracking-tight mt-0.5">
                                    Ust. Ahmad Ashil Fadhil, S.H., M.H.
                                </h3>
                                <p class="text-[11px] text-emerald-100/90 font-medium">
                                    Institut PTIQ Jakarta & Magister Hukum
                                </p>
                                <div class="text-[11px] text-amber-300/80 mt-1 font-arabic" dir="rtl" style="line-height: 1.8;">
                                    حفظه الله تعالى ورعاه
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Integrated Real-time PSB Status Bar (Attached Below Arch) -->
                    <div class="mt-4 bg-white border border-[#E5E0D8] rounded-md p-4 text-xs">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2 mb-2">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-[#D97706]"></span>
                                <span class="editorial-label text-[#0D3B2E]">STATUS PSB TERKINI</span>
                            </div>
                            <span class="text-[11px] font-mono text-[#059669] font-semibold">
                                @if($activeWave)
                                    Pendaftaran Aktif
                                @else
                                    Pendaftaran Ditutup
                                @endif
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs text-[#18181B]">
                            <div>
                                <span class="text-[#4B6358] block">Tahun Akademik:</span>
                                <strong class="text-[#0D3B2E]">{{ $activeWave?->academic_year ?? '2027/2028' }} ({{ $activeWave?->name ?? 'Gelombang I' }})</strong>
                            </div>
                            <a href="{{ route('psb.index') }}" class="inline-flex items-center gap-1 text-[#059669] hover:text-[#0D3B2E] font-semibold transition">
                                <span>Daftar Online</span>
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
