<x-layouts::app :title="__('Kelola Kategori Artikel')">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('Kategori Artikel & Warta') }}</flux:heading>
                <flux:subheading>{{ __('Kelola taksonomi dan pengelompokan berita pondok.') }}</flux:subheading>
            </div>
            <a href="{{ route('admin.cms.dashboard') }}" class="px-4 py-2 bg-zinc-200 hover:bg-zinc-300 text-zinc-800 text-xs font-semibold rounded-xl transition">
                &larr; Dashboard CMS
            </a>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 text-emerald-800 text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-xl bg-red-50 text-red-700 text-xs space-y-1">
                <div class="font-bold">Terjadi kesalahan validasi:</div>
                <ul class="list-disc pl-4 space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Add Category Form -->
            <div class="lg:col-span-4 p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4 h-fit">
                <flux:heading size="lg">Tambah Kategori Baru</flux:heading>
                <form action="{{ route('admin.cms.categories.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold mb-1">Nama Kategori *</label>
                        <input type="text" name="name" required placeholder="Contoh: Prestasi Santri" class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Slug URL (Opsional)</label>
                        <input type="text" name="slug" placeholder="Otomatis jika dikosongkan" class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Kategori Induk (Parent)</label>
                        <select name="parent_id" class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                            <option value="">-- Tanpa Induk (Root) --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-[#084C27] hover:bg-[#059669] text-white text-xs font-semibold rounded-xl transition cursor-pointer">
                        Simpan Kategori
                    </button>
                </form>
            </div>

            <!-- Categories List Table -->
            <div class="lg:col-span-8 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden">
                <div class="p-6 border-b border-zinc-200 dark:border-zinc-800">
                    <flux:heading size="lg">Daftar Kategori Terdaftar</flux:heading>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400 font-semibold border-b border-zinc-200 dark:border-zinc-800">
                            <tr>
                                <th class="p-4">Nama Kategori</th>
                                <th class="p-4">Slug</th>
                                <th class="p-4">Induk</th>
                                <th class="p-4">Total Artikel</th>
                                <th class="p-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                            @forelse($categories as $category)
                                <tr class="hover:bg-white dark:hover:bg-zinc-800/40 transition">
                                    <td class="p-4 font-bold text-zinc-900 dark:text-zinc-100">
                                        {{ $category->name }}
                                    </td>
                                    <td class="p-4 text-zinc-500 font-mono text-[11px]">
                                        {{ $category->slug }}
                                    </td>
                                    <td class="p-4 text-zinc-400">
                                        {{ $category->parent?->name ?? '-' }}
                                    </td>
                                    <td class="p-4 text-zinc-500">
                                        <span class="px-2 py-0.5 rounded-full bg-zinc-200 dark:bg-zinc-800 text-[10px] font-semibold">
                                            {{ $category->posts_count }} artikel
                                        </span>
                                    </td>
                                    <td class="p-4 text-right">
                                        <form action="{{ route('admin.cms.categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold cursor-pointer">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-zinc-400">Belum ada kategori yang ditambahkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
