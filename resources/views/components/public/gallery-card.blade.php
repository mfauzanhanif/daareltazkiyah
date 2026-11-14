@props([
    'gallery',
])

<a href="{{ route('gallery.index') }}" class="group aspect-square border border-[#E5E0D8] rounded-2xl bg-[#FAF8F5] relative overflow-hidden block hover:border-[#059669]/50 hover:shadow-md transition-all duration-300 shadow-2xs">
    @if(!empty($gallery->cover_image_url) || !empty($gallery->cover_image))
        <img src="{{ $gallery->cover_image_url ?: asset('storage/' . $gallery->cover_image) }}"
             alt="{{ $gallery->title }}"
             loading="lazy"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
    @else
        <div class="w-full h-full bg-[#FAF8F5] flex items-center justify-center text-[#B89758] text-xs text-center p-3">
            <span class="font-sans font-bold text-sm">{{ $gallery->title }}</span>
        </div>
    @endif

    <!-- Photo Count Marker -->
    @if($gallery->photos && $gallery->photos->count() > 0)
        <div class="absolute top-2.5 right-2.5 px-2 py-0.5 rounded-lg bg-[#0D3B2E]/90 text-white text-[10px] font-mono border border-white/20">
            {{ $gallery->photos->count() }} Foto
        </div>
    @endif

    <!-- Overlay Title on Hover -->
    <div class="absolute inset-0 bg-gradient-to-t from-[#042816] via-[#0D3B2E]/90 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-4 flex flex-col justify-end text-white">
        <span class="text-amber-300 block text-[10px] font-bold uppercase tracking-wider">DOKUMENTASI</span>
        <span class="font-sans text-xs md:text-sm font-bold line-clamp-2 leading-snug mt-1">
            {{ $gallery->title }}
        </span>
        @if($gallery->event_date)
            <span class="text-[10px] text-emerald-200 mt-1 font-mono">
                {{ \Carbon\Carbon::parse($gallery->event_date)->translatedFormat('d M Y') }}
            </span>
        @endif
    </div>
</a>
