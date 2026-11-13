@extends('layouts.public', ['title' => 'Daftar Perlengkapan Santri Baru - DAAR EL TAZKIYAH SUMARDI'])

@section('content')
<div x-data="{
    genderTab: 'all'
}">

    <!-- SECTION 1: HERO BANNER -->
    <section class="relative bg-cover bg-center overflow-hidden py-16 md:py-24 border-b border-[#B89758]/30"
             style="background-image: url('{{ asset('images/foto-santri-1.webp') }}');">
        <div class="absolute inset-0 bg-gradient-to-t from-[#042816] via-[#084C27]/90 to-[#042816]/85"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
            <!-- Breadcrumbs -->
            <nav class="flex items-center justify-center gap-2 text-xs font-semibold text-emerald-200/90 uppercase tracking-wider">
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('psb.index') }}" class="hover:text-white transition">PSB</a>
                <span>/</span>
                <span class="text-amber-300">Perlengkapan Santri</span>
            </nav>

            <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.2]">
                Daftar Perlengkapan Santri Baru
            </h1>

            <p class="text-base sm:text-lg md:text-xl text-emerald-100/90 max-w-3xl mx-auto leading-relaxed">
                Panduan perlengkapan wajib santri putra dan santri putri yang harus disiapkan saat memasuki kehidupan asrama mukim di Pondok Pesantren Modern Tahfidzul Qur'an Daar El Tazkiyah Sumardi.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('psb.form') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-md bg-[#D97706] hover:bg-[#b46304] text-white text-xs sm:text-sm font-bold uppercase tracking-wider transition shadow-md">
                    <span>Daftar Sekarang &rarr;</span>
                </a>
                <a href="{{ route('psb.fee') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-md border border-white/30 bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-semibold uppercase tracking-wider transition backdrop-blur-xs">
                    <span>Rincian Biaya</span>
                </a>
                <a href="{{ route('psb.status') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 rounded-md border border-emerald-400/50 bg-emerald-900/40 hover:bg-emerald-900/70 text-emerald-100 text-xs sm:text-sm font-semibold uppercase tracking-wider transition">
                    <span>Cek Status</span>
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION 2: KOMPARASI 4 KATEGORI PERLENGKAPAN PUTRA & PUTRI -->
    <section class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="text-center max-w-3xl mx-auto space-y-2">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        RINCIAN 4 KATEGORI PERLENGKAPAN SANTRI
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    Perbandingan rincian perlengkapan untuk calon santri putra (ikhwan) dan santri putri (akhwat).
                </p>
            </div>

            <!-- Filter Tab Switcher -->
            <div class="flex justify-center">
                <div class="inline-flex p-1.5 bg-white border border-[#E5E0D8] rounded-xl text-xs sm:text-sm font-semibold shadow-2xs">
                    <button type="button" @click="genderTab = 'all'"
                        class="px-5 py-2 rounded-lg transition"
                        :class="genderTab === 'all' ? 'bg-[#0D3B2E] text-white shadow-xs font-bold' : 'text-[#4B6358] hover:text-[#0D3B2E]'">
                        Semua (Komparasi)
                    </button>
                    <button type="button" @click="genderTab = 'putra'"
                        class="px-5 py-2 rounded-lg transition"
                        :class="genderTab === 'putra' ? 'bg-[#0D3B2E] text-white shadow-xs font-bold' : 'text-[#4B6358] hover:text-[#0D3B2E]'">
                        Perlengkapan Santri Putra
                    </button>
                    <button type="button" @click="genderTab = 'putri'"
                        class="px-5 py-2 rounded-lg transition"
                        :class="genderTab === 'putri' ? 'bg-[#0D3B2E] text-white shadow-xs font-bold' : 'text-[#4B6358] hover:text-[#0D3B2E]'">
                        Perlengkapan Santri Putri
                    </button>
                </div>
            </div>

            <div class="space-y-10 max-w-6xl mx-auto">
                <!-- 1. SERAGAM SEKOLAH FORMAL -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-8 space-y-6 shadow-xs">
                    <div class="border-b border-[#E5E0D8] pb-4 flex items-center justify-between flex-wrap gap-2">
                        <div class="flex items-center gap-3">
                            <span class="w-10 h-10 rounded-xl bg-emerald-50 text-[#0D3B2E] font-bold text-base flex items-center justify-center font-mono">
                                01
                            </span>
                            <div>
                                <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">Seragam Sekolah Formal</h3>
                                <p class="text-xs text-[#4B6358]">Digunakan untuk kegiatan belajar mengajar (KBM) kelas madrasah formal.</p>
                            </div>
                        </div>
                        <span class="text-xs font-mono font-bold px-3 py-1 rounded-full bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E]">KBM Madrasah</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Putra -->
                        <div x-show="genderTab === 'all' || genderTab === 'putra'" class="p-5 bg-[#FAF8F5] rounded-xl border border-emerald-700/20 space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <strong class="font-sans text-sm text-[#0D3B2E]">Perlengkapan Santri Putra</strong>
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-[#084C27]">Putra</span>
                            </div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Celana Hitam &amp; Baju Putih</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Celana Biru &amp; Baju Putih</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Pramuka 1 Stel</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Dasi Biru/Hitam &amp; Kacu Pramuka</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Gesper</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Sepatu hitam (pantofel)</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Kaos kaki</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Peci Hitam (Songkok)</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Buku &amp; Alat tulis</span></li>
                            </ul>
                        </div>

                        <!-- Putri -->
                        <div x-show="genderTab === 'all' || genderTab === 'putri'" class="p-5 bg-[#FAF8F5] rounded-xl border border-amber-600/20 space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <strong class="font-sans text-sm text-[#0D3B2E]">Perlengkapan Santri Putri</strong>
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-900">Putri</span>
                            </div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Rok Hitam &amp; Baju Putih</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Rok Biru &amp; Baju Putih</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Pramuka 1 Stel</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Kacu Pramuka</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Gesper</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Sepatu hitam (pantofel)</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Kaos kaki</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Kerudung Putih/Hitam/Coklat (segi empat tebal &amp; besar)</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Buku &amp; Alat tulis</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 2. SERAGAM PONDOK FORMAL (KEGIATAN PONDOK) -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-8 space-y-6 shadow-xs">
                    <div class="border-b border-[#E5E0D8] pb-4 flex items-center justify-between flex-wrap gap-2">
                        <div class="flex items-center gap-3">
                            <span class="w-10 h-10 rounded-xl bg-amber-50 text-[#B89758] font-bold text-base flex items-center justify-center font-mono">
                                02
                            </span>
                            <div>
                                <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">Seragam Pondok Formal</h3>
                                <p class="text-xs text-[#4B6358]">Digunakan untuk kegiatan resmi pondok, kajian majelis, dan muhadharah.</p>
                            </div>
                        </div>
                        <span class="text-xs font-mono font-bold px-3 py-1 rounded-full bg-[#FAF8F5] border border-[#E5E0D8] text-[#B89758]">Kegiatan Pondok</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Putra -->
                        <div x-show="genderTab === 'all' || genderTab === 'putra'" class="p-5 bg-[#FAF8F5] rounded-xl border border-emerald-700/20 space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <strong class="font-sans text-sm text-[#0D3B2E]">Perlengkapan Santri Putra</strong>
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-[#084C27]">Putra</span>
                            </div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Celana Hitam &amp; Baju Putih</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Peci Hitam (Songkok)</span></li>
                            </ul>
                        </div>

                        <!-- Putri -->
                        <div x-show="genderTab === 'all' || genderTab === 'putri'" class="p-5 bg-[#FAF8F5] rounded-xl border border-amber-600/20 space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <strong class="font-sans text-sm text-[#0D3B2E]">Perlengkapan Santri Putri</strong>
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-900">Putri</span>
                            </div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Rok Hitam &amp; Baju Putih</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Kerudung Hitam/Putih (segi empat tebal &amp; besar)</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 3. PERLENGKAPAN SHOLAT -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-8 space-y-6 shadow-xs">
                    <div class="border-b border-[#E5E0D8] pb-4 flex items-center justify-between flex-wrap gap-2">
                        <div class="flex items-center gap-3">
                            <span class="w-10 h-10 rounded-xl bg-emerald-50 text-[#0D3B2E] font-bold text-base flex items-center justify-center font-mono">
                                03
                            </span>
                            <div>
                                <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">Perlengkapan Sholat &amp; Ibadah</h3>
                                <p class="text-xs text-[#4B6358]">Digunakan untuk sholat berjamaah 5 waktu, tahajjud, dan halaqah tahfidz di masjid.</p>
                            </div>
                        </div>
                        <span class="text-xs font-mono font-bold px-3 py-1 rounded-full bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E]">Ibadah Harian</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Putra -->
                        <div x-show="genderTab === 'all' || genderTab === 'putra'" class="p-5 bg-[#FAF8F5] rounded-xl border border-emerald-700/20 space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <strong class="font-sans text-sm text-[#0D3B2E]">Perlengkapan Santri Putra</strong>
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-[#084C27]">Putra</span>
                            </div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Baju Muslim Bebas (Min. 4)</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Sarung (Min. 4)</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Sajadah (Min. 1)</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Koko/Gamis Putih (Min. 2)</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Kemeja Panjang bebas</span></li>
                            </ul>
                        </div>

                        <!-- Putri -->
                        <div x-show="genderTab === 'all' || genderTab === 'putri'" class="p-5 bg-[#FAF8F5] rounded-xl border border-amber-600/20 space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <strong class="font-sans text-sm text-[#0D3B2E]">Perlengkapan Santri Putri</strong>
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-900">Putri</span>
                            </div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Mukena Warna bebas (Min. 2)</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Sajadah (Min. 1)</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Mukena Warna Putih (Min. 1)</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 4. PERLENGKAPAN SEHARI-HARI -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-8 space-y-6 shadow-xs">
                    <div class="border-b border-[#E5E0D8] pb-4 flex items-center justify-between flex-wrap gap-2">
                        <div class="flex items-center gap-3">
                            <span class="w-10 h-10 rounded-xl bg-amber-50 text-[#B89758] font-bold text-base flex items-center justify-center font-mono">
                                04
                            </span>
                            <div>
                                <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">Perlengkapan Sehari-hari &amp; Asrama</h3>
                                <p class="text-xs text-[#4B6358]">Pakaian tidur/bebas serta perlengkapan makan, mandi, dan mencuci pakaian mandiri.</p>
                            </div>
                        </div>
                        <span class="text-xs font-mono font-bold px-3 py-1 rounded-full bg-[#FAF8F5] border border-[#E5E0D8] text-[#B89758]">Kemandirian Asrama</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Pakaian Tidur/Bebas Putra -->
                        <div x-show="genderTab === 'all' || genderTab === 'putra'" class="p-5 bg-[#FAF8F5] rounded-xl border border-emerald-700/20 space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <strong class="font-sans text-sm text-[#0D3B2E]">Pakaian Tidur / Bebas Putra</strong>
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-[#084C27]">Putra</span>
                            </div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Kaos polos</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Celana Training (Min. 2)</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Celana bahan/hitam</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Gesper</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Bantal/guling</span></li>
                            </ul>
                        </div>

                        <!-- Pakaian Tidur/Bebas Putri -->
                        <div x-show="genderTab === 'all' || genderTab === 'putri'" class="p-5 bg-[#FAF8F5] rounded-xl border border-amber-600/20 space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <strong class="font-sans text-sm text-[#0D3B2E]">Pakaian Tidur / Bebas Putri</strong>
                                <span class="text-[11px] font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-900">Putri</span>
                            </div>
                            <ul class="text-xs space-y-2 text-[#18181B]">
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Gamis menutup aurat</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Kerudung hitam (bergo jumbo)</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Celana bahan/hitam</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Gesper</span></li>
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span><span>Bantal/guling</span></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Makan, Mencuci & Mandi (Putra & Putri) -->
                    <div class="p-5 bg-[#FAF8F5] rounded-xl border border-[#E5E0D8] space-y-3">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                            <strong class="font-sans text-sm text-[#0D3B2E]">Makan, Mencuci &amp; Mandi (Berlaku Santri Putra &amp; Putri)</strong>
                            <span class="text-[11px] font-bold px-2.5 py-0.5 rounded bg-[#0D3B2E] text-white">Putra &amp; Putri</span>
                        </div>
                        <p class="text-xs text-[#4B6358]">
                            Sebagai sarana melatih kemandirian dan tanggung jawab, setiap santri mencuci pakaian dan alat makannya sendiri.
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 text-xs text-[#18181B] pt-1">
                            <div class="p-3 bg-white rounded-lg border border-[#E5E0D8] flex items-center gap-2">
                                <span class="text-[#059669] font-bold">&check;</span>
                                <span>Piring &amp; sendok</span>
                            </div>
                            <div class="p-3 bg-white rounded-lg border border-[#E5E0D8] flex items-center gap-2">
                                <span class="text-[#059669] font-bold">&check;</span>
                                <span>Gelas / Botol minum</span>
                            </div>
                            <div class="p-3 bg-white rounded-lg border border-[#E5E0D8] flex items-center gap-2">
                                <span class="text-[#059669] font-bold">&check;</span>
                                <span>Gayung mandi</span>
                            </div>
                            <div class="p-3 bg-white rounded-lg border border-[#E5E0D8] flex items-center gap-2">
                                <span class="text-[#059669] font-bold">&check;</span>
                                <span>Ember pakaian</span>
                            </div>
                            <div class="p-3 bg-white rounded-lg border border-[#E5E0D8] flex items-center gap-2">
                                <span class="text-[#059669] font-bold">&check;</span>
                                <span>Hanger / Gantungan</span>
                            </div>
                            <div class="p-3 bg-white rounded-lg border border-[#E5E0D8] flex items-center gap-2">
                                <span class="text-[#059669] font-bold">&check;</span>
                                <span>Alat Mandi (sabun cair)</span>
                            </div>
                            <div class="p-3 bg-white rounded-lg border border-[#E5E0D8] flex items-center gap-2 sm:col-span-2">
                                <span class="text-[#059669] font-bold">&check;</span>
                                <span>Alat mencuci pakaian &amp; sabun cuci piring</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: CATATAN PENTING, LARANGAN & KETENTUAN ASRAMA -->
    <section class="py-12 md:py-16 bg-white border-b border-[#E5E0D8]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="text-center max-w-2xl mx-auto space-y-2">
                <span class="editorial-label text-red-700">TATA TERTIB ASRAMA</span>
                <h2 class="font-sans text-2xl sm:text-3xl font-extrabold text-[#0D3B2E]">
                    Catatan Penting, Larangan &amp; Ketentuan Asrama
                </h2>
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    Mohon diperhatikan demi kenyamanan, keamanan, dan keberkahan belajar para santri di lingkungan pesantren.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card Larangan -->
                <div class="bg-red-50/60 border border-red-200 rounded-2xl p-6 sm:p-7 space-y-4">
                    <div class="flex items-center gap-2.5 text-red-800 font-sans font-bold text-base">
                        <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span>Barang yang DILARANG Dibawa:</span>
                    </div>
                    <ul class="text-xs space-y-2.5 text-red-950/80">
                        <li class="flex items-start gap-2">
                            <span class="text-red-600 font-bold">&times;</span>
                            <span><strong>Gawai &amp; Elektronik:</strong> Smartphone, HP, tablet, laptop, pemutar musik/MP3, game console, dan alat elektronik pribadi lainnya.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-red-600 font-bold">&times;</span>
                            <span><strong>Perhiasan &amp; Uang Tunai Berlebih:</strong> Emas/perhiasan mencolok serta uang tunai dalam jumlah besar (uang saku wajib dititipkan ke wali kamar/bendahara).</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-red-600 font-bold">&times;</span>
                            <span><strong>Pakaian Tidak Syar'i:</strong> Kaos bergambar tidak senonoh/musik cadas, celana jeans ketat, pakaian transparan, atau berpotongan tidak sopan.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-red-600 font-bold">&times;</span>
                            <span><strong>Bahan Berbahaya:</strong> Senjata tajam, rokok/vape, obat-obatan terlarang, korek api gas, dan bahan berbahaya lainnya.</span>
                        </li>
                    </ul>
                </div>

                <!-- Card Ketentuan & Himbauan -->
                <div class="bg-emerald-50/60 border border-emerald-200 rounded-2xl p-6 sm:p-7 space-y-4">
                    <div class="flex items-center gap-2.5 text-[#0D3B2E] font-sans font-bold text-base">
                        <svg class="w-5 h-5 text-[#059669] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Ketentuan &amp; Rekomendasi Asrama:</span>
                    </div>
                    <ul class="text-xs space-y-2.5 text-emerald-950/80">
                        <li class="flex items-start gap-2">
                            <span class="text-[#059669] font-bold">&check;</span>
                            <span><strong>Label Nama Pribadi:</strong> Seluruh pakaian, buku, sarung, ember, dan peralatan pribadi WAJIB diberi label/bordir nama santri untuk mencegah tertukar.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[#059669] font-bold">&check;</span>
                            <span><strong>Kemandirian Mencuci:</strong> Pesantren tidak menyediakan jasa laundry. Santri dilatih mandiri mencuci pakaian sendiri setiap hari dengan jadwal teratur.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[#059669] font-bold">&check;</span>
                            <span><strong>Kesehatan Santri:</strong> Membawa obat-obatan pribadi bagi santri yang memiliki riwayat penyakit tertentu (wajib dilaporkan ke bagian kesehatan pondok).</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-[#059669] font-bold">&check;</span>
                            <span><strong>Kerapihan Lemari:</strong> Barang bawaan secukupnya dan sesuai kapasitas sewa lemari yang telah disediakan di kamar asrama santri.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: DOWNLOAD SURAT PERNYATAAN / CTA PENUTUP -->
    <section class="py-12 md:py-16 bg-[#084C27] text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <div class="max-w-2xl mx-auto space-y-3">
                <span class="editorial-label text-amber-300">PANDUAN &amp; FORMULIR RESMI</span>
                <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-white">
                    Siap Mempersiapkan Kedatangan Santri?
                </h2>
                <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
                    Dapatkan dokumen tata tertib santri dan surat pernyataan kepatuhan asrama untuk ditandatangani saat registrasi ulang, atau mulai langkah pendaftaran sekarang.
                </p>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                <a href="{{ route('psb.form') }}"
                    class="px-8 py-3.5 rounded-md bg-[#D97706] hover:bg-[#b46304] text-white font-bold text-xs uppercase tracking-wider transition shadow-md">
                    Isi Formulir Pendaftaran Online &rarr;
                </a>
                <a href="{{ route('psb.fee') }}"
                    class="px-6 py-3.5 rounded-md border border-white/30 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs uppercase tracking-wider transition">
                    Lihat Rincian Biaya
                </a>
                @php
                    $waNum = \App\Models\SiteSetting::get('school_phone', '0896-5332-4339');
                @endphp
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waNum) }}?text=Halo%20Panitia%20PSB%20Daar%20El%20Tazkiyah,%20saya%20ingin%20bertanya%20tentang%20perlengkapan%20santri%20baru." target="_blank" rel="noopener noreferrer"
                    class="px-6 py-3.5 rounded-md border border-emerald-400/50 bg-emerald-900/40 hover:bg-emerald-900/70 text-emerald-100 font-semibold text-xs uppercase tracking-wider transition">
                    Tanya Panitia via WhatsApp
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
