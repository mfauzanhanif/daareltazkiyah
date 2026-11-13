@extends('layouts.public', ['title' => 'Rincian Biaya Pendidikan PSB - DAAR EL TAZKIYAH SUMARDI'])

@section('content')
    <div x-data="{
        biayaTab: 'mts'
    }">

        <!-- SECTION 1: HERO BANNER -->
        <section class="relative bg-cover bg-center overflow-hidden py-16 md:py-24 border-b border-[#B89758]/30"
            style="background-image: url('{{ asset('images/foto-santri-1.webp') }}');">
            <div class="absolute inset-0 bg-gradient-to-t from-[#042816] via-[#084C27]/90 to-[#042816]/85"></div>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
                <h1
                    class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.2]">
                    Rincian Biaya
                </h1>

                <p class="text-base sm:text-lg md:text-xl text-emerald-100/90 max-w-3xl mx-auto leading-relaxed">
                    Informasi resmi, transparan, dan terperinci mengenai biaya pendidikan MTs (Mukim) dan MDTA (Non-Mukim)
                    di Pondok Pesantren Modern Tahfidzul Qur'an Daar El Tazkiyah Sumardi.
                </p>

            </div>
        </section>

        <!-- SECTION 2: RINGKASAN BIAYA MTS & MDTA -->
        <section class="py-12 md:py-16 bg-white border-b border-[#E5E0D8]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                <div class="text-center max-w-3xl mx-auto space-y-2">
                    <div class="flex items-center justify-center gap-3 sm:gap-4">
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                        <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                            RINGKASAN BIAYA AWAL MASUK
                        </h2>
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                    </div>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Dua program pendidikan dengan kurikulum terpadu dan biaya yang sangat terjangkau bagi umat.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto items-stretch">
                    <!-- Card 1: MTs Mukim -->
                    <div
                        class="bg-[#FAF8F5] border-2 border-emerald-700/20 rounded-2xl p-6 sm:p-8 flex flex-col justify-between space-y-6 hover:border-[#0D3B2E] hover:shadow-md transition">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                                <span
                                    class="px-3 py-1 rounded-full bg-[#0D3B2E] text-white text-[11px] font-bold uppercase tracking-wider">
                                    MTs (Mukim 24 Jam)
                                </span>
                            </div>
                            <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">Madrasah Tsanawiyah</h3>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Setingkat SMP terpadu asrama mukim 24 jam dengan bimbingan intensif 30 juz Al-Qur'an, kajian
                                kitab kuning, dan makan 3x sehari.
                            </p>

                            <div class="grid grid-cols-2 gap-3 text-center">
                                <div class="p-3 bg-white border border-[#E5E0D8] rounded-xl">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#4B6358] block">Santri
                                        Putra</span>
                                    <strong class="text-lg sm:text-xl font-extrabold text-[#0D3B2E] block">Rp
                                        3.250.000</strong>
                                </div>
                                <div class="p-3 bg-white border border-[#E5E0D8] rounded-xl">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#4B6358] block">Santri
                                        Putri</span>
                                    <strong class="text-lg sm:text-xl font-extrabold text-[#0D3B2E] block">Rp
                                        3.350.000</strong>
                                </div>
                            </div>

                            <ul class="text-xs space-y-2 text-[#18181B] pt-2">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#059669] shrink-0"></span>
                                    <span>Iuran Bulanan (Makan 3x/hari): <strong>Rp 500.000/bln</strong></span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#059669] shrink-0"></span>
                                    <span>Kasur santri menjadi hak milik santri setelah lulus</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#059669] shrink-0"></span>
                                    <span>Ijazah formal Kementerian Agama RI (Kemenag)</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-4 border-t border-[#E5E0D8]">
                            <button type="button" @click="biayaTab = 'mts'"
                                class="w-full py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-bold uppercase tracking-wider transition shadow-xs cursor-pointer">
                                Lihat Rincian Tabel MTs &darr;
                            </button>
                        </div>
                    </div>

                    <!-- Card 2: MDTA Non-Mukim -->
                    <div
                        class="bg-[#FAF8F5] border-2 border-amber-600/20 rounded-2xl p-6 sm:p-8 flex flex-col justify-between space-y-6 hover:border-amber-600 hover:shadow-md transition">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-3">
                                <span
                                    class="px-3 py-1 rounded-full bg-amber-600 text-white text-[11px] font-bold uppercase tracking-wider">
                                    MDTA (Non-Mukim)
                                </span>
                            </div>
                            <h3 class="font-sans font-extrabold text-2xl text-[#0D3B2E]">Madrasah Diniyah</h3>
                            <p class="text-xs text-[#4B6358] leading-relaxed">
                                Sekolah sore hari ba'da Ashar (Senin s/d Kamis) untuk anak usia SD/MI dengan fokus
                                dasar-dasar Agama Islam dan Tahfidz Juz 30.
                            </p>

                            <div class="p-3 bg-white border border-[#E5E0D8] rounded-xl text-center">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[#4B6358] block">Total
                                    Biaya Masuk Awal</span>
                                <strong class="text-2xl sm:text-3xl font-extrabold text-[#0D3B2E] block">Rp 52.000</strong>
                            </div>

                            <ul class="text-xs space-y-2 text-[#18181B] pt-2">
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600 shrink-0"></span>
                                    <span>Infaq Shodaqoh Bulanan: <strong>Rp 12.000/bln</strong></span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600 shrink-0"></span>
                                    <span>Biaya Rapor untuk masa belajar 4 Tahun: <strong>Rp 20.000</strong></span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600 shrink-0"></span>
                                    <span>Kartu Santri Tahunan: <strong>Rp 5.000/thn</strong></span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-4 border-t border-[#E5E0D8]">
                            <button type="button" @click="biayaTab = 'mdta'"
                                class="w-full py-3 rounded-md bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold uppercase tracking-wider transition shadow-xs cursor-pointer">
                                Lihat Rincian Tabel MDTA &darr;
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 3: TABEL RINCIAN BIAYA (2 TAB: MTS & MDTA) -->
        <section id="tabel-rincian" class="py-12 md:py-16 bg-[#FAF8F5] border-b border-[#E5E0D8] scroll-mt-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                <div class="text-center max-w-3xl mx-auto space-y-2">
                    <div class="flex items-center justify-center gap-3 sm:gap-4">
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                        <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                            TABEL RINCIAN BIAYA
                        </h2>
                        <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
                    </div>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Pilih tab di bawah ini untuk melihat rincian per komponen biaya.
                    </p>
                </div>

                <!-- Tab Switcher -->
                <div class="flex justify-center">
                    <div
                        class="inline-flex p-1.5 bg-white border border-[#E5E0D8] rounded-xl text-xs sm:text-sm font-semibold shadow-2xs">
                        <button type="button" @click="biayaTab = 'mts'" class="px-6 py-2.5 rounded-lg transition"
                            :class="biayaTab === 'mts' ? 'bg-[#0D3B2E] text-white shadow-xs font-bold' :
                                'text-[#4B6358] hover:text-[#0D3B2E]'">
                            Rincian MTs (Mukim)
                        </button>
                        <button type="button" @click="biayaTab = 'mdta'" class="px-6 py-2.5 rounded-lg transition"
                            :class="biayaTab === 'mdta' ? 'bg-[#0D3B2E] text-white shadow-xs font-bold' :
                                'text-[#4B6358] hover:text-[#0D3B2E]'">
                            Rincian MDTA (Non-Mukim)
                        </button>
                    </div>
                </div>

                <!-- Tab Content: MTs (Mukim) -->
                <div x-show="biayaTab === 'mts'" x-transition class="space-y-6 max-w-5xl mx-auto">
                    <div class="bg-white border border-[#E5E0D8] rounded-2xl overflow-hidden shadow-xs">
                        <div
                            class="p-6 bg-[#FAF8F5] border-b border-[#E5E0D8] flex flex-wrap items-center justify-between gap-3">
                            <div>
                                <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Rincian Biaya MTs (Madrasah
                                    Tsanawiyah - Mukim)</h3>
                                <p class="text-xs text-[#4B6358] mt-0.5">Estimasi biaya masuk awal untuk santri putra dan
                                    santri putri.</p>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-emerald-100 text-[#084C27] text-xs font-bold">12
                                Komponen Biaya</span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead>
                                    <tr class="bg-[#FAF8F5] border-b border-[#E5E0D8] text-[#0D3B2E]">
                                        <th class="py-3.5 px-4 font-bold text-center w-12">No</th>
                                        <th class="py-3.5 px-4 font-bold">Rincian Biaya</th>
                                        <th class="py-3.5 px-4 font-bold">Ketentuan</th>
                                        <th class="py-3.5 px-4 font-bold text-right">Biaya (Laki-laki)</th>
                                        <th class="py-3.5 px-4 font-bold text-right">Biaya (Perempuan)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#E5E0D8]">
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">1</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Biaya Pendaftaran</td>
                                        <td class="py-3 px-4 text-[#4B6358]">Sekali</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp {{ $feeMts }}</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp {{ $feeMts }}</td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">2</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Uang Ujian</td>
                                        <td class="py-3 px-4 text-[#4B6358]">Pertahun</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 200.000</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 200.000</td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">3</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Seragam Olahraga</td>
                                        <td class="py-3 px-4 text-[#4B6358]">1 Set</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 150.000</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 150.000</td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">4</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Baju Muslim</td>
                                        <td class="py-3 px-4 text-[#4B6358]">1 Set</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 150.000</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 150.000</td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">5</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Sewa Lemari</td>
                                        <td class="py-3 px-4 text-[#4B6358]">Setahun</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 150.000</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 150.000</td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">6</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Beli Kasur</td>
                                        <td class="py-3 px-4 text-[#4B6358]">1 Kali</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 200.000</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 200.000</td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">7</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Iuran Bulanan (Makan 3x/hari)
                                        </td>
                                        <td class="py-3 px-4 text-[#4B6358]">Perbulan</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 500.000</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 500.000</td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">8</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Kitab dan Buku Pelajaran</td>
                                        <td class="py-3 px-4 text-[#4B6358]">Pertahun</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 1.000.000</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 1.000.000</td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">9</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Organisasi</td>
                                        <td class="py-3 px-4 text-[#4B6358]">Pertahun</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 100.000</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 100.000</td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">10</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Ekstrakurikuler</td>
                                        <td class="py-3 px-4 text-[#4B6358]">Pertahun</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 200.000</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 200.000</td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">11</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Wakaf Pembangunan</td>
                                        <td class="py-3 px-4 text-[#4B6358]">1 Kali</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 500.000</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 500.000</td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">12</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Kerudung Hitam dan Putih</td>
                                        <td class="py-3 px-4 text-[#4B6358]">1 Set</td>
                                        <td class="py-3 px-4 text-right text-gray-400 font-mono">-</td>
                                        <td class="py-3 px-4 text-right font-mono">Rp 100.000</td>
                                    </tr>
                                    <tr class="bg-emerald-50/60 font-bold border-t-2 border-[#0D3B2E]">
                                        <td colspan="3"
                                            class="py-4 px-4 text-right uppercase text-[#0D3B2E] text-xs sm:text-sm font-extrabold">
                                            Total Biaya Masuk Awal:</td>
                                        <td
                                            class="py-4 px-4 text-right text-sm sm:text-base text-[#0D3B2E] font-mono font-extrabold">
                                            Rp 3.250.000</td>
                                        <td
                                            class="py-4 px-4 text-right text-sm sm:text-base text-[#0D3B2E] font-mono font-extrabold">
                                            Rp 3.350.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="text-xs text-[#4B6358] bg-white p-4 rounded-xl border border-[#E5E0D8] space-y-1">
                        <p><strong>Catatan Tambahan:</strong></p>
                        <p>&bull; Biaya kasur (Rp 200.000) adalah pembelian 1 kali, dan kasur menjadi hak milik santri
                            setelah menyelesaikan pendidikan.</p>
                        <p>&bull; Biaya masuk awal dapat diangsur dengan skema kesepakatan bersama bendahara pesantren saat
                            daftar ulang.</p>
                    </div>
                </div>

                <!-- Tab Content: MDTA (Non-Mukim) -->
                <div x-show="biayaTab === 'mdta'" x-cloak x-transition class="space-y-6 max-w-4xl mx-auto">
                    <div class="bg-white border border-[#E5E0D8] rounded-2xl overflow-hidden shadow-xs">
                        <div
                            class="p-6 bg-[#FAF8F5] border-b border-[#E5E0D8] flex flex-wrap items-center justify-between gap-3">
                            <div>
                                <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Rincian Biaya MDTA (Madrasah Diniyah
                                    - Non-Mukim)</h3>
                                <p class="text-xs text-[#4B6358] mt-0.5">Biaya pendaftaran dan administrasi santri sore
                                    MDTA.</p>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-900 text-xs font-bold">4 Komponen
                                Biaya</span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead>
                                    <tr class="bg-[#FAF8F5] border-b border-[#E5E0D8] text-[#0D3B2E]">
                                        <th class="py-3.5 px-4 font-bold text-center w-12">No</th>
                                        <th class="py-3.5 px-4 font-bold">Rincian Biaya</th>
                                        <th class="py-3.5 px-4 font-bold">Keterangan</th>
                                        <th class="py-3.5 px-4 font-bold text-right">Biaya</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#E5E0D8]">
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">1</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Biaya Pendaftaran</td>
                                        <td class="py-3 px-4 text-[#4B6358]">Sekali</td>
                                        <td class="py-3 px-4 text-right font-mono font-semibold">Rp {{ $feeMdta }}
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">2</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Infaq Shodaqoh</td>
                                        <td class="py-3 px-4 text-[#4B6358]">Perbulan</td>
                                        <td class="py-3 px-4 text-right font-mono font-semibold">Rp 12.000</td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">3</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Biaya Rapor (4 Tahun)</td>
                                        <td class="py-3 px-4 text-[#4B6358]">Sekali</td>
                                        <td class="py-3 px-4 text-right font-mono font-semibold">Rp 20.000</td>
                                    </tr>
                                    <tr class="hover:bg-[#FAF8F5]/60 transition">
                                        <td class="py-3 px-4 font-mono text-center">4</td>
                                        <td class="py-3 px-4 font-semibold text-[#0D3B2E]">Kartu Santri Tahunan</td>
                                        <td class="py-3 px-4 text-[#4B6358]">Pertahun</td>
                                        <td class="py-3 px-4 text-right font-mono font-semibold">Rp 5.000</td>
                                    </tr>
                                    <tr class="bg-amber-50/60 font-bold border-t-2 border-amber-600">
                                        <td colspan="3"
                                            class="py-4 px-4 text-right uppercase text-[#0D3B2E] text-xs sm:text-sm font-extrabold">
                                            Total Biaya Masuk Awal:</td>
                                        <td
                                            class="py-4 px-4 text-right text-base sm:text-lg text-[#0D3B2E] font-mono font-extrabold">
                                            Rp 52.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 4: KEBIJAKAN PEMBAYARAN & REKENING RESMI -->
        <section class="py-12 md:py-16 bg-white border-b border-[#E5E0D8]">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                <div class="text-center max-w-2xl mx-auto space-y-2">
                    <h2 class="font-sans text-2xl sm:text-3xl font-extrabold text-[#0D3B2E]">
                        Rekening Resmi
                    </h2>
                    <p class="text-xs sm:text-sm text-[#4B6358]">
                        Informasi rekening resmi pondok pesantren serta panduan tata cara pembayaran infaq pendaftaran.
                    </p>
                </div>

                <!-- Rekening Card -->
                @php
                    $bankName = \App\Models\SiteSetting::get('bank_name', 'Bank Syariah Indonesia (BSI)');
                    $bankNumber = \App\Models\SiteSetting::get('bank_account_number', '7366764695');
                    $bankHolder = \App\Models\SiteSetting::get('bank_account_name', 'Yayasan Daar El Tazkiyah Sumardi');
                @endphp
                <div
                    class="bg-gradient-to-br from-[#0D3B2E] to-[#084C27] text-white p-6 sm:p-8 rounded-2xl shadow-md space-y-4">
                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/20 pb-4">
                        <div>
                            <span class="text-xs font-mono uppercase tracking-wider text-emerald-200">Rekening Resmi
                                Pesantren</span>
                            <h3 class="font-sans text-xl sm:text-2xl font-extrabold mt-0.5">{{ $bankName }}</h3>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="space-y-1">
                            <span class="text-xs text-emerald-200">Nomor Rekening:</span>
                            <div class="font-mono text-2xl font-bold tracking-wider text-amber-300">
                                {{ $bankNumber }}
                            </div>
                        </div>
                        <div class="space-y-1">
                            <span class="text-xs text-emerald-200">Atas Nama Rekening:</span>
                            <div class="font-sans text-lg font-bold text-white">
                                {{ $bankHolder }}
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-emerald-100/80 pt-2 border-t border-white/10">
                        Pastikan hanya mentransfer ke rekening resmi atas nama {{ $bankHolder }}. Simpan
                        bukti transfer untuk diunggah pada formulir atau dikonfirmasikan ke panitia PSB.
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="text-center pt-4 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('psb.form') }}"
                        class="px-8 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs sm:text-sm font-bold uppercase tracking-wider transition shadow-xs">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('psb.perlengkapan') }}"
                        class="px-6 py-3.5 rounded-md border border-[#0D3B2E] bg-white text-[#0D3B2E] hover:bg-[#0D3B2E] hover:text-white text-xs sm:text-sm font-semibold uppercase tracking-wider transition">
                        Perlengkapan Santri Baru
                    </a>
                    @php
                        $waNum = \App\Models\SiteSetting::get('school_phone', '0896-5332-4339');
                    @endphp
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waNum) }}?text=Halo%20Bendahara%20PSB%20Daar%20El%20Tazkiyah,%20saya%20ingin%20konsultasi%20mengenai%20rincian%20biaya."
                        target="_blank" rel="noopener noreferrer"
                        class="px-6 py-3.5 rounded-md border border-[#E5E0D8] bg-[#FAF8F5] text-[#0D3B2E] hover:border-[#0D3B2E] text-xs sm:text-sm font-semibold uppercase tracking-wider transition">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </section>

    </div>
@endsection
