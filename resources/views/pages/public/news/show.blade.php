@extends('layouts.public')

@section('title', $post->title . ' - PPMTQ Daar El Tazkiyah Sumardi')

@section('meta')
    <meta property="og:title" content="{{ $post->ogTitle() }}">
    <meta property="og:description" content="{{ $post->ogDescription() }}">
    <meta property="og:image" content="{{ $post->featured_image ? (Illuminate\Support\Str::startsWith($post->featured_image, ['http://', 'https://']) ? $post->featured_image : asset('storage/' . $post->featured_image)) : asset('favicon.svg') }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
@endsection

@section('content')
<article class="py-12 md:py-20 bg-[#FAF8F5]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs text-[#4B6358] bg-white border border-[#E5E0D8] rounded-xl px-4 py-3 shadow-xs">
            <a href="{{ route('home') }}" class="hover:text-[#0D3B2E] font-medium">Beranda</a>
            <span class="text-[#B89758]">&rsaquo;</span>
            <a href="{{ route('news.index') }}" class="hover:text-[#0D3B2E] font-medium">Warta & Berita</a>
            @if($post->category)
                <span class="text-[#B89758]">&rsaquo;</span>
                <a href="{{ route('news.index', ['category' => $post->category->slug]) }}" class="hover:text-[#0D3B2E] font-medium">{{ $post->category->name }}</a>
            @endif
        </nav>

        <!-- Article Header -->
        <header class="space-y-4 bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-8 shadow-xs">
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold uppercase tracking-wider text-[#059669]">
                    {{ $post->category?->name ?? 'WARTA PONDOK' }}
                </span>
                <span class="w-8 h-px bg-[#B89758]"></span>
                <span class="text-[11px] font-mono text-[#4B6358] uppercase">Publikasi Resmi</span>
            </div>

            <h1 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] leading-tight">
                {{ $post->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-3 sm:gap-4 text-xs text-[#4B6358] pt-3 border-t border-[#E5E0D8]/60 font-mono">
                <span>Tanggal: <strong>{{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F Y') }}</strong></span>
                <span>&bull;</span>
                <span>Penulis: <strong>{{ $post->author?->name ?? 'Admin Humas' }}</strong></span>
                <span>&bull;</span>
                <span>Dibaca: <strong>{{ $post->views->sum('count') ?? 1 }}x</strong></span>
                <span>&bull;</span>
                <span>{{ $post->estimatedReadTime() }} menit baca</span>
            </div>
        </header>

        <!-- Featured Image -->
        @if($post->featured_image)
            <div class="border border-[#E5E0D8] rounded-2xl overflow-hidden max-h-[480px] bg-white shadow-sm">
                <img src="{{ Illuminate\Support\Str::startsWith($post->featured_image, ['http://', 'https://']) ? $post->featured_image : asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <!-- Article Body -->
        <div class="bg-white border border-[#E5E0D8] rounded-2xl p-6 sm:p-10 md:p-12 shadow-xs prose prose-emerald max-w-none text-[#18181B] text-base leading-relaxed">
            {!! $post->content !!}
        </div>

        <!-- Article Navigation & Share Bar -->
        <div class="bg-white border border-[#E5E0D8] rounded-2xl p-5 sm:p-6 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
            <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-[#0D3B2E] hover:text-[#059669] transition">
                <span aria-hidden="true">&larr;</span>
                <span>Kembali ke Seluruh Berita</span>
            </a>
            <div class="flex items-center gap-2 text-xs text-[#4B6358]">
                <span>Bagikan:</span>
                <a href="https://wa.me/?text={{ urlencode($post->title . ' - ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="px-4 py-2 rounded-xl border border-[#E5E0D8] bg-[#FAF8F5] hover:bg-white hover:border-[#0D3B2E] text-[#0D3B2E] font-bold text-xs transition shadow-2xs">
                    WhatsApp
                </a>
            </div>
        </div>

    </div>
</article>
@endsection
