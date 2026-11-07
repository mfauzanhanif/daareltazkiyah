<div>
    <!-- Filter & Search Bar -->
    <div class="bg-white p-5 rounded-2xl border border-[#084C27]/10 shadow-xs mb-10 flex flex-col md:flex-row gap-4 items-center justify-between">
        <!-- Categories Pills -->
        <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 text-xs font-semibold scrollbar-none">
            <button type="button"
                    wire:click="setCategory('')"
                    class="px-4 py-2 rounded-xl transition cursor-pointer {{ $category === '' ? 'bg-[#084C27] text-white shadow-xs' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Semua Kategori
            </button>
            @foreach($categories as $cat)
                <button type="button"
                        wire:click="setCategory('{{ $cat->slug }}')"
                        class="px-4 py-2 rounded-xl transition whitespace-nowrap cursor-pointer {{ $category === $cat->slug ? 'bg-[#084C27] text-white shadow-xs' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $cat->name }} ({{ $cat->posts_count }})
                </button>
            @endforeach
        </div>

        <!-- Search Input -->
        <div class="w-full md:w-72 flex items-center gap-2">
            <div class="relative w-full">
                <input type="text"
                       wire:model.live.debounce.300ms="search"
                       placeholder="Cari artikel..."
                       class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-gray-200 focus:border-[#084C27] focus:ring-1 focus:ring-[#084C27] outline-hidden">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            @if($search !== '' || $category !== '')
                <button type="button"
                        wire:click="resetFilters"
                        class="px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-xl transition shrink-0 cursor-pointer"
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
            <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-dashed border-[#084C27]/20 space-y-3">
                <div class="w-14 h-14 rounded-2xl bg-[#084C27]/5 text-[#084C27] flex items-center justify-center mx-auto">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <h3 class="font-serif font-bold text-base text-[#084C27]">Tidak Ada Artikel Ditemukan</h3>
                <p class="text-[#4B6358] text-xs max-w-sm mx-auto">Tidak ada artikel berita yang cocok dengan kata kunci atau kategori yang Anda pilih.</p>
                <button type="button"
                        wire:click="resetFilters"
                        class="inline-block mt-2 px-4 py-2 rounded-xl bg-[#084C27] text-white text-xs font-semibold hover:bg-[#059669] transition cursor-pointer">
                    Reset Filter
                </button>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12 flex justify-center">
        {{ $posts->links() }}
    </div>
</div>
