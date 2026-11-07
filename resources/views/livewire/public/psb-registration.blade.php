<div>
    @if(!$wave)
        <div class="bg-white p-8 md:p-14 rounded-3xl border border-[#084C27]/10 shadow-card text-center space-y-6">
            <div class="w-20 h-20 mx-auto rounded-full bg-amber-50 text-[#D97706] flex items-center justify-center">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div class="space-y-2">
                <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#084C27]">Pendaftaran Santri Baru Sedang Ditutup</h1>
                <p class="text-sm md:text-base text-[#4B6358] max-w-xl mx-auto">
                    Saat ini belum ada gelombang pendaftaran yang aktif (closed). Silakan pantau pengumuman berkala atau hubungi panitia melalui kontak WhatsApp untuk jadwal gelombang berikutnya.
                </p>
            </div>
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-3 rounded-xl border border-gray-300 text-[#084C27] font-semibold text-sm hover:bg-gray-50 transition">
                    Kembali ke Beranda
                </a>
                @php
                    $waNum = \App\Models\SiteSetting::get('psb_whatsapp_number', '6281234567890');
                @endphp
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string)$waNum) }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-[#059669] hover:bg-[#084C27] text-white font-semibold text-sm transition">
                    Hubungi Panitia PSB
                </a>
            </div>
        </div>
    @else
        <div class="bg-white p-6 md:p-10 rounded-3xl border border-[#084C27]/10 shadow-card space-y-8">
            <!-- Wizard Stepper Indicator -->
            <div class="grid grid-cols-4 gap-2 border-b border-gray-100 pb-6 text-center text-xs">
                <div class="{{ $step >= 1 ? 'text-[#084C27] font-bold border-b-2 border-[#084C27] pb-2' : 'text-gray-400' }}">
                    1. Program
                </div>
                <div class="{{ $step >= 2 ? 'text-[#084C27] font-bold border-b-2 border-[#084C27] pb-2' : 'text-gray-400' }}">
                    2. Santri
                </div>
                <div class="{{ $step >= 3 ? 'text-[#084C27] font-bold border-b-2 border-[#084C27] pb-2' : 'text-gray-400' }}">
                    3. Orang Tua
                </div>
                <div class="{{ $step >= 4 ? 'text-[#084C27] font-bold border-b-2 border-[#084C27] pb-2' : 'text-gray-400' }}">
                    4. Berkas
                </div>
            </div>

            <!-- STEP 1: PILIHAN PROGRAM -->
            @if ($step === 1)
                <div class="space-y-6">
                    <div class="border-b border-gray-100 pb-3">
                        <h2 class="font-serif font-bold text-xl text-[#084C27]">Langkah 1: Pilih Jenjang Program Pendidikan</h2>
                        <p class="text-xs text-gray-500">Pilih program yang akan diikuti oleh calon santri baru.</p>
                    </div>

                    @error('program_type')
                        <div class="p-3 bg-red-50 border-l-4 border-red-500 text-red-800 text-xs rounded-r-xl">
                            {{ $message }}
                        </div>
                    @enderror

                    @php
                        $mtsQuotaOpen = $wave->hasQuotaFor(\App\Enums\ProgramType::Mts);
                        $mdtaQuotaOpen = $wave->hasQuotaFor(\App\Enums\ProgramType::Mdta);
                        $mtsRem = $wave->remainingQuotaFor(\App\Enums\ProgramType::Mts);
                        $mdtaRem = $wave->remainingQuotaFor(\App\Enums\ProgramType::Mdta);
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- MTS Card -->
                        <label class="rounded-2xl p-6 border-2 transition relative flex flex-col justify-between {{ $mtsQuotaOpen ? 'cursor-pointer' : 'opacity-60 cursor-not-allowed bg-gray-50' }} {{ $program_type === 'MTS' && $mtsQuotaOpen ? 'border-[#084C27] bg-[#FDFBF7] shadow-sm' : 'border-gray-200' }}">
                            <input type="radio" wire:model.live="program_type" value="MTS" {{ ! $mtsQuotaOpen ? 'disabled' : '' }} class="sr-only">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-xs font-bold px-3 py-1 rounded-full bg-[#084C27] text-white">MTS Mukim 24 Jam</span>
                                    @if ($mtsQuotaOpen)
                                        <span class="w-4 h-4 rounded-full border-2 flex items-center justify-center {{ $program_type === 'MTS' ? 'border-[#084C27] bg-[#084C27]' : 'border-gray-300' }}"></span>
                                    @else
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-red-100 text-red-800">Kuota Penuh</span>
                                    @endif
                                </div>
                                <h3 class="font-serif font-bold text-lg text-[#084C27]">Madrasah Tsanawiyah</h3>
                                <p class="text-xs text-[#4B6358] mt-1">Setingkat SMP terpadu asrama mukim 24 jam dengan bimbingan intensif 30 juz.</p>
                                @if($mtsRem !== null && $mtsQuotaOpen)
                                    <div class="mt-2 text-[11px] font-semibold text-emerald-700">Sisa kuota: {{ $mtsRem }} santri</div>
                                @endif
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-200/60 flex items-baseline justify-between">
                                <span class="text-xs text-gray-500">Infaq Pendaftaran:</span>
                                <span class="text-sm font-bold text-[#D97706]">Rp {{ number_format($wave->fee_mts, 0, ',', '.') }}</span>
                            </div>
                        </label>

                        <!-- MDTA Card -->
                        <label class="rounded-2xl p-6 border-2 transition relative flex flex-col justify-between {{ $mdtaQuotaOpen ? 'cursor-pointer' : 'opacity-60 cursor-not-allowed bg-gray-50' }} {{ $program_type === 'MDTA' && $mdtaQuotaOpen ? 'border-[#084C27] bg-[#FDFBF7] shadow-sm' : 'border-gray-200' }}">
                            <input type="radio" wire:model.live="program_type" value="MDTA" {{ ! $mdtaQuotaOpen ? 'disabled' : '' }} class="sr-only">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-xs font-bold px-3 py-1 rounded-full bg-amber-600 text-white">MDTA Sekolah Sore</span>
                                    @if ($mdtaQuotaOpen)
                                        <span class="w-4 h-4 rounded-full border-2 flex items-center justify-center {{ $program_type === 'MDTA' ? 'border-amber-600 bg-amber-600' : 'border-gray-300' }}"></span>
                                    @else
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-red-100 text-red-800">Kuota Penuh</span>
                                    @endif
                                </div>
                                <h3 class="font-serif font-bold text-lg text-[#084C27]">Madrasah Diniyah</h3>
                                <p class="text-xs text-[#4B6358] mt-1">Santri non-mukim belajar sore hari materi Fiqih, Aqidah, dan Juz 'Amma.</p>
                                @if($mdtaRem !== null && $mdtaQuotaOpen)
                                    <div class="mt-2 text-[11px] font-semibold text-amber-700">Sisa kuota: {{ $mdtaRem }} santri</div>
                                @endif
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-200/60 flex items-baseline justify-between">
                                <span class="text-xs text-gray-500">Infaq Pendaftaran:</span>
                                <span class="text-sm font-bold text-[#D97706]">Rp {{ number_format($wave->fee_mdta, 0, ',', '.') }}</span>
                            </div>
                        </label>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="button" wire:click="nextStep" class="px-6 py-3 rounded-xl bg-[#084C27] hover:bg-[#059669] text-white font-semibold text-sm transition">
                            Lanjut ke Data Santri &rarr;
                        </button>
                    </div>
                </div>
            @endif

            <!-- STEP 2: DATA CALON SANTRI -->
            @if ($step === 2)
                <div class="space-y-6">
                    <div class="border-b border-gray-100 pb-3">
                        <h2 class="font-serif font-bold text-xl text-[#084C27]">Langkah 2: Data Diri Calon Santri</h2>
                        <p class="text-xs text-gray-500">Isi data calon santri sesuai dengan Kartu Keluarga dan Akta Kelahiran.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Nama Lengkap Santri *</label>
                            <input type="text" wire:model="full_name" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                            @error('full_name') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">NIK Calon Santri (16 Digit) *</label>
                            <input type="text" wire:model.blur="nik" maxlength="16" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                            @error('nik') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">NISN (Nomor Induk Siswa Nasional)</label>
                            <input type="text" wire:model="nisn" maxlength="10" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                            @error('nisn') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Jenis Kelamin *</label>
                            <select wire:model="gender" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                                <option value="L">Laki-laki (Ikhwan)</option>
                                <option value="P">Perempuan (Akhwat)</option>
                            </select>
                            @error('gender') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Anak Ke- *</label>
                            <input type="number" wire:model="child_order" min="1" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                            @error('child_order') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Tempat Lahir *</label>
                            <input type="text" wire:model="birth_place" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                            @error('birth_place') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Tanggal Lahir *</label>
                            <input type="date" wire:model="birth_date" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                            @error('birth_date') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Asal Sekolah Sebelumnya *</label>
                            <input type="text" wire:model="previous_school" placeholder="Contoh: SDIT Daar El Fikri / MI Nurul Falah" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                            @error('previous_school') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Alamat Lengkap Domisili *</label>
                            <textarea wire:model="address" rows="2" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden"></textarea>
                            @error('address') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-between pt-4">
                        <button type="button" wire:click="previousStep" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-sm font-semibold hover:bg-gray-50 transition">
                            &larr; Kembali
                        </button>
                        <button type="button" wire:click="nextStep" class="px-6 py-3 rounded-xl bg-[#084C27] hover:bg-[#059669] text-white font-semibold text-sm transition">
                            Lanjut ke Data Orang Tua &rarr;
                        </button>
                    </div>
                </div>
            @endif

            <!-- STEP 3: DATA ORANG TUA / WALI -->
            @if ($step === 3)
                <div class="space-y-6">
                    <div class="border-b border-gray-100 pb-3">
                        <h2 class="font-serif font-bold text-xl text-[#084C27]">Langkah 3: Data Orang Tua / Wali</h2>
                        <p class="text-xs text-gray-500">Informasi kontak dan data orang tua/wali calon santri.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Nama Ayah Kandung *</label>
                            <input type="text" wire:model="father_name" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                            @error('father_name') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Pekerjaan Ayah</label>
                            <input type="text" wire:model="father_job" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                            @error('father_job') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Nama Ibu Kandung *</label>
                            <input type="text" wire:model="mother_name" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                            @error('mother_name') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Pekerjaan Ibu</label>
                            <input type="text" wire:model="mother_job" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                            @error('mother_job') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Nomor WhatsApp Aktif Orang Tua *</label>
                            <input type="text" wire:model="parent_phone" placeholder="08xxxxxxxxxx" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                            @error('parent_phone') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Penghasilan Rata-rata Orang Tua</label>
                            <select wire:model="parent_income" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden">
                                <option value="< 2 Juta">&lt; 2 Juta</option>
                                <option value="2-5 Juta">2 - 5 Juta</option>
                                <option value="5-10 Juta">5 - 10 Juta</option>
                                <option value="> 10 Juta">&gt; 10 Juta</option>
                            </select>
                            @error('parent_income') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-[#084C27] mb-1">Alamat Orang Tua (kosongkan jika sama dengan santri)</label>
                            <textarea wire:model="parent_address" rows="2" class="w-full px-4 py-2.5 text-sm rounded-xl border border-gray-200 focus:border-[#084C27] outline-hidden"></textarea>
                            @error('parent_address') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-between pt-4">
                        <button type="button" wire:click="previousStep" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-sm font-semibold hover:bg-gray-50 transition">
                            &larr; Kembali
                        </button>
                        <button type="button" wire:click="nextStep" class="px-6 py-3 rounded-xl bg-[#084C27] hover:bg-[#059669] text-white font-semibold text-sm transition">
                            Lanjut ke Unggah Berkas &rarr;
                        </button>
                    </div>
                </div>
            @endif

            <!-- STEP 4: UPLOAD BERKAS & BUKTI BAYAR -->
            @if ($step === 4)
                <div class="space-y-6">
                    <div class="border-b border-gray-100 pb-3">
                        <h2 class="font-serif font-bold text-xl text-[#084C27]">Langkah 4: Unggah Dokumen & Bukti Pembayaran</h2>
                        <p class="text-xs text-gray-500">Format: JPG, PNG, atau PDF (Maksimal 2MB per berkas).</p>
                    </div>

                    <!-- Payment Instruction Info -->
                    @php
                        $bankName = \App\Models\SiteSetting::get('bank_name', 'Bank Syariah Indonesia (BSI)');
                        $bankNumber = \App\Models\SiteSetting::get('bank_account_number', '7123456789');
                        $bankHolder = \App\Models\SiteSetting::get('bank_account_name', 'PPMTQ DAAR EL TAZKIYAH');
                        $feeAmount = $program_type === 'MTS' ? $wave->fee_mts : $wave->fee_mdta;
                    @endphp
                    <div class="bg-amber-50/70 p-5 rounded-2xl border border-amber-200 space-y-2">
                        <div class="font-serif font-bold text-sm text-amber-900">Rekening Transfer Pembayaran Infaq Pendaftaran:</div>
                        <div class="text-xs text-amber-800 space-y-1">
                            <p>Bank: <strong>{{ $bankName }}</strong></p>
                            <p>Nomor Rekening: <strong class="font-mono text-sm">{{ $bankNumber }}</strong></p>
                            <p>Atas Nama: <strong>{{ $bankHolder }}</strong></p>
                            <p class="text-[11px] text-amber-700 italic">Harap transfer nominal sebesar: <strong>Rp {{ number_format($feeAmount, 0, ',', '.') }}</strong> untuk program {{ $program_type }}.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Pasfoto -->
                        <div class="border border-gray-200 p-4 rounded-xl space-y-2">
                            <label class="block text-xs font-semibold text-[#084C27]">1. Pasfoto Resmi Santri (3x4) *</label>
                            <input type="file" wire:model="document_photo" accept="image/png,image/jpeg,image/jpg" class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            <div wire:loading wire:target="document_photo" class="text-[10px] text-amber-600">Mengunggah pasfoto...</div>
                            @error('document_photo') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Kartu Keluarga -->
                        <div class="border border-gray-200 p-4 rounded-xl space-y-2">
                            <label class="block text-xs font-semibold text-[#084C27]">2. Scan Kartu Keluarga (KK) *</label>
                            <input type="file" wire:model="document_kk" accept="application/pdf,image/*" class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            <div wire:loading wire:target="document_kk" class="text-[10px] text-amber-600">Mengunggah KK...</div>
                            @error('document_kk') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Akta Kelahiran -->
                        <div class="border border-gray-200 p-4 rounded-xl space-y-2">
                            <label class="block text-xs font-semibold text-[#084C27]">3. Scan Akta Kelahiran Santri *</label>
                            <input type="file" wire:model="document_akta" accept="application/pdf,image/*" class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            <div wire:loading wire:target="document_akta" class="text-[10px] text-amber-600">Mengunggah akta...</div>
                            @error('document_akta') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Bukti Pembayaran -->
                        <div class="border border-gray-200 p-4 rounded-xl space-y-2">
                            <label class="block text-xs font-semibold text-[#084C27]">4. Bukti Transfer Biaya Pendaftaran *</label>
                            <input type="file" wire:model="document_payment" accept="application/pdf,image/*" class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            <div wire:loading wire:target="document_payment" class="text-[10px] text-amber-600">Mengunggah bukti transfer...</div>
                            @error('document_payment') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-between pt-6 border-t border-gray-100">
                        <button type="button" wire:click="previousStep" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-sm font-semibold hover:bg-gray-50 transition">
                            &larr; Kembali
                        </button>
                        <button type="button" wire:click="submit" wire:loading.attr="disabled" class="px-8 py-3.5 rounded-xl bg-[#084C27] hover:bg-[#059669] text-white font-bold text-sm shadow-elevated hover:shadow-glow-amber transition disabled:opacity-50">
                            <span wire:loading.remove wire:target="submit">Kirim Formulir Pendaftaran PSB</span>
                            <span wire:loading wire:target="submit">Memproses Pendaftaran...</span>
                        </button>
                    </div>
                </div>
            @endif

        </div>
    @endif
</div>
