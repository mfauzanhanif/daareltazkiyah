@extends('layouts.public')

@section('title', 'Berita & Pengumuman Pondok')

@section('meta')
    <meta name="description" content="Ikuti perkembangan informasi kegiatan santri, prestasi, dan pengumuman resmi PPMTQ Daar El Tazkiyah Sumardi.">
    <meta property="og:title" content="Berita & Pengumuman - PPMTQ Daar El Tazkiyah Sumardi">
    <meta property="og:description" content="Ikuti perkembangan informasi kegiatan santri, prestasi, dan pengumuman resmi PPMTQ Daar El Tazkiyah Sumardi.">
@endsection

@section('content')
<section class="py-12 md:py-20 bg-[#FDFBF7]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 space-y-3">
            <span class="text-xs md:text-sm font-semibold uppercase tracking-wider text-[#059669]">Warta & Kabar Terkini</span>
            <h1 class="font-serif text-3xl md:text-5xl font-bold text-[#084C27]">Berita & Pengumuman Pondok</h1>
            <p class="text-sm md:text-base text-[#4B6358]">Ikuti perkembangan informasi kegiatan santri, prestasi, dan pengumuman resmi PPMTQ Daar El Tazkiyah.</p>
            <div class="w-16 h-1 bg-[#D97706] mx-auto rounded-full"></div>
        </div>

        <!-- Livewire Reactive News List -->
        <livewire:public.news-list :category="(string) request('category', '')" :search="(string) request('search', request('q', ''))" />

    </div>
</section>
@endsection
