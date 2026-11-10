<!-- Carousel Bottom Navigation & Persistent Action Buttons (Borderless & Clean) -->
<div class="pt-2 sm:pt-4 flex items-center justify-between gap-2 sm:gap-3 shrink-0 w-full overflow-hidden">
    <!-- Action CTAs: Daftar Sekarang & Profil Pesantren (Single line on mobile) -->
    <div class="flex items-center gap-1.5 sm:gap-2.5 min-w-0">
        <a href="{{ route('psb.form') }}"
            class="inline-flex items-center justify-center px-2.5 min-[360px]:px-3 sm:px-4 py-1.5 sm:py-2 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-[9.5px] min-[360px]:text-[10px] sm:text-xs uppercase tracking-wider whitespace-nowrap transition shadow-xs">
            Daftar Sekarang
        </a>
        <a href="{{ route('profile.index') }}"
            class="inline-flex items-center justify-center px-2.5 min-[360px]:px-3 sm:px-3.5 py-1.5 sm:py-2 rounded-md bg-white hover:bg-[#FAF8F5] text-[#0D3B2E] font-semibold text-[9.5px] min-[360px]:text-[10px] sm:text-xs uppercase tracking-wider whitespace-nowrap transition shadow-xs">
            Profil Pesantren
        </a>
    </div>

    <!-- Right Controls: Prev / Next Arrow Buttons (Clean, Borderless, No Dots) -->
    <div class="flex items-center gap-1 sm:gap-1.5 shrink-0">
        <button type="button" @click="prev(); resetAutoplay()"
            class="p-1.5 sm:p-2 rounded-md bg-white hover:bg-gray-100 text-[#0D3B2E] transition shadow-xs"
            aria-label="Slide Sebelumnya">
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <button type="button" @click="next(); resetAutoplay()"
            class="p-1.5 sm:p-2 rounded-md bg-white hover:bg-gray-100 text-[#0D3B2E] transition shadow-xs"
            aria-label="Slide Berikutnya">
            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>
