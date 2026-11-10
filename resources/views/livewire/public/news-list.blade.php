<div>
    <!-- Filter & Search Bar -->
    <div class="bg-white p-4 sm:p-5 border border-[#E5E0D8] rounded-2xl mb-10 shadow-xs flex flex-col md:flex-row gap-4 items-center justify-between">

        <!-- Categories Filter Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 text-xs font-semibold scrollbar-none">
            <button type="button" wire:click="setCategory('')"
                class="px-4 py-2 rounded-full border transition cursor-pointer uppercase tracking-wider whitespace-nowrap {{ $category === '' ? 'border-[#0D3B2E] bg-[#0D3B2E] text-white shadow-xs' : 'border-[#E5E0D8] bg-[#FAF8F5] text-[#4B6358] hover:border-[#0D3B2E]' }}">
                Semua Kategori
            </button>
            @foreach ($categories as $cat)
                <button type="button" wire:click="setCategory('{{ $cat->slug }}')"
                    class="px-4 py-2 rounded-full border transition whitespace-nowrap cursor-pointer uppercase tracking-wider {{ $category === $cat->slug ? 'border-[#0D3B2E] bg-[#0D3B2E] text-white shadow-xs' : 'border-[#E5E0D8] bg-[#FAF8F5] text-[#4B6358] hover:border-[#0D3B2E]' }}">
                    {{ $cat->name }} ({{ $cat->posts_count }})
                </button>
            @endforeach
        </div>

        <!-- Search Input -->
        <div class="w-full md:w-80 flex items-center gap-2">
            <div class="relative w-full">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari arsip artikel..."
                    class="w-full pl-9 pr-4 py-2.5 text-xs rounded-xl border border-[#E5E0D8] bg-[#FAF8F5] focus:bg-white focus:border-[#059669] focus:outline-none transition">
                <svg class="w-4 h-4 text-[#4B6358] absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            @if ($search !== '' || $category !== '')
                <button type="button" wire:click="resetFilters"
                    class="px-3.5 py-2.5 rounded-xl border border-[#E5E0D8] bg-[#FAF8F5] hover:bg-white text-[#0D3B2E] text-xs font-semibold uppercase tracking-wider transition shrink-0 cursor-pointer shadow-2xs"
                    title="Reset pencarian dan filter">
                    Reset
                </button>
            @endif
        </div>
    </div>

    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @forelse($posts as $post)
            <x-public.news-card :post="$post" />
        @empty
            <div class="col-span-full text-center py-16 bg-white border border-[#E5E0D8] rounded-2xl shadow-xs space-y-3 p-8">
                <span class="text-xs font-semibold uppercase tracking-widest text-[#B89758]">ARSIP TIDAK DITEMUKAN</span>
                <h3 class="font-sans text-lg text-[#0D3B2E] font-bold">
                    Tidak Ada Artikel Ditemukan
                </h3>
                <p class="text-xs text-[#4B6358] max-w-md mx-auto">
                    Silakan gunakan kata kunci pencarian yang lain atau tekan tombol reset pada filter kategori.
                </p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($posts->hasPages())
        <div class="mt-12 bg-white border border-[#E5E0D8] rounded-2xl p-4 shadow-xs">
            {{ $posts->links() }}
        </div>
    @endif
</div>
