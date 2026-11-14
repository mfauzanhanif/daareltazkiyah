<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    {{ filled($title ?? null) ? $title.' - '.config('app.name', 'Daar El Tazkiyah') : config('app.name', 'Daar El Tazkiyah') }}
</title>

<link rel="icon" href="{{ asset('images/logo_daar_el_tazkiyah.svg') }}" type="image/svg+xml">
<link rel="alternate icon" href="{{ asset('images/logo_daar_el_tazkiyah.png') }}" type="image/png">
<link rel="apple-touch-icon" href="{{ asset('images/logo_daar_el_tazkiyah.png') }}">

@fonts

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
