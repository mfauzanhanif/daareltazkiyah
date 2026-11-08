@extends('layouts.public', ['title' => 'Kontak & Lokasi Kampus - PPMTQ Daar El Tazkiyah Sumardi'])

@section('content')
    <!-- Page Header (Editorial Academic Banner) -->
    <section class="bg-white border-b border-[#E5E0D8] pt-12 pb-14 md:pt-16 md:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <div class="flex items-center gap-3">
                    <span class="editorial-label">05 — LOKASI & SILATURAHMI</span>
                    <span class="w-8 h-px bg-[#B89758]"></span>
                    <span class="text-xs font-mono text-[#4B6358] uppercase tracking-wider">Sekretariat Pondok</span>
                </div>
                <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-[#0D3B2E] tracking-tight leading-[1.15]">
                    Kunjungi Kampus Kami di Ciampea, Bogor
                </h1>
                <p class="text-base sm:text-lg text-[#4B6358] leading-relaxed">
                    Kami menyambut hangat kunjungan silaturahmi calon wali santri, muhsinin, dan tamu pondok di kampus asri PPMTQ Daar El Tazkiyah Sumardi.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <section class="py-16 md:py-24 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                <!-- Left Column: Secretariat Info & Reservation Form -->
                <div class="lg:col-span-5 space-y-8">
                    
                    <!-- Secretariat Card -->
                    <div class="bg-white border border-[#E5E0D8] p-8 space-y-6">
                        <div class="space-y-1 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">KANTOR SEKRETARIAT</span>
                            <h2 class="font-serif text-xl font-bold text-[#0D3B2E]">
                                PPMTQ Daar El Tazkiyah Sumardi
                            </h2>
                            <p class="text-xs text-[#059669] font-medium">
                                Kampus Tahfidz Ciampea, Kabupaten Bogor
                            </p>
                        </div>

                        <div class="space-y-4 text-xs text-[#18181B]">
                            <div class="space-y-1">
                                <strong class="text-[#0D3B2E] block uppercase tracking-wider">Alamat Lengkap:</strong>
                                <p class="text-[#4B6358] leading-relaxed">{{ $siteAddress }}</p>
                            </div>

                            <div class="space-y-1 pt-2 border-t border-[#E5E0D8]">
                                <strong class="text-[#0D3B2E] block uppercase tracking-wider">Layanan Telepon & WhatsApp:</strong>
                                <p class="text-[#4B6358] font-mono text-sm">{{ $sitePhone }}</p>
                            </div>

                            <div class="space-y-1 pt-2 border-t border-[#E5E0D8]">
                                <strong class="text-[#0D3B2E] block uppercase tracking-wider">Email Resmi:</strong>
                                <p class="text-[#4B6358] font-mono">{{ $siteEmail }}</p>
                            </div>

                            <div class="space-y-1 pt-2 border-t border-[#E5E0D8]">
                                <strong class="text-[#0D3B2E] block uppercase tracking-wider">Jam Pelayanan Tamu:</strong>
                                <p class="text-[#4B6358] leading-relaxed">
                                    Senin – Sabtu: 08.00 – 16.30 WIB<br>
                                    Ahad / Hari Libur: Dengan Konfirmasi Terlebih Dahulu
                                </p>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waNumber) }}?text={{ urlencode('Assalamu\'alaikum Panitia PPMTQ Daar El Tazkiyah, saya ingin bertanya seputar pondok dan PSB.') }}" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs tracking-wider uppercase transition">
                                <span>Hubungi Panitia via WhatsApp ({{ $waNumber }})</span>
                            </a>
                        </div>
                    </div>

                    <!-- Campus Visit Reservation Form -->
                    <div class="bg-white border border-[#E5E0D8] p-8 space-y-6">
                        <div class="space-y-1 border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">JADWALKAN KUNJUNGAN</span>
                            <h3 class="font-serif text-lg font-bold text-[#0D3B2E]">
                                Formulir Reservasi Silaturahmi
                            </h3>
                            <p class="text-xs text-[#4B6358]">
                                Isi formulir singkat berikut untuk memastikan asatidz dan panitia menyambut Anda di kampus.
                            </p>
                        </div>

                        <form action="{{ route('contact.consultation') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="parent_name" class="block text-xs font-semibold text-[#0D3B2E] uppercase tracking-wider mb-1">
                                    Nama Lengkap Calon Wali *
                                </label>
                                <input type="text" name="parent_name" id="parent_name" required value="{{ old('parent_name') }}" placeholder="Contoh: Bapak H. Abdullah" class="w-full px-3.5 py-2.5 text-xs border border-[#E5E0D8] focus:border-[#0D3B2E] focus:outline-none bg-[#FAF8F5]">
                                @error('parent_name')
                                    <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-semibold text-[#0D3B2E] uppercase tracking-wider mb-1">
                                    No. WhatsApp Aktif *
                                </label>
                                <input type="text" name="phone" id="phone" required value="{{ old('phone') }}" placeholder="Contoh: 081234567890" class="w-full px-3.5 py-2.5 text-xs border border-[#E5E0D8] focus:border-[#0D3B2E] focus:outline-none bg-[#FAF8F5]">
                                @error('phone')
                                    <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="program_interest" class="block text-xs font-semibold text-[#0D3B2E] uppercase tracking-wider mb-1">
                                        Pilihan Program *
                                    </label>
                                    <select name="program_interest" id="program_interest" required class="w-full px-3.5 py-2.5 text-xs border border-[#E5E0D8] focus:border-[#0D3B2E] focus:outline-none bg-[#FAF8F5]">
                                        <option value="MTS">MTS Mukim 24 Jam</option>
                                        <option value="MDTA">MDTA Sekolah Sore</option>
                                        <option value="UMUM">Konsultasi Umum</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="visit_date" class="block text-xs font-semibold text-[#0D3B2E] uppercase tracking-wider mb-1">
                                        Rencana Tanggal
                                    </label>
                                    <input type="date" name="visit_date" id="visit_date" value="{{ old('visit_date') }}" class="w-full px-3.5 py-2.5 text-xs border border-[#E5E0D8] focus:border-[#0D3B2E] focus:outline-none bg-[#FAF8F5]">
                                </div>
                            </div>

                            <div>
                                <label for="notes" class="block text-xs font-semibold text-[#0D3B2E] uppercase tracking-wider mb-1">
                                    Catatan Tambahan
                                </label>
                                <textarea name="notes" id="notes" rows="3" placeholder="Informasi pertanyaan awal atau jumlah rombongan keluarga..." class="w-full px-3.5 py-2.5 text-xs border border-[#E5E0D8] focus:border-[#0D3B2E] focus:outline-none bg-[#FAF8F5]">{{ old('notes') }}</textarea>
                            </div>

                            <button type="submit" class="w-full py-3 bg-[#B89758] hover:bg-[#96783e] text-white font-semibold text-xs tracking-wider uppercase transition">
                                Kirim Konfirmasi Reservasi Silaturahmi &rarr;
                            </button>
                        </form>
                    </div>

                </div>

                <!-- Right Column: Interactive Google Map & Directions -->
                <div class="lg:col-span-7 space-y-8">
                    <!-- Google Map Embed Container -->
                    <div class="bg-white border border-[#E5E0D8] p-3 space-y-4">
                        <div class="h-96 lg:h-[480px] w-full border border-[#E5E0D8] overflow-hidden bg-gray-100">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15853.535091763717!2d106.6967727!3d-6.5991444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5e52c77df49%3A0xe54ef5aef2f128be!2sCihideung%20Udik%2C%20Kec.%20Ciampea%2C%20Kabupaten%20Bogor%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade" title="Peta Lokasi PPMTQ Daar El Tazkiyah Sumardi Ciampea Bogor">
                            </iframe>
                        </div>
                        <div class="p-3 text-xs text-[#4B6358] flex items-center justify-between">
                            <span>Koordinat: Cihideung Udik, Ciampea, Kab. Bogor 16620</span>
                            <a href="https://maps.google.com/?q=Cihideung+Udik+Ciampea+Bogor" target="_blank" rel="noopener noreferrer" class="text-[#0D3B2E] font-semibold hover:underline">
                                Buka di Google Maps &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- Directions & Transportation Guide -->
                    <div class="bg-white border border-[#E5E0D8] p-8 space-y-6">
                        <div class="border-b border-[#E5E0D8] pb-4">
                            <span class="editorial-label">PANDUAN RUTE</span>
                            <h3 class="font-serif text-xl font-bold text-[#0D3B2E] mt-1">
                                Petunjuk Transportasi Menuju Pesantren
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs text-[#18181B]">
                            <div class="p-4 border border-[#E5E0D8] bg-[#FAF8F5] space-y-2">
                                <strong class="text-[#0D3B2E] block font-semibold text-sm">Dari Arah Stasiun Kereta Api Bogor:</strong>
                                <p class="text-[#4B6358] leading-relaxed">
                                    Dari Stasiun Bogor, gunakan transportasi online atau angkutan kota ke arah Kampus IPB Dramaga / Terminal Laladon, kemudian lanjutkan ke arah Ciampea (Cibanteng Babengket / Cihideung Udik). Estimasi waktu tempuh 35-45 menit.
                                </p>
                            </div>

                            <div class="p-4 border border-[#E5E0D8] bg-[#FAF8F5] space-y-2">
                                <strong class="text-[#0D3B2E] block font-semibold text-sm">Dari Arah Tol Jagorawi / Sentul:</strong>
                                <p class="text-[#4B6358] leading-relaxed">
                                    Keluar Gerbang Tol BORR (Bogor Outer Ring Road), ambil arah Yasmin menuju Bubulak/Dramaga, ikuti Jalan Raya Dramaga - Ciampea hingga simpang Cibanteng. Lokasi kampus berada di lingkungan asri Cihideung Udik.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
