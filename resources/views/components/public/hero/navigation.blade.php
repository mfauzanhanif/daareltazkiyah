<!-- Carousel Bottom Navigation & Persistent Action Buttons -->
<div class="pt-3 sm:pt-4 border-t border-[#E5E0D8] flex items-center justify-between gap-2 sm:gap-3 shrink-0">
    <!-- Action CTAs: Daftar Sekarang & Profil Pesantren (Single line on mobile, no arrow) -->
    <div class="flex items-center gap-1.5 sm:gap-2.5 min-w-0 shrink">
        <a href="{{ route('psb.index') }}"
            class="inline-flex items-center justify-center px-2.5 sm:px-4 py-1.5 sm:py-2 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-[10px] sm:text-xs uppercase tracking-wide sm:tracking-wider whitespace-nowrap transition shadow-xs">
            Daftar Sekarang
        </a>
        <a href="{{ route('profile.index') }}"
            class="inline-flex items-center justify-center px-2.5 sm:px-3.5 py-1.5 sm:py-2 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] hover:bg-[#FAF8F5] text-[#0D3B2E] font-semibold text-[10px] sm:text-xs uppercase tracking-wide sm:tracking-wider whitespace-nowrap transition shadow-xs">
            Profil Pesantren
        </a>
    </div>

    <!-- Right Controls: Clean Slide Dots & Prev/Next Arrows -->
    <div class="flex items-center gap-1.5 sm:gap-3 shrink-0">
        <!-- 3 Dot Indicators -->
        <div class="flex items-center gap-1 sm:gap-1.5 px-0.5 sm:px-1">
            <button type="button" @click="goTo(1)"
                class="h-1.5 sm:h-2 rounded-full transition-all duration-300"
                :class="currentSlide === 1 ? 'w-4 sm:w-6 bg-[#059669]' : 'w-1.5 sm:w-2 bg-[#D1D5DB] hover:bg-gray-400'"
                aria-label="Slide 1: Profil Pesantren">
            </button>
            <button type="button" @click="goTo(2)"
                class="h-1.5 sm:h-2 rounded-full transition-all duration-300"
                :class="currentSlide === 2 ? 'w-4 sm:w-6 bg-[#059669]' : 'w-1.5 sm:w-2 bg-[#D1D5DB] hover:bg-gray-400'"
                aria-label="Slide 2: Penerimaan Santri Baru">
            </button>
            <button type="button" @click="goTo(3)"
                class="h-1.5 sm:h-2 rounded-full transition-all duration-300"
                :class="currentSlide === 3 ? 'w-4 sm:w-6 bg-[#059669]' : 'w-1.5 sm:w-2 bg-[#D1D5DB] hover:bg-gray-400'"
                aria-label="Slide 3: Warta Terkini">
            </button>
        </div>

        <!-- Prev / Next Arrow Buttons -->
        <div class="flex items-center gap-1 sm:gap-1.5">
            <button type="button" @click="prev(); resetAutoplay()"
                class="p-1 sm:p-2 rounded-md border border-[#E5E0D8] bg-white text-[#0D3B2E] hover:border-[#0D3B2E] hover:bg-[#FAF8F5] transition shadow-xs"
                aria-label="Slide Sebelumnya">
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <button type="button" @click="next(); resetAutoplay()"
                class="p-1 sm:p-2 rounded-md border border-[#E5E0D8] bg-white text-[#0D3B2E] hover:border-[#0D3B2E] hover:bg-[#FAF8F5] transition shadow-xs"
                aria-label="Slide Berikutnya">
                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>
