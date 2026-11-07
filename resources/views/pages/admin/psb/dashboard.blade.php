<x-layouts::app :title="__('Dashboard Panitia PSB')">
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <flux:heading size="xl">{{ __('Dashboard Panitia PSB') }}</flux:heading>
                <flux:subheading>{{ __('Ringkasan statistik calon santri baru dan verifikasi berkas.') }}</flux:subheading>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.psb.export') }}" class="px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold rounded-xl transition shadow-xs flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Export Excel (.xlsx)</span>
                </a>
                <a href="{{ route('admin.psb.applicants.index') }}" class="px-4 py-2 bg-[#084C27] hover:bg-[#059669] text-white text-xs font-semibold rounded-xl transition shadow-xs">
                    Kelola Pendaftar &rarr;
                </a>
            </div>
        </div>

        <!-- Metrics Overview Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Pendaftar -->
            <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-1">
                <span class="text-xs text-zinc-500 font-semibold uppercase tracking-wider">Total Pendaftar</span>
                <div class="text-3xl font-extrabold text-[#084C27] dark:text-emerald-400">{{ $totalApplicants }}</div>
                <p class="text-[11px] text-zinc-400">Seluruh gelombang TA aktif</p>
            </div>

            <!-- MTS Pendaftar -->
            <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-1">
                <span class="text-xs text-zinc-500 font-semibold uppercase tracking-wider">Program MTS (Mukim)</span>
                <div class="text-3xl font-extrabold text-emerald-600">{{ $mtsCount }}</div>
                <p class="text-[11px] text-zinc-400">Calon santri jenjang MTS</p>
            </div>

            <!-- MDTA Pendaftar -->
            <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-1">
                <span class="text-xs text-zinc-500 font-semibold uppercase tracking-wider">Program MDTA (Sekolah Sore)</span>
                <div class="text-3xl font-extrabold text-[#D97706]">{{ $mdtaCount }}</div>
                <p class="text-[11px] text-zinc-400">Calon santri non-mukim</p>
            </div>

            <!-- Verifikasi & Pembayaran -->
            <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-1">
                <span class="text-xs text-zinc-500 font-semibold uppercase tracking-wider">Berkas Terverifikasi</span>
                <div class="text-3xl font-extrabold text-blue-600">{{ $verifiedCount }}</div>
                <p class="text-[11px] text-zinc-400">{{ $paidCount }} pendaftar telah lunas bayar</p>
            </div>
        </div>

        <!-- Recent Applicants Table -->
        <div class="rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden space-y-4 p-6">
            <div class="flex items-center justify-between">
                <flux:heading size="lg">Pendaftar Terbaru</flux:heading>
                <a href="{{ route('admin.psb.applicants.index') }}" class="text-xs text-emerald-600 hover:underline font-semibold">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-xs text-left">
                    <thead class="bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400 font-semibold border-b border-zinc-200 dark:border-zinc-800">
                        <tr>
                            <th class="p-3">No. Registrasi</th>
                            <th class="p-3">Nama Santri</th>
                            <th class="p-3">Program</th>
                            <th class="p-3">Status Berkas</th>
                            <th class="p-3">Status Bayar</th>
                            <th class="p-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                        @forelse($recentApplicants as $applicant)
                            <tr class="hover:bg-white dark:hover:bg-zinc-800/40 transition">
                                <td class="p-3 font-mono font-bold text-[#084C27] dark:text-emerald-400">
                                    {{ $applicant->registration_number }}
                                </td>
                                <td class="p-3 font-semibold text-zinc-900 dark:text-zinc-100">
                                    {{ $applicant->full_name }}
                                </td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 rounded-md font-bold text-[10px] {{ $applicant->program_type->value === 'MTS' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $applicant->program_type->value ?? $applicant->program_type }}
                                    </span>
                                </td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-gray-100 text-gray-800">
                                        {{ $applicant->application_status->value ?? $applicant->application_status }}
                                    </span>
                                </td>
                                <td class="p-3">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ ($applicant->payment_status->value ?? $applicant->payment_status) === 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $applicant->payment_status->value ?? $applicant->payment_status }}
                                    </span>
                                </td>
                                <td class="p-3 text-right">
                                    <a href="{{ route('admin.psb.applicants.show', $applicant->id) }}" class="text-xs font-semibold text-[#084C27] hover:underline">
                                        Review &rarr;
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-zinc-400">Belum ada calon santri yang mendaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts::app>
