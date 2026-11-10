@props([
    'post',
])

<article class="bg-white border border-[#E5E0D8] rounded-2xl overflow-hidden hover:border-[#059669]/50 hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
    <div>
        <!-- 16:9 Thumbnail Frame with Slow Zoom -->
        <div class="aspect-video bg-[#FAF8F5] border-b border-[#E5E0D8] relative overflow-hidden">
            @if(!empty($post->featured_image))
                <img src="{{ asset('storage/' . $post->featured_image) }}"
                     alt="{{ $post->title }}"
                     loading="lazy"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
            @else
                <div class="absolute inset-0 flex items-center justify-center text-[#B89758]/25 font-sans text-3xl font-bold bg-[#FDFBF7]">
                    DT
                </div>
            @endif
        </div>

        <!-- Article Content -->
        <div class="p-6 space-y-3">
            <div class="flex items-center justify-between text-xs text-[#4B6358] border-b border-[#E5E0D8]/60 pb-2.5">
                <span class="text-[11px] font-bold uppercase tracking-wider text-[#059669]">
                    {{ $post->category?->name ?? 'Warta Pondok' }}
                </span>
                <time datetime="{{ \Carbon\Carbon::parse($post->published_at)->toDateString() }}" class="font-mono text-[11px] text-[#4B6358]">
                    {{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('d M Y') }}
                </time>
            </div>

            <h3 class="font-sans font-bold text-base sm:text-lg text-[#0D3B2E] group-hover:text-[#059669] transition leading-snug line-clamp-2">
                <a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a>
            </h3>

            <p class="text-xs text-[#4B6358] line-clamp-3 leading-relaxed">
                {{ $post->excerpt ?? Str::limit(strip_tags((string) ($post->content ?? $post->body ?? '')), 120) }}
            </p>
        </div>
    </div>

    <!-- Read More Action -->
    <div class="p-6 pt-0 border-t border-[#E5E0D8]/60 flex items-center justify-between text-xs mt-3">
        <span class="text-[#4B6358] text-[11px]">{{ $post->estimatedReadTime() }} mnt baca</span>
        <a href="{{ route('news.show', $post->slug) }}" class="inline-flex items-center gap-1.5 font-bold text-[#0D3B2E] group-hover:text-[#059669] transition">
            <span>Baca Selengkapnya</span>
            <span aria-hidden="true" class="group-hover:translate-x-1 transition-transform">&rarr;</span>
        </a>
    </div>
</article>
