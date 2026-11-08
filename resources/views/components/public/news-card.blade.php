@props([
    'post',
])

<article class="bg-white border border-[#E5E0D8] overflow-hidden hover:border-[#0D3B2E] transition-all flex flex-col justify-between group">
    <div>
        <!-- 16:9 Thumbnail Frame with Slow Zoom -->
        <div class="aspect-video bg-[#FAF8F5] border-b border-[#E5E0D8] relative overflow-hidden">
            @if(!empty($post->featured_image))
                <img src="{{ asset('storage/' . $post->featured_image) }}"
                     alt="{{ $post->title }}"
                     loading="lazy"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
            @else
                <div class="absolute inset-0 flex items-center justify-center text-[#B89758]/30 font-serif text-3xl font-bold">
                    DT
                </div>
            @endif
        </div>

        <!-- Article Content -->
        <div class="p-6 space-y-3">
            <div class="flex items-center justify-between text-xs text-[#4B6358] border-b border-[#E5E0D8] pb-2">
                @if($post->category)
                    <span class="editorial-label text-[#059669]">
                        {{ $post->category->name }}
                    </span>
                @else
                    <span class="editorial-label text-[#059669]">WARTA PONDOK</span>
                @endif
                <time datetime="{{ \Carbon\Carbon::parse($post->published_at)->toDateString() }}" class="font-mono text-[11px]">
                    {{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('d M Y') }}
                </time>
            </div>

            <h3 class="font-serif font-bold text-lg text-[#0D3B2E] group-hover:text-[#059669] transition leading-snug line-clamp-2">
                <a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a>
            </h3>

            <p class="text-xs text-[#4B6358] line-clamp-3 leading-relaxed">
                {{ $post->excerpt ?? Str::limit(strip_tags((string) ($post->content ?? $post->body ?? '')), 120) }}
            </p>
        </div>
    </div>

    <!-- Read More Action -->
    <div class="p-6 pt-0 border-t border-[#E5E0D8] flex items-center justify-between text-xs">
        <span class="text-[#4B6358] text-[11px]">{{ $post->estimatedReadTime() }} mnt baca</span>
        <a href="{{ route('news.show', $post->slug) }}" class="inline-flex items-center gap-1 font-semibold text-[#0D3B2E] hover:text-[#059669] transition group-hover:translate-x-0.5">
            <span>Baca Selengkapnya</span>
            <span aria-hidden="true">&rarr;</span>
        </a>
    </div>
</article>
