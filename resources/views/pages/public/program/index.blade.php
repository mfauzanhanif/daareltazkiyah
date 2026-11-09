@extends('layouts.public', ['title' => 'Program Pendidikan & Unggulan - PPMTQ Daar El Tazkiyah Sumardi'])

@section('content')
    <!-- Page Header (Editorial Academic Banner) -->
    <section class="bg-white border-b border-[#E5E0D8] pt-12 pb-14 md:pt-16 md:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#0D3B2E] tracking-tight leading-[1.15]">
                    Program Pendidikan & Kurikulum Terpadu
                </h1>
                <p class="text-base sm:text-lg text-[#4B6358] leading-relaxed">
                    Menyeimbangkan penguasaan hafalan Al-Qur'an mutqin 30 juz, pendalaman kitab kuning salafiyah, disiplin ilmu formal Kemenag RI, serta pengembangan minat bakat santri.
                </p>
                <div class="flex flex-wrap items-center gap-3 pt-2 text-xs font-bold uppercase tracking-wider">
                    <a href="#program-unggulan" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                        &darr; Program Unggulan
                    </a>
                    <a href="#program-pendidikan" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                        &darr; Program Pendidikan (MTs & MDTA)
                    </a>
                    <a href="#ekstrakurikuler" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                        &darr; Ekstrakurikuler
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 1: PROGRAM UNGGULAN -->
    <section id="program-unggulan" class="py-16 md:py-24 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="max-w-3xl space-y-2">
                <span class="editorial-label text-[#059669]">PILAR UTAMA KEUNGGULAN</span>
                <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                    6 Program Unggulan Santri
                </h2>
                <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    Dirancang secara komprehensif untuk mencetak santri huffadz yang berpengetahuan luas, mandiri, dan berakhlak karimah.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Tahfidz Al-Qur'an -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">01</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Mutqin Bersanad</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Tahfidz Al-Qur'an</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Program menghafal Al-Qur'an secara terarah dan mutqin. Menerapkan bimbingan harian dengan target terukur dan sanad tajwid riwayat Hafsh 'an 'Ashim.
                    </p>
                </div>

                <!-- 2. Tahfidz Hadits -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">02</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Sunnah Pilihan</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Tahfidz Hadits</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Menghafal dan memahami hadits-hadits pilihan dari kitab Arbain Nawawiyah dan matan hadits pokok sebagai landasan amaliah sehari-hari.
                    </p>
                </div>

                <!-- 3. Kajian Kitab Kuning -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">03</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-amber-100 text-amber-900 font-semibold">Turats Klasik</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Kajian Kitab Kuning</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pendalaman khazanah keilmuan Islam klasik (Turats) meliputi gramatika nahwu-sharaf (Jurumiyah/Amrithi), fiqih safinatun najah, dan adab.
                    </p>
                </div>

                <!-- 4. Bahasa Arab & Inggris -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">04</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-blue-100 text-blue-900 font-semibold">Bilingual Daily</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Bahasa Arab & Inggris</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pembiasaan komunikasi dwibahasa aktif sehari-hari di lingkungan asrama mukim melalui kosa kata harian (mufradat) dan percakapan (muhadatsah).
                    </p>
                </div>

                <!-- 5. Public Speaking -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">05</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-purple-100 text-purple-900 font-semibold">Muhadharah</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Public Speaking & Da'wah</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pelatihan dakwah, pidato (muhadharah) 3 bahasa, dan retorika berwibawa guna mencetak santri yang siap menyampaikan pesan Al-Qur'an ke masyarakat.
                    </p>
                </div>

                <!-- 6. Pembinaan Akhlak & Kedisiplinan -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">06</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Adab 24 Jam</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Pembinaan Akhlak & Kedisiplinan</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pembentukan karakter santri melalui pembiasaan adab Islami, disiplin ibadah berjamaah di masjid, dan ketertiban tata krama kepesantrenan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: PROGRAM PENDIDIKAN (MTS & MDTA) -->
    <section id="program-pendidikan" class="py-16 md:py-24 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label text-[#059669]">JENJANG FORMAL & NON-MUKIM</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Dua Jalur Pendidikan Resmi
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Pilihan tepat sesuai kebutuhan belajar santri: jenjang MTs berasrama penuh (24 jam) atau jenjang MDTA madrasah diniyah sore untuk anak SD.
                    </p>
                </div>
            </div>

            <!-- Program Comparison 2-Columns -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">

                <!-- 1. MTs Mukim 24 Jam -->
                <div class="bg-[#FAF8F5] border-2 border-[#0D3B2E]/20 rounded-md p-8 relative flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] hover:shadow-md transition">
                    <div class="space-y-6">
                        <div class="border-b border-[#E5E0D8] pb-4">
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <span class="editorial-label text-[#059669]">PENDIDIKAN ASRAMA 24 JAM</span>
                                <span class="text-xs font-mono bg-[#0D3B2E] text-white px-2.5 py-0.5 rounded font-bold">Mukim</span>
                            </div>
                            <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">
                                MTs (Madrasah Tsanawiyah)
                            </h3>
                            <p class="text-xs sm:text-sm text-[#4B6358] mt-2 leading-relaxed">
                                Pendidikan formal setingkat SMP terpadu asrama mukim 24 jam dengan bimbingan asatidz intensif, target 30 juz Al-Qur'an mutqin, dan kurikulum nasional Kementerian Agama RI.
                            </p>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="bg-white p-5 border border-[#E5E0D8] rounded-md space-y-3">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Bulanan (Syahriyah):</span>
                                <span class="text-2xl font-extrabold text-[#0D3B2E] font-sans">
                                    Rp 500.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                                </span>
                            </div>
                            <p class="text-xs text-[#059669] font-medium leading-relaxed">
                                *Sudah termasuk makan 3x sehari, asrama mukim, laundry, air minum steril, dan biaya pendidikan.
                            </p>
                            <div class="flex items-baseline justify-between pt-2 border-t border-[#E5E0D8] text-xs">
                                <span class="text-[#4B6358]">Biaya Pendaftaran PSB:</span>
                                <strong class="text-sm font-bold text-[#B89758] font-sans">Rp {{ $feeMts }}</strong>
                            </div>
                        </div>

                        <!-- Highlights -->
                        <div class="space-y-2 text-xs">
                            <span class="font-bold text-[#0D3B2E] uppercase tracking-wider block">Fasilitas & Keunggulan MTs:</span>
                            <ul class="space-y-2 text-[#18181B]">
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Asrama mukim 24 jam di bawah bimbingan musyrif & asatidz huffadz.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Target hafalan 30 juz mutqin dengan metode sabaq, sabqi, dan manzil.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Ijazah formal Kementerian Agama RI (diakui untuk lanjut ke SMA/MA/Pesantren Tinggi).</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Kajian kitab kuning (fiqih, tajwid, hadits, tauhid) & pembiasaan bahasa Arab-Inggris.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#E5E0D8]">
                        <a href="{{ route('psb.index') }}?program=MTS" class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                            <span>Daftar MTs Mukim Sekarang &rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- 2. MDTA Non-Mukim -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-8 relative flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] hover:shadow-md transition">
                    <div class="space-y-6">
                        <div class="border-b border-[#E5E0D8] pb-4">
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <span class="editorial-label text-[#B89758]">PENDIDIKAN SORE TINGKAT SD</span>
                                <span class="text-xs font-mono bg-[#B89758] text-white px-2.5 py-0.5 rounded font-bold">Non-Mukim</span>
                            </div>
                            <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">
                                MDTA (Madrasah Diniyah Takmiliyah Awaliyah)
                            </h3>
                            <p class="text-xs sm:text-sm text-[#4B6358] mt-2 leading-relaxed">
                                Sekolah sore untuk tingkat Sekolah Dasar (SD/MI) guna memperdalam bacaan Al-Qur'an bertajwid, hafalan Juz 'Amma, praktik ibadah shalat, doa harian, dan akhlak mulia.
                            </p>
                        </div>

                        <!-- Price Breakdown -->
                        <div class="bg-white p-5 border border-[#E5E0D8] rounded-md space-y-3">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Bulanan (Syahriyah):</span>
                                <span class="text-2xl font-extrabold text-[#0D3B2E] font-sans">
                                    Rp 12.000 <span class="text-xs font-normal text-gray-500">/ bulan</span>
                                </span>
                            </div>
                            <p class="text-xs text-[#059669] font-medium leading-relaxed">
                                *Biaya pendidikan madrasah sore yang sangat terjangkau bagi masyarakat sekitar.
                            </p>
                            <div class="flex items-baseline justify-between pt-2 border-t border-[#E5E0D8] text-xs">
                                <span class="text-[#4B6358]">Biaya Pendaftaran PSB:</span>
                                <strong class="text-sm font-bold text-[#B89758] font-sans">Rp {{ $feeMdta }}</strong>
                            </div>
                        </div>

                        <!-- Highlights -->
                        <div class="space-y-2 text-xs">
                            <span class="font-bold text-[#0D3B2E] uppercase tracking-wider block">Materi & Jadwal MDTA:</span>
                            <ul class="space-y-2 text-[#18181B]">
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Jadwal sekolah sore hari ba'da Ashar (Senin – Sabtu, 14.00 – 17.00 WIB).</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Tahsin Al-Qur'an bersanad, makharijul huruf, dan hafalan Juz 30.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Praktik wudhu & sholat berjamaah serta hafalan doa harian ma'tsurat.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="text-[#059669] font-bold">&check;</span>
                                    <span>Pembiasaan adab kepada orang tua, guru, dan teman sejak usia dini.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#E5E0D8]">
                        <a href="{{ route('psb.index') }}?program=MDTA" class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md bg-[#B89758] hover:bg-[#96783e] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                            <span>Daftar MDTA Sore Sekarang &rarr;</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION 3: EKSTRAKURIKULER -->
    <section id="ekstrakurikuler" class="py-16 md:py-24 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label text-[#059669]">PENGEMBANGAN MINAT & BAKAT</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Kegiatan Ekstrakurikuler Santri
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Untuk menunjang kebugaran fisik, jiwa seni Islami, dan kepemimpinan santri di luar ruang kelas.
                    </p>
                </div>
                <span class="text-xs font-mono text-[#059669] font-bold">6 Ekstrakurikuler Resmi</span>
            </div>

            <!-- 6 Extracurricular Cards from PROFIL_DAAR_EL_TAZKIYAH.md -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Pencak Silat -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">01</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Bela Diri</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Pencak Silat</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Seni bela diri tradisional nusantara untuk melatih ketangkasan fisik, pertahanan diri, kedisiplinan mental, dan ketangguhan jasmani santri.
                    </p>
                </div>

                <!-- 2. Hadroh -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">02</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-amber-100 text-amber-900 font-semibold">Seni Sholawat</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Hadroh & Rebana</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Seni tabuh rebana dan lantunan qasidah sholawat nabi untuk menumbuhkan mahabbah kepada Rasulullah SAW dan keindahan seni Islam.
                    </p>
                </div>

                <!-- 3. Kaligrafi -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">03</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-blue-100 text-blue-900 font-semibold">Khat Al-Qur'an</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Kaligrafi (Khattil Qur'an)</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pelatihan menulis ayat-ayat Al-Qur'an dengan kaidah khat Naskhi, Tsuluts, Riq'ah, dan Diwani guna melatih ketelitian dan estetika seni santri.
                    </p>
                </div>

                <!-- 4. Tilawah / Qiro'ah -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">04</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-100 text-[#084C27] font-semibold">Nagham Quran</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Seni Baca Al-Qur'an (Tilawah)</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pendalaman irama lagu tilawah Al-Qur'an (Bayyati, Shoba, Hijaz, Nahawand, Rost, Jiharkah, Sikah) untuk persiapan kafilah MTQ/MHQ.
                    </p>
                </div>

                <!-- 5. Futsal -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">05</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-orange-100 text-orange-900 font-semibold">Olahraga Fisik</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Futsal & Olahraga</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Olahraga tim mingguan untuk menyegarkan pikiran, melatih kekompakan ukhuwah antar santri, dan menjaga stamina tubuh agar tetap bugar.
                    </p>
                </div>

                <!-- 6. Pramuka -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">06</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-stone-100 text-stone-900 font-semibold">Kepanduan</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Pramuka Santri</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Gerakan kepanduan untuk mengasah jiwa kepemimpinan, keterampilan bertahan di alam terbuka, tali temali, sandi, dan cinta tanah air.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
