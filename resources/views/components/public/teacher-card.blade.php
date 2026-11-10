@props([
    'teacher',
])

<div class="bg-white border border-[#E5E0D8] rounded-2xl p-5 hover:border-[#059669]/50 hover:shadow-md transition-all duration-300 flex flex-col justify-between group shadow-2xs">
    <div class="space-y-4">
        <!-- 3:4 Portrait Photo Container -->
        <div class="aspect-3/4 w-full border border-[#E5E0D8] rounded-xl bg-[#FAF8F5] relative overflow-hidden">
            @if(!empty($teacher->photo_path))
                <img src="{{ asset('storage/' . $teacher->photo_path) }}"
                     alt="{{ $teacher->full_name }}"
                     loading="lazy"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
            @else
                <div class="w-full h-full flex flex-col items-center justify-center text-[#B89758]/40 p-4">
                    <svg class="w-16 h-16 fill-current mb-2" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                    <span class="font-sans font-bold text-lg text-[#0D3B2E]/60 tracking-wider">
                        {{ Str::substr($teacher->full_name, 0, 2) }}
                    </span>
                </div>
            @endif

            <!-- Role Label -->
            <div class="absolute bottom-0 inset-x-0 bg-[#0D3B2E]/90 text-white p-2 text-center border-t border-[#B89758]/30">
                <span class="text-amber-200 block text-[10px] font-bold uppercase tracking-wider">
                    {{ $teacher->role_title }}
                </span>
            </div>
        </div>

        <!-- Teacher Information -->
        <div class="text-left space-y-1.5 pt-1">
            <h4 class="font-sans font-bold text-base text-[#0D3B2E] leading-snug group-hover:text-[#059669] transition">
                {{ $teacher->full_name }}
            </h4>
            @if(!empty($teacher->specialization))
                <p class="text-xs text-[#B89758] font-medium">
                    {{ $teacher->specialization }}
                </p>
            @endif
            @if(!empty($teacher->bio))
                <p class="text-xs text-[#4B6358] line-clamp-3 leading-relaxed">
                    {{ $teacher->bio }}
                </p>
            @endif
        </div>
    </div>
</div>
