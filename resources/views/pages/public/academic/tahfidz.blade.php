@extends('layouts.public', ['title' => 'Kurikulum Tahfidz & Kitab Kuning - PPMTQ Daar El Tazkiyah Sumardi'])

@section('content')
    <!-- Page Header (Editorial Academic Banner) -->
    <section class="bg-white border-b border-[#E5E0D8] pt-12 pb-14 md:pt-16 md:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <div class="flex items-center gap-3">
                    <span class="editorial-label">02 — PROGRAM AKADEMIK</span>
                    <span class="w-8 h-px bg-[#B89758]"></span>
                    <span class="text-xs font-mono text-[#4B6358] uppercase tracking-wider">Kurikulum Khusus Pondok</span>
                </div>
                <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-bold text-[#0D3B2E] tracking-tight leading-[1.15]">
                    Kurikulum Tahfidz 30 Juz & Kitab Kuning Salaf
                </h1>
                <p class="text-base sm:text-lg text-[#4B6358] leading-relaxed">
                    Sistem talaqqi dan tahsin bersanad untuk mencetak huffadz mutqin yang tidak hanya hafal lafazh Al-Qur'an, tetapi juga menguasai matan kaidah tajwid serta kitab-kitab dasar keilmuan Islam.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <section class="py-16 md:py-24 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <!-- Section 1: Metodologi Tahfidz 3 Langkah (Sabaq, Sabqi, Manzil) -->
            <div class="bg-white border border-[#E5E0D8] rounded-md p-8 md:p-12 space-y-8">
                <div class="border-b border-[#E5E0D8] pb-4">
                    <span class="editorial-label">METODE PENGHAFALAN</span>
                    <h2 class="font-sans text-2xl sm:text-3xl font-bold text-[#0D3B2E] mt-1">
                        Sistem Penjagaan Hafalan (Sabaq, Sabqi & Manzil)
                    </h2>
                    <p class="text-sm text-[#4B6358] mt-1">
                        Mengadopsi metodologi tahfidz klasik yang terbukti efektif mengukuhkan hafalan jangka panjang.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="border border-[#E5E0D8] bg-[#FAF8F5] rounded-md p-6 space-y-3">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                            <span class="editorial-label text-[#059669]">TAHAP 01</span>
                            <span class="text-xs font-mono text-[#4B6358]">Setoran Baru</span>
                        </div>
                        <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">Sabaq (Setoran Baru)</h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Setoran hafalan ayat atau halaman baru setiap hari setelah melalui proses tashih bacaan dan perbaikan makhraj bersama asatidz pembina halaqah. Target harian: 1/2 hingga 1 halaman mutqin.
                        </p>
                    </div>

                    <div class="border border-[#E5E0D8] bg-[#FAF8F5] rounded-md p-6 space-y-3">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                            <span class="editorial-label text-[#059669]">TAHAP 02</span>
                            <span class="text-xs font-mono text-[#4B6358]">Penguatan Dekat</span>
                        </div>
                        <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">Sabqi (Muraja'ah Dekat)</h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Pengulangan hafalan dari juz atau lembar yang baru saja disetorkan dalam satu pekan terakhir (minimal 1/4 hingga 1/2 juz) untuk merekatkan hafalan baru sebelum menyatu ke memori permanen.
                        </p>
                    </div>

                    <div class="border border-[#E5E0D8] bg-[#FAF8F5] rounded-md p-6 space-y-3">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                            <span class="editorial-label text-[#059669]">TAHAP 03</span>
                            <span class="text-xs font-mono text-[#4B6358]">Penjagaan Mutlak</span>
                        </div>
                        <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">Manzil (Muraja'ah Total)</h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Pengulangan seluruh juz yang telah dihafal secara bergilir setiap hari (minimal 1 juz per hari). Santri yang telah menyelesaikan 30 juz wajib mengulang 3-5 juz per hari untuk menjaga predikat mutqin.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Section 2: Matan Tajwid Bersanad & Ujian Tasmi' -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Matan Tajwid -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-8 space-y-4">
                    <span class="editorial-label">KORPS MATAN TAJWID</span>
                    <h3 class="font-sans text-2xl font-bold text-[#0D3B2E]">
                        Kajian Matan Tajwid Bersanad
                    </h3>
                    <p class="text-sm text-[#4B6358] leading-relaxed">
                        Santri tidak hanya mempraktikkan bacaan yang benar, namun juga menghafal dan membedah syair bait-bait matan tajwid otoritatif sebagai dasar hukum bacaan:
                    </p>
                    <ul class="text-xs text-[#18181B] space-y-3 pt-2">
                        <li class="p-3 border border-[#E5E0D8] bg-[#FAF8F5] rounded-md">
                            <strong class="text-[#0D3B2E] block text-sm">1. Matan Tuhfatul Athfal</strong>
                            <span class="text-[#4B6358]">Karya Syaikh Sulaiman Al-Jamzuri, memuat kaidah dasar nun & mim sukun, tanwin, hukum mad, dan pembagian lam ta'rif.</span>
                        </li>
                        <li class="p-3 border border-[#E5E0D8] bg-[#FAF8F5] rounded-md">
                            <strong class="text-[#0D3B2E] block text-sm">2. Mandzumah Al-Jazariyah</strong>
                            <span class="text-[#4B6358]">Karya Imam Ibnul Jazari, mengkaji secara mendalam makharijul huruf, sifatul huruf, waqaf & ibtida', serta rasm utsmani.</span>
                        </li>
                    </ul>
                </div>

                <!-- Program Tasmi' Sekali Duduk -->
                <div class="bg-white border border-[#E5E0D8] rounded-md p-8 space-y-4">
                    <span class="editorial-label">EVALUASI AKADEMIK</span>
                    <h3 class="font-sans text-2xl font-bold text-[#0D3B2E]">
                        Ujian Tasmi' Al-Qur'an Sekali Duduk
                    </h3>
                    <p class="text-sm text-[#4B6358] leading-relaxed">
                        Sebagai tolok ukur kemutqinan hafalan santri, pesantren menyelenggarakan agenda rutin Tasmi' Sekali Duduk yang disimak langsung oleh dewan asatidz dan disaksikan oleh santri lainnya:
                    </p>
                    <div class="space-y-2 pt-2 text-xs">
                        <div class="flex items-center justify-between p-3 border border-[#E5E0D8] rounded-md">
                            <span class="font-semibold text-[#0D3B2E]">Tasmi' 5 Juz Sekali Duduk</span>
                            <span class="text-[#059669] font-mono">Evaluasi Tiap Semester</span>
                        </div>
                        <div class="flex items-center justify-between p-3 border border-[#E5E0D8] rounded-md">
                            <span class="font-semibold text-[#0D3B2E]">Tasmi' 10 Juz Sekali Duduk</span>
                            <span class="text-[#059669] font-mono">Evaluasi Kenaikan Tingkat</span>
                        </div>
                        <div class="flex items-center justify-between p-3 border border-[#E5E0D8] rounded-md">
                            <span class="font-semibold text-[#0D3B2E]">Tasmi' 30 Juz Sekali Duduk (Kubro)</span>
                            <span class="text-[#B89758] font-mono font-bold">Syarat Wisuda Tahfidz</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 3: Kajian Kitab Kuning Salafiyah -->
            <div class="bg-white border border-[#E5E0D8] rounded-md p-8 md:p-12 space-y-6">
                <div class="border-b border-[#E5E0D8] pb-4">
                    <span class="editorial-label">KHAZANAH TURATS</span>
                    <h3 class="font-sans text-2xl font-bold text-[#0D3B2E]">
                        Kajian Kitab Kuning (Turats Salafiyah)
                    </h3>
                    <p class="text-sm text-[#4B6358] mt-1">
                        Memperkuat pemahaman syariat dan melestarikan tradisi keilmuan para ulama salafus shalih.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="border border-[#E5E0D8] rounded-md p-5 space-y-2">
                        <span class="editorial-label text-[#B89758]">ADAB AL-QUR'AN</span>
                        <h4 class="font-sans font-bold text-base text-[#0D3B2E]">At-Tibyan fi Adabi Hamalatil Quran</h4>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Karya Imam An-Nawawi, membina adab penghafal Al-Qur'an, adab membaca, mengajar, serta kemuliaan ahlul quran.
                        </p>
                    </div>

                    <div class="border border-[#E5E0D8] rounded-md p-5 space-y-2">
                        <span class="editorial-label text-[#B89758]">GRAMATIKA ARAB</span>
                        <h4 class="font-sans font-bold text-base text-[#0D3B2E]">Matan Al-Jurumiyah</h4>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Karya Syaikh Ash-Shanhaji, fondasi tata bahasa Arab (ilmu nahwu) untuk membaca dan memahami struktur bahasa Arab fusha.
                        </p>
                    </div>

                    <div class="border border-[#E5E0D8] rounded-md p-5 space-y-2">
                        <span class="editorial-label text-[#B89758]">FIQIH IBADAH</span>
                        <h4 class="font-sans font-bold text-base text-[#0D3B2E]">Safinatun Najah & Taqrib</h4>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Pedoman fiqih madzhab Imam Syafi'i seputar thaharah, sholat, zakat, puasa, dan tata krama kehidupan bersuci.
                        </p>
                    </div>

                    <div class="border border-[#E5E0D8] rounded-md p-5 space-y-2">
                        <span class="editorial-label text-[#B89758]">HADITS NABAWI</span>
                        <h4 class="font-sans font-bold text-base text-[#0D3B2E]">Al-Arba'in An-Nawawiyah</h4>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Himpunan 42 hadits pokok akidah, syariah, dan akhlak yang menjadi pondasi utama ajaran Islam.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
