<div>
    @if(!$wave)
        <div class="bg-white p-8 md:p-14 rounded-2xl border border-[#E5E0D8] text-center space-y-6 shadow-xs">
            <div class="w-20 h-20 mx-auto rounded-2xl bg-[#FAF8F5] border border-[#B89758] text-[#B89758] flex items-center justify-center shadow-xs">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div class="space-y-2">
                <h1 class="font-sans text-2xl md:text-3xl font-extrabold text-[#0D3B2E]">Pendaftaran Santri Baru Sedang Ditutup</h1>
                <p class="text-sm md:text-base text-[#4B6358] max-w-xl mx-auto leading-relaxed">
                    Saat ini belum ada gelombang pendaftaran yang aktif (closed). Silakan pantau pengumuman berkala atau hubungi panitia melalui kontak WhatsApp untuk jadwal gelombang berikutnya.
                </p>
            </div>
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-3 rounded-xl border border-[#E5E0D8] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider hover:border-[#0D3B2E] bg-white transition shadow-2xs">
                    Kembali ke Beranda
                </a>
                @php
                    $waNum = \App\Models\SiteSetting::get('school_phone', '0896-5332-4339');
                @endphp
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string)$waNum) }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition shadow-xs">
                    Hubungi Panitia PSB
                </a>
            </div>
        </div>
    @else
        <div class="bg-white p-6 md:p-10 rounded-2xl border border-[#E5E0D8] space-y-8 shadow-xs">
            <!-- 5-Step Wizard Stepper Indicator -->
            <div class="grid grid-cols-5 gap-1.5 sm:gap-2 border-b border-[#E5E0D8]/60 pb-6 text-center text-[10px] sm:text-xs">
                <button type="button" wire:click="goToStep(1)" class="transition cursor-pointer {{ $step === 1 ? 'text-[#0D3B2E] font-bold border-b-2 border-[#0D3B2E] pb-2' : ($step > 1 ? 'text-[#059669] font-medium border-b-2 border-[#059669]/50 pb-2' : 'text-[#4B6358]') }}">
                    1. Santri
                </button>
                <button type="button" wire:click="goToStep(2)" class="transition cursor-pointer {{ $step === 2 ? 'text-[#0D3B2E] font-bold border-b-2 border-[#0D3B2E] pb-2' : ($step > 2 ? 'text-[#059669] font-medium border-b-2 border-[#059669]/50 pb-2' : 'text-[#4B6358]') }}">
                    2. Orang Tua
                </button>
                <button type="button" wire:click="goToStep(3)" class="transition cursor-pointer {{ $step === 3 ? 'text-[#0D3B2E] font-bold border-b-2 border-[#0D3B2E] pb-2' : ($step > 3 ? 'text-[#059669] font-medium border-b-2 border-[#059669]/50 pb-2' : 'text-[#4B6358]') }}">
                    3. Sekolah &amp; Pilihan
                </button>
                <button type="button" wire:click="goToStep(4)" class="transition cursor-pointer {{ $step === 4 ? 'text-[#0D3B2E] font-bold border-b-2 border-[#0D3B2E] pb-2' : ($step > 4 ? 'text-[#059669] font-medium border-b-2 border-[#059669]/50 pb-2' : 'text-[#4B6358]') }}">
                    4. Dokumen
                </button>
                <div class="{{ $step === 5 ? 'text-[#0D3B2E] font-bold border-b-2 border-[#0D3B2E] pb-2' : 'text-[#4B6358]' }}">
                    5. Review
                </div>
            </div>

            <!-- STEP 1: DATA CALON SANTRI -->
            @if ($step === 1)
                <div class="space-y-6">
                    <div class="border-b border-[#E5E0D8]/60 pb-3">
                        <h2 class="font-sans font-bold text-xl text-[#0D3B2E]">Langkah 1: Data Calon Santri</h2>
                        <p class="text-xs text-[#4B6358]">Isi data calon santri sesuai dengan dokumen resmi Kartu Keluarga dan Akta Kelahiran.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1.5">Nama Lengkap Santri *</label>
                            <input type="text" wire:model="full_name" placeholder="Nama lengkap sesuai akta / KK" class="w-full px-4 py-2.5 text-sm rounded-xl border border-[#E5E0D8] focus:border-[#059669] focus:bg-white outline-none bg-[#FAF8F5] transition">
                            @error('full_name') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1.5">NIK Calon Santri (16 Digit) *</label>
                            <input type="text" wire:model.blur="nik" maxlength="16" placeholder="16 digit NIK pada Kartu Keluarga" class="w-full px-4 py-2.5 text-sm font-mono rounded-xl border border-[#E5E0D8] focus:border-[#059669] focus:bg-white outline-none bg-[#FAF8F5] transition">
                            @error('nik') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1.5">NISN (10 Digit, Opsional)</label>
                            <input type="text" wire:model="nisn" maxlength="10" placeholder="10 digit NISN dari sekolah asal" class="w-full px-4 py-2.5 text-sm font-mono rounded-xl border border-[#E5E0D8] focus:border-[#059669] focus:bg-white outline-none bg-[#FAF8F5] transition">
                            @error('nisn') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1.5">Tempat Lahir *</label>
                            <input type="text" wire:model="birth_place" placeholder="Kota / Kabupaten tempat lahir" class="w-full px-4 py-2.5 text-sm rounded-xl border border-[#E5E0D8] focus:border-[#059669] focus:bg-white outline-none bg-[#FAF8F5] transition">
                            @error('birth_place') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1.5">Tanggal Lahir *</label>
                            <input type="date" wire:model="birth_date" class="w-full px-4 py-2.5 text-sm rounded-xl border border-[#E5E0D8] focus:border-[#059669] focus:bg-white outline-none bg-[#FAF8F5] transition">
                            @error('birth_date') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-[#0D3B2E] mb-1.5">Jenis Kelamin *</label>
                            <select wire:model="gender" class="w-full px-4 py-2.5 text-sm rounded-xl border border-[#E5E0D8] focus:border-[#059669] focus:bg-white outline-none bg-[#FAF8F5] transition">
                                <option value="L">Laki-laki (Ikhwan)</option>
                                <option value="P">Perempuan (Akhwat)</option>
                            </select>
                            @error('gender') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1.5">Anak Ke- *</label>
                                <input type="number" wire:model="child_order" min="1" class="w-full px-4 py-2.5 text-sm rounded-xl border border-[#E5E0D8] focus:border-[#059669] focus:bg-white outline-none bg-[#FAF8F5] transition">
                                @error('child_order') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1.5">Dari ... Bersaudara</label>
                                <input type="number" wire:model="total_siblings" min="1" class="w-full px-4 py-2.5 text-sm rounded-xl border border-[#E5E0D8] focus:border-[#059669] focus:bg-white outline-none bg-[#FAF8F5] transition">
                                @error('total_siblings') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Alamat Berjenjang -->
                        <div class="sm:col-span-2 pt-2 border-t border-[#E5E0D8]/60">
                            <span class="block text-xs font-bold text-[#0D3B2E] mb-3 uppercase tracking-wider">Alamat Domisili Santri</span>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[11px] font-semibold text-[#4B6358] mb-1">Provinsi</label>
                                    <input type="text" wire:model="province" placeholder="Contoh: Banten" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] focus:border-[#059669] bg-[#FAF8F5] transition">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-[#4B6358] mb-1">Kabupaten / Kota</label>
                                    <input type="text" wire:model="city" placeholder="Contoh: Serang" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] focus:border-[#059669] bg-[#FAF8F5] transition">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-[#4B6358] mb-1">Kecamatan</label>
                                    <input type="text" wire:model="district" placeholder="Contoh: Petir" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] focus:border-[#059669] bg-[#FAF8F5] transition">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-semibold text-[#4B6358] mb-1">Desa / Kelurahan</label>
                                    <input type="text" wire:model="village" placeholder="Contoh: Mekar Baru" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] focus:border-[#059669] bg-[#FAF8F5] transition">
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-[11px] font-semibold text-[#4B6358] mb-1">Detail Jalan / Kampung / RT / RW *</label>
                                    <textarea wire:model="address" rows="2" placeholder="Contoh: Kp. Lembur Sawah RT 03 / RW 01 No. 12" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] focus:border-[#059669] bg-[#FAF8F5] transition"></textarea>
                                    @error('address') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="button" wire:click="nextStep" class="px-6 py-3 rounded-xl bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs tracking-wider uppercase transition shadow-xs cursor-pointer">
                            Lanjut ke Data Orang Tua &rarr;
                        </button>
                    </div>
                </div>
            @endif

            <!-- STEP 2: DATA ORANG TUA / WALI -->
            @if ($step === 2)
                <div class="space-y-8">
                    <div class="border-b border-[#E5E0D8]/60 pb-3">
                        <h2 class="font-sans font-bold text-xl text-[#0D3B2E]">Langkah 2: Data Orang Tua &amp; Wali Santri</h2>
                        <p class="text-xs text-[#4B6358]">Lengkapi identitas ayah kandung, ibu kandung, serta penanggung jawab wali santri.</p>
                    </div>

                    <!-- 1. DATA AYAH KANDUNG -->
                    <div class="p-5 bg-[#FAF8F5] rounded-2xl border border-[#E5E0D8] space-y-4">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E]">A. Data Ayah Kandung</h3>
                            <span class="text-xs font-mono font-bold text-[#059669]">Ayah</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Nama Ayah Kandung *</label>
                                <input type="text" wire:model="father_name" placeholder="Nama lengkap ayah" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                                @error('father_name') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Status Keberadaan</label>
                                <select wire:model="father_status" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                                    <option value="Hidup">Masih Hidup</option>
                                    <option value="Meninggal">Meninggal Dunia</option>
                                    <option value="Bercerai">Bercerai</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">NIK Ayah (16 Digit)</label>
                                <input type="text" wire:model="father_nik" maxlength="16" placeholder="NIK Ayah Kandung" class="w-full px-3.5 py-2 text-sm font-mono rounded-xl border border-[#E5E0D8] bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Tempat &amp; Tanggal Lahir</label>
                                <input type="text" wire:model="father_birth" placeholder="Contoh: Serang, 12 Mei 1980" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Pendidikan Terakhir</label>
                                <input type="text" wire:model="father_education" placeholder="Contoh: S1 / SMA / SMP" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Pekerjaan Ayah</label>
                                <input type="text" wire:model="father_job" placeholder="Contoh: Karyawan Swasta / Wiraswasta / Guru" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Penghasilan Rata-rata Ayah</label>
                                <select wire:model="parent_income" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                                    <option value="< 2 Juta">&lt; 2 Juta</option>
                                    <option value="2-5 Juta">2 - 5 Juta</option>
                                    <option value="5-10 Juta">5 - 10 Juta</option>
                                    <option value="> 10 Juta">&gt; 10 Juta</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Nomor WhatsApp Ayah {{ $father_no_wa ? '(Opsional / Tanpa WA)' : '*' }}</label>
                                <input type="text" wire:model="parent_phone" placeholder="Contoh: 081234567890" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                                @error('parent_phone') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="sm:col-span-2 flex flex-wrap items-center gap-6 pt-1 text-xs text-[#0D3B2E]">
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" wire:model="father_pesantren" class="rounded border-gray-300 text-[#0D3B2E] focus:ring-[#059669]">
                                    <span>Pernah belajar / alumni pondok pesantren</span>
                                </label>
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" wire:model="father_no_wa" class="rounded border-gray-300 text-[#0D3B2E] focus:ring-[#059669]">
                                    <span>Ayah tidak memiliki WhatsApp</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- 2. DATA IBU KANDUNG -->
                    <div class="p-5 bg-[#FAF8F5] rounded-2xl border border-[#E5E0D8] space-y-4">
                        <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E]">B. Data Ibu Kandung</h3>
                            <span class="text-xs font-mono font-bold text-[#B89758]">Ibu</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Nama Ibu Kandung *</label>
                                <input type="text" wire:model="mother_name" placeholder="Nama lengkap ibu" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                                @error('mother_name') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Status Keberadaan</label>
                                <select wire:model="mother_status" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                                    <option value="Hidup">Masih Hidup</option>
                                    <option value="Meninggal">Meninggal Dunia</option>
                                    <option value="Bercerai">Bercerai</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">NIK Ibu (16 Digit)</label>
                                <input type="text" wire:model="mother_nik" maxlength="16" placeholder="NIK Ibu Kandung" class="w-full px-3.5 py-2 text-sm font-mono rounded-xl border border-[#E5E0D8] bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Tempat &amp; Tanggal Lahir</label>
                                <input type="text" wire:model="mother_birth" placeholder="Contoh: Serang, 18 Agustus 1983" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Pendidikan Terakhir</label>
                                <input type="text" wire:model="mother_education" placeholder="Contoh: SMA / D3 / S1" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Pekerjaan Ibu</label>
                                <input type="text" wire:model="mother_job" placeholder="Contoh: Ibu Rumah Tangga / Guru / Pedagang" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Penghasilan Ibu (Opsional)</label>
                                <input type="text" wire:model="mother_income" placeholder="Contoh: < 2 Juta" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Nomor WhatsApp Ibu {{ $father_no_wa ? '*' : '' }}</label>
                                <input type="text" wire:model="mother_phone" placeholder="Contoh: 08xxxxxxxxxx" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                                @error('mother_phone') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="sm:col-span-2 flex flex-wrap items-center gap-6 pt-1 text-xs text-[#0D3B2E]">
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" wire:model="mother_pesantren" class="rounded border-gray-300 text-[#0D3B2E] focus:ring-[#059669]">
                                    <span>Pernah belajar / alumni pondok pesantren</span>
                                </label>
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" wire:model="mother_no_wa" class="rounded border-gray-300 text-[#0D3B2E] focus:ring-[#059669]">
                                    <span>Ibu tidak memiliki WhatsApp</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- 3. DATA WALI SANTRI (RADIO: AYAH / IBU / LAINNYA) -->
                    <div class="p-5 bg-white rounded-2xl border border-[#E5E0D8] space-y-4">
                        <div class="border-b border-[#E5E0D8] pb-2">
                            <h3 class="font-sans font-bold text-base text-[#0D3B2E]">C. Data Wali Santri (Penanggung Jawab Utama)</h3>
                            <p class="text-xs text-[#4B6358]">Pilih siapa yang menjadi wali utama pendaftaran santri.</p>
                        </div>

                        <div class="flex items-center gap-6 text-xs font-semibold text-[#0D3B2E]">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="radio" wire:model.live="guardian_type" value="ayah" class="text-[#0D3B2E] focus:ring-[#059669]">
                                <span>Sama dengan Ayah Kandung</span>
                            </label>
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="radio" wire:model.live="guardian_type" value="ibu" class="text-[#0D3B2E] focus:ring-[#059669]">
                                <span>Sama dengan Ibu Kandung</span>
                            </label>
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="radio" wire:model.live="guardian_type" value="lainnya" class="text-[#0D3B2E] focus:ring-[#059669]">
                                <span>Lainnya (Wali Lain)</span>
                            </label>
                        </div>

                        <!-- Muncul jika 'Lainnya' dipilih -->
                        @if ($guardian_type === 'lainnya')
                            <div class="p-4 bg-[#FAF8F5] rounded-xl border border-[#E5E0D8] grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                                <div>
                                    <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Nama Lengkap Wali *</label>
                                    <input type="text" wire:model="guardian_name" placeholder="Nama wali santri" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                                    @error('guardian_name') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Hubungan dengan Santri *</label>
                                    <input type="text" wire:model="guardian_relation" placeholder="Contoh: Kakek / Paman / Kakak Kandung" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                                    @error('guardian_relation') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">NIK Wali</label>
                                    <input type="text" wire:model="guardian_nik" maxlength="16" placeholder="NIK Wali" class="w-full px-3.5 py-2 text-sm font-mono rounded-xl border border-[#E5E0D8] bg-white transition">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Nomor WhatsApp Wali *</label>
                                    <input type="text" wire:model="guardian_phone" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                                    @error('guardian_phone') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Pekerjaan Wali</label>
                                    <input type="text" wire:model="guardian_job" placeholder="Pekerjaan wali" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-between pt-4">
                        <button type="button" wire:click="previousStep" class="px-5 py-2.5 rounded-xl border border-[#E5E0D8] text-[#4B6358] text-xs font-semibold uppercase tracking-wider hover:border-[#0D3B2E] hover:text-[#0D3B2E] bg-white transition shadow-2xs cursor-pointer">
                            &larr; Kembali ke Data Santri
                        </button>
                        <button type="button" wire:click="nextStep" class="px-6 py-3 rounded-xl bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition shadow-xs cursor-pointer">
                            Lanjut ke Sekolah &amp; Pilihan &rarr;
                        </button>
                    </div>
                </div>
            @endif

            <!-- STEP 3: SEKOLAH ASAL & PILIHAN PROGRAM -->
            @if ($step === 3)
                <div class="space-y-6">
                    <div class="border-b border-[#E5E0D8]/60 pb-3">
                        <h2 class="font-sans font-bold text-xl text-[#0D3B2E]">Langkah 3: Sekolah Asal &amp; Pilihan Program Tujuan</h2>
                        <p class="text-xs text-[#4B6358]">Informasi riwayat pendidikan dasar dan pilihan program pendidikan di pesantren.</p>
                    </div>

                    <!-- Sekolah Asal -->
                    <div class="p-5 bg-[#FAF8F5] rounded-2xl border border-[#E5E0D8] space-y-4">
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E] border-b border-[#E5E0D8] pb-2">A. Riwayat Sekolah Asal</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Jenjang Sekolah Asal</label>
                                <select wire:model="school_level" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                                    <option value="SD">SD (Sekolah Dasar)</option>
                                    <option value="MI">MI (Madrasah Ibtidaiyah)</option>
                                    <option value="Paket A">Paket A</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Nama Sekolah Asal *</label>
                                <input type="text" wire:model="previous_school" placeholder="Contoh: SDIT Daar El Fikri / SDN 1 Petir" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                                @error('previous_school') <span class="text-[11px] text-red-600 block mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-semibold text-[#0D3B2E] mb-1">Alamat Sekolah Asal (Kota / Kecamatan)</label>
                                <input type="text" wire:model="school_address" placeholder="Contoh: Kec. Petir, Kab. Serang, Banten" class="w-full px-3.5 py-2 text-sm rounded-xl border border-[#E5E0D8] bg-white transition">
                            </div>
                        </div>
                    </div>

                    <!-- Pilihan Program Tujuan -->
                    <div class="space-y-3">
                        <h3 class="font-sans font-bold text-base text-[#0D3B2E]">B. Pilihan Jenjang Program Tujuan *</h3>
                        @error('program_type')
                            <div class="p-3 bg-red-50 border-l-4 border-red-500 text-red-800 text-xs rounded-xl">
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
                            <label class="rounded-2xl p-6 border-2 transition-all duration-300 relative flex flex-col justify-between {{ $mtsQuotaOpen ? 'cursor-pointer hover:shadow-md' : 'opacity-60 cursor-not-allowed bg-gray-50' }} {{ $program_type === 'MTS' && $mtsQuotaOpen ? 'border-[#0D3B2E] bg-[#FAF8F5]' : 'border-[#E5E0D8]' }}">
                                <input type="radio" wire:model.live="program_type" value="MTS" {{ ! $mtsQuotaOpen ? 'disabled' : '' }} class="sr-only">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-[#0D3B2E] text-white">MTS Mukim 24 Jam</span>
                                        @if ($mtsQuotaOpen)
                                            <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center {{ $program_type === 'MTS' ? 'border-[#0D3B2E] bg-[#0D3B2E]' : 'border-gray-300' }}"></span>
                                        @else
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-red-100 text-red-800">Kuota Penuh</span>
                                        @endif
                                    </div>
                                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Madrasah Tsanawiyah (MTs)</h3>
                                    <p class="text-xs text-[#4B6358] mt-1 leading-relaxed">Pendidikan formal Kemenag berpadu asrama mukim 24 jam dengan bimbingan intensif 30 juz Al-Qur'an.</p>
                                    @if($mtsRem !== null && $mtsQuotaOpen)
                                        <div class="mt-2 text-[11px] font-semibold text-emerald-700">Sisa kuota: {{ $mtsRem }} santri</div>
                                    @endif
                                </div>
                                <div class="mt-6 pt-4 border-t border-[#E5E0D8]/60 flex items-baseline justify-between text-xs">
                                    <span class="text-[#4B6358]">Biaya Masuk:</span>
                                    <span class="font-bold text-[#0D3B2E]">Putra Rp 3.250.000 | Putri Rp 3.350.000</span>
                                </div>
                            </label>

                            <!-- MDTA Card -->
                            <label class="rounded-2xl p-6 border-2 transition-all duration-300 relative flex flex-col justify-between {{ $mdtaQuotaOpen ? 'cursor-pointer hover:shadow-md' : 'opacity-60 cursor-not-allowed bg-gray-50' }} {{ $program_type === 'MDTA' && $mdtaQuotaOpen ? 'border-amber-600 bg-[#FAF8F5]' : 'border-[#E5E0D8]' }}">
                                <input type="radio" wire:model.live="program_type" value="MDTA" {{ ! $mdtaQuotaOpen ? 'disabled' : '' }} class="sr-only">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-xs font-bold px-3 py-1 rounded-full bg-amber-600 text-white">MDTA Sekolah Sore</span>
                                        @if ($mdtaQuotaOpen)
                                            <span class="w-5 h-5 rounded-full border-2 flex items-center justify-center {{ $program_type === 'MDTA' ? 'border-amber-600 bg-amber-600' : 'border-gray-300' }}"></span>
                                        @else
                                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-red-100 text-red-800">Kuota Penuh</span>
                                        @endif
                                    </div>
                                    <h3 class="font-sans font-bold text-lg text-[#0D3B2E]">Madrasah Diniyah (MDTA)</h3>
                                    <p class="text-xs text-[#4B6358] mt-1 leading-relaxed">Santri non-mukim belajar sore hari materi Fiqih, Aqidah, dan Tahfidz Juz 30.</p>
                                    @if($mdtaRem !== null && $mdtaQuotaOpen)
                                        <div class="mt-2 text-[11px] font-semibold text-amber-700">Sisa kuota: {{ $mdtaRem }} santri</div>
                                    @endif
                                </div>
                                <div class="mt-6 pt-4 border-t border-[#E5E0D8]/60 flex items-baseline justify-between text-xs">
                                    <span class="text-[#4B6358]">Biaya Masuk:</span>
                                    <span class="font-bold text-[#0D3B2E]">Rp 52.000</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-between pt-4">
                        <button type="button" wire:click="previousStep" class="px-5 py-2.5 rounded-xl border border-[#E5E0D8] text-[#4B6358] text-xs font-semibold uppercase tracking-wider hover:border-[#0D3B2E] hover:text-[#0D3B2E] bg-white transition shadow-2xs cursor-pointer">
                            &larr; Kembali ke Data Orang Tua
                        </button>
                        <button type="button" wire:click="nextStep" class="px-6 py-3 rounded-xl bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition shadow-xs cursor-pointer">
                            Lanjut ke Unggah Dokumen &rarr;
                        </button>
                    </div>
                </div>
            @endif

            <!-- STEP 4: UPLOAD DROPZONE DOKUMEN -->
            @if ($step === 4)
                <div class="space-y-6">
                    <div class="border-b border-[#E5E0D8]/60 pb-3">
                        <h2 class="font-sans font-bold text-xl text-[#0D3B2E]">Langkah 4: Unggah Berkas Dokumen Persyaratan</h2>
                        <p class="text-xs text-[#4B6358]">Format yang didukung: <strong>JPG, PNG, atau PDF</strong> dengan ukuran maksimal <strong>5MB</strong> per berkas.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- 1. Pasfoto -->
                        <div class="border border-[#E5E0D8] p-4 rounded-xl bg-white space-y-2 shadow-2xs">
                            <label class="block text-xs font-semibold text-[#0D3B2E]">1. Pasfoto Resmi Santri (3x4) *</label>
                            <input type="file" wire:model="document_photo" accept="image/png,image/jpeg,image/jpg" class="block w-full text-xs text-[#4B6358] file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#0D3B2E] file:text-white hover:file:bg-[#059669]">
                            <div wire:loading wire:target="document_photo" class="text-[10px] text-amber-600">Mengunggah pasfoto...</div>
                            @if ($document_photo)
                                <span class="text-[10px] text-emerald-600 font-medium block">&check; Berkas terpilih</span>
                            @endif
                            @error('document_photo') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- 2. Kartu Keluarga -->
                        <div class="border border-[#E5E0D8] p-4 rounded-xl bg-white space-y-2 shadow-2xs">
                            <label class="block text-xs font-semibold text-[#0D3B2E]">2. Scan Kartu Keluarga (KK) *</label>
                            <input type="file" wire:model="document_kk" accept="application/pdf,image/*" class="block w-full text-xs text-[#4B6358] file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#0D3B2E] file:text-white hover:file:bg-[#059669]">
                            <div wire:loading wire:target="document_kk" class="text-[10px] text-amber-600">Mengunggah KK...</div>
                            @if ($document_kk)
                                <span class="text-[10px] text-emerald-600 font-medium block">&check; Berkas terpilih</span>
                            @endif
                            @error('document_kk') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- 3. Akta Kelahiran -->
                        <div class="border border-[#E5E0D8] p-4 rounded-xl bg-white space-y-2 shadow-2xs">
                            <label class="block text-xs font-semibold text-[#0D3B2E]">3. Scan Akta Kelahiran</label>
                            <input type="file" wire:model="document_akta" accept="application/pdf,image/*" class="block w-full text-xs text-[#4B6358] file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#0D3B2E] file:text-white hover:file:bg-[#059669]">
                            <div wire:loading wire:target="document_akta" class="text-[10px] text-amber-600">Mengunggah akta...</div>
                            @if ($document_akta)
                                <span class="text-[10px] text-emerald-600 font-medium block">&check; Berkas terpilih</span>
                            @endif
                            @error('document_akta') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- 4. KTP Ayah -->
                        <div class="border border-[#E5E0D8] p-4 rounded-xl bg-white space-y-2 shadow-2xs">
                            <label class="block text-xs font-semibold text-[#0D3B2E]">4. Scan / Foto KTP Ayah Kandung</label>
                            <input type="file" wire:model="document_ktp_ayah" accept="application/pdf,image/*" class="block w-full text-xs text-[#4B6358] file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#0D3B2E] file:text-white hover:file:bg-[#059669]">
                            <div wire:loading wire:target="document_ktp_ayah" class="text-[10px] text-amber-600">Mengunggah KTP Ayah...</div>
                            @if ($document_ktp_ayah)
                                <span class="text-[10px] text-emerald-600 font-medium block">&check; Berkas terpilih</span>
                            @endif
                            @error('document_ktp_ayah') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- 5. KTP Ibu -->
                        <div class="border border-[#E5E0D8] p-4 rounded-xl bg-white space-y-2 shadow-2xs">
                            <label class="block text-xs font-semibold text-[#0D3B2E]">5. Scan / Foto KTP Ibu Kandung</label>
                            <input type="file" wire:model="document_ktp_ibu" accept="application/pdf,image/*" class="block w-full text-xs text-[#4B6358] file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#0D3B2E] file:text-white hover:file:bg-[#059669]">
                            <div wire:loading wire:target="document_ktp_ibu" class="text-[10px] text-amber-600">Mengunggah KTP Ibu...</div>
                            @if ($document_ktp_ibu)
                                <span class="text-[10px] text-emerald-600 font-medium block">&check; Berkas terpilih</span>
                            @endif
                            @error('document_ktp_ibu') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- 6. Ijazah / SKL -->
                        <div class="border border-[#E5E0D8] p-4 rounded-xl bg-white space-y-2 shadow-2xs">
                            <label class="block text-xs font-semibold text-[#0D3B2E]">6. Scan Ijazah / Surat Keterangan Lulus (SKL)</label>
                            <input type="file" wire:model="document_ijazah" accept="application/pdf,image/*" class="block w-full text-xs text-[#4B6358] file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#0D3B2E] file:text-white hover:file:bg-[#059669]">
                            <div wire:loading wire:target="document_ijazah" class="text-[10px] text-amber-600">Mengunggah Ijazah...</div>
                            @if ($document_ijazah)
                                <span class="text-[10px] text-emerald-600 font-medium block">&check; Berkas terpilih</span>
                            @endif
                            @error('document_ijazah') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- 7. Print NISN -->
                        <div class="border border-[#E5E0D8] p-4 rounded-xl bg-white space-y-2 shadow-2xs">
                            <label class="block text-xs font-semibold text-[#0D3B2E]">7. Print Out Profil NISN Resmi</label>
                            <input type="file" wire:model="document_nisn" accept="application/pdf,image/*" class="block w-full text-xs text-[#4B6358] file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#0D3B2E] file:text-white hover:file:bg-[#059669]">
                            <div wire:loading wire:target="document_nisn" class="text-[10px] text-amber-600">Mengunggah Print NISN...</div>
                            @if ($document_nisn)
                                <span class="text-[10px] text-emerald-600 font-medium block">&check; Berkas terpilih</span>
                            @endif
                            @error('document_nisn') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- 8. Bukti Bayar Transfer -->
                        <div class="border border-[#E5E0D8] p-4 rounded-xl bg-white space-y-2 shadow-2xs">
                            <label class="block text-xs font-semibold text-[#0D3B2E]">8. Bukti Transfer Infaq Pendaftaran (Opsional)</label>
                            <input type="file" wire:model="document_payment" accept="application/pdf,image/*" class="block w-full text-xs text-[#4B6358] file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#0D3B2E] file:text-white hover:file:bg-[#059669]">
                            <div wire:loading wire:target="document_payment" class="text-[10px] text-amber-600">Mengunggah bukti bayar...</div>
                            @if ($document_payment)
                                <span class="text-[10px] text-emerald-600 font-medium block">&check; Berkas terpilih</span>
                            @endif
                            @error('document_payment') <span class="text-[11px] text-red-600 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-between pt-4">
                        <button type="button" wire:click="previousStep" class="px-5 py-2.5 rounded-xl border border-[#E5E0D8] text-[#4B6358] text-xs font-semibold uppercase tracking-wider hover:border-[#0D3B2E] hover:text-[#0D3B2E] bg-white transition shadow-2xs cursor-pointer">
                            &larr; Kembali ke Sekolah &amp; Pilihan
                        </button>
                        <button type="button" wire:click="nextStep" class="px-6 py-3 rounded-xl bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition shadow-xs cursor-pointer">
                            Lanjut ke Review Data &rarr;
                        </button>
                    </div>
                </div>
            @endif

            <!-- STEP 5: REVIEW RINGKASAN DATA & SUBMIT -->
            @if ($step === 5)
                <div class="space-y-8">
                    <div class="border-b border-[#E5E0D8]/60 pb-3">
                        <h2 class="font-sans font-bold text-xl text-[#0D3B2E]">Langkah 5: Tinjau Ulang Data &amp; Persetujuan Submit</h2>
                        <p class="text-xs text-[#4B6358]">Pastikan seluruh data yang Anda masukkan telah benar dan sesuai dengan dokumen resmi.</p>
                    </div>

                    @error('general')
                        <div class="p-4 bg-red-50 border-l-4 border-red-500 text-red-800 text-xs rounded-xl">
                            {{ $message }}
                        </div>
                    @enderror

                    <!-- Ringkasan Grid -->
                    <div class="space-y-4 text-xs">
                        <!-- Review 1: Calon Santri -->
                        <div class="p-5 bg-[#FAF8F5] rounded-xl border border-[#E5E0D8] space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <strong class="font-sans text-sm text-[#0D3B2E]">1. Data Diri Calon Santri</strong>
                                <button type="button" wire:click="goToStep(1)" class="text-[#059669] hover:underline font-semibold cursor-pointer">Ubah</button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[#18181B]">
                                <div>Nama Lengkap: <strong class="text-[#0D3B2E]">{{ $full_name }}</strong></div>
                                <div>NIK: <strong class="font-mono text-[#0D3B2E]">{{ $nik }}</strong></div>
                                <div>NISN: <span class="font-mono">{{ $nisn ?: '-' }}</span></div>
                                <div>Jenis Kelamin: <strong>{{ $gender === 'L' ? 'Laki-laki (Ikhwan)' : 'Perempuan (Akhwat)' }}</strong></div>
                                <div>TTL: <strong>{{ $birth_place }}, {{ $birth_date }}</strong></div>
                                <div>Anak Ke: <strong>{{ $child_order }}</strong> dari <strong>{{ $total_siblings ?: '-' }}</strong> bersaudara</div>
                                <div class="sm:col-span-2">Alamat: <span class="text-[#4B6358]">{{ $address }}, {{ $village }}, {{ $district }}, {{ $city }}, {{ $province }}</span></div>
                            </div>
                        </div>

                        <!-- Review 2: Orang Tua / Wali -->
                        <div class="p-5 bg-[#FAF8F5] rounded-xl border border-[#E5E0D8] space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <strong class="font-sans text-sm text-[#0D3B2E]">2. Data Orang Tua &amp; Wali</strong>
                                <button type="button" wire:click="goToStep(2)" class="text-[#059669] hover:underline font-semibold cursor-pointer">Ubah</button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[#18181B]">
                                <div>Ayah Kandung: <strong class="text-[#0D3B2E]">{{ $father_name }}</strong> ({{ $father_status }})</div>
                                <div>No. WA Ayah: <span class="font-mono">{{ $parent_phone }}</span></div>
                                <div>Ibu Kandung: <strong class="text-[#0D3B2E]">{{ $mother_name }}</strong> ({{ $mother_status }})</div>
                                <div>No. WA Ibu: <span class="font-mono">{{ $mother_phone ?: '-' }}</span></div>
                                <div>Penghasilan: <span>{{ $parent_income }}</span></div>
                                <div>Wali Utama: <strong class="capitalize">{{ $guardian_type === 'lainnya' ? ($guardian_name . ' (' . $guardian_relation . ')') : $guardian_type }}</strong></div>
                            </div>
                        </div>

                        <!-- Review 3: Pilihan Program -->
                        <div class="p-5 bg-[#FAF8F5] rounded-xl border border-[#E5E0D8] space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <strong class="font-sans text-sm text-[#0D3B2E]">3. Sekolah Asal &amp; Pilihan Program</strong>
                                <button type="button" wire:click="goToStep(3)" class="text-[#059669] hover:underline font-semibold cursor-pointer">Ubah</button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-[#18181B]">
                                <div>Sekolah Asal: <strong>{{ $previous_school }}</strong> ({{ $school_level }})</div>
                                <div>Program Tujuan: <strong class="text-[#0D3B2E]">{{ $program_type === 'MTS' ? 'MTs (Madrasah Tsanawiyah - Mukim 24 Jam)' : 'MDTA (Madrasah Diniyah - Non-Mukim)' }}</strong></div>
                            </div>
                        </div>

                        <!-- Review 4: Dokumen Terlampir -->
                        <div class="p-5 bg-[#FAF8F5] rounded-xl border border-[#E5E0D8] space-y-3">
                            <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-2">
                                <strong class="font-sans text-sm text-[#0D3B2E]">4. Berkas Dokumen Terlampir</strong>
                                <button type="button" wire:click="goToStep(4)" class="text-[#059669] hover:underline font-semibold cursor-pointer">Ubah</button>
                            </div>
                            <div class="flex flex-wrap gap-2 text-xs">
                                <span class="px-2.5 py-1 rounded-md bg-emerald-100 text-[#084C27] font-semibold">&check; Pasfoto 3x4</span>
                                <span class="px-2.5 py-1 rounded-md bg-emerald-100 text-[#084C27] font-semibold">&check; Kartu Keluarga</span>
                                @if ($document_akta) <span class="px-2.5 py-1 rounded-md bg-emerald-100 text-[#084C27] font-semibold">&check; Akta Kelahiran</span> @endif
                                @if ($document_ktp_ayah) <span class="px-2.5 py-1 rounded-md bg-emerald-100 text-[#084C27] font-semibold">&check; KTP Ayah</span> @endif
                                @if ($document_ktp_ibu) <span class="px-2.5 py-1 rounded-md bg-emerald-100 text-[#084C27] font-semibold">&check; KTP Ibu</span> @endif
                                @if ($document_ijazah) <span class="px-2.5 py-1 rounded-md bg-emerald-100 text-[#084C27] font-semibold">&check; Ijazah/SKL</span> @endif
                                @if ($document_nisn) <span class="px-2.5 py-1 rounded-md bg-emerald-100 text-[#084C27] font-semibold">&check; Print NISN</span> @endif
                                @if ($document_payment) <span class="px-2.5 py-1 rounded-md bg-emerald-100 text-[#084C27] font-semibold">&check; Bukti Transfer</span> @endif
                            </div>
                        </div>
                    </div>

                    <!-- Persetujuan Checkbox -->
                    <div class="p-5 bg-emerald-50/60 rounded-xl border border-emerald-200/60 space-y-2">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" wire:model="agreement" class="mt-1 rounded border-gray-300 text-[#0D3B2E] focus:ring-[#059669]">
                            <span class="text-xs text-[#0D3B2E] leading-relaxed">
                                Saya menyatakan dengan sesungguhnya bahwa seluruh data yang diisikan dalam formulir pendaftaran ini adalah benar, lengkap, dan sah. Apabila di kemudian hari ditemukan ketidaksesuaian data, saya bersedia menerima sanksi pembatalan kelulusan santri sesuai ketentuan Pondok Pesantren Modern Tahfidzul Qur'an Daar El Tazkiyah Sumardi.
                            </span>
                        </label>
                        @error('agreement') <span class="text-[11px] text-red-600 block pl-7">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-between pt-4 border-t border-[#E5E0D8]/60">
                        <button type="button" wire:click="previousStep" class="px-5 py-2.5 rounded-xl border border-[#E5E0D8] text-[#4B6358] text-xs font-semibold uppercase tracking-wider hover:border-[#0D3B2E] hover:text-[#0D3B2E] bg-white transition shadow-2xs cursor-pointer">
                            &larr; Kembali ke Dokumen
                        </button>
                        <button type="button" wire:click="submit" wire:loading.attr="disabled" class="px-8 py-3.5 rounded-xl bg-[#0D3B2E] hover:bg-[#059669] text-white font-bold text-xs uppercase tracking-wider transition disabled:opacity-50 shadow-md cursor-pointer">
                            <span wire:loading.remove wire:target="submit">Kirim Formulir Pendaftaran PSB &rarr;</span>
                            <span wire:loading wire:target="submit">Sedang Memproses Pendaftaran...</span>
                        </button>
                    </div>
                </div>
            @endif

        </div>
    @endif
</div>
