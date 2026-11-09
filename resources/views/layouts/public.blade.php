<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ filled($title ?? null) ? $title . ' - ' . config('app.name', 'Daar El Tazkiyah') : 'Pondok Pesantren Modern Tahfidzul Qur\'an Daar El Tazkiyah Sumardi' }}</title>

    <!-- Open Graph / Meta -->
    @yield('meta')

    <!-- Browser Tab Icon / Favicon -->
    <link rel="icon" href="{{ asset('images/logo_daar_el_tazkiyah.svg') }}" type="image/svg+xml">
    <link rel="alternate icon" href="{{ asset('images/logo_daar_el_tazkiyah.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/logo_daar_el_tazkiyah.png') }}">

    @fonts

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body class="min-h-screen bg-[#FDFBF7] text-[#0F291E] font-sans antialiased selection:bg-[#D97706] selection:text-white flex flex-col justify-between overflow-x-hidden">

    @php
        $activeWave = \App\Models\AdmissionWave::currentActive();
        $waNumber = \App\Models\SiteSetting::get('psb_whatsapp_number', '0895-0718-4811');
        $siteAddress = \App\Models\SiteSetting::get('school_address', 'RT 006 / RW 002, Kp. Lembur Sawah, Desa Mekarbaru, Kecamatan Petir, Kabupaten Serang, Provinsi Banten');
        $sitePhone = \App\Models\SiteSetting::get('school_phone', '0895-0718-4811');
        $siteEmail = \App\Models\SiteSetting::get('school_email', 'info@daareltazkiyah.sch.id');
    @endphp

    <!-- Public Master Navigation Header -->
    <x-public.header :activeWave="$activeWave" />

    <!-- Main Page Content Body -->
    <main class="grow">
        @yield('content')
    </main>

    <!-- Public Master Footer -->
    <x-public.footer :siteAddress="$siteAddress" :sitePhone="$sitePhone" :siteEmail="$siteEmail" />

    <!-- Sticky Floating WhatsApp Action Button (56x56px with pulse animation) -->
    <x-public.whatsapp-button :waNumber="$waNumber" />

    @fluxScripts
</body>
</html>
