<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>@yield('Title') - Devstagram</title>

        {{--
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
            rel="stylesheet"
        />
        --}} @vite('resources/css/app.css')
    </head>
    <body>
        <header class="p-5 border-b shadow w-screen fixed z-[100] bg-white">
            <div class="container mx-auto flex justify-between items-center">
                <a href="/" class="font-bold"> Devstagram </a>
                <nav class="flex gap-4 hover:text-gray-800">
                    <a href="/login">Login</a>
                    <a href={{ route('register') }} >Register</a>
                </nav>
            </div>
        </header>
        @yield('title') 
        <main>@yield('content')</main>

        <footer class="text-gray-600 text-center py-4">
            Todos los derechos reservados - Devstagram {{ date("Y") }}
        </footer>
    </body>
</html>
