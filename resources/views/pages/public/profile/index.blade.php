@extends('layouts.public', ['title' => 'Profil - Daar El Tazkiyah Sumardi'])

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
                    Profil Daar El Tazkiyah Sumardi
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
                                    VISI
                                </span>
                            </div>

                            <blockquote
                                class="font-sans font-extrabold text-xl sm:text-2xl lg:text-[26px] xl:text-[28px] text-white leading-snug">
                                "Melahirkan generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi, dan siap mengabdi
                                untuk umat."
                            </blockquote>
                        </div>

                        <div class="relative z-10 pt-6 mt-6 sm:mt-8 border-t border-white/15">
                        </div>
                    </div>

                    <!-- Right Column: 4 Misi (7 Cols) -->
                    <div class="lg:col-span-7 flex flex-col justify-between space-y-4">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-6 h-[1.5px] bg-[#084C27]"></span>
                            <span class="text-[#084C27] text-xs font-bold tracking-[0.25em] uppercase">
                                MISI
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
                            </div>

                            <!-- Misi 2 -->
                            <div
                                class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-5 sm:p-6 space-y-2 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group flex flex-col justify-center">
                                <h3
                                    class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E] group-hover:text-[#059669] transition leading-snug">
                                    <span class="text-[#B89758] mr-1.5">2.</span>Membentuk akhlak mulia dan disiplin
                                </h3>
                            </div>

                            <!-- Misi 3 -->
                            <div
                                class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-5 sm:p-6 space-y-2 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group flex flex-col justify-center">
                                <h3
                                    class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E] group-hover:text-[#059669] transition leading-snug">
                                    <span class="text-[#B89758] mr-1.5">3.</span>Memberikan pendidikan berkualitas berbasis
                                    Islam
                                </h3>
                            </div>

                            <!-- Misi 4 -->
                            <div
                                class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-5 sm:p-6 space-y-2 hover:border-[#0D3B2E] hover:bg-white hover:shadow-xs transition group flex flex-col justify-center">
                                <h3
                                    class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E] group-hover:text-[#059669] transition leading-snug">
                                    <span class="text-[#B89758] mr-1.5">4.</span>Mempersiapkan santri berprestasi di tingkat
                                    nasional
                                </h3>
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
        <section id="pendidik" class="py-16 md:py-24 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

                <!-- Editorial Header -->
                <div class="text-center max-w-3xl mx-auto">
                    <div class="flex items-center justify-center gap-3 sm:gap-4">
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                        <h2
                            class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                            DEWAN PENDIDIK
                        </h2>
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                    </div>
                </div>

                <!-- Featured Showcase Banner -->
                <div class="bg-white border border-[#E5E0D8] rounded-3xl overflow-hidden shadow-sm">
                    <div class="grid grid-cols-1 lg:grid-cols-12 items-stretch">

                        <!-- Left: Narrative (5 Cols) -->
                        <div
                            class="lg:col-span-5 p-8 sm:p-10 lg:p-12 flex flex-col justify-center bg-gradient-to-br from-[#0D3B2E] via-[#0A2E24] to-[#07221A] text-white relative overflow-hidden">
                            <!-- Subtle Glow Accent -->
                            <div
                                class="absolute -right-16 -bottom-16 w-64 h-64 rounded-full bg-[#B89758]/10 blur-2xl pointer-events-none">
                            </div>

                            <div class="space-y-4 relative z-10">
                                <div class="w-10 h-1 bg-[#B89758] rounded-full"></div>

                                <h3 class="text-2xl sm:text-3xl font-bold leading-snug tracking-tight text-white">
                                    Mendidik dengan Hati, Membina dengan Keteladanan Adab
                                </h3>

                                <p class="text-sm text-emerald-100/85 leading-relaxed">
                                    Setiap santri didampingi secara intensif oleh jajaran Dewan Asatidz huffadz dan praktisi
                                    pendidikan berpengalaman dalam setoran hafalan Al-Qur'an serta pembiasaan adab harian.
                                </p>
                            </div>
                        </div>

                        <!-- Right: Interactive Group Photo (7 Cols) -->
                        <div class="lg:col-span-7 relative bg-[#F3EFEA] min-h-[280px] sm:min-h-[360px] overflow-hidden group cursor-pointer"
                            @click="openModal('{{ asset('images/foto-pengajar.webp') }}', 'Foto Bersama Dewan Pengajar PPMTQ Daar El Tazkiyah')">

                            @if (file_exists(public_path('images/foto-pengajar.webp')))
                                <img src="{{ asset('images/foto-pengajar.webp') }}"
                                    alt="Dewan Pengajar PPMTQ Daar El Tazkiyah" loading="lazy"
                                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                            @elseif(file_exists(public_path('images/foto pengajar.webp')))
                                <img src="{{ asset('images/foto%20pengajar.webp') }}"
                                    alt="Dewan Pengajar PPMTQ Daar El Tazkiyah" loading="lazy"
                                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                            @elseif(file_exists(public_path('images/dewan-pengajar-transparan.webp')))
                                <img src="{{ asset('images/dewan-pengajar-transparan.webp') }}"
                                    alt="Dewan Pengajar Daar El Tazkiyah Sumardi" loading="lazy"
                                    class="w-full h-full object-contain object-bottom pt-6 px-4 group-hover:scale-105 transition-transform duration-700">
                            @endif

                            <!-- Subtle Bottom Gradient & Action Pill -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#0D3B2E]/70 via-transparent to-transparent opacity-90 group-hover:opacity-100 transition-opacity">
                            </div>

                            <div class="absolute bottom-5 left-5 right-5 flex items-center justify-between text-white">
                                <span class="text-xs sm:text-sm font-medium text-white/90 drop-shadow-xs">
                                    Jajaran Dewan Asatidz &amp; Tenaga Pendidik
                                </span>
                                <span
                                    class="inline-flex items-center gap-2 bg-white/95 text-[#0D3B2E] px-3.5 py-2 rounded-full text-xs font-bold shadow-md group-hover:bg-[#B89758] group-hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                    </svg>
                                    Perbesar Foto
                                </span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Teachers Name-Only Directory Grid -->
                <div class="space-y-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-[#0D3B2E]">Jajaran Pengajar &amp; Pembina</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($teachers as $teacher)
                            @php
                                // Mengambil inisial dari nama asli (melewati gelar Ust., Ustz., Ibu, Bapak, Hj., H.)
                                $cleanName = preg_replace(
                                    '/^(Ust\.|Ustz\.|Ustadz|Ustadzah|Ibu|Bapak|Bp\.|Hj\.|H\.)\s+/i',
                                    '',
                                    $teacher->full_name,
                                );
                                $cleanName = preg_replace('/^(Hj\.|H\.)\s+/i', '', $cleanName);
                                $initial = Str::upper(Str::substr(trim($cleanName), 0, 1));
                            @endphp

                            <div
                                class="group bg-white border border-[#E5E0D8] rounded-xl p-4 hover:border-[#0D3B2E] hover:shadow-sm transition-all duration-200 flex items-center gap-3.5">
                                <!-- Initials Avatar -->
                                <div
                                    class="w-10 h-10 rounded-lg bg-[#FAF8F5] border border-[#E5E0D8] group-hover:bg-[#0D3B2E] group-hover:border-[#0D3B2E] flex items-center justify-center text-[#0D3B2E] group-hover:text-[#E5C88E] font-sans font-bold text-sm transition-colors shrink-0">
                                    {{ $initial }}
                                </div>

                                <!-- Teacher Full Name Only -->
                                <h4
                                    class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E] group-hover:text-[#059669] transition-colors leading-snug truncate">
                                    {{ $teacher->full_name }}
                                </h4>
                            </div>
                        @empty
                            <div
                                class="col-span-full text-center py-10 bg-white border border-dashed border-[#E5E0D8] rounded-2xl text-sm text-[#4B6358]">
                                Belum ada data asatidz yang dipublikasikan.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </section>

        <!-- 6. SECTION 5: LEGALITAS LEMBAGA -->
        <section id="legalitas" class="py-16 md:py-24 bg-white border-b border-[#E5E0D8] scroll-mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

                <!-- Simple Left-Aligned Header -->
                <div class="text-center max-w-3xl mx-auto">
                    <div class="flex items-center justify-center gap-3 sm:gap-4">
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                        <h2
                            class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                            LEGALITAS
                        </h2>
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                    </div>
                </div>

                <!-- Single Clean Card with 2-Column Data Grid -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 sm:p-10">
                    <h3 class="text-lg font-bold text-[#0D3B2E] mb-6">
                        Identitas Hukum Pesantren
                    </h3>

                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 text-sm">
                        <div class="border-b border-[#E5E0D8] pb-4">
                            <dt class="text-[#4B6358] text-xs mb-1">Yayasan Penyelenggara</dt>
                            <dd class="font-bold text-[#0D3B2E] text-base">Yayasan Daar El Tazkiyah Sumardi</dd>
                        </div>

                        <div class="border-b border-[#E5E0D8] pb-4">
                            <dt class="text-[#4B6358] text-xs mb-1">Unit Pendidikan Diniyah</dt>
                            <dd class="font-bold text-[#0D3B2E] text-base">MDT Ula Daar El Tazkiyah Sumardi</dd>
                        </div>

                        <div class="border-b border-[#E5E0D8] pb-4">
                            <dt class="text-[#4B6358] text-xs mb-1">Nomor Izin Operasional (Ijop)</dt>
                            <dd class="font-bold text-[#0D3B2E]">
                                Nomor: 0355 <span class="font-normal text-[#4B6358]">— Kemenag Kab. Serang (28 Oktober
                                    2026)</span>
                            </dd>
                        </div>

                        <div class="border-b border-[#E5E0D8] pb-4">
                            <dt class="text-[#4B6358] text-xs mb-1">Nomor Statistik MDT (NSMDT)</dt>
                            <dd class="font-bold text-[#0D3B2E]">311236041251</dd>
                        </div>

                        <div class="border-b border-[#E5E0D8] pb-4">
                            <dt class="text-[#4B6358] text-xs mb-1">Tanggal Berdiri Yayasan</dt>
                            <dd class="font-bold text-[#0D3B2E]">23 Juni 2025</dd>
                        </div>

                        <div class="border-b border-[#E5E0D8] pb-4">
                            <dt class="text-[#4B6358] text-xs mb-1">Motto Pendidikan</dt>
                            <dd class="font-medium italic text-[#0D3B2E]">
                                &ldquo;Ilmu, Iman, Amal, Akhlak &mdash; Berilmu, Berakhlak, Berprestasi&rdquo;
                            </dd>
                        </div>

                        <div class="md:col-span-2 pt-1">
                            <dt class="text-[#4B6358] text-xs mb-1">Alamat Lengkap Lembaga</dt>
                            <dd class="font-semibold text-[#0D3B2E]">
                                Kp. Lembur Sawah, Desa Mekar Baru, Kecamatan Petir, Kabupaten Serang, Provinsi Banten.
                            </dd>
                        </div>
                    </dl>
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
