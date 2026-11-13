@props([
    'activeWave' => null,
])

@php
    $activeWave = $activeWave ?? \App\Models\AdmissionWave::currentActive();
@endphp

<!-- Main Editorial Navigation Header (Sticky with Off-Canvas Mobile Drawer) -->
<header x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-40 bg-[#FAF8F5]/95 backdrop-blur-md border-b border-[#E5E0D8] transition-colors duration-200 w-full shadow-xs">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 sm:h-20 lg:h-24">

            <!-- Institutional Brand & Logo -->
            <a href="{{ route('home') }}"
                class="flex items-center gap-2 sm:gap-3 lg:gap-3.5 group min-w-0 py-1.5 sm:shrink-0 sm:mr-2">
                <img src="{{ asset('images/logo_daar_el_tazkiyah.svg') }}" alt="Logo PPMTQ Daar El Tazkiyah Sumardi"
                    width="56" height="56"
                    class="w-9 h-9 min-[360px]:w-10 min-[360px]:h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 shrink-0 object-contain transition-transform duration-300 group-hover:scale-105"
                    onerror="this.onerror=null; this.src='{{ asset('images/logo_daar_el_tazkiyah.png') }}';">

                <div class="flex flex-col justify-center min-w-0">
                    <div class="block text-[7px] min-[360px]:text-[8px] sm:text-[10px] lg:text-[11px] font-semibold text-[#4B6358] uppercase tracking-normal sm:tracking-[0.045em] whitespace-nowrap leading-tight select-none">
                        Pondok Pesantren Modern Tahfidzul Qur'an
                    </div>
                    <div class="block font-sans font-extrabold text-[12px] min-[360px]:text-[13.5px] sm:text-[18px] lg:text-[20.5px] text-[#0D3B2E] tracking-tight sm:tracking-[0.02em] uppercase whitespace-nowrap leading-tight mt-0.5 select-none">
                        DAAR EL TAZKIYAH SUMARDI
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
                        class="absolute left-0 w-52 bg-white border border-[#E5E0D8] rounded-md shadow-lg py-1 mt-1 z-50 text-left normal-case">

                        <a href="{{ route('profile.index') }}#selayang-pandang"
                            class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition">
                            Selayang Pandang
                        </a>
                        <a href="{{ route('profile.index') }}#visi-misi"
                            class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                            Visi &amp; Misi
                        </a>
                        <a href="{{ route('profile.index') }}#fasilitas"
                            class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                            Fasilitas
                        </a>
                        <a href="{{ route('profile.index') }}#pendidik"
                            class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                            Dewan Pendidik
                        </a>
                        <a href="{{ route('profile.index') }}#legalitas"
                            class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                            Legalitas
                        </a>
                    </div>
                </div>

                <!-- Dropdown: Program -->
                <div class="relative" @mouseenter="openDropdown = 'program'" @mouseleave="openDropdown = null">
                    <a href="{{ route('program.index') }}"
                        class="inline-flex items-center gap-1.5 px-3 py-2 hover:text-[#059669] transition border-b-2 {{ request()->is('program*') || request()->is('mts*') || request()->is('mdta*') ? 'border-[#0D3B2E] font-bold text-[#0D3B2E]' : 'border-transparent' }}"
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
                        class="absolute left-0 w-52 bg-white border border-[#E5E0D8] rounded-md shadow-lg py-1 mt-1 z-50 text-left normal-case">

                        <a href="{{ route('program.index') }}"
                            class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition">
                            Program
                        </a>
                        <a href="{{ route('mts.index') }}"
                            class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                            MTS
                        </a>
                        <a href="{{ route('mdta.index') }}"
                            class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                            MDTA
                        </a>
                        <a href="{{ route('program.index') }}#ekstrakurikuler"
                            class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                            Ekstrakurikuler
                        </a>
                    </div>
                </div>

                <!-- Dropdown: PSB -->
                <div class="relative" @mouseenter="openDropdown = 'psb'" @mouseleave="openDropdown = null">
                    <a href="{{ route('psb.index') }}"
                        class="inline-flex items-center gap-1.5 px-3 py-2 hover:text-[#059669] transition border-b-2 {{ request()->is('psb*') ? 'border-[#0D3B2E] font-bold text-[#0D3B2E]' : 'border-transparent' }}"
                        :class="{ 'text-[#059669]': openDropdown === 'psb' }">
                        <span>PSB</span>
                        <svg class="w-3.5 h-3.5 transition-transform duration-200"
                            :class="{ 'rotate-180': openDropdown === 'psb' }" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>

                    <!-- Dropdown Panel: PSB -->
                    <div x-show="openDropdown === 'psb'" x-cloak
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute left-0 w-52 bg-white border border-[#E5E0D8] rounded-md shadow-lg py-1 mt-1 z-50 text-left normal-case">

                        <a href="{{ route('psb.index') }}"
                            class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition">
                            Info Pendaftaran
                        </a>
                        <a href="{{ route('psb.fee') }}"
                            class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                            Rincian Biaya
                        </a>
                        <a href="{{ route('psb.perlengkapan') }}"
                            class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                            Perlengkapan Santri
                        </a>
                        <a href="{{ route('psb.status') }}"
                            class="block px-4 py-2.5 text-xs font-semibold text-[#0D3B2E] hover:text-[#059669] hover:bg-[#FAF8F5] transition border-t border-[#E5E0D8]/40">
                            Cek Status
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
            <div class="hidden lg:flex items-center gap-3">
                <a href="{{ route('psb.form') }}"
                    class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider px-5 py-2.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white border border-[#0D3B2E] transition group shadow-xs">
                    <span>Daftar</span>
                </a>
            </div>

            <!-- Mobile Hamburger Toggle Button -->
            <div class="flex items-center shrink-0 lg:hidden">
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen"
                    class="p-2 rounded-md border border-[#E5E0D8] text-[#0D3B2E] hover:bg-white hover:border-[#0D3B2E] transition shrink-0"
                    aria-label="Buka Menu Navigasi" :aria-expanded="mobileMenuOpen.toString()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Off-Canvas Mobile Navigation Drawer -->
    <template x-teleport="body">
        <div x-show="mobileMenuOpen" x-cloak
             x-effect="document.body.classList.toggle('overflow-hidden', mobileMenuOpen)"
             class="fixed inset-0 z-[100] lg:hidden"
             role="dialog" aria-modal="true" aria-label="Menu Navigasi Mobile">

            <!-- Backdrop Overlay -->
            <div x-show="mobileMenuOpen"
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-black/60 backdrop-blur-xs"
                 @click="mobileMenuOpen = false"
                 aria-hidden="true"></div>

            <!-- Off-Canvas Drawer Panel (Sliding in from Right) -->
            <div x-show="mobileMenuOpen"
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-200 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="fixed inset-y-0 right-0 w-[85%] max-w-xs sm:max-w-sm bg-[#FAF8F5] shadow-2xl border-l border-[#E5E0D8] flex flex-col justify-between overflow-y-auto z-[101]"
                 @keydown.escape.window="mobileMenuOpen = false">

            <!-- Off-Canvas Header -->
            <div class="p-4 border-b border-[#E5E0D8] bg-white flex items-center justify-between shrink-0">
                <div class="flex items-center gap-2.5 min-w-0">
                    <img src="{{ asset('images/logo_daar_el_tazkiyah.svg') }}" alt="Logo" class="w-8 h-8 object-contain shrink-0" onerror="this.onerror=null; this.src='{{ asset('images/logo_daar_el_tazkiyah.png') }}';">
                    <div class="min-w-0">
                        <span class="block text-[8px] font-semibold text-[#4B6358] uppercase truncate leading-tight">Pondok Pesantren Modern Tahfidzul Qur'an</span>
                        <span class="block font-sans font-extrabold text-xs text-[#0D3B2E] uppercase truncate leading-tight">DAAR EL TAZKIYAH SUMARDI</span>
                    </div>
                </div>
                <button type="button" @click="mobileMenuOpen = false"
                    class="p-2 rounded-md hover:bg-gray-100 text-[#0D3B2E] transition border border-transparent hover:border-[#E5E0D8]"
                    aria-label="Tutup Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Off-Canvas Scrollable Content -->
            <div class="px-4 py-4 space-y-4 grow overflow-y-auto">
                <!-- Arabic Seal Banner -->
                <div class="font-arabic text-xs text-[#B89758] text-center pb-2 border-b border-[#E5E0D8]" dir="rtl"
                    style="line-height: 1.8;">
                    معهد دار التزكية سوماردي الإسلامي لتحفيظ القرآن
                </div>

                <nav class="space-y-1 text-xs font-semibold uppercase tracking-wider text-[#18181B]">
                    <!-- Beranda -->
                    <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
                        class="block px-3 py-2.5 rounded-md border-l-2 {{ request()->routeIs('home') ? 'border-[#0D3B2E] bg-white text-[#0D3B2E] font-bold' : 'border-transparent text-[#18181B] hover:text-[#059669]' }}">
                        Beranda
                    </a>

                    <!-- Profil Accordion -->
                    <div x-data="{ expanded: {{ request()->is('profil*') ? 'true' : 'false' }} }" class="border-t border-[#E5E0D8]/60 pt-1">
                        <button type="button" @click="expanded = !expanded"
                            class="w-full flex items-center justify-between px-3 py-2.5 text-left {{ request()->is('profil*') ? 'text-[#0D3B2E] font-bold' : 'text-[#18181B] hover:text-[#059669]' }}">
                            <span>Profil</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': expanded }" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="expanded" x-cloak class="pl-4 space-y-1 text-xs normal-case font-medium border-l border-[#E5E0D8] ml-3 mb-2">
                            <a href="{{ route('profile.index') }}#selayang-pandang" @click="mobileMenuOpen = false"
                                class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">Selayang Pandang</a>
                            <a href="{{ route('profile.index') }}#visi-misi" @click="mobileMenuOpen = false"
                                class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">Visi &amp; Misi</a>
                            <a href="{{ route('profile.index') }}#fasilitas" @click="mobileMenuOpen = false"
                                class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">Fasilitas Pesantren</a>
                            <a href="{{ route('profile.index') }}#pendidik" @click="mobileMenuOpen = false"
                                class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">Dewan Pendidik</a>
                            <a href="{{ route('profile.index') }}#legalitas" @click="mobileMenuOpen = false"
                                class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">Legalitas</a>
                        </div>
                    </div>

                    <!-- Program Accordion -->
                    <div x-data="{ expanded: {{ request()->is('program*') || request()->is('mts*') || request()->is('mdta*') ? 'true' : 'false' }} }" class="border-t border-[#E5E0D8]/60 pt-1">
                        <button type="button" @click="expanded = !expanded"
                            class="w-full flex items-center justify-between px-3 py-2.5 text-left {{ request()->is('program*') || request()->is('mts*') || request()->is('mdta*') ? 'text-[#0D3B2E] font-bold' : 'text-[#18181B] hover:text-[#059669]' }}">
                            <span>Program</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': expanded }" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="expanded" x-cloak class="pl-4 space-y-1 text-xs normal-case font-medium border-l border-[#E5E0D8] ml-3 mb-2">
                            <a href="{{ route('program.index') }}" @click="mobileMenuOpen = false"
                                class="block py-1.5 {{ request()->routeIs('program.index') ? 'text-[#0D3B2E] font-bold' : 'text-[#4B6358] hover:text-[#0D3B2E]' }}">Program</a>
                            <a href="{{ route('mts.index') }}" @click="mobileMenuOpen = false"
                                class="block py-1.5 {{ request()->routeIs('mts.index') ? 'text-[#0D3B2E] font-bold' : 'text-[#4B6358] hover:text-[#0D3B2E]' }}">MTS</a>
                            <a href="{{ route('mdta.index') }}" @click="mobileMenuOpen = false"
                                class="block py-1.5 {{ request()->routeIs('mdta.index') ? 'text-[#0D3B2E] font-bold' : 'text-[#4B6358] hover:text-[#0D3B2E]' }}">MDTA</a>
                            <a href="{{ route('program.index') }}#ekstrakurikuler" @click="mobileMenuOpen = false"
                                class="block py-1.5 text-[#4B6358] hover:text-[#0D3B2E]">Ekstrakurikuler</a>
                        </div>
                    </div>

                    <!-- PSB Accordion -->
                    <div x-data="{ expanded: {{ request()->is('psb*') ? 'true' : 'false' }} }" class="border-t border-[#E5E0D8]/60 pt-1">
                        <button type="button" @click="expanded = !expanded"
                            class="w-full flex items-center justify-between px-3 py-2.5 text-left {{ request()->is('psb*') ? 'text-[#0D3B2E] font-bold' : 'text-[#18181B] hover:text-[#059669]' }}">
                            <span>PSB</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': expanded }" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="expanded" x-cloak class="pl-4 space-y-1 text-xs normal-case font-medium border-l border-[#E5E0D8] ml-3 mb-2">
                            <a href="{{ route('psb.index') }}" @click="mobileMenuOpen = false"
                                class="block py-1.5 {{ request()->routeIs('psb.index') ? 'text-[#0D3B2E] font-bold' : 'text-[#4B6358] hover:text-[#0D3B2E]' }}">
                                Info Pendaftaran
                            </a>
                            <a href="{{ route('psb.fee') }}" @click="mobileMenuOpen = false"
                                class="block py-1.5 {{ request()->routeIs('psb.fee') ? 'text-[#0D3B2E] font-bold' : 'text-[#4B6358] hover:text-[#0D3B2E]' }}">
                                Rincian Biaya
                            </a>
                            <a href="{{ route('psb.perlengkapan') }}" @click="mobileMenuOpen = false"
                                class="block py-1.5 {{ request()->routeIs('psb.perlengkapan') ? 'text-[#0D3B2E] font-bold' : 'text-[#4B6358] hover:text-[#0D3B2E]' }}">
                                Perlengkapan Santri
                            </a>
                            <a href="{{ route('psb.status') }}" @click="mobileMenuOpen = false"
                                class="block py-1.5 {{ request()->routeIs('psb.status') ? 'text-[#0D3B2E] font-bold' : 'text-[#4B6358] hover:text-[#0D3B2E]' }}">
                                Cek Status
                            </a>
                        </div>
                    </div>

                    <!-- Berita -->
                    <a href="{{ route('news.index') }}" @click="mobileMenuOpen = false"
                        class="block px-3 py-2.5 border-t border-[#E5E0D8]/60 {{ request()->is('berita*') ? 'border-l-2 border-[#0D3B2E] bg-white text-[#0D3B2E] font-bold' : 'border-l-2 border-transparent text-[#18181B] hover:text-[#059669]' }}">
                        Berita
                    </a>

                    <!-- Galeri -->
                    <a href="{{ route('gallery.index') }}" @click="mobileMenuOpen = false"
                        class="block px-3 py-2.5 border-t border-[#E5E0D8]/60 {{ request()->is('galeri*') ? 'border-l-2 border-[#0D3B2E] bg-white text-[#0D3B2E] font-bold' : 'border-l-2 border-transparent text-[#18181B] hover:text-[#059669]' }}">
                        Galeri
                    </a>

                    <!-- Kontak -->
                    <a href="{{ route('contact.index') }}" @click="mobileMenuOpen = false"
                        class="block px-3 py-2.5 border-t border-[#E5E0D8]/60 {{ request()->is('kontak*') ? 'border-l-2 border-[#0D3B2E] bg-white text-[#0D3B2E] font-bold' : 'border-l-2 border-transparent text-[#18181B] hover:text-[#059669]' }}">
                        Kontak
                    </a>
                </nav>
            </div>

            <!-- Off-Canvas Footer CTA -->
            <div class="p-4 border-t border-[#E5E0D8] bg-white space-y-2 shrink-0">
                <a href="{{ route('psb.form') }}" @click="mobileMenuOpen = false"
                    class="block w-full text-center px-4 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition shadow-sm">
                    Daftar &rarr;
                </a>
            </div>
        </div>
    </div>
    </template>
</header>
