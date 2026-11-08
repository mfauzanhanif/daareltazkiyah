@extends('layouts.public')

@section('content')
<section class="py-12 md:py-20 bg-[#FDFBF7]" x-data="{ copiedReg: false, copiedToken: false }">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Success Card -->
        <div class="bg-white p-8 md:p-12 rounded-md border border-[#E5E0D8] text-center space-y-8">
            <div class="w-20 h-20 mx-auto rounded-md bg-[#FAF8F5] border border-[#B89758] text-[#059669] flex items-center justify-center">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>

            <div class="space-y-2">
                <span class="inline-block px-3 py-1 rounded-md bg-emerald-50 text-emerald-800 text-xs font-bold uppercase tracking-wider">Pendaftaran Berhasil</span>
                <h1 class="font-sans text-2xl md:text-4xl font-bold text-[#0D3B2E]">Alhamdulillah, Formulir PSB Telah Diterima!</h1>
                <p class="text-sm text-[#4B6358] max-w-lg mx-auto">
                    Data pendaftaran atas nama <strong>{{ $applicant->full_name }}</strong> untuk program <strong>{{ $applicant->program_type->value ?? $applicant->program_type }}</strong> telah tersimpan dalam sistem kami.
                </p>
            </div>

            <!-- Credentials Box (Secret Token & Registration Number with Copy Actions) -->
            <div class="bg-[#FAF8F5] p-6 rounded-md border-2 border-[#B89758]/40 max-w-md mx-auto space-y-5 text-left">
                <!-- Registration Number -->
                <div class="space-y-1.5">
                    <span class="text-xs text-[#4B6358] uppercase tracking-wider font-semibold">Nomor Registrasi Anda</span>
                    <div class="flex items-center justify-between bg-white px-3.5 py-2.5 rounded-md border border-[#E5E0D8]">
                        <span class="font-mono text-xl sm:text-2xl font-extrabold text-[#0D3B2E] tracking-wider select-all">
                            {{ $applicant->registration_number }}
                        </span>
                        <button type="button"
                                @click="navigator.clipboard.writeText('{{ $applicant->registration_number }}'); copiedReg = true; setTimeout(() => copiedReg = false, 2500)"
                                class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1.5 rounded-md bg-emerald-50 hover:bg-emerald-100 text-[#0D3B2E] transition shrink-0"
                                title="Salin Nomor Registrasi">
                            <span x-text="copiedReg ? 'Tersalin!' : 'Salin'"></span>
                        </button>
                    </div>
                </div>

                <!-- Secret Access Token -->
                <div class="pt-3 border-t border-[#E5E0D8] space-y-1.5">
                    <span class="text-xs text-[#4B6358] uppercase tracking-wider font-semibold">Token Akses Rahasia (8 Karakter)</span>
                    <div class="flex items-center justify-between bg-white px-3.5 py-2.5 rounded-md border border-[#E5E0D8]">
                        <span class="font-mono text-lg sm:text-xl font-bold text-[#B89758] tracking-widest select-all">
                            {{ $applicant->access_token }}
                        </span>
                        <button type="button"
                                @click="navigator.clipboard.writeText('{{ $applicant->access_token }}'); copiedToken = true; setTimeout(() => copiedToken = false, 2500)"
                                class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1.5 rounded-md bg-amber-50 hover:bg-amber-100 text-[#B89758] transition shrink-0"
                                title="Salin Token Akses">
                            <span x-text="copiedToken ? 'Tersalin!' : 'Salin'"></span>
                        </button>
                    </div>
                </div>

                <div class="text-[11px] text-[#4B6358] bg-amber-50/60 p-2.5 rounded-md border border-amber-200/40 flex items-start gap-1.5">
                    <svg class="w-4 h-4 text-[#B89758] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span>Simpan nomor registrasi dan token akses ini baik-baik untuk melakukan cek status, pengumuman, dan revisi berkas pendaftaran di kemudian hari.</span>
                </div>
            </div>

            <!-- Actions: Download PDF (Outline) & WhatsApp Confirmation (WhatsApp Green) per DESIGN §11.3 -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                <a href="{{ route('psb.proof', $applicant->registration_number) }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-md border border-[#0D3B2E] hover:bg-[#0D3B2E] text-[#0D3B2E] hover:text-white font-semibold text-xs tracking-wider uppercase transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span>Unduh Bukti Pendaftaran (PDF)</span>
                </a>

                @php
                    $waNumber = \App\Models\SiteSetting::get('psb_whatsapp_number', '6281234567890');
                    $progName = ($applicant->program_type->value ?? $applicant->program_type) === 'MTS' ? 'MTS (Mukim 24 Jam)' : 'MDTA (Sekolah Sore)';
                    $waveName = $applicant->admissionWave?->name ?? 'Gelombang I';
                    $waMsg = "Assalamu'alaikum Panitia PSB PPMTQ Daar El Tazkiyah,\n\nSaya telah mendaftarkan calon santri baru secara online:\n- Nama: {$applicant->full_name}\n- No. Registrasi: {$applicant->registration_number}\n- Jenjang: {$progName}\n- Gelombang: {$waveName}\n\nMohon informasi verifikasi berkas dan pembayaran kami. Terima kasih.";
                @endphp
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $waNumber) }}?text={{ urlencode($waMsg) }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-md bg-[#25D366] hover:bg-[#1EBE5D] text-white font-semibold text-xs tracking-wider uppercase shadow-md hover:shadow-lg transition">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span>Konfirmasi via WhatsApp</span>
                </a>
            </div>

            <!-- Return Link -->
            <div class="pt-4 border-t border-[#E5E0D8]">
                <a href="{{ route('psb.status') }}" class="text-xs font-semibold text-[#0D3B2E] hover:underline">
                    Lihat / Cek Status Pendaftaran Mandiri &rarr;
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
