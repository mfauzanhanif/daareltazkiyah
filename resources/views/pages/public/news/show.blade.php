@extends('layouts.public')

@section('title', $post->title)

@section('meta')
    <meta property="og:title" content="{{ $post->ogTitle() }}">
    <meta property="og:description" content="{{ $post->ogDescription() }}">
    <meta property="og:image" content="{{ $post->featured_image ? (Illuminate\Support\Str::startsWith($post->featured_image, ['http://', 'https://']) ? $post->featured_image : asset('storage/' . $post->featured_image)) : asset('favicon.svg') }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
@endsection

@section('content')
<article class="py-12 md:py-20 bg-[#FDFBF7]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs text-[#4B6358]">
            <a href="{{ route('home') }}" class="hover:text-[#084C27]">Beranda</a>
            <span>/</span>
            <a href="{{ route('news.index') }}" class="hover:text-[#084C27]">Berita</a>
            @if($post->category)
                <span>/</span>
                <a href="{{ route('news.index', ['category' => $post->category->slug]) }}" class="hover:text-[#084C27]">{{ $post->category->name }}</a>
            @endif
        </nav>

        <!-- Article Header -->
        <header class="space-y-4">
            @if($post->category)
                <span class="inline-block px-3 py-1 rounded-full bg-[#084C27]/10 text-[#084C27] text-xs font-semibold">
                    {{ $post->category->name }}
                </span>
            @endif

            <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-[#084C27] leading-tight">
                {{ $post->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-4 text-xs text-[#4B6358] pt-2 border-b border-gray-200 pb-6">
                <span>Dipublikasikan: <strong>{{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F Y') }}</strong></span>
                <span>&bull;</span>
                <span>Penulis: <strong>{{ $post->author?->name ?? 'Admin Humas' }}</strong></span>
                <span>&bull;</span>
                <span>Dibaca: <strong>{{ $post->views->sum('count') ?? 1 }} kali</strong></span>
                <span>&bull;</span>
                <span class="inline-flex items-center gap-1 text-[#059669]">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ $post->estimatedReadTime() }} menit baca</span>
                </span>
            </div>
        </header>

        <!-- Featured Image -->
        @if($post->featured_image)
            <div class="rounded-3xl overflow-hidden shadow-elevated border border-gray-100 max-h-[480px]">
                <img src="{{ Illuminate\Support\Str::startsWith($post->featured_image, ['http://', 'https://']) ? $post->featured_image : asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <!-- Article Content (Rich Text) -->
        <div class="bg-white p-6 md:p-10 rounded-3xl border border-[#084C27]/10 shadow-xs prose prose-emerald max-w-none text-[#1B3A2B] leading-relaxed">
            {!! $post->content !!}
        </div>

        <!-- Social Share Actions -->
        <div class="bg-emerald-50 p-6 rounded-2xl border border-emerald-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <h4 class="font-serif font-bold text-base text-[#084C27]">Bagikan Berita Ini</h4>
                <p class="text-xs text-[#4B6358]">Sebarkan warta kebaikan dan informasi kegiatan pondok kepada sesama.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' - ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#059669] hover:bg-[#084C27] text-white text-xs font-semibold transition shadow-xs">
                    <span>Bagikan ke WhatsApp</span>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#1877F2] hover:bg-[#0d65d9] text-white text-xs font-semibold transition shadow-xs">
                    <span>Facebook</span>
                </a>
            </div>
        </div>

        <!-- Related News -->
        @if($relatedPosts->isNotEmpty())
            <div class="pt-8 space-y-6">
                <h3 class="font-serif font-bold text-2xl text-[#084C27]">Berita Terkait Lainnya</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $related)
                        <x-public.news-card :post="$related" />
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</article>
@endsection
