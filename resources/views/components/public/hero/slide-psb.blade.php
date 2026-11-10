@props([
    'activeWave' => null,
    'feeMts' => '100.000',
    'feeMdta' => '25.000',
    'isClone' => false,
])

<!-- Slide 2: Informasi PSB 2027/2028 (Clean, Simplified, Matching Height) -->
<div class="w-full shrink-0"
    @if ($isClone) inert aria-hidden="true"
     @else
         :inert="currentSlide !== 2" :aria-hidden="currentSlide !== 2" @endif>
    <div
        class="relative w-full rounded-2xl overflow-hidden h-[390px] sm:h-[420px] md:h-[450px] flex items-center p-6 sm:p-10 lg:p-12 text-white shadow-md">
        <!-- Background Image: Foto Santri -->
        <img src="{{ asset('images/foto-santri-1.webp') }}" alt="Santri Pondok Pesantren Daar El Tazkiyah"
            class="absolute inset-0 w-full h-full object-cover select-none pointer-events-none">

        <!-- Emerald Forest Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#084C27]/95 via-[#0D3B2E]/90 to-[#084C27]/75"></div>
        <div class="absolute inset-0 bg-radial from-transparent via-transparent to-black/30 pointer-events-none"></div>

        <!-- Content (Clean & Simplified) -->
        <div class="relative z-10 max-w-xl space-y-3 sm:space-y-4 text-left">
            <!-- Title -->
            <div class="space-y-1">
                <h2
                    class="font-sans text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    Pendaftaran Santri Baru <br class="hidden sm:inline" />
                    <span class="text-amber-300">Tahun Ajaran {{ $activeWave?->academic_year ?? '2027/2028' }}</span>
                </h2>
            </div>

            <p class="text-xs sm:text-sm md:text-base text-emerald-100/90 leading-relaxed max-w-lg">
                Pendaftaran {{ $activeWave?->name ?? 'Gelombang I' }} Tahun Ajaran
                {{ $activeWave?->academic_year ?? '2027/2028' }} sedang dibuka, Ayo daftar sekarang!
            </p>

            <!-- Action CTAs (Simplified & Clean) -->
            <div class="pt-1 sm:pt-2 flex flex-wrap items-center gap-3">
                <a href="{{ route('psb.form') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 sm:px-6 sm:py-3 rounded-md bg-[#B89758] hover:bg-[#a38347] text-white text-xs sm:text-sm font-bold uppercase tracking-wider transition shadow-sm">
                    <span>Daftar Sekarang &rarr;</span>
                </a>
                <a href="{{ route('psb.fee') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 sm:px-5 sm:py-3 rounded-md bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/30 text-white text-xs sm:text-sm font-semibold transition">
                    <span>Rincian Biaya &rarr;</span>
                </a>
            </div>
        </div>

        <!-- Foto 2 Anak Santri di Samping Kanan -->
        <img src="{{ asset('images/foto-santri.webp') }}" alt="Santri Putra dan Putri Daar El Tazkiyah"
            class="hidden md:block absolute bottom-0 right-4 lg:right-10 z-10 h-[85%] lg:h-[92%] w-auto object-contain object-bottom select-none pointer-events-none drop-shadow-2xl">
    </div>
</div>
