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
                <form action="{{ route('search') }}" method="GET" class="max-w-xl relative">
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
                @auth
                    <div class="flex items-center justify-center gap-4">
                        @livewire('notifications.load-notifications')

                        <div class="block relative">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <x-button type="submit" variant="icon">
                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3 1C2.44771 1 2 1.44772 2 2V13C2 13.5523 2.44772 14 3 14H10.5C10.7761 14 11 13.7761 11 13.5C11 13.2239 10.7761 13 10.5 13H3V2L10.5 2C10.7761 2 11 1.77614 11 1.5C11 1.22386 10.7761 1 10.5 1H3ZM12.6036 4.89645C12.4083 4.70118 12.0917 4.70118 11.8964 4.89645C11.7012 5.09171 11.7012 5.40829 11.8964 5.60355L13.2929 7H6.5C6.22386 7 6 7.22386 6 7.5C6 7.77614 6.22386 8 6.5 8H13.2929L11.8964 9.39645C11.7012 9.59171 11.7012 9.90829 11.8964 10.1036C12.0917 10.2988 12.4083 10.2988 12.6036 10.1036L14.8536 7.85355C15.0488 7.65829 15.0488 7.34171 14.8536 7.14645L12.6036 4.89645Z"
                                            fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                                    </svg>
                                </x-button>
                            </form>
                        </div>
                        <a href="{{ route('post.index', auth()->user()->username) }}"
                            class="inline-flex items-center relative px-3 border rounded-full hover:shadow-lg">
                            {{ auth()->user()->username }}
                            <img src="{{ auth()->user()->image() }}" alt="profile"
                                class="rounded-full w-10 h-10 object-cover ml-4 -mr-4">
                        </a>
                    </div>
                @endauth
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
    @livewireScripts
</body>

</html>
