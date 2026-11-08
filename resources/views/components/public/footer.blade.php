@props([
    'siteAddress' => null,
    'sitePhone' => null,
    'siteEmail' => null,
])

@php
    $siteAddress = $siteAddress ?? \App\Models\SiteSetting::get('school_address', 'RT 006 / RW 002, Kp. Lembur Sawah, Desa Mekarbaru, Kecamatan Petir, Kabupaten Serang, Provinsi Banten');
    $sitePhone = $sitePhone ?? \App\Models\SiteSetting::get('school_phone', '0895-0718-4811');
    $siteEmail = $siteEmail ?? \App\Models\SiteSetting::get('school_email', 'info@daareltazkiyah.sch.id');
    $facebookUrl = \App\Models\SiteSetting::get('facebook_url', 'https://facebook.com/media_daar_eltazkiyah');
    $instagramUrl = \App\Models\SiteSetting::get('instagram_url', 'https://instagram.com/media_daar_eltazkiyah');
    $youtubeUrl = \App\Models\SiteSetting::get('youtube_url', 'https://youtube.com/@media_daar_eltazkiyah');
    $tiktokUrl = \App\Models\SiteSetting::get('tiktok_url', 'https://tiktok.com/@media_daar_eltazkiyah');
@endphp

<footer class="bg-[#084C27] text-white pt-16 pb-8 border-t border-[#B89758]/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-white/10">

            <!-- Col 1: About & Logo -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo_daar_el_tazkiyah.svg') }}"
                        alt="Logo PPMTQ Daar El Tazkiyah"
                        class="w-12 h-12 object-contain bg-white rounded-md p-1 border border-[#B89758]"
                        onerror="this.onerror=null; this.src='{{ asset('images/logo_daar_el_tazkiyah.png') }}';">
                    <div>
                        <span class="font-sans font-extrabold text-base text-white block leading-tight">Daar El Tazkiyah Sumardi</span>
                        <span class="text-[10px] text-emerald-200 uppercase font-semibold">PPMTQ Petir, Serang - Banten</span>
                    </div>
                </div>
                <p class="text-xs text-emerald-100/80 leading-relaxed">
                    Pondok Pesantren Modern Tahfidzul Qur'an Daar El Tazkiyah Sumardi mendidik generasi Qur'ani yang berilmu, berakhlak mulia, berprestasi, dan siap mengabdi untuk umat.
                </p>
                <div class="text-xs text-amber-300 font-medium font-arabic text-base sm:text-lg leading-relaxed pt-1" dir="rtl" style="line-height: 1.8;">
                    مَنْ سَلَكَ طَرِيقًا يَلْتَمِسُ فِيهِ عِلْمًا سَهَّلَ اللَّهُ لَهُ بِهِ طَرِيقًا إِلَى الْجَنَّةِ
                </div>
            </div>

            <!-- Col 2: Educational Programs -->
            <div class="space-y-3">
                <span class="editorial-label text-amber-300">PROGRAM PENDIDIKAN</span>
                <ul class="text-xs space-y-2 text-emerald-100/80 pt-1">
                    <li><a href="{{ route('program.index') }}#program-unggulan" class="hover:text-white hover:underline transition">6 Program Unggulan</a></li>
                    <li><a href="{{ route('program.index') }}#program-pendidikan" class="hover:text-white hover:underline transition">MTs Mukim (Asrama 24 Jam)</a></li>
                    <li><a href="{{ route('program.index') }}#program-pendidikan" class="hover:text-white hover:underline transition">MDTA (Sekolah Sore Non-Mukim)</a></li>
                    <li><a href="{{ route('program.index') }}#ekstrakurikuler" class="hover:text-white hover:underline transition">Ekstrakurikuler Santri</a></li>
                    <li><a href="{{ route('psb.index') }}" class="hover:text-white hover:underline transition">Penerimaan Santri Baru (PSB)</a></li>
                </ul>
            </div>

            <!-- Col 3: Institutional Profiles & Quick Links -->
            <div class="space-y-3">
                <span class="editorial-label text-amber-300">PROFIL & INFORMASI</span>
                <ul class="text-xs space-y-2 text-emerald-100/80 pt-1">
                    <li><a href="{{ route('profile.index') }}#selayang-pandang" class="hover:text-white hover:underline transition">Selayang Pandang</a></li>
                    <li><a href="{{ route('profile.index') }}#visi-misi" class="hover:text-white hover:underline transition">Visi & 4 Pilar Misi</a></li>
                    <li><a href="{{ route('profile.index') }}#fasilitas" class="hover:text-white hover:underline transition">Sarana & Fasilitas</a></li>
                    <li><a href="{{ route('profile.index') }}#pendidik" class="hover:text-white hover:underline transition">Tenaga Pendidik & Pembimbing</a></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-white hover:underline transition">Warta & Berita Pondok</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="hover:text-white hover:underline transition">Galeri Dokumentasi</a></li>
                    <li><a href="{{ route('psb.status') }}" class="hover:text-white hover:underline transition">Cek Status PSB Online</a></li>
                </ul>
            </div>

            <!-- Col 4: Secretariat & Socials -->
            <div class="space-y-4">
                <span class="editorial-label text-amber-300">SEKRETARIAT PESANTREN</span>
                <p class="text-xs text-emerald-100/80 leading-relaxed">
                    {{ $siteAddress }}
                </p>
                <div class="text-xs text-emerald-100/80 space-y-1.5">
                    <p><span class="text-amber-300 font-medium">WhatsApp MTs:</span> 0895-0718-4811</p>
                    <p><span class="text-amber-300 font-medium">WhatsApp MDTA:</span> 0858-8276-7078</p>
                    <p><span class="text-amber-300 font-medium">Email Resmi:</span> {{ $siteEmail }}</p>
                    <p><span class="text-amber-300 font-medium">Media Sosial:</span> @media_daar_eltazkiyah</p>
                </div>

                <!-- Social Icons -->
                <div class="flex items-center gap-2 pt-2">
                    @if($facebookUrl)
                        <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded border border-white/20 hover:border-amber-300 text-white flex items-center justify-center transition" aria-label="Facebook">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    @endif
                    @if($instagramUrl)
                        <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded border border-white/20 hover:border-amber-300 text-white flex items-center justify-center transition" aria-label="Instagram">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                    @if($youtubeUrl)
                        <a href="{{ $youtubeUrl }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded border border-white/20 hover:border-amber-300 text-white flex items-center justify-center transition" aria-label="YouTube">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    @endif
                    @if($tiktokUrl)
                        <a href="{{ $tiktokUrl }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded border border-white/20 hover:border-amber-300 text-white flex items-center justify-center transition" aria-label="TikTok">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.16 1.18 2.09 2.35 2.27.7.13 1.43.05 2.09-.22.95-.39 1.64-1.24 1.84-2.24.11-.6.13-1.21.13-1.82.01-4.28 0-8.56 0-12.84z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

        </div>

        <!-- Bottom Copyright Bar -->
        <div class="pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-emerald-200/70 gap-4">
            <p>&copy; {{ date('Y') }} Pondok Pesantren Modern Tahfidzul Qur'an Daar El Tazkiyah Sumardi. Seluruh hak cipta dilindungi.</p>
            <div class="flex items-center gap-6">
                <a href="{{ route('profile.index') }}" class="hover:text-emerald-100 transition">Profil Pondok</a>
                <a href="{{ route('contact.index') }}" class="hover:text-emerald-100 transition">Hubungi Kami</a>
                <a href="{{ route('login') }}" class="hover:text-amber-300 transition font-semibold">Admin Panel</a>
            </div>
        </div>
    </div>
</footer>
