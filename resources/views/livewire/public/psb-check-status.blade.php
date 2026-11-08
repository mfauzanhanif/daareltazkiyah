<div class="space-y-8">
    <!-- Lookup Card -->
    <div class="bg-white p-6 sm:p-8 rounded-md border border-[#E5E0D8]">
        <form wire:submit="checkStatus" class="space-y-6">
            @if ($errors->has('registration_number'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md text-red-800 text-xs">
                    {{ $errors->first('registration_number') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Nomor Registrasi PSB *</label>
                    <input type="text" wire:model="registration_number" placeholder="Contoh: PSB-2027-MTS-0001" required class="w-full px-4 py-3 text-sm font-mono rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden uppercase bg-[#FAF8F5]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Token Akses Rahasia (8 Karakter) *</label>
                    <input type="text" wire:model="access_token" placeholder="Contoh: ABCD1234" maxlength="8" required class="w-full px-4 py-3 text-sm font-mono rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden uppercase bg-[#FAF8F5]">
                </div>
            </div>

            <button type="submit" wire:loading.attr="disabled" class="w-full py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-bold text-sm transition disabled:opacity-50">
                <span wire:loading.remove wire:target="checkStatus">Periksa Status Pendaftaran</span>
                <span wire:loading wire:target="checkStatus">Memeriksa Data...</span>
            </button>
        </form>
    </div>

    <!-- Results Section -->
    @if ($applicant)
        <div class="space-y-8 pt-4 border-t border-[#E5E0D8]">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 border-b border-[#E5E0D8] gap-4">
                <div>
                    <span class="text-xs text-[#059669] font-bold uppercase tracking-wider">Hasil Pengecekan Status</span>
                    <h2 class="font-serif text-2xl font-bold text-[#0D3B2E]">{{ $applicant->full_name }}</h2>
                    <p class="font-mono text-xs text-gray-500 mt-0.5">No. Registrasi: <strong class="text-black">{{ $applicant->registration_number }}</strong> &bull; Program: {{ $applicant->program_type->value ?? $applicant->program_type }}</p>
                </div>
                <a href="{{ route('psb.proof', $applicant->registration_number) }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white text-xs font-semibold shadow-xs transition shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Unduh Bukti PDF</span>
                </a>
            </div>

            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl text-xs font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Status Overview Card -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Status Card 1: Application -->
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs space-y-2">
                    <span class="text-xs text-gray-400 font-semibold block">Status Berkas Pendaftaran</span>
                    @php
                        $appStatus = $applicant->application_status->value ?? (string) $applicant->application_status;
                        $statusBadge = match($appStatus) {
                            'verified' => ['bg' => 'bg-emerald-100 text-emerald-800', 'label' => 'Terverifikasi'],
                            'accepted' => ['bg' => 'bg-emerald-800 text-white', 'label' => 'Diterima'],
                            'revision_needed' => ['bg' => 'bg-amber-100 text-amber-800', 'label' => 'Perlu Revisi'],
                            'rejected' => ['bg' => 'bg-red-100 text-red-800', 'label' => 'Ditolak'],
                            default => ['bg' => 'bg-gray-100 text-gray-800', 'label' => 'Menunggu Verifikasi (pending)'],
                        };
                    @endphp
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $statusBadge['bg'] }}">
                        {{ $statusBadge['label'] }}
                    </span>
                    <p class="text-[11px] text-gray-500 pt-1">
                        Status saat ini: <code>{{ $appStatus }}</code>
                    </p>
                </div>

                <!-- Status Card 2: Payment -->
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs space-y-2">
                    <span class="text-xs text-gray-400 font-semibold block">Status Pembayaran</span>
                    @php
                        $payStatus = $applicant->payment_status->value ?? (string) $applicant->payment_status;
                        $payBadge = match($payStatus) {
                            'paid' => ['bg' => 'bg-emerald-100 text-emerald-800', 'label' => 'Lunas'],
                            'unpaid' => ['bg' => 'bg-red-100 text-red-800', 'label' => 'Belum Bayar'],
                            default => ['bg' => 'bg-amber-100 text-amber-800', 'label' => 'Menunggu Konfirmasi'],
                        };
                    @endphp
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $payBadge['bg'] }}">
                        {{ $payBadge['label'] }}
                    </span>
                    <p class="text-[11px] text-gray-500 pt-1">
                        Nominal: Rp {{ number_format($applicant->registration_fee, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Status Card 3: Gelombang -->
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-xs space-y-2">
                    <span class="text-xs text-gray-400 font-semibold block">Gelombang Pendaftaran</span>
                    <h4 class="font-bold text-sm text-[#084C27]">{{ $applicant->admissionWave?->name ?? 'Gelombang I' }}</h4>
                    <p class="text-[11px] text-gray-500">Tahun Ajaran {{ $applicant->admissionWave?->academic_year ?? '2027/2028' }}</p>
                </div>
            </div>

            <!-- Admin Notes / Revision Message -->
            @if ($applicant->admin_notes)
                <div class="bg-amber-50 p-6 rounded-2xl border border-amber-200 space-y-2">
                    <h3 class="font-serif font-bold text-sm text-amber-900 flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#D97706]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Catatan dari Panitia PSB:</span>
                    </h3>
                    <p class="text-xs text-amber-800 leading-relaxed">{{ $applicant->admin_notes }}</p>
                </div>
            @endif

            <!-- EDIT FORM -->
            @if ($applicant->canBeEdited())
                <div class="bg-white p-8 rounded-3xl border border-[#084C27]/10 shadow-card space-y-6">
                    <div class="border-b border-gray-100 pb-3 flex items-center justify-between">
                        <div>
                            <h3 class="font-serif font-bold text-lg text-[#084C27]">Perbarui / Koreksi Data Pendaftaran</h3>
                            <p class="text-xs text-gray-500">Data dapat diubah mandiri selama berstatus <strong>{{ $appStatus }}</strong>.</p>
                        </div>
                        <span class="text-xs font-bold text-emerald-600 px-3 py-1 bg-emerald-50 rounded-full">Mode Edit Terbuka</span>
                    </div>

                    <div class="space-y-6">
                        <!-- Student Biodata -->
                        <div class="space-y-4">
                            <h4 class="font-serif font-bold text-sm text-[#084C27]">Data Diri Calon Santri</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-semibold text-[#084C27] mb-1">Nama Lengkap Santri</label>
                                    <input type="text" wire:model="full_name" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                                    @error('full_name') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-[#084C27] mb-1">Tempat Lahir</label>
                                    <input type="text" wire:model="birth_place" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-[#084C27] mb-1">Tanggal Lahir</label>
                                    <input type="date" wire:model="birth_date" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-[#084C27] mb-1">Anak Ke-</label>
                                    <input type="number" wire:model="child_order" min="1" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-[#084C27] mb-1">Asal Sekolah</label>
                                    <input type="text" wire:model="previous_school" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-semibold text-[#084C27] mb-1">Alamat Lengkap</label>
                                    <textarea wire:model="address" rows="2" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Parent Info -->
                        <div class="pt-4 border-t border-gray-100 space-y-4">
                            <h4 class="font-serif font-bold text-sm text-[#084C27]">Data Orang Tua / Wali</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-[#084C27] mb-1">Nama Ayah</label>
                                    <input type="text" wire:model="father_name" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#084C27] mb-1">Nama Ibu</label>
                                    <input type="text" wire:model="mother_name" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-semibold text-[#084C27] mb-1">Nomor WhatsApp Orang Tua</label>
                                    <input type="text" wire:model="parent_phone" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                                </div>
                            </div>
                        </div>

                        <!-- Document Re-upload -->
                        <div class="pt-4 border-t border-gray-100 space-y-4">
                            <div>
                                <h4 class="font-serif font-bold text-sm text-[#084C27]">Unggah Ulang Berkas / Dokumen (Opsional)</h4>
                                <p class="text-xs text-gray-500">Maksimal 2MB per berkas, format PDF/JPG/PNG.</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="p-4 rounded-xl border border-gray-200 bg-gray-50/50 space-y-2">
                                    <label class="block text-xs font-semibold text-[#084C27]">Pasfoto Resmi Santri (3x4)</label>
                                    @if ($doc = $applicant->document(\App\Enums\DocumentType::Photo))
                                        <span class="inline-flex items-center text-[10px] text-emerald-700 font-semibold bg-emerald-50 px-2 py-0.5 rounded-md">✓ Sudah ada: {{ $doc->original_name }}</span>
                                    @endif
                                    <input type="file" wire:model="document_photo" accept="image/png,image/jpeg,image/jpg" class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#084C27] file:text-white hover:file:bg-[#059669]">
                                    <div wire:loading wire:target="document_photo" class="text-[10px] text-amber-600">Mengunggah...</div>
                                    @error('document_photo') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                                </div>

                                <div class="p-4 rounded-xl border border-gray-200 bg-gray-50/50 space-y-2">
                                    <label class="block text-xs font-semibold text-[#084C27]">Kartu Keluarga (KK)</label>
                                    @if ($doc = $applicant->document(\App\Enums\DocumentType::Kk))
                                        <span class="inline-flex items-center text-[10px] text-emerald-700 font-semibold bg-emerald-50 px-2 py-0.5 rounded-md">✓ Sudah ada: {{ $doc->original_name }}</span>
                                    @endif
                                    <input type="file" wire:model="document_kk" accept=".pdf,image/png,image/jpeg,image/jpg" class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#084C27] file:text-white hover:file:bg-[#059669]">
                                    <div wire:loading wire:target="document_kk" class="text-[10px] text-amber-600">Mengunggah...</div>
                                    @error('document_kk') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                                </div>

                                <div class="p-4 rounded-xl border border-gray-200 bg-gray-50/50 space-y-2">
                                    <label class="block text-xs font-semibold text-[#084C27]">Akta Kelahiran</label>
                                    @if ($doc = $applicant->document(\App\Enums\DocumentType::Akta))
                                        <span class="inline-flex items-center text-[10px] text-emerald-700 font-semibold bg-emerald-50 px-2 py-0.5 rounded-md">✓ Sudah ada: {{ $doc->original_name }}</span>
                                    @endif
                                    <input type="file" wire:model="document_akta" accept=".pdf,image/png,image/jpeg,image/jpg" class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#084C27] file:text-white hover:file:bg-[#059669]">
                                    <div wire:loading wire:target="document_akta" class="text-[10px] text-amber-600">Mengunggah...</div>
                                    @error('document_akta') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                                </div>

                                <div class="p-4 rounded-xl border border-gray-200 bg-gray-50/50 space-y-2">
                                    <label class="block text-xs font-semibold text-[#084C27]">Bukti Transfer Pembayaran</label>
                                    @if ($doc = $applicant->document(\App\Enums\DocumentType::PaymentProof))
                                        <span class="inline-flex items-center text-[10px] text-emerald-700 font-semibold bg-emerald-50 px-2 py-0.5 rounded-md">✓ Sudah ada: {{ $doc->original_name }}</span>
                                    @endif
                                    <input type="file" wire:model="document_payment" accept=".pdf,image/png,image/jpeg,image/jpg" class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#084C27] file:text-white hover:file:bg-[#059669]">
                                    <div wire:loading wire:target="document_payment" class="text-[10px] text-amber-600">Mengunggah...</div>
                                    @error('document_payment') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex justify-end">
                            <button type="button" wire:click="saveChanges" wire:loading.attr="disabled" class="px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-sm transition disabled:opacity-50">
                                <span wire:loading.remove wire:target="saveChanges">Simpan Perubahan & Unggah Ulang Berkas</span>
                                <span wire:loading wire:target="saveChanges">Menyimpan Perubahan...</span>
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 text-center text-xs text-gray-500">
                    Data pendaftaran Anda telah dikunci oleh panitia (status: <strong>{{ $appStatus }}</strong>) dan tidak dapat diedit secara mandiri lagi. Jika ada kekeliruan data, silakan hubungi panitia melalui kontak WhatsApp resmi.
                </div>
            @endif
        </div>
    @endif
</div>
