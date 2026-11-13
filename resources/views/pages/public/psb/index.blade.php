@extends('layouts.public', ['title' => 'Informasi Penerimaan Santri Baru (PSB) - DAAR EL TAZKIYAH SUMARDI'])

@section('content')
<div x-data="{
    alurTab: 'online',
    openFaq: null
}">

    <!-- SECTION 1: HERO / CTA (Desain Eksisting) -->
    <section class="relative bg-cover bg-center overflow-hidden py-16 md:py-24 border-b border-[#B89758]/30"
             style="background-image: url('{{ asset('images/foto-santri-1.webp') }}');">
        <div class="absolute inset-0 bg-gradient-to-t from-[#042816] via-[#084C27]/90 to-[#042816]/85"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-6">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-950/60 border border-[#B89758]/50 text-[#B89758] text-xs font-semibold uppercase tracking-wider backdrop-blur-xs">
                <span>Penerimaan Santri Baru (PSB)</span>
                @if($activeWave)
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    <span class="text-white">{{ $activeWave->academic_year }}</span>
                @endif
            </div>

            <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.2]">
                Pendaftaran Santri Baru MTs &amp; MDTA
            </h1>

            <p class="text-base sm:text-lg md:text-xl text-emerald-100/90 max-w-3xl mx-auto leading-relaxed">
                Pondok Pesantren Modern Tahfidzul Qur'an Daar El Tazkiyah Sumardi membuka kesempatan bagi putra-putri Anda untuk menimba ilmu agama, tahfidz Al-Qur'an, dan pendidikan formal berkarakter di Kabupaten Serang, Banten.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                <a href="{{ route('psb.form') }}"
                    class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-md bg-[#D97706] hover:bg-[#b46304] text-white text-xs sm:text-sm font-bold uppercase tracking-wider transition shadow-md">
                    <span>Daftar Sekarang &rarr;</span>
                </a>
                <a href="{{ route('psb.fee') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-md border border-white/30 bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-semibold uppercase tracking-wider transition backdrop-blur-xs">
                    <span>Rincian Biaya</span>
                </a>
                <a href="{{ route('psb.perlengkapan') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-md border border-white/30 bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-semibold uppercase tracking-wider transition backdrop-blur-xs">
                    <span>Perlengkapan</span>
                </a>
                <a href="{{ route('psb.status') }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-md border border-emerald-400/50 bg-emerald-900/40 hover:bg-emerald-900/70 text-emerald-100 text-xs sm:text-sm font-semibold uppercase tracking-wider transition">
                    <span>Cek Status</span>
                </a>
            </div>

            @if($activeWave)
                <div class="pt-4 text-xs text-emerald-200/80">
                    Periode Pendaftaran {{ $activeWave->name }}:
                    <strong class="text-white">{{ $activeWave->start_date?->translatedFormat('d F Y') }}</strong> s/d
                    <strong class="text-white">{{ $activeWave->end_date?->translatedFormat('d F Y') }}</strong>
                </div>
            @endif
        </div>
    </section>

    <!-- SECTION 2: ALUR PENDAFTARAN (2 TAB: ONLINE & OFFLINE) -->
    <section class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="text-center max-w-3xl mx-auto space-y-2">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        ALUR PENDAFTARAN SANTRI
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    Pilih jalur pendaftaran yang paling memudahkan Anda: secara online atau datang langsung ke pondok pesantren.
                </p>
            </div>

            <!-- Tab Buttons -->
            <div class="flex justify-center">
                <div class="inline-flex p-1.5 bg-white border border-[#E5E0D8] rounded-xl text-xs sm:text-sm font-semibold shadow-2xs">
                    <button type="button" @click="alurTab = 'online'"
                        class="px-6 py-2.5 rounded-lg transition font-medium"
                        :class="alurTab === 'online' ? 'bg-[#0D3B2E] text-white shadow-xs font-bold' : 'text-[#4B6358] hover:text-[#0D3B2E]'">
                        Pendaftaran Online
                    </button>
                    <button type="button" @click="alurTab = 'offline'"
                        class="px-6 py-2.5 rounded-lg transition font-medium"
                        :class="alurTab === 'offline' ? 'bg-[#0D3B2E] text-white shadow-xs font-bold' : 'text-[#4B6358] hover:text-[#0D3B2E]'">
                        Pendaftaran Offline
                    </button>
                </div>
            </div>

            <!-- Tab Content: Online (Default Active) -->
            <div x-show="alurTab === 'online'" x-transition class="space-y-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Step 1 -->
                    <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-3 hover:border-[#0D3B2E] hover:shadow-md transition">
                        <div class="flex items-center justify-between">
                            <span class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 text-[#0D3B2E] font-mono font-extrabold text-base flex items-center justify-center">
                                01
                            </span>
                            <span class="text-[10px] font-mono uppercase font-bold text-[#059669]">Langkah 1</span>
                        </div>
                        <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">
                            Isi Formulir Online
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Wali santri mengisi formulir pendaftaran melalui laman resmi <a href="{{ route('psb.form') }}" class="text-[#059669] underline font-semibold">psb/form</a> dan melengkapi data calon santri serta orang tua.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-3 hover:border-[#0D3B2E] hover:shadow-md transition">
                        <div class="flex items-center justify-between">
                            <span class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200 text-[#B89758] font-mono font-extrabold text-base flex items-center justify-center">
                                02
                            </span>
                            <span class="text-[10px] font-mono uppercase font-bold text-[#B89758]">Langkah 2</span>
                        </div>
                        <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">
                            Simpan Bukti Pendaftaran
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Setelah submit, unduh dan simpan lembar bukti pendaftaran berformat PDF yang memuat Nomor Registrasi resmi dan rincian pendaftar.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-3 hover:border-[#0D3B2E] hover:shadow-md transition">
                        <div class="flex items-center justify-between">
                            <span class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 text-[#0D3B2E] font-mono font-extrabold text-base flex items-center justify-center">
                                03
                            </span>
                            <span class="text-[10px] font-mono uppercase font-bold text-[#059669]">Langkah 3</span>
                        </div>
                        <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">
                            Pembayaran
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Melakukan transfer biaya/infaq pendaftaran sesuai nominal program yang dipilih ke rekening resmi pondok pesantren yang tercantum.
                        </p>
                    </div>

                    <!-- Step 4 -->
                    <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-3 hover:border-[#0D3B2E] hover:shadow-md transition">
                        <div class="flex items-center justify-between">
                            <span class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200 text-[#B89758] font-mono font-extrabold text-base flex items-center justify-center">
                                04
                            </span>
                            <span class="text-[10px] font-mono uppercase font-bold text-[#B89758]">Langkah 4</span>
                        </div>
                        <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">
                            Konfirmasi Pembayaran
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Unggah bukti transfer atau konfirmasi ke bendahara/panitia PSB via WhatsApp untuk validasi status pembayaran dan verifikasi berkas.
                        </p>
                    </div>
                </div>

                <div class="text-center pt-2">
                    <a href="{{ route('psb.form') }}"
                        class="inline-flex items-center gap-2 px-8 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs sm:text-sm font-bold uppercase tracking-wider transition shadow-xs">
                        <span>Isi Formulir Pendaftaran Online Sekarang &rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Tab Content: Offline -->
            <div x-show="alurTab === 'offline'" x-cloak x-transition class="space-y-6">
                <div class="max-w-3xl mx-auto bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-8 space-y-6 shadow-xs">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-200 text-[#0D3B2E] flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div class="space-y-2">
                            <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">
                                Datang Langsung ke Sekretariat Pondok Pesantren
                            </h3>
                            <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                                Calon santri bersama orang tua/wali dapat hadir langsung ke kampus PPMTQ Daar El Tazkiyah Sumardi untuk melakukan pendaftaran secara langsung di lokasi.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-[#E5E0D8] text-xs text-[#18181B]">
                        <div class="space-y-1.5 p-4 bg-[#FAF8F5] rounded-xl border border-[#E5E0D8]">
                            <strong class="text-[#0D3B2E] block">Alamat Sekretariat PSB:</strong>
                            <p class="text-[#4B6358] leading-relaxed">
                                Kp. Lembur Sawah, Kel./Desa Mekar Baru, Kecamatan Petir, Kabupaten Serang, Provinsi Banten.
                            </p>
                        </div>
                        <div class="space-y-1.5 p-4 bg-[#FAF8F5] rounded-xl border border-[#E5E0D8]">
                            <strong class="text-[#0D3B2E] block">Jam Pelayanan:</strong>
                            <p class="text-[#4B6358] leading-relaxed">
                                Setiap hari (Senin s/d Ahad) pukul 08.00 – 16.00 WIB. Petugas panitia siap mendampingi pengisian formulir, penyerahan fotocopy berkas, dan silaturahmi.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-3 pt-2">
                        @php
                            $waNum = \App\Models\SiteSetting::get('school_phone', '0896-5332-4339');
                        @endphp
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waNum) }}?text=Halo%20Panitia%20PSB%20Daar%20El%20Tazkiyah,%20saya%20ingin%20berkunjung%20untuk%20pendaftaran%20offline."
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                            <span>Konfirmasi Kunjungan via WhatsApp</span>
                        </a>
                        <a href="https://maps.google.com/?q=Daar+El+Tazkiyah+Sumardi" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-5 py-3 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] text-[#0D3B2E] text-xs font-semibold uppercase tracking-wider transition">
                            <span>Petunjuk Lokasi Google Maps &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: RINGKASAN BIAYA (2 CARD BERDAMPINGAN: MTS & MDTA) -->
    <section class="py-12 md:py-16 bg-white border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="text-center max-w-3xl mx-auto space-y-2">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        RINGKASAN BIAYA PENDIDIKAN
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    Transparansi biaya awal masuk untuk jenjang Madrasah Tsanawiyah (Mukim) dan Madrasah Diniyah (Non-Mukim).
                </p>
            </div>

            <!-- 2 Cards Side-by-Side -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto items-stretch">
                <!-- Card 1: MTs Mukim -->
                <div class="bg-[#FAF8F5] border-2 border-emerald-700/20 rounded-2xl p-7 sm:p-8 flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] hover:shadow-lg transition">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full bg-[#0D3B2E] text-white text-[11px] font-bold uppercase tracking-wider">
                                MTs (Mukim 24 Jam)
                            </span>
                            <span class="text-xs font-mono font-bold text-[#059669]">Formal Kemenag</span>
                        </div>

                        <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">
                            Madrasah Tsanawiyah
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Pendidikan formal berijazah Kementerian Agama RI yang dipadukan dengan kepesantrenan mukim 24 jam, makan 3x sehari, dan tahfidz Al-Qur'an intensif.
                        </p>

                        <!-- Biaya Masuk Awal Putra & Putri -->
                        <div class="grid grid-cols-2 gap-3 pt-2">
                            <div class="p-4 bg-white border border-[#E5E0D8] rounded-xl text-center space-y-1">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-[#4B6358] block">Santri Putra</span>
                                <span class="font-sans text-xl sm:text-2xl font-extrabold text-[#0D3B2E] block">
                                    Rp 3.250.000
                                </span>
                                <span class="text-[10px] text-gray-500 block">Total Masuk Awal</span>
                            </div>
                            <div class="p-4 bg-white border border-[#E5E0D8] rounded-xl text-center space-y-1">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-[#4B6358] block">Santri Putri</span>
                                <span class="font-sans text-xl sm:text-2xl font-extrabold text-[#0D3B2E] block">
                                    Rp 3.350.000
                                </span>
                                <span class="text-[10px] text-gray-500 block">Total Masuk Awal</span>
                            </div>
                        </div>

                        <div class="p-3 bg-emerald-50/60 rounded-xl border border-emerald-200/50 text-xs text-[#0D3B2E] flex items-center justify-between">
                            <span>Iuran Bulanan / Syahriyah:</span>
                            <strong class="font-bold">Rp 500.000 / bulan</strong>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#E5E0D8] flex items-center justify-between gap-3">
                        <a href="{{ route('psb.fee') }}"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0D3B2E] hover:text-[#059669] transition">
                            <span>Lihat Rincian 12 Komponen Biaya MTs</span>
                            <span>&rarr;</span>
                        </a>
                        <a href="{{ route('psb.form', ['program' => 'MTS']) }}"
                            class="px-4 py-2 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                            Daftar MTs
                        </a>
                    </div>
                </div>

                <!-- Card 2: MDTA Non-Mukim -->
                <div class="bg-[#FAF8F5] border-2 border-amber-600/20 rounded-2xl p-7 sm:p-8 flex flex-col justify-between space-y-6 hover:border-amber-600 hover:shadow-lg transition">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full bg-amber-600 text-white text-[11px] font-bold uppercase tracking-wider">
                                MDTA (Non-Mukim)
                            </span>
                            <span class="text-xs font-mono font-bold text-amber-800">Sekolah Sore</span>
                        </div>

                        <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">
                            Madrasah Diniyah
                        </h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">
                            Pendidikan keagamaan non-mukim ba'da Ashar (Senin–Kamis) untuk anak usia SD/MI di wilayah Petir, Serang, dan sekitarnya.
                        </p>

                        <!-- Biaya Masuk Awal MDTA -->
                        <div class="p-4 bg-white border border-[#E5E0D8] rounded-xl text-center space-y-1">
                            <span class="text-[11px] font-bold uppercase tracking-wider text-[#4B6358] block">Total Biaya Masuk Awal</span>
                            <span class="font-sans text-3xl font-extrabold text-[#0D3B2E] block">
                                Rp 52.000
                            </span>
                            <span class="text-[10px] text-gray-500 block">Termasuk Pendaftaran, Rapor 4 Thn &amp; Kartu Santri</span>
                        </div>

                        <div class="p-3 bg-amber-50/60 rounded-xl border border-amber-200/50 text-xs text-[#0D3B2E] flex items-center justify-between">
                            <span>Infaq Shodaqoh Bulanan:</span>
                            <strong class="font-bold">Rp 12.000 / bulan</strong>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-[#E5E0D8] flex items-center justify-between gap-3">
                        <a href="{{ route('psb.fee') }}"
                            class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0D3B2E] hover:text-[#059669] transition">
                            <span>Lihat Rincian Biaya MDTA</span>
                            <span>&rarr;</span>
                        </a>
                        <a href="{{ route('psb.form', ['program' => 'MDTA']) }}"
                            class="px-4 py-2 rounded-md bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                            Daftar MDTA
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: PERSYARATAN (DAFTAR SEDERHANA TANPA KETERANGAN KATEGORI / STATUS WAJIB) -->
    <section class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="text-center max-w-3xl mx-auto space-y-2">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        PERSYARATAN DOKUMEN
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    Kelengkapan berkas fisik yang diserahkan atau diunggah saat pendaftaran calon santri baru.
                </p>
            </div>

            <!-- Simple 5 items list per brief without category/wajib labels -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <!-- 1 -->
                <div class="bg-white border border-[#E5E0D8] rounded-xl p-5 flex items-start gap-4 hover:border-[#0D3B2E] transition shadow-2xs">
                    <span class="w-9 h-9 rounded-lg bg-emerald-50 text-[#0D3B2E] font-mono font-bold text-sm flex items-center justify-center shrink-0">
                        1
                    </span>
                    <div class="space-y-0.5">
                        <h3 class="font-sans font-bold text-sm text-[#0D3B2E]">Fotocopy/salinan Akta Kelahiran</h3>
                        <p class="text-xs text-[#4B6358]">Salinan akta kelahiran calon santri.</p>
                    </div>
                </div>

                <!-- 2 -->
                <div class="bg-white border border-[#E5E0D8] rounded-xl p-5 flex items-start gap-4 hover:border-[#0D3B2E] transition shadow-2xs">
                    <span class="w-9 h-9 rounded-lg bg-emerald-50 text-[#0D3B2E] font-mono font-bold text-sm flex items-center justify-center shrink-0">
                        2
                    </span>
                    <div class="space-y-0.5">
                        <h3 class="font-sans font-bold text-sm text-[#0D3B2E]">Fotocopy/salinan Kartu Keluarga</h3>
                        <p class="text-xs text-[#4B6358]">Salinan Kartu Keluarga (KK) terbaru.</p>
                    </div>
                </div>

                <!-- 3 -->
                <div class="bg-white border border-[#E5E0D8] rounded-xl p-5 flex items-start gap-4 hover:border-[#0D3B2E] transition shadow-2xs">
                    <span class="w-9 h-9 rounded-lg bg-emerald-50 text-[#0D3B2E] font-mono font-bold text-sm flex items-center justify-center shrink-0">
                        3
                    </span>
                    <div class="space-y-0.5">
                        <h3 class="font-sans font-bold text-sm text-[#0D3B2E]">Fotocopy/salinan KTP Orang Tua/Wali</h3>
                        <p class="text-xs text-[#4B6358]">Salinan KTP ayah, ibu, atau wali santri.</p>
                    </div>
                </div>

                <!-- 4 -->
                <div class="bg-white border border-[#E5E0D8] rounded-xl p-5 flex items-start gap-4 hover:border-[#0D3B2E] transition shadow-2xs">
                    <span class="w-9 h-9 rounded-lg bg-emerald-50 text-[#0D3B2E] font-mono font-bold text-sm flex items-center justify-center shrink-0">
                        4
                    </span>
                    <div class="space-y-0.5">
                        <h3 class="font-sans font-bold text-sm text-[#0D3B2E]">Fotocopy/salinan Ijazah/SKL</h3>
                        <p class="text-xs text-[#4B6358]">Salinan Ijazah atau Surat Keterangan Lulus.</p>
                    </div>
                </div>

                <!-- 5 -->
                <div class="bg-white border border-[#E5E0D8] rounded-xl p-5 flex items-start gap-4 hover:border-[#0D3B2E] transition shadow-2xs sm:col-span-2 lg:col-span-1">
                    <span class="w-9 h-9 rounded-lg bg-emerald-50 text-[#0D3B2E] font-mono font-bold text-sm flex items-center justify-center shrink-0">
                        5
                    </span>
                    <div class="space-y-0.5">
                        <h3 class="font-sans font-bold text-sm text-[#0D3B2E]">Pas Foto 3x4</h3>
                        <p class="text-xs text-[#4B6358]">Pas foto formal calon santri ukuran 3x4.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: FAQ (ACCORDION FAQ) & PENUTUP -->
    <section class="py-12 md:py-16 bg-white border-b border-[#E5E0D8]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="text-center max-w-3xl mx-auto space-y-2">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        PERTANYAAN SEPUTAR PSB (FAQ)
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    Jawaban atas pertanyaan yang sering diajukan oleh calon wali santri baru.
                </p>
            </div>

            <!-- Accordion List -->
            <div class="space-y-3">
                <!-- Item 1 -->
                <div class="border border-[#E5E0D8] rounded-xl overflow-hidden bg-white shadow-2xs">
                    <button type="button" @click="openFaq = (openFaq === 1 ? null : 1)"
                        class="w-full p-5 text-left flex items-center justify-between gap-4 font-sans font-bold text-sm sm:text-base text-[#0D3B2E] hover:text-[#059669] transition">
                        <span>Bagaimana tata cara mendaftar santri baru di PPMTQ Daar El Tazkiyah?</span>
                        <svg class="w-5 h-5 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': openFaq === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 1" x-cloak class="px-5 pb-5 pt-1 text-xs text-[#4B6358] leading-relaxed border-t border-[#E5E0D8]/60">
                        Pendaftaran dapat dilakukan secara online melalui menu <a href="{{ route('psb.form') }}" class="text-[#059669] font-semibold underline">Formulir Pendaftaran</a> di website resmi kami atau hadir langsung secara offline ke Sekretariat Pondok Pesantren di Kp. Lembur Sawah, Desa Mekar Baru, Petir, Serang, Banten.
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="border border-[#E5E0D8] rounded-xl overflow-hidden bg-white shadow-2xs">
                    <button type="button" @click="openFaq = (openFaq === 2 ? null : 2)"
                        class="w-full p-5 text-left flex items-center justify-between gap-4 font-sans font-bold text-sm sm:text-base text-[#0D3B2E] hover:text-[#059669] transition">
                        <span>Apakah jenjang MTs wajib mukim di asrama?</span>
                        <svg class="w-5 h-5 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': openFaq === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 2" x-cloak class="px-5 pb-5 pt-1 text-xs text-[#4B6358] leading-relaxed border-t border-[#E5E0D8]/60">
                        Ya, jenjang Madrasah Tsanawiyah (MTs) merupakan sistem pendidikan kepesantrenan mukim 24 jam dengan asrama terpisah antara santri putra dan putri, fasilitas makan 3 kali sehari, serta bimbingan halaqah tahfidz Al-Qur'an dan kajian kitab kuning.
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="border border-[#E5E0D8] rounded-xl overflow-hidden bg-white shadow-2xs">
                    <button type="button" @click="openFaq = (openFaq === 3 ? null : 3)"
                        class="w-full p-5 text-left flex items-center justify-between gap-4 font-sans font-bold text-sm sm:text-base text-[#0D3B2E] hover:text-[#059669] transition">
                        <span>Berapa rincian biaya awal masuk santri MTs dan MDTA?</span>
                        <svg class="w-5 h-5 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': openFaq === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 3" x-cloak class="px-5 pb-5 pt-1 text-xs text-[#4B6358] leading-relaxed border-t border-[#E5E0D8]/60">
                        Untuk MTs (Mukim), total biaya masuk awal adalah <strong>Rp 3.250.000</strong> (Putra) dan <strong>Rp 3.350.000</strong> (Putri). Untuk MDTA (Non-Mukim), total biaya adalah <strong>Rp 52.000</strong>. Rincian tabel per komponen dapat dilihat di halaman <a href="{{ route('psb.fee') }}" class="text-[#059669] font-semibold underline">Rincian Biaya</a>.
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="border border-[#E5E0D8] rounded-xl overflow-hidden bg-white shadow-2xs">
                    <button type="button" @click="openFaq = (openFaq === 4 ? null : 4)"
                        class="w-full p-5 text-left flex items-center justify-between gap-4 font-sans font-bold text-sm sm:text-base text-[#0D3B2E] hover:text-[#059669] transition">
                        <span>Bagaimana cara mengecek status pendaftaran santri?</span>
                        <svg class="w-5 h-5 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': openFaq === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 4" x-cloak class="px-5 pb-5 pt-1 text-xs text-[#4B6358] leading-relaxed border-t border-[#E5E0D8]/60">
                        Wali santri dapat membuka halaman <a href="{{ route('psb.status') }}" class="text-[#059669] font-semibold underline">Cek Status Pendaftaran</a> lalu memasukkan kombinasi <strong>Nomor Pendaftaran</strong> dan <strong>16 digit NIK Calon Santri</strong>.
                    </div>
                </div>
            </div>

            <!-- Closing CTA Penutup -->
            <div class="bg-[#084C27] text-white rounded-2xl p-8 sm:p-10 text-center space-y-5 shadow-lg">
                <h3 class="font-sans text-2xl sm:text-3xl font-extrabold text-white">
                    Siap Mendaftarkan Putra-Putri Anda?
                </h3>
                <p class="text-xs sm:text-sm text-emerald-100 max-w-xl mx-auto leading-relaxed">
                    Jangan lewatkan kesempatan menjadi bagian dari keluarga besar PPMTQ Daar El Tazkiyah Sumardi. Daftarkan secara online sekarang atau hubungi panitia kami.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-3 pt-2">
                    <a href="{{ route('psb.form') }}"
                        class="px-7 py-3 rounded-md bg-[#D97706] hover:bg-[#b46304] text-white font-bold text-xs uppercase tracking-wider transition shadow-md">
                        Isi Formulir Online &rarr;
                    </a>
                    <a href="{{ route('psb.fee') }}"
                        class="px-6 py-3 rounded-md border border-white/30 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs uppercase tracking-wider transition">
                        Rincian Biaya
                    </a>
                    <a href="{{ route('psb.perlengkapan') }}"
                        class="px-6 py-3 rounded-md border border-white/30 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs uppercase tracking-wider transition">
                        Perlengkapan Santri
                    </a>
                    <a href="{{ route('psb.status') }}"
                        class="px-5 py-3 rounded-md border border-emerald-400/50 bg-emerald-900/40 hover:bg-emerald-900/70 text-emerald-100 font-semibold text-xs uppercase tracking-wider transition">
                        Cek Status
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
