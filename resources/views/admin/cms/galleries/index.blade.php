<x-layouts::app :title="__('Kelola Galeri Foto')">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('Galeri Foto Dokumentasi') }}</flux:heading>
                <flux:subheading>{{ __('Kelola album dan dokumentasi visual kegiatan santri pondok.') }}</flux:subheading>
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
            <!-- Create Album Form -->
            <div class="lg:col-span-4 p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4 h-fit">
                <flux:heading size="lg">Buat Album Baru</flux:heading>
                <form action="{{ route('admin.cms.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold mb-1">Judul Album *</label>
                        <input type="text" name="title" required placeholder="Contoh: Wisuda Tahfidz 2027" class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Slug URL (Opsional)</label>
                        <input type="text" name="slug" placeholder="Otomatis dari judul jika kosong" class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Tanggal Kegiatan</label>
                        <input type="date" name="event_date" value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Foto Sampul (Cover)</label>
                        <input type="file" name="cover_image" accept="image/*" class="w-full px-3 py-1.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Deskripsi Singkat</label>
                        <textarea name="description" rows="2" placeholder="Catatan atau keterangan kegiatan..." class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800"></textarea>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" name="is_published" value="1" id="is_published" checked class="rounded border-zinc-300 text-[#084C27] focus:ring-[#084C27]">
                        <label for="is_published" class="text-xs font-medium text-zinc-700 dark:text-zinc-300">Publikasikan ke Website</label>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-[#084C27] hover:bg-[#059669] text-white text-xs font-semibold rounded-xl transition cursor-pointer">
                        Buat Album Galeri
                    </button>
                </form>
            </div>

            <!-- Albums List -->
            <div class="lg:col-span-8 space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse($galleries as $gallery)
                        <div class="bg-zinc-50 dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 overflow-hidden flex flex-col justify-between">
                            <div>
                                <div class="aspect-video bg-zinc-200 dark:bg-zinc-800 relative overflow-hidden">
                                    @if($gallery->cover_image)
                                        <img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-zinc-400 font-bold text-lg">Tanpa Sampul</div>
                                    @endif
                                    <span class="absolute top-2 right-2 px-2 py-0.5 rounded-full bg-black/60 text-white text-[10px] font-semibold">
                                        {{ $gallery->photos_count }} Foto
                                    </span>
                                </div>
                                <div class="p-4 space-y-1">
                                    <span class="text-[10px] text-zinc-400 block">{{ $gallery->event_date ? \Carbon\Carbon::parse($gallery->event_date)->translatedFormat('d F Y') : 'Tanpa Tanggal' }}</span>
                                    <h4 class="font-bold text-sm text-zinc-900 dark:text-zinc-100 line-clamp-1">{{ $gallery->title }}</h4>
                                    @if($gallery->description)
                                        <p class="text-xs text-zinc-500 line-clamp-2">{{ $gallery->description }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="p-4 pt-0 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between mt-3 text-xs">
                                <a href="{{ route('admin.cms.galleries.show', $gallery->id) }}" class="text-[#059669] hover:underline font-semibold flex items-center gap-1">
                                    <span>Kelola Foto</span> &rarr;
                                </a>
                                <form action="{{ route('admin.cms.galleries.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Hapus album ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold cursor-pointer">Hapus</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 p-12 text-center text-zinc-400 bg-zinc-50 dark:bg-zinc-900 rounded-2xl border border-dashed border-zinc-300">
                            Belum ada album galeri yang dibuat.
                        </div>
                    @endforelse
                </div>
                <div>
                    {{ $galleries->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
