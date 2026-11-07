@props([
    'activeWave' => null,
])

@php
    $activeWave = $activeWave ?? \App\Models\AdmissionWave::currentActive();
@endphp

<div x-data="{ mobileMenuOpen: false }" class="relative z-40">
    <!-- Top Announcement Bar (Wave Status) -->
    @if($activeWave)
        <div class="bg-gradient-to-r from-[#084C27] via-[#059669] to-[#084C27] text-white text-xs md:text-sm py-2 px-4 shadow-xs text-center font-medium">
            <div class="max-w-7xl mx-auto flex items-center justify-center gap-2 flex-wrap">
                <span class="inline-block w-2 h-2 rounded-full bg-[#D97706] animate-pulse"></span>
                <span>Penerimaan Santri Baru (PSB) TA {{ $activeWave->academic_year }} {{ $activeWave->name }} Telah Dibuka!</span>
                <a href="{{ route('psb.index') }}" class="underline font-semibold text-amber-300 hover:text-white transition ml-1 inline-flex items-center gap-1">
                    <span>Daftar Sekarang</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    @endif

    <!-- Main Navigation Header -->
    <header class="sticky top-0 bg-white/95 backdrop-blur-md border-b border-[#084C27]/10 transition-all shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo & Institution Title -->
                <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#084C27] to-[#059669] flex items-center justify-center text-white font-serif font-bold text-xl shadow-md group-hover:scale-105 transition-transform shrink-0 border border-gold-hairline">
                        DT
                    </div>
                    <div class="flex flex-col">
                        <div class="font-serif font-bold text-base sm:text-lg md:text-xl text-[#084C27] tracking-tight leading-tight">
                            Daar El Tazkiyah
                        </div>
                        <div class="text-[10px] sm:text-[11px] text-[#059669] font-semibold tracking-wide uppercase line-clamp-1">
                            Pondok Pesantren Modern Tahfidzul Quran
                        </div>
                        <div class="hidden lg:block font-arabic text-[11px] text-[#D97706]" dir="rtl" style="line-height: 1.8;">
                            معهد دار التزكية سوماردي الإسلامي لتحفيظ القرآن
                        </div>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center gap-6 xl:gap-8 text-sm font-semibold text-[#1B3A2B]">
                    <a href="{{ route('home') }}" class="hover:text-[#059669] transition py-1">Beranda</a>
                    <a href="{{ route('home') }}#profil" class="hover:text-[#059669] transition py-1">Profil</a>
                    <a href="{{ route('home') }}#program" class="hover:text-[#059669] transition py-1">Program</a>
                    <a href="{{ route('news.index') }}" class="hover:text-[#059669] transition py-1">Berita</a>
                    <a href="{{ route('gallery.index') }}" class="hover:text-[#059669] transition py-1">Galeri</a>
                    <a href="{{ route('home') }}#kontak" class="hover:text-[#059669] transition py-1">Kontak</a>
                </nav>

                <!-- Desktop CTAs -->
                <div class="hidden sm:flex items-center gap-3">
                    <a href="{{ route('psb.status') }}" class="text-xs font-semibold px-3.5 py-2 rounded-xl border border-[#084C27]/20 text-[#084C27] hover:bg-[#084C27]/5 transition">
                        Cek Status PSB
                    </a>
                    <a href="{{ route('psb.index') }}" class="inline-flex items-center gap-1.5 text-xs md:text-sm font-semibold px-4 py-2.5 rounded-xl bg-[#D97706] hover:bg-[#B45309] text-white shadow-sm hover:shadow-glow-amber transition-all transform hover:-translate-y-0.5">
                        <span>Daftar Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <!-- Mobile Hamburger Toggle -->
                <div class="flex items-center gap-2 lg:hidden">
                    <a href="{{ route('psb.index') }}" class="sm:hidden text-xs font-semibold px-3 py-2 rounded-lg bg-[#D97706] text-white">
                        Daftar
                    </a>
                    <button type="button"
                            @click="mobileMenuOpen = !mobileMenuOpen"
                            class="p-2 rounded-xl text-[#084C27] hover:bg-[#084C27]/5 focus:outline-hidden focus:ring-2 focus:ring-[#059669]"
                            aria-label="Buka Menu Navigasi"
                            :aria-expanded="mobileMenuOpen.toString()">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             @click.away="mobileMenuOpen = false"
             class="lg:hidden border-t border-[#084C27]/10 bg-[#FDFBF7]/95 backdrop-blur-md px-4 pt-4 pb-6 space-y-3 shadow-lg"
             style="display: none;">
            <div class="font-arabic text-xs text-[#D97706] text-center pb-2 border-b border-[#084C27]/10" dir="rtl" style="line-height: 1.8;">
                معهد دار التزكية سوماردي الإسلامي لتحفيظ القرآن
            </div>

            <nav class="grid gap-1 font-semibold text-sm text-[#084C27]">
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false" class="px-3 py-2.5 rounded-lg hover:bg-[#084C27]/5 transition">Beranda</a>
                <a href="{{ route('home') }}#profil" @click="mobileMenuOpen = false" class="px-3 py-2.5 rounded-lg hover:bg-[#084C27]/5 transition">Profil & Visi Misi</a>
                <a href="{{ route('home') }}#program" @click="mobileMenuOpen = false" class="px-3 py-2.5 rounded-lg hover:bg-[#084C27]/5 transition">Program & Biaya</a>
                <a href="{{ route('home') }}#asatidz" @click="mobileMenuOpen = false" class="px-3 py-2.5 rounded-lg hover:bg-[#084C27]/5 transition">Dewan Asatidz</a>
                <a href="{{ route('news.index') }}" @click="mobileMenuOpen = false" class="px-3 py-2.5 rounded-lg hover:bg-[#084C27]/5 transition">Berita & Warta</a>
                <a href="{{ route('gallery.index') }}" @click="mobileMenuOpen = false" class="px-3 py-2.5 rounded-lg hover:bg-[#084C27]/5 transition">Galeri Foto</a>
                <a href="{{ route('home') }}#kontak" @click="mobileMenuOpen = false" class="px-3 py-2.5 rounded-lg hover:bg-[#084C27]/5 transition">Kontak & Lokasi</a>
            </nav>

            <div class="pt-3 border-t border-[#084C27]/10 grid grid-cols-1 gap-2">
                <a href="{{ route('psb.status') }}" class="w-full text-center px-4 py-2.5 rounded-xl border border-[#084C27]/25 text-[#084C27] font-semibold text-sm hover:bg-[#084C27]/5 transition">
                    Cek Status PSB
                </a>
                <a href="{{ route('psb.index') }}" class="w-full text-center px-4 py-3 rounded-xl bg-[#D97706] hover:bg-[#B45309] text-white font-semibold text-sm shadow-md transition">
                    Daftar Sekarang (PSB Online) &rarr;
                </a>
            </div>
        </div>
    </header>
</div>
