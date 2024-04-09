@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <!-- component -->
    <div class="h-screen md:flex">
        <div
            class="relative overflow-hidden md:flex w-1/2 bg-gradient-to-tr from-blue-800 to-purple-700 i justify-around items-center hidden">
            <div>
                <h1 class="text-white font-bold text-4xl font-sans">Devstagram</h1>
                <p class="text-white mt-1">
                    Don't have account?
                </p>
                <x-link variant='dark' href="{{ route('register') }}">
                    Register
                </x-link>
            </div>
            <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-40 -right-0 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-20 -right-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
        </div>
        <div class="flex md:w-1/2 justify-center py-10 items-center bg-white">
            <div class="flex flex-col items-center">
                <!-- Google Login Button -->
                <x-link href="{{ route('google.login') }}"
                    class="bg-red-600 text-white font-semibold px-6 py-3 rounded-lg flex items-center justify-center mb-8">
                    <i class="fab fa-google text-white text-lg mr-2"></i>
                    Sign in with Google
                </x-link>

                <x-link href="{{ route('github.login') }}"
                    class="bg-gray-600 text-white font-semibold px-6 py-3 rounded-lg flex items-center justify-center mb-8">
                    <i class="fab fa-github text-white text-lg mr-2"></i>
                    Sign in with Github
                </x-link>

                <!-- Formulario de inicio de sesión -->
                <form class="bg-white max-sm:pt-16 w-full max-w-[20rem] space-y-2" action="{{ 'login' }}"
                    method="POST">
                    <h1 class="text-gray-800 font-bold text-2xl mb-1">Hello There!</h1>
                    <p class="text-sm font-normal text-gray-600 mb-7">Welcome Back</p>
                    @csrf

                    @error('username')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <x-label variant='icon'>
                        <svg class="ml-4" width="15" height="15" viewBox="0 0 15 15" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1 2C0.447715 2 0 2.44772 0 3V12C0 12.5523 0.447715 13 1 13H14C14.5523 13 15 12.5523 15 12V3C15 2.44772 14.5523 2 14 2H1ZM1 3L14 3V3.92494C13.9174 3.92486 13.8338 3.94751 13.7589 3.99505L7.5 7.96703L1.24112 3.99505C1.16621 3.94751 1.0826 3.92486 1 3.92494V3ZM1 4.90797V12H14V4.90797L7.74112 8.87995C7.59394 8.97335 7.40606 8.97335 7.25888 8.87995L1 4.90797Z"
                                fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                        <x-input type="text" name="email" id="" placeholder="Email Address" />
                    </x-label>
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <x-label variant='icon'>
                        <svg class="ml-4" width="15" height="15" viewBox="0 0 15 15" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.3536 2.35355C13.5488 2.15829 13.5488 1.84171 13.3536 1.64645C13.1583 1.45118 12.8417 1.45118 12.6464 1.64645L10.6828 3.61012C9.70652 3.21671 8.63759 3 7.5 3C4.30786 3 1.65639 4.70638 0.0760002 7.23501C-0.0253338 7.39715 -0.0253334 7.60288 0.0760014 7.76501C0.902945 9.08812 2.02314 10.1861 3.36061 10.9323L1.64645 12.6464C1.45118 12.8417 1.45118 13.1583 1.64645 13.3536C1.84171 13.5488 2.15829 13.5488 2.35355 13.3536L4.31723 11.3899C5.29348 11.7833 6.36241 12 7.5 12C10.6921 12 13.3436 10.2936 14.924 7.76501C15.0253 7.60288 15.0253 7.39715 14.924 7.23501C14.0971 5.9119 12.9769 4.81391 11.6394 4.06771L13.3536 2.35355ZM9.90428 4.38861C9.15332 4.1361 8.34759 4 7.5 4C4.80285 4 2.52952 5.37816 1.09622 7.50001C1.87284 8.6497 2.89609 9.58106 4.09974 10.1931L9.90428 4.38861ZM5.09572 10.6114L10.9003 4.80685C12.1039 5.41894 13.1272 6.35031 13.9038 7.50001C12.4705 9.62183 10.1971 11 7.5 11C6.65241 11 5.84668 10.8639 5.09572 10.6114Z"
                                fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                        <x-input type="password" name="password" id="" placeholder="Password" />
                    </x-label>
                    @error('password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="flex items-center gap-2">
                        <x-input variant="check" type="checkbox" name="remember" id="remember" placeholder="Password" />
                        <label for="remember">Remember the session</label>
                    </div>
                    <x-button type="submit" class="w-full">
                        Log In
                    </x-button>

                    @if (session('message'))
                        <p class="text-red-500">{{ session('message') }}</p>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
