@props([
    'activeWave' => null,
])

@php
    $activeWave = $activeWave ?? \App\Models\AdmissionWave::currentActive();
@endphp

<div x-data="{ mobileMenuOpen: false }" class="relative z-40">
    <!-- Top Announcement Bar (Editorial Wave Status) -->
    @if($activeWave)
        <div class="bg-[#084C27] text-white text-xs py-2 px-4 border-b border-[#E5E0D8]/20 font-medium">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-4 flex-wrap">
                <div class="flex items-center gap-2">
                    <span class="inline-block w-1.5 h-1.5 bg-[#D97706]"></span>
                    <span class="text-emerald-100 font-mono tracking-wider text-[11px] uppercase">Warta Penerimaan:</span>
                    <span class="text-white">Penerimaan Santri Baru (PSB) TA {{ $activeWave->academic_year }} {{ $activeWave->name }} Telah Dibuka</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-xs text-amber-200 font-arabic hidden md:inline" dir="rtl" style="line-height: 1.8;">معهد دار التزكية لتحفيظ القرآن</span>
                    <a href="{{ route('psb.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-300 hover:text-white transition group">
                        <span>Daftar Sekarang</span>
                        <span class="group-hover:translate-x-0.5 transition-transform" aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Editorial Navigation Header -->
    <header class="sticky top-0 bg-[#FAF8F5]/95 backdrop-blur-md border-b border-[#E5E0D8] transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <!-- Institutional Brand & Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                    <div class="w-11 h-11 border border-[#B89758] bg-[#084C27] flex items-center justify-center text-white font-serif font-bold text-lg shadow-xs group-hover:border-[#059669] transition">
                        DT
                    </div>
                    <div class="flex flex-col">
                        <div class="font-serif font-bold text-base sm:text-lg md:text-xl text-[#0D3B2E] tracking-tight leading-tight">
                            Daar El Tazkiyah
                        </div>
                        <div class="text-[10px] sm:text-[11px] text-[#4B6358] font-medium tracking-wider uppercase line-clamp-1">
                            Pondok Pesantren Modern Tahfidzul Quran
                        </div>
                        <div class="hidden xl:block font-arabic text-[11px] text-[#B89758]" dir="rtl" style="line-height: 1.8;">
                            معهد دار التزكية سوماردي الإسلامي لتحفيظ القرآن
                        </div>
                    </div>
                </a>

                <!-- Desktop Navigation Links (Hierarchical Dropdowns with 1-Line Descriptions) -->
                <nav x-data="{ openDropdown: null }" class="hidden lg:flex items-center gap-1 xl:gap-2 text-xs font-semibold uppercase tracking-wider text-[#18181B]">
                    
                    <!-- Beranda -->
                    <a href="{{ route('home') }}" class="px-3 py-2 text-[#0D3B2E] hover:text-[#059669] transition border-b-2 {{ request()->routeIs('home') ? 'border-[#0D3B2E] font-bold' : 'border-transparent' }}">
                        Beranda
                    </a>

                    <!-- Dropdown: Profil -->
                    <div class="relative" @mouseenter="openDropdown = 'profil'" @mouseleave="openDropdown = null">
                        <button type="button" 
                                class="inline-flex items-center gap-1.5 px-3 py-2 hover:text-[#059669] transition border-b-2 {{ request()->is('profil*') ? 'border-[#0D3B2E] font-bold' : 'border-transparent' }}"
                                :class="{ 'text-[#059669]': openDropdown === 'profil' }">
                            <span>Profil</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="{ 'rotate-180': openDropdown === 'profil' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Panel -->
                        <div x-show="openDropdown === 'profil'"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute left-0 w-80 bg-white border border-[#E5E0D8] shadow-md p-2 mt-1 z-50 text-left normal-case"
                             style="display: none;">
                            
                            <a href="{{ route('profile.sejarah') }}" class="block p-3 hover:bg-[#FAF8F5] border border-transparent hover:border-[#E5E0D8] transition group">
                                <div class="flex items-center justify-between">
                                    <span class="font-serif font-bold text-sm text-[#0D3B2E] group-hover:text-[#059669]">01. Sejarah & Visi Misi</span>
                                    <span class="text-xs text-[#B89758] group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </div>
                                <p class="text-xs text-[#4B6358] mt-1 leading-relaxed">
                                    Akar pendirian, filosofi tazkiyah, dan 4 pilar komitmen pendidikan.
                                </p>
                            </a>

                            <a href="{{ route('profile.teachers') }}" class="block p-3 hover:bg-[#FAF8F5] border border-transparent hover:border-[#E5E0D8] transition group mt-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-serif font-bold text-sm text-[#0D3B2E] group-hover:text-[#059669]">02. Dewan Asatidz</span>
                                    <span class="text-xs text-[#B89758] group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </div>
                                <p class="text-xs text-[#4B6358] mt-1 leading-relaxed">
                                    Profil dewan guru huffadz 30 juz bersanad dan tenaga pendidik.
                                </p>
                            </a>

                            <a href="{{ route('profile.facilities') }}" class="block p-3 hover:bg-[#FAF8F5] border border-transparent hover:border-[#E5E0D8] transition group mt-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-serif font-bold text-sm text-[#0D3B2E] group-hover:text-[#059669]">03. Sarana & Fasilitas</span>
                                    <span class="text-xs text-[#B89758] group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </div>
                                <p class="text-xs text-[#4B6358] mt-1 leading-relaxed">
                                    Masjid, asrama mukim, ruang kelas terpadu, dan area olahraga asri.
                                </p>
                            </a>
                        </div>
                    </div>

                    <!-- Dropdown: Akademik -->
                    <div class="relative" @mouseenter="openDropdown = 'akademik'" @mouseleave="openDropdown = null">
                        <button type="button" 
                                class="inline-flex items-center gap-1.5 px-3 py-2 hover:text-[#059669] transition border-b-2 {{ request()->is('akademik*') ? 'border-[#0D3B2E] font-bold' : 'border-transparent' }}"
                                :class="{ 'text-[#059669]': openDropdown === 'akademik' }">
                            <span>Akademik</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="{ 'rotate-180': openDropdown === 'akademik' }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Panel -->
                        <div x-show="openDropdown === 'akademik'"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute left-0 w-80 bg-white border border-[#E5E0D8] shadow-md p-2 mt-1 z-50 text-left normal-case"
                             style="display: none;">
                            
                            <a href="{{ route('academic.mts') }}" class="block p-3 hover:bg-[#FAF8F5] border border-transparent hover:border-[#E5E0D8] transition group">
                                <div class="flex items-center justify-between">
                                    <span class="font-serif font-bold text-sm text-[#0D3B2E] group-hover:text-[#059669]">01. MTS Mukim 24 Jam</span>
                                    <span class="text-xs text-[#B89758] group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </div>
                                <p class="text-xs text-[#4B6358] mt-1 leading-relaxed">
                                    Pendidikan formal setingkat SMP terpadu asrama dan target 30 juz.
                                </p>
                            </a>

                            <a href="{{ route('academic.mdta') }}" class="block p-3 hover:bg-[#FAF8F5] border border-transparent hover:border-[#E5E0D8] transition group mt-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-serif font-bold text-sm text-[#0D3B2E] group-hover:text-[#059669]">02. MDTA (Sekolah Sore)</span>
                                    <span class="text-xs text-[#B89758] group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </div>
                                <p class="text-xs text-[#4B6358] mt-1 leading-relaxed">
                                    Madrasah diniyah non-mukim untuk anak sekolah dasar di sore hari.
                                </p>
                            </a>

                            <a href="{{ route('academic.tahfidz') }}" class="block p-3 hover:bg-[#FAF8F5] border border-transparent hover:border-[#E5E0D8] transition group mt-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-serif font-bold text-sm text-[#0D3B2E] group-hover:text-[#059669]">03. Kurikulum Tahfidz & Kitab</span>
                                    <span class="text-xs text-[#B89758] group-hover:translate-x-1 transition-transform">&rarr;</span>
                                </div>
                                <p class="text-xs text-[#4B6358] mt-1 leading-relaxed">
                                    Metode sabaq-manzil, matan tajwid bersanad, dan kitab kuning salaf.
                                </p>
                            </a>
                        </div>
                    </div>

                    <!-- Berita -->
                    <a href="{{ route('news.index') }}" class="px-3 py-2 text-[#18181B] hover:text-[#059669] transition border-b-2 {{ request()->is('berita*') ? 'border-[#0D3B2E] font-bold' : 'border-transparent' }}">
                        Berita
                    </a>

                    <!-- Galeri -->
                    <a href="{{ route('gallery.index') }}" class="px-3 py-2 text-[#18181B] hover:text-[#059669] transition border-b-2 {{ request()->is('galeri*') ? 'border-[#0D3B2E] font-bold' : 'border-transparent' }}">
                        Galeri
                    </a>

                    <!-- PSB Online -->
                    <a href="{{ route('psb.index') }}" class="px-3 py-2 text-[#18181B] hover:text-[#059669] transition border-b-2 {{ request()->is('psb*') ? 'border-[#0D3B2E] font-bold' : 'border-transparent' }}">
                        PSB Online
                    </a>

                    <!-- Kontak -->
                    <a href="{{ route('contact.index') }}" class="px-3 py-2 text-[#18181B] hover:text-[#059669] transition border-b-2 {{ request()->is('kontak*') ? 'border-[#0D3B2E] font-bold' : 'border-transparent' }}">
                        Kontak
                    </a>
                </nav>

                <!-- Desktop CTAs (Sharp/Subtle Edges, Hairline Border, Dignified) -->
                <div class="hidden sm:flex items-center gap-3">
                    <a href="{{ route('psb.status') }}" class="text-xs font-semibold uppercase tracking-wider px-4 py-2.5 border border-[#E5E0D8] text-[#0D3B2E] hover:border-[#0D3B2E] hover:bg-white transition">
                        Cek Status PSB
                    </a>
                    <a href="{{ route('psb.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-wider px-5 py-2.5 bg-[#0D3B2E] hover:bg-[#059669] text-white border border-[#0D3B2E] transition group">
                        <span>Daftar Sekarang</span>
                        <span class="group-hover:translate-x-0.5 transition-transform" aria-hidden="true">&rarr;</span>
                    </a>
                </div>

                <!-- Mobile Hamburger Toggle -->
                <div class="flex items-center gap-2 lg:hidden">
                    <a href="{{ route('psb.index') }}" class="sm:hidden text-xs font-semibold uppercase px-3 py-2 bg-[#0D3B2E] text-white">
                        Daftar
                    </a>
                    <button type="button"
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            class="p-2 border border-[#E5E0D8] text-[#0D3B2E] hover:bg-white transition"
                            aria-label="Buka Menu Navigasi"
                            :aria-expanded="mobileMenuOpen.toString()">
                        <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             @click.away="mobileMenuOpen = false"
             class="lg:hidden border-t border-[#E5E0D8] bg-[#FAF8F5] px-4 pt-4 pb-6 space-y-4"
             style="display: none;">
            
            <div class="font-arabic text-xs text-[#B89758] text-center pb-2 border-b border-[#E5E0D8]" dir="rtl" style="line-height: 1.8;">
                معهد دار التزكية سوماردي الإسلامي لتحفيظ القرآن
            </div>

            <nav class="space-y-1 text-sm font-semibold text-[#18181B]">
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 border-l-2 {{ request()->routeIs('home') ? 'border-[#0D3B2E] bg-white text-[#0D3B2E]' : 'border-transparent' }}">
                    Beranda
                </a>

                <!-- Profil Accordion in Mobile -->
                <div x-data="{ expanded: false }" class="border-t border-[#E5E0D8]/60 pt-1">
                    <button type="button" @click="expanded = !expanded" class="w-full flex items-center justify-between px-3 py-2 text-left">
                        <span>Profil Lembaga</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': expanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="expanded" class="pl-4 space-y-1 text-xs border-l border-[#E5E0D8] ml-3 mb-2" style="display: none;">
                        <a href="{{ route('profile.sejarah') }}" @click="mobileMenuOpen = false" class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">01. Sejarah & Visi Misi</a>
                        <a href="{{ route('profile.teachers') }}" @click="mobileMenuOpen = false" class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">02. Dewan Asatidz</a>
                        <a href="{{ route('profile.facilities') }}" @click="mobileMenuOpen = false" class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">03. Sarana & Fasilitas</a>
                    </div>
                </div>

                <!-- Akademik Accordion in Mobile -->
                <div x-data="{ expanded: false }" class="border-t border-[#E5E0D8]/60 pt-1">
                    <button type="button" @click="expanded = !expanded" class="w-full flex items-center justify-between px-3 py-2 text-left">
                        <span>Program Akademik</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': expanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="expanded" class="pl-4 space-y-1 text-xs border-l border-[#E5E0D8] ml-3 mb-2" style="display: none;">
                        <a href="{{ route('academic.mts') }}" @click="mobileMenuOpen = false" class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">01. MTS Mukim 24 Jam</a>
                        <a href="{{ route('academic.mdta') }}" @click="mobileMenuOpen = false" class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">02. MDTA (Sekolah Sore)</a>
                        <a href="{{ route('academic.tahfidz') }}" @click="mobileMenuOpen = false" class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">03. Kurikulum Tahfidz & Kitab</a>
                    </div>
                </div>

                <a href="{{ route('news.index') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 border-t border-[#E5E0D8]/60">
                    Warta & Berita
                </a>
                <a href="{{ route('gallery.index') }}" @click="mobileMenuOpen = false" class="block px-3 py-2">
                    Galeri Dokumentasi
                </a>
                <a href="{{ route('contact.index') }}" @click="mobileMenuOpen = false" class="block px-3 py-2">
                    Kontak & Lokasi
                </a>
            </nav>

            <div class="pt-3 border-t border-[#E5E0D8] space-y-2">
                <a href="{{ route('psb.status') }}" class="block w-full text-center px-4 py-2.5 border border-[#E5E0D8] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider bg-white">
                    Cek Status PSB
                </a>
                <a href="{{ route('psb.index') }}" class="block w-full text-center px-4 py-3 bg-[#0D3B2E] text-white font-semibold text-xs uppercase tracking-wider">
                    Daftar Sekarang (PSB Online) &rarr;
                </a>
            </div>
        </div>
    </header>
</div>
