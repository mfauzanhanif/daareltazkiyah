@extends('layouts.public')

@section('title', 'Warta & Berita Pondok - PPMTQ Daar El Tazkiyah Sumardi')

@section('meta')
    <meta name="description" content="Ikuti perkembangan informasi kegiatan santri, prestasi, dan pengumuman resmi PPMTQ Daar El Tazkiyah Sumardi.">
    <meta property="og:title" content="Warta & Berita - PPMTQ Daar El Tazkiyah Sumardi">
    <meta property="og:description" content="Ikuti perkembangan informasi kegiatan santri, prestasi, dan pengumuman resmi PPMTQ Daar El Tazkiyah Sumardi.">
@endsection

@section('content')
    <!-- Page Header (Editorial Academic Banner) -->
    <section class="bg-white border-b border-[#E5E0D8] pt-12 pb-14 md:pt-16 md:pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <div class="flex items-center gap-3">
                    <span class="editorial-label">04 — WARTA & DOKUMENTASI</span>
                    <span class="w-8 h-px bg-[#B89758]"></span>
                    <span class="text-xs font-mono text-[#4B6358] uppercase tracking-wider">Arsip Berita</span>
                </div>
                <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-bold text-[#0D3B2E] tracking-tight leading-[1.15]">
                    Warta & Pengumuman Resmi Pesantren
                </h1>
                <p class="text-base sm:text-lg text-[#4B6358] leading-relaxed">
                    Dokumentasi kabar kegiatan santri, agenda kajian kitab salaf, musabaqah hifdzil quran, serta informasi administratif resmi PPMTQ Daar El Tazkiyah Sumardi.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Livewire List -->
    <section class="py-16 md:py-24 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:public.news-list :category="(string) request('category', '')" :search="(string) request('search', request('q', ''))" />
        </div>
    </section>
@endsection
