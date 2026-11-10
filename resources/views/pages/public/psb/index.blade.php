@extends('layouts.public', ['title' => 'Informasi Penerimaan Santri Baru (PSB) - DAAR EL TAZKIYAH SUMARDI'])

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

    <!-- 1. HERO BANNER PSB -->
    <section class="relative bg-cover bg-center overflow-hidden py-16 md:py-24 border-b border-[#B89758]/30"
             style="background-image: url('{{ asset('images/foto-santri-1.webp') }}');">
        <div class="absolute inset-0 bg-gradient-to-t from-[#042816] via-[#084C27]/90 to-[#042816]/85"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
            <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.2]">
                Pendaftaran Santri Baru MTs &amp; MDTA
            </h1>

            <p class="text-base sm:text-lg md:text-xl text-emerald-100/90 max-w-3xl mx-auto leading-relaxed">
                Portal informasi resmi Penerimaan Santri Baru Pondok Pesantren Modern Tahfidzul Qur'an Daar El Tazkiyah Sumardi di Kabupaten Serang, Provinsi Banten.
            </p>
        </div>
    </section>

    <!-- 2. STATUS GELOMBANG PENDAFTARAN (ACTIVE / CLOSED STATE) -->
    <section class="py-8 bg-white border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($activeWave)
                <div class="bg-[#FAF8F5] border-2 border-emerald-600/30 rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xs">
                    <div class="space-y-2 text-center md:text-left">
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-2.5">
                            <span class="px-3 py-1 rounded-full bg-[#059669] text-white text-[11px] font-bold uppercase tracking-wider">
                                Gelombang Dibuka
                            </span>
                            <span class="text-xs font-mono font-bold text-[#0D3B2E]">
                                {{ $activeWave->name }}
                            </span>
                        </div>
                        <h2 class="font-sans text-xl sm:text-2xl font-extrabold text-[#0D3B2E]">
                            Pendaftaran Santri Baru Tahun Ajaran {{ $activeWave->academic_year }}
                        </h2>
                        <p class="text-xs sm:text-sm text-[#4B6358] max-w-2xl">
                            Periode Pendaftaran:
                            <strong>{{ $activeWave->start_date?->translatedFormat('d F Y') }}</strong> s/d
                            <strong>{{ $activeWave->end_date?->translatedFormat('d F Y') }}</strong>.
                            Kuota terbatas putra dan putri untuk jenjang <strong>MTS</strong> (Mukim) dan <strong>MDTA</strong> (Sekolah Sore).
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0 w-full md:w-auto">
                        <a href="{{ route('psb.form') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                            <span>Daftar Sekarang &rarr;</span>
                        </a>
                        <a href="{{ route('psb.fee') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-md border border-[#0D3B2E] bg-white text-[#0D3B2E] hover:bg-[#0D3B2E] hover:text-white text-xs font-semibold uppercase tracking-wider transition">
                            <span>Rincian Biaya</span>
                        </a>
                        <a href="{{ route('psb.status') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 rounded-md border border-[#E5E0D8] bg-white text-[#0D3B2E] hover:border-[#0D3B2E] text-xs font-semibold uppercase tracking-wider transition">
                            <span>Cek Status</span>
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-[#FAF8F5] border border-amber-300 rounded-2xl p-8 text-center space-y-4 shadow-xs max-w-3xl mx-auto">
                    <div class="w-12 h-12 mx-auto rounded-full bg-amber-100 text-amber-800 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="space-y-1">
                        <h2 class="font-sans text-xl sm:text-2xl font-bold text-[#0D3B2E]">
                            Pendaftaran Santri Baru Sedang Ditutup
                        </h2>
                        <p class="text-xs sm:text-sm text-[#4B6358] max-w-xl mx-auto leading-relaxed">
                            Saat ini belum ada gelombang pendaftaran yang aktif (closed). Silakan hubungi sekretariat panitia untuk konfirmasi jadwal gelombang berikutnya bagi calon santri <strong>MTS</strong> dan <strong>MDTA</strong>.
                        </p>
                    </div>
                    <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
                        <a href="{{ route('psb.fee') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-md border border-[#0D3B2E] bg-white text-[#0D3B2E] hover:bg-[#0D3B2E] hover:text-white text-xs font-semibold uppercase tracking-wider transition">
                            <span>Rincian Biaya</span>
                        </a>
                        @php
                            $waNum = \App\Models\SiteSetting::get('school_phone', '0896-5332-4339');
                        @endphp
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waNum) }}" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-6 py-2.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition">
                            <span>Hubungi Panitia (WhatsApp)</span>
                        </a>
                        <a href="{{ route('psb.status') }}"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-md border border-[#E5E0D8] bg-white text-[#0D3B2E] text-xs font-semibold uppercase tracking-wider transition">
                            <span>Cek Status</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- 3. ALUR & TAHAPAN PENDAFTARAN -->
    <section class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        ALUR PENDAFTARAN SANTRI
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
            </div>

            <!-- 4 Alur Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Tahap 1 -->
                <div class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-3 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <span class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 text-[#0D3B2E] font-mono font-extrabold text-base flex items-center justify-center">
                            01
                        </span>
                        <span class="text-[10px] font-mono uppercase font-bold text-[#059669]">Online</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Isi Formulir Online
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Wali santri mengisi formulir pendaftaran melalui laman <a href="{{ route('psb.form') }}" class="text-[#059669] underline font-semibold">psb/form</a> dan melampirkan berkas dokumen yang diperlukan.
                    </p>
                </div>

                <!-- Tahap 2 -->
                <div class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-3 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <span class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200 text-[#B89758] font-mono font-extrabold text-base flex items-center justify-center">
                            02
                        </span>
                        <span class="text-[10px] font-mono uppercase font-bold text-[#B89758]">Verifikasi</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Simpan Bukti &amp; Token
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Unduh lembar bukti pendaftaran berformat PDF yang memuat nomor registrasi dan kode akses rahasia santri.
                    </p>
                </div>

                <!-- Tahap 3 -->
                <div class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-3 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <span class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 text-[#0D3B2E] font-mono font-extrabold text-base flex items-center justify-center">
                            03
                        </span>
                        <span class="text-[10px] font-mono uppercase font-bold text-[#059669]">Observasi</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Tes &amp; Silaturahmi
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Calon santri mengikuti pemetaan bacaan Al-Qur'an dan wawancara kesiapan mukim bersama orang tua di pondok.
                    </p>
                </div>

                <!-- Tahap 4 -->
                <div class="group relative bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 space-y-3 hover:border-[#0D3B2E] hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <span class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-200 text-[#B89758] font-mono font-extrabold text-base flex items-center justify-center">
                            04
                        </span>
                        <span class="text-[10px] font-mono uppercase font-bold text-[#B89758]">Kelulusan</span>
                    </div>
                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition">
                        Daftar Ulang
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Cek status penerimaan secara mandiri di website dan selesaikan administrasi daftar ulang sebelum masuk asrama.
                    </p>
                </div>
            </div>

            <!-- Action Button -->
            <div class="text-center pt-2">
                <a href="{{ route('psb.form') }}"
                    class="inline-flex items-center gap-2 px-8 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs sm:text-sm font-bold uppercase tracking-wider transition shadow-xs">
                    <span>Mulai Mengisi Formulir Pendaftaran &rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- 4. RINCIAN BIAYA PENDIDIKAN & PERLENGKAPAN SANTRI (RINGKASAN & LINK) -->
    <section id="tabel-biaya" class="py-12 md:py-16 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        RINCIAN BIAYA PENDIDIKAN
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
                <p class="text-xs sm:text-sm text-[#4B6358] max-w-2xl mx-auto leading-relaxed">
                    Informasi transparan mengenai infaq pendaftaran, syahriyah bulanan, estimasi kebutuhan masuk awal, serta daftar lengkap <strong>PERLENGKAPAN SANTRI BARU</strong> kini dirangkum dalam satu halaman terpisah.
                </p>
            </div>

            <!-- Highlights Comparison Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto items-stretch">
                <!-- MTS -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 flex flex-col justify-between space-y-4 hover:border-[#0D3B2E] transition shadow-xs">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="editorial-label text-[#059669]">MUKIM 24 JAM</span>
                            <span class="text-xs font-mono font-bold text-[#0D3B2E]">MTS</span>
                        </div>
                        <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">Madrasah Tsanawiyah</h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">Pendidikan formal Kemenag berpadu asrama mukim dan bimbingan tahfidz intensif.</p>
                        <div class="bg-white p-3.5 rounded-xl border border-[#E5E0D8] flex items-center justify-between">
                            <div>
                                <span class="text-[11px] text-[#4B6358] block">Syahriyah</span>
                                <span class="text-lg font-bold text-[#0D3B2E]">Rp 500.000<span class="text-xs font-normal text-gray-500">/bln</span></span>
                            </div>
                            <div class="text-right border-l border-[#E5E0D8] pl-3">
                                <span class="text-[11px] text-[#4B6358] block">Infaq Pendaftaran</span>
                                <span class="text-sm font-bold text-[#B89758]">Rp {{ $feeMts }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-xs text-[#059669] font-medium flex items-center gap-1.5 pt-2 border-t border-[#E5E0D8]">
                        <span>&bull; Makan 3x sehari &bull; Asrama &bull; Ijazah Kemenag</span>
                    </div>
                </div>

                <!-- MDTA -->
                <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-2xl p-6 sm:p-7 flex flex-col justify-between space-y-4 hover:border-[#0D3B2E] transition shadow-xs">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="editorial-label text-[#B89758]">NON-MUKIM</span>
                            <span class="text-xs font-mono font-bold text-[#0D3B2E]">MDTA</span>
                        </div>
                        <h3 class="font-sans font-bold text-xl text-[#0D3B2E]">Madrasah Diniyah (MDTA)</h3>
                        <p class="text-xs text-[#4B6358] leading-relaxed">Sekolah sore ba'da Ashar (Senin–Kamis) untuk anak usia SD/MI di wilayah Serang.</p>
                        <div class="bg-white p-3.5 rounded-xl border border-[#E5E0D8] flex items-center justify-between">
                            <div>
                                <span class="text-[11px] text-[#4B6358] block">Syahriyah</span>
                                <span class="text-lg font-bold text-[#0D3B2E]">Rp 12.000<span class="text-xs font-normal text-gray-500">/bln</span></span>
                            </div>
                            <div class="text-right border-l border-[#E5E0D8] pl-3">
                                <span class="text-[11px] text-[#4B6358] block">Infaq Pendaftaran</span>
                                <span class="text-sm font-bold text-[#B89758]">Rp {{ $feeMdta }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-xs text-[#B89758] font-medium flex items-center gap-1.5 pt-2 border-t border-[#E5E0D8]">
                        <span>&bull; Tahfidz Juz 30 &bull; Diniyah Sore &bull; Seni Islam</span>
                    </div>
                </div>
            </div>

            <!-- Dedicated CTA to /psb/biaya -->
            <div class="text-center pt-2">
                <a href="{{ route('psb.fee') }}"
                    class="inline-flex items-center gap-2 px-8 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs sm:text-sm font-bold uppercase tracking-wider transition shadow-xs">
                    <span>Lihat Rincian Biaya &amp; Perlengkapan Lengkap &rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- 5. PERSYARATAN BERKAS PENDAFTARAN -->
    <section class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        PERSYARATAN BERKAS PENDAFTARAN
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
            </div>

            <!-- 6 Document Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1 -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-lg bg-emerald-50 text-[#0D3B2E] font-mono font-bold text-xs flex items-center justify-center">01</span>
                        <span class="text-[10px] font-mono uppercase text-[#059669] font-bold">Wajib</span>
                    </div>
                    <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Fotokopi Akta Kelahiran</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Fotokopi akta kelahiran calon santri sebanyak 2 lembar untuk verifikasi identitas resmi dan sinkronisasi data EMIS Kemenag.
                    </p>
                </div>

                <!-- 2 -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-lg bg-emerald-50 text-[#0D3B2E] font-mono font-bold text-xs flex items-center justify-center">02</span>
                        <span class="text-[10px] font-mono uppercase text-[#059669] font-bold">Wajib</span>
                    </div>
                    <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Kartu Keluarga (KK) &amp; KTP</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Fotokopi Kartu Keluarga terbaru dan KTP kedua orang tua/wali santri (masing-masing 2 lembar).
                    </p>
                </div>

                <!-- 3 -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-lg bg-emerald-50 text-[#0D3B2E] font-mono font-bold text-xs flex items-center justify-center">03</span>
                        <span class="text-[10px] font-mono uppercase text-[#059669] font-bold">Wajib</span>
                    </div>
                    <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Ijazah / SKL SD/MI</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Fotokopi Ijazah yang telah dilegalisir atau Surat Keterangan Lulus (SKL) bagi santri yang baru menyelesaikan pendidikan dasar.
                    </p>
                </div>

                <!-- 4 -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-lg bg-emerald-50 text-[#0D3B2E] font-mono font-bold text-xs flex items-center justify-center">04</span>
                        <span class="text-[10px] font-mono uppercase text-[#059669] font-bold">Wajib</span>
                    </div>
                    <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Pas Foto Formal 3x4</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pas foto formal berwarna ukuran 3x4 (2 lembar) berlatar belakang merah/biru, mengenakan pakaian rapi atau berbusana muslim.
                    </p>
                </div>

                <!-- 5 -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-lg bg-amber-50 text-[#B89758] font-mono font-bold text-xs flex items-center justify-center">05</span>
                        <span class="text-[10px] font-mono uppercase text-[#B89758] font-bold">Kesehatan</span>
                    </div>
                    <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Surat Sehat Dokter</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Surat keterangan sehat dari Puskesmas/Dokter umum yang menyatakan santri sehat jasmani dan tidak memiliki penyakit menular.
                    </p>
                </div>

                <!-- 6 -->
                <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 space-y-3 hover:border-[#0D3B2E] hover:shadow-xs transition">
                    <div class="flex items-center justify-between">
                        <span class="w-8 h-8 rounded-lg bg-amber-50 text-[#B89758] font-mono font-bold text-xs flex items-center justify-center">06</span>
                        <span class="text-[10px] font-mono uppercase text-[#B89758] font-bold">Registrasi</span>
                    </div>
                    <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Bukti Formulir Online</h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Membawa cetak lembar bukti pendaftaran yang didapatkan setelah menyelesaikan pengisian di portal online.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. FAQ RINGKAS PSB -->
    <section class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 md:space-y-12">
            <!-- Centered Header -->
            <div class="text-center max-w-3xl mx-auto">
                <div class="flex items-center justify-center gap-3 sm:gap-4">
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        PERTANYAAN SEPUTAR PSB
                    </h2>
                    <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                </div>
            </div>

            <!-- FAQ List -->
            <div class="space-y-4">
                <div class="bg-white border border-[#E5E0D8] rounded-xl p-5 space-y-2 shadow-xs">
                    <h3 class="font-sans font-bold text-base text-[#0D3B2E]">
                        Bagaimana cara mendaftar santri baru di PPMTQ Daar El Tazkiyah?
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Pendaftaran dapat dilakukan secara online melalui menu <a href="{{ route('psb.form') }}" class="text-[#059669] font-semibold underline">Formulir Pendaftaran</a> di website resmi kami. Wali santri cukup mengisi data diri santri, orang tua, dan mengunggah scan berkas yang dipersyaratkan.
                    </p>
                </div>

                <div class="bg-white border border-[#E5E0D8] rounded-xl p-5 space-y-2 shadow-xs">
                    <h3 class="font-sans font-bold text-base text-[#0D3B2E]">
                        Apakah santri jenjang MTs wajib mukim di asrama?
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Ya, jenjang Madrasah Tsanawiyah (MTs) merupakan pendidikan berbasis pesantren mukim 24 jam dengan fasilitas makan 3 kali sehari dan bimbingan halaqah Al-Qur'an intensif oleh asatidz huffadz.
                    </p>
                </div>

                <div class="bg-white border border-[#E5E0D8] rounded-xl p-5 space-y-2 shadow-xs">
                    <h3 class="font-sans font-bold text-base text-[#0D3B2E]">
                        Apakah ada batasan kuota untuk setiap gelombang pendaftaran?
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Ya, kuota santri putra dan putri dibatasi per gelombang demi menjaga rasio kenyamanan asrama dan efektivitas pembelajaran halaqah tahfidz yang kondusif.
                    </p>
                </div>

                <div class="bg-white border border-[#E5E0D8] rounded-xl p-5 space-y-2 shadow-xs">
                    <h3 class="font-sans font-bold text-base text-[#0D3B2E]">
                        Bagaimana cara mengecek status pendaftaran santri?
                    </h3>
                    <p class="text-xs text-[#4B6358] leading-relaxed">
                        Wali santri dapat membuka halaman <a href="{{ route('psb.status') }}" class="text-[#059669] font-semibold underline">Cek Status Pendaftaran</a> lalu memasukkan nomor registrasi resmi serta kode akses rahasia yang tertera pada lembar bukti pendaftaran.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. BOTTOM CTA BANNER -->
    <section class="py-12 md:py-16 bg-[#084C27] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <div class="max-w-2xl mx-auto space-y-3">
                <h2 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    Mulai Langkah Pendaftaran Santri Baru Sekarang
                </h2>
                <p class="text-xs sm:text-sm text-emerald-100/90 leading-relaxed">
                    Daftarkan putra-putri Anda melalui formulir online atau jadwalkan silaturahmi langsung ke pondok pesantren kami di Mekar Baru, Petir, Serang, Banten.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                <a href="{{ route('psb.form') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-md bg-[#D97706] hover:bg-[#b46304] text-white font-bold text-xs uppercase tracking-wider transition shadow-md">
                    <span>Isi Formulir Pendaftaran &rarr;</span>
                </a>
                <a href="{{ route('psb.fee') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-md border border-white/30 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs uppercase tracking-wider transition">
                    <span>Rincian Biaya</span>
                </a>
                <a href="{{ route('psb.status') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-md border border-white/30 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs uppercase tracking-wider transition">
                    <span>Cek Status Pendaftaran</span>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection