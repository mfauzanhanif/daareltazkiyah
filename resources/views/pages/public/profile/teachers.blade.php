@extends('layouts.public', ['title' => 'Dewan Asatidz & Tenaga Pendidik - PPMTQ Daar El Tazkiyah Sumardi'])

@section('content')
    <!-- Page Header (Editorial Academic Banner) -->
    <section class="bg-white border-b border-[#E5E0D8] pt-12 pb-14 md:pt-16 md:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <div class="flex items-center gap-3">
                    <span class="editorial-label">01 — PROFIL INSTITUSI</span>
                    <span class="w-8 h-px bg-[#B89758]"></span>
                    <span class="text-xs font-mono text-[#4B6358] uppercase tracking-wider">Dewan Guru</span>
                </div>
                <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-bold text-[#0D3B2E] tracking-tight leading-[1.15]">
                    Dewan Asatidz & Tenaga Pendidik
                </h1>
                <p class="text-base sm:text-lg text-[#4B6358] leading-relaxed">
                    Dibimbing langsung oleh para pengajar berpengalaman, huffadz 30 juz Al-Qur'an bersanad, dan lulusan universitas Islam serta perguruan tinggi terkemuka di Indonesia dan Timur Tengah.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <section class="py-16 md:py-24 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <!-- Leadership / Pengasuh Spotlight Card -->
            <div class="bg-white border border-[#E5E0D8] rounded-md p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                    <div class="md:col-span-4 flex justify-center">
                        <div class="w-48 h-60 sm:w-56 sm:h-72 border border-[#B89758] bg-[#0D3B2E] rounded-md overflow-hidden p-2 flex flex-col justify-end text-white relative">
                            <div class="absolute inset-0 flex items-center justify-center text-white/20">
                                <svg class="w-24 h-24 fill-current" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                            </div>
                            <div class="relative z-10 bg-[#0D3B2E]/90 p-3 text-center border-t border-[#B89758]/40">
                                <span class="editorial-label text-amber-200">PENGASUH PONDOK</span>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-8 space-y-4">
                        <div class="space-y-1">
                            <span class="editorial-label">PIMPINAN & PENASIHAT AKADEMIK</span>
                            <h2 class="font-sans text-2xl sm:text-3xl font-bold text-[#0D3B2E]">
                                Ust. Ahmad Ashil Fadhil, S.H., M.H.
                            </h2>
                            <p class="text-sm font-semibold text-[#059669]">
                                Institut PTIQ Jakarta & Magister Ilmu Hukum
                            </p>
                        </div>
                        <p class="text-sm sm:text-base text-[#4B6358] leading-relaxed">
                            Mengemban amanah sebagai Pengasuh Pondok Pesantren Modern Tahfidzul Quran Daar El Tazkiyah Sumardi. Beliau mengampu kajian Fiqih Muamalah, Ulumul Qur'an, dan bimbingan tahsinul qira'ah bersanad, mendampingi santri secara intensif dalam pembentukan adab dan kepemimpinan.
                        </p>
                        <div class="pt-2 flex flex-wrap gap-6 text-xs text-[#18181B] border-t border-[#E5E0D8]">
                            <div>
                                <strong class="text-[#0D3B2E] block">Bidang Keilmuan:</strong>
                                <span>Tahfidz 30 Juz, Qira'at, & Fiqih Islam</span>
                            </div>
                            <div>
                                <strong class="text-[#0D3B2E] block">Almamater:</strong>
                                <span>PTIQ Jakarta & Pascasarjana Hukum</span>
                            </div>
                            <div>
                                <strong class="text-[#0D3B2E] block">Masa Khidmah:</strong>
                                <span>Sejak Pendirian Lembaga</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teachers Roster Grid -->
            <div class="space-y-8">
                <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-4">
                    <div class="space-y-1">
                        <span class="editorial-label">KORPS PENDIDIK</span>
                        <h3 class="font-sans text-2xl font-bold text-[#0D3B2E]">
                            Jajaran Dewan Asatidz & Tenaga Edukatif
                        </h3>
                    </div>
                    <div class="text-xs font-mono text-[#4B6358]">
                        Total: {{ $teachers->count() }} Asatidz Aktif
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($teachers as $teacher)
                        <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-4 hover:border-[#0D3B2E] transition">
                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 bg-[#FAF8F5] border border-[#E5E0D8] rounded-md shrink-0 flex items-center justify-center font-sans text-xl font-bold text-[#0D3B2E]">
                                    {{ Str::substr($teacher->full_name, 0, 1) }}
                                </div>
                                <div class="space-y-0.5">
                                    <h4 class="font-sans font-bold text-base text-[#0D3B2E] leading-snug">
                                        {{ $teacher->full_name }}
                                    </h4>
                                    <p class="text-xs font-medium text-[#059669]">
                                        {{ $teacher->role_title }}
                                    </p>
                                </div>
                            </div>
                            <p class="text-xs text-[#4B6358] leading-relaxed line-clamp-3">
                                {{ $teacher->bio ?? 'Tenaga pendidik dan pembina halaqah tahfidzul quran santri di PPMTQ Daar El Tazkiyah Sumardi.' }}
                            </p>
                            <div class="pt-3 border-t border-[#E5E0D8] flex items-center justify-between text-[11px] text-[#4B6358]">
                                <span class="font-mono">Pendidik Bersertifikasi</span>
                                <span class="text-[#0D3B2E] font-semibold">Aktif Mengajar</span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 bg-white border border-[#E5E0D8] rounded-md p-8 text-sm text-[#4B6358]">
                            Belum ada data dewan guru yang dipublikasikan saat ini.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Teaching Philosophy Banner -->
            <div class="bg-white border-l-4 border-[#B89758] border-y border-r border-[#E5E0D8] rounded-r-md p-8 space-y-3">
                <span class="editorial-label">METODE PENGASUHAN</span>
                <h4 class="font-sans text-xl font-bold text-[#0D3B2E]">
                    Keteladanan Hidup 24 Jam Bersama Santri
                </h4>
                <p class="text-sm text-[#4B6358] leading-relaxed max-w-4xl">
                    Para asatidz mukim tidak sekadar mengajar di dalam kelas, melainkan mendampingi para santri dalam sholat berjamaah lima waktu, halaqah shubuh dan maghrib, makan bersama di ruang asrama, hingga evaluasi hafalan malam hari, memastikan adab dan sunnah Rasulullah ﷺ tertanam secara hidup.
                </p>
            </div>

        </div>
    </section>
@endsection
