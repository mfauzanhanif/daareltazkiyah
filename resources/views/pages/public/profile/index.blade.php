@extends('layouts.public', ['title' => 'Profil Pesantren - PPMTQ Daar El Tazkiyah Sumardi'])

@section('content')
    <!-- Page Header (Editorial Academic Banner) -->
    <section class="bg-white border-b border-[#E5E0D8] pt-12 pb-14 md:pt-16 md:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#0D3B2E] tracking-tight leading-[1.15]">
                    Pondok Pesantren Modern Tahfidzul Qur'an Daar El Tazkiyah Sumardi
                </h1>
                <p class="text-base sm:text-lg text-[#4B6358] leading-relaxed">
                    Mencetak generasi Qur'ani yang berilmu amaliah, berakhlak mulia, berprestasi di tingkat nasional, dan siap mengabdi untuk umat di Kabupaten Serang, Provinsi Banten.
                </p>
                <div class="flex flex-wrap items-center gap-3 pt-2 text-xs font-bold uppercase tracking-wider">
                    <a href="#selayang-pandang" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                        &darr; Selayang Pandang
                    </a>
                    <a href="#visi-misi" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                        &darr; Visi & Misi
                    </a>
                    <a href="#fasilitas" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                        &darr; Fasilitas
                    </a>
                    <a href="#pendidik" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                        &darr; Pendidik
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 1: SELAYANG PANDANG (WITH PENGASUH PHOTO ON RIGHT) -->
    <section id="selayang-pandang" class="py-16 md:py-24 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                <!-- Left Column: Selayang Pandang Text -->
                <div class="lg:col-span-7 space-y-6">
                    <div class="space-y-2">
                        <span class="editorial-label text-[#059669]">SELAYANG PANDANG</span>
                        <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                            Membangun Peradaban Melalui Generasi Qur'ani
                        </h2>
                    </div>

                    <div class="space-y-4 text-sm sm:text-base text-[#4B6358] leading-relaxed">
                        <p>
                            <strong class="text-[#0D3B2E]">Pondok Pesantren Modern Tahfidzul Qur'an (PPMTQ) Daar El Tazkiyah Sumardi</strong> adalah lembaga pendidikan Islam yang berfokus pada pembentukan generasi Qur'ani. Berlokasi di Kabupaten Serang, Banten, pesantren ini memadukan kurikulum pendidikan formal dan kepesantrenan untuk mencetak santri yang unggul dalam ilmu agama maupun umum, berakhlak mulia, berprestasi, dan siap mengabdi kepada masyarakat.
                        </p>
                        <p>
                            Pesantren didirikan dengan landasan tazkiyatun nufus (penyucian jiwa), membekali para santri dengan ketertiban ibadah 24 jam di asrama mukim, keakraban bersama Al-Qur'an setiap saat, serta penguasaan sains dan teknologi kontemporer di era disrupsi.
                        </p>
                    </div>

                    <div class="pt-2 flex items-center gap-4 text-xs font-bold uppercase tracking-wider">
                        <a href="{{ route('psb.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white transition shadow-xs">
                            <span>Daftar Santri Baru &rarr;</span>
                        </a>
                        <a href="{{ route('contact.index') }}" class="px-5 py-3 rounded-md border border-[#E5E0D8] hover:border-[#0D3B2E] bg-white text-[#0D3B2E] transition">
                            Kunjungi Kampus
                        </a>
                    </div>
                </div>

                <!-- Right Column: Foto & Profil Pengasuh -->
                <div class="lg:col-span-5 flex flex-col items-center">
                    <div class="w-full max-w-md bg-white border border-[#E5E0D8] rounded-md overflow-hidden shadow-md">
                        <!-- Pengasuh Photo Frame with Real Photo -->
                        <div class="aspect-4/5 relative overflow-hidden bg-gradient-to-b from-[#0D3B2E] to-[#042816] flex flex-col justify-end border-b border-[#E5E0D8]">
                            @if(file_exists(public_path('images/pengasuh daar el tazkiyah.webp')))
                                <img src="{{ asset('images/pengasuh daar el tazkiyah.webp') }}"
                                    alt="Ust. Ahmad Ashil Fadhil, S.H., M.H."
                                    class="absolute inset-0 w-full h-full object-cover object-top">
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-white/20 pb-16 pointer-events-none">
                                    <img src="{{ asset('images/logo_daar_el_tazkiyah.svg') }}" alt="Logo" class="w-32 h-32 object-contain opacity-20"
                                        onerror="this.onerror=null; this.src='{{ asset('images/logo_daar_el_tazkiyah.png') }}';">
                                    <span class="font-arabic text-xs text-amber-200/50 mt-2" dir="rtl">فضيلة الشيخ Pengasuh</span>
                                </div>
                            @endif

                            <!-- Leadership Identity Overlay -->
                            <div class="relative z-10 bg-gradient-to-t from-[#084C27] via-[#084C27]/90 to-transparent p-6 text-center text-white space-y-1">
                                <span class="editorial-label text-amber-300 block text-[10px]">PIMPINAN & PENGASUH PESANTREN</span>
                                <h3 class="font-sans font-extrabold text-xl text-white tracking-tight">
                                    Ust. Ahmad Ashil Fadhil, S.H., M.H.
                                </h3>
                                <p class="text-xs text-emerald-100 font-medium">
                                    PPMTQ Daar El Tazkiyah Sumardi
                                </p>
                                <div class="text-xs text-amber-300/90 font-arabic pt-1" dir="rtl" style="line-height: 1.8;">
                                    حفظه الله تعالى ورعاه
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION 2: VISI & MISI -->
    <section id="visi-misi" class="py-16 md:py-24 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="max-w-3xl space-y-2">
                <span class="editorial-label text-[#059669]">VISI & HALUAN</span>
                <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                    Visi & Misi PPMTQ Daar El Tazkiyah
                </h2>
                <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                    Pedoman pembinaan yang kokoh demi mewujudkan santri penghafal Al-Qur'an yang berilmu amaliah, mandiri, dan berakhlak mulia.
                </p>
            </div>

            <!-- Visi Card -->
            <div class="bg-gradient-to-r from-[#0D3B2E] to-[#084C27] rounded-md p-8 sm:p-10 text-white shadow-md relative overflow-hidden">
                <div class="relative z-10 space-y-4 max-w-3xl">
                    <span class="editorial-label text-amber-300">VISI LEMBAGA</span>
                    <blockquote class="font-sans font-extrabold text-2xl sm:text-3xl md:text-4xl text-white leading-snug">
                        "Melahirkan generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi, dan siap mengabdi untuk umat."
                    </blockquote>
                </div>
            </div>

            <!-- 4 Misi Grid -->
            <div>
                <div class="border-b border-[#E5E0D8] pb-3 mb-6">
                    <span class="editorial-label text-[#0D3B2E]">4 PILAR MISI PENDIDIKAN</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Misi 1 -->
                    <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                        <span class="font-mono text-xs font-bold text-[#B89758]">01</span>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E]">
                            Menanamkan kecintaan kepada Al-Qur'an
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Membina kecintaan, kefasihan tilawah tajwid, dan hafalan mutqin 30 juz Al-Qur'an sejak dini melalui halaqah intensif.
                        </p>
                    </div>

                    <!-- Misi 2 -->
                    <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                        <span class="font-mono text-xs font-bold text-[#B89758]">02</span>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E]">
                            Membentuk akhlak mulia dan disiplin
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Membiasakan keteladanan adab Islami, sholat berjamaah tepat waktu di masjid, dan kemandirian hidup asrama santri.
                        </p>
                    </div>

                    <!-- Misi 3 -->
                    <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                        <span class="font-mono text-xs font-bold text-[#B89758]">03</span>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E]">
                            Memberikan pendidikan berkualitas berbasis Islam
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Memadukan kurikulum kepesantrenan salafiyah dengan pendidikan formal nasional Kemenag RI serta wawasan global.
                        </p>
                    </div>

                    <!-- Misi 4 -->
                    <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                        <span class="font-mono text-xs font-bold text-[#B89758]">04</span>
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E]">
                            Mempersiapkan santri berprestasi di tingkat nasional
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Mengasah bakat santri di bidang Musabaqah Hifdzil Qur'an (MHQ), sains madrasah, pidato dwibahasa, dan kepemimpinan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: FASILITAS PESANTREN -->
    <section id="fasilitas" class="py-16 md:py-24 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label text-[#059669]">SARANA & PRASARANA</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Fasilitas Penunjang Pendidikan Santri
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Lingkungan belajar yang asri, bersih, dan representatif guna mendukung kenyamanan ibadah dan studi santri di Serang, Banten.
                    </p>
                </div>
                <span class="text-xs font-mono text-[#059669] font-bold">7 Fasilitas Utama</span>
            </div>

            <!-- 7 Facilities Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <!-- 1. Ruang Kelas -->
                <div class="bg-white border border-[#E5E0D8] rounded-md overflow-hidden hover:border-[#0D3B2E] hover:shadow-sm transition group">
                    <x-public.image-placeholder title="Ruang Kelas Nyaman" aspect="aspect-16/10" />
                    <div class="p-5 space-y-1.5">
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                            Ruang Kelas yang Nyaman
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Ruang belajar berpendingin udara dan sirkulasi alami yang asri, dilengkapi meja belajar individu dan papan tulis modern.
                        </p>
                    </div>
                </div>

                <!-- 2. Masjid -->
                <div class="bg-white border border-[#E5E0D8] rounded-md overflow-hidden hover:border-[#0D3B2E] hover:shadow-sm transition group">
                    <x-public.image-placeholder title="Masjid Pesantren" aspect="aspect-16/10" />
                    <div class="p-5 space-y-1.5">
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                            Masjid Jami' Pesantren
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Pusat peribadahan sholat berjamaah, halaqah tahfidz Al-Qur'an ba'da Subuh dan Maghrib, serta kajian kitab kuning.
                        </p>
                    </div>
                </div>

                <!-- 3. Asrama Santri -->
                <div class="bg-white border border-[#E5E0D8] rounded-md overflow-hidden hover:border-[#0D3B2E] hover:shadow-sm transition group">
                    <x-public.image-placeholder title="Asrama Santri Mukim" aspect="aspect-16/10" />
                    <div class="p-5 space-y-1.5">
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                            Gedung Asrama Santri
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Hunian mukim santri 24 jam dengan tempat tidur bertingkat, lemari pakaian tertata, dan bimbingan musyrif asrama.
                        </p>
                    </div>
                </div>

                <!-- 4. Perpustakaan -->
                <div class="bg-white border border-[#E5E0D8] rounded-md overflow-hidden hover:border-[#0D3B2E] hover:shadow-sm transition group">
                    <x-public.image-placeholder title="Perpustakaan Santri" aspect="aspect-16/10" />
                    <div class="p-5 space-y-1.5">
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                            Perpustakaan & Ruang Baca
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Koleksi kitab-kitab turats salafiyah, tafsir Al-Qur'an, kamus dwibahasa, serta buku sains dan sastra terkini.
                        </p>
                    </div>
                </div>

                <!-- 5. UKS -->
                <div class="bg-white border border-[#E5E0D8] rounded-md overflow-hidden hover:border-[#0D3B2E] hover:shadow-sm transition group">
                    <x-public.image-placeholder title="Unit Kesehatan Santri" aspect="aspect-16/10" />
                    <div class="p-5 space-y-1.5">
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                            Unit Kesehatan Santri (UKS)
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Layanan pertolongan pertama, obat-obatan dasar, serta pemantauan kesehatan berkala bagi seluruh santri pondok.
                        </p>
                    </div>
                </div>

                <!-- 6. Dapur Umum -->
                <div class="bg-white border border-[#E5E0D8] rounded-md overflow-hidden hover:border-[#0D3B2E] hover:shadow-sm transition group">
                    <x-public.image-placeholder title="Dapur Umum Santri" aspect="aspect-16/10" />
                    <div class="p-5 space-y-1.5">
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                            Dapur Umum Higienis
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Fasilitas pengolahan konsumsi santri 3 kali sehari dengan menu bergizi, higienis, dan pengawasan ketat.
                        </p>
                    </div>
                </div>

                <!-- 7. Kantin -->
                <div class="bg-white border border-[#E5E0D8] rounded-md overflow-hidden hover:border-[#0D3B2E] hover:shadow-sm transition group">
                    <x-public.image-placeholder title="Kantin Pesantren" aspect="aspect-16/10" />
                    <div class="p-5 space-y-1.5">
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition">
                            Kantin & Koperasi Santri
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Penyedia kebutuhan harian santri, alat tulis madrasah, perlengkapan mandi, dan makanan ringan halal thoyyib.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: TENAGA PENDIDIK & PEMBIMBING -->
    <section id="pendidik" class="py-16 md:py-24 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-2xl">
                    <span class="editorial-label text-[#059669]">DEWAN GURU & ASATIDZ</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Tenaga Pendidik & Pembimbing Santri
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Dididik langsung oleh para guru, huffadz Al-Qur'an, dan akademisi berintegritas tinggi.
                    </p>
                </div>
                <span class="text-xs font-mono text-[#059669] font-bold">9 Dewan Pendidik</span>
            </div>

            <!-- Teachers Grid (Clean Educator Cards without numbers, descriptions, or fields) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($teachers as $teacher)
                    <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-md p-5 hover:border-[#0D3B2E] hover:shadow-xs transition group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-[#0D3B2E] border-2 border-[#B89758] flex items-center justify-center text-white font-sans font-bold text-base shadow-xs shrink-0">
                                {{ Str::substr($teacher->full_name, 0, 1) }}
                            </div>
                            <div class="min-w-0">
                                <h3 class="font-sans font-bold text-base text-[#0D3B2E] group-hover:text-[#059669] transition leading-snug">
                                    {{ $teacher->full_name }}
                                </h3>
                                <p class="text-xs text-[#059669] font-medium mt-0.5">
                                    {{ $teacher->role_title }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8 bg-[#FAF8F5] border border-[#E5E0D8] rounded-md text-xs text-[#4B6358]">
                        Belum ada data asatidz yang dipublikasikan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
