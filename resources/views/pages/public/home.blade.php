@extends('layouts.public')

@section('content')
    <!-- 0. HERO SECTION (SPLIT-SCREEN EDITORIAL) -->
    <x-public.hero :activeWave="$activeWave" />

    <!-- 1. PROFIL & 3 PILAR NILAI UTAMA (INTERACTIVE EDITORIAL ACCORDION) -->
    <section class="py-16 md:py-24 bg-white border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Left Column: Vision Statement & Institutional Anchor -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="space-y-2">
                        <span class="editorial-label">01 — PROFIL & NILAI UTAMA</span>
                        <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#0D3B2E] tracking-tight leading-snug">
                            Visi & Haluan Pendidikan Pesantren
                        </h2>
                    </div>

                    <!-- Visi Quote Box -->
                    <div class="bg-[#FAF8F5] border-l-4 border-[#0D3B2E] p-6 space-y-3">
                        <span class="editorial-label text-[#059669]">VISI UTAMA</span>
                        <blockquote class="font-serif text-lg sm:text-xl font-bold text-[#0D3B2E] leading-relaxed">
                            "{{ "Melahirkan generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi dan siap mengabdi untuk umat." }}"
                        </blockquote>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Pijakan pembentukan santri mutafaqqih fiddin, tangguh mental, mandiri, dan berwawasan luas di Ciampea, Bogor.
                        </p>
                    </div>

                    <p class="text-sm text-[#4B6358] leading-relaxed">
                        Kami memadukan kedalaman tradisi kajian kitab kuning salafiyah dengan ketertiban kurikulum madrasah formal Kemenag RI, dipandu keteladanan asatidz 24 jam.
                    </p>

                    <div class="pt-2">
                        <a href="{{ route('profile.sejarah') }}" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-[#0D3B2E] hover:text-[#059669] transition group">
                            <span>Pelajari Sejarah & Nilai Lembaga Selengkapnya</span>
                            <span class="group-hover:translate-x-1 transition-transform" aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Interactive 4-Misi Accordion -->
                <div class="lg:col-span-7 space-y-3" x-data="{ activeMisi: 1 }">
                    <div class="border-b border-[#E5E0D8] pb-3 mb-4 flex items-center justify-between">
                        <span class="editorial-label">4 PILAR MISI PENDIDIKAN</span>
                        <span class="text-xs font-mono text-[#4B6358]">Klik untuk membuka rincian</span>
                    </div>

                    <!-- Misi 1 -->
                    <div class="border border-[#E5E0D8] bg-[#FAF8F5] transition">
                        <button type="button" @click="activeMisi = (activeMisi === 1 ? 0 : 1)" class="w-full p-5 text-left flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="font-mono text-xs font-bold text-[#B89758]">01</span>
                                <h3 class="font-serif font-bold text-base sm:text-lg text-[#0D3B2E]">
                                    {{ "Menanamkan kecintaan kepada Al-Qur'an" }}
                                </h3>
                            </div>
                            <span class="text-sm text-[#0D3B2E] transition-transform duration-200" :class="{ 'rotate-180': activeMisi === 1 }">&darr;</span>
                        </button>
                        <div x-show="activeMisi === 1" x-collapse class="px-5 pb-5 pt-1 text-xs sm:text-sm text-[#4B6358] border-t border-[#E5E0D8] leading-relaxed bg-white">
                            Membimbing hafalan 30 juz Al-Qur'an dengan kaidah tahsin bersanad, tadabbur makna ayat, dan pembiasaan muraja'ah harian secara disiplin melalui metode sabaq, sabqi, dan manzil.
                        </div>
                    </div>

                    <!-- Misi 2 -->
                    <div class="border border-[#E5E0D8] bg-[#FAF8F5] transition">
                        <button type="button" @click="activeMisi = (activeMisi === 2 ? 0 : 2)" class="w-full p-5 text-left flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="font-mono text-xs font-bold text-[#B89758]">02</span>
                                <h3 class="font-serif font-bold text-base sm:text-lg text-[#0D3B2E]">
                                    {{ "Membentuk akhlak mulia dan disiplin" }}
                                </h3>
                            </div>
                            <span class="text-sm text-[#0D3B2E] transition-transform duration-200" :class="{ 'rotate-180': activeMisi === 2 }">&darr;</span>
                        </button>
                        <div x-show="activeMisi === 2" x-collapse class="px-5 pb-5 pt-1 text-xs sm:text-sm text-[#4B6358] border-t border-[#E5E0D8] leading-relaxed bg-white" style="display: none;">
                            Menegakkan keteladanan adab Islami, disiplin ibadah fardhu & sunnah berjamaah di masjid, serta pembiasaan hidup mandiri dan bertanggung jawab di lingkungan asrama santri.
                        </div>
                    </div>

                    <!-- Misi 3 -->
                    <div class="border border-[#E5E0D8] bg-[#FAF8F5] transition">
                        <button type="button" @click="activeMisi = (activeMisi === 3 ? 0 : 3)" class="w-full p-5 text-left flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="font-mono text-xs font-bold text-[#B89758]">03</span>
                                <h3 class="font-serif font-bold text-base sm:text-lg text-[#0D3B2E]">
                                    {{ "Memberikan pendidikan berkualitas berbasis Islam" }}
                                </h3>
                            </div>
                            <span class="text-sm text-[#0D3B2E] transition-transform duration-200" :class="{ 'rotate-180': activeMisi === 3 }">&darr;</span>
                        </button>
                        <div x-show="activeMisi === 3" x-collapse class="px-5 pb-5 pt-1 text-xs sm:text-sm text-[#4B6358] border-t border-[#E5E0D8] leading-relaxed bg-white" style="display: none;">
                            Menggabungkan kurikulum keagamaan muadalah pesantren dengan standar nasional Kementerian Agama RI serta wawasan sains, teknologi, dan bahasa Arab-Inggris terkini.
                        </div>
                    </div>

                    <!-- Misi 4 -->
                    <div class="border border-[#E5E0D8] bg-[#FAF8F5] transition">
                        <button type="button" @click="activeMisi = (activeMisi === 4 ? 0 : 4)" class="w-full p-5 text-left flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="font-mono text-xs font-bold text-[#B89758]">04</span>
                                <h3 class="font-serif font-bold text-base sm:text-lg text-[#0D3B2E]">
                                    {{ "Mempersiapkan santri berprestasi di tingkat nasional" }}
                                </h3>
                            </div>
                            <span class="text-sm text-[#0D3B2E] transition-transform duration-200" :class="{ 'rotate-180': activeMisi === 4 }">&darr;</span>
                        </button>
                        <div x-show="activeMisi === 4" x-collapse class="px-5 pb-5 pt-1 text-xs sm:text-sm text-[#4B6358] border-t border-[#E5E0D8] leading-relaxed bg-white" style="display: none;">
                            Mengasah potensi santri dalam Musabaqah Hifdzil Qur'an (MHQ), olimpiade sains madrasah, pidato dwibahasa asing, serta kepemimpinan umat untuk masa depan.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 2. CAPAIAN AKADEMIK & PROGRAM COMPARISON (EDITORIAL GRID) -->
    <section id="program" class="py-16 md:py-24 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- Section Title -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label">02 — PROGRAM AKADEMIK & KEHIDUPAN SANTRI</span>
                    <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#0D3B2E] tracking-tight">
                        Pilihan Jenjang & Rutinitas 24 Jam
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Dua program pendidikan unggulan dirancang khusus untuk membina hafalan Al-Qur'an, adab mulia, dan kecerdasan intelektual santri.
                    </p>
                </div>
                <div class="flex items-center gap-4 text-xs font-semibold text-[#0D3B2E]">
                    <a href="{{ route('academic.mts') }}" class="hover:text-[#059669] transition">Silabus MTS &rarr;</a>
                    <a href="{{ route('academic.mdta') }}" class="hover:text-[#059669] transition">Silabus MDTA &rarr;</a>
                    <a href="{{ route('academic.tahfidz') }}" class="hover:text-[#059669] transition">Kurikulum Tahfidz &rarr;</a>
                </div>
            </div>

            <!-- 2-Column Program Comparison Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">

                <!-- Program 1: MTS (Mukim 24 Jam) -->
                <div class="bg-white border border-[#E5E0D8] p-8 relative flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] transition">
                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center justify-between gap-2 border-b border-[#E5E0D8] pb-2 mb-2">
                                <span class="editorial-label text-[#059669]">PROGRAM UNGGULAN MUKIM</span>
                                <span class="text-xs font-mono text-[#0D3B2E] font-semibold">Mukim</span>
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <h3 class="font-serif font-bold text-2xl text-[#0D3B2E]">MTS (Mukim 24 Jam)</h3>
                            </div>
                            <p class="text-xs sm:text-sm text-[#4B6358] mt-2 leading-relaxed">
                                Pendidikan setingkat SMP terpadu asrama penuh 24 jam dengan target mutqin 30 juz Al-Qur'an dan kurikulum formal Kemenag RI.
                            </p>
                        </div>

                        <!-- Price Card -->
                        <div class="bg-[#FAF8F5] p-5 border border-[#E5E0D8] space-y-2.5">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Bulanan (Syahriah):</span>
                                <span class="text-2xl font-bold text-[#0D3B2E] font-sans">
                                    Rp 500.000 <span class="text-xs font-normal text-gray-500">/ bln</span>
                                </span>
                            </div>
                            <div class="flex items-baseline justify-between pt-2 border-t border-[#E5E0D8]">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Registrasi PSB:</span>
                                <span class="text-lg font-bold text-[#B89758] font-sans">
                                    Rp {{ $feeMts }}
                                </span>
                            </div>
                            <p class="text-[11px] text-[#4B6358]/80 italic">
                                *Biaya pendaftaran otomatis terhubung dengan gelombang aktif yang berlaku.
                            </p>
                        </div>

                        <!-- Features -->
                        <div class="space-y-2">
                            <div class="text-xs font-bold text-[#0D3B2E] uppercase tracking-wider">Fasilitas & Kurikulum:</div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Asrama mukim 24 jam dengan bimbingan asatidz intensif</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Makan 3 kali sehari dengan menu bergizi & layanan laundry</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Ijazah formal Madrasah Tsanawiyah (Kementerian Agama RI)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Ekstrakurikuler: Memanah, beladiri, & pidato dwibahasa (Arab-Inggris)</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-[#E5E0D8]">
                        <a href="{{ route('psb.index') }}?program=MTS" class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-semibold uppercase tracking-wider transition">
                            <span>Daftar MTS Sekarang</span>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Program 2: MDTA (Sekolah Sore) -->
                <div class="bg-white border border-[#E5E0D8] p-8 relative flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] transition">
                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center justify-between gap-2 border-b border-[#E5E0D8] pb-2 mb-2">
                                <span class="editorial-label text-[#B89758]">PENDIDIKAN DINIYAH SORE</span>
                                <span class="text-xs font-mono text-[#B89758] font-semibold">Non-Mukim</span>
                            </div>
                            <div class="flex items-center justify-between gap-2">
                                <h3 class="font-serif font-bold text-2xl text-[#0D3B2E]">MDTA (Sekolah Sore)</h3>
                            </div>
                            <p class="text-xs sm:text-sm text-[#4B6358] mt-2 leading-relaxed">
                                Madrasah Diniyah Takmiliyah Awaliyah sore hari untuk santri non-mukim guna memperkuat hafalan juz 'amma, akidah, akhlak, dan tata cara ibadah harian.
                            </p>
                        </div>

                        <!-- Price Card -->
                        <div class="bg-[#FAF8F5] p-5 border border-[#E5E0D8] space-y-2.5">
                            <div class="flex items-baseline justify-between">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Bulanan (Syahriah):</span>
                                <span class="text-2xl font-bold text-[#0D3B2E] font-sans">
                                    Rp 12.000 <span class="text-xs font-normal text-gray-500">/ bln</span>
                                </span>
                            </div>
                            <div class="flex items-baseline justify-between pt-2 border-t border-[#E5E0D8]">
                                <span class="text-xs font-semibold text-[#4B6358]">Biaya Registrasi PSB:</span>
                                <span class="text-lg font-bold text-[#B89758] font-sans">
                                    Rp {{ $feeMdta }}
                                </span>
                            </div>
                            <p class="text-[11px] text-[#4B6358]/80 italic">
                                *Sesuai gelombang penerimaan santri baru yang berlaku.
                            </p>
                        </div>

                        <!-- Features -->
                        <div class="space-y-2">
                            <div class="text-xs font-bold text-[#0D3B2E] uppercase tracking-wider">Materi & Jadwal Belajar:</div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Jadwal sekolah sore hari ba'da Ashar (Senin s/d Kamis & Sabtu, 14.00 – 17.00 WIB)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Tahsin Al-Qur'an bersanad & hafalan Juz 30</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Praktik sholat berjamaah & doa zikir harian ma'tsurat</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                    <span>Pembiasaan adab dan akhlakul karimah sejak dini</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-[#E5E0D8]">
                        <a href="{{ route('psb.index') }}?program=MDTA" class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-semibold uppercase tracking-wider transition">
                            <span>Daftar MDTA Sekarang</span>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Interactive 24-Hour Santri Daily Routine Timeline -->
            <div class="bg-white border border-[#E5E0D8] p-8 space-y-6">
                <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-4">
                    <div class="space-y-1">
                        <span class="editorial-label">LINI MASA 24 JAM</span>
                        <h4 class="font-serif font-bold text-xl sm:text-2xl text-[#0D3B2E]">
                            Jadwal Rutinitas Harian Santri Mukim
                        </h4>
                    </div>
                    <span class="text-xs font-mono text-[#4B6358] hidden sm:inline">Senin s/d Sabtu</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="p-4 border border-[#E5E0D8] bg-[#FAF8F5] space-y-1.5">
                        <span class="font-mono text-xs font-bold text-[#B89758]">03.30 – 05.00</span>
                        <h5 class="font-serif font-bold text-sm text-[#0D3B2E]">Qiyamullail & Subuh</h5>
                        <p class="text-[11px] text-[#4B6358] leading-relaxed">Tahajjud, witir, sholat Subuh berjamaah, zikir ma'tsurat, dan persiapan halaqah.</p>
                    </div>
                    <div class="p-4 border border-[#E5E0D8] bg-[#FAF8F5] space-y-1.5">
                        <span class="font-mono text-xs font-bold text-[#B89758]">05.00 – 06.30</span>
                        <h5 class="font-serif font-bold text-sm text-[#0D3B2E]">Halaqah Sabaq Pagi</h5>
                        <p class="text-[11px] text-[#4B6358] leading-relaxed">Setoran hafalan baru Al-Qur'an di hadapan asatidz pembina kelompok halaqah.</p>
                    </div>
                    <div class="p-4 border border-[#E5E0D8] bg-[#FAF8F5] space-y-1.5">
                        <span class="font-mono text-xs font-bold text-[#B89758]">07.00 – 12.30</span>
                        <h5 class="font-serif font-bold text-sm text-[#0D3B2E]">KBM Formal MTS</h5>
                        <p class="text-[11px] text-[#4B6358] leading-relaxed">Pembelajaran kurikulum nasional Kemenag RI (sains, matematika, bahasa, dll).</p>
                    </div>
                    <div class="p-4 border border-[#E5E0D8] bg-[#FAF8F5] space-y-1.5">
                        <span class="font-mono text-xs font-bold text-[#B89758]">18.00 – 20.30</span>
                        <h5 class="font-serif font-bold text-sm text-[#0D3B2E]">Maghrib & Kitab Salaf</h5>
                        <p class="text-[11px] text-[#4B6358] leading-relaxed">Sholat berjamaah, muraja'ah Al-Qur'an, dan kajian kitab kuning fiqih/tajwid.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 3. PSB ACTIVE HUB & FAST FEE SIMULATOR -->
    <section class="py-16 md:py-24 bg-white border-b border-[#E5E0D8]" x-data="{ psbStep: 1, simProgram: 'MTS' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

            <!-- Section Title -->
            <div class="max-w-3xl space-y-2">
                <span class="editorial-label">03 — PENERIMAAN SANTRI BARU (PSB)</span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#0D3B2E] tracking-tight">
                    Portal Aktif & Alur Pendaftaran Santri Baru
                </h2>
                <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    Sistem pendaftaran transparan terintegrasi. Calon wali santri dapat memeriksa alur 4 langkah, berkas persyaratan, dan kalkulasi estimasi biaya langsung dari beranda.
                </p>
            </div>

            <!-- Stepper + Simulator Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- Left: Clickable 4-Step Stepper -->
                <div class="lg:col-span-7 bg-[#FAF8F5] border border-[#E5E0D8] p-8 space-y-6">
                    <div class="border-b border-[#E5E0D8] pb-3 flex items-center justify-between">
                        <span class="editorial-label">ALUR 4 TAHAP PENDAFTARAN</span>
                        <span class="text-xs font-mono text-[#4B6358]">Klik tiap langkah</span>
                    </div>

                    <!-- Step Navigator Tabs -->
                    <div class="grid grid-cols-4 gap-2">
                        <button type="button" @click="psbStep = 1" :class="psbStep === 1 ? 'border-[#0D3B2E] bg-white text-[#0D3B2E]' : 'border-[#E5E0D8] bg-transparent text-[#4B6358]'" class="p-2 sm:p-3 border rounded-md text-center transition">
                            <span class="font-mono text-xs block font-bold">01</span>
                            <span class="text-[10px] sm:text-xs font-semibold uppercase block truncate">Daftar Akun</span>
                        </button>
                        <button type="button" @click="psbStep = 2" :class="psbStep === 2 ? 'border-[#0D3B2E] bg-white text-[#0D3B2E]' : 'border-[#E5E0D8] bg-transparent text-[#4B6358]'" class="p-2 sm:p-3 border rounded-md text-center transition">
                            <span class="font-mono text-xs block font-bold">02</span>
                            <span class="text-[10px] sm:text-xs font-semibold uppercase block truncate">Unggah Berkas</span>
                        </button>
                        <button type="button" @click="psbStep = 3" :class="psbStep === 3 ? 'border-[#0D3B2E] bg-white text-[#0D3B2E]' : 'border-[#E5E0D8] bg-transparent text-[#4B6358]'" class="p-2 sm:p-3 border rounded-md text-center transition">
                            <span class="font-mono text-xs block font-bold">03</span>
                            <span class="text-[10px] sm:text-xs font-semibold uppercase block truncate">Observasi</span>
                        </button>
                        <button type="button" @click="psbStep = 4" :class="psbStep === 4 ? 'border-[#0D3B2E] bg-white text-[#0D3B2E]' : 'border-[#E5E0D8] bg-transparent text-[#4B6358]'" class="p-2 sm:p-3 border rounded-md text-center transition">
                            <span class="font-mono text-xs block font-bold">04</span>
                            <span class="text-[10px] sm:text-xs font-semibold uppercase block truncate">Kelulusan</span>
                        </button>
                    </div>

                    <!-- Step Content Panes -->
                    <div class="bg-white border border-[#E5E0D8] p-6 space-y-3">
                        <div x-show="psbStep === 1" class="space-y-2">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <h4 class="font-serif font-bold text-base text-[#0D3B2E]">Langkah 1: Pengisian Formulir & Akun Online</h4>
                                <span class="editorial-label text-[#059669]">TAHAP AWAL</span>
                            </div>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Wali santri mengisi biodata lengkap calon santri (nama, NIK, NISN, riwayat sekolah asal) serta kontak orang tua di portal PSB Online, lalu mengunduh bukti tanda terima pendaftaran.
                            </p>
                        </div>

                        <div x-show="psbStep === 2" class="space-y-2" style="display: none;">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <h4 class="font-serif font-bold text-base text-[#0D3B2E]">Langkah 2: Kelengkapan Dokumen & Persyaratan</h4>
                                <span class="editorial-label text-[#059669]">BERKAS ADM</span>
                            </div>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Mengunggah scan dokumen asli: Kartu Keluarga (KK), Akta Kelahiran, Surat Keterangan Lulus / Raport terakhir, pas foto formal berseragam, dan bukti pembayaran biaya seleksi.
                            </p>
                        </div>

                        <div x-show="psbStep === 3" class="space-y-2" style="display: none;">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <h4 class="font-serif font-bold text-base text-[#0D3B2E]">Langkah 3: Observasi Al-Qur'an & Wawancara</h4>
                                <span class="editorial-label text-[#059669]">TES SELEKSI</span>
                            </div>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Pelaksanaan tes bacaan Al-Qur'an (tahsin), tes daya ingat hafalan ayat baru, serta wawancara komitmen calon santri dan orang tua bersama dewan asatidz di kampus Ciampea.
                            </p>
                        </div>

                        <div x-show="psbStep === 4" class="space-y-2" style="display: none;">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <h4 class="font-serif font-bold text-base text-[#0D3B2E]">Langkah 4: Pengumuman Kelulusan & Registrasi Ulang</h4>
                                <span class="editorial-label text-[#059669]">DAFTAR ULANG</span>
                            </div>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Pengumuman hasil seleksi dapat dicek secara langsung melalui fitur Cek Status PSB. Santri yang dinyatakan diterima melakukan registrasi ulang dan persiapan masuk asrama mukim.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <a href="{{ route('psb.status') }}" class="text-xs font-semibold text-[#4B6358] hover:text-[#0D3B2E] transition">
                            Sudah Mendaftar? Cek Status &rarr;
                        </a>
                        <a href="{{ route('psb.index') }}" class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-md bg-[#0D3B2E] text-white font-semibold text-xs uppercase tracking-wider hover:bg-[#059669] transition">
                            <span>Mulai Isi Formulir PSB</span>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Right: Fast Fee Calculator & Wave Info -->
                <div class="lg:col-span-5 bg-[#FAF8F5] border border-[#E5E0D8] p-8 space-y-6">
                    <div class="border-b border-[#E5E0D8] pb-3">
                        <span class="editorial-label">SIMULASI BIAYA CEPAT</span>
                        <h3 class="font-serif font-bold text-xl text-[#0D3B2E] mt-1">
                            Kalkulasi Biaya Terpadu
                        </h3>
                    </div>

                    <!-- Program Selection for Calculator -->
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-[#0D3B2E] uppercase tracking-wider">
                            Pilih Jenjang Calon Santri:
                        </label>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="button" @click="simProgram = 'MTS'" :class="simProgram === 'MTS' ? 'border-[#0D3B2E] bg-white text-[#0D3B2E] font-bold' : 'border-[#E5E0D8] text-[#4B6358]'" class="p-2.5 border rounded-md text-xs text-center transition">
                                MTS (Mukim 24 Jam)
                            </button>
                            <button type="button" @click="simProgram = 'MDTA'" :class="simProgram === 'MDTA' ? 'border-[#0D3B2E] bg-white text-[#0D3B2E] font-bold' : 'border-[#E5E0D8] text-[#4B6358]'" class="p-2.5 border rounded-md text-xs text-center transition">
                                MDTA (Sekolah Sore)
                            </button>
                        </div>
                    </div>

                    <!-- Calculated Breakdown -->
                    <div class="bg-white border border-[#E5E0D8] p-5 space-y-3 text-xs">
                        <div class="flex justify-between items-baseline py-1 border-b border-[#E5E0D8]">
                            <span class="text-[#4B6358]">Biaya Registrasi Awal:</span>
                            <span class="font-bold text-[#B89758] font-sans text-sm" x-text="simProgram === 'MTS' ? 'Rp {{ $feeMts }}' : 'Rp {{ $feeMdta }}'"></span>
                        </div>
                        <div class="flex justify-between items-baseline py-1 border-b border-[#E5E0D8]">
                            <span class="text-[#4B6358]">Biaya Bulanan (Syahriah):</span>
                            <span class="font-bold text-[#0D3B2E] font-sans text-base" x-text="simProgram === 'MTS' ? 'Rp 500.000 / bln' : 'Rp 12.000 / bln'"></span>
                        </div>
                        <div class="pt-1 text-[#4B6358] leading-relaxed">
                            <span x-show="simProgram === 'MTS'">*Mencakup tempat tidur asrama mukim, makan bergizi 3x sehari, air minum steril, bimbingan tahfidz intensif, dan laundry.</span>
                            <span x-show="simProgram === 'MDTA'" style="display: none;">*Program non-mukim sore hari (14.00-17.00 WIB) untuk pembinaan hafalan Al-Qur'an dan akhlak santri sekitar.</span>
                        </div>
                    </div>

                    <div class="pt-2">
                        <a :href="'{{ route('psb.index') }}?program=' + simProgram" class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md bg-[#B89758] hover:bg-[#96783e] text-white font-semibold text-xs uppercase tracking-wider transition">
                            <span>Lanjutkan Pendaftaran Program Terpilih &rarr;</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 4. DEWAN ASATIDZ SPOTLIGHT PREVIEW -->
    <section class="py-16 md:py-24 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label">DEWAN GURU & ASATIDZ</span>
                    <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#0D3B2E] tracking-tight">
                        Dibimbing Langsung Huffadz Bersanad
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Dididik oleh para pengajar yang berpengalaman dan memiliki sanad keilmuan Al-Qur'an bersambung.
                    </p>
                </div>
                <a href="{{ route('profile.teachers') }}" class="text-xs font-semibold uppercase tracking-wider text-[#0D3B2E] hover:text-[#059669] transition">
                    Lihat Seluruh Dewan Asatidz &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($teachers->take(4) as $teacher)
                    <div class="bg-white border border-[#E5E0D8] p-6 space-y-3 hover:border-[#0D3B2E] transition">
                        <div class="w-12 h-12 bg-[#FAF8F5] border border-[#E5E0D8] flex items-center justify-center font-serif font-bold text-lg text-[#0D3B2E]">
                            {{ Str::substr($teacher->full_name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-base text-[#0D3B2E]">
                                {{ $teacher->full_name }}
                            </h3>
                            <p class="text-xs text-[#059669] font-medium">
                                {{ $teacher->role_title }}
                            </p>
                        </div>
                        <p class="text-xs text-[#4B6358] line-clamp-2 leading-relaxed">
                            {{ $teacher->bio ?? 'Pembimbing tahfidz Al-Qur\'an dan asatidz di PPMTQ Daar El Tazkiyah.' }}
                        </p>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8 bg-white border border-[#E5E0D8] text-xs text-[#4B6358]">
                        Belum ada data asatidz yang dipublikasikan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 5. WARTA & BERITA TERKINI (ASYMMETRICAL JOURNAL LAYOUT) -->
    <section class="py-16 md:py-24 bg-white border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label">04 — WARTA & DOKUMENTASI TERKINI</span>
                    <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#0D3B2E] tracking-tight">
                        Warta Pesantren & Agenda Kegiatan
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Kabar terbaru seputar dinamika santri, tasmi' Al-Qur'an, dan informasi resmi lembaga.
                    </p>
                </div>
                <a href="{{ route('news.index') }}" class="text-xs font-semibold uppercase tracking-wider text-[#0D3B2E] hover:text-[#059669] transition">
                    Lihat Seluruh Arsip Berita &rarr;
                </a>
            </div>

            <!-- Asymmetrical Journal Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left: Featured Story -->
                @if($featuredPost)
                    <article class="lg:col-span-7 bg-[#FAF8F5] border border-[#E5E0D8] p-8 space-y-5 hover:border-[#0D3B2E] transition">
                        <div class="flex items-center justify-between text-xs text-[#4B6358]">
                            <span class="editorial-label text-[#059669]">{{ $featuredPost->category?->name ?? 'Warta Pondok' }}</span>
                            <time datetime="{{ $featuredPost->published_at?->toDateString() }}" class="font-mono">
                                {{ $featuredPost->published_at?->translatedFormat('d F Y') ?? date('d M Y') }}
                            </time>
                        </div>
                        <h3 class="font-serif font-bold text-2xl sm:text-3xl text-[#0D3B2E] leading-snug">
                            <a href="{{ route('news.show', $featuredPost->slug) }}" class="hover:text-[#059669] transition">
                                {{ $featuredPost->title }}
                            </a>
                        </h3>
                        <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed line-clamp-3">
                            {{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->body ?? ''), 180) }}
                        </p>
                        <div class="pt-2 flex items-center justify-between border-t border-[#E5E0D8] text-xs">
                            <span class="text-[#4B6358]">Penulis: <strong class="text-[#0D3B2E]">{{ $featuredPost->author?->name ?? 'Humas Daar El Tazkiyah' }}</strong></span>
                            <a href="{{ route('news.show', $featuredPost->slug) }}" class="font-semibold text-[#0D3B2E] hover:text-[#059669] transition">
                                Baca Artikel Lengkap &rarr;
                            </a>
                        </div>
                    </article>
                @else
                    <div class="col-span-full bg-[#FAF8F5] border border-[#E5E0D8] p-8 text-center text-xs text-[#4B6358]">
                        Belum ada warta berita yang dipublikasikan.
                    </div>
                @endif

                <!-- Right: Recent Articles List -->
                @if($featuredPost && $recentPosts->isNotEmpty())
                    <div class="lg:col-span-5 space-y-4">
                        <div class="border-b border-[#E5E0D8] pb-2">
                            <span class="editorial-label text-[#4B6358]">WARTA TERBARU LAINNYA</span>
                        </div>

                        @foreach($recentPosts as $post)
                            <article class="bg-white border border-[#E5E0D8] p-5 space-y-2 hover:border-[#0D3B2E] transition">
                                <div class="flex items-center justify-between text-[11px] text-[#4B6358]">
                                    <span class="text-[#059669] font-medium uppercase tracking-wider">{{ $post->category?->name ?? 'Kegiatan' }}</span>
                                    <time class="font-mono">{{ $post->published_at?->translatedFormat('d M Y') ?? date('d M Y') }}</time>
                                </div>
                                <h4 class="font-serif font-bold text-base text-[#0D3B2E] leading-snug">
                                    <a href="{{ route('news.show', $post->slug) }}" class="hover:text-[#059669] transition">
                                        {{ $post->title }}
                                    </a>
                                </h4>
                                <p class="text-xs text-[#4B6358] line-clamp-2">
                                    {{ $post->excerpt ?? Str::limit(strip_tags($post->body ?? ''), 100) }}
                                </p>
                            </article>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </section>

    <!-- 6. GALERI KEGIATAN SANTRI -->
    <section class="py-16 md:py-24 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label">DOKUMENTASI KAMPUS</span>
                    <h2 class="font-serif text-3xl sm:text-4xl font-bold text-[#0D3B2E] tracking-tight">
                        Potret Rutinitas & Kehidupan Santri
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Dokumentasi visual hafalan Al-Qur'an, belajar mandiri, dan lingkungan asri pesantren di Ciampea.
                    </p>
                </div>
                <a href="{{ route('gallery.index') }}" class="text-xs font-semibold uppercase tracking-wider text-[#0D3B2E] hover:text-[#059669] transition">
                    Buka Seluruh Galeri &rarr;
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @forelse($latestGalleries as $gallery)
                    <div class="bg-white border border-[#E5E0D8] p-2 space-y-2 group">
                        <div class="aspect-4/3 bg-[#FAF8F5] border border-[#E5E0D8] overflow-hidden flex items-center justify-center">
                            @if($gallery->photos->isNotEmpty())
                                <img src="{{ Storage::url($gallery->photos->first()->photo_path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out" loading="lazy">
                            @else
                                <span class="font-serif text-xs text-[#4B6358]">DT Gallery</span>
                            @endif
                        </div>
                        <h4 class="font-serif font-bold text-xs text-[#0D3B2E] truncate">
                            {{ $gallery->title }}
                        </h4>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8 bg-white border border-[#E5E0D8] text-xs text-[#4B6358]">
                        Belum ada dokumentasi kegiatan yang diunggah.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 7. LOKASI & SILATURAHMI CTA -->
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-[#FAF8F5] border border-[#E5E0D8] p-8 md:p-12">
                <div class="lg:col-span-8 space-y-3">
                    <span class="editorial-label">KUNJUNGAN & SILATURAHMI</span>
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-[#0D3B2E]">
                        Kunjungi Kampus PPMTQ Daar El Tazkiyah Sumardi
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed max-w-2xl">
                        {{ $siteAddress }}
                    </p>
                    <div class="pt-2 flex flex-wrap gap-4 text-xs text-[#18181B]">
                        <span>Telepon / WA: <strong class="text-[#0D3B2E]">{{ $sitePhone }}</strong></span>
                        <span>Email: <strong class="text-[#0D3B2E]">{{ $siteEmail }}</strong></span>
                    </div>
                </div>
                <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3">
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center gap-2 py-3 px-6 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-semibold uppercase tracking-wider transition">
                        <span>Peta & Jadwal Kunjungan</span>
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waNumber) }}?text={{ urlencode('Assalamu\'alaikum Panitia PSB PPMTQ Daar El Tazkiyah, saya ingin bertanya seputar pendaftaran santri baru.') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 py-3 px-6 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] text-[#0D3B2E] text-xs font-semibold uppercase tracking-wider transition">
                        <span>Chat WhatsApp ({{ $waNumber }})</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
