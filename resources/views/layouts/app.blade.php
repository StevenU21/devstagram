<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @stack('styles')
    <title>@yield('title') - Devstagram</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/broadcast.js')
    @livewireStyles
</head>

<body class="overflow-x-hidden">
    <header class="p-2 border-b shadow w-screen sticky z-[100] bg-white flex top-0">
        <nav class="bg-white w-full flex relative justify-between items-center px-8">

            <a href="{{ route('home') }}" class="font-bold text-2xl"> DevStagram </a>
            <!-- end logo -->

            <!-- search bar -->
            <!-- <div class="hidden sm:block flex-shrink flex-grow-0 justify-start px-2"> -->
            @if (!Route::is('login') && !Route::is('register') && !Route::is('perfil.index'))
                <form action="{{ route('search') }}" method="GET" class="max-w-xl relative hidden sm:block">
                    <x-label variant="icon">
                        <x-input type="text" id="searchInput" name="searchInput" placeholder="Search something..." />
                        <div id="searchResult" style="display: none;"></div>

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </x-label>
                </form>
            @endif
            @include('components.autocomplete')
            <!-- login -->
            <div class="flex-initial">
                @guest
                    <div class="flex justify-end items-center relative gap-8">
                        <x-link variant="link" href="/login">Login</x-link>
                        <x-link variant="link" href="{{ route('register') }}">Register</x-link>
                    </div>
                @endguest
                <x-profile />
                <!-- end login -->
            </div>

        </nav>
    </header>

    <main class="bg-gray-100 min-h-screen">@yield('content')</main>

    @include('components.alerts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownButton = document.getElementById('dropdownButton');
            var dropdownContent = document.getElementById('dropdownContent');

            dropdownButton.addEventListener('click', function() {
                var display = dropdownContent.style.display;
                dropdownContent.style.display = display === 'none' ? 'block' : 'none';
            });

            // Cerrar el dropdown cuando se hace clic fuera de él
            window.addEventListener('click', function(event) {
                if (!dropdownButton.contains(event.target)) {
                    dropdownContent.style.display = 'none';
                }
            });
        });
    </script>

    @auth
        <script>
            const user_id = {{ auth()->user()->id }}
        </script>
    @endauth

    {{-- <script src="{{ asset('js/ion.sound.js') }}"></script>
    <script src="{{ asset('js/ion.sound.min.js') }}"></script> --}}
    @livewireScripts
</body>

</html>
