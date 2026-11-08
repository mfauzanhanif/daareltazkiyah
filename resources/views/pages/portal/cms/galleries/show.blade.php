<x-layouts::app :title="__('Kelola Foto Album')">
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <flux:heading size="xl">{{ $gallery->title }}</flux:heading>
                <flux:subheading>{{ $gallery->event_date ? \Carbon\Carbon::parse($gallery->event_date)->translatedFormat('d F Y') : 'Tanpa Tanggal' }} &bull; {{ $gallery->photos->count() }} Foto Dokumentasi</flux:subheading>
            </div>
            <a href="{{ route('admin.cms.galleries.index') }}" class="px-4 py-2 bg-zinc-200 hover:bg-zinc-300 text-zinc-800 text-xs font-semibold rounded-xl transition">
                &larr; Kembali ke Galeri
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

        <!-- Upload Photos Card -->
        <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4">
            <flux:heading size="lg">Unggah Foto Baru ke Album Ini</flux:heading>
            <form action="{{ route('admin.cms.galleries.photos.store', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                @csrf
                <div class="md:col-span-5">
                    <label class="block text-xs font-semibold mb-1">Pilih File Foto (Bisa lebih dari satu file) *</label>
                    <input type="file" name="photos[]" multiple required accept="image/*" class="w-full px-3 py-1.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#084C27]/10 file:text-[#084C27]">
                </div>
                <div class="md:col-span-5">
                    <label class="block text-xs font-semibold mb-1">Keterangan / Caption Foto (Opsional)</label>
                    <input type="text" name="caption" placeholder="Contoh: Suasana pembukaan acara" class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="w-full py-2.5 bg-[#084C27] hover:bg-[#059669] text-white text-xs font-semibold rounded-xl transition cursor-pointer">
                        Unggah Foto
                    </button>
                </div>
            </form>
        </div>

        <!-- Photos Grid -->
        <div class="space-y-4">
            <flux:heading size="lg">Daftar Foto dalam Album</flux:heading>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @forelse($gallery->photos as $photo)
                    <div class="bg-zinc-50 dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 overflow-hidden group flex flex-col justify-between">
                        <div>
                            <div class="aspect-square bg-zinc-200 dark:bg-zinc-800 overflow-hidden relative">
                                <img src="{{ asset('storage/' . $photo->file_path) }}" alt="{{ $photo->caption ?? 'Foto' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            </div>
                            <div class="p-2.5">
                                <p class="text-[11px] text-zinc-600 dark:text-zinc-300 line-clamp-2 leading-tight">
                                    {{ $photo->caption ?? 'Tanpa keterangan' }}
                                </p>
                            </div>
                        </div>
                        <div class="p-2.5 pt-0 flex justify-end">
                            <form action="{{ route('admin.cms.galleries.photos.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini dari album?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-[10px] font-semibold cursor-pointer">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-12 text-center text-zinc-400 bg-zinc-50 dark:bg-zinc-900 rounded-2xl border border-dashed border-zinc-300">
                        Belum ada foto dalam album ini. Silakan unggah foto di atas.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts::app>
