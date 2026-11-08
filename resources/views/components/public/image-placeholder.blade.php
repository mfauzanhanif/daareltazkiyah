@props([
    'title' => 'Daar El Tazkiyah',
    'aspect' => 'aspect-4/3',
])

<div {{ $attributes->merge(['class' => "relative {$aspect} w-full bg-gradient-to-br from-[#0D3B2E] via-[#084C27] to-[#042816] rounded-md overflow-hidden flex flex-col items-center justify-center p-4 border border-[#B89758]/30 select-none"]) }}>
    <!-- Subtle geometric background overlay -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <defs>
                <pattern id="arch-pattern" width="20" height="20" patternUnits="userSpaceOnUse">
                    <path d="M 10,0 L 20,10 L 10,20 L 0,10 Z" fill="none" stroke="#D97706" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#arch-pattern)"/>
        </svg>
    </div>

    <!-- Center Logo & Branding -->
    <div class="relative z-10 flex flex-col items-center text-center space-y-2">
        <img src="{{ asset('images/logo_daar_el_tazkiyah.svg') }}"
            alt="Logo Daar El Tazkiyah"
            class="w-12 h-12 sm:w-16 sm:h-16 object-contain opacity-90 drop-shadow-md"
            onerror="this.onerror=null; this.src='{{ asset('images/logo_daar_el_tazkiyah.png') }}';">
        <div class="space-y-0.5">
            <span class="text-[10px] sm:text-xs font-semibold text-amber-200 tracking-wider uppercase block">
                {{ $title }}
            </span>
            <span class="text-[9px] text-emerald-200/80 block font-arabic" dir="rtl">
                معهد دار التزكية سوماردي
            </span>
        </div>
    </div>
</div>
