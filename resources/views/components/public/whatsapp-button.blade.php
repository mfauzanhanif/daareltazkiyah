@props([
    'waNumber' => null,
])

@php
    $waNumber = $waNumber ?? \App\Models\SiteSetting::get('psb_whatsapp_number', '6281234567890');
    $cleanPhone = preg_replace('/[^0-9]/', '', (string) $waNumber);
    $defaultMessage = urlencode('Assalamu\'alaikum Panitia PSB PPMTQ Daar El Tazkiyah, saya ingin bertanya seputar pendaftaran santri baru.');
@endphp

<aside aria-label="Kontak WhatsApp Panitia PSB" class="fixed bottom-6 right-6 z-50">
    <div class="relative group">
        <!-- Pulsing ambient glow animation ring -->
        <span class="absolute -inset-1 rounded-full bg-[#25D366]/40 animate-ping opacity-75 pointer-events-none"></span>

        <!-- 56x56px Circular WhatsApp Action Button -->
        <a href="https://wa.me/{{ $cleanPhone }}?text={{ $defaultMessage }}"
           target="_blank"
           rel="noopener noreferrer"
           class="relative w-14 h-14 rounded-full bg-[#25D366] hover:bg-[#20ba59] text-white flex items-center justify-center shadow-elevated hover:shadow-glow-amber transition-all transform hover:scale-110 active:scale-95 focus:outline-hidden focus:ring-4 focus:ring-[#25D366]/50"
           title="Hubungi Panitia PSB via WhatsApp ({{ $waNumber }})"
           aria-label="Chat WhatsApp Panitia PSB {{ $waNumber }}">
            <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24">
                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.664-.698c.974.57 1.77.879 2.801.88h.005c3.179 0 5.766-2.587 5.767-5.766.001-3.181-2.585-5.767-5.777-5.767zm7.537 5.764c-.002 4.156-3.383 7.537-7.542 7.537-1.325-.001-2.571-.351-3.666-.999l-4.088 1.072 1.091-3.987c-.714-1.144-1.095-2.476-1.094-3.843.003-4.156 3.385-7.537 7.545-7.537 4.159.001 7.543 3.382 7.544 7.541l.21-.004zm-10.428-2.31c-.139-.307-.285-.313-.418-.319-.108-.005-.232-.005-.357-.005-.125 0-.327.046-.499.233-.172.187-.655.641-.655 1.562s.67 1.812.763 1.937c.094.125 1.319 2.014 3.195 2.825.446.193.795.308 1.066.394.448.143.856.123 1.178.075.359-.054 1.107-.453 1.263-.89.156-.437.156-.812.11-.89-.047-.078-.172-.125-.359-.219-.187-.094-1.107-.546-1.279-.609-.172-.062-.297-.094-.422.094-.125.187-.484.609-.593.734-.109.125-.219.14-.406.047-.187-.094-.79-.291-1.505-.929-.556-.497-.932-1.111-1.041-1.298-.109-.187-.012-.288.082-.381.084-.084.187-.219.281-.328.094-.109.125-.187.187-.312.062-.125.031-.234-.016-.328-.046-.094-.418-1.008-.578-1.38z"/>
            </svg>
            <span class="sr-only">{{ $waNumber }}</span>
        </a>

        <!-- Desktop Tooltip Hover Bubble -->
        <div class="hidden md:group-hover:flex absolute right-16 top-1/2 -translate-y-1/2 bg-[#084C27] text-white text-xs font-semibold px-3 py-1.5 rounded-lg shadow-lg whitespace-nowrap items-center gap-1.5 pointer-events-none transition-all">
            <span>Tanya Panitia ({{ $waNumber }})</span>
            <div class="w-2 h-2 bg-[#084C27] rotate-45 absolute -right-1 top-1/2 -translate-y-1/2"></div>
        </div>
    </div>
</aside>
