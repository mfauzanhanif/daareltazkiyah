@props([
    'activeWave' => null,
])

@php
    $feeMts = $activeWave ? number_format($activeWave->fee_mts, 0, ',', '.') : '100.000';
    $feeMdta = $activeWave ? number_format($activeWave->fee_mdta, 0, ',', '.') : '25.000';
@endphp

<section id="program" class="py-20 md:py-28 bg-white border-y border-[#084C27]/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <span class="text-xs md:text-sm font-semibold uppercase tracking-wider text-[#059669]">Jenjang Pendidikan</span>
            <h2 class="font-serif text-3xl md:text-4xl font-bold text-[#084C27]">Pilihan Program & Struktur Biaya</h2>
            <p class="text-sm md:text-base text-[#4B6358]">Dua program pendidikan unggulan dirancang khusus untuk membina hafalan Al-Qur'an, adab mulia, dan kecerdasan intelektual santri.</p>
            <div class="w-16 h-1 bg-[#D97706] mx-auto rounded-full"></div>
        </div>

        <!-- 2-Column Program Comparison Bento -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto items-stretch">
            
            <!-- Program 1: MTS (Mukim 24 Jam) -->
            <div class="bg-[#FDFBF7] rounded-3xl p-8 border-2 border-[#084C27] shadow-card relative flex flex-col justify-between">
                <!-- Highlight Badge -->
                <div class="absolute -top-4 left-8 px-4 py-1 rounded-full bg-[#084C27] text-white text-xs font-bold tracking-wide shadow-sm border border-gold-hairline">
                    PROGRAM UNGGULAN MUKIM
                </div>

                <div class="space-y-6">
                    <div>
                        <div class="flex items-center justify-between gap-2">
                            <h3 class="font-serif font-bold text-2xl text-[#084C27]">MTS (Mukim 24 Jam)</h3>
                            <span class="px-3 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold">Mukim</span>
                        </div>
                        <p class="text-sm text-[#4B6358] mt-1.5 leading-relaxed">
                            Pendidikan setingkat SMP terpadu asrama penuh 24 jam dengan target mutqin 30 juz Al-Qur'an dan kurikulum formal Kemenag RI.
                        </p>
                    </div>

                    <!-- Price Card -->
                    <div class="bg-white p-5 rounded-2xl border border-[#084C27]/10 space-y-2.5 shadow-2xs">
                        <div class="flex items-baseline justify-between">
                            <span class="text-xs font-semibold text-[#4B6358]">Biaya Bulanan (Syahriah):</span>
                            <span class="text-2xl font-extrabold text-[#084C27] font-sans">
                                Rp 500.000 <span class="text-xs font-normal text-gray-500">/ bln</span>
                            </span>
                        </div>
                        <div class="flex items-baseline justify-between pt-2 border-t border-gray-100">
                            <span class="text-xs font-semibold text-[#4B6358]">Biaya Registrasi PSB:</span>
                            <span class="text-lg font-bold text-[#D97706] font-sans">
                                Rp {{ $feeMts }}
                            </span>
                        </div>
                        <p class="text-[11px] text-[#4B6358]/80 italic">
                            *Biaya pendaftaran otomatis terhubung dengan gelombang aktif yang berlaku.
                        </p>
                    </div>

                    <!-- Feature Checklist -->
                    <div class="space-y-2">
                        <div class="text-xs font-bold text-[#084C27] uppercase tracking-wider">Fasilitas & Kurikulum:</div>
                        <ul class="text-sm space-y-2.5 text-[#1B3A2B]">
                            <li class="flex items-center gap-2.5">
                                <svg class="w-5 h-5 text-[#059669] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Asrama mukim 24 jam dengan bimbingan asatidz intensif</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-5 h-5 text-[#059669] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Makan 3 kali sehari dengan menu bergizi & layanan laundry</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-5 h-5 text-[#059669] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Ijazah formal Madrasah Tsanawiyah (Kementerian Agama RI)</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-5 h-5 text-[#059669] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Ekstrakurikuler: Memanah, beladiri, & pidato dwibahasa (Arab-Inggris)</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="pt-8">
                    <a href="{{ route('psb.index') }}?program=MTS" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#084C27] hover:bg-[#059669] text-white font-semibold text-sm transition shadow-sm">
                        <span>Daftar MTS Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Program 2: MDTA (Sekolah Sore) -->
            <div class="bg-[#FDFBF7] rounded-3xl p-8 border border-[#084C27]/15 shadow-card relative flex flex-col justify-between">
                <div class="space-y-6">
                    <div>
                        <div class="flex items-center justify-between gap-2">
                            <h3 class="font-serif font-bold text-2xl text-[#084C27]">MDTA (Sekolah Sore)</h3>
                            <span class="px-3 py-0.5 rounded-full bg-amber-100 text-amber-800 text-xs font-bold">Non-Mukim</span>
                        </div>
                        <p class="text-sm text-[#4B6358] mt-1.5 leading-relaxed">
                            Madrasah Diniyah Takmiliyah Awaliyah untuk santri non-mukim yang bersekolah di luar dan ingin mendalami ilmu agama serta tahfidz.
                        </p>
                    </div>

                    <!-- Price Card -->
                    <div class="bg-white p-5 rounded-2xl border border-[#084C27]/10 space-y-2.5 shadow-2xs">
                        <div class="flex items-baseline justify-between">
                            <span class="text-xs font-semibold text-[#4B6358]">Biaya Bulanan (SPP):</span>
                            <span class="text-2xl font-extrabold text-[#084C27] font-sans">
                                Rp 12.000 <span class="text-xs font-normal text-gray-500">/ bln</span>
                            </span>
                        </div>
                        <div class="flex items-baseline justify-between pt-2 border-t border-gray-100">
                            <span class="text-xs font-semibold text-[#4B6358]">Biaya Registrasi PSB:</span>
                            <span class="text-lg font-bold text-[#D97706] font-sans">
                                Rp {{ $feeMdta }}
                            </span>
                        </div>
                        <p class="text-[11px] text-[#4B6358]/80 italic">
                            *Biaya pendaftaran otomatis terhubung dengan gelombang aktif yang berlaku.
                        </p>
                    </div>

                    <!-- Feature Checklist -->
                    <div class="space-y-2">
                        <div class="text-xs font-bold text-[#084C27] uppercase tracking-wider">Jadwal & Materi Pelajaran:</div>
                        <ul class="text-sm space-y-2.5 text-[#1B3A2B]">
                            <li class="flex items-center gap-2.5">
                                <svg class="w-5 h-5 text-[#059669] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Jadwal sekolah sore hari ba'da Ashar (Senin sampai Jumat)</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-5 h-5 text-[#059669] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Kurikulum Fiqih Ibadah, Aqidah Akhlak, Tajwid, & Tarikh Islam</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-5 h-5 text-[#059669] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Target hafalan Juz 'Amma dan doa-doa amaliah harian</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="w-5 h-5 text-[#059669] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                <span>Ijazah Madrasah Diniyah Kemenag resmi untuk jenjang lanjutan</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="pt-8">
                    <a href="{{ route('psb.index') }}?program=MDTA" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl border-2 border-[#084C27] text-[#084C27] hover:bg-[#084C27] hover:text-white font-semibold text-sm transition">
                        <span>Daftar MDTA Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
