@props([
    'post',
])

<article class="bg-[#FDFBF7] rounded-2xl overflow-hidden border border-[#084C27]/10 shadow-xs hover:shadow-card transition-all flex flex-col justify-between group">
    <div>
        <!-- 16:9 Thumbnail -->
        <div class="aspect-video bg-gradient-to-tr from-[#084C27] to-[#059669] relative overflow-hidden">
            @if(!empty($post->featured_image))
                <img src="{{ asset('storage/' . $post->featured_image) }}"
                     alt="{{ $post->title }}"
                     loading="lazy"
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
            @else
                <div class="absolute inset-0 flex items-center justify-center text-white/30 font-serif text-4xl">
                    DT
                </div>
            @endif

            @if($post->category)
                <span class="absolute top-3 left-3 px-3 py-1 rounded-lg bg-[#084C27]/90 backdrop-blur-xs text-white text-[11px] font-semibold shadow-xs">
                    {{ $post->category->name }}
                </span>
            @endif
        </div>

        <!-- Article Content Preview -->
        <div class="p-6 space-y-3">
            <div class="flex items-center gap-3 text-xs text-[#4B6358]">
                <span class="inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-[#059669]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>{{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F Y') }}</span>
                </span>
                <span>&bull;</span>
                <span>{{ $post->estimatedReadTime() }} menit baca</span>
            </div>

            <h3 class="font-serif font-bold text-lg text-[#084C27] group-hover:text-[#059669] transition leading-snug line-clamp-2">
                <a href="{{ route('news.show', $post->slug) }}">{{ $post->title }}</a>
            </h3>

            <p class="text-xs sm:text-sm text-[#4B6358] line-clamp-3 leading-relaxed">
                {{ $post->excerpt ?? Str::limit(strip_tags((string) $post->content), 120) }}
            </p>
        </div>
    </div>

    <!-- Read More CTA -->
    <div class="p-6 pt-0">
        <a href="{{ route('news.show', $post->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#084C27] hover:text-[#059669] transition">
            <span>Baca Selengkapnya</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>
</article>
