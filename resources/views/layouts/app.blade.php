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
    @livewireStyles
</head>

<body class="overflow-x-hidden">
    <header class="p-2 border-b shadow w-screen sticky z-[100] bg-white flex top-0">
        <nav class="bg-white w-full flex relative justify-between items-center px-8">

            <a href="{{ route('home') }}" class="font-bold text-2xl"> DevStagram </a>
            <!-- end logo -->

            <!-- search bar -->
            <!-- <div class="hidden sm:block flex-shrink flex-grow-0 justify-start px-2"> -->
            @if (!Route::is('login') && !Route::is('register'))
                <div class="flex-1 flex justify-center">
                    <div class="relative hidden sm:block flex-shrink flex-grow-0 ">
                        <input type="text" class="bg-purple-white bg-gray-100 rounded-lg border-0 p-3 w-full"
                            placeholder="Search something..." style="min-width:400px;">
                        <div class="absolute top-0 right-0 p-4 pr-3 text-purple-lighter">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            @endif
            <!-- end search bar -->

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
                        <div class="relative inline-block text-left">
                            <x-button variant="icon" id="dropdownButton">
                                <!-- Icono de la campana -->
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.60124 1.25086C8.60124 1.75459 8.26278 2.17927 7.80087 2.30989C10.1459 2.4647 12 4.41582 12 6.79999V10.25C12 11.0563 12.0329 11.7074 12.7236 12.0528C12.931 12.1565 13.0399 12.3892 12.9866 12.6149C12.9333 12.8406 12.7319 13 12.5 13H8.16144C8.36904 13.1832 8.49997 13.4513 8.49997 13.75C8.49997 14.3023 8.05226 14.75 7.49997 14.75C6.94769 14.75 6.49997 14.3023 6.49997 13.75C6.49997 13.4513 6.63091 13.1832 6.83851 13H2.49999C2.2681 13 2.06664 12.8406 2.01336 12.6149C1.96009 12.3892 2.06897 12.1565 2.27638 12.0528C2.96708 11.7074 2.99999 11.0563 2.99999 10.25V6.79999C2.99999 4.41537 4.85481 2.46396 7.20042 2.3098C6.73867 2.17908 6.40036 1.75448 6.40036 1.25086C6.40036 0.643104 6.89304 0.150421 7.5008 0.150421C8.10855 0.150421 8.60124 0.643104 8.60124 1.25086ZM7.49999 3.29999C5.56699 3.29999 3.99999 4.86699 3.99999 6.79999V10.25L4.00002 10.3009C4.0005 10.7463 4.00121 11.4084 3.69929 12H11.3007C10.9988 11.4084 10.9995 10.7463 11 10.3009L11 10.25V6.79999C11 4.86699 9.43299 3.29999 7.49999 3.29999Z"
                                        fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                                </svg>

                            </x-button>

                            <div id="dropdownContent"
                                class="absolute right-0 mt-1 w-80 mx-auto bg-white rounded-lg shadow-lg overflow-auto max-h-96 z-10"
                                style="display: none;">
                                <!-- Encabezado -->
                                <div class="px-4 py-2 border-b bg-gray-100 text-lg font-semibold text-gray-700">
                                    <div>Notificaciones</div>
                                </div>
                                @livewire('notifications.load-notifications')
                            </div>
                        </div>

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
                            @if (auth()->user()->image)
                                <img src="{{ auth()->user()->url() }}" alt="profile"
                                    class="rounded-full w-10 h-10 object-cover ml-4 -mr-4">
                            @else
                                <div class="rounded-full w-10 h-10 object-cover ml-4 -mr-4">
                                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        role="presentation" focusable="false"
                                        style="display: block; height: 100%; width: 100%; fill: currentcolor;">
                                        <path
                                            d="m16 .7c-8.437 0-15.3 6.863-15.3 15.3s6.863 15.3 15.3 15.3 15.3-6.863 15.3-15.3-6.863-15.3-15.3-15.3zm0 28c-4.021 0-7.605-1.884-9.933-4.81a12.425 12.425 0 0 1 6.451-4.4 6.507 6.507 0 0 1 -3.018-5.49c0-3.584 2.916-6.5 6.5-6.5s6.5 2.916 6.5 6.5a6.513 6.513 0 0 1 -3.019 5.491 12.42 12.42 0 0 1 6.452 4.4c-2.328 2.925-5.912 4.809-9.933 4.809z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
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
