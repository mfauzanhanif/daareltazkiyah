@extends('layouts.public')

@section('content')
<section class="py-12 md:py-20 bg-[#FDFBF7]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        @if(!$activeWave)
            <!-- CLOSED ADMISSION STATE -->
            <div class="bg-white p-8 md:p-14 rounded-3xl border border-[#084C27]/10 shadow-card text-center space-y-6">
                <div class="w-20 h-20 mx-auto rounded-full bg-amber-50 text-[#D97706] flex items-center justify-center">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div class="space-y-2">
                    <h1 class="font-serif text-2xl md:text-3xl font-bold text-[#084C27]">Pendaftaran Santri Baru Sedang Ditutup</h1>
                    <p class="text-sm md:text-base text-[#4B6358] max-w-xl mx-auto">
                        Saat ini belum ada gelombang pendaftaran yang aktif (closed). Silakan pantau warta berkala atau hubungi panitia melalui kontak WhatsApp untuk jadwal pendaftaran gelombang berikutnya.
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
            <!-- ACTIVE REGISTRATION HEADER -->
            <div class="text-center space-y-3">
                <span class="text-xs md:text-sm font-semibold uppercase tracking-wider text-[#059669]">Portal Pendaftaran</span>
                <h1 class="font-serif text-3xl md:text-5xl font-bold text-[#084C27]">Penerimaan Santri Baru (PSB)</h1>
                <p class="text-sm text-[#4B6358]">Tahun Ajaran {{ $activeWave->academic_year }} &bull; <strong class="text-[#D97706]">{{ $activeWave->name }}</strong></p>
                <div class="w-16 h-1 bg-[#D97706] mx-auto rounded-full"></div>
            </div>

            <!-- REACTIVE MULTI-STEP REGISTRATION WIZARD -->
            <livewire:public.psb-registration :selected-program="$selectedProgram" />
        @endif

    </div>
</section>
@endsection
