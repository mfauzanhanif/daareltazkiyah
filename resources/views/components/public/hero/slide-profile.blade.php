@props([
    'isClone' => false,
])

<!-- Slide 1: Profil Pesantren & Identitas -->
<div class="w-full shrink-0 px-2 sm:px-5 md:px-6"
    @if ($isClone) inert aria-hidden="true"
     @else
         :inert="currentSlide !== 1" :aria-hidden="currentSlide !== 1" @endif>
    <div
        class="grid grid-cols-12 grid-rows-[auto_auto] md:grid-rows-none gap-x-2.5 sm:gap-x-6 lg:gap-x-8 gap-y-2 sm:gap-y-3 md:gap-y-4 items-center content-center h-[390px] sm:h-[420px] md:h-[450px]">

        <!-- Element 1: Headline (Mobile: Row 1 Full Width Col 1-12 | Desktop: Row 1 Col 1-7) -->
        <div class="col-span-12 md:col-span-7 col-start-1 row-start-1 flex flex-col justify-end text-left min-w-0">
            @if (!$isClone)
                <h1 class="w-full font-sans tracking-tight">
                    <span
                        class="block text-xs min-[360px]:text-sm sm:text-lg md:text-xl lg:text-2xl font-bold uppercase tracking-wide text-[#0D3B2E]/90 leading-tight">
                        Pondok Pesantren Modern Tahfidzul Quran
                    </span>
                    <span
                        class="block text-2xl min-[360px]:text-[28px] min-[400px]:text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-[#059669] leading-[1.08] tracking-tight mt-0.5 sm:mt-1">
                        Daar El Tazkiyah Sumardi
                    </span>
                </h1>
            @else
                <div role="heading" aria-level="1" class="w-full font-sans tracking-tight" aria-hidden="true">
                    <span
                        class="block text-xs min-[360px]:text-sm sm:text-lg md:text-xl lg:text-2xl font-bold uppercase tracking-wide text-[#0D3B2E]/90 leading-tight">
                        Pondok Pesantren Modern Tahfidzul Quran
                    </span>
                    <span
                        class="block text-2xl min-[360px]:text-[28px] min-[400px]:text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-[#059669] leading-[1.08] tracking-tight mt-0.5 sm:mt-1">
                        DAAR EL TAZKIYAH SUMARDI
                    </span>
                </div>
            @endif
        </div>

        <!-- Element 2: Tagline & Description (Mobile: Row 2 Col 1-7 Sebelah Kiri Foto Pengasuh | Desktop: Row 2 Col 1-7 Under Title) -->
        <div
            class="col-span-7 md:col-span-7 col-start-1 row-start-2 flex flex-col justify-center text-left space-y-1.5 sm:space-y-2 min-w-0">
            <!-- Tagline / Motto di bawah (sebelah kiri foto pengasuh) -->
            <div class="flex items-center gap-1.5 sm:gap-2.5">
                <span class="w-2.5 sm:w-6 h-0.5 bg-[#B89758] rounded-full shrink-0" aria-hidden="true"></span>
                <p
                    class="text-[11px] min-[360px]:text-xs sm:text-sm md:text-base font-serif italic text-[#B89758] tracking-wide leading-tight">
                    &ldquo;Bersama Al-Qur'an Meraih Masa Depan Gemilang.&rdquo;
                </p>
            </div>

            <!-- Deskripsi Singkat -->
            <p class="text-[10.5px] min-[360px]:text-[11.5px] sm:text-xs md:text-sm text-[#4B6358] leading-relaxed">
                Lembaga pendidikan Islam yang berfokus pada pembentukan generasi Qur'ani. Memadukan kurikulum pendidikan formal dan kepesantrenan untuk mencetak santri yang
                unggul dalam ilmu agama maupun umum, berakhlak mulia, berprestasi, dan siap mengabdi kepada masyarakat.
            </p>
        </div>

        <!-- Element 3: Foto Pengasuh Arch Frame (Mobile: Row 2 Col 8-12 | Desktop: Rows 1-2 Col 8-12) -->
        <div
            class="col-span-5 md:col-span-5 col-start-8 row-start-2 md:row-start-1 md:row-span-2 flex flex-col items-center justify-center relative min-w-0">
            <div class="relative flex flex-col items-center justify-end w-full max-w-full">
                <!-- Arch Backdrop with rounded-arch and border-gold-hairline -->
                <div
                    class="relative w-24 min-[360px]:w-28 min-[400px]:w-32 sm:w-48 md:w-60 lg:w-72 h-36 min-[360px]:h-40 min-[400px]:h-44 sm:h-60 md:h-72 lg:h-80 rounded-arch border-gold-hairline bg-gradient-to-t from-[#084C27] via-[#0D3B2E] to-[#14532D] shadow-lg overflow-hidden flex items-end justify-center pt-2 sm:pt-4">
                    <div
                        class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,#B89758,transparent_70%)]">
                    </div>

                    @if (file_exists(public_path('images/pengasuh-daar-el-tazkiyah.webp')))
                        <img src="{{ asset('images/pengasuh-daar-el-tazkiyah.webp') }}"
                            alt="Ust. Ahmad Ashil Fadhil, S.H., M.H."
                            class="relative z-10 h-[92%] w-auto max-w-full object-contain object-bottom drop-shadow-2xl select-none pointer-events-none">
                    @elseif(file_exists(public_path('images/pengasuh daar el tazkiyah.webp')))
                        <img src="{{ asset('images/pengasuh daar el tazkiyah.webp') }}"
                            alt="Ust. Ahmad Ashil Fadhil, S.H., M.H."
                            class="relative z-10 h-[92%] w-auto max-w-full object-contain object-bottom drop-shadow-2xl select-none pointer-events-none">
                    @else
                        <div class="relative z-10 flex flex-col items-center justify-center text-white/30 h-64">
                            <img src="{{ asset('images/logo_daar_el_tazkiyah.svg') }}" alt="Logo"
                                class="w-20 h-20 opacity-30"
                                onerror="this.onerror=null; this.src='{{ asset('images/logo_daar_el_tazkiyah.png') }}';">
                        </div>
                    @endif
                </div>

                <!-- Floating Name Badge -->
                <div
                    class="relative z-20 -mt-2.5 sm:-mt-3.5 bg-white/95 backdrop-blur-md border border-gold-hairline px-1.5 sm:px-3 py-0.5 sm:py-1.5 rounded sm:rounded-lg shadow-md text-center w-full max-w-[110px] min-[360px]:max-w-[125px] sm:max-w-[200px] md:max-w-[240px]">
                    <span
                        class="text-[7px] sm:text-[8.5px] md:text-[9.5px] font-bold tracking-widest text-[#B89758] uppercase block">PENGASUH
                        PESANTREN</span>
                    <h3
                        class="font-sans font-bold text-[8px] min-[360px]:text-[8.5px] sm:text-xs md:text-sm text-[#0D3B2E] tracking-tight leading-tight mt-0.5 truncate">
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
