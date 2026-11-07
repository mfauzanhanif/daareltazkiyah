<x-layouts::app :title="__('Panel CMS & Konten')">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('Manajemen Konten & Warta') }}</flux:heading>
                <flux:subheading>{{ __('Kelola publikasi artikel berita, pengumuman, dokumentasi galeri, dan data pengajar.') }}</flux:subheading>
            </div>
            <a href="{{ route('admin.cms.posts.index') }}" class="px-4 py-2 bg-[#084C27] hover:bg-[#059669] text-white text-xs font-semibold rounded-xl transition shadow-xs">
                Kelola Artikel &rarr;
            </a>
        </div>

        <!-- Metrics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-5 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-1">
                <span class="text-xs text-zinc-500 font-medium">Total Artikel</span>
                <div class="text-2xl font-bold text-[#084C27] dark:text-emerald-400">{{ $postsCount }}</div>
            </div>
            <div class="p-5 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-1">
                <span class="text-xs text-zinc-500 font-medium">Album Galeri</span>
                <div class="text-2xl font-bold text-[#D97706]">{{ $galleriesCount }}</div>
            </div>
            <div class="p-5 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-1">
                <span class="text-xs text-zinc-500 font-medium">Dewan Asatidz</span>
                <div class="text-2xl font-bold text-emerald-600">{{ $teachersCount }}</div>
            </div>
            <div class="p-5 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-1">
                <span class="text-xs text-zinc-500 font-medium">Kategori Artikel</span>
                <div class="text-2xl font-bold text-zinc-700 dark:text-zinc-300">{{ $categoriesCount }}</div>
            </div>
        </div>

        <!-- Quick Post Create & Recent List -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Form Card -->
            <div class="lg:col-span-5 p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4">
                <flux:heading size="lg">Tambah Artikel Baru</flux:heading>
                <form action="{{ route('admin.cms.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold mb-1">Judul Artikel *</label>
                        <input type="text" name="title" required class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Status Publikasi</label>
                        <select name="status" class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                            <option value="published">Langsung Publikasikan</option>
                            <option value="draft">Simpan Draf</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Ringkasan / Excerpt</label>
                        <textarea name="excerpt" rows="2" class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800"></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Konten Lengkap *</label>
                        <textarea name="content" rows="4" required class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800"></textarea>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-[#084C27] hover:bg-[#059669] text-white text-xs font-semibold rounded-xl transition">
                        Simpan Artikel
                    </button>
                </form>
            </div>

            <!-- Recent Posts List -->
            <div class="lg:col-span-7 p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4">
                <flux:heading size="lg">Artikel Terkini</flux:heading>
                <div class="divide-y divide-zinc-200 dark:divide-zinc-800 text-xs">
                    @forelse($recentPosts as $post)
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <h4 class="font-bold text-zinc-900 dark:text-zinc-100">{{ $post->title }}</h4>
                                <span class="text-zinc-400">{{ \Carbon\Carbon::parse($post->published_at ?? $post->created_at)->translatedFormat('d F Y') }}</span>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $post->status->value === 'published' ? 'bg-emerald-100 text-emerald-800' : 'bg-zinc-200 text-zinc-700' }}">
                                {{ $post->status->value }}
                            </span>
                        </div>
                    @empty
                        <div class="py-6 text-center text-zinc-400">Belum ada artikel.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
