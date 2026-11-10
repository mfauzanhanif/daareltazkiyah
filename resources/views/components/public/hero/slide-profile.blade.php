@props([
    'isClone' => false,
])

<!-- Slide 1: Profil Pesantren & Identitas -->
<div class="w-full shrink-0 px-3 sm:px-5 md:px-6"
     @if($isClone)
         inert aria-hidden="true"
     @else
         :inert="currentSlide !== 1" :aria-hidden="currentSlide !== 1"
     @endif>
    <div class="grid grid-cols-12 gap-x-3 sm:gap-x-6 lg:gap-x-8 gap-y-2 sm:gap-y-3 md:gap-y-4 items-center h-[390px] sm:h-[420px] md:h-[450px]">

        <!-- Element 1: Headline & Motto (Mobile: Row 1 Full Width Col 1-12 | Desktop: Row 1 Col 1-7) -->
        <div class="col-span-12 md:col-span-7 col-start-1 row-start-1 flex flex-col justify-center text-left space-y-1 sm:space-y-2.5">
            @if(!$isClone)
                <h1 class="w-full font-sans tracking-tight">
                    <span class="block text-base min-[380px]:text-lg sm:text-2xl md:text-3xl lg:text-[34px] font-bold text-[#0D3B2E] leading-tight">
                        Pondok Pesantren Modern Tahfidzul Quran
                    </span>
                    <span class="block text-xl min-[380px]:text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#059669] leading-tight mt-0.5 sm:mt-1.5">
                        Daar El Tazkiyah Sumardi
                    </span>
                </h1>
            @else
                <div role="heading" aria-level="1" class="w-full font-sans tracking-tight" aria-hidden="true">
                    <span class="block text-base min-[380px]:text-lg sm:text-2xl md:text-3xl lg:text-[34px] font-bold text-[#0D3B2E] leading-tight">
                        Pondok Pesantren Modern Tahfidzul Quran
                    </span>
                    <span class="block text-xl min-[380px]:text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#059669] leading-tight mt-0.5 sm:mt-1.5">
                        Daar El Tazkiyah Sumardi
                    </span>
                </div>
            @endif

            <!-- Dignified editorial motto -->
            <div class="flex items-center gap-2 sm:gap-3 pt-0.5">
                <span class="w-4 sm:w-8 h-0.5 bg-[#B89758]/80 rounded-full shrink-0" aria-hidden="true"></span>
                <p class="text-xs sm:text-base md:text-lg font-serif italic text-[#B89758] tracking-wide">
                    &ldquo;Bersama Al-Qur'an Meraih Masa Depan Gemilang.&rdquo;
                </p>
            </div>
        </div>

        <!-- Element 2: Description (Mobile: Row 2 Col 1-7 Beside Photo | Desktop: Row 2 Col 1-7 Under Title) -->
        <div class="col-span-7 md:col-span-7 col-start-1 row-start-2 flex flex-col justify-center text-left space-y-1.5 sm:space-y-2">
            <p class="text-[11px] min-[380px]:text-xs sm:text-sm md:text-base text-[#4B6358] leading-relaxed">
                Lembaga pendidikan Islam di Petir, Serang yang membina generasi Qur'ani berakhlak mulia, cerdas, dan mandiri dengan perpaduan kurikulum pesantren dan nasional.
            </p>
            <div class="flex flex-wrap items-center gap-1 sm:gap-1.5 text-[9.5px] sm:text-xs font-mono text-[#059669] font-semibold">
                <span class="bg-emerald-50 px-1.5 py-0.5 rounded">&check; MTs Mukim 24 Jam</span>
                <span class="bg-amber-50 text-[#B89758] px-1.5 py-0.5 rounded">&check; MDT Ula Sore</span>
            </div>
        </div>

        <!-- Element 3: Foto Pengasuh Arch Frame (Mobile: Row 2 Col 8-12 Beside Description | Desktop: Rows 1-2 Col 8-12) -->
        <div class="col-span-5 md:col-span-5 col-start-8 row-start-2 md:row-start-1 md:row-span-2 flex flex-col items-center justify-center relative">
            <div class="relative flex flex-col items-center justify-end w-full max-w-sm">
                <!-- Arch Backdrop with rounded-arch and border-gold-hairline -->
                <div class="relative w-28 min-[380px]:w-34 sm:w-52 md:w-68 lg:w-80 h-38 min-[380px]:h-44 sm:h-64 md:h-78 lg:h-84 rounded-arch border-gold-hairline bg-gradient-to-t from-[#084C27] via-[#0D3B2E] to-[#14532D] shadow-xl overflow-hidden flex items-end justify-center pt-2 sm:pt-6">
                    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,#B89758,transparent_70%)]"></div>

                    @if(file_exists(public_path('images/pengasuh-daar-el-tazkiyah.webp')))
                        <img src="{{ asset('images/pengasuh-daar-el-tazkiyah.webp') }}"
                            alt="Ust. Ahmad Ashil Fadhil, S.H., M.H."
                            class="relative z-10 h-[92%] w-auto max-w-full object-contain object-bottom drop-shadow-2xl select-none pointer-events-none">
                    @elseif(file_exists(public_path('images/pengasuh daar el tazkiyah.webp')))
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
                <div class="relative z-20 -mt-2.5 sm:-mt-4 bg-white/95 backdrop-blur-md border border-gold-hairline px-2 sm:px-4 py-1 sm:py-2 rounded-md sm:rounded-lg shadow-lg text-center max-w-[125px] sm:max-w-[220px] md:max-w-[260px]">
                    <span class="text-[7.5px] sm:text-[9px] md:text-[10px] font-bold tracking-widest text-[#B89758] uppercase block">PENGASUH PESANTREN</span>
                    <h3 class="font-sans font-bold text-[8.5px] sm:text-xs md:text-sm text-[#0D3B2E] tracking-tight leading-tight mt-0.5 truncate">
                        Ust. Ahmad Ashil Fadhil, S.H., M.H.
                    </h3>
                    <p class="text-[7px] sm:text-[9px] text-[#4B6358] font-normal truncate hidden sm:block">
                        PPMTQ Daar El Tazkiyah Sumardi
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
