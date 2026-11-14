@extends('layouts.public', ['title' => 'Formulir Pendaftaran Santri Baru (Online) - DAAR EL TAZKIYAH SUMARDI'])

@section('content')
<div class="py-10 md:py-16 bg-[#FAF8F5] min-h-[calc(100vh-200px)]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 md:space-y-10">

        <!-- Breadcrumb & Top Bar -->
        <nav class="flex items-center justify-between flex-wrap gap-3 text-xs text-[#4B6358] border-b border-[#E5E0D8] pb-3">
            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" class="hover:text-[#0D3B2E] transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('psb.index') }}" class="hover:text-[#0D3B2E] transition">Informasi PSB</a>
                <span>/</span>
                <span class="text-[#0D3B2E] font-bold">Formulir Pendaftaran</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('psb.index') }}" class="text-[#0D3B2E] hover:text-[#059669] font-medium transition inline-flex items-center gap-1">
                    <span>&larr;</span>
                    <span>Informasi &amp; Biaya PSB</span>
                </a>
                <span class="text-[#E5E0D8]">|</span>
                <a href="{{ route('psb.status') }}" class="text-[#B89758] hover:text-[#0D3B2E] font-medium transition">
                    Cek Status Pendaftaran &rarr;
                </a>
            </div>
        </nav>

        <!-- Centered Header matching home.blade.php styling -->
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <div class="flex items-center justify-center gap-3 sm:gap-4">
                <span class="w-8 sm:w-16 h-px bg-gradient-to-r from-transparent to-[#B89758]"></span>
                <h1 class="font-sans text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#0D3B2E] tracking-tight">
                    FORMULIR PENDAFTARAN
                </h1>
                <span class="w-8 sm:w-16 h-px bg-gradient-to-l from-transparent to-[#B89758]"></span>
            </div>

            @if($activeWave)
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    {{ $activeWave->name }} &bull; Tahun Ajaran {{ $activeWave->academic_year }}
                    @if($activeWave->start_date && $activeWave->end_date)
                        <span class="hidden sm:inline">&bull; Periode: {{ $activeWave->start_date->translatedFormat('d M Y') }} s/d {{ $activeWave->end_date->translatedFormat('d M Y') }}</span>
                    @endif
                </p>
            @else
                <p class="text-xs sm:text-sm text-[#4B6358]">
                    Penerimaan Santri Baru Pondok Pesantren Modern Tahfidzul Qur'an Daar El Tazkiyah Sumardi
                </p>
            @endif
        </div>

        <!-- Livewire Multi-Step Registration Wizard Component -->
        <livewire:public.psb-registration :selected-program="$selectedProgram" />

        <!-- Footer Assistance Note -->
        <div class="bg-white border border-[#E5E0D8] rounded-xl p-5 text-center text-xs text-[#4B6358] space-y-1">
            <p>
                Butuh bantuan dalam pengisian formulir pendaftaran santri baru?
            </p>
            <p>
                Hubungi Panitia PSB melalui WhatsApp di <strong class="text-[#0D3B2E]">0896-5332-4339</strong> (MTs) atau <strong class="text-[#0D3B2E]">0895-0718-4811</strong> (MDTA).
            </p>
        </div>

    </div>
</div>
@endsection
