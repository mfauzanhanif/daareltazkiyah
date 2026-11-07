<x-layouts::app :title="__('Tambah Artikel Baru')">
    <div class="space-y-6 max-w-4xl">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('Tulis Artikel Baru') }}</flux:heading>
                <flux:subheading>{{ __('Buat berita, artikel kajian, atau pengumuman resmi pondok.') }}</flux:subheading>
            </div>
            <a href="{{ route('admin.cms.posts.index') }}" class="px-4 py-2 bg-zinc-200 hover:bg-zinc-300 text-zinc-800 text-xs font-semibold rounded-xl transition">
                &larr; Kembali
            </a>
        </div>

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

        <form action="{{ route('admin.cms.posts.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Judul Artikel *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Masukkan judul artikel" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Slug URL (Opsional)</label>
                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="Otomatis dari judul jika dikosongkan" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Kategori Artikel</label>
                    <select name="category_id" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27]">
                        <option value="">-- Tanpa Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') === $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Status Publikasi *</label>
                    <select name="status" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27]">
                        <option value="published" @selected(old('status') === 'published')>Publikasikan Langsung</option>
                        <option value="draft" @selected(old('status') === 'draft')>Draf (Disimpan Sementara)</option>
                        <option value="scheduled" @selected(old('status') === 'scheduled')>Terjadwal</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Waktu Publikasi (Opsional)</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27]">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Gambar Utama (Featured Image)</label>
                    <input type="file" name="featured_image" accept="image/*" class="w-full px-3.5 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#084C27]/10 file:text-[#084C27]">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Ringkasan / Excerpt</label>
                    <textarea name="excerpt" rows="2" placeholder="Ringkasan singkat yang tampil di daftar artikel" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27]">{{ old('excerpt') }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Konten Lengkap * (Mendukung format HTML/Paragraf)</label>
                    <textarea name="content" rows="10" required placeholder="Tuliskan isi artikel lengkap..." class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27] font-sans leading-relaxed">{{ old('content') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Meta Title (SEO & WhatsApp)</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title') }}" placeholder="Judul khusus untuk sharing sosial media" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Meta Description (SEO & WhatsApp)</label>
                    <input type="text" name="meta_description" value="{{ old('meta_description') }}" placeholder="Deskripsi khusus untuk sharing sosial media" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-800">
                <a href="{{ route('admin.cms.posts.index') }}" class="px-5 py-2.5 rounded-xl border border-zinc-300 text-xs font-semibold text-zinc-700 hover:bg-zinc-100 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#084C27] hover:bg-[#059669] text-white text-xs font-semibold transition shadow-xs cursor-pointer">
                    Simpan & Terbitkan Artikel
                </button>
            </div>
        </form>
    </div>
</x-layouts::app>
