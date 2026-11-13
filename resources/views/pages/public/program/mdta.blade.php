@extends('layouts.public', ['title' => 'Madrasah Diniyah Takmiliyah Awaliyah (MDTA) - PPMTQ Daar El Tazkiyah Sumardi'])

@section('content')
<div x-data="{
    showModal: false,
    modalImage: '',
    modalTitle: '',
    openModal(src, title) {
        this.modalImage = src;
        this.modalTitle = title;
        this.showModal = true;
        document.body.classList.add('overflow-hidden');
    },
    closeModal() {
        this.showModal = false;
        document.body.classList.remove('overflow-hidden');
    }
}" @keydown.escape.window="closeModal()">

    <!-- 1. PAGE HERO BANNER -->
    <section class="relative bg-cover bg-center overflow-hidden py-16 md:py-24 border-b border-[#B89758]/30"
             style="background-image: url('{{ asset('images/foto-santri-1.webp') }}');">
        <!-- Dark Forest Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#042816] via-[#084C27]/90 to-[#042816]/85"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#B89758]/20 border border-[#B89758]/40 text-[#B89758] text-[11px] sm:text-xs font-semibold uppercase tracking-wider">
                <span>Pendidikan Diniyah Sore Hari &bull; Usia SD/MI</span>
            </div>
            <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.2]">
                Madrasah Diniyah Takmiliyah Awaliyah (MDTA)
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-emerald-100/90 max-w-3xl mx-auto leading-relaxed">
                Unit resmi MDT Ula DAAR EL TAZKIYAH SUMARDI yang membina dasar keislaman, Al-Qur'an, tata cara ibadah harian, dan akhlak mulia bagi generasi usia sekolah dasar di waktu sore hari.
            </p>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- SECTION 2: DESKRIPSI PROGRAM MDTA -->
    <!-- ========================================================================= -->
    <section class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        DESKRIPSI PROGRAM MDTA
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    Pendidikan keagamaan Islam non-mukim yang ramah dan menyenangkan bagi santri usia SD/MI.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                <!-- Left Column: Detailed Narrative -->
                <div class="lg:col-span-7 space-y-5 text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    <div class="p-5 sm:p-6 bg-white border border-[#E5E0D8] rounded-2xl space-y-4 shadow-xs">
                        <h3 class="font-sans font-bold text-lg sm:text-xl text-[#0D3B2E]">
                            Membangun Karakter Islami Sejak Usia Dasar
                        </h3>
                        <p>
                            <strong class="text-[#0D3B2E]">Madrasah Diniyah Takmiliyah Awaliyah (MDTA)</strong> di bawah naungan Yayasan DAAR EL TAZKIYAH SUMARDI adalah lembaga pendidikan keagamaan Islam luar sekolah yang beroperasi sebagai unit <strong class="text-[#0D3B2E]">MDT Ula DAAR EL TAZKIYAH SUMARDI</strong>. Lembaga ini telah resmi terdaftar di Kementerian Agama Kabupaten Serang dengan <strong class="text-[#0D3B2E]">Izin Operasional No: 0355</strong> dan <strong class="text-[#0D3B2E]">NSMDT: 311236041251</strong>.
                        </p>
                        <p>
                            Program ini diselenggarakan khusus pada sore hari selepas sekolah formal (Senin sampai Kamis, pukul 13.30 – 16.10 WIB) agar anak-anak usia Sekolah Dasar (SD/MI) di Kp. Lembur Sawah, Desa Mekarbaru, dan sekitarnya mendapatkan bekal ilmu agama yang cukup, terstruktur, dan aplikatif.
                        </p>
                        <p>
                            Melalui bimbingan para asatidz yang sabar dan kompeten, santri diajarkan membaca Al-Qur'an dengan kaidah tajwid yang benar (BTQ), menghafal surat-surat Juz 30 (Tahfidz Juz 'Amma), mempraktikkan sholat fardhu dan doa harian secara tertib, serta meneladani akhlak mulia Nabi Muhammad SAW.
                        </p>
                    </div>

                    <!-- Highlight Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-white border border-[#E5E0D8] rounded-xl p-4.5 space-y-1.5 shadow-xs">
                            <div class="flex items-center gap-2 text-[#059669]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="font-sans font-bold text-sm text-[#0D3B2E]">Jadwal Sore Efektif</span>
                            </div>
                            <p class="text-xs text-[#4B6358]">
                                Belajar hari Senin s/d Kamis pukul 13.30 – 16.10 WIB, cocok dipadukan dengan jadwal sekolah formal SD/MI.
                            </p>
                        </div>

                        <div class="bg-white border border-[#E5E0D8] rounded-xl p-4.5 space-y-1.5 shadow-xs">
                            <div class="flex items-center gap-2 text-[#059669]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="font-sans font-bold text-sm text-[#0D3B2E]">Izin Resmi Kemenag</span>
                            </div>
                            <p class="text-xs text-[#4B6358]">
                                Terdaftar sah dengan NSMDT: 311236041251 dan Ijop Kemenag Serang No. 0355.
                            </p>
                        </div>

                        <div class="bg-white border border-[#E5E0D8] rounded-xl p-4.5 space-y-1.5 shadow-xs">
                            <div class="flex items-center gap-2 text-[#059669]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                <span class="font-sans font-bold text-sm text-[#0D3B2E]">Praktik Ibadah Terpadu</span>
                            </div>
                            <p class="text-xs text-[#4B6358]">
                                Sholat Dzuhur dan Ashar berjamaah langsung di masjid pesantren bersama para asatidz.
                            </p>
                        </div>

                        <div class="bg-white border border-[#E5E0D8] rounded-xl p-4.5 space-y-1.5 shadow-xs">
                            <div class="flex items-center gap-2 text-[#059669]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="font-sans font-bold text-sm text-[#0D3B2E]">Infaq Sangat Terjangkau</span>
                            </div>
                            <p class="text-xs text-[#4B6358]">
                                Khidmah sosial yayasan untuk masyarakat sekitar dengan infaq bulanan hanya Rp 12.000/bulan.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: MDTA Profile Card -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-6 shadow-sm">
                        <div class="border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label text-[#B89758]">RINGKASAN PROGRAM</span>
                            <h3 class="font-sans font-extrabold text-xl sm:text-2xl text-[#0D3B2E] mt-1">
                                MDT Ula Daar El Tazkiyah
                            </h3>
                            <div class="text-xs font-mono font-bold text-[#059669] mt-1">
                                NSMDT: 311236041251
                            </div>
                        </div>

                        <div class="space-y-3.5 text-xs sm:text-sm">
                            <div class="flex justify-between items-center py-2 border-b border-[#E5E0D8]/60">
                                <span class="text-[#4B6358]">Sasaran Usia</span>
                                <strong class="text-[#0D3B2E] font-sans">Usia SD/MI (Kelas 1 - 6)</strong>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-[#E5E0D8]/60">
                                <span class="text-[#4B6358]">Hari &amp; Waktu Belajar</span>
                                <strong class="text-[#0D3B2E] font-sans">Senin – Kamis (13.30 – 16.10 WIB)</strong>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-[#E5E0D8]/60">
                                <span class="text-[#4B6358]">Izin Operasional</span>
                                <strong class="text-[#0D3B2E] font-sans">Kemenag Serang No. 0355</strong>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-[#E5E0D8]/60">
                                <span class="text-[#4B6358]">Fokus Utama</span>
                                <strong class="text-[#0D3B2E] font-sans">BTQ, Tahfidz Juz 30, Fiqih, Akhlak</strong>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-[#E5E0D8]/60">
                                <span class="text-[#4B6358]">Biaya Bulanan (Syahriyah)</span>
                                <strong class="text-[#0D3B2E] font-sans text-base text-[#059669]">Rp 12.000 <span class="text-xs font-normal text-gray-500">/ bln</span></strong>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-[#4B6358]">Biaya Pendaftaran PSB</span>
                                <strong class="text-[#B89758] font-sans">Rp {{ $feeMdta }}</strong>
                            </div>
                        </div>

                        <div class="pt-2 space-y-3">
                            <a href="{{ route('psb.form', ['program' => 'MDTA']) }}"
                                class="w-full inline-flex items-center justify-center gap-2 py-3.5 rounded-md bg-[#B89758] hover:bg-[#96783e] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs group">
                                <span>Daftar MDTA Sore Sekarang &rarr;</span>
                            </a>
                            @php
                                $cleanWaMdta = preg_replace('/[^0-9]/', '', $waMdtaNumber);
                                if (str_starts_with($cleanWaMdta, '0')) {
                                    $cleanWaMdta = '62' . substr($cleanWaMdta, 1);
                                }
                            @endphp
                            <a href="https://wa.me/{{ $cleanWaMdta }}?text=Assalamu%27alaikum+Ustadzah+Admin+MDTA+PPMTQ+Daar+El+Tazkiyah%2C+saya+ingin+konsultasi+terkait+pendaftaran+santri+MDTA."
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md border border-[#0D3B2E] hover:bg-[#0D3B2E] hover:text-white text-[#0D3B2E] text-xs font-semibold uppercase tracking-wider transition shadow-xs">
                                <span>Hubungi Hotline MDTA ({{ $waMdtaNumber }})</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- SECTION 3: KURIKULUM MDTA -->
    <!-- ========================================================================= -->
    <section id="kurikulum-mdta" class="py-12 md:py-16 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        KURIKULUM PEMBELAJARAN MDTA
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    Struktur materi pokok kurikulum MDT Ula Daar El Tazkiyah Sumardi yang dirancang berjenjang untuk menanamkan dasar keislaman yang kokoh.
                </p>
            </div>

            <!-- 7 Requested Subjects Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. BTQ -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-2.5 hover:border-[#0D3B2E] hover:bg-white transition group shadow-xs">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">01</span>
                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-emerald-100/70 text-[#084C27]">Fondasi Qur'ani</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Baca Tulis Al-Qur'an (BTQ)
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pembelajaran membaca Al-Qur'an secara tartil dengan kaidah makharijul huruf dan tajwid, serta latihan menulis huruf hijaiyah bersambung dengan benar dan rapi.
                    </p>
                </div>

                <!-- 2. Tahfidz Al-Qur'an -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-2.5 hover:border-[#0D3B2E] hover:bg-white transition group shadow-xs">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">02</span>
                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-emerald-100/70 text-[#084C27]">Hafalan Mutqin</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Tahfidz Al-Qur'an
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Bimbingan menghafal surat-surat dalam Juz 30 (Juz 'Amma) secara berjenjang dari kelas 1 hingga kelas 3 melalui metode talaqqi dan murojaah rutin setiap hari Senin.
                    </p>
                </div>

                <!-- 3. Aqidah Akhlak -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-2.5 hover:border-[#0D3B2E] hover:bg-white transition group shadow-xs">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">03</span>
                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-amber-100/70 text-amber-900">Tauhid &amp; Adab</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Aqidah Akhlak
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Penanaman keimanan kepada rukun iman dan rukun Islam, pembiasaan akhlak mulia dalam keseharian, serta adab berbakti kepada kedua orang tua, guru, dan teman.
                    </p>
                </div>

                <!-- 4. Fiqih -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-2.5 hover:border-[#0D3B2E] hover:bg-white transition group shadow-xs">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">04</span>
                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-emerald-100/70 text-[#084C27]">Hukum Syariat</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Fiqih
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pemahaman tata cara thaharah (bersuci dari hadats dan najis), tata cara wudhu yang benar, rukun dan syarat sholat fardhu, serta ketentuan puasa Ramadhan.
                    </p>
                </div>

                <!-- 5. Sejarah Kebudayaan Islam (SKI) -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-2.5 hover:border-[#0D3B2E] hover:bg-white transition group shadow-xs">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">05</span>
                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-amber-100/70 text-amber-900">Teladan Nabawi</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Sejarah Kebudayaan Islam (SKI)
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Mempelajari sirah Nabi Muhammad SAW, kisah 25 Nabi dan Rasul, serta riwayat hidup para sahabat Nabi sebagai teladan utama pembentukan karakter santri.
                    </p>
                </div>

                <!-- 6. Bahasa Arab -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-2.5 hover:border-[#0D3B2E] hover:bg-white transition group shadow-xs">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">06</span>
                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-emerald-100/70 text-[#084C27]">Bahasa Al-Qur'an</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Bahasa Arab
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pengenalan mufradat (kosakata) dasar seputar anggota tubuh, keluarga, angka, benda-benda di madrasah, dan percakapan sederhana bahasa Al-Qur'an.
                    </p>
                </div>

                <!-- 7. Praktik Ibadah dan Doa Harian -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-2.5 hover:border-[#0D3B2E] hover:bg-white transition group shadow-xs sm:col-span-2 lg:col-span-3">
                    <div class="flex items-center justify-between">
                        <span class="font-mono text-xs font-bold text-[#B89758]">07</span>
                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-emerald-100/70 text-[#084C27]">Amaliah Praktis</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition-colors">
                        Praktik Ibadah dan Doa Harian
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Praktik langsung wudhu dan sholat berjamaah (Dzuhur &amp; Ashar) di masjid, hafalan doa-doa harian (sebelum makan, tidur, masuk kamar mandi, kedua orang tua), serta pembacaan dzikir ma'tsurat singkat dan surat-surat pendek sebelum kepulangan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- SECTION 4: JADWAL PELAJARAN HARIAN SANTRI MDTA -->
    <!-- ========================================================================= -->
    <section id="jadwal-harian" class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        JADWAL PELAJARAN HARIAN
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    Struktur alokasi waktu dan mata pelajaran santri MDTA setiap Senin sampai Kamis (13.30 – 16.10 WIB).
                </p>
            </div>

            <!-- Schedule Table with Exactly Equal Column Widths for Days -->
            <div class="border border-[#E5E0D8] rounded-2xl overflow-hidden shadow-xs bg-white">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs sm:text-sm border-collapse table-fixed min-w-[640px]">
                        <thead>
                            <tr class="bg-[#0D3B2E] text-white">
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px] w-[20%]">Waktu (WIB)</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px] w-[20%] text-center border-l border-white/10">Senin</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px] w-[20%] text-center border-l border-white/10">Selasa</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px] w-[20%] text-center border-l border-white/10">Rabu</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px] w-[20%] text-center border-l border-white/10">Kamis</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E5E0D8]">
                            <!-- Sesi 1: Sholat Dzuhur & Murojaah -->
                            <tr class="bg-emerald-50/60 font-semibold text-[#084C27]">
                                <td class="py-3 px-4 sm:px-6 font-mono font-bold whitespace-nowrap text-[#0D3B2E]">13.30 – 14.00</td>
                                <td colspan="4" class="py-3 px-4 sm:px-6 text-center border-l border-[#E5E0D8]">
                                    Sholat Dzuhur Berjamaah &amp; Murojaah Juz 30 (Senin s/d Kamis)
                                </td>
                            </tr>

                            <!-- Sesi 2: Pelajaran 1 -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3.5 px-4 sm:px-6 font-mono font-bold text-[#0D3B2E] whitespace-nowrap bg-gray-50/50">14.00 – 14.45</td>
                                <td class="py-3.5 px-4 sm:px-6 text-center border-l border-[#E5E0D8]">
                                    <strong class="text-[#0D3B2E]">Tahfidzul Quran</strong>
                                    <span class="block text-[11px] text-[#4B6358] mt-0.5">Talaqqi &amp; Ziyadah</span>
                                </td>
                                <td class="py-3.5 px-4 sm:px-6 text-center border-l border-[#E5E0D8]">
                                    <strong class="text-[#0D3B2E]">Aqidah</strong>
                                    <span class="block text-[11px] text-[#4B6358] mt-0.5">Tauhid &amp; Rukun Iman</span>
                                </td>
                                <td class="py-3.5 px-4 sm:px-6 text-center border-l border-[#E5E0D8]">
                                    <strong class="text-[#0D3B2E]">Bahasa Arab</strong>
                                    <span class="block text-[11px] text-[#4B6358] mt-0.5">Mufradat &amp; Percakapan</span>
                                </td>
                                <td class="py-3.5 px-4 sm:px-6 text-center border-l border-[#E5E0D8]">
                                    <strong class="text-[#0D3B2E]">Praktik Ibadah / Fiqh</strong>
                                    <span class="block text-[11px] text-[#4B6358] mt-0.5">Wudhu &amp; Gerakan Sholat</span>
                                </td>
                            </tr>

                            <!-- Sesi 3: Istirahat & Ashar -->
                            <tr class="bg-amber-50/60 font-semibold text-amber-950">
                                <td class="py-3 px-4 sm:px-6 font-mono font-bold whitespace-nowrap text-[#B89758]">14.45 – 15.15</td>
                                <td colspan="4" class="py-3 px-4 sm:px-6 text-center border-l border-[#E5E0D8]">
                                    Istirahat &amp; Sholat Ashar Berjamaah (Senin s/d Kamis)
                                </td>
                            </tr>

                            <!-- Sesi 4: Pelajaran 2 -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3.5 px-4 sm:px-6 font-mono font-bold text-[#0D3B2E] whitespace-nowrap bg-gray-50/50">15.15 – 16.00</td>
                                <td class="py-3.5 px-4 sm:px-6 text-center border-l border-[#E5E0D8]">
                                    <strong class="text-[#0D3B2E]">Hadist</strong>
                                    <span class="block text-[11px] text-[#4B6358] mt-0.5">Hafalan Hadits Pilihan</span>
                                </td>
                                <td class="py-3.5 px-4 sm:px-6 text-center border-l border-[#E5E0D8]">
                                    <strong class="text-[#0D3B2E]">Akhlak</strong>
                                    <span class="block text-[11px] text-[#4B6358] mt-0.5">Adab Pergaulan Islami</span>
                                </td>
                                <td class="py-3.5 px-4 sm:px-6 text-center border-l border-[#E5E0D8]">
                                    <strong class="text-[#0D3B2E]">SKI</strong>
                                    <span class="block text-[11px] text-[#4B6358] mt-0.5">Sirah Nabawiyah</span>
                                </td>
                                <td class="py-3.5 px-4 sm:px-6 text-center border-l border-[#E5E0D8] bg-emerald-50/30">
                                    <strong class="text-[#0D3B2E]">Seni &amp; Bakat</strong>
                                    <span class="block text-[11px] text-[#4B6358] mt-0.5">Khat &amp; Sholawat</span>
                                </td>
                            </tr>

                            <!-- Sesi 5: Kepulangan -->
                            <tr class="bg-gray-100/70 text-[#4B6358]">
                                <td class="py-3 px-4 sm:px-6 font-mono font-bold whitespace-nowrap text-[#0D3B2E]">16.00 – 16.10</td>
                                <td colspan="4" class="py-3 px-4 sm:px-6 text-center font-medium border-l border-[#E5E0D8]">
                                    Himbauan Asatidz, Doa Kafaratul Majelis, &amp; Tandzif Jama'i
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- SECTION 5: TARGET HAFALAN AL-QUR'AN SANTRI MDTA -->
    <!-- ========================================================================= -->
    <section id="target-hafalan" class="py-12 md:py-16 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        TARGET HAFALAN BERJENJANG MDTA
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    Target capaian hafalan Al-Qur'an Juz 30 yang sistematis dan disesuaikan dengan tingkat usia serta kemampuan santri madrasah diniyah.
                </p>
            </div>

            <!-- Target Cards Grid for Kelas 1, 2, 3 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kelas 1 -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-4 hover:border-[#0D3B2E] hover:bg-white hover:shadow-md transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="editorial-label text-[#059669]">TINGKAT DASAR</span>
                        <span class="text-xs font-mono font-bold text-[#B89758]">KELAS 1</span>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">Kelas 1 MDTA</h3>
                        <p class="text-xs text-[#4B6358]">Fondasi makharijul huruf &amp; hafalan surat pendek</p>
                    </div>

                    <div class="p-4 rounded-xl bg-white border border-[#E5E0D8] space-y-2 shadow-2xs">
                        <span class="text-[10px] font-mono uppercase text-[#B89758] font-bold block">TARGET CAPAIAN RESMI</span>
                        <div class="font-sans font-bold text-lg text-[#0D3B2E]">
                            Surat An-Nas <span class="text-[#059669]">s/d</span> Surat Al-Ashr
                        </div>
                        <p class="text-[11px] text-[#4B6358] leading-relaxed">
                            Mencakup 12 surat pendek Juz 'Amma dengan penekanan tajwid dasar, kelancaran pelafalan, dan kebenaran harakat.
                        </p>
                    </div>

                    <div class="text-[11px] text-[#4B6358] space-y-1.5 pt-1">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                            <span>Jadwal Setoran: Setiap Senin (14.00 – 14.45 WIB)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span>
                            <span>Metode Talaqqi bersuara dan tasmi' hafalan</span>
                        </div>
                    </div>
                </div>

                <!-- Kelas 2 -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-4 hover:border-[#0D3B2E] hover:bg-white hover:shadow-md transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="editorial-label text-[#B89758]">TINGKAT MENENGAH</span>
                        <span class="text-xs font-mono font-bold text-[#B89758]">KELAS 2</span>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">Kelas 2 MDTA</h3>
                        <p class="text-xs text-[#4B6358]">Pengembangan ketahanan hafalan &amp; kaidah mad</p>
                    </div>

                    <div class="p-4 rounded-xl bg-white border border-[#E5E0D8] space-y-2 shadow-2xs">
                        <span class="text-[10px] font-mono uppercase text-[#B89758] font-bold block">TARGET CAPAIAN RESMI</span>
                        <div class="font-sans font-bold text-lg text-[#0D3B2E]">
                            Surat At-Takasur <span class="text-[#B89758]">s/d</span> Surat Al-Fajr
                        </div>
                        <p class="text-[11px] text-[#4B6358] leading-relaxed">
                            Mencakup surat-surat pertengahan Juz 30 dengan tartil, hukum mad, ghunnah, serta pengenalan wakaf wal ibtida'.
                        </p>
                    </div>

                    <div class="text-[11px] text-[#4B6358] space-y-1.5 pt-1">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#B89758]"></span>
                            <span>Bimbingan setoran pekanan bersama asatidz</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#B89758]"></span>
                            <span>Murojaah gabungan setiap awal sesi</span>
                        </div>
                    </div>
                </div>

                <!-- Kelas 3 -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 space-y-4 hover:border-[#0D3B2E] hover:bg-white hover:shadow-md transition">
                    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                        <span class="editorial-label text-[#0D3B2E]">TINGKAT LANJUT</span>
                        <span class="text-xs font-mono font-bold text-[#B89758]">KELAS 3</span>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">Kelas 3 MDTA</h3>
                        <p class="text-xs text-[#4B6358]">Penyelesaian Juz 'Amma mutqin &amp; persiapan tasmi'</p>
                    </div>

                    <div class="p-4 rounded-xl bg-white border border-[#E5E0D8] space-y-2 shadow-2xs">
                        <span class="text-[10px] font-mono uppercase text-[#B89758] font-bold block">TARGET CAPAIAN RESMI</span>
                        <div class="font-sans font-bold text-lg text-[#0D3B2E]">
                            Surat Al-Ghasyiyah <span class="text-[#0D3B2E]">s/d</span> Surat An-Naba
                        </div>
                        <p class="text-[11px] text-[#4B6358] leading-relaxed">
                            Penyelesaian surat-surat pembuka Juz 30 hingga tuntas tasmi' Juz 30 secara utuh sekali duduk sebelum kelulusan.
                        </p>
                    </div>

                    <div class="text-[11px] text-[#4B6358] space-y-1.5 pt-1">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#0D3B2E]"></span>
                            <span>Ujian tasmi' akbar disaksikan dewan guru</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#0D3B2E]"></span>
                            <span>Sertifikat Syahadah Tahfidz Juz 'Amma</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom CTA Banner -->
            <div class="p-6 sm:p-8 bg-[#0D3B2E] rounded-2xl text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-md">
                <div class="space-y-1 text-center md:text-left">
                    <h3 class="font-sans font-bold text-xl sm:text-2xl text-white">
                        Daftarkan Putra/Putri Anda di MDTA Sore
                    </h3>
                    <p class="text-xs sm:text-sm text-emerald-100/80">
                        Infaq pendidikan terjangkau dengan pembinaan Al-Qur'an dan karakter Islami sejak dini.
                    </p>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-3 shrink-0">
                    <a href="{{ route('psb.form', ['program' => 'MDTA']) }}"
                        class="px-6 py-3 rounded-md bg-[#B89758] hover:bg-[#96783e] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                        Daftar MDTA Sore &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
