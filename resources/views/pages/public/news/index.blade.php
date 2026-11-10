@extends('layouts.public')

@section('title', 'Warta & Berita Pondok - PPMTQ Daar El Tazkiyah Sumardi')

@section('meta')
    <meta name="description" content="Ikuti perkembangan informasi kegiatan santri, prestasi, dan pengumuman resmi PPMTQ Daar El Tazkiyah Sumardi.">
    <meta property="og:title" content="Warta & Berita - PPMTQ Daar El Tazkiyah Sumardi">
    <meta property="og:description" content="Ikuti perkembangan informasi kegiatan santri, prestasi, dan pengumuman resmi PPMTQ Daar El Tazkiyah Sumardi.">
@endsection

@section('content')
    <!-- Page Header (Editorial Academic Banner with Santri Photo Background) -->
    <section class="relative bg-cover bg-center overflow-hidden py-16 md:py-24 border-b border-[#B89758]/30"
             style="background-image: url('{{ asset('images/foto-santri-3.webp') }}');">
        <!-- Dark Forest Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#042816] via-[#084C27]/90 to-[#042816]/85"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-4">
            <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.2]">
                Warta & Pengumuman Resmi Pesantren
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-emerald-100/90 max-w-3xl mx-auto leading-relaxed">
                Dokumentasi kabar kegiatan santri, agenda kajian kitab salaf, musabaqah hifdzil quran, serta informasi administratif resmi PPMTQ Daar El Tazkiyah Sumardi.
            </p>
        </div>
    </section>

    <!-- Main Livewire List -->
    <section class="py-10 md:py-16 bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <livewire:public.news-list :category="(string) request('category', '')" :search="(string) request('search', request('q', ''))" />
        </div>
    </section>
@endsection
