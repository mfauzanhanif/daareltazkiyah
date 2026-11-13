<x-layouts::app :title="__('Data Calon Santri PSB')">
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <flux:heading size="xl">{{ __('Manajemen Pendaftar PSB') }}</flux:heading>
                <flux:subheading>{{ __('Daftar calon santri baru yang telah mengisi formulir registrasi online.') }}
                </flux:subheading>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.psb.export', request()->query()) }}"
                    class="px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold rounded-xl transition shadow-xs flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Export Excel (.xlsx)</span>
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 text-emerald-800 text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filter & Search Bar -->
        <div
            class="bg-zinc-50 dark:bg-zinc-900 p-4 rounded-2xl border border-zinc-200 dark:border-zinc-800 flex flex-wrap gap-3 items-center justify-between">
            <form method="GET" action="{{ route('admin.psb.applicants.index') }}"
                class="flex flex-wrap items-center gap-3 w-full">
                <!-- Search input -->
                <div class="w-full sm:w-64">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, NIK, no registrasi..."
                        class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                </div>

                <!-- Program filter -->
                <div>
                    <select name="program"
                        class="px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                        <option value="">Semua Program</option>
                        <option value="MTS" {{ request('program') === 'MTS' ? 'selected' : '' }}>MTS</option>
                        <option value="MDTA" {{ request('program') === 'MDTA' ? 'selected' : '' }}>MDTA</option>
                    </select>
                </div>

                <!-- Status filter -->
                <div>
                    <select name="status"
                        class="px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                        <option value="">Semua Status Berkas</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Verified
                        </option>
                        <option value="revision_needed"
                            {{ request('status') === 'revision_needed' ? 'selected' : '' }}>Perlu Revisi</option>
                        <option value="accepted" {{ request('status') === 'accepted' ? 'selected' : '' }}>Diterima
                        </option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak
                        </option>
                    </select>
                </div>

                <button type="submit"
                    class="px-4 py-2 bg-[#084C27] hover:bg-[#059669] text-white text-xs font-semibold rounded-xl transition">
                    Filter
                </button>

                @if (request()->hasAny(['search', 'program', 'status']))
                    <a href="{{ route('admin.psb.applicants.index') }}" class="text-xs text-zinc-500 hover:underline">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table -->
        <div
            class="rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-xs text-left">
                    <thead
                        class="bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400 font-semibold border-b border-zinc-200 dark:border-zinc-800">
                        <tr>
                            <th class="p-4">No. Registrasi</th>
                            <th class="p-4">Nama Lengkap</th>
                            <th class="p-4">NIK</th>
                            <th class="p-4">Program</th>
                            <th class="p-4">Orang Tua / Kontak</th>
                            <th class="p-4">Status Berkas</th>
                            <th class="p-4">Status Bayar</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        @forelse($applicants as $applicant)
                            <tr class="hover:bg-white dark:hover:bg-zinc-800/40 transition">
                                <td class="p-4 font-mono font-bold text-[#084C27] dark:text-emerald-400">
                                    {{ $applicant->registration_number }}
                                </td>
                                <td class="p-4 font-semibold text-zinc-900 dark:text-zinc-100">
                                    {{ $applicant->full_name }}
                                </td>
                                <td class="p-4 font-mono text-zinc-500">
                                    {{ $applicant->nik }}
                                </td>
                                <td class="p-4">
                                    <span
                                        class="px-2 py-0.5 rounded-md font-bold text-[10px] {{ ($applicant->program_type->value ?? $applicant->program_type) === 'MTS' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $applicant->program_type->value ?? $applicant->program_type }}
                                    </span>
                                </td>
                                <td class="p-4 text-zinc-600 dark:text-zinc-400">
                                    <div>{{ $applicant->parent?->father_name ?? '-' }}</div>
                                    <div class="text-[10px] text-zinc-400 font-mono">
                                        {{ $applicant->parent?->parent_phone ?? '-' }}</div>
                                </td>
                                <td class="p-4">
                                    <span
                                        class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-gray-100 text-gray-800">
                                        {{ $applicant->application_status->value ?? $applicant->application_status }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span
                                        class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ ($applicant->payment_status->value ?? $applicant->payment_status) === 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $applicant->payment_status->value ?? $applicant->payment_status }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('admin.psb.applicants.show', $applicant->id) }}"
                                        class="px-3 py-1 bg-[#084C27] hover:bg-[#059669] text-white text-[11px] font-semibold rounded-lg transition inline-block">
                                        Review
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-8 text-center text-zinc-400">Tidak ada data calon santri
                                    yang sesuai kriteria.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-zinc-200 dark:border-zinc-800">
                {{ $applicants->links() }}
            </div>
        </div>
    </div>
</x-layouts::app>
