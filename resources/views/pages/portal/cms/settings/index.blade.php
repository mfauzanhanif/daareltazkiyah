<x-layouts::app :title="__('Pengaturan Situs & PSB')">
    <div class="space-y-6 max-w-4xl">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl">{{ __('Pengaturan Sistem & Situs') }}</flux:heading>
                <flux:subheading>{{ __('Kelola nomor kontak WhatsApp, identitas pondok, dan rekening pembayaran PSB.') }}</flux:subheading>
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

        <form action="{{ route('admin.cms.settings.update') }}" method="POST" class="space-y-6">
            @csrf

            <!-- WhatsApp & PSB Section -->
            <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4">
                <flux:heading size="lg">Kontak & Layanan PSB Online</flux:heading>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1">Nomor WhatsApp Admin PSB *</label>
                        <input type="text" name="psb_whatsapp_number" value="{{ old('psb_whatsapp_number', $settings['psb_whatsapp_number']->value ?? '6281234567890') }}" required placeholder="Format: 628xxxxxxxxxx" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 focus:ring-1 focus:ring-[#084C27]">
                        <p class="text-[10px] text-zinc-400 mt-1">Digunakan untuk tombol konfirmasi pendaftaran santri baru dan floating WhatsApp.</p>
                    </div>
                </div>
            </div>

            <!-- Identity Section -->
            <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4">
                <flux:heading size="lg">Identitas Lembaga & Kontak</flux:heading>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold mb-1">Nama Resmi Lembaga</label>
                        <input type="text" name="school_name" value="{{ old('school_name', $settings['school_name']->value ?? 'PPMTQ Daar El Tazkiyah Sumardi') }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold mb-1">Alamat Lengkap</label>
                        <textarea name="school_address" rows="2" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">{{ old('school_address', $settings['school_address']->value ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Nomor Telepon Kantor</label>
                        <input type="text" name="school_phone" value="{{ old('school_phone', $settings['school_phone']->value ?? '') }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Email Resmi</label>
                        <input type="email" name="school_email" value="{{ old('school_email', $settings['school_email']->value ?? '') }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                </div>
            </div>

            <!-- Bank Account Section -->
            <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4">
                <flux:heading size="lg">Rekening Bank Pembayaran Infaq PSB</flux:heading>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1">Nama Bank</label>
                        <input type="text" name="bank_name" value="{{ old('bank_name', $settings['bank_name']->value ?? 'Bank Syariah Indonesia (BSI)') }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Nomor Rekening</label>
                        <input type="text" name="bank_account_number" value="{{ old('bank_account_number', $settings['bank_account_number']->value ?? '') }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">Atas Nama Rekening</label>
                        <input type="text" name="bank_account_name" value="{{ old('bank_account_name', $settings['bank_account_name']->value ?? 'PPMTQ Daar El Tazkiyah') }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                </div>
            </div>

            <!-- Tuition Fees Section -->
            <div class="p-6 rounded-2xl bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 space-y-4">
                <flux:heading size="lg">Biaya Bulanan Program</flux:heading>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1">SPP Bulanan MTS (Rp)</label>
                        <input type="number" name="monthly_fee_mts" value="{{ old('monthly_fee_mts', $settings['monthly_fee_mts']->value ?? '1200000') }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1">SPP Bulanan MDTA (Rp)</label>
                        <input type="number" name="monthly_fee_mdta" value="{{ old('monthly_fee_mdta', $settings['monthly_fee_mdta']->value ?? '350000') }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="px-6 py-2.5 bg-[#084C27] hover:bg-[#059669] text-white text-xs font-semibold rounded-xl transition shadow-xs cursor-pointer">
                    Simpan Semua Pengaturan
                </button>
            </div>
        </form>
    </div>
</x-layouts::app>
