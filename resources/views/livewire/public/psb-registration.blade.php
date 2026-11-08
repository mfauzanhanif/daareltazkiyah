<div>
    @if(!$wave)
        <div class="bg-white p-8 md:p-14 rounded-md border border-[#E5E0D8] text-center space-y-6">
            <div class="w-20 h-20 mx-auto rounded-md bg-[#FAF8F5] border border-[#B89758] text-[#B89758] flex items-center justify-center">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div class="space-y-2">
                <h1 class="font-sans text-2xl md:text-3xl font-bold text-[#0D3B2E]">Pendaftaran Santri Baru Sedang Ditutup</h1>
                <p class="text-sm md:text-base text-[#4B6358] max-w-xl mx-auto">
                    Saat ini belum ada gelombang pendaftaran yang aktif (closed). Silakan pantau pengumuman berkala atau hubungi panitia melalui kontak WhatsApp untuk jadwal gelombang berikutnya.
                </p>
            </div>
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-3 rounded-md border border-[#E5E0D8] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider hover:border-[#0D3B2E] bg-white transition">
                    Kembali ke Beranda
                </a>
                @php
                    $waNum = \App\Models\SiteSetting::get('psb_whatsapp_number', '6281234567890');
                @endphp
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string)$waNum) }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition">
                    Hubungi Panitia PSB
                </a>
            </div>
        </div>
    @else
        <div class="bg-white p-6 md:p-10 rounded-md border border-[#E5E0D8] space-y-8">
            <!-- Wizard Stepper Indicator -->
            <div class="grid grid-cols-4 gap-2 border-b border-[#E5E0D8] pb-6 text-center text-xs">
                <div class="{{ $step >= 1 ? 'text-[#0D3B2E] font-bold border-b-2 border-[#0D3B2E] pb-2' : 'text-[#4B6358]' }}">
                    1. Program
                </div>
                <div class="{{ $step >= 2 ? 'text-[#0D3B2E] font-bold border-b-2 border-[#0D3B2E] pb-2' : 'text-[#4B6358]' }}">
                    2. Santri
                </div>
                <div class="{{ $step >= 3 ? 'text-[#0D3B2E] font-bold border-b-2 border-[#0D3B2E] pb-2' : 'text-[#4B6358]' }}">
                    3. Orang Tua
                </div>
                <div class="{{ $step >= 4 ? 'text-[#0D3B2E] font-bold border-b-2 border-[#0D3B2E] pb-2' : 'text-[#4B6358]' }}">
                    4. Berkas
                </div>
            </div>

            <!-- STEP 1: PILIHAN PROGRAM -->
            @if ($step === 1)
                <div class="space-y-6">
                    <div class="border-b border-[#E5E0D8] pb-3">
                        <h2 class="font-sans font-bold text-xl text-[#0D3B2E]">Langkah 1: Pilih Jenjang Program Pendidikan</h2>
                        <p class="text-xs text-[#4B6358]">Pilih program yang akan diikuti oleh calon santri baru.</p>
                    </div>

                    @error('program_type')
                        <div class="p-3 bg-red-50 border-l-4 border-red-500 text-red-800 text-xs rounded-r-md">
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
                        <label class="rounded-md p-6 border-2 transition relative flex flex-col justify-between {{ $mtsQuotaOpen ? 'cursor-pointer' : 'opacity-60 cursor-not-allowed bg-gray-50' }} {{ $program_type === 'MTS' && $mtsQuotaOpen ? 'border-[#0D3B2E] bg-[#FAF8F5]' : 'border-[#E5E0D8]' }}">
                            <input type="radio" wire:model.live="program_type" value="MTS" {{ ! $mtsQuotaOpen ? 'disabled' : '' }} class="sr-only">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-xs font-bold px-3 py-1 rounded-md bg-[#0D3B2E] text-white">MTS Mukim 24 Jam</span>
                                    @if ($mtsQuotaOpen)
                                        <span class="w-4 h-4 rounded-md border-2 flex items-center justify-center {{ $program_type === 'MTS' ? 'border-[#0D3B2E] bg-[#0D3B2E]' : 'border-gray-300' }}"></span>
                                    @else
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-red-100 text-red-800">Kuota Penuh</span>
                                    @endif
                                </div>
                                <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Madrasah Tsanawiyah</h3>
                                <p class="text-xs text-[#4B6358] mt-1">Setingkat SMP terpadu asrama mukim 24 jam dengan bimbingan intensif 30 juz.</p>
                                @if($mtsRem !== null && $mtsQuotaOpen)
                                    <div class="mt-2 text-[11px] font-semibold text-emerald-700">Sisa kuota: {{ $mtsRem }} santri</div>
                                @endif
                            </div>
                            <div class="mt-6 pt-4 border-t border-[#E5E0D8] flex items-baseline justify-between">
                                <span class="text-xs text-[#4B6358]">Infaq Pendaftaran:</span>
                                <span class="text-sm font-bold text-[#B89758]">Rp {{ number_format($wave->fee_mts, 0, ',', '.') }}</span>
                            </div>
                        </label>

                        <!-- MDTA Card -->
                        <label class="rounded-md p-6 border-2 transition relative flex flex-col justify-between {{ $mdtaQuotaOpen ? 'cursor-pointer' : 'opacity-60 cursor-not-allowed bg-gray-50' }} {{ $program_type === 'MDTA' && $mdtaQuotaOpen ? 'border-[#0D3B2E] bg-[#FAF8F5]' : 'border-[#E5E0D8]' }}">
                            <input type="radio" wire:model.live="program_type" value="MDTA" {{ ! $mdtaQuotaOpen ? 'disabled' : '' }} class="sr-only">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-xs font-bold px-3 py-1 rounded-md bg-amber-600 text-white">MDTA Sekolah Sore</span>
                                    @if ($mdtaQuotaOpen)
                                        <span class="w-4 h-4 rounded-md border-2 flex items-center justify-center {{ $program_type === 'MDTA' ? 'border-amber-600 bg-amber-600' : 'border-gray-300' }}"></span>
                                    @else
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-red-100 text-red-800">Kuota Penuh</span>
                                    @endif
                                </div>
                                <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Madrasah Diniyah</h3>
                                <p class="text-xs text-[#4B6358] mt-1">Santri non-mukim belajar sore hari materi Fiqih, Aqidah, dan Juz 'Amma.</p>
                                @if($mdtaRem !== null && $mdtaQuotaOpen)
                                    <div class="mt-2 text-[11px] font-semibold text-amber-700">Sisa kuota: {{ $mdtaRem }} santri</div>
                                @endif
                            </div>
                            <div class="mt-6 pt-4 border-t border-[#E5E0D8] flex items-baseline justify-between">
                                <span class="text-xs text-[#4B6358]">Infaq Pendaftaran:</span>
                                <span class="text-sm font-bold text-[#B89758]">Rp {{ number_format($wave->fee_mdta, 0, ',', '.') }}</span>
                            </div>
                        </label>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="button" wire:click="nextStep" class="px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs tracking-wider uppercase transition">
                            Lanjut ke Data Santri &rarr;
                        </button>
                    </div>
                </div>
            @endif

            <!-- STEP 2: DATA CALON SANTRI -->
            @if ($step === 2)
                <div class="space-y-6">
                    <div class="border-b border-[#E5E0D8] pb-3">
                        <h2 class="font-sans font-bold text-xl text-[#0D3B2E]">Langkah 2: Data Diri Calon Santri</h2>
                        <p class="text-xs text-[#4B6358]">Isi data calon santri sesuai dengan Kartu Keluarga dan Akta Kelahiran.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Nama Lengkap Santri *</label>
                            <input type="text" wire:model="full_name" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                            @error('full_name') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">NIK Calon Santri (16 Digit) *</label>
                            <input type="text" wire:model.blur="nik" maxlength="16" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                            @error('nik') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">NISN (Nomor Induk Siswa Nasional)</label>
                            <input type="text" wire:model="nisn" maxlength="10" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                            @error('nisn') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Jenis Kelamin *</label>
                            <select wire:model="gender" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                                <option value="L">Laki-laki (Ikhwan)</option>
                                <option value="P">Perempuan (Akhwat)</option>
                            </select>
                            @error('gender') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Anak Ke- *</label>
                            <input type="number" wire:model="child_order" min="1" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                            @error('child_order') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Tempat Lahir *</label>
                            <input type="text" wire:model="birth_place" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                            @error('birth_place') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Tanggal Lahir *</label>
                            <input type="date" wire:model="birth_date" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                            @error('birth_date') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Asal Sekolah Sebelumnya *</label>
                            <input type="text" wire:model="previous_school" placeholder="Contoh: SDIT Daar El Fikri / MI Nurul Falah" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                            @error('previous_school') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Alamat Lengkap Domisili *</label>
                            <textarea wire:model="address" rows="2" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]"></textarea>
                            @error('address') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-between pt-4">
                        <button type="button" wire:click="previousStep" class="px-5 py-2.5 rounded-md border border-[#E5E0D8] text-[#4B6358] text-xs font-semibold uppercase tracking-wider hover:border-[#0D3B2E] hover:text-[#0D3B2E] bg-white transition">
                            &larr; Kembali
                        </button>
                        <button type="button" wire:click="nextStep" class="px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition">
                            Lanjut ke Data Orang Tua &rarr;
                        </button>
                    </div>
                </div>
            @endif

            <!-- STEP 3: DATA ORANG TUA / WALI -->
            @if ($step === 3)
                <div class="space-y-6">
                    <div class="border-b border-[#E5E0D8] pb-3">
                        <h2 class="font-sans font-bold text-xl text-[#0D3B2E]">Langkah 3: Data Orang Tua / Wali</h2>
                        <p class="text-xs text-[#4B6358]">Informasi kontak dan data orang tua/wali calon santri.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Nama Ayah Kandung *</label>
                            <input type="text" wire:model="father_name" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                            @error('father_name') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Pekerjaan Ayah</label>
                            <input type="text" wire:model="father_job" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                            @error('father_job') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Nama Ibu Kandung *</label>
                            <input type="text" wire:model="mother_name" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                            @error('mother_name') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Pekerjaan Ibu</label>
                            <input type="text" wire:model="mother_job" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                            @error('mother_job') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Nomor WhatsApp Aktif Orang Tua *</label>
                            <input type="text" wire:model="parent_phone" placeholder="08xxxxxxxxxx" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                            @error('parent_phone') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Penghasilan Rata-rata Orang Tua</label>
                            <select wire:model="parent_income" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]">
                                <option value="< 2 Juta">&lt; 2 Juta</option>
                                <option value="2-5 Juta">2 - 5 Juta</option>
                                <option value="5-10 Juta">5 - 10 Juta</option>
                                <option value="> 10 Juta">&gt; 10 Juta</option>
                            </select>
                            @error('parent_income') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Alamat Orang Tua (kosongkan jika sama dengan santri)</label>
                            <textarea wire:model="parent_address" rows="2" class="w-full px-4 py-2.5 text-sm rounded-md border border-[#E5E0D8] focus:border-[#0D3B2E] outline-hidden bg-[#FAF8F5]"></textarea>
                            @error('parent_address') <span class="text-[11px] text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-between pt-4">
                        <button type="button" wire:click="previousStep" class="px-5 py-2.5 rounded-md border border-[#E5E0D8] text-[#4B6358] text-xs font-semibold uppercase tracking-wider hover:border-[#0D3B2E] hover:text-[#0D3B2E] bg-white transition">
                            &larr; Kembali
                        </button>
                        <button type="button" wire:click="nextStep" class="px-6 py-3 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition">
                            Lanjut ke Unggah Berkas &rarr;
                        </button>
                    </div>
                </div>
            @endif

            <!-- STEP 4: UPLOAD BERKAS & BUKTI BAYAR -->
            @if ($step === 4)
                <div class="space-y-6">
                    <div class="border-b border-[#E5E0D8] pb-3">
                        <h2 class="font-sans font-bold text-xl text-[#0D3B2E]">Langkah 4: Unggah Dokumen & Bukti Pembayaran</h2>
                        <p class="text-xs text-[#4B6358]">Format: JPG, PNG, atau PDF (Maksimal 2MB per berkas).</p>
                    </div>

                    <!-- Payment Instruction Info -->
                    @php
                        $bankName = \App\Models\SiteSetting::get('bank_name', 'Bank Syariah Indonesia (BSI)');
                        $bankNumber = \App\Models\SiteSetting::get('bank_account_number', '7123456789');
                        $bankHolder = \App\Models\SiteSetting::get('bank_account_name', 'PPMTQ DAAR EL TAZKIYAH');
                        $feeAmount = $program_type === 'MTS' ? $wave->fee_mts : $wave->fee_mdta;
                    @endphp
                    <div class="bg-[#FAF8F5] p-5 rounded-md border border-[#B89758]/50 space-y-2">
                        <div class="font-sans font-bold text-sm text-[#0D3B2E]">Rekening Transfer Pembayaran Infaq Pendaftaran:</div>
                        <div class="text-xs text-[#4B6358] space-y-1">
                            <p>Bank: <strong class="text-[#0D3B2E]">{{ $bankName }}</strong></p>
                            <p>Nomor Rekening: <strong class="font-mono text-sm text-[#0D3B2E]">{{ $bankNumber }}</strong></p>
                            <p>Atas Nama: <strong class="text-[#0D3B2E]">{{ $bankHolder }}</strong></p>
                            <p class="text-[11px] text-[#B89758] font-medium">Harap transfer nominal sebesar: <strong>Rp {{ number_format($feeAmount, 0, ',', '.') }}</strong> untuk program {{ $program_type }}.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Pasfoto -->
                        <div class="border border-[#E5E0D8] p-4 rounded-md bg-white space-y-2">
                            <label class="block text-xs font-semibold text-[#0D3B2E]">1. Pasfoto Resmi Santri (3x4) *</label>
                            <input type="file" wire:model="document_photo" accept="image/png,image/jpeg,image/jpg" class="block w-full text-xs text-[#4B6358] file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#0D3B2E] file:text-white hover:file:bg-[#059669]">
                            <div wire:loading wire:target="document_photo" class="text-[10px] text-amber-600">Mengunggah pasfoto...</div>
                            @error('document_photo') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Kartu Keluarga -->
                        <div class="border border-[#E5E0D8] p-4 rounded-md bg-white space-y-2">
                            <label class="block text-xs font-semibold text-[#0D3B2E]">2. Scan Kartu Keluarga (KK) *</label>
                            <input type="file" wire:model="document_kk" accept="application/pdf,image/*" class="block w-full text-xs text-[#4B6358] file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#0D3B2E] file:text-white hover:file:bg-[#059669]">
                            <div wire:loading wire:target="document_kk" class="text-[10px] text-amber-600">Mengunggah KK...</div>
                            @error('document_kk') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Akta Kelahiran -->
                        <div class="border border-[#E5E0D8] p-4 rounded-md bg-white space-y-2">
                            <label class="block text-xs font-semibold text-[#0D3B2E]">3. Scan Akta Kelahiran Santri *</label>
                            <input type="file" wire:model="document_akta" accept="application/pdf,image/*" class="block w-full text-xs text-[#4B6358] file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#0D3B2E] file:text-white hover:file:bg-[#059669]">
                            <div wire:loading wire:target="document_akta" class="text-[10px] text-amber-600">Mengunggah akta...</div>
                            @error('document_akta') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Bukti Pembayaran -->
                        <div class="border border-[#E5E0D8] p-4 rounded-md bg-white space-y-2">
                            <label class="block text-xs font-semibold text-[#0D3B2E]">4. Bukti Transfer Biaya Pendaftaran *</label>
                            <input type="file" wire:model="document_payment" accept="application/pdf,image/*" class="block w-full text-xs text-[#4B6358] file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#0D3B2E] file:text-white hover:file:bg-[#059669]">
                            <div wire:loading wire:target="document_payment" class="text-[10px] text-amber-600">Mengunggah bukti transfer...</div>
                            @error('document_payment') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-between pt-6 border-t border-[#E5E0D8]">
                        <button type="button" wire:click="previousStep" class="px-5 py-2.5 rounded-md border border-[#E5E0D8] text-[#4B6358] text-xs font-semibold uppercase tracking-wider hover:border-[#0D3B2E] hover:text-[#0D3B2E] bg-white transition">
                            &larr; Kembali
                        </button>
                        <button type="button" wire:click="submit" wire:loading.attr="disabled" class="px-8 py-3.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition disabled:opacity-50">
                            <span wire:loading.remove wire:target="submit">Kirim Formulir Pendaftaran PSB &rarr;</span>
                            <span wire:loading wire:target="submit">Memproses Pendaftaran...</span>
                        </button>
                    </div>
                </div>
            @endif

        </div>
    @endif
</div>
