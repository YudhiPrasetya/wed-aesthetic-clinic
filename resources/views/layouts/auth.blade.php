<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/wed-favicon/apple-touch-icon.png') }}">
        <link type="image/png" rel="icon" sizes="32x32" href="{{ asset('images/wed-favicon/favicon-32x32.png') }}">
        <link type="image/png" rel="icon" sizes="16x16" href="{{ asset('images/wed-favicon/favicon-16x16.png') }}">
        {{-- <link rel="manifest" href="/site.webmanifest"> --}}

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        <tallstackui:script />
        @livewireStyles

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="min-h-screen bg-gradient-to-br from-sky-50 via-teal-50/30 to-emerald-50/20">
        {{-- {{ $slot }} --}}
        {{-- <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-1/3 flex-col gap-2">
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div> --}}
        {{ $slot }}
        @livewireScripts
    </body>
</html>
