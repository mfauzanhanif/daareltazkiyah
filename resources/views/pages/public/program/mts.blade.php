@extends('layouts.public', ['title' => 'Madrasah Tsanawiyah (MTs) - PPMTQ Daar El Tazkiyah Sumardi'])

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
             style="background-image: url('{{ asset('images/foto-santri-2.webp') }}');">
        <!-- Dark Forest Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#042816] via-[#084C27]/90 to-[#042816]/85"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#B89758]/20 border border-[#B89758]/40 text-[#B89758] text-[11px] sm:text-xs font-semibold uppercase tracking-wider">
                <span>Pendidikan Formal Asrama 24 Jam</span>
            </div>
            <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.2]">
                Madrasah Tsanawiyah (MTs)
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-emerald-100/90 max-w-3xl mx-auto leading-relaxed">
                Pendidikan formal tingkat menengah pertama terpadu berbasis asrama mukim 24 jam dengan bimbingan asatidz intensif, tahfidzul Qur'an mutqin, serta kurikulum resmi Kementerian Agama Republik Indonesia.
            </p>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- SECTION 2: DESKRIPSI PROGRAM MTS -->
    <!-- ========================================================================= -->
    <section class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        DESKRIPSI PROGRAM MTS
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    Mengenal lebih dekat sistem pendidikan formal berasrama di Pondok Pesantren Modern Tahfidzul Qur'an Daar El Tazkiyah Sumardi.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                <!-- Left Column: Detailed Editorial Narrative -->
                <div class="lg:col-span-7 space-y-5 text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    <div class="p-5 sm:p-6 bg-white border border-[#E5E0D8] rounded-2xl space-y-4 shadow-xs">
                        <h3 class="font-sans font-bold text-lg sm:text-xl text-[#0D3B2E]">
                            Mencetak Cendekiawan Muslim Berjiwa Qur'ani &amp; Berwawasan Global
                        </h3>
                        <p>
                            <strong class="text-[#0D3B2E]">Madrasah Tsanawiyah (MTs) Daar El Tazkiyah Sumardi</strong> merupakan jenjang pendidikan formal setingkat Sekolah Menengah Pertama (SMP) yang diselenggarakan dengan sistem <strong class="text-[#0D3B2E]">Boarding School (Mukim Asrama 24 Jam)</strong> di Kp. Lembur Sawah, Desa Mekarbaru, Kecamatan Petir, Kabupaten Serang, Provinsi Banten.
                        </p>
                        <p>
                            Program ini dirancang secara integratif untuk menjawab kebutuhan orang tua yang menginginkan pendidikan akademik berkualitas tinggi sekaligus penanaman fondasi spiritual dan akhlak yang kuat. Santri dibina selama 24 jam penuh di bawah pengawasan asatidz dan musyrif huffadz yang berpengalaman.
                        </p>
                        <p>
                            Dengan kurikulum yang menginduk pada <strong class="text-[#0D3B2E]">Kementerian Agama Republik Indonesia (Kemenag RI)</strong>, setiap lulusan MTs Daar El Tazkiyah Sumardi berhak mendapatkan ijazah formal negara dan memiliki hak serta kesempatan yang sama untuk melanjutkan studi ke jenjang Madrasah Aliyah (MA), Sekolah Menengah Atas (SMA), Sekolah Menengah Kejuruan (SMK), maupun pondok pesantren lanjutan terbaik di seluruh Indonesia.
                        </p>
                    </div>

                    <!-- Highlight Pillars Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-white border border-[#E5E0D8] rounded-xl p-4.5 space-y-1.5 shadow-xs">
                            <div class="flex items-center gap-2 text-[#059669]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="font-sans font-bold text-sm text-[#0D3B2E]">Asrama 24 Jam Intensif</span>
                            </div>
                            <p class="text-xs text-[#4B6358]">
                                Pengawalan ibadah sholat 5 waktu berjamaah di masjid, qiyamul lail, shaum sunnah, dan adab keseharian santri.
                            </p>
                        </div>

                        <div class="bg-white border border-[#E5E0D8] rounded-xl p-4.5 space-y-1.5 shadow-xs">
                            <div class="flex items-center gap-2 text-[#059669]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                <span class="font-sans font-bold text-sm text-[#0D3B2E]">Tahfidz Terarah &amp; Mutqin</span>
                            </div>
                            <p class="text-xs text-[#4B6358]">
                                Target ziyadah terukur setiap hari dengan bimbingan talaqqi, disempurnakan tasmi' hafalan berkala.
                            </p>
                        </div>

                        <div class="bg-white border border-[#E5E0D8] rounded-xl p-4.5 space-y-1.5 shadow-xs">
                            <div class="flex items-center gap-2 text-[#059669]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span class="font-sans font-bold text-sm text-[#0D3B2E]">Ijazah Formal Kemenag</span>
                            </div>
                            <p class="text-xs text-[#4B6358]">
                                Kurikulum nasional terakreditasi sehingga kelulusan diakui sah oleh negara dan dinas pendidikan.
                            </p>
                        </div>

                        <div class="bg-white border border-[#E5E0D8] rounded-xl p-4.5 space-y-1.5 shadow-xs">
                            <div class="flex items-center gap-2 text-[#059669]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                <span class="font-sans font-bold text-sm text-[#0D3B2E]">Bahasa Arab &amp; Inggris</span>
                            </div>
                            <p class="text-xs text-[#4B6358]">
                                Pembiasaan lingkungan berbahasa (Biah Lughawiyyah) melalui mufradat harian dan muhadharah mingguan.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Program Profile Bento Card -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-6 shadow-sm">
                        <div class="border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label text-[#059669]">RINGKASAN PROGRAM</span>
                            <h3 class="font-sans font-extrabold text-xl sm:text-2xl text-[#0D3B2E] mt-1">
                                MTs Daar El Tazkiyah
                            </h3>
                        </div>

                        <div class="space-y-3.5 text-xs sm:text-sm">
                            <div class="flex justify-between items-center py-2 border-b border-[#E5E0D8]/60">
                                <span class="text-[#4B6358]">Jenjang Pendidikan</span>
                                <strong class="text-[#0D3B2E] font-sans">Setingkat SMP (Formal)</strong>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-[#E5E0D8]/60">
                                <span class="text-[#4B6358]">Sistem Pembelajaran</span>
                                <strong class="text-[#0D3B2E] font-sans">Boarding (Mukim 24 Jam)</strong>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-[#E5E0D8]/60">
                                <span class="text-[#4B6358]">Naungan Lembaga</span>
                                <strong class="text-[#0D3B2E] font-sans">Kementerian Agama RI</strong>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-[#E5E0D8]/60">
                                <span class="text-[#4B6358]">Target Kelulusan</span>
                                <strong class="text-[#0D3B2E] font-sans">Ijazah MTs &amp; Syahadah Tahfidz</strong>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-[#E5E0D8]/60">
                                <span class="text-[#4B6358]">Iuran Bulanan (Syahriyah)</span>
                                <strong class="text-[#0D3B2E] font-sans text-base text-[#059669]">Rp 500.000 <span class="text-xs font-normal text-gray-500">/ bln</span></strong>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-[#4B6358]">Biaya PSB Gelombang Aktif</span>
                                <strong class="text-[#B89758] font-sans">Rp {{ $feeMts }}</strong>
                            </div>
                        </div>

                        <div class="pt-2 space-y-3">
                            <a href="{{ route('psb.form', ['program' => 'MTS']) }}"
                                class="w-full inline-flex items-center justify-center gap-2 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs group">
                                <span>Daftar MTs Mukim Sekarang &rarr;</span>
                            </a>
                            @php
                                $cleanWa = preg_replace('/[^0-9]/', '', $waNumber);
                                if (str_starts_with($cleanWa, '0')) {
                                    $cleanWa = '62' . substr($cleanWa, 1);
                                }
                            @endphp
                            <a href="https://wa.me/{{ $cleanWa }}?text=Assalamu%27alaikum+Panitia+PSB+PPMTQ+Daar+El+Tazkiyah%2C+saya+ingin+konsultasi+mengenai+program+MTs+Mukim."
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-md border border-[#0D3B2E] hover:bg-[#0D3B2E] hover:text-white text-[#0D3B2E] text-xs font-semibold uppercase tracking-wider transition shadow-xs">
                                <span>Konsultasi WhatsApp Panitia</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- SECTION 3: KURIKULUM MTs -->
    <!-- ========================================================================= -->
    <section id="kurikulum-mts" class="py-12 md:py-16 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        KURIKULUM PEMBELAJARAN MTS
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    Struktur kurikulum terpadu yang memadukan standar akademik Kementerian Agama RI, tahfidzul Qur'an mutqin, kajian kitab turats salafiyah, dan kecakapan bahasa modern.
                </p>
            </div>

            <!-- 4 Curriculum Pillars Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                <!-- Pilar 1: Kurikulum Formal Kemenag RI -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-4 hover:border-[#0D3B2E] transition shadow-xs flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                            <span class="editorial-label text-[#059669]">PILAR 01 &bull; AKADEMIK NEGARA</span>
                            <span class="text-xs font-mono font-bold text-[#B89758]">RESMI KEMENAG</span>
                        </div>
                        <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">
                            Kurikulum Formal Kemenag RI &amp; Nasional
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Mata pelajaran standar nasional yang diujikan secara resmi guna menjamin penguasaan ilmu pengetahuan umum dan dasar-dasar syariat Islam yang komprehensif.
                        </p>
                        <div class="space-y-2 pt-2 text-xs text-[#18181B]">
                            <strong class="text-[#0D3B2E] block uppercase tracking-wider text-[11px]">Mata Pelajaran Agama (PAI):</strong>
                            <p class="text-[#4B6358]">Al-Qur'an Hadits, Aqidah Akhlak, Fiqih, Sejarah Kebudayaan Islam (SKI), dan Bahasa Arab.</p>
                            <strong class="text-[#0D3B2E] block uppercase tracking-wider text-[11px] pt-1">Mata Pelajaran Umum:</strong>
                            <p class="text-[#4B6358]">Matematika, IPA Terpadu (Fisika &amp; Biologi), IPS Terpadu, Bahasa Indonesia, Bahasa Inggris, Pendidikan Pancasila &amp; Kewarganegaraan (PPKn), Seni Budaya, dan Informatika.</p>
                        </div>
                    </div>
                </div>

                <!-- Pilar 2: Tahfidzul Qur'an Mutqin -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-4 hover:border-[#0D3B2E] transition shadow-xs flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                            <span class="editorial-label text-[#B89758]">PILAR 02 &bull; PROGRAM UNGGULAN</span>
                            <span class="text-xs font-mono font-bold text-[#059669]">TAHFIDZ MUTQIN</span>
                        </div>
                        <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">
                            Tahfidzul Qur'an &amp; Ulumul Qur'an
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Bimbingan menghafal Al-Qur'an dengan sistem talaqqi intensif bersama dewan asatidz huffadz bersanad, menitikberatkan pada tajwid yang kokoh dan kelancaran hafalan.
                        </p>
                        <ul class="space-y-2 pt-2 text-xs text-[#18181B]">
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#B89758] mt-1.5 shrink-0"></span>
                                <span><strong>Ziyadah Harian:</strong> Penambahan hafalan baru setiap hari secara bertahap dan terarah.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#B89758] mt-1.5 shrink-0"></span>
                                <span><strong>Murojaah Mandiri &amp; Berpasangan:</strong> Pengulangan hafalan lama pagi dan sore hari.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#B89758] mt-1.5 shrink-0"></span>
                                <span><strong>Tasmi' Berkala:</strong> Ujian memperdengarkan hafalan 1 juz, 5 juz, hingga 30 juz di hadapan para penguji.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Pilar 3: Kajian Kitab Salaf / Turats -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-4 hover:border-[#0D3B2E] transition shadow-xs flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                            <span class="editorial-label text-[#059669]">PILAR 03 &bull; KEPESANTRENAN</span>
                            <span class="text-xs font-mono font-bold text-[#B89758]">TURATS SALAFIYAH</span>
                        </div>
                        <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">
                            Kajian Kitab Kuning (Turats Salaf)
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Pendalaman khazanah keilmuan Islam klasik bersanad untuk membekali santri pemahaman teks Arab gundul dan kaidah hukum Islam yang mendalam.
                        </p>
                        <div class="grid grid-cols-2 gap-3 pt-2 text-xs">
                            <div class="p-3 bg-white rounded-xl border border-[#E5E0D8]/80">
                                <span class="font-bold text-[#0D3B2E] block">Nahwu &amp; Sharaf</span>
                                <span class="text-[11px] text-[#4B6358]">Matan Al-Ajurrumiyyah &amp; Al-Amtsilah At-Tashrifiyyah</span>
                            </div>
                            <div class="p-3 bg-white rounded-xl border border-[#E5E0D8]/80">
                                <span class="font-bold text-[#0D3B2E] block">Fiqih Syafi'i</span>
                                <span class="text-[11px] text-[#4B6358]">Mabadi' Al-Fiqhiyyah &amp; Safinatun Najah</span>
                            </div>
                            <div class="p-3 bg-white rounded-xl border border-[#E5E0D8]/80">
                                <span class="font-bold text-[#0D3B2E] block">Akhlak &amp; Adab</span>
                                <span class="text-[11px] text-[#4B6358]">Taisirul Khalaq &amp; Ta'limul Muta'allim</span>
                            </div>
                            <div class="p-3 bg-white rounded-xl border border-[#E5E0D8]/80">
                                <span class="font-bold text-[#0D3B2E] block">Hadits Nabawi</span>
                                <span class="text-[11px] text-[#4B6358]">Matan Al-Arba'in An-Nawawiyyah</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pilar 4: Bahasa & Pembinaan Karakter Asrama -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-4 hover:border-[#0D3B2E] transition shadow-xs flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                            <span class="editorial-label text-[#B89758]">PILAR 04 &bull; PEMBIASAAN 24 JAM</span>
                            <span class="text-xs font-mono font-bold text-[#059669]">BIAH LUGHAWIYYAH</span>
                        </div>
                        <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">
                            Bahasa Asing Aktif &amp; Kepemimpinan
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Pembentukan karakter santri mandiri, disiplin, berakhlak mulia, serta fasih berkomunikasi aktif dalam Bahasa Arab dan Bahasa Inggris.
                        </p>
                        <ul class="space-y-2 pt-2 text-xs text-[#18181B]">
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#059669] mt-1.5 shrink-0"></span>
                                <span><strong>Muhadatsah &amp; Conversation:</strong> Pemberian mufradat harian dan percakapan rutin di asrama.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#059669] mt-1.5 shrink-0"></span>
                                <span><strong>Muhadharah Khitobah:</strong> Latihan public speaking pidato 3 bahasa (Arab, Inggris, Indonesia).</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#059669] mt-1.5 shrink-0"></span>
                                <span><strong>Kedisiplinan &amp; Kebersihan:</strong> Budaya mandiri, piket harian, dan ketertiban asrama mukim.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bottom CTA Banner -->
            <div class="p-6 sm:p-8 bg-[#0D3B2E] rounded-2xl text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-md">
                <div class="space-y-1 text-center md:text-left">
                    <h3 class="font-sans font-bold text-xl sm:text-2xl text-white">
                        Tertarik Mendaftarkan Putra/Putri Anda ke MTs?
                    </h3>
                    <p class="text-xs sm:text-sm text-emerald-100/80">
                        Pendaftaran santri baru MTs PPMTQ Daar El Tazkiyah Sumardi dibuka secara online dengan kuota terbatas.
                    </p>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-3 shrink-0">
                    <a href="{{ route('psb.form', ['program' => 'MTS']) }}"
                        class="px-6 py-3 rounded-md bg-[#B89758] hover:bg-[#96783e] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                        Daftar MTs Sekarang &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
