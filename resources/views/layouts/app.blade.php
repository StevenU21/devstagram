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
                        <a href="/login">Login</a>
                        <a href={{ route('register') }}>Register</a>
                        <div class="flex mr-4 items-center">
                        </div>
                    </div>
                @endguest
                @auth
                    <div class="flex items-center justify-center gap-4">

                        <div class="relative inline-block text-left">
                            <button id="dropdownButton"
                                class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                                <!-- Icono de la campana -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"
                                    fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9v5l-2 4v2h18v-2l-2-4V9c0-3.87-3.13-7-7-7zm-1 18c0 1.1.9 2 2 2s2-.9 2-2h-4zm1-14c-1.1 0-2 .9-2 2h4c0-1.1-.9-2-2-2z" />
                                </svg>

                            </button>
                            <div id="dropdownContent"
                                class="absolute right-0 mt-1 w-80 mx-auto bg-white rounded-lg shadow-lg overflow-auto max-h-96 z-10"
                                style="display: none;">
                                <!-- Encabezado -->
                                <div class="px-4 py-2 border-b bg-gray-100 text-lg font-semibold text-gray-700">
                                    <div>Notificaciones</div>
                                </div>
                                <div class="px-4 py-2 flex justify-start items-center">
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold text-sm py-2 px-4 rounded">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold text-sm py-2 px-4 rounded ml-4">
                                        <i class="fas fa-eye"></i>/<i class="fas fa-eye-slash"></i> Marcar/Desmarcar
                                    </button>
                                </div>
                                <!-- Notificaciones -->
                                <a href="#"
                                    class="flex items-center px-4 py-3 border-b hover:bg-gray-100 space-x-4 relative">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ auth()->user()->url() }}"
                                        alt="avatar">
                                    <div class="text-sm space-y-1">
                                        <p class="text-gray-900 leading-none">{{ auth()->user()->name }}</p>
                                        <p class="text-gray-600">Mensaje de la notificación</p>
                                        <p class="text-gray-600">Hace 3 min</p>
                                    </div>
                                    <span
                                        class="absolute top-1/2 transform -translate-y-1/2 right-4 px-2 py-0.5 text-xs text-white bg-red-500 rounded-full">No
                                        leído</span>
                                </a>
                                <!-- Notificación leída -->
                                <a href="#"
                                    class="flex items-center px-4 py-3 border-b hover:bg-gray-100 space-x-4 relative">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ auth()->user()->url() }}"
                                        alt="avatar">
                                    <div class="text-sm space-y-1">
                                        <p class="text-gray-900 leading-none">{{ auth()->user()->name }}</p>
                                        <p class="text-gray-600">Mensaje de la notificación</p>
                                        <p class="text-gray-600">Hace 3 min</p>
                                    </div>
                                    <span
                                        class="absolute top-1/2 transform -translate-y-1/2 right-4 px-2 py-0.5 text-xs text-white bg-green-500 rounded-full">Leído</span>
                                </a>
                                <!-- Agregar más notificaciones aquí -->
                            </div>
                        </div>

                        <div class="block relative">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="inline-block py-2 px-3 hover:bg-gray-200 rounded-full relative ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>
                                </button>
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
