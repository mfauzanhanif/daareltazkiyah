<x-layouts::app :title="__('Detail Calon Santri: ' . $applicant->full_name)">
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <a href="{{ route('admin.psb.applicants.index') }}" class="text-xs text-emerald-600 hover:underline font-semibold mb-1 block">
                    &larr; Kembali ke Daftar Pendaftar
                </a>
                <flux:heading size="xl">{{ $applicant->full_name }}</flux:heading>
                <flux:subheading>
                    No. Registrasi: <span class="font-mono font-bold">{{ $applicant->registration_number }}</span> &bull; 
                    Gelombang: {{ $applicant->admissionWave?->name ?? 'Gelombang I' }} &bull;
                    Program: {{ $applicant->program_type->value ?? $applicant->program_type }}
                </flux:subheading>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('psb.proof', $applicant->registration_number) }}" target="_blank" class="px-4 py-2 border border-zinc-300 dark:border-zinc-700 text-xs font-semibold rounded-xl hover:bg-zinc-100 dark:hover:bg-zinc-800 transition">
                    Unduh Bukti PDF
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 text-emerald-800 text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Left Column: Biodata & Parents & Documents -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Biodata Santri -->
                <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4">
                    <flux:heading size="lg">Data Diri Calon Santri</flux:heading>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-zinc-400 block">NIK:</span>
                            <span class="font-mono font-bold">{{ $applicant->nik }}</span>
                        </div>
                        <div>
                            <span class="text-zinc-400 block">NISN:</span>
                            <span class="font-mono">{{ $applicant->nisn ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-zinc-400 block">Jenis Kelamin:</span>
                            <span>{{ ($applicant->gender->value ?? $applicant->gender) === 'L' ? 'Laki-laki (Ikhwan)' : 'Perempuan (Akhwat)' }}</span>
                        </div>
                        <div>
                            <span class="text-zinc-400 block">Tempat, Tanggal Lahir:</span>
                            <span>{{ $applicant->birth_place }}, {{ $applicant->birth_date?->translatedFormat('d F Y') ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-zinc-400 block">Anak Ke-:</span>
                            <span>{{ $applicant->child_order }}</span>
                        </div>
                        <div>
                            <span class="text-zinc-400 block">Asal Sekolah:</span>
                            <span>{{ $applicant->previous_school }}</span>
                        </div>
                        <div class="sm:col-span-2">
                            <span class="text-zinc-400 block">Alamat Tempat Tinggal:</span>
                            <span>{{ $applicant->address }}</span>
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua -->
                <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4">
                    <flux:heading size="lg">Data Orang Tua / Wali</flux:heading>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div>
                            <span class="text-zinc-400 block">Nama Ayah:</span>
                            <span class="font-semibold">{{ $applicant->parent?->father_name ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-zinc-400 block">Pekerjaan Ayah:</span>
                            <span>{{ $applicant->parent?->father_job ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-zinc-400 block">Nama Ibu:</span>
                            <span class="font-semibold">{{ $applicant->parent?->mother_name ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-zinc-400 block">Pekerjaan Ibu:</span>
                            <span>{{ $applicant->parent?->mother_job ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-zinc-400 block">No. WhatsApp / HP:</span>
                            <span class="font-mono font-bold text-emerald-600">{{ $applicant->parent?->parent_phone ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="text-zinc-400 block">Penghasilan:</span>
                            <span>{{ $applicant->parent?->parent_income ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Dokumen Pendaftaran -->
                <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4">
                    <flux:heading size="lg">Berkas Terunggah ({{ $applicant->documents->count() }})</flux:heading>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        @forelse($applicant->documents as $doc)
                            <div class="p-3 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-800 flex items-center justify-between">
                                <div>
                                    <span class="font-bold uppercase text-[10px] text-[#084C27] block">{{ $doc->document_type->value ?? $doc->document_type }}</span>
                                    <span class="text-zinc-500 truncate block max-w-[180px]">{{ $doc->file_name }}</span>
                                </div>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $doc->is_verified ? 'bg-emerald-100 text-emerald-800' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $doc->is_verified ? 'Terverifikasi' : 'Belum Dicek' }}
                                </span>
                            </div>
                        @empty
                            <div class="col-span-2 text-zinc-400 py-3">Tidak ada berkas terunggah.</div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column: Status Update Form & Activity Log -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Update Status Form -->
                <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4">
                    <flux:heading size="lg">Verifikasi & Status</flux:heading>
                    
                    <form action="{{ route('admin.psb.applicants.update-status', $applicant->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="block text-xs font-semibold mb-1">Status Berkas Pendaftaran *</label>
                            <select name="application_status" required class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                                @php $currentApp = $applicant->application_status->value ?? (string) $applicant->application_status; @endphp
                                <option value="pending" {{ $currentApp === 'pending' ? 'selected' : '' }}>Pending (Menunggu Verifikasi)</option>
                                <option value="verified" {{ $currentApp === 'verified' ? 'selected' : '' }}>Verified (Berkas Lengkap & Sah)</option>
                                <option value="revision_needed" {{ $currentApp === 'revision_needed' ? 'selected' : '' }}>Revision Needed (Perlu Perbaikan)</option>
                                <option value="accepted" {{ $currentApp === 'accepted' ? 'selected' : '' }}>Accepted (Diterima Sebagai Santri)</option>
                                <option value="rejected" {{ $currentApp === 'rejected' ? 'selected' : '' }}>Rejected (Tidak Diterima)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1">Status Pembayaran</label>
                            <select name="payment_status" class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                                @php $currentPay = $applicant->payment_status->value ?? (string) $applicant->payment_status; @endphp
                                <option value="pending_verification" {{ $currentPay === 'pending_verification' ? 'selected' : '' }}>Pending Verification</option>
                                <option value="paid" {{ $currentPay === 'paid' ? 'selected' : '' }}>Paid (Lunas)</option>
                                <option value="unpaid" {{ $currentPay === 'unpaid' ? 'selected' : '' }}>Unpaid (Belum Bayar)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold mb-1">Catatan Panitia / Alasan Revisi</label>
                            <textarea name="admin_notes" rows="3" placeholder="Tuliskan catatan untuk calon wali santri..." class="w-full px-3 py-2 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">{{ old('admin_notes', $applicant->admin_notes) }}</textarea>
                        </div>

                        <button type="submit" class="w-full py-2.5 bg-[#084C27] hover:bg-[#059669] text-white text-xs font-semibold rounded-xl transition">
                            Perbarui Status Pendaftar
                        </button>
                    </form>
                </div>

                <!-- Activity Log -->
                <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4">
                    <flux:heading size="lg">Audit Log Aktivitas</flux:heading>
                    <div class="space-y-3 text-xs">
                        @forelse($applicant->activities as $act)
                            <div class="p-3 rounded-xl bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-800 space-y-1">
                                <div class="flex items-center justify-between text-[10px] text-zinc-400">
                                    <span>{{ $act->causer?->name ?? 'Sistem' }}</span>
                                    <span>{{ $act->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="font-medium text-zinc-800 dark:text-zinc-200">{{ $act->description }}</div>
                            </div>
                        @empty
                            <p class="text-zinc-400 text-xs">Belum ada riwayat perubahan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
