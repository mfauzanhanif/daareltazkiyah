@props([
    'activeWave' => null,
    'feeMts' => '100.000',
    'feeMdta' => '25.000',
])

<!-- Slide 2: Informasi PSB 2027/2028 -->
<div class="w-full shrink-0" :inert="currentSlide !== 2" :aria-hidden="currentSlide !== 2">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 items-center">
        <!-- Left: PSB Details -->
        <div class="md:col-span-7 flex flex-col justify-center space-y-3 sm:space-y-4 text-left">
            <div class="space-y-2">
                <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#0D3B2E] tracking-tight leading-tight">
                    Pendaftaran Santri Baru <br class="hidden sm:inline" />
                    <span class="text-[#059669]">Tahun Ajaran {{ $activeWave?->academic_year ?? '2027/2028' }}</span>
                </h2>

                <!-- Gelombang Status (Replaces long paragraph) -->
                <div class="flex items-center gap-2 pt-1">
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm font-semibold shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-[#059669] animate-pulse"></span>
                        <span>{{ $activeWave?->name ?? 'Gelombang I' }} Sedang Dibuka (1 Okt 2026 – 28 Feb 2027)</span>
                    </span>
                </div>
            </div>

            <!-- Fee Comparison Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1 max-w-xl">
                <!-- MTs Card -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-3.5 shadow-2xs">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-xs text-[#0D3B2E]">Jenjang MTs (Mukim)</span>
                        <span class="text-[9px] font-semibold bg-[#0D3B2E] text-white px-2 py-0.5 rounded">24 JAM</span>
                    </div>
                    <div class="text-base sm:text-lg font-extrabold text-[#0D3B2E] mt-1 font-sans">
                        Rp 500.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                    </div>
                    <p class="text-[11px] text-[#059669] mt-0.5 leading-tight">
                        Termasuk makan 3x sehari, asrama &amp; pendidikan
                    </p>
                    <div class="text-[10px] text-[#4B6358] pt-1.5 border-t border-[#E5E0D8]/60 mt-1.5 flex justify-between">
                        <span>Total Masuk Awal:</span>
                        <strong class="text-[#0D3B2E]">Putra Rp 3,25 Jt &bull; Putri Rp 3,35 Jt</strong>
                    </div>
                </div>

                <!-- MDTA Card -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-3.5 shadow-2xs">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-xs text-[#0D3B2E]">Jenjang MDT Ula</span>
                        <span class="text-[9px] font-semibold bg-[#B89758] text-white px-2 py-0.5 rounded">SEKOLAH SORE</span>
                    </div>
                    <div class="text-base sm:text-lg font-extrabold text-[#0D3B2E] mt-1 font-sans">
                        Rp 12.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                    </div>
                    <p class="text-[11px] text-[#4B6358] mt-0.5 leading-tight">
                        Pendidikan diniyah &amp; tahsin tingkat SD
                    </p>
                    <div class="text-[10px] text-[#4B6358] pt-1.5 border-t border-[#E5E0D8]/60 mt-1.5 flex justify-between">
                        <span>Jadwal Belajar:</span>
                        <strong class="text-[#0D3B2E]">Senin – Kamis (13.30–16.10 WIB)</strong>
                    </div>
                </div>
            </div>

            <!-- Action CTAs -->
            <div class="pt-2 flex flex-wrap items-center gap-3">
                <a href="{{ route('psb.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                    <span>Lihat Rincian Biaya &amp; Daftar &rarr;</span>
                </a>
                <a href="{{ route('psb.status') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] transition">
                    <span>Cek Status &rarr;</span>
                </a>
            </div>
        </div>

        <!-- Right Visual: Waves & Requirements Breakdown Card -->
        <div class="hidden md:flex md:col-span-5 flex-col items-center">
            <div class="w-full max-w-sm bg-white border border-[#E5E0D8] rounded-md p-4 space-y-3 shadow-sm">
                <div class="border-b border-[#E5E0D8] pb-2 flex items-center justify-between">
                    <span class="text-xs font-bold text-[#0D3B2E] uppercase tracking-wider">TOTAL BIAYA MASUK SLTP/SMP</span>
                    <span class="text-xs font-mono text-[#059669] font-bold">2027/2028</span>
                </div>

                <!-- Total Cost Highlight -->
                <div class="grid grid-cols-2 gap-2 text-center">
                    <div class="p-2.5 rounded-md bg-[#FAF8F5] border border-[#E5E0D8]">
                        <span class="text-[10px] font-mono text-[#4B6358] uppercase block">Santri Putra</span>
                        <strong class="font-sans font-extrabold text-base text-[#0D3B2E] block mt-0.5">Rp 3.250.000</strong>
                    </div>
                    <div class="p-2.5 rounded-md bg-[#FAF8F5] border border-[#E5E0D8]">
                        <span class="text-[10px] font-mono text-[#4B6358] uppercase block">Santri Putri</span>
                        <strong class="font-sans font-extrabold text-base text-[#0D3B2E] block mt-0.5">Rp 3.350.000</strong>
                    </div>
                </div>

                <!-- Inclusions Checklist -->
                <div class="p-2.5 rounded-md bg-emerald-50/60 border-l-4 border-[#059669] text-[11px] text-[#084C27] space-y-1">
                    <p class="font-semibold">&check; Termasuk kasur, lemari, seragam, buku/kitab, wakaf &amp; iuran bln 1.</p>
                    <p class="text-[10px] text-[#4B6358] italic">*Santri membawa peralatan cuci pakaian mandiri.</p>
                </div>

                <div class="pt-1">
                    <a href="{{ route('psb.index') }}" class="w-full inline-flex items-center justify-center py-2 px-3 rounded-md bg-[#0D3B2E] text-white font-bold text-xs uppercase tracking-wider hover:bg-[#059669] transition">
                        Daftar Santri Baru Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
