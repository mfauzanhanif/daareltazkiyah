@extends('layouts.public', ['title' => 'MDTA (Sekolah Sore) - Program Pendidikan PPMTQ Daar El Tazkiyah'])

@section('content')
    <!-- Page Header (Editorial Academic Banner) -->
    <section class="bg-white border-b border-[#E5E0D8] pt-12 pb-14 md:pt-16 md:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <div class="flex items-center gap-3">
                    <span class="editorial-label">02 — PROGRAM AKADEMIK</span>
                    <span class="w-8 h-px bg-[#B89758]"></span>
                    <span class="text-xs font-mono text-[#4B6358] uppercase tracking-wider">Jenjang Diniyah Non-Mukim</span>
                </div>
                <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-[#0D3B2E] tracking-tight leading-[1.15]">
                    Madrasah Diniyah Takmiliyah Awaliyah (MDTA Sekolah Sore)
                </h1>
                <p class="text-base sm:text-lg text-[#4B6358] leading-relaxed">
                    Pendidikan keagamaan Islam non-mukim untuk anak usia sekolah dasar/tingkat pertama setiap sore hari. Membekali santri dengan fondasi akidah, hafalan juz 'amma, adab harian, dan tata cara ibadah sesuai tuntunan sunnah.
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
                            <span class="editorial-label">STRUKTUR BIAYA MDTA</span>
                            <h2 class="font-serif text-2xl font-bold text-[#0D3B2E]">
                                Investasi Pendidikan
                            </h2>
                            <p class="text-xs text-[#4B6358]">
                                Biaya bersubsidi untuk masyarakat dan santri sekitar.
                            </p>
                        </div>

                        <!-- Monthly Syahriah -->
                        <div class="space-y-1">
                            <span class="text-xs font-semibold text-[#4B6358] uppercase tracking-wider block">Biaya Bulanan (Syahriah):</span>
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-bold text-[#0D3B2E] font-sans">Rp 12.000</span>
                                <span class="text-xs text-[#4B6358]">/ bulan</span>
                            </div>
                            <p class="text-xs text-[#4B6358]/90">
                                Program pengabdian masyarakat pondok untuk pemerataan pendidikan agama santri sekitar.
                            </p>
                        </div>

                        <!-- Registration Fee -->
                        <div class="pt-3 border-t border-[#E5E0D8] space-y-1">
                            <span class="text-xs font-semibold text-[#4B6358] uppercase tracking-wider block">Biaya Registrasi PSB:</span>
                            <div class="text-xl font-bold text-[#B89758] font-sans">
                                Rp {{ $feeMdta }}
                            </div>
                            <p class="text-[11px] text-[#4B6358] italic">
                                *Sesuai gelombang penerimaan santri baru aktif ({{ $activeWave?->name ?? 'Gelombang Terkini' }}).
                            </p>
                        </div>

                        <!-- CTAs -->
                        <div class="pt-4 space-y-3">
                            <a href="{{ route('psb.index') }}?program=MDTA" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs tracking-wider uppercase transition">
                                <span>Daftar MDTA Sekolah Sore</span>
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waNumber) }}?text={{ urlencode('Assalamu\'alaikum, saya ingin konsultasi seputar pendaftaran santri MDTA Sekolah Sore PPMTQ Daar El Tazkiyah.') }}" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-md border border-[#E5E0D8] hover:border-[#0D3B2E] text-[#0D3B2E] font-semibold text-xs tracking-wide transition bg-white">
                                <span>Tanya Jadwal MDTA via WhatsApp</span>
                            </a>
                        </div>
                    </div>

                    <!-- Program Quick Switcher -->
                    <div class="bg-white border border-[#E5E0D8] p-6 space-y-3">
                        <span class="editorial-label">JENJANG PENDIDIKAN</span>
                        <ul class="text-sm space-y-2 pt-1 font-medium text-[#18181B]">
                            <li class="border-l-2 border-transparent pl-3 text-[#4B6358] hover:border-[#E5E0D8] hover:text-[#0D3B2E] transition">
                                <a href="{{ route('academic.mts') }}">MTS (Mukim 24 Jam)</a>
                            </li>
                            <li class="border-l-2 border-[#0D3B2E] pl-3 text-[#0D3B2E] font-semibold">
                                MDTA (Sekolah Sore)
                            </li>
                            <li class="border-l-2 border-transparent pl-3 text-[#4B6358] hover:border-[#E5E0D8] hover:text-[#0D3B2E] transition">
                                <a href="{{ route('academic.tahfidz') }}">Kurikulum Tahfidz & Kitab Kuning</a>
                            </li>
                        </ul>
                    </div>
                </aside>

                <!-- Right Column: Detail Silabus & Kegiatan MDTA -->
                <div class="lg:col-span-8 space-y-12 bg-white border border-[#E5E0D8] p-8 sm:p-12">

                    <!-- Section: Profil Jenjang -->
                    <article class="space-y-6">
                        <div class="flex items-center gap-3 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">PROFIL PROGRAM</span>
                            <span class="text-xs text-[#E5E0D8]">|</span>
                            <h2 class="font-serif text-2xl font-bold text-[#0D3B2E]">
                                Madrasah Diniyah Takmiliyah Awaliyah
                            </h2>
                        </div>
                        <p class="text-base text-[#18181B] leading-relaxed">
                            Program MDTA (Sekolah Sore) Daar El Tazkiyah dirancang khusus untuk memenuhi kebutuhan orang tua yang menyekolahkan anaknya di sekolah dasar/umum di pagi hari, namun menghendaki bekal pendidikan agama Islam, baca tulis Al-Qur'an (BTQ), dan akhlak yang mendalam di sore hari.
                        </p>
                    </article>

                    <!-- Section: Waktu & Jadwal Belajar -->
                    <article class="space-y-6 pt-4 border-t border-[#E5E0D8]">
                        <div class="flex items-center gap-3 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">WAKTU BELAJAR</span>
                            <span class="text-xs text-[#E5E0D8]">|</span>
                            <h2 class="font-serif text-2xl font-bold text-[#0D3B2E]">
                                Jadwal KBM Sekolah Sore
                            </h2>
                        </div>

                        <div class="border border-[#E5E0D8] p-6 space-y-3 bg-[#FAF8F5]">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-[#E5E0D8] pb-3">
                                <span class="font-semibold text-sm text-[#0D3B2E]">Hari Aktif Belajar:</span>
                                <span class="text-xs font-mono text-[#059669]">Senin s/d Kamis & Sabtu</span>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-[#E5E0D8] pb-3">
                                <span class="font-semibold text-sm text-[#0D3B2E]">Waktu Kegiatan:</span>
                                <span class="text-xs font-mono text-[#059669]">14.00 – 17.00 WIB</span>
                            </div>
                            <p class="text-xs text-[#4B6358] pt-1">
                                Diselingi sholat Ashar berjamaah di Masjid Jami' pesantren serta bimbingan doa harian dan zikir petang ma'tsurat.
                            </p>
                        </div>
                    </article>

                    <!-- Section: Materi Pelajaran MDTA -->
                    <article class="space-y-6 pt-4 border-t border-[#E5E0D8]">
                        <div class="flex items-center gap-3 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">MATERI KURIKULUM</span>
                            <span class="text-xs text-[#E5E0D8]">|</span>
                            <h2 class="font-serif text-2xl font-bold text-[#0D3B2E]">
                                Silabus Mata Pelajaran Diniyah
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="p-6 border border-[#E5E0D8] space-y-2">
                                <span class="editorial-label text-[#059669]">MAPEL 01</span>
                                <h3 class="font-serif font-bold text-lg text-[#0D3B2E]">Al-Qur'an & Tajwid Praktis</h3>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Tahsin makharijul huruf, sifat-sifat huruf, hukum nun sukun, mim sukun, dan mad, serta hafalan surat-surat Juz 30 (Juz 'Amma).
                                </p>
                            </div>
                            <div class="p-6 border border-[#E5E0D8] space-y-2">
                                <span class="editorial-label text-[#059669]">MAPEL 02</span>
                                <h3 class="font-serif font-bold text-lg text-[#0D3B2E]">Fiqih Ibadah & Praktik Sholat</h3>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Thaharah (wudhu, tayamum, mandi wajib), tata cara sholat fardhu & sunnah yang benar, serta hafalan bacaan sholat dan doa harian.
                                </p>
                            </div>
                            <div class="p-6 border border-[#E5E0D8] space-y-2">
                                <span class="editorial-label text-[#059669]">MAPEL 03</span>
                                <h3 class="font-serif font-bold text-lg text-[#0D3B2E]">Aqidah Akhlak</h3>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Mengenal Rukun Iman, sifat-sifat Allah dan Rasul-Nya, adab kepada orang tua, guru, teman, serta penghindaran perilaku tercela.
                                </p>
                            </div>
                            <div class="p-6 border border-[#E5E0D8] space-y-2">
                                <span class="editorial-label text-[#059669]">MAPEL 04</span>
                                <h3 class="font-serif font-bold text-lg text-[#0D3B2E]">Tarikh Islam & Bahasa Arab Dasar</h3>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Kisah keteladanan Nabi Muhammad ﷺ dan sahabat, pengenalan kosa kata bahasa Arab dasar, serta kaidah menulis huruf pegon dan Arab.
                                </p>
                            </div>
                        </div>
                    </article>

                </div>
            </div>
        </div>
    </section>
@endsection
