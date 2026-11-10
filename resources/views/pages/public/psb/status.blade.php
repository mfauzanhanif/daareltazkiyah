@extends('layouts.public', ['title' => 'Cek Status Pendaftaran PSB - PPMTQ Daar El Tazkiyah Sumardi'])

@section('content')
<section class="py-12 md:py-16 bg-[#FAF8F5]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <div class="text-center space-y-3">
            <span class="text-xs font-semibold uppercase tracking-widest text-[#B89758]">Layanan Mandiri Calon Santri</span>
            <div class="flex items-center justify-center gap-3">
                <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                <h1 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                    Cek Status Kelulusan & Verifikasi Berkas
                </h1>
                <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
            </div>
            <p class="text-xs sm:text-sm text-[#4B6358] max-w-lg mx-auto leading-relaxed">
                Masukkan nomor registrasi resmi (format: PSB-202X-PROG-XXX) dan kode akses token rahasia yang tertera pada lembar bukti pendaftaran Anda.
            </p>
        </div>

        <livewire:public.psb-check-status />

        <div class="text-center text-xs text-[#4B6358] border-t border-[#E5E0D8]/60 pt-4">
            Kendala teknis atau lupa nomor registrasi / token akses? <a href="{{ route('contact.index') }}" class="text-[#0D3B2E] font-semibold hover:text-[#059669] hover:underline">Hubungi Sekretariat Panitia PSB</a>.
        </div>

    </div>
</section>
@endsection
