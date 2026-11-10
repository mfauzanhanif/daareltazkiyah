@props([
    'featuredPost' => null,
    'isClone' => false,
])

<!-- Slide 3: Latest Berita (Full Image Magazine Slide, Exact Matching Height) -->
<div class="w-full shrink-0"
     @if($isClone)
         inert aria-hidden="true"
     @else
         :inert="currentSlide !== 3" :aria-hidden="currentSlide !== 3"
     @endif>
    <div class="relative w-full rounded-2xl overflow-hidden h-[390px] sm:h-[420px] md:h-[450px] flex items-end p-6 sm:p-10 lg:p-12 text-white shadow-md">
        <!-- Full News Background Image -->
        @if($featuredPost && $featuredPost->featured_image)
            <img src="{{ asset('storage/' . $featuredPost->featured_image) }}"
                 alt="{{ $featuredPost->title }}"
                 class="absolute inset-0 w-full h-full object-cover select-none pointer-events-none">
        @elseif(file_exists(public_path('images/foto-santri-3.webp')))
            <img src="{{ asset('images/foto-santri-3.webp') }}"
                 alt="Warta & Kegiatan Santri"
                 class="absolute inset-0 w-full h-full object-cover select-none pointer-events-none">
        @else
            <img src="{{ asset('images/foto santri 3.webp') }}"
                 alt="Warta & Kegiatan Santri"
                 class="absolute inset-0 w-full h-full object-cover select-none pointer-events-none">
        @endif

        <!-- High-Contrast Gradient Overlay for Legibility -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/60 to-black/30"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-transparent to-transparent hidden md:block"></div>

        <!-- Content Positioned Over Full Image -->
        <div class="relative z-10 max-w-2xl space-y-3 text-left">
            <div class="flex flex-wrap items-center gap-2">
                <span class="px-2.5 py-1 rounded-full bg-[#059669] text-white text-[10px] sm:text-xs font-bold uppercase tracking-wider shadow-xs">
                    BERITA TERKINI
                </span>
                <span class="px-2.5 py-1 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-amber-300 text-xs font-semibold">
                    {{ $featuredPost?->category?->name ?? 'Kegiatan Santri' }}
                </span>
                <span class="text-xs text-white/80">
                    &bull; {{ $featuredPost?->published_at?->translatedFormat('d F Y') ?? date('d F Y') }}
                </span>
            </div>

            <h2 class="font-sans text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-white tracking-tight leading-tight line-clamp-2">
                <a href="{{ $featuredPost ? route('news.show', $featuredPost->slug) : route('news.index') }}" class="hover:text-amber-300 transition">
                    {{ $featuredPost?->title ?? 'Warta & Dinamika Kegiatan Santri Daar El Tazkiyah' }}
                </a>
            </h2>

            <p class="text-xs sm:text-sm text-gray-200 line-clamp-2 max-w-xl leading-relaxed">
                {{ $featuredPost?->excerpt ?? Str::limit(strip_tags($featuredPost?->body ?? $featuredPost?->content ?? 'Ikuti seluruh informasi terbaru kegiatan hafalan Al-Qur\'an, agenda pengajian asatidz, dan prestasi santri Daar El Tazkiyah Sumardi.'), 150) }}
            </p>

            <div class="pt-1 sm:pt-2 flex flex-wrap items-center gap-3">
                @if($featuredPost)
                    <a href="{{ route('news.show', $featuredPost->slug) }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-md bg-[#B89758] hover:bg-[#a38347] text-white text-xs sm:text-sm font-bold uppercase tracking-wider transition shadow-sm">
                        <span>Baca Berita Selengkapnya &rarr;</span>
                    </a>
                @endif
                <a href="{{ route('news.index') }}"
                   class="inline-flex items-center px-4 py-2.5 rounded-md bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/30 text-white text-xs sm:text-sm font-semibold uppercase tracking-wider transition">
                    Semua Berita
                </a>
            </div>
        </div>
    </div>
</div>
