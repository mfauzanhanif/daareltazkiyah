@extends('layouts.public')

@section('content')
<section class="py-12 md:py-20 bg-[#FDFBF7]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <div class="text-center space-y-3">
            <span class="text-xs md:text-sm font-semibold uppercase tracking-wider text-[#059669]">Layanan Mandiri</span>
            <h1 class="font-serif text-3xl md:text-4xl font-bold text-[#084C27]">Cek Status Pendaftaran PSB</h1>
            <p class="text-sm text-[#4B6358]">Masukkan nomor registrasi dan token akses rahasia yang tertera pada bukti pendaftaran Anda.</p>
            <div class="w-16 h-1 bg-[#D97706] mx-auto rounded-full"></div>
        </div>

        <livewire:public.psb-check-status />

        <div class="text-center text-xs text-gray-400">
            Lupa nomor registrasi atau token akses? Silakan hubungi sekretariat panitia via WhatsApp.
        </div>

    </div>
</section>
@endsection
