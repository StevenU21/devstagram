@extends('layouts.app')
@section('title', 'Register')

@section('content')
    <!-- component -->
    <div class="h-screen md:flex">
        <div
            class="relative overflow-hidden md:flex w-1/2 bg-gradient-to-tr from-blue-800 to-purple-700 i justify-around items-center hidden">
            <div>
                <h1 class="text-white font-bold text-4xl font-sans">Devstagram</h1>
                <p class="text-white mt-1">
                    Already have acount?
                </p>
                <x-link href="{{ route('login') }}" variant="dark">
                    Log In
                </x-link>
            </div>
            <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-40 -right-0 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-20 -right-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
        </div>
        <div class="flex md:w-1/2 justify-center py-10 items-center bg-white">
            <form class="bg-white max-sm:pt-16 w-full max-w-[20rem]" action="{{ 'register' }}" method="POST">
                <h1 class="text-gray-800 font-bold text-2xl mb-1">Hello There!</h1>
                <p class="text-sm font-normal text-gray-600 mb-7">Welcome Back</p>
                @csrf
                <x-input class="pl-2 outline-none border-none flex-1" type="text" name="name" id=""
                placeholder="Full name" />
                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input class="pl-2 outline-none border-none flex-1" type="text" name="username" id=""
                placeholder="Username" />
                @error('username')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input class="pl-2 outline-none border-none flex-1" type="text" name="email" id=""
                placeholder="Email Address" />
                <x-input class="pl-2 outline-none border-none flex-1" type="password" name="password" id=""
                placeholder="Password" />
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <x-input class="pl-2 outline-none border-none flex-1" type="password" name="password_confirmation"
                id="" placeholder="Repeat Password" />
                <x-button type="submit" class="w-full mt-2">
                    Create account
                </x-button>
            </form>
        </div>
    </div>
@endsection
