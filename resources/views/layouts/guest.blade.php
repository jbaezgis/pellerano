<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{asset('images/icon.png')}}" type="image/png">

        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">

        <meta property="og:description" content="@yield('description')" />
        <meta property="og:title" content="@yield('title')" />
        <meta property="og:url" content="https://pellerano.com" />
        <meta property="og:type" content="website" />
        <meta property="og:locale" content="{{ app()->getLocale() }}" />
        <meta property="og:locale:alternate" content="es_ES" />
        <meta property="og:site_name" content="Pellerano" />
        <meta property="og:image" content="{{asset('images/cover-image.png')}}" />
        <meta property="og:image:url" content="{{asset('images/cover-image.png')}}" />

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Acme&family=Anton&family=Courgette&family=Kaushan+Script&family=Lobster&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

        <!-- Styles -->
        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased bg-white">
        {{-- <div class="flex justify-center py-4">
            <img class="h-32" src="{{ asset('images/logo-circle.png') }}" alt="Ardenti Logo">
        </div> --}}
        <x-jet-banner />

        <div class="min-h-screen">
            @livewire('guest-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        {{-- <footer class="border-t bg-white py-4">
            <div class="text-xl text-center font-courgette text-gray-700">
                Sabor y calidad en cada bocado!
            </div>
            <div class="py-2">
                <div class="max-w-7xl mx-auto flex justify-center px-2 gap-6">
                    <div class="flex gap-2">
                        <div>
                            <img class="h-6" src="{{ asset('images/iconos/whatsapp.png') }}" alt="">
                        </div>
                        <div>
                            849-656-6119
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                              </svg>
                        </div>
                        <div>
                            ardemti@gmail.com
                        </div>
                    </div>
                </div>
            </div>
        </footer> --}}

        @stack('modals')

        @livewireScripts
    </body>
</html>
