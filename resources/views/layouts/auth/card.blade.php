<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-6">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2.5 font-medium group text-center" wire:navigate>
                    <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 dark:bg-emerald-950/40 p-1.5 shadow-2xs group-hover:scale-105 transition-transform duration-200">
                        <x-app-logo-icon class="size-10" />
                    </span>

                    <div class="flex flex-col items-center">
                        <span class="font-sans font-bold text-base text-[#0D3B2E] dark:text-emerald-400 leading-tight">
                            {{ config('app.name', 'Daar El Tazkiyah') }}
                        </span>
                        <span class="text-[11px] text-zinc-500 dark:text-zinc-400">
                            PPMTQ Daar El Tazkiyah Sumardi
                        </span>
                    </div>
                </a>

                <div class="flex flex-col gap-6">
                    <div class="rounded-xl border bg-white dark:bg-stone-950 dark:border-stone-800 text-stone-800 shadow-xs">
                        <div class="px-10 py-8">{{ $slot }}</div>
                    </div>
                </div>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
