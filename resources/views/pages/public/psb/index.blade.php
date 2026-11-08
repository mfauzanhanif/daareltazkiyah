@extends('layouts.public', ['title' => 'Pendaftaran PSB Online - PPMTQ Daar El Tazkiyah Sumardi'])

@section('content')
<section class="py-12 md:py-20 bg-[#FAF8F5]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        @if(!$activeWave)
            <!-- CLOSED ADMISSION STATE -->
            <div class="bg-white p-8 md:p-14 border border-[#E5E0D8] rounded-md text-center space-y-6">
                <div class="w-16 h-16 mx-auto border border-[#B89758] rounded-md bg-[#FAF8F5] text-[#B89758] flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div class="space-y-2">
                    <span class="editorial-label text-[#B89758]">STATUS PENDAFTARAN</span>
                    <h1 class="font-sans text-2xl md:text-3xl font-bold text-[#0D3B2E]">Pendaftaran Santri Baru Sedang Ditutup</h1>
                    <p class="text-xs sm:text-sm text-[#4B6358] max-w-xl mx-auto leading-relaxed">
                        Saat ini belum ada gelombang pendaftaran yang aktif. Silakan pantau pengumuman resmi berkala atau hubungi panitia melalui kontak WhatsApp untuk informasi gelombang berikutnya.
                    </p>
                </div>
                <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-2.5 rounded-md border border-[#E5E0D8] text-[#0D3B2E] font-semibold text-xs uppercase tracking-wider hover:border-[#0D3B2E] bg-white transition">
                        Kembali ke Beranda
                    </a>
                    @php
                        $waNum = \App\Models\SiteSetting::get('psb_whatsapp_number', '6281234567890');
                    @endphp
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', (string)$waNum) }}" target="_blank" rel="noopener noreferrer" class="w-full sm:w-auto px-6 py-2.5 rounded-md bg-[#0D3B2E] hover:bg-[#059669] text-white font-semibold text-xs uppercase tracking-wider transition">
                        Hubungi Panitia PSB
                    </a>
                </div>
            </div>
        @else
            <!-- ACTIVE REGISTRATION HEADER -->
            <div class="text-center space-y-3">
                <div class="flex items-center justify-center gap-3">
                    <span class="editorial-label">03 — PENERIMAAN SANTRI BARU (PSB)</span>
                    <span class="w-8 h-px bg-[#B89758]"></span>
                    <span class="text-xs font-mono text-[#059669] uppercase font-semibold">Gelombang Aktif</span>
                </div>
                <h1 class="font-sans text-3xl sm:text-4xl md:text-5xl font-bold text-[#0D3B2E] tracking-tight leading-tight">
                    Penerimaan Santri Baru (PSB Online)
                </h1>
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    Tahun Akademik {{ $activeWave->academic_year }} &bull; <strong class="text-[#B89758]">{{ $activeWave->name }}</strong>
                </p>
            </div>

            <!-- REACTIVE MULTI-STEP REGISTRATION WIZARD -->
            <livewire:public.psb-registration :selected-program="$selectedProgram" />
        @endif

    </div>
</section>
@endsection
