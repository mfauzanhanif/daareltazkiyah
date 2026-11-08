<x-layouts::app :title="__('Daftar Artikel')">
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <flux:heading size="xl">{{ __('Daftar Artikel Berita') }}</flux:heading>
                <flux:subheading>{{ __('Kelola seluruh artikel, pengumuman, dan warta publik pondok.') }}</flux:subheading>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.cms.posts.create') }}" class="px-4 py-2 bg-[#084C27] hover:bg-[#059669] text-white text-xs font-semibold rounded-xl transition shadow-xs">
                    + Tulis Artikel Baru
                </a>
                <a href="{{ route('admin.cms.dashboard') }}" class="px-4 py-2 bg-zinc-200 hover:bg-zinc-300 text-zinc-800 text-xs font-semibold rounded-xl transition">
                    &larr; Dashboard CMS
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 text-emerald-800 text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-xs text-left">
                    <thead class="bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400 font-semibold border-b border-zinc-200 dark:border-zinc-800">
                        <tr>
                            <th class="p-4">Judul Artikel</th>
                            <th class="p-4">Kategori</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Tanggal Publikasi</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        @forelse($posts as $post)
                            <tr class="hover:bg-white dark:hover:bg-zinc-800/40 transition">
                                <td class="p-4 font-semibold text-zinc-900 dark:text-zinc-100">
                                    <div class="max-w-md truncate">{{ $post->title }}</div>
                                    <span class="text-[10px] text-zinc-400 font-normal">Slug: {{ $post->slug }}</span>
                                </td>
                                <td class="p-4 text-zinc-500">
                                    {{ $post->category?->name ?? '-' }}
                                </td>
                                <td class="p-4">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $post->status->value === 'published' ? 'bg-emerald-100 text-emerald-800' : ($post->status->value === 'scheduled' ? 'bg-amber-100 text-amber-800' : 'bg-zinc-200 text-zinc-700') }}">
                                        {{ $post->status->value }}
                                    </span>
                                </td>
                                <td class="p-4 text-zinc-400">
                                    {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->translatedFormat('d M Y H:i') : '-' }}
                                </td>
                                <td class="p-4 text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('admin.cms.posts.edit', $post->id) }}" class="text-[#059669] hover:underline font-semibold">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.cms.posts.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus artikel ini?')">
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
                                <td colspan="5" class="p-8 text-center text-zinc-400">Belum ada data artikel.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-zinc-200 dark:border-zinc-800">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-layouts::app>
