<x-layouts::app :title="__('Kelola Dewan Asatidz')">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('Dewan Asatidz & Pengajar') }}</flux:heading>
                <flux:subheading>{{ __('Kelola profil asatidz, pengasuh, dan tenaga pendidik pondok.') }}</flux:subheading>
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
            <!-- Add Teacher Form -->
            <div class="lg:col-span-4 p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4 h-fit">
                <flux:heading size="lg">Tambah Pengajar Baru</flux:heading>
                <form action="{{ route('admin.cms.teachers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold mb-1">Nama Lengkap & Gelar *</label>
                        <input type="text" name="full_name" required placeholder="Contoh: Ust. Muhammad Zaid, Lc." class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Amanah / Jabatan *</label>
                        <input type="text" name="role_title" required placeholder="Contoh: Pembimbing Tahfidz Putri" class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Bidang Keahlian / Spesialisasi</label>
                        <input type="text" name="specialization" placeholder="Contoh: Qira'at Asy'arah, Fiqih" class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Foto Profil</label>
                        <input type="file" name="photo" accept="image/*" class="w-full px-3 py-1.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Biografi Singkat</label>
                        <textarea name="bio" rows="2" placeholder="Latar belakang pendidikan..." class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold mb-1">Urutan Tampil</label>
                            <input type="number" name="sort_order" value="1" min="1" class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                        </div>
                        <div class="flex items-center gap-2 pt-6">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" id="is_active" checked class="rounded border-zinc-300 text-[#084C27] focus:ring-[#084C27]">
                            <label for="is_active" class="text-xs font-medium text-zinc-700 dark:text-zinc-300">Aktif Tampil</label>
                        </div>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-[#084C27] hover:bg-[#059669] text-white text-xs font-semibold rounded-xl transition cursor-pointer">
                        Simpan Data Pengajar
                    </button>
                </form>
            </div>

            <!-- Teachers List Table -->
            <div class="lg:col-span-8 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden">
                <div class="p-6 border-b border-zinc-200 dark:border-zinc-800">
                    <flux:heading size="lg">Daftar Dewan Asatidz</flux:heading>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left">
                        <thead class="bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400 font-semibold border-b border-zinc-200 dark:border-zinc-800">
                            <tr>
                                <th class="p-4">Foto & Nama</th>
                                <th class="p-4">Amanah / Jabatan</th>
                                <th class="p-4">Spesialisasi</th>
                                <th class="p-4">Urutan</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                            @forelse($teachers as $teacher)
                                <tr class="hover:bg-white dark:hover:bg-zinc-800/40 transition">
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-zinc-200 dark:bg-zinc-800 overflow-hidden shrink-0 border border-zinc-300">
                                                @if($teacher->photo_path)
                                                    <img src="{{ asset('storage/' . $teacher->photo_path) }}" alt="{{ $teacher->full_name }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center font-bold text-zinc-400 text-xs">DT</div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-bold text-zinc-900 dark:text-zinc-100">{{ $teacher->full_name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-zinc-600 dark:text-zinc-300">
                                        {{ $teacher->role_title }}
                                    </td>
                                    <td class="p-4 text-zinc-500">
                                        {{ $teacher->specialization ?? '-' }}
                                    </td>
                                    <td class="p-4 text-zinc-500">
                                        #{{ $teacher->sort_order }}
                                    </td>
                                    <td class="p-4">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $teacher->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-zinc-200 text-zinc-700' }}">
                                            {{ $teacher->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-right">
                                        <form action="{{ route('admin.cms.teachers.destroy', $teacher->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data pengajar ini?')">
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
                                    <td colspan="6" class="p-8 text-center text-zinc-400">Belum ada data pengajar yang ditambahkan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t border-zinc-200 dark:border-zinc-800">
                    {{ $teachers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
