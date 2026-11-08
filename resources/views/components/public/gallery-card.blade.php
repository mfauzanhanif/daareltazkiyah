@props([
    'gallery',
])

<a href="{{ route('gallery.index') }}" class="group aspect-square border border-[#E5E0D8] bg-[#FAF8F5] relative overflow-hidden block hover:border-[#0D3B2E] transition">
    @if(!empty($gallery->cover_image))
        <img src="{{ asset('storage/' . $gallery->cover_image) }}"
             alt="{{ $gallery->title }}"
             loading="lazy"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
    @else
        <div class="w-full h-full bg-[#FAF8F5] flex items-center justify-center text-[#B89758] text-xs text-center p-3">
            <span class="font-serif font-bold text-sm">{{ $gallery->title }}</span>
        </div>
    @endif

    <!-- Photo Count Marker (Editorial Style) -->
    @if($gallery->photos && $gallery->photos->count() > 0)
        <div class="absolute top-2 right-2 px-2 py-0.5 bg-[#0D3B2E] text-white text-[10px] font-mono border border-white/20">
            {{ $gallery->photos->count() }} Foto
        </div>
    @endif

    <!-- Overlay Title on Hover -->
    <div class="absolute inset-0 bg-[#0D3B2E]/90 opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-4 flex flex-col justify-end text-white">
        <span class="editorial-label text-amber-300 block text-[10px]">DOKUMENTASI</span>
        <span class="font-serif text-xs md:text-sm font-bold line-clamp-2 leading-snug mt-1">
            {{ $gallery->title }}
        </span>
        @if($gallery->event_date)
            <span class="text-[10px] text-emerald-200 mt-1 font-mono">
                {{ \Carbon\Carbon::parse($gallery->event_date)->translatedFormat('d M Y') }}
            </span>
        @endif
    </div>
</a>
