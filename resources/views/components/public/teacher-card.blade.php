@props([
    'teacher',
])

<div class="bg-white rounded-2xl p-5 border border-[#084C27]/10 shadow-xs hover:shadow-card hover:border-[#059669]/30 transition-all flex flex-col justify-between group">
    <div class="space-y-4">
        <!-- 3:4 Portrait Photo Container -->
        <div class="aspect-[3/4] w-full rounded-xl overflow-hidden bg-gradient-to-tr from-[#084C27] to-[#059669] relative shadow-inner">
            @if(!empty($teacher->photo_path))
                <img src="{{ asset('storage/' . $teacher->photo_path) }}"
                     alt="{{ $teacher->full_name }}"
                     loading="lazy"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            @else
                <div class="w-full h-full flex flex-col items-center justify-center text-white/40 p-4">
                    <svg class="w-20 h-20 fill-current mb-2" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    <span class="font-serif font-bold text-xl text-white/60 tracking-wider">
                        {{ Str::substr($teacher->full_name, 0, 2) }}
                    </span>
                </div>
            @endif

            <!-- Role Badge Overlay -->
            <div class="absolute bottom-2.5 left-2.5 right-2.5">
                <span class="inline-block px-3 py-1 rounded-lg bg-[#084C27]/90 backdrop-blur-xs text-white text-[11px] font-semibold shadow-xs">
                    {{ $teacher->role_title }}
                </span>
            </div>
        </div>

        <!-- Teacher Information -->
        <div class="text-left space-y-1">
            <h4 class="font-serif font-bold text-base text-[#084C27] leading-snug group-hover:text-[#059669] transition">
                {{ $teacher->full_name }}
            </h4>
            @if(!empty($teacher->specialization))
                <p class="text-xs text-[#D97706] font-semibold">
                    {{ $teacher->specialization }}
                </p>
            @endif
            @if(!empty($teacher->bio))
                <p class="text-xs text-[#4B6358] line-clamp-3 leading-relaxed pt-1">
                    {{ $teacher->bio }}
                </p>
            @endif
        </div>
    </div>
</div>
