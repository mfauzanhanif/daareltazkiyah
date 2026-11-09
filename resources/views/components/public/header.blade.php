@props([
    'activeWave' => null,
])

@php
    $activeWave = $activeWave ?? \App\Models\AdmissionWave::currentActive();
@endphp

<div x-data="{ mobileMenuOpen: false }" class="relative z-40">
    <!-- Main Editorial Navigation Header -->
    <header class="sticky top-0 bg-[#FAF8F5]/95 backdrop-blur-md border-b border-[#E5E0D8] transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20 lg:h-24">

                <!-- Institutional Brand & Logo -->
                <a href="{{ route('home') }}"
                    class="flex items-center gap-2 sm:gap-3 group min-w-0 py-1.5 mr-2">
                    <img src="{{ asset('images/logo_daar_el_tazkiyah.svg') }}" alt="Logo PPMTQ Daar El Tazkiyah Sumardi"
                        width="56" height="56"
                        class="w-9 h-9 xs:w-10 xs:h-10 sm:w-12 sm:h-12 md:w-13 md:h-13 shrink-0 object-contain transition-transform group-hover:scale-105"
                        onerror="this.onerror=null; this.src='{{ asset('images/logo_daar_el_tazkiyah.png') }}';">

                    <div class="flex flex-col justify-center min-w-0 w-fit">
                        <div class="block text-[8px] xs:text-[9.5px] sm:text-[10.5px] md:text-[11px] font-semibold text-[#4B6358] uppercase tracking-wider text-justify [text-align-last:justify] leading-tight select-none">
                            Pondok Pesantren Modern Tahfidzul Qur'an
                        </div>
                        <div class="block font-sans font-extrabold text-[12px] xs:text-[13.5px] sm:text-[16px] md:text-[17.5px] text-[#0D3B2E] tracking-tight uppercase text-justify [text-align-last:justify] leading-tight mt-0.5 select-none">
                            DAAR EL TAZKIYAH SUMARDI
                        </div>
                        <div class="block font-arabic text-[10px] xs:text-[11px] sm:text-[12px] md:text-[12.5px] text-[#B89758] font-medium text-justify [text-align-last:justify] leading-tight mt-0.5 select-none" dir="rtl">
                            معهد دار التزكية سوماردي الإسلامي لتحفيظ القرآن
                        </div>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav x-data="{ openDropdown: null }"
                    class="hidden lg:flex items-center gap-1 xl:gap-1.5 text-xs font-semibold uppercase tracking-wider text-[#18181B]">

                    <!-- Beranda -->
                    <a href="{{ route('home') }}"
                        class="px-3 py-2 text-[#0D3B2E] hover:text-[#059669] transition border-b-2 {{ request()->routeIs('home') ? 'border-[#0D3B2E] font-bold' : 'border-transparent' }}">
                        Beranda
                    </a>

                    <!-- Dropdown: Profil -->
                    <div class="relative" @mouseenter="openDropdown = 'profil'" @mouseleave="openDropdown = null">
                        <a href="{{ route('profile.index') }}"
                            class="inline-flex items-center gap-1.5 px-3 py-2 hover:text-[#059669] transition border-b-2 {{ request()->is('profil*') ? 'border-[#0D3B2E] font-bold text-[#0D3B2E]' : 'border-transparent' }}"
                            :class="{ 'text-[#059669]': openDropdown === 'profil' }">
                            <span>Profil</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-200"
                                :class="{ 'rotate-180': openDropdown === 'profil' }" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>

                        <!-- Dropdown Panel: Profil -->
                        <div x-show="openDropdown === 'profil'" x-cloak
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute left-0 w-48 bg-white border border-[#E5E0D8] rounded-md shadow-lg py-1 mt-1 z-50 text-left normal-case">

                            <a href="{{ route('profile.index') }}#selayang-pandang"
                                class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition">
                                Selayang Pandang
                            </a>
                            <a href="{{ route('profile.index') }}#visi-misi"
                                class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                                Visi & Misi
                            </a>
                            <a href="{{ route('profile.index') }}#fasilitas"
                                class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                                Fasilitas Pesantren
                            </a>
                            <a href="{{ route('profile.index') }}#pendidik"
                                class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                                Dewan Pendidik
                            </a>
                        </div>
                    </div>

                    <!-- Dropdown: Program -->
                    <div class="relative" @mouseenter="openDropdown = 'program'" @mouseleave="openDropdown = null">
                        <a href="{{ route('program.index') }}"
                            class="inline-flex items-center gap-1.5 px-3 py-2 hover:text-[#059669] transition border-b-2 {{ request()->is('program*') ? 'border-[#0D3B2E] font-bold text-[#0D3B2E]' : 'border-transparent' }}"
                            :class="{ 'text-[#059669]': openDropdown === 'program' }">
                            <span>Program</span>
                            <svg class="w-3.5 h-3.5 transition-transform duration-200"
                                :class="{ 'rotate-180': openDropdown === 'program' }" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>

                        <!-- Dropdown Panel: Program -->
                        <div x-show="openDropdown === 'program'" x-cloak
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute left-0 w-48 bg-white border border-[#E5E0D8] rounded-md shadow-lg py-1 mt-1 z-50 text-left normal-case">

                            <a href="{{ route('program.index') }}#program-unggulan"
                                class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition">
                                Program Unggulan
                            </a>
                            <a href="{{ route('program.index') }}#program-pendidikan"
                                class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                                Program Pendidikan
                            </a>
                            <a href="{{ route('program.index') }}#ekstrakurikuler"
                                class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                                Ekstrakurikuler
                            </a>
                        </div>
                    </div>

                    <!-- Berita -->
                    <a href="{{ route('news.index') }}"
                        class="px-3 py-2 hover:text-[#059669] transition border-b-2 {{ request()->is('berita*') ? 'border-[#0D3B2E] font-bold text-[#0D3B2E]' : 'border-transparent' }}">
                        Berita
                    </a>

                    <!-- Galeri -->
                    <a href="{{ route('gallery.index') }}"
                        class="px-3 py-2 hover:text-[#059669] transition border-b-2 {{ request()->is('galeri*') ? 'border-[#0D3B2E] font-bold text-[#0D3B2E]' : 'border-transparent' }}">
                        Galeri
                    </a>

                    <!-- Kontak -->
                    <a href="{{ route('contact.index') }}"
                        class="px-3 py-2 hover:text-[#059669] transition border-b-2 {{ request()->is('kontak*') ? 'border-[#0D3B2E] font-bold text-[#0D3B2E]' : 'border-transparent' }}">
                        Kontak
                    </a>
                </nav>

                <!-- Desktop CTAs -->
                <div class="hidden sm:flex items-center gap-3">
                    <a href="{{ route('psb.index') }}"
                        class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider px-5 py-2.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white border border-[#0D3B2E] transition group shadow-xs">
                        <span>Daftar</span>
                        <span class="group-hover:translate-x-1 transition-transform" aria-hidden="true">&rarr;</span>
                    </a>
                </div>

                <!-- Mobile Hamburger Toggle & Quick Action -->
                <div class="flex items-center gap-1.5 sm:gap-2 shrink-0 lg:hidden">
                    <a href="{{ route('psb.index') }}"
                        class="sm:hidden text-[11px] font-bold uppercase tracking-wider px-2.5 py-1.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white transition shadow-xs shrink-0">
                        Daftar
                    </a>
                    <button type="button" @click="mobileMenuOpen = !mobileMenuOpen"
                        class="p-2 rounded-md border border-[#E5E0D8] text-[#0D3B2E] hover:bg-white hover:border-[#0D3B2E] transition shrink-0"
                        aria-label="Buka Menu Navigasi" :aria-expanded="mobileMenuOpen.toString()">
                        <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2" @click.away="mobileMenuOpen = false"
            class="lg:hidden border-t border-[#E5E0D8] bg-[#FAF8F5] px-4 pt-4 pb-6 space-y-4 max-h-[calc(100vh-4.5rem)] overflow-y-auto shadow-lg">

            <div class="font-arabic text-xs text-[#B89758] text-center pb-2 border-b border-[#E5E0D8]" dir="rtl"
                style="line-height: 1.8;">
                معهد دار التزكية سوماردي الإسلامي لتحفيظ القرآن
            </div>

            <nav class="space-y-1 text-sm font-semibold text-[#18181B]">
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
                    class="block px-3 py-2 rounded-md border-l-2 {{ request()->routeIs('home') ? 'border-[#0D3B2E] bg-white text-[#0D3B2E]' : 'border-transparent' }}">
                    Beranda
                </a>

                <!-- Profil Accordion -->
                <div x-data="{ expanded: false }" class="border-t border-[#E5E0D8]/60 pt-1">
                    <button type="button" @click="expanded = !expanded"
                        class="w-full flex items-center justify-between px-3 py-2 text-left">
                        <span>Profil Pesantren</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': expanded }" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="expanded" x-cloak class="pl-4 space-y-1 text-xs border-l border-[#E5E0D8] ml-3 mb-2">
                        <a href="{{ route('profile.index') }}#selayang-pandang" @click="mobileMenuOpen = false"
                            class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">Selayang Pandang</a>
                        <a href="{{ route('profile.index') }}#visi-misi" @click="mobileMenuOpen = false"
                            class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">Visi & Misi</a>
                        <a href="{{ route('profile.index') }}#fasilitas" @click="mobileMenuOpen = false"
                            class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">Fasilitas Pesantren</a>
                        <a href="{{ route('profile.index') }}#pendidik" @click="mobileMenuOpen = false"
                            class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">Dewan Pendidik</a>
                    </div>
                </div>

                <!-- Program Accordion -->
                <div x-data="{ expanded: false }" class="border-t border-[#E5E0D8]/60 pt-1">
                    <button type="button" @click="expanded = !expanded"
                        class="w-full flex items-center justify-between px-3 py-2 text-left">
                        <span>Program Pendidikan</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': expanded }" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="expanded" x-cloak class="pl-4 space-y-1 text-xs border-l border-[#E5E0D8] ml-3 mb-2">
                        <a href="{{ route('program.index') }}#program-unggulan" @click="mobileMenuOpen = false"
                            class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">Program Unggulan</a>
                        <a href="{{ route('program.index') }}#program-pendidikan" @click="mobileMenuOpen = false"
                            class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">Program Pendidikan (MTs & MDTA)</a>
                        <a href="{{ route('program.index') }}#ekstrakurikuler" @click="mobileMenuOpen = false"
                            class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">Ekstrakurikuler</a>
                    </div>
                </div>

                <a href="{{ route('news.index') }}" @click="mobileMenuOpen = false"
                    class="block px-3 py-2 border-t border-[#E5E0D8]/60">
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
                <a href="{{ route('psb.index') }}"
                    class="block w-full text-center px-4 py-3 rounded-md bg-[#0D3B2E] text-white font-semibold text-xs uppercase tracking-wider">
                    Daftar (PSB Online) &rarr;
                </a>
            </div>
        </div>
    </header>
</div>
