@extends('layouts.public')

@section('content')
    <!-- 1. HERO SECTION -->
    <x-public.hero :activeWave="$activeWave" />

    <!-- 2. VISI & MISI BENTO GRID SECTION -->
    <x-public.visi-misi />

    <!-- 3. PROGRAM COMPARISON & DYNAMIC FEE SYNC SECTION -->
    <x-public.program-card :activeWave="$activeWave" />

    <!-- 4. DEWAN ASATIDZ / TEACHERS SHOWCASE SECTION -->
    <section id="asatidz" class="py-20 md:py-28 bg-[#FDFBF7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                <span class="text-xs md:text-sm font-semibold uppercase tracking-wider text-[#059669]">Dewan Guru</span>
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-[#084C27]">Dewan Asatidz & Tenaga Pendidik</h2>
                <p class="text-sm md:text-base text-[#4B6358]">Dibimbing langsung oleh para pengajar berpengalaman, huffadz
                    30 juz Al-Qur'an bersanad, dan lulusan universitas Islam terkemuka.</p>
                <div class="w-16 h-1 bg-[#D97706] mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($teachers as $teacher)
                    <x-public.teacher-card :teacher="$teacher" />
                @empty
                    <div
                        class="col-span-full text-center py-12 text-[#4B6358] bg-white rounded-2xl border border-[#084C27]/10 p-8">
                        Belum ada data asatidz yang dipublikasikan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 5. LATEST NEWS PREVIEW WIDGET SECTION -->
    <section class="py-20 md:py-28 bg-white border-t border-[#084C27]/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div class="space-y-2">
                    <span class="text-xs md:text-sm font-semibold uppercase tracking-wider text-[#059669]">Kabar
                        Pondok</span>
                    <h2 class="font-serif text-3xl md:text-4xl font-bold text-[#084C27]">Warta & Berita Terkini</h2>
                    <p class="text-sm text-[#4B6358]">Informasi kegiatan santri, prestasi, kajian ilmiah, dan pengumuman
                        resmi pesantren.</p>
                </div>
                <a href="{{ route('news.index') }}"
                    class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#084C27] hover:text-[#059669] transition">
                    <span>Lihat Semua Berita</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latestPosts as $post)
                    <x-public.news-card :post="$post" />
                @empty
                    <div
                        class="col-span-full text-center py-12 text-[#4B6358] bg-[#FDFBF7] rounded-2xl border border-[#084C27]/10 p-8">
                        Belum ada warta berita yang dipublikasikan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 6. GALLERY PREVIEW GRID SECTION -->
    <section class="py-20 md:py-28 bg-[#FDFBF7] border-t border-[#084C27]/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div class="space-y-2">
                    <span
                        class="text-xs md:text-sm font-semibold uppercase tracking-wider text-[#059669]">Dokumentasi</span>
                    <h2 class="font-serif text-3xl md:text-4xl font-bold text-[#084C27]">Galeri Foto Kegiatan</h2>
                    <p class="text-sm text-[#4B6358]">Potret rutinitas hafalan Qur'an, belajar mengajar, dan ekstrakurikuler
                        santri.</p>
                </div>
                <a href="{{ route('gallery.index') }}"
                    class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#084C27] hover:text-[#059669] transition">
                    <span>Lihat Semua Galeri</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @forelse($latestGalleries as $gallery)
                    <x-public.gallery-card :gallery="$gallery" />
                @empty
                    <div
                        class="col-span-full text-center py-12 text-[#4B6358] bg-white rounded-2xl border border-[#084C27]/10 p-8">
                        Belum ada dokumentasi kegiatan yang diunggah.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 7. CONTACT & LOCATION MAP EMBED SECTION -->
    <section id="kontak" class="py-20 md:py-28 bg-white border-t border-[#084C27]/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                <span class="text-xs md:text-sm font-semibold uppercase tracking-wider text-[#059669]">Lokasi & Hubungi
                    Kami</span>
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-[#084C27]">Kunjungi Pondok Pesantren Kami</h2>
                <p class="text-sm md:text-base text-[#4B6358]">Kami menyambut hangat kunjungan silaturahmi calon wali santri
                    dan tamu pondok di kampus asri Ciampea, Bogor.</p>
                <div class="w-16 h-1 bg-[#D97706] mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Contact Details Bento Card -->
                <div class="lg:col-span-5 bg-[#FDFBF7] p-8 rounded-3xl border border-[#084C27]/10 shadow-xs space-y-6">
                    <div>
                        <h3 class="font-serif font-bold text-xl text-[#084C27]">PPMTQ Daar El Tazkiyah Sumardi</h3>
                        <p class="text-xs text-[#059669] font-semibold mt-1 uppercase tracking-wide">Kampus Tahfidz Ciampea
                            Bogor</p>
                    </div>

                    <div class="space-y-5 text-sm text-[#1B3A2B]">
                        <div class="flex items-start gap-3.5">
                            <div
                                class="w-9 h-9 rounded-xl bg-emerald-50 text-[#084C27] flex items-center justify-center shrink-0 mt-0.5 border border-[#084C27]/10">
                                <svg class="w-5 h-5 text-[#059669]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <strong class="block text-[#084C27] font-semibold">Alamat Sekretariat:</strong>
                                <span class="leading-relaxed text-[#4B6358]">{{ $siteAddress }}</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5">
                            <div
                                class="w-9 h-9 rounded-xl bg-emerald-50 text-[#084C27] flex items-center justify-center shrink-0 mt-0.5 border border-[#084C27]/10">
                                <svg class="w-5 h-5 text-[#059669]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <strong class="block text-[#084C27] font-semibold">Layanan Telepon:</strong>
                                <span class="font-sans font-medium text-[#4B6358]">{{ $sitePhone }}</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5">
                            <div
                                class="w-9 h-9 rounded-xl bg-emerald-50 text-[#084C27] flex items-center justify-center shrink-0 mt-0.5 border border-[#084C27]/10">
                                <svg class="w-5 h-5 text-[#059669]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <strong class="block text-[#084C27] font-semibold">Email Resmi:</strong>
                                <span class="text-[#4B6358]">{{ $siteEmail }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string) $waNumber) }}?text={{ urlencode('Assalamu\'alaikum Panitia PSB PPMTQ Daar El Tazkiyah, saya ingin bertanya seputar pendaftaran santri baru.') }}"
                            target="_blank" rel="noopener noreferrer"
                            class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-[#059669] hover:bg-[#084C27] text-white font-semibold text-sm transition shadow-sm">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.974.57 1.77.879 2.801.88h.005c3.179 0 5.766-2.587 5.767-5.766.001-3.181-2.585-5.767-5.777-5.767zm7.537 5.764c-.002 4.156-3.383 7.537-7.542 7.537-1.325-.001-2.571-.351-3.666-.999l-4.088 1.072 1.091-3.987c-.714-1.144-1.095-2.476-1.094-3.843.003-4.156 3.385-7.537 7.545-7.537 4.159.001 7.543 3.382 7.544 7.541l.21-.004zm-10.428-2.31c-.139-.307-.285-.313-.418-.319-.108-.005-.232-.005-.357-.005-.125 0-.327.046-.499.233-.172.187-.655.641-.655 1.562s.67 1.812.763 1.937c.094.125 1.319 2.014 3.195 2.825.446.193.795.308 1.066.394.448.143.856.123 1.178.075.359-.054 1.107-.453 1.263-.89.156-.437.156-.812.11-.89-.047-.078-.172-.125-.359-.219-.187-.094-1.107-.546-1.279-.609-.172-.062-.297-.094-.422.094-.125.187-.484.609-.593.734-.109.125-.219.14-.406.047-.187-.094-.79-.291-1.505-.929-.556-.497-.932-1.111-1.041-1.298-.109-.187-.012-.288.082-.381.084-.084.187-.219.281-.328.094-.109.125-.187.187-.312.062-.125.031-.234-.016-.328-.046-.094-.418-1.008-.578-1.38z" />
                            </svg>
                            <span>Chat Panitia via WhatsApp ({{ $waNumber }})</span>
                        </a>
                    </div>
                </div>

                <!-- Google Maps Embed Iframe -->
                <div
                    class="lg:col-span-7 bg-gray-100 rounded-3xl overflow-hidden shadow-xs border border-[#084C27]/10 h-96 lg:h-[440px]">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15853.535091763717!2d106.6967727!3d-6.5991444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5e52c77df49%3A0xe54ef5aef2f128be!2sCihideung%20Udik%2C%20Kec.%20Ciampea%2C%20Kabupaten%20Bogor%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" title="Peta Lokasi PPMTQ Daar El Tazkiyah Sumardi">
                    </iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
