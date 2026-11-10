@extends('layouts.public', ['title' => 'Informasi & Pendaftaran PSB T.A 2027/2028 - DAAR EL TAZKIYAH SUMARDI'])

@section('content')
<div x-data="{ 
    showModal: false, 
    modalImage: '', 
    modalTitle: '',
    equipmentTab: 'sekolah',
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

    <!-- Hero / Banner Section PSB -->
    <section class="bg-white border-b border-[#E5E0D8] pt-12 pb-14 md:pt-16 md:pb-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <div class="lg:col-span-7 space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-mono font-bold text-[#059669] uppercase tracking-wider">
                            Penerimaan Santri Baru (PSB) T.A 2027 – 2028
                        </span>
                        <span class="w-2 h-2 rounded-full bg-[#059669] animate-pulse"></span>
                    </div>
                    
                    <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#0D3B2E] tracking-tight leading-[1.15]">
                        Pendaftaran Santri Baru Tingkat SLTP/SMP Sederajat
                    </h1>
                    
                    <p class="text-base sm:text-lg text-[#4B6358] leading-relaxed">
                        Selamat datang di portal informasi resmi Penerimaan Santri Baru Pondok Pesantren Modern Tahfidzul Qur'an Daar El Tazkiyah Sumardi. Pendaftaran transparan dengan rincian biaya resmi dan daftar perlengkapan santri.
                    </p>

                    <div class="flex flex-wrap items-center gap-2.5 pt-2 text-xs font-bold uppercase tracking-wider">
                        <a href="#tabel-biaya" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                            &darr; Rincian Biaya PSB
                        </a>
                        <a href="#perlengkapan-santri" class="px-3.5 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                            &darr; Perlengkapan Santri
                        </a>
                        <a href="#formulir-pendaftaran" class="px-4 py-2 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white transition shadow-xs">
                            &darr; Formulir Pendaftaran Online
                        </a>
                        <a href="{{ route('psb.status') }}" class="px-3.5 py-2 rounded-md bg-white border border-[#E5E0D8] text-[#4B6358] hover:text-[#0D3B2E] hover:border-[#0D3B2E] transition">
                            Cek Status Pendaftaran &rarr;
                        </a>
                    </div>
                </div>

                <!-- Right Visual: Hero PSB Image or Visual Card -->
                <div class="lg:col-span-5">
                    @php
                        $heroPsbFile = 'images/Hero PSB.jpg';
                        $hasHeroPsb = file_exists(public_path($heroPsbFile));
                    @endphp

                    <div class="border border-[#E5E0D8] rounded-xl overflow-hidden shadow-md bg-white p-2">
                        @if($hasHeroPsb)
                            <div class="aspect-16/10 relative overflow-hidden rounded-lg bg-gray-100 cursor-pointer group"
                                 @click="openModal('{{ asset($heroPsbFile) }}', 'Brosur Penerimaan Santri Baru (PSB)')">
                                <img src="{{ asset($heroPsbFile) }}" 
                                    alt="Hero PSB Daar El Tazkiyah" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-semibold gap-1.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                    <span>Perbesar Brosur PSB</span>
                                </div>
                            </div>
                        @else
                            <div class="aspect-16/10 relative overflow-hidden rounded-lg bg-gray-100 cursor-pointer group"
                                 @click="openModal('{{ asset('images/foto-santri-3.webp') }}', 'Penerimaan Santri Baru PPMTQ Daar El Tazkiyah')">
                                <img src="{{ asset('images/foto-santri-3.webp') }}" 
                                    alt="Santri Baru Daar El Tazkiyah" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0D3B2E]/90 via-[#0D3B2E]/40 to-transparent flex flex-col justify-end p-5 text-white">
                                    <span class="text-[10px] font-mono uppercase tracking-widest text-amber-300 font-bold">PSB T.A 2027/2028</span>
                                    <h3 class="font-sans font-bold text-lg leading-tight mt-0.5">Membina Generasi Penghafal Al-Qur'an</h3>
                                    <p class="text-[11px] text-emerald-100/90 mt-1">Kuota terbatas putra &amp; putri untuk lingkungan belajar yang kondusif.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION 1: TABEL RINCIAN BIAYA PSB (T.A 2027 - 2028) -->
    <section id="tabel-biaya" class="py-10 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 md:space-y-10">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-3xl">
                    <span class="editorial-label text-[#059669]">TRANSPARANSI KEUANGAN</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Rincian Biaya Masuk Santri Baru (T.A 2027/2028)
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Tabel perbandingan biaya masuk untuk <strong>Santri Laki-Laki</strong> dan <strong>Santri Perempuan</strong> jenjang SLTP/SMP Sederajat (MTs Mukim 24 Jam).
                    </p>
                </div>

                @php
                    $hargaPsbFile = 'images/Rincian Harga PSB.jpg';
                    $hasHargaPsb = file_exists(public_path($hargaPsbFile));
                @endphp
                <div class="flex items-center gap-3 shrink-0">
                    @if($hasHargaPsb)
                        <button type="button" 
                            @click="openModal('{{ asset($hargaPsbFile) }}', 'Brosur Rincian Biaya PSB T.A 2027/2028')"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-md bg-white border border-[#E5E0D8] hover:border-[#0D3B2E] text-xs font-semibold text-[#0D3B2E] transition shadow-xs">
                            <svg class="w-4 h-4 text-[#059669]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <span>Lihat Brosur Biaya Asli</span>
                        </button>
                    @endif
                </div>
            </div>

            <!-- Cost Comparison Table -->
            <div class="border border-[#E5E0D8] rounded-xl overflow-hidden shadow-xs bg-white">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs sm:text-sm border-collapse">
                        <thead>
                            <tr class="bg-[#0D3B2E] text-white">
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px] w-12 text-center">No</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px]">Komponen Pembiayaan</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px]">Keterangan / Periode</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px] text-right">Santri Laki-Laki</th>
                                <th class="py-3.5 px-4 sm:px-6 font-semibold uppercase tracking-wider text-[11px] text-right">Santri Perempuan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E5E0D8]">
                            <!-- 1. Biaya Pendaftaran -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3 px-4 sm:px-6 text-center font-mono font-bold text-[#4B6358]">1</td>
                                <td class="py-3 px-4 sm:px-6 font-medium text-[#0D3B2E]">Biaya Pendaftaran</td>
                                <td class="py-3 px-4 sm:px-6 text-[#4B6358]">1 Kali (Awal Masuk)</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 100.000</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 100.000</td>
                            </tr>
                            <!-- 2. Uang Ujian -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3 px-4 sm:px-6 text-center font-mono font-bold text-[#4B6358]">2</td>
                                <td class="py-3 px-4 sm:px-6 font-medium text-[#0D3B2E]">Uang Ujian</td>
                                <td class="py-3 px-4 sm:px-6 text-[#4B6358]">Setahun</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 200.000</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 200.000</td>
                            </tr>
                            <!-- 3. Seragam Olahraga -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3 px-4 sm:px-6 text-center font-mono font-bold text-[#4B6358]">3</td>
                                <td class="py-3 px-4 sm:px-6 font-medium text-[#0D3B2E]">Seragam Olahraga</td>
                                <td class="py-3 px-4 sm:px-6 text-[#4B6358]">1 Set</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 150.000</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 150.000</td>
                            </tr>
                            <!-- 4. Baju Muslim -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3 px-4 sm:px-6 text-center font-mono font-bold text-[#4B6358]">4</td>
                                <td class="py-3 px-4 sm:px-6 font-medium text-[#0D3B2E]">Baju Muslim</td>
                                <td class="py-3 px-4 sm:px-6 text-[#4B6358]">1 Set</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 150.000</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 150.000</td>
                            </tr>
                            <!-- 5. Sewa Lemari -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3 px-4 sm:px-6 text-center font-mono font-bold text-[#4B6358]">5</td>
                                <td class="py-3 px-4 sm:px-6 font-medium text-[#0D3B2E]">Sewa Lemari</td>
                                <td class="py-3 px-4 sm:px-6 text-[#4B6358]">Setahun</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 150.000</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 150.000</td>
                            </tr>
                            <!-- 6. Beli Kasur -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3 px-4 sm:px-6 text-center font-mono font-bold text-[#4B6358]">6</td>
                                <td class="py-3 px-4 sm:px-6 font-medium text-[#0D3B2E]">Beli Kasur</td>
                                <td class="py-3 px-4 sm:px-6 text-[#4B6358]">1 Kali (Milik Santri)</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 200.000</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 200.000</td>
                            </tr>
                            <!-- 7. Iuran Bulanan -->
                            <tr class="hover:bg-[#FAF8F5] transition bg-emerald-50/30">
                                <td class="py-3 px-4 sm:px-6 text-center font-mono font-bold text-[#059669]">7</td>
                                <td class="py-3 px-4 sm:px-6">
                                    <strong class="font-bold text-[#0D3B2E] block">Iuran Bulanan (Syahriyah)</strong>
                                    <span class="text-[11px] text-[#059669]">Sudah termasuk biaya pendidikan &amp; makan 3x sehari</span>
                                </td>
                                <td class="py-3 px-4 sm:px-6 text-[#4B6358]">Per Bulan</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-bold text-[#0D3B2E]">Rp 500.000</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-bold text-[#0D3B2E]">Rp 500.000</td>
                            </tr>
                            <!-- 8. Kitab & Buku -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3 px-4 sm:px-6 text-center font-mono font-bold text-[#4B6358]">8</td>
                                <td class="py-3 px-4 sm:px-6 font-medium text-[#0D3B2E]">Kitab &amp; Buku Pelajaran / LKS</td>
                                <td class="py-3 px-4 sm:px-6 text-[#4B6358]">Setahun</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 1.000.000</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 1.000.000</td>
                            </tr>
                            <!-- 9. Organisasi -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3 px-4 sm:px-6 text-center font-mono font-bold text-[#4B6358]">9</td>
                                <td class="py-3 px-4 sm:px-6 font-medium text-[#0D3B2E]">Organisasi Santri</td>
                                <td class="py-3 px-4 sm:px-6 text-[#4B6358]">Setahun</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 100.000</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 100.000</td>
                            </tr>
                            <!-- 10. Ekstrakurikuler -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3 px-4 sm:px-6 text-center font-mono font-bold text-[#4B6358]">10</td>
                                <td class="py-3 px-4 sm:px-6 font-medium text-[#0D3B2E]">Ekstrakurikuler</td>
                                <td class="py-3 px-4 sm:px-6 text-[#4B6358]">Setahun</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 200.000</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 200.000</td>
                            </tr>
                            <!-- 11. Wakaf Pembangunan -->
                            <tr class="hover:bg-[#FAF8F5] transition">
                                <td class="py-3 px-4 sm:px-6 text-center font-mono font-bold text-[#4B6358]">11</td>
                                <td class="py-3 px-4 sm:px-6 font-medium text-[#0D3B2E]">Wakaf Pembangunan</td>
                                <td class="py-3 px-4 sm:px-6 text-[#4B6358]">1 Kali (Investasi Jariyah)</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 500.000</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-semibold text-[#0D3B2E]">Rp 500.000</td>
                            </tr>
                            <!-- 12. Kerudung Hitam + Putih -->
                            <tr class="hover:bg-[#FAF8F5] transition bg-amber-50/30">
                                <td class="py-3 px-4 sm:px-6 text-center font-mono font-bold text-[#B89758]">12</td>
                                <td class="py-3 px-4 sm:px-6">
                                    <strong class="font-bold text-[#0D3B2E] block">Kerudung Hitam + Putih</strong>
                                    <span class="text-[11px] text-[#B89758]">Khusus Santri Perempuan (1 Set)</span>
                                </td>
                                <td class="py-3 px-4 sm:px-6 text-[#4B6358]">1 Set Khusus Putri</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-bold text-gray-400">-</td>
                                <td class="py-3 px-4 sm:px-6 text-right font-mono font-bold text-[#0D3B2E]">Rp 100.000</td>
                            </tr>

                            <!-- TOTAL ROW -->
                            <tr class="bg-[#0D3B2E] text-white font-sans text-sm sm:text-base border-t-2 border-[#B89758]">
                                <td colspan="3" class="py-4 px-4 sm:px-6 font-extrabold uppercase tracking-wider text-right">
                                    TOTAL BIAYA MASUK SANTRI BARU:
                                </td>
                                <td class="py-4 px-4 sm:px-6 text-right font-mono font-extrabold text-amber-300 whitespace-nowrap text-base sm:text-lg">
                                    Rp 3.250.000
                                </td>
                                <td class="py-4 px-4 sm:px-6 text-right font-mono font-extrabold text-amber-300 whitespace-nowrap text-base sm:text-lg">
                                    Rp 3.350.000
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Catatan Biaya PSB -->
                <div class="p-5 sm:p-6 bg-[#FAF8F5] border-t border-[#E5E0D8] space-y-2 text-xs text-[#4B6358]">
                    <span class="font-bold text-[#0D3B2E] uppercase tracking-wider text-[11px] block">Catatan Penting Pembiayaan PSB:</span>
                    <ul class="space-y-1.5 list-disc list-inside leading-relaxed">
                        <li>Seluruh rincian biaya di atas berlaku sama untuk santri laki-laki dan perempuan, kecuali komponen kerudung hitam + putih yang khusus diperuntukkan bagi santri perempuan.</li>
                        <li>Iuran bulanan sebesar <strong>Rp 500.000/bulan</strong> sudah mencakup seluruh biaya pendidikan asrama serta penyediaan konsumsi makan 3 kali sehari.</li>
                        <li><strong>TIDAK ADA Fasilitas Cuci / Laundry:</strong> Santri membawa peralatan mencuci pakaian sendiri untuk melatih kemandirian dan kebersihan pribadi di asrama.</li>
                        <li>Biaya yang bertuliskan <em>"1 Kali"</em> hanya dibayarkan 1 (satu) kali selama masa pendaftaran awal masuk pondok.</li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 2: DAFTAR PERLENGKAPAN SANTRI BARU (PUTRA & PUTRI) -->
    <section id="perlengkapan-santri" class="py-10 md:py-16 bg-white border-b border-[#E5E0D8] scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 md:space-y-10">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#E5E0D8] pb-6">
                <div class="space-y-2 max-w-3xl">
                    <span class="editorial-label text-[#059669]">PERSIAPAN MASUK ASRAMA</span>
                    <h2 class="font-sans text-3xl sm:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                        Daftar Perlengkapan Santri Baru
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358] leading-relaxed">
                        Panduan perlengkapan wajib yang harus dipersiapkan oleh orang tua/wali santri sebelum masuk ke asrama PPMTQ DAAR EL TAZKIYAH SUMARDI.
                    </p>
                </div>

                @php
                    $perlengkapanBrochure = 'images/perlengakapan santri baru.jpg';
                    $hasPerlengkapanBrochure = file_exists(public_path($perlengkapanBrochure));
                @endphp
                <div class="flex items-center gap-3 shrink-0">
                    @if($hasPerlengkapanBrochure)
                        <button type="button" 
                            @click="openModal('{{ asset($perlengkapanBrochure) }}', 'Brosur Daftar Perlengkapan Santri Baru')"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] hover:border-[#0D3B2E] text-xs font-semibold text-[#0D3B2E] transition shadow-xs">
                            <svg class="w-4 h-4 text-[#059669]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <span>Lihat Brosur Perlengkapan</span>
                        </button>
                    @endif
                </div>
            </div>

            <!-- Interactive Tab Navigation -->
            <div class="space-y-6">
                <div class="flex flex-wrap items-center gap-2 border-b border-[#E5E0D8] pb-3">
                    <button type="button" @click="equipmentTab = 'sekolah'"
                        class="px-4 py-2.5 rounded-md text-xs font-bold uppercase tracking-wider transition"
                        :class="equipmentTab === 'sekolah' ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-[#FAF8F5] border border-[#E5E0D8] text-[#4B6358] hover:text-[#0D3B2E]'">
                        1. Seragam Sekolah Formal
                    </button>
                    <button type="button" @click="equipmentTab = 'pondok'"
                        class="px-4 py-2.5 rounded-md text-xs font-bold uppercase tracking-wider transition"
                        :class="equipmentTab === 'pondok' ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-[#FAF8F5] border border-[#E5E0D8] text-[#4B6358] hover:text-[#0D3B2E]'">
                        2. Seragam Pondok Formal
                    </button>
                    <button type="button" @click="equipmentTab = 'sholat'"
                        class="px-4 py-2.5 rounded-md text-xs font-bold uppercase tracking-wider transition"
                        :class="equipmentTab === 'sholat' ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-[#FAF8F5] border border-[#E5E0D8] text-[#4B6358] hover:text-[#0D3B2E]'">
                        3. Perlengkapan Sholat
                    </button>
                    <button type="button" @click="equipmentTab = 'harian'"
                        class="px-4 py-2.5 rounded-md text-xs font-bold uppercase tracking-wider transition"
                        :class="equipmentTab === 'harian' ? 'bg-[#0D3B2E] text-white shadow-xs' : 'bg-[#FAF8F5] border border-[#E5E0D8] text-[#4B6358] hover:text-[#0D3B2E]'">
                        4. Perlengkapan Sehari-hari
                    </button>
                </div>

                <!-- TAB 1: Seragam Sekolah Formal -->
                <div x-show="equipmentTab === 'sekolah'" x-cloak class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Putra -->
                    <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Santri Putra (Ikhwan)</h3>
                            <span class="text-xs font-mono font-bold px-2 py-0.5 rounded bg-emerald-100 text-[#084C27]">Formal Putra</span>
                        </div>
                        <ul class="text-xs space-y-2.5 text-[#18181B]">
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Celana Hitam &amp; Baju Putih</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Celana Biru &amp; Baju Putih</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Pramuka 1 Stel</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Dasi Biru, Dasi Hitam &amp; Kacu Pramuka</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Gesper (Ikat Pinggang)</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Sepatu hitam (disarankan pantofel) &amp; Kaos kaki</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Peci Hitam (Songkok)</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Buku &amp; Alat tulis lainnya</span></li>
                        </ul>
                    </div>

                    <!-- Putri -->
                    <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Santri Putri (Akhwat)</h3>
                            <span class="text-xs font-mono font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-900">Formal Putri</span>
                        </div>
                        <ul class="text-xs space-y-2.5 text-[#18181B]">
                            <li class="flex items-start gap-2.5"><span class="text-[#B89758] font-bold">&check;</span><span>Rok Hitam &amp; Baju Putih</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#B89758] font-bold">&check;</span><span>Rok Biru &amp; Baju Putih</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#B89758] font-bold">&check;</span><span>Pramuka 1 Stel &amp; Kacu Pramuka</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#B89758] font-bold">&check;</span><span>Gesper (Ikat Pinggang)</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#B89758] font-bold">&check;</span><span>Sepatu hitam (disarankan pantofel) &amp; Kaos kaki</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#B89758] font-bold">&check;</span><span>Kerudung Putih, Hitam &amp; Coklat (segi empat tebal &amp; besar)</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#B89758] font-bold">&check;</span><span>Buku &amp; Alat tulis lainnya</span></li>
                        </ul>
                    </div>
                </div>

                <!-- TAB 2: Seragam Pondok Formal -->
                <div x-show="equipmentTab === 'pondok'" x-cloak class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Putra -->
                    <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Santri Putra (Ikhwan)</h3>
                            <span class="text-xs font-mono font-bold px-2 py-0.5 rounded bg-emerald-100 text-[#084C27]">Kegiatan Pondok</span>
                        </div>
                        <ul class="text-xs space-y-2.5 text-[#18181B]">
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Celana Hitam &amp; Baju Putih</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Peci Hitam (Songkok)</span></li>
                        </ul>
                    </div>

                    <!-- Putri -->
                    <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Santri Putri (Akhwat)</h3>
                            <span class="text-xs font-mono font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-900">Kegiatan Pondok</span>
                        </div>
                        <ul class="text-xs space-y-2.5 text-[#18181B]">
                            <li class="flex items-start gap-2.5"><span class="text-[#B89758] font-bold">&check;</span><span>Rok Hitam &amp; Baju Putih</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#B89758] font-bold">&check;</span><span>Kerudung Hitam / Putih (segi empat tebal &amp; besar)</span></li>
                        </ul>
                    </div>
                </div>

                <!-- TAB 3: Perlengkapan Sholat -->
                <div x-show="equipmentTab === 'sholat'" x-cloak class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Putra -->
                    <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Santri Putra (Ikhwan)</h3>
                            <span class="text-xs font-mono font-bold px-2 py-0.5 rounded bg-emerald-100 text-[#084C27]">Ibadah Putra</span>
                        </div>
                        <ul class="text-xs space-y-2.5 text-[#18181B]">
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Baju Muslim Bebas (Min. 4 stel)</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Sarung (Min. 4 lembar)</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Sajadah (Min. 1 lembar)</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Koko Putih / Gamis Putih (Min. 2 stel)</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Kemeja Panjang bebas</span></li>
                        </ul>
                    </div>

                    <!-- Putri -->
                    <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Santri Putri (Akhwat)</h3>
                            <span class="text-xs font-mono font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-900">Ibadah Putri</span>
                        </div>
                        <ul class="text-xs space-y-2.5 text-[#18181B]">
                            <li class="flex items-start gap-2.5"><span class="text-[#B89758] font-bold">&check;</span><span>Mukena Warna bebas (Min. 2 set)</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#B89758] font-bold">&check;</span><span>Sajadah (Min. 1 lembar)</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#B89758] font-bold">&check;</span><span>Mukena Warna Putih (Min. 1 set)</span></li>
                        </ul>
                    </div>
                </div>

                <!-- TAB 4: Perlengkapan Sehari-hari -->
                <div x-show="equipmentTab === 'harian'" x-cloak class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pakaian Bebas & Tidur -->
                    <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Pakaian Tidur / Waktu Bebas</h3>
                            <span class="text-xs font-mono font-bold px-2 py-0.5 rounded bg-slate-200 text-slate-800">Istirahat</span>
                        </div>
                        <div class="space-y-4 text-xs">
                            <div>
                                <strong class="text-[#0D3B2E] block mb-1.5 font-bold">Untuk Putra:</strong>
                                <ul class="space-y-1.5 text-[#18181B] pl-2">
                                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Baju kaos polos</span></li>
                                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Celana Training (Min. 2)</span></li>
                                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Celana bahan / celana hitam &amp; Gesper</span></li>
                                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#059669]"></span><span>Bantal / guling</span></li>
                                </ul>
                            </div>
                            <div class="pt-2 border-t border-[#E5E0D8]">
                                <strong class="text-[#0D3B2E] block mb-1.5 font-bold">Untuk Putri:</strong>
                                <ul class="space-y-1.5 text-[#18181B] pl-2">
                                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#B89758]"></span><span>Baju gamis menutup aurat</span></li>
                                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#B89758]"></span><span>Kerudung hitam (bergo jumbo)</span></li>
                                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#B89758]"></span><span>Celana bahan / hitam &amp; Gesper</span></li>
                                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#B89758]"></span><span>Bantal / guling</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Perlengkapan Makan, Mencuci, & Mandi (Putra & Putri) -->
                    <div class="bg-[#FAF8F5] border border-[#E5E0D8] rounded-xl p-6 space-y-4">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E]">Makan, Mandi, &amp; Mencuci</h3>
                            <span class="text-xs font-mono font-bold px-2 py-0.5 rounded bg-emerald-100 text-[#084C27]">Putra &amp; Putri</span>
                        </div>
                        <div class="space-y-3 text-xs text-[#18181B]">
                            <p class="text-[#4B6358] leading-relaxed">
                                Seluruh santri membawa perlengkapan makan, mandi, serta alat mencuci sendiri untuk memelihara kemandirian dan kebersihan diri:
                            </p>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Piring makan &amp; sendok pribadi</span></li>
                                <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Gelas / Botol minum</span></li>
                                <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Gayung &amp; Ember untuk mandi / mencuci</span></li>
                                <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Hanger gantungan pakaian</span></li>
                                <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Alat Mandi (disarankan sabun cair &amp; sikat gigi)</span></li>
                                <li class="flex items-start gap-2.5"><span class="text-[#059669] font-bold">&check;</span><span>Alat mencuci pakaian &amp; mencuci piring (sabun cuci, sikat pakaian, spons)</span></li>
                            </ul>
                            <div class="p-3 bg-amber-50 rounded border border-amber-200 text-[11px] text-amber-900 leading-relaxed mt-2">
                                <strong>Pemberitahuan:</strong> Pesantren tidak menyediakan jasa laundry. Santri mencuci pakaian secara mandiri dengan bimbingan musyrif/musyrifah.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 3: FORMULIR PENDAFTARAN ONLINE (LIVEWIRE WIZARD) -->
    <section id="formulir-pendaftaran" class="py-10 md:py-16 bg-[#FAF8F5] scroll-mt-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 md:space-y-10">

            @if(!$activeWave)
                <!-- CLOSED ADMISSION STATE -->
                <div class="bg-white p-8 md:p-14 border border-[#E5E0D8] rounded-md text-center space-y-6">
                    <div class="w-16 h-16 mx-auto border border-[#B89758] rounded-md bg-[#FAF8F5] text-[#B89758] flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div class="space-y-2">
                        <span class="editorial-label text-[#B89758]">STATUS PENDAFTARAN</span>
                        <h2 class="font-sans text-2xl md:text-3xl font-bold text-[#0D3B2E]">Pendaftaran Santri Baru Sedang Ditutup</h2>
                        <p class="text-xs sm:text-sm text-[#4B6358] max-w-xl mx-auto leading-relaxed">
                            Saat ini belum ada gelombang pendaftaran yang aktif. Silakan pantau pengumuman resmi berkala atau hubungi panitia melalui kontak WhatsApp untuk informasi gelombang berikutnya.
                        </p>
                    </div>
                    <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-2.5 rounded-md border border-[#E5E0D8] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider hover:border-[#0D3B2E] bg-white transition">
                            Kembali ke Beranda
                        </a>
                        @php
                            $waNum = \App\Models\SiteSetting::get('psb_whatsapp_number', '0896-5332-4339');
                        @endphp
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string)$waNum) }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-6 py-2.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition">
                            Hubungi Panitia PSB
                        </a>
                    </div>
                </div>
            @else
                <!-- ACTIVE REGISTRATION HEADER -->
                <div class="text-center space-y-3">
                    <div class="flex items-center justify-center gap-3">
                        <span class="editorial-label">FORMULIR PENDAFTARAN RESMI</span>
                        <span class="w-8 h-px bg-[#B89758]"></span>
                        <span class="text-xs font-mono text-[#059669] uppercase font-semibold">T.A {{ $activeWave->academic_year }}</span>
                    </div>
                    <h2 class="font-sans text-3xl sm:text-4xl font-bold text-[#0D3B2E] tracking-tight leading-tight">
                        Formulir Registrasi Santri Baru (Online)
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        {{ $activeWave->name }} &bull; Periode: {{ $activeWave->start_date?->translatedFormat('d F Y') }} s/d {{ $activeWave->end_date?->translatedFormat('d F Y') }}
                    </p>
                </div>

                <!-- REACTIVE MULTI-STEP REGISTRATION WIZARD -->
                <livewire:public.psb-registration :selected-program="$selectedProgram" />
            @endif

        </div>
    </section>

    <!-- IMAGE PREVIEW / LIGHTBOX MODAL -->
    <div x-show="showModal" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4 sm:p-6"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.self="closeModal()">
        
        <div class="relative bg-white rounded-lg overflow-hidden max-w-4xl w-full max-h-[90vh] flex flex-col shadow-2xl border border-white/20"
             @click.stop>
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-5 py-3.5 bg-[#FAF8F5] border-b border-[#E5E0D8]">
                <h3 class="font-sans font-bold text-sm sm:text-base text-[#0D3B2E]" x-text="modalTitle"></h3>
                <button type="button" @click="closeModal()" class="p-1.5 rounded-md hover:bg-gray-200 text-gray-600 transition" aria-label="Tutup">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Modal Body (Scrollable Image) -->
            <div class="overflow-auto p-4 flex items-center justify-center bg-[#18181B]/5">
                <img :src="modalImage" :alt="modalTitle" class="max-h-[72vh] w-auto max-w-full object-contain rounded shadow-xs">
            </div>

            <!-- Modal Footer -->
            <div class="px-5 py-3 bg-[#FAF8F5] border-t border-[#E5E0D8] flex items-center justify-between text-xs">
                <span class="text-[#4B6358]">Dokumen Resmi PSB PPMTQ DAAR EL TAZKIYAH SUMARDI</span>
                <a :href="modalImage" download class="inline-flex items-center gap-1.5 px-4 py-2 rounded-md bg-[#0D3B2E] text-white font-semibold hover:bg-[#059669] transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>Unduh Brosur</span>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection