@extends('layouts.public', ['title' => 'Kontak & Lokasi Pesantren - PPMTQ Daar El Tazkiyah Sumardi'])

@section('content')
    <!-- Page Header (Editorial Academic Banner with Santri Photo Background) -->
    <section class="relative bg-cover bg-center overflow-hidden py-16 md:py-24 border-b border-[#B89758]/30"
             style="background-image: url('{{ asset('images/foto-santri-2.webp') }}');">
        <!-- Dark Forest Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#042816] via-[#084C27]/90 to-[#042816]/85"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
            <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.2]">
                Kontak & Lokasi PPMTQ Daar El Tazkiyah Sumardi
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-emerald-100/90 max-w-3xl mx-auto leading-relaxed">
                Kami menyambut hangat kunjungan silaturahmi, konsultasi pendaftaran santri baru, dan informasi seputar kepesantrenan di Kabupaten Serang, Banten.
            </p>
        </div>
    </section>

    <!-- Main Content Grid -->
    <section class="py-10 md:py-16 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Left Column: Secretariat, Dual Hotlines, & Reservation Form -->
                <div class="lg:col-span-5 space-y-8">

                    <!-- Secretariat & Address Card -->
                    <div class="bg-white border border-[#E5E0D8] rounded-md p-8 space-y-6 shadow-xs">
                        <div class="space-y-1 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label text-[#059669]">KANTOR SEKRETARIAT</span>
                            <h2 class="font-sans text-xl font-bold text-[#0D3B2E]">
                                PPMTQ Daar El Tazkiyah Sumardi
                            </h2>
                            <p class="text-xs text-[#4B6358] font-medium">
                                Kecamatan Petir, Kabupaten Serang, Provinsi Banten
                            </p>
                        </div>

                        <div class="space-y-4 text-xs text-[#18181B]">
                            <!-- Alamat Lengkap -->
                            <div class="space-y-1">
                                <strong class="text-[#0D3B2E] block uppercase tracking-wider">Alamat Lengkap:</strong>
                                <p class="text-[#4B6358] leading-relaxed">
                                    {{ $siteAddress }}
                                </p>
                            </div>

                            <!-- Dual Hotline WhatsApp -->
                            <div class="space-y-2 pt-2 border-t border-[#E5E0D8]">
                                <strong class="text-[#0D3B2E] block uppercase tracking-wider">Nomor Telepon & WhatsApp:</strong>
                                <div class="grid grid-cols-1 gap-2 pt-1">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waNumber) }}" target="_blank" rel="noopener noreferrer"
                                        class="p-3 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] hover:border-[#0D3B2E] flex items-center justify-between group transition">
                                        <div>
                                            <span class="text-[10px] text-[#059669] font-bold block uppercase">Pendaftaran MTs / SMP:</span>
                                            <span class="font-mono text-sm font-bold text-[#0D3B2E]">{{ $waNumber }}</span>
                                        </div>
                                        <span class="text-xs text-[#059669] group-hover:translate-x-1 transition-transform">&rarr;</span>
                                    </a>

                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waMdtaNumber) }}" target="_blank" rel="noopener noreferrer"
                                        class="p-3 rounded-md bg-[#FAF8F5] border border-[#E5E0D8] hover:border-[#0D3B2E] flex items-center justify-between group transition">
                                        <div>
                                            <span class="text-[10px] text-[#B89758] font-bold block uppercase">Pendaftaran MDTA Sore:</span>
                                            <span class="font-mono text-sm font-bold text-[#0D3B2E]">{{ $waMdtaNumber }}</span>
                                        </div>
                                        <span class="text-xs text-[#B89758] group-hover:translate-x-1 transition-transform">&rarr;</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Email & Website -->
                            <div class="space-y-1 pt-2 border-t border-[#E5E0D8]">
                                <strong class="text-[#0D3B2E] block uppercase tracking-wider">Email & Website Resmi:</strong>
                                <p class="text-[#4B6358] font-mono">{{ $siteEmail }}</p>
                                <p class="text-[#4B6358] font-mono">www.daareltazkiyahsumardi.ponpes.id</p>
                            </div>

                            <!-- Jam Pelayanan -->
                            <div class="space-y-1 pt-2 border-t border-[#E5E0D8]">
                                <strong class="text-[#0D3B2E] block uppercase tracking-wider">Jam Pelayanan Tamu:</strong>
                                <p class="text-[#4B6358] leading-relaxed">
                                    Senin – Sabtu: 08.00 – 16.30 WIB<br>
                                    Ahad / Libur: Dengan Konfirmasi WhatsApp Terlebih Dahulu
                                </p>
                            </div>
                        </div>

                        <!-- CTA WhatsApp Langsung -->
                        <div class="pt-2">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waNumber) }}?text={{ urlencode('Assalamu\'alaikum Panitia PPMTQ Daar El Tazkiyah Sumardi, saya ingin bertanya seputar pendaftaran santri baru.') }}"
                                target="_blank" rel="noopener noreferrer"
                                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-bold text-xs uppercase tracking-wider transition shadow-xs">
                                <span>Hubungi Panitia via WhatsApp ({{ $waNumber }})</span>
                            </a>
                        </div>
                    </div>

                    <!-- Campus Visit Reservation Form -->
                    <div class="bg-white border border-[#E5E0D8] rounded-md p-8 space-y-6 shadow-xs">
                        <div class="space-y-1 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label text-[#B89758]">JADWALKAN KUNJUNGAN</span>
                            <h3 class="font-sans text-lg font-bold text-[#0D3B2E]">
                                Formulir Reservasi Silaturahmi
                            </h3>
                            <p class="text-xs text-[#4B6358]">
                                Isi formulir berikut untuk menjadwalkan kunjungan silaturahmi langsung dengan pengasuh atau panitia di pesantren.
                            </p>
                        </div>

                        <form action="{{ route('contact.consultation') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="parent_name" class="block text-xs font-semibold text-[#0D3B2E] uppercase tracking-wider mb-1">
                                    Nama Lengkap Calon Wali *
                                </label>
                                <input type="text" name="parent_name" id="parent_name" required value="{{ old('parent_name') }}" placeholder="Contoh: Bapak H. Ahmad" class="w-full px-3.5 py-2.5 text-xs rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] focus:outline-none bg-[#FAF8F5]">
                                @error('parent_name')
                                    <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-semibold text-[#0D3B2E] uppercase tracking-wider mb-1">
                                    No. WhatsApp Aktif *
                                </label>
                                <input type="text" name="phone" id="phone" required value="{{ old('phone') }}" placeholder="Contoh: 081234567890" class="w-full px-3.5 py-2.5 text-xs rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] focus:outline-none bg-[#FAF8F5]">
                                @error('phone')
                                    <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="program_interest" class="block text-xs font-semibold text-[#0D3B2E] uppercase tracking-wider mb-1">
                                        Pilihan Program *
                                    </label>
                                    <select name="program_interest" id="program_interest" required class="w-full px-3.5 py-2.5 text-xs rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] focus:outline-none bg-[#FAF8F5]">
                                        <option value="MTS">MTS Mukim 24 Jam</option>
                                        <option value="MDTA">MDTA Sekolah Sore</option>
                                        <option value="UMUM">Konsultasi Umum</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="visit_date" class="block text-xs font-semibold text-[#0D3B2E] uppercase tracking-wider mb-1">
                                        Rencana Tanggal
                                    </label>
                                    <input type="date" name="visit_date" id="visit_date" value="{{ old('visit_date') }}" class="w-full px-3.5 py-2.5 text-xs rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] focus:outline-none bg-[#FAF8F5]">
                                </div>
                            </div>

                            <div>
                                <label for="notes" class="block text-xs font-semibold text-[#0D3B2E] uppercase tracking-wider mb-1">
                                    Catatan Pertanyaan
                                </label>
                                <textarea name="notes" id="notes" rows="3" placeholder="Informasi pertanyaan awal atau jumlah rombongan keluarga..." class="w-full px-3.5 py-2.5 text-xs rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] focus:outline-none bg-[#FAF8F5]">{{ old('notes') }}</textarea>
                            </div>

                            <button type="submit" class="w-full py-3.5 rounded-md bg-[#B89758] hover:bg-[#96783e] text-white font-bold text-xs tracking-wider uppercase transition shadow-xs">
                                Kirim Reservasi Silaturahmi &rarr;
                            </button>
                        </form>
                    </div>

                </div>

                <!-- Right Column: Interactive Google Map & Social Media Showcase -->
                <div class="lg:col-span-7 space-y-8">
                    <!-- Google Map Embed Container -->
                    <div class="bg-white border border-[#E5E0D8] rounded-md p-3 space-y-3 shadow-xs">
                        <div class="h-96 lg:h-[420px] w-full border border-[#E5E0D8] rounded-md overflow-hidden bg-gray-100">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15865.578647895476!2d106.2163931!3d-6.2081547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e423d24e1011867%3A0x6b2e3895e7b514ab!2sMekarbaru%2C%20Kec.%20Petir%2C%20Kabupaten%20Serang%2C%20Banten!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" title="Peta Lokasi PPMTQ Daar El Tazkiyah Sumardi Petir Serang Banten">
                            </iframe>
                        </div>
                        <div class="p-3 text-xs text-[#4B6358] flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                            <span>Koordinat: Kp. Lembur Sawah, Desa Mekarbaru, Kec. Petir, Kab. Serang, Banten</span>
                            <a href="https://maps.google.com/?q=Mekarbaru+Petir+Serang+Banten" target="_blank" rel="noopener noreferrer" class="text-[#0D3B2E] font-bold hover:underline">
                                Buka di Google Maps &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- Social Media Showcase -->
                    <div class="bg-white border border-[#E5E0D8] rounded-md p-8 space-y-6 shadow-xs">
                        <div class="border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label text-[#059669]">JARINGAN MEDIA</span>
                            <h3 class="font-sans font-bold text-xl text-[#0D3B2E] mt-1">
                                Media Sosial Resmi: @media_daareltazkiyah_sumardi
                            </h3>
                            <p class="text-xs text-[#4B6358] mt-1">
                                Dapatkan update dokumentasi kegiatan, siaran langsung pengajian, dan informasi penerimaan santri.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <!-- Instagram -->
                            <a href="https://www.instagram.com/media_daareltazkiyah_sumardi" target="_blank" rel="noopener noreferrer"
                                class="p-4 rounded-md border border-[#E5E0D8] bg-[#FAF8F5] hover:border-[#0D3B2E] hover:bg-white transition flex items-center gap-3 group">
                                <div class="w-10 h-10 rounded-full bg-pink-50 border border-pink-200 flex items-center justify-center text-pink-600 group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                </div>
                                <div>
                                    <span class="font-sans font-bold text-xs text-[#0D3B2E] block">Instagram</span>
                                    <span class="text-[10px] text-[#4B6358] font-mono">@media_daareltazkiyah_sumardi</span>
                                </div>
                            </a>

                            <!-- TikTok -->
                            <a href="https://www.tiktok.com/@media.daareltazki" target="_blank" rel="noopener noreferrer"
                                class="p-4 rounded-md border border-[#E5E0D8] bg-[#FAF8F5] hover:border-[#0D3B2E] hover:bg-white transition flex items-center gap-3 group">
                                <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-300 flex items-center justify-center text-slate-800 group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.16 1.18 2.09 2.35 2.27.7.13 1.43.05 2.09-.22.95-.39 1.64-1.24 1.84-2.24.11-.6.13-1.21.13-1.82.01-4.28 0-8.56 0-12.84z"/></svg>
                                </div>
                                <div>
                                    <span class="font-sans font-bold text-xs text-[#0D3B2E] block">TikTok</span>
                                    <span class="text-[10px] text-[#4B6358] font-mono">@media.daareltazki</span>
                                </div>
                            </a>

                            <!-- Facebook -->
                            <a href="https://www.facebook.com/Daar-El-tazkiyah-Sumardi-61595393704791" target="_blank" rel="noopener noreferrer"
                                class="p-4 rounded-md border border-[#E5E0D8] bg-[#FAF8F5] hover:border-[#0D3B2E] hover:bg-white transition flex items-center gap-3 group">
                                <div class="w-10 h-10 rounded-full bg-blue-50 border border-blue-200 flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </div>
                                <div>
                                    <span class="font-sans font-bold text-xs text-[#0D3B2E] block">Facebook</span>
                                    <span class="text-[10px] text-[#4B6358] font-mono">Daar-El-tazkiyah-Sumardi</span>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
