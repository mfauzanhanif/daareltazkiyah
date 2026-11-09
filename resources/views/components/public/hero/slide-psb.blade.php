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
                        Termasuk makan 3x sehari, asrama, & pendidikan
                    </p>
                </div>

                <!-- MDTA Card -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-3.5 shadow-2xs">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-xs text-[#0D3B2E]">Jenjang MDTA</span>
                        <span class="text-[9px] font-semibold bg-[#B89758] text-white px-2 py-0.5 rounded">SEKOLAH SORE</span>
                    </div>
                    <div class="text-base sm:text-lg font-extrabold text-[#0D3B2E] mt-1 font-sans">
                        Rp 12.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                    </div>
                    <p class="text-[11px] text-[#4B6358] mt-0.5 leading-tight">
                        Pendidikan diniyah & tahsin tingkat SD
                    </p>
                </div>
            </div>

            <!-- Subtle secondary link -->
            <div class="pt-1">
                <a href="{{ route('psb.status') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] transition">
                    <span>Sudah mendaftar sebelumnya? Cek status pendaftaran</span>
                    <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>

        <!-- Right Visual: Waves & Requirements Breakdown Card -->
        <div class="hidden md:flex md:col-span-5 flex-col items-center">
            <div class="w-full max-w-sm bg-white border border-[#E5E0D8] rounded-md p-4 space-y-3 shadow-sm">
                <div class="border-b border-[#E5E0D8] pb-2 flex items-center justify-between">
                    <span class="text-xs font-bold text-[#0D3B2E] uppercase tracking-wider">JADWAL & BIAYA REGISTRASI</span>
                    <span class="text-xs font-mono text-[#059669] font-bold">2027/2028</span>
                </div>

                <!-- Wave 1 -->
                <div class="p-2.5 rounded-md bg-[#FAF8F5] border-l-4 border-[#059669] space-y-1">
                    <h4 class="font-bold text-xs text-[#0D3B2E]">Gelombang I (Sedang Dibuka)</h4>
                    <p class="text-[11px] text-[#4B6358]">1 Oktober 2026 – 28 Februari 2027</p>
                    <div class="text-[11px] text-[#0D3B2E] font-semibold pt-0.5">
                        Registrasi: MTs Rp {{ $feeMts }} | MDTA Rp {{ $feeMdta }}
                    </div>
                </div>

                <!-- Wave 2 -->
                <div class="p-2.5 rounded-md bg-[#FAF8F5] border-l-4 border-[#B89758] space-y-1">
                    <h4 class="font-bold text-xs text-[#0D3B2E]">Gelombang II</h4>
                    <p class="text-[11px] text-[#4B6358]">1 Maret 2027 – 30 Juni 2027</p>
                    <div class="text-[11px] text-[#0D3B2E] font-semibold pt-0.5">
                        Registrasi: MTs Rp 150.000 | MDTA Rp 30.000
                    </div>
                </div>

                <!-- Requirements Checklist -->
                <div class="pt-2 border-t border-[#E5E0D8] text-[11px] text-[#4B6358]">
                    <span class="font-bold text-[#0D3B2E] block uppercase tracking-wider text-[10px] mb-0.5">Syarat Pendaftaran:</span>
                    Fotokopi Akta Lahir, KK, KTP Orang Tua, Ijazah/SKL, dan Pas Foto 3x4 (2 lembar).
                </div>
            </div>
        </div>
    </div>
</div>
