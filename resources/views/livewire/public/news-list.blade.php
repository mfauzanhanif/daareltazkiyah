<div>
    <!-- Filter & Search Bar (Editorial Hairline Layout) -->
    <div class="bg-white p-5 border border-stone-hairline rounded-md mb-10 flex flex-col md:flex-row gap-4 items-center justify-between">

        <!-- Categories Filter (Editorial Tab/Box) -->
        <div
            class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 text-xs font-semibold scrollbar-none">
            <button type="button" wire:click="setCategory('')"
                class="px-4 py-2 rounded-md border transition cursor-pointer uppercase tracking-wider {{ $category === '' ? 'border-stone-hairline bg-deep-forest text-white' : 'border-[#E5E0D8] bg-[#FAF8F5] text-[#4B6358] hover:border-[#0D3B2E]' }}">
                Semua Kategori
            </button>
            @foreach ($categories as $cat)
                <button type="button" wire:click="setCategory('{{ $cat->slug }}')"
                    class="px-4 py-2 rounded-md border transition whitespace-nowrap cursor-pointer uppercase tracking-wider {{ $category === $cat->slug ? 'border-[#0D3B2E] bg-[#0D3B2E] text-white' : 'border-[#E5E0D8] bg-[#FAF8F5] text-[#4B6358] hover:border-[#0D3B2E]' }}">
                    {{ $cat->name }} ({{ $cat->posts_count }})
                </button>
            @endforeach
        </div>

        <!-- Search Input -->
        <div class="w-full md:w-72 flex items-center gap-2">
            <div class="relative w-full">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari arsip artikel..."
                    class="w-full pl-9 pr-4 py-2 text-xs rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] focus:outline-none bg-[#FAF8F5]">
                <svg class="w-4 h-4 text-[#4B6358] absolute left-3 top-2.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            @if ($search !== '' || $category !== '')
                <button type="button" wire:click="resetFilters"
                    class="px-3 py-2 rounded-md border border-[#E5E0D8] bg-[#FAF8F5] hover:bg-white text-[#0D3B2E] text-xs font-semibold uppercase tracking-wider transition shrink-0 cursor-pointer"
                    title="Reset pencarian dan filter">
                    Reset
                </button>
            @endif
        </div>
    </div>

    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <x-public.news-card :post="$post" />
        @empty
            <div class="col-span-full text-center py-16 bg-white border border-[#E5E0D8] rounded-md space-y-3 p-8">
                <span class="editorial-label text-[#B89758]">ARSIP TIDAK DITEMUKAN</span>
                <h3 class="font-sans text-lg text-[#0D3B2E] font-bold">
                    Tidak Ada Artikel Ditemukan
                </h3>
                <p class="text-xs text-[#4B6358]">
                    Silakan gunakan kata kunci pencarian yang lain atau reset filter kategori.
                </p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($posts->hasPages())
        <div class="mt-12 bg-white border border-[#E5E0D8] rounded-md p-4">
            {{ $posts->links() }}
        </div>
    @endif
</div>
