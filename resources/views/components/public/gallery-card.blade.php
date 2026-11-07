@props([
    'gallery',
])

<a href="{{ route('gallery.index') }}" class="group aspect-square rounded-2xl overflow-hidden bg-gray-200 relative shadow-xs block">
    @if(!empty($gallery->cover_image))
        <img src="{{ asset('storage/' . $gallery->cover_image) }}"
             alt="{{ $gallery->title }}"
             loading="lazy"
             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
    @else
        <div class="w-full h-full bg-gradient-to-br from-[#084C27] to-[#059669] flex items-center justify-center text-white/50 text-xs text-center p-3">
            <span class="font-serif font-bold text-base text-white/70">{{ $gallery->title }}</span>
        </div>
    @endif

    <!-- Photo Count Badge -->
    @if($gallery->photos && $gallery->photos->count() > 0)
        <div class="absolute top-2.5 right-2.5 px-2 py-0.5 rounded-md bg-black/60 backdrop-blur-xs text-white text-[10px] font-semibold flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <span>{{ $gallery->photos->count() }}</span>
        </div>
    @endif

    <!-- Overlay Title -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 p-4 flex flex-col justify-end">
        <span class="text-white text-xs md:text-sm font-semibold line-clamp-2 leading-snug">
            {{ $gallery->title }}
        </span>
        @if($gallery->event_date)
            <span class="text-[10px] text-emerald-300 mt-1">
                {{ \Carbon\Carbon::parse($gallery->event_date)->translatedFormat('d M Y') }}
            </span>
        @endif
    </div>
</a>
