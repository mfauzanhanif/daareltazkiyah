@extends('layouts.public', ['title' => 'Profil Pesantren & Legalitas - DAAR EL TAZKIYAH SUMARDI'])

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
            <div class="absolute inset-0 bg-gradient-to-t from-[#042816] via-[#084C27]/90 to-[#042816]/85"></div>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
                <h1
                    class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.2]">
                    Pondok Pesantren Modern Tahfidzul Qur'an Daar El Tazkiyah Sumardi
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-emerald-100/90 max-w-3xl mx-auto leading-relaxed">
                    Mencetak generasi Qur'ani yang berilmu amaliah, berakhlak mulia, berprestasi di tingkat nasional, dan
                    siap mengabdi untuk umat di Kabupaten Serang, Provinsi Banten.
                </p>
            </div>
        </section>

        <!-- 2. SECTION 1: SELAYANG PANDANG -->
        <section id="selayang-pandang" class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
                <!-- Centered Header -->
                <div class="text-center max-w-3xl mx-auto">
                    <div class="flex items-center justify-center gap-3 sm:gap-4">
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                        <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                            SELAYANG PANDANG
                        </h2>
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <!-- Left Column: Narrative -->
                    <div class="lg:col-span-7 space-y-6">
                        <div class="space-y-4 text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                            <p>
                                <strong class="text-[#0D3B2E]">Pondok Pesantren Modern Tahfidzul Qur'an (PPMTQ) Daar El
                                    Tazkiyah Sumardi</strong> didirikan di bawah naungan <strong
                                    class="text-[#0D3B2E]">Yayasan DAAR EL TAZKIYAH SUMARDI</strong> (resmi berdiri sejak 23
                                Juni 2025) yang berfokus pada pembentukan generasi Qur'ani yang beriman, berilmu amaliah,
                                dan berakhlak karimah.
                            </p>
                            <p>
                                Berlokasi asri dan kondusif di Kp. Lembur Sawah, Kelurahan/Desa Mekar Baru, Kecamatan Petir,
                                Kabupaten Serang, Provinsi Banten, pesantren ini memadukan kurikulum pendidikan formal dan
                                kepesantrenan terpadu dengan penyelenggaraan unit pendidikan diniyah resmi <strong
                                    class="text-[#0D3B2E]">MDT Ula DAAR EL TAZKIYAH SUMARDI</strong>.
                            </p>
                            <p>
                                Pesantren berlandaskan <em>tazkiyatun nufus</em> (penyucian jiwa), membekali santri dengan
                                ketertiban ibadah 24 jam di asrama mukim, keakraban bersama Al-Qur'an melalui metode ziyadah
                                dan murojaah harian terstruktur, serta kemandirian hidup santri.
                            </p>
                        </div>

                        <div class="pt-2 flex flex-wrap items-center gap-3 text-xs font-bold uppercase tracking-wider">
                            <a href="{{ route('psb.form') }}"
                                class="inline-flex items-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white transition shadow-xs">
                                <span>Daftar Santri Baru &rarr;</span>
                            </a>
                            <a href="#legalitas"
                                class="px-5 py-3 rounded-md border border-[#E5E0D8] hover:border-[#0D3B2E] bg-white text-[#0D3B2E] transition shadow-xs">
                                Lihat Legalitas Resmi &darr;
                            </a>
                        </div>
                    </div>

                    <!-- Right Column: Foto & Profil Pengasuh -->
                    <div class="lg:col-span-5 flex flex-col items-center">
                        <div class="w-full max-w-md bg-white border border-[#E5E0D8] rounded-2xl overflow-hidden shadow-md">
                            <div
                                class="aspect-4/5 relative overflow-hidden bg-gradient-to-b from-[#0D3B2E] to-[#042816] flex flex-col justify-end border-b border-[#E5E0D8]">
                                @if (file_exists(public_path('images/pengasuh-daar-el-tazkiyah.webp')))
                                    <img src="{{ asset('images/pengasuh-daar-el-tazkiyah.webp') }}"
                                        alt="Ust. Ahmad Ashil Fadhil, S.H., M.H." loading="lazy"
                                        class="absolute inset-0 w-full h-full object-cover object-top">
                                @elseif(file_exists(public_path('images/pengasuh daar el tazkiyah.webp')))
                                    <img src="{{ asset('images/pengasuh%20daar%20el%20tazkiyah.webp') }}"
                                        alt="Ust. Ahmad Ashil Fadhil, S.H., M.H." loading="lazy"
                                        class="absolute inset-0 w-full h-full object-cover object-top">
                                @else
                                    <div
                                        class="absolute inset-0 flex flex-col items-center justify-center text-white/20 pb-16 pointer-events-none">
                                        <img src="{{ asset('images/logo_daar_el_tazkiyah.svg') }}" alt="Logo"
                                            class="w-32 h-32 object-contain opacity-20"
                                            onerror="this.onerror=null; this.src='{{ asset('images/logo_daar_el_tazkiyah.png') }}';">
                                    </div>
                                @endif

                                <div
                                    class="relative z-10 bg-gradient-to-t from-[#084C27] via-[#084C27]/90 to-transparent p-6 text-center text-white space-y-1">
                                    <span
                                        class="text-amber-300 block text-[10px] font-mono uppercase tracking-widest font-bold">PIMPINAN
                                        &amp; PENGASUH PESANTREN</span>
                                    <h3 class="font-sans font-extrabold text-xl text-white tracking-tight">
                                        Ust. Ahmad Ashil Fadhil, S.H., M.H.
                                    </h3>
                                    <p class="text-xs text-emerald-100 font-medium">
                                        PPMTQ Daar El Tazkiyah Sumardi
                                    </p>
                                    <div class="text-xs text-amber-300/90 font-arabic pt-1" dir="rtl"
                                        style="line-height: 1.8;">
                                        حفظه الله تعالى ورعاه
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. SECTION 2: VISI & MISI -->
        <section id="visi-misi" class="py-12 md:py-16 bg-white border-b border-[#E5E0D8] scroll-mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
                <!-- Centered Header -->
                <div class="text-center max-w-3xl mx-auto">
                    <div class="flex items-center justify-center gap-3 sm:gap-4">
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                        <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                            VISI &amp; MISI
                        </h2>
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                    </div>
                </div>

                <!-- 2-Column Grid: Left Visi, Right 4 Misi Cards (Matching home.blade.php) -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-stretch">
                    <!-- Left Column: Visi (5 Cols) -->
                    <div
                        class="lg:col-span-5 bg-gradient-to-br from-[#0D3B2E] via-[#084C27] to-[#042816] rounded-2xl p-6 sm:p-8 lg:p-10 text-white shadow-md relative overflow-hidden border border-[#B89758]/30 flex flex-col justify-between">
                        <div
                            class="absolute -right-12 -bottom-12 w-56 h-56 bg-[#B89758]/15 rounded-full blur-3xl pointer-events-none">
                        </div>
                        <div
                            class="absolute -left-10 -top-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none">
                        </div>

                        <div class="relative z-10 space-y-4 sm:space-y-5">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-[1.5px] bg-amber-400"></span>
                                <span class="text-amber-400 text-xs font-bold tracking-[0.25em] uppercase">
                                    Visi Lembaga
                                </span>
                            </div>

                            <blockquote
                                class="font-sans font-extrabold text-xl sm:text-2xl lg:text-[26px] xl:text-[28px] text-white leading-snug">
                                "Melahirkan generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi, dan siap mengabdi
                                untuk umat."
                            </blockquote>
                        </div>

                        <div class="relative z-10 pt-6 mt-6 sm:mt-8 border-t border-white/15">
                            <span class="text-xs text-emerald-200/80 font-mono">PPMTQ Daar El Tazkiyah Sumardi</span>
                        </div>
                    </div>

                    <!-- Right Column: 4 Misi (7 Cols) -->
                    <div class="lg:col-span-7 flex flex-col justify-between space-y-4">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-6 h-[1.5px] bg-[#084C27]"></span>
                            <span class="text-[#084C27] text-xs font-bold tracking-[0.25em] uppercase">
                                4 Pilar Misi Pendidikan
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 h-full">
                            <!-- Misi 1 -->
                            <div
                                class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-5 sm:p-6 space-y-2 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group flex flex-col justify-center">
                                <h3
                                    class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E] group-hover:text-[#059669] transition leading-snug">
                                    <span class="text-[#B89758] mr-1.5">1.</span>Menanamkan kecintaan kepada Al-Qur'an
                                </h3>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Membina tilawah tajwid dan hafalan mutqin 30 juz Al-Qur'an sejak dini melalui halaqah
                                    terarah.
                                </p>
                            </div>

                            <!-- Misi 2 -->
                            <div
                                class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-5 sm:p-6 space-y-2 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group flex flex-col justify-center">
                                <h3
                                    class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E] group-hover:text-[#059669] transition leading-snug">
                                    <span class="text-[#B89758] mr-1.5">2.</span>Membentuk akhlak mulia dan disiplin
                                </h3>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Membiasakan adab Islami, sholat berjamaah tepat waktu di masjid, dan kemandirian asrama
                                    santri.
                                </p>
                            </div>

                            <!-- Misi 3 -->
                            <div
                                class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-5 sm:p-6 space-y-2 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group flex flex-col justify-center">
                                <h3
                                    class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E] group-hover:text-[#059669] transition leading-snug">
                                    <span class="text-[#B89758] mr-1.5">3.</span>Memberikan pendidikan berkualitas berbasis
                                    Islam
                                </h3>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Memadukan kurikulum salafiyah kepesantrenan dengan pendidikan formal nasional
                                    Kementerian Agama RI.
                                </p>
                            </div>

                            <!-- Misi 4 -->
                            <div
                                class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-5 sm:p-6 space-y-2 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group flex flex-col justify-center">
                                <h3
                                    class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E] group-hover:text-[#059669] transition leading-snug">
                                    <span class="text-[#B89758] mr-1.5">4.</span>Mempersiapkan santri berprestasi di tingkat
                                    nasional
                                </h3>
                                <p class="text-xs text-[#4B6358] leading-relaxed">
                                    Mengasah potensi santri pada Musabaqah Hifdzil Qur'an (MHQ), sains madrasah, dan dakwah
                                    dwibahasa.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. SECTION 3: FASILITAS PESANTREN -->
        <section id="fasilitas" class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
                <!-- Centered Header -->
                <div class="text-center max-w-3xl mx-auto">
                    <div class="flex items-center justify-center gap-3 sm:gap-4">
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                        <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                            FASILITAS PESANTREN
                        </h2>
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                    </div>
                </div>

                <!-- 7 Facilities Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <!-- 1. Ruang Kelas -->
                    <div
                        class="bg-white border border-[#E5E0D8] rounded-2xl overflow-hidden hover:border-[#0D3B2E] hover:shadow-md transition group">
                        <x-public.image-placeholder title="Ruang Kelas Nyaman" aspect="aspect-16/10" />
                        <div class="p-5 space-y-1.5">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                                Ruang Kelas yang Nyaman
                            </h3>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Ruang belajar berpendingin udara dan sirkulasi alami yang asri, meja individu, dan sarana
                                multimedia.
                            </p>
                        </div>
                    </div>

                    <!-- 2. Masjid -->
                    <div
                        class="bg-white border border-[#E5E0D8] rounded-2xl overflow-hidden hover:border-[#0D3B2E] hover:shadow-md transition group">
                        <x-public.image-placeholder title="Masjid Pesantren" aspect="aspect-16/10" />
                        <div class="p-5 space-y-1.5">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                                Masjid Jami' Pesantren
                            </h3>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Pusat peribadahan sholat berjamaah 5 waktu, halaqah tahfidz ba'da Subuh dan Maghrib, serta
                                kajian kitab kuning.
                            </p>
                        </div>
                    </div>

                    <!-- 3. Asrama Santri -->
                    <div
                        class="bg-white border border-[#E5E0D8] rounded-2xl overflow-hidden hover:border-[#0D3B2E] hover:shadow-md transition group">
                        <x-public.image-placeholder title="Asrama Santri Mukim" aspect="aspect-16/10" />
                        <div class="p-5 space-y-1.5">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                                Gedung Asrama Santri
                            </h3>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Hunian mukim santri 24 jam dengan tempat tidur kasur nyaman, lemari rapi, dan pendampingan
                                musyrif asrama.
                            </p>
                        </div>
                    </div>

                    <!-- 4. Perpustakaan -->
                    <div
                        class="bg-white border border-[#E5E0D8] rounded-2xl overflow-hidden hover:border-[#0D3B2E] hover:shadow-md transition group">
                        <x-public.image-placeholder title="Perpustakaan Santri" aspect="aspect-16/10" />
                        <div class="p-5 space-y-1.5">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                                Perpustakaan &amp; Ruang Baca
                            </h3>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Koleksi kitab turats salafiyah, tafsir Al-Qur'an, kamus dwibahasa Arab-Inggris, dan buku
                                referensi akademik.
                            </p>
                        </div>
                    </div>

                    <!-- 5. UKS -->
                    <div
                        class="bg-white border border-[#E5E0D8] rounded-2xl overflow-hidden hover:border-[#0D3B2E] hover:shadow-md transition group">
                        <x-public.image-placeholder title="Unit Kesehatan Santri" aspect="aspect-16/10" />
                        <div class="p-5 space-y-1.5">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                                Unit Kesehatan Santri (UKS)
                            </h3>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Layanan pertolongan pertama, obat-obatan dasar, serta pemantauan kesehatan berkala bagi
                                seluruh santri pondok.
                            </p>
                        </div>
                    </div>

                    <!-- 6. Dapur Umum -->
                    <div
                        class="bg-white border border-[#E5E0D8] rounded-2xl overflow-hidden hover:border-[#0D3B2E] hover:shadow-md transition group">
                        <x-public.image-placeholder title="Dapur Umum Santri" aspect="aspect-16/10" />
                        <div class="p-5 space-y-1.5">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                                Dapur Umum Higienis
                            </h3>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Pengolahan konsumsi santri 3 kali sehari dengan menu bergizi, higienis, bersih, dan jadwal
                                makan teratur.
                            </p>
                        </div>
                    </div>

                    <!-- 7. Kantin & Koperasi -->
                    <div
                        class="bg-white border border-[#E5E0D8] rounded-2xl overflow-hidden hover:border-[#0D3B2E] hover:shadow-md transition group">
                        <x-public.image-placeholder title="Kantin Pesantren" aspect="aspect-16/10" />
                        <div class="p-5 space-y-1.5">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                                Kantin &amp; Koperasi Santri
                            </h3>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Penyedia kebutuhan harian santri, alat tulis madrasah, perlengkapan mandi &amp; mencuci, dan
                                makanan ringan halal thoyyib.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. SECTION 4: DEWAN PENDIDIK & ASATIDZ -->
        <section id="pendidik" class="py-12 md:py-16 bg-white border-b border-[#E5E0D8] scroll-mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
                <!-- Centered Header -->
                <div class="text-center max-w-3xl mx-auto">
                    <div class="flex items-center justify-center gap-3 sm:gap-4">
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                        <h2
                            class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                            DEWAN PENDIDIK &amp; ASATIDZ
                        </h2>
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                    </div>
                </div>

                <!-- Asatidz Showcase Card -->
                <div
                    class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 sm:p-8 shadow-xs">
                    <!-- Left: Dewan Pengajar Visual -->
                    <div
                        class="lg:col-span-6 bg-gradient-to-br from-[#084C27] via-[#0D3B2E] to-[#14532D] rounded-xl p-6 sm:p-8 text-white relative overflow-hidden flex flex-col items-center justify-between min-h-[300px]">
                        <div class="text-center space-y-1 relative z-10">
                            <span class="text-amber-300 text-[10px] font-mono uppercase tracking-widest font-bold">DEWAN
                                ASATIDZAH &amp; PENDIDIK</span>
                            <h3 class="font-sans font-extrabold text-xl sm:text-2xl text-white tracking-tight">
                                Keluarga Besar Asatidz Pesantren
                            </h3>
                            <p class="text-xs text-emerald-100/90 max-w-md mx-auto">
                                Membina kurikulum kepesantrenan, tahfidzul Qur'an mutqin, bahasa Arab, dan pembentukan
                                karakter santri.
                            </p>
                        </div>

                        <div class="relative z-10 w-full mt-4 flex justify-center">
                            @if (file_exists(public_path('images/dewan-pengajar-transparan.webp')))
                                <img src="{{ asset('images/dewan-pengajar-transparan.webp') }}"
                                    alt="Dewan Pengajar Daar El Tazkiyah Sumardi" loading="lazy"
                                    class="max-h-60 sm:max-h-64 w-auto object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-300">
                            @elseif(file_exists(public_path('images/dewan pengajar (latar transfaran).webp')))
                                <img src="{{ asset('images/dewan%20pengajar%20(latar%20transfaran).webp') }}"
                                    alt="Dewan Pengajar Daar El Tazkiyah Sumardi" loading="lazy"
                                    class="max-h-60 sm:max-h-64 w-auto object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-300">
                            @endif
                        </div>
                    </div>

                    <!-- Right: Educator Highlight -->
                    <div class="lg:col-span-6 space-y-4">
                        <div class="border border-[#E5E0D8] rounded-xl overflow-hidden group shadow-xs">
                            <div class="aspect-16/10 relative overflow-hidden bg-gray-100 cursor-pointer"
                                @click="openModal('{{ asset('images/foto-pengajar.webp') }}', 'Foto Bersama Dewan Pengajar PPMTQ Daar El Tazkiyah')">
                                @if (file_exists(public_path('images/foto-pengajar.webp')))
                                    <img src="{{ asset('images/foto-pengajar.webp') }}"
                                        alt="Foto Pengajar PPMTQ Daar El Tazkiyah" loading="lazy"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @elseif(file_exists(public_path('images/foto pengajar.webp')))
                                    <img src="{{ asset('images/foto%20pengajar.webp') }}"
                                        alt="Foto Pengajar PPMTQ Daar El Tazkiyah" loading="lazy"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                                <div
                                    class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold gap-1.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                    </svg>
                                    <span>Perbesar Foto Pengajar</span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <span
                                class="text-[10px] font-mono uppercase tracking-wider text-[#059669] font-bold">PEMBIMBING
                                BERINTEGRITAS</span>
                            <h4 class="font-sans font-bold text-base text-[#0D3B2E]">Komitmen Pendidik Berakhlakul Karimah
                            </h4>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Santri didampingi langsung oleh <strong>Ust. Ahmad Ashil Fadhil, S.H., M.H.</strong> selaku
                                Pengasuh Pesantren bersama asatidz huffadz dalam setoran hafalan Al-Qur'an dan pembiasaan
                                adab harian.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Teachers Individual Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($teachers as $teacher)
                        <div
                            class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-5 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-[#0D3B2E] border-2 border-[#B89758] flex items-center justify-center text-white font-sans font-bold text-base shadow-xs shrink-0">
                                    {{ Str::substr($teacher->full_name, 0, 1) }}
                                </div>
                                <div class="min-w-0">
                                    <h3
                                        class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition leading-snug">
                                        {{ $teacher->full_name }}
                                    </h3>
                                    <p class="text-xs text-[#059669] font-medium mt-0.5">
                                        {{ $teacher->role_title }}
                                    </p>
                                    @if ($teacher->specialization)
                                        <span class="inline-block text-[11px] text-[#4B6358] mt-1">
                                            Bidang: {{ $teacher->specialization }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full text-center py-8 bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl text-xs text-[#4B6358]">
                            Belum ada data asatidz yang dipublikasikan.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- 6. SECTION 5: LEGALITAS LEMBAGA -->
        <section id="legalitas" class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
                <!-- Centered Header -->
                <div class="text-center max-w-3xl mx-auto">
                    <div class="flex items-center justify-center gap-3 sm:gap-4">
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                        <h2
                            class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                            LEGALITAS RESMI LEMBAGA
                        </h2>
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                    </div>
                </div>

                <!-- Legal Grid: 2 Columns -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                    <!-- Left: 7 Columns Legal Identitas -->
                    <div
                        class="lg:col-span-7 bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-8 space-y-6 flex flex-col justify-between shadow-xs">
                        <div class="space-y-4">
                            <div class="border-b border-[#E5E0D8] pb-3 flex items-center justify-between">
                                <span class="text-xs font-mono font-bold text-[#0D3B2E] uppercase">IDENTITAS HUKUM
                                    PESANTREN</span>
                                <span
                                    class="text-xs font-mono text-[#059669] font-bold px-2 py-0.5 bg-emerald-50 rounded border border-emerald-200">
                                    Sah &amp; Terverifikasi
                                </span>
                            </div>

                            <div class="divide-y divide-[#E5E0D8] text-xs sm:text-sm">
                                <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                    <span class="text-[#4B6358] font-medium">Yayasan Penyelenggara:</span>
                                    <strong class="text-[#0D3B2E] font-bold text-right">Yayasan DAAR EL TAZKIYAH
                                        SUMARDI</strong>
                                </div>
                                <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                    <span class="text-[#4B6358] font-medium">Unit Pendidikan Diniyah:</span>
                                    <strong class="text-[#0D3B2E] font-bold text-right">MDT Ula DAAR EL TAZKIYAH
                                        SUMARDI</strong>
                                </div>
                                <div class="py-3 flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                                    <span class="text-[#4B6358] font-medium">Nomor Izin Operasional (Ijop):</span>
                                    <div class="text-right">
                                        <strong class="text-[#0D3B2E] font-bold block">Nomor: 0355</strong>
                                        <span class="text-[11px] text-[#4B6358] block">Piagam Kemenag Kantor Kabupaten
                                            Serang</span>
                                        <span class="text-[10px] text-[#B89758] font-mono block">Ditetapkan: 28 Oktober
                                            2026</span>
                                    </div>
                                </div>
                                <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                    <span class="text-[#4B6358] font-medium">Nomor Statistik MDT (NSMDT):</span>
                                    <strong
                                        class="text-[#0D3B2E] font-mono font-bold tracking-wider text-base text-right">311236041251</strong>
                                </div>
                                <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                    <span class="text-[#4B6358] font-medium">Tahun Berdiri Yayasan:</span>
                                    <strong class="text-[#0D3B2E] font-bold text-right">23 Juni 2025</strong>
                                </div>
                                <div class="py-3 flex flex-col sm:flex-row sm:items-start justify-between gap-1">
                                    <span class="text-[#4B6358] font-medium">Alamat Lembaga Lengkap:</span>
                                    <span class="text-[#0D3B2E] font-semibold text-right max-w-sm">
                                        Kp. Lembur Sawah, Kel./Desa Mekar Baru, Kecamatan Petir, Kab. Serang, Provinsi
                                        Banten.
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- 4 Slogans -->
                        <div class="pt-4 border-t border-[#E5E0D8] space-y-3">
                            <span
                                class="text-[10px] font-mono font-bold text-[#B89758] tracking-widest uppercase block">MOTTO
                                &amp; SLOGAN</span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                <div class="p-3 rounded-lg bg-[#FAF8F5] border border-[#E5E0D8] flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-[#059669] shrink-0"></span>
                                    <span class="text-xs font-semibold text-[#0D3B2E]">&ldquo;Ilmu - Iman - Amal -
                                        Akhlak&rdquo;</span>
                                </div>
                                <div class="p-3 rounded-lg bg-[#FAF8F5] border border-[#E5E0D8] flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-[#B89758] shrink-0"></span>
                                    <span class="text-xs font-semibold text-[#0D3B2E]">&ldquo;Berilmu, Berakhlak,
                                        Berprestasi&rdquo;</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: 5 Columns Certificate Preview -->
                    <div
                        class="lg:col-span-5 bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-8 space-y-5 flex flex-col justify-between shadow-xs">
                        <div>
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3 mb-4">
                                <span class="text-xs font-mono font-bold text-[#059669] uppercase">BUKTI PIAGAM
                                    RESMI</span>
                                <span class="text-[10px] font-mono text-[#4B6358]">Kemenag Serang</span>
                            </div>

                            <div
                                class="border-2 border-dashed border-[#B89758]/50 rounded-xl p-4 bg-[#FAF8F5] text-center space-y-3 relative group">
                                @php
                                    $ijopFile = 'images/Ijop MDTA.jpg';
                                    $ijopExists = file_exists(public_path($ijopFile));
                                @endphp

                                @if ($ijopExists)
                                    <div class="relative aspect-4/3 overflow-hidden rounded-lg bg-gray-100 cursor-pointer shadow-xs"
                                        @click="openModal('{{ asset($ijopFile) }}', 'Piagam Izin Operasional MDT Ula No. 0355')">
                                        <img src="{{ asset($ijopFile) }}"
                                            alt="Piagam Izin Operasional MDT Ula Nomor 0355" loading="lazy"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        <div
                                            class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold gap-1.5">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                            <span>Klik untuk Memperbesar</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="py-6 px-4 bg-white border border-[#E5E0D8] rounded-xl shadow-xs space-y-3">
                                        <div
                                            class="w-14 h-14 mx-auto rounded-full bg-emerald-50 border-2 border-[#B89758] flex items-center justify-center text-[#0D3B2E]">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <div class="space-y-1">
                                            <span
                                                class="text-[10px] font-mono uppercase tracking-widest text-[#B89758] font-bold block">KEMENTERIAN
                                                AGAMA RI</span>
                                            <h4 class="font-sans font-bold text-base text-[#0D3B2E]">Piagam Izin
                                                Operasional MDTA</h4>
                                            <p class="text-xs font-mono text-[#059669] font-bold">Nomor: 0355</p>
                                        </div>
                                        <div class="pt-2 text-[10px] font-mono text-[#4B6358] border-t border-[#E5E0D8]">
                                            NSMDT: 311236041251 &bull; Kemenag Kab. Serang
                                        </div>
                                    </div>
                                @endif

                                <div class="text-left space-y-1 text-xs text-[#4B6358] pt-1">
                                    <p><strong class="text-[#0D3B2E]">Dokumen:</strong> Piagam Izin Operasional MDTA</p>
                                    <p><strong class="text-[#0D3B2E]">Penerbit:</strong> Kemenag Kabupaten Serang</p>
                                    <p><strong class="text-[#0D3B2E]">Status:</strong> Sah &amp; Terdaftar Resmi</p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 flex flex-col sm:flex-row items-center gap-3">
                            @if ($ijopExists)
                                <button type="button"
                                    @click="openModal('{{ asset($ijopFile) }}', 'Piagam Izin Operasional MDT Ula No. 0355')"
                                    class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                                    <span>Preview Piagam Asli</span>
                                </button>
                            @else
                                <a href="{{ route('contact.index') }}"
                                    class="w-full inline-flex items-center justify-center gap-2 py-3 px-4 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                                    <span>Hubungi Sekretariat &rarr;</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- IMAGE PREVIEW / LIGHTBOX MODAL -->
        <div x-show="showModal" x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4 sm:p-6"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.self="closeModal()">

            <div class="relative bg-white rounded-xl overflow-hidden max-w-4xl w-full max-h-[90vh] flex flex-col shadow-2xl border border-white/20"
                @click.stop>

                <div class="flex items-center justify-between px-5 py-3.5 bg-[#FAF8F5] border-b border-[#E5E0D8]">
                    <h3 class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E]" x-text="modalTitle"></h3>
                    <button type="button" @click="closeModal()"
                        class="p-1.5 rounded-md hover:bg-gray-200 text-gray-600 transition" aria-label="Tutup">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="overflow-auto p-4 flex items-center justify-center bg-[#18181B]/5">
                    <img :src="modalImage" :alt="modalTitle"
                        class="max-h-[72vh] w-auto max-w-full object-contain rounded shadow-xs">
                </div>

                <div class="px-5 py-3 bg-[#FAF8F5] border-t border-[#E5E0D8] flex items-center justify-between text-xs">
                    <span class="text-[#4B6358]">PPMTQ DAAR EL TAZKIYAH SUMARDI</span>
                    <button type="button" @click="closeModal()"
                        class="px-4 py-1.5 rounded bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold transition">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection
