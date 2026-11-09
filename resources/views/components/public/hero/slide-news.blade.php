@props([
    'featuredPost' => null,
])

<!-- Slide 3: Latest Berita (Warta Terkini) -->
<div class="w-full shrink-0" :inert="currentSlide !== 3" :aria-hidden="currentSlide !== 3">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8 items-center">
        <!-- Left: News Story -->
        <div class="md:col-span-7 flex flex-col justify-center space-y-3 sm:space-y-4 text-left">
            <span class="text-xs font-bold text-[#059669] tracking-wider uppercase">
                WARTA & KABAR TERKINI
            </span>

            @if($featuredPost)
                <div class="space-y-2">
                    <div class="flex items-center gap-2 sm:gap-3 text-xs text-[#4B6358]">
                        <span class="px-2 py-0.5 bg-emerald-50 text-[#084C27] rounded font-semibold text-[11px]">
                            {{ $featuredPost->category?->name ?? 'Warta Utama' }}
                        </span>
                        <span>&bull;</span>
                        <time datetime="{{ $featuredPost->published_at?->toDateString() }}" class="text-[11px] font-medium">
                            {{ $featuredPost->published_at?->translatedFormat('d F Y') ?? date('d M Y') }}
                        </time>
                        <span class="hidden sm:inline">&bull;</span>
                        <span class="hidden sm:inline text-[11px]">Humas Pondok</span>
                    </div>

                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight leading-tight line-clamp-2">
                        <a href="{{ route('news.show', $featuredPost->slug) }}" class="hover:text-[#059669] transition">
                            {{ $featuredPost->title }}
                        </a>
                    </h2>
                </div>

                <p class="text-xs sm:text-sm md:text-base text-[#4B6358] max-w-xl leading-relaxed line-clamp-3">
                    {{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->body ?? $featuredPost->content ?? ''), 180) }}
                </p>

                <!-- Action CTAs -->
                <div class="pt-2 flex items-center gap-3">
                    <a href="{{ route('news.show', $featuredPost->slug) }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition group shadow-xs">
                        <span>Baca Berita Lengkap</span>
                        <span class="group-hover:translate-x-1 transition-transform" aria-hidden="true">&rarr;</span>
                    </a>
                    <a href="{{ route('news.index') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-md border border-[#E5E0D8] bg-white hover:border-[#0D3B2E] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider transition shadow-xs">
                        Semua Berita
                    </a>
                </div>
            @else
                <div class="space-y-2">
                    <h2 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight leading-tight">
                        Warta & Dinamika Santri Daar El Tazkiyah
                    </h2>
                </div>
                <p class="text-xs sm:text-sm md:text-base text-[#4B6358] max-w-xl leading-relaxed">
                    Ikuti seluruh informasi terbaru kegiatan hafalan Al-Qur'an, agenda pengajian asatidz, dan prestasi santri Daar El Tazkiyah Sumardi.
                </p>
                <div class="pt-2">
                    <a href="{{ route('news.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition shadow-xs">
                        <span>Lihat Semua Berita &rarr;</span>
                    </a>
                </div>
            @endif
        </div>

        <!-- Right Visual: News Preview Card -->
        <div class="hidden md:flex md:col-span-5 flex-col items-center">
            <div class="w-full max-w-sm bg-white border border-[#E5E0D8] rounded-md overflow-hidden shadow-sm group">
                <div class="aspect-16/10 relative overflow-hidden bg-[#FAF8F5] border-b border-[#E5E0D8]">
                    @if($featuredPost && $featuredPost->featured_image)
                        <img src="{{ asset('storage/' . $featuredPost->featured_image) }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <x-public.image-placeholder :title="$featuredPost?->title ?? 'Warta Daar El Tazkiyah'" aspect="aspect-16/10" />
                    @endif
                </div>
                <div class="p-4 space-y-1.5">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-[#059669]">SOROTAN UTAMA</span>
                    <h3 class="font-bold text-sm text-[#0D3B2E] leading-snug line-clamp-2">
                        {{ $featuredPost?->title ?? 'Warta & Kegiatan Santri Terbaru' }}
                    </h3>
                    <p class="text-xs text-[#4B6358] line-clamp-2 leading-relaxed">
                        {{ $featuredPost?->excerpt ?? 'Informasi seputar aktivitas harian santri, kajian kitab, dan agenda pondok.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
