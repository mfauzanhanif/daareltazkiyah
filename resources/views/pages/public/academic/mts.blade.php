@extends('layouts.public', ['title' => 'MTS (Mukim 24 Jam) - Program Pendidikan PPMTQ Daar El Tazkiyah'])

@section('content')
    <!-- Page Header (Editorial Academic Banner) -->
    <section class="bg-white border-b border-[#E5E0D8] pt-12 pb-14 md:pt-16 md:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <div class="flex items-center gap-3">
                    <span class="editorial-label">02 — PROGRAM AKADEMIK</span>
                    <span class="w-8 h-px bg-[#B89758]"></span>
                    <span class="text-xs font-mono text-[#4B6358] uppercase tracking-wider">Jenjang Formal Mukim</span>
                </div>
                <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-[#0D3B2E] tracking-tight leading-[1.15]">
                    Madrasah Tsanawiyah (MTS Mukim 24 Jam)
                </h1>
                <p class="text-base sm:text-lg text-[#4B6358] leading-relaxed">
                    Pendidikan setingkat SMP terpadu dengan sistem asrama penuh 24 jam. Menggabungkan kurikulum nasional Kementerian Agama RI dengan kurikulum tahfidz mutqin 30 juz bersanad dan kepesantrenan salaf modern.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <section class="py-16 md:py-24 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Left Column: Sticky Financial & Registration Info Card -->
                <aside class="lg:col-span-4 space-y-8 lg:sticky lg:top-28">
                    <!-- Fee & Admission Card -->
                    <div class="bg-white border border-[#E5E0D8] p-6 sm:p-8 space-y-6">
                        <div class="space-y-1 border-b border-[#E5E0D8] pb-5">
                            <span class="editorial-label">STRUKTUR BIAYA MTS</span>
                            <h2 class="font-serif text-2xl font-bold text-[#0D3B2E]">
                                Investasi Pendidikan
                            </h2>
                            <p class="text-xs text-[#4B6358]">
                                Biaya terjangkau dengan fasilitas mukim komprehensif.
                            </p>
                        </div>

                        <!-- Monthly Syahriah -->
                        <div class="space-y-1">
                            <span class="text-xs font-semibold text-[#4B6358] uppercase tracking-wider block">Biaya Bulanan (Syahriah):</span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-[#0D3B2E] font-sans">Rp 500.000</span>
                                <span class="text-xs text-[#4B6358]">/ bulan</span>
                            </div>
                            <p class="text-xs text-[#4B6358]/90">
                                Mencakup biaya asrama mukim 24 jam, makan 3x sehari, bimbingan asatidz, dan air minum.
                            </p>
                        </div>

                        <!-- Registration Fee -->
                        <div class="pt-3 border-t border-[#E5E0D8] space-y-1">
                            <span class="text-xs font-semibold text-[#4B6358] uppercase tracking-wider block">Biaya Registrasi PSB:</span>
                            <div class="text-xl font-bold text-[#B89758] font-sans">
                                Rp {{ $feeMts }}
                            </div>
                            <p class="text-[11px] text-[#4B6358] italic">
                                *Biaya formulir & ujian seleksi sesuai gelombang aktif ({{ $activeWave?->name ?? 'Gelombang Terkini' }}).
                            </p>
                        </div>

                        <!-- CTAs -->
                        <div class="pt-4 space-y-3">
                            <a href="{{ route('psb.index') }}?program=MTS" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs tracking-wider uppercase transition">
                                <span>Daftar MTS Mukim Sekarang</span>
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waNumber) }}?text={{ urlencode('Assalamu\'alaikum, saya ingin konsultasi detail program MTS Mukim 24 Jam PPMTQ Daar El Tazkiyah.') }}" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center gap-2 px-6 py-2.5 border border-[#E5E0D8] hover:border-[#0D3B2E] text-[#0D3B2E] font-semibold text-xs tracking-wide transition bg-white">
                                <span>Konsultasi Panitia via WhatsApp</span>
                            </a>
                        </div>
                    </div>

                    <!-- Program Quick Switcher -->
                    <div class="bg-white border border-[#E5E0D8] p-6 space-y-3">
                        <span class="editorial-label">JENJANG PENDIDIKAN</span>
                        <ul class="text-sm space-y-2 pt-1 font-medium text-[#18181B]">
                            <li class="border-l-2 border-[#0D3B2E] pl-3 text-[#0D3B2E] font-semibold">
                                MTS (Mukim 24 Jam)
                            </li>
                            <li class="border-l-2 border-transparent pl-3 text-[#4B6358] hover:border-[#E5E0D8] hover:text-[#0D3B2E] transition">
                                <a href="{{ route('academic.mdta') }}">MDTA (Sekolah Sore)</a>
                            </li>
                            <li class="border-l-2 border-transparent pl-3 text-[#4B6358] hover:border-[#E5E0D8] hover:text-[#0D3B2E] transition">
                                <a href="{{ route('academic.tahfidz') }}">Kurikulum Tahfidz & Kitab Kuning</a>
                            </li>
                        </ul>
                    </div>
                </aside>

                <!-- Right Column: Detail Silabus & Kehidupan Mukim -->
                <div class="lg:col-span-8 space-y-12 bg-white border border-[#E5E0D8] p-8 sm:p-12">

                    <!-- Section: Profil Jenjang -->
                    <article class="space-y-6">
                        <div class="flex items-center gap-3 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">PROFIL PROGRAM</span>
                            <span class="text-xs text-[#E5E0D8]">|</span>
                            <h2 class="font-serif text-2xl font-bold text-[#0D3B2E]">
                                Madrasah Tsanawiyah Terpadu Asrama
                            </h2>
                        </div>
                        <p class="text-base text-[#18181B] leading-relaxed">
                            Program MTS Mukim Daar El Tazkiyah dirancang khusus untuk mencetak generasi lulusan yang kokoh dalam hafalan Al-Qur'an 30 juz, teguh berpegang pada akidah Ahlussunnah wal Jama'ah, serta memiliki kecakapan sains, teknologi, dan literasi bahasa internasional (Arab dan Inggris) untuk melanjutkan pendidikan ke jenjang MA/SMA favorit maupun beasiswa ke luar negeri.
                        </p>
                    </article>

                    <!-- Section: Target Capaian Santri (3 Tahun) -->
                    <article class="space-y-6 pt-4 border-t border-[#E5E0D8]">
                        <div class="flex items-center gap-3 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">STANDAR KELULUSAN</span>
                            <span class="text-xs text-[#E5E0D8]">|</span>
                            <h2 class="font-serif text-2xl font-bold text-[#0D3B2E]">
                                Target Capaian Lulusan MTS (3 Tahun)
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="p-6 border border-[#E5E0D8] bg-[#FAF8F5] space-y-2">
                                <span class="editorial-label text-[#059669]">CAPAIAN 01</span>
                                <h3 class="font-serif font-bold text-lg text-[#0D3B2E]">Tahfidz 30 Juz Mutqin</h3>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Menyelesaikan setoran hafalan Al-Qur'an 30 juz dengan standar tahsin bersanad, serta lulus ujian tasmi' kubro di hadapan dewan penguji.
                                </p>
                            </div>
                            <div class="p-6 border border-[#E5E0D8] bg-[#FAF8F5] space-y-2">
                                <span class="editorial-label text-[#059669]">CAPAIAN 02</span>
                                <h3 class="font-serif font-bold text-lg text-[#0D3B2E]">Ijazah Formal Kemenag RI</h3>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Memperoleh ijazah resmi negara Madrasah Tsanawiyah yang diakui penuh untuk melanjutkan ke jenjang Aliyah, SMA, SMK, maupun sekolah internasional.
                                </p>
                            </div>
                            <div class="p-6 border border-[#E5E0D8] bg-[#FAF8F5] space-y-2">
                                <span class="editorial-label text-[#059669]">CAPAIAN 03</span>
                                <h3 class="font-serif font-bold text-lg text-[#0D3B2E]">Penguasaan Kitab Turats</h3>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Mampu membaca dan memahami kaidah dasar gramatika Arab (Jurumiyah), fiqih ibadah (Safinatun Najah & Taqrib), serta akhlak mulia.
                                </p>
                            </div>
                            <div class="p-6 border border-[#E5E0D8] bg-[#FAF8F5] space-y-2">
                                <span class="editorial-label text-[#059669]">CAPAIAN 04</span>
                                <h3 class="font-serif font-bold text-lg text-[#0D3B2E]">Kemandirian & Adab Kepemimpinan</h3>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Terbiasa mandiri mengelola waktu, sholat berjamaah lima waktu tepat waktu, terampil berpidato dalam 3 bahasa (Indonesia, Arab, Inggris).
                                </p>
                            </div>
                        </div>
                    </article>

                    <!-- Section: Integrasi Kurikulum -->
                    <article class="space-y-6 pt-4 border-t border-[#E5E0D8]">
                        <div class="flex items-center gap-3 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">INTEGRASI MAPEL</span>
                            <span class="text-xs text-[#E5E0D8]">|</span>
                            <h2 class="font-serif text-2xl font-bold text-[#0D3B2E]">
                                Struktur Kurikulum Pembelajaran
                            </h2>
                        </div>

                        <div class="space-y-4">
                            <div class="border border-[#E5E0D8] p-5">
                                <strong class="text-[#0D3B2E] block text-sm font-semibold mb-1">A. Kurikulum Nasional Kemenag:</strong>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Matematika, Ilmu Pengetahuan Alam (IPA Terpadu), Ilmu Pengetahuan Sosial (IPS), Bahasa Indonesia, Bahasa Inggris, Pendidikan Pancasila, Seni Budaya & Prakarya, Penjasorkes.
                                </p>
                            </div>
                            <div class="border border-[#E5E0D8] p-5">
                                <strong class="text-[#0D3B2E] block text-sm font-semibold mb-1">B. Kurikulum Kepesantrenan & Diniyah:</strong>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Tahfidz & Tahsin Al-Qur'an, Tajwid (Matan Tuhfatul Athfal & Jazariyah), Fiqih Ibadah & Muamalah, Aqidah Akhlak, Bahasa Arab (Nahwu, Sharaf, Durusul Lughah), Hadits Nabawi (Arba'in Nawawi), Sejarah Kebudayaan Islam (SKI).
                                </p>
                            </div>
                            <div class="border border-[#E5E0D8] p-5">
                                <strong class="text-[#0D3B2E] block text-sm font-semibold mb-1">C. Program Pengembangan Diri & Sunnah:</strong>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Olahraga Panahan (Archery), Seni Bela Diri Pencak Silat, Muhadharah (Khitobah 3 Bahasa), Kaligrafi Islam (Khat), Jurnalistik Santri, Kepramukaan.
                                </p>
                            </div>
                        </div>
                    </article>

                    <!-- Section: Fasilitas Santri Mukim -->
                    <article class="space-y-6 pt-4 border-t border-[#E5E0D8]">
                        <div class="flex items-center gap-3 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">FASILITAS MUKIM</span>
                            <span class="text-xs text-[#E5E0D8]">|</span>
                            <h2 class="font-serif text-2xl font-bold text-[#0D3B2E]">
                                Fasilitas Hidup di Lingkungan Pesantren
                            </h2>
                        </div>

                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs text-[#18181B]">
                            <li class="flex items-center gap-2 p-2 border border-[#E5E0D8]">
                                <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                <span>Kamar asrama mukim dengan lemari & ranjang kokoh</span>
                            </li>
                            <li class="flex items-center gap-2 p-2 border border-[#E5E0D8]">
                                <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                <span>Makan 3 kali sehari dengan menu gizi seimbang</span>
                            </li>
                            <li class="flex items-center gap-2 p-2 border border-[#E5E0D8]">
                                <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                <span>Layanan pencucian pakaian (laundry) pakaian seragam santri</span>
                            </li>
                            <li class="flex items-center gap-2 p-2 border border-[#E5E0D8]">
                                <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                <span>Bimbingan musyrif & asatidz mukim 24 jam</span>
                            </li>
                            <li class="flex items-center gap-2 p-2 border border-[#E5E0D8]">
                                <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                <span>Akses perpustakaan kitab & sarana olahraga panahan</span>
                            </li>
                            <li class="flex items-center gap-2 p-2 border border-[#E5E0D8]">
                                <span class="w-1.5 h-1.5 bg-[#059669]"></span>
                                <span>Lingkungan bebas asap rokok & bebas gawai (gadget-free)</span>
                            </li>
                        </ul>
                    </article>

                </div>
            </div>
        </div>
    </section>
@endsection
