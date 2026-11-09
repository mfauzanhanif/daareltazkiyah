<!-- Slide 1: Profil Pesantren & Identitas -->
<div class="w-full shrink-0" :inert="currentSlide !== 1" :aria-hidden="currentSlide !== 1">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 items-center">
        <!-- Left: Headline & Information -->
        <div class="md:col-span-7 flex flex-col justify-center space-y-3 sm:space-y-4 text-left">
            <div class="space-y-2 sm:space-y-3">
                <h1 class="font-sans text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#0D3B2E] tracking-tight leading-tight">
                    Pondok Pesantren Modern Tahfidzul Quran <br class="hidden sm:inline" />
                    <span class="text-[#059669]">Daar El Tazkiyah Sumardi</span>
                </h1>

                <!-- Humanized, dignified editorial motto -->
                <div class="flex items-center gap-2.5 sm:gap-3">
                    <span class="w-6 sm:w-8 h-0.5 bg-[#B89758]/80 rounded-full shrink-0" aria-hidden="true"></span>
                    <p class="text-sm sm:text-base md:text-lg font-serif italic text-[#B89758] tracking-wide">
                        &ldquo;Bersama Al-Qur'an Meraih Masa Depan Gemilang.&rdquo;
                    </p>
                </div>
            </div>

            <p class="text-xs sm:text-sm md:text-base text-[#4B6358] max-w-xl leading-relaxed">
                Lembaga pendidikan Islam di Kabupaten Serang, Banten yang memadukan kurikulum pendidikan formal dan kepesantrenan untuk melahirkan generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi, dan siap mengabdi kepada masyarakat.
            </p>
        </div>

        <!-- Right Visual: Arch Frame Pengasuh with Prominent Cutout Photo (Visible on Mobile & Desktop) -->
        <div class="flex md:col-span-5 flex-col items-center justify-center relative mt-4 md:mt-0">
            <div class="relative flex flex-col items-center justify-end w-full max-w-sm">
                <!-- Arch Backdrop with rounded-arch and border-gold-hairline -->
                <div class="relative w-48 sm:w-64 md:w-72 lg:w-80 h-56 sm:h-72 md:h-84 lg:h-88 rounded-arch border-gold-hairline bg-gradient-to-t from-[#084C27] via-[#0D3B2E] to-[#14532D] shadow-xl overflow-hidden flex items-end justify-center pt-4 sm:pt-6">
                    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,#B89758,transparent_70%)]"></div>

                    @if(file_exists(public_path('images/pengasuh daar el tazkiyah.webp')))
                        <img src="{{ asset('images/pengasuh daar el tazkiyah.webp') }}"
                            alt="Ust. Ahmad Ashil Fadhil, S.H., M.H."
                            class="relative z-10 h-[92%] w-auto max-w-full object-contain object-bottom drop-shadow-2xl select-none pointer-events-none">
                    @else
                        <div class="relative z-10 flex flex-col items-center justify-center text-white/30 h-64">
                            <img src="{{ asset('images/logo_daar_el_tazkiyah.svg') }}" alt="Logo" class="w-20 h-20 opacity-30"
                                onerror="this.onerror=null; this.src='{{ asset('images/logo_daar_el_tazkiyah.png') }}';">
                        </div>
                    @endif
                </div>

                <!-- Floating Name Badge -->
                <div class="relative z-20 -mt-4 sm:-mt-5 bg-white/95 backdrop-blur-md border border-gold-hairline px-3 sm:px-4 py-1.5 sm:py-2 rounded-lg shadow-lg text-center max-w-[220px] sm:max-w-[260px]">
                    <span class="text-[9px] sm:text-[10px] font-bold tracking-widest text-[#B89758] uppercase block">PENGASUH PESANTREN</span>
                    <h3 class="font-sans font-bold text-xs sm:text-sm text-[#0D3B2E] tracking-tight leading-tight mt-0.5">
                        Ust. Ahmad Ashil Fadhil, S.H., M.H.
                    </h3>
                    <p class="text-[9px] sm:text-[10px] text-[#4B6358] font-normal">
                        PPMTQ Daar El Tazkiyah Sumardi
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
