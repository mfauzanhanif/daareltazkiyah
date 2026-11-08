<x-layouts::app :title="__('Edit Artikel')">
    <div class="space-y-6 max-w-4xl">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('Edit Artikel') }}</flux:heading>
                <flux:subheading>{{ __('Perbarui informasi warta atau pengumuman resmi pondok.') }}</flux:subheading>
            </div>
            <a href="{{ route('admin.cms.posts.index') }}" class="px-4 py-2 bg-zinc-200 hover:bg-zinc-300 text-zinc-800 text-xs font-semibold rounded-xl transition">
                &larr; Kembali
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

        <form action="{{ route('admin.cms.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Judul Artikel *</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Slug URL</label>
                    <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Kategori Artikel</label>
                    <select name="category_id" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27]">
                        <option value="">-- Tanpa Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) === $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Status Publikasi *</label>
                    <select name="status" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27]">
                        <option value="published" @selected(old('status', $post->status->value) === 'published')>Publikasikan Langsung</option>
                        <option value="draft" @selected(old('status', $post->status->value) === 'draft')>Draf (Disimpan Sementara)</option>
                        <option value="scheduled" @selected(old('status', $post->status->value) === 'scheduled')>Terjadwal</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Waktu Publikasi</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('Y-m-d\TH:i') : '') }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27]">
                </div>

                <div class="md:col-span-2 space-y-2">
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Gambar Utama (Featured Image)</label>
                    @if($post->featured_image)
                        <div class="w-32 h-20 rounded-xl overflow-hidden border border-zinc-200">
                            <img src="{{ Illuminate\Support\Str::startsWith($post->featured_image, ['http://', 'https://']) ? $post->featured_image : asset('storage/' . $post->featured_image) }}" alt="Preview" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <input type="file" name="featured_image" accept="image/*" class="w-full px-3.5 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#084C27]/10 file:text-[#084C27]">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Ringkasan / Excerpt</label>
                    <textarea name="excerpt" rows="2" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27]">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Konten Lengkap * (Mendukung format HTML/Paragraf)</label>
                    <textarea name="content" rows="10" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27] font-sans leading-relaxed">{{ old('content', $post->content) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300 mb-1">Meta Description</label>
                    <input type="text" name="meta_description" value="{{ old('meta_description', $post->meta_description) }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-800">
                <a href="{{ route('admin.cms.posts.index') }}" class="px-5 py-2.5 rounded-xl border border-zinc-300 text-xs font-semibold text-zinc-700 hover:bg-zinc-100 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#084C27] hover:bg-[#059669] text-white text-xs font-semibold transition shadow-xs cursor-pointer">
                    Perbarui Artikel
                </button>
            </div>
        </form>
    </div>
</x-layouts::app>
