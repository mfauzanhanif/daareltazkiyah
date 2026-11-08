@props([
    'siteAddress' => null,
    'sitePhone' => null,
    'siteEmail' => null,
])

@php
    $siteAddress = $siteAddress ?? \App\Models\SiteSetting::get('school_address', \App\Models\SiteSetting::get('site_address', 'Jl. Cibanteng Babengket, RT 02 / RW 02, Desa Cihideung Udik, Kec. Ciampea, Kab. Bogor, Jawa Barat 16620'));
    $sitePhone = $sitePhone ?? \App\Models\SiteSetting::get('school_phone', \App\Models\SiteSetting::get('site_phone', '0812-3456-7890'));
    $siteEmail = $siteEmail ?? \App\Models\SiteSetting::get('school_email', \App\Models\SiteSetting::get('site_email', 'info@daareltazkiyah.sch.id'));
    $facebookUrl = \App\Models\SiteSetting::get('facebook_url', 'https://facebook.com');
    $instagramUrl = \App\Models\SiteSetting::get('instagram_url', 'https://instagram.com');
    $youtubeUrl = \App\Models\SiteSetting::get('youtube_url', 'https://youtube.com');
@endphp

<footer class="bg-[#084C27] text-white pt-16 pb-8 border-t border-[#B89758]/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-white/10">

            <!-- Col 1: About & Arabic Citation -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 border border-[#B89758] bg-[#059669] flex items-center justify-center font-serif font-bold text-lg text-white">
                        DT
                    </div>
                    <div>
                        <span class="font-serif font-bold text-lg text-white block leading-tight">Daar El Tazkiyah</span>
                        <span class="text-[11px] text-emerald-200 uppercase font-semibold">PPMTQ Sumardi Bogor</span>
                    </div>
                </div>
                <p class="text-xs text-emerald-100/80 leading-relaxed">
                    Pondok Pesantren Modern Tahfidzul Quran Daar El Tazkiyah Sumardi mendidik generasi huffadz 30 juz mutqin, berakhlak mulia, cerdas, berprestasi, dan siap mengabdi untuk umat.
                </p>
                <div class="text-xs text-amber-300 font-medium font-arabic text-base sm:text-lg leading-relaxed pt-1" dir="rtl" style="line-height: 1.8;">
                    مَنْ سَلَكَ طَرِيقًا يَلْتَمِسُ فِيهِ عِلْمًا سَهَّلَ اللَّهُ لَهُ بِهِ طَرِيقًا إِلَى الْجَنَّةِ
                </div>
            </div>

            <!-- Col 2: Educational Programs (Multi-Page Dedicated Links) -->
            <div class="space-y-3">
                <span class="editorial-label text-amber-300">PROGRAM AKADEMIK</span>
                <ul class="text-xs space-y-2 text-emerald-100/80 pt-1">
                    <li><a href="{{ route('academic.mts') }}" class="hover:text-white hover:underline transition">MTS (Mukim 24 Jam)</a></li>
                    <li><a href="{{ route('academic.mdta') }}" class="hover:text-white hover:underline transition">MDTA (Sekolah Sore)</a></li>
                    <li><a href="{{ route('academic.tahfidz') }}" class="hover:text-white hover:underline transition">Tahfidzul Qur'an 30 Juz Bersanad</a></li>
                    <li><a href="{{ route('academic.tahfidz') }}" class="hover:text-white hover:underline transition">Kajian Kitab Kuning Salaf</a></li>
                    <li><a href="{{ route('academic.mts') }}" class="hover:text-white hover:underline transition">Kurikulum Terpadu Kemenag RI</a></li>
                </ul>
            </div>

            <!-- Col 3: Institutional Profiles & Quick Links -->
            <div class="space-y-3">
                <span class="editorial-label text-amber-300">PROFIL & INFORMASI</span>
                <ul class="text-xs space-y-2 text-emerald-100/80 pt-1">
                    <li><a href="{{ route('profile.sejarah') }}" class="hover:text-white hover:underline transition">Sejarah & Visi Misi Lembaga</a></li>
                    <li><a href="{{ route('profile.teachers') }}" class="hover:text-white hover:underline transition">Dewan Asatidz & Tenaga Pendidik</a></li>
                    <li><a href="{{ route('profile.facilities') }}" class="hover:text-white hover:underline transition">Sarana & Prasarana Kampus</a></li>
                    <li><a href="{{ route('psb.index') }}" class="hover:text-white hover:underline transition">Pendaftaran PSB Online</a></li>
                    <li><a href="{{ route('psb.status') }}" class="hover:text-white hover:underline transition">Cek Status Penerimaan Santri</a></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-white hover:underline transition">Warta & Berita Pondok</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="hover:text-white hover:underline transition">Galeri Dokumentasi Kegiatan</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-white hover:underline transition">Kontak & Lokasi Kampus</a></li>
                </ul>
            </div>

            <!-- Col 4: Secretariat & Socials -->
            <div class="space-y-4">
                <span class="editorial-label text-amber-300">SEKRETARIAT PONDOK</span>
                <p class="text-xs text-emerald-100/80 leading-relaxed">
                    {{ $siteAddress }}
                </p>
                <div class="text-xs text-emerald-100/80 space-y-1.5">
                    <p><span class="text-amber-300 font-medium">Telepon / WhatsApp:</span> {{ $sitePhone }}</p>
                    <p><span class="text-amber-300 font-medium">Email Resmi:</span> {{ $siteEmail }}</p>
                </div>

                <!-- Social Icons -->
                <div class="flex items-center gap-2 pt-2">
                    @if($facebookUrl)
                        <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 border border-white/20 hover:border-amber-300 text-white flex items-center justify-center transition" aria-label="Facebook">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    @endif
                    @if($instagramUrl)
                        <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 border border-white/20 hover:border-amber-300 text-white flex items-center justify-center transition" aria-label="Instagram">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                    @if($youtubeUrl)
                        <a href="{{ $youtubeUrl }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 border border-white/20 hover:border-amber-300 text-white flex items-center justify-center transition" aria-label="YouTube">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

        </div>

        <!-- Bottom Copyright Bar -->
        <div class="pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-emerald-200/70 gap-4">
            <p>&copy; {{ date('Y') }} Pondok Pesantren Modern Tahfidzul Quran Daar El Tazkiyah Sumardi. Seluruh hak cipta dilindungi.</p>
            <div class="flex items-center gap-6">
                <a href="{{ route('profile.sejarah') }}" class="hover:text-emerald-100 transition">Tentang Kami</a>
                <a href="{{ route('contact.index') }}" class="hover:text-emerald-100 transition">Hubungi Kami</a>
                <a href="{{ route('login') }}" class="hover:text-amber-300 transition font-semibold">Admin Panel</a>
            </div>
        </div>
    </div>
</footer>
