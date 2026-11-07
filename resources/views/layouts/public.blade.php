<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ filled($title ?? null) ? $title . ' - ' . config('app.name', 'Daar El Tazkiyah') : config('app.name', 'Daar El Tazkiyah') . ' - Pondok Pesantren Modern Tahfidzul Quran' }}</title>

    <!-- Open Graph / Meta -->
    @yield('meta')

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    @fonts

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body class="min-h-screen bg-[#FDFBF7] text-[#0F291E] font-sans antialiased selection:bg-[#D97706] selection:text-white flex flex-col justify-between">

    @php
        $activeWave = \App\Models\AdmissionWave::currentActive();
        $waNumber = \App\Models\SiteSetting::get('psb_whatsapp_number', '6281234567890');
        $siteAddress = \App\Models\SiteSetting::get('school_address', \App\Models\SiteSetting::get('site_address', 'Jl. Cibanteng Babengket, RT 02 / RW 02, Desa Cihideung Udik, Kec. Ciampea, Kab. Bogor, Jawa Barat 16620'));
        $sitePhone = \App\Models\SiteSetting::get('school_phone', \App\Models\SiteSetting::get('site_phone', '0812-3456-7890'));
        $siteEmail = \App\Models\SiteSetting::get('school_email', \App\Models\SiteSetting::get('site_email', 'info@daareltazkiyah.sch.id'));
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
