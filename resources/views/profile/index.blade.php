@extends('layout.app')

@section('title')
    {{ auth()->user()->username }}
@endsection

@section('content')
    <div class=" max-w-xl w-full mx-auto">
        <h1 class="py-4 text-center text-2xl font-bold"> {{ auth()->user()->username }}</h1>
        <form method="POST" action="{{ route('perfil.store') }}" class="flex flex-col gap-4" enctype="multipart/form-data" >
            @csrf
            <div class="relative hidden sm:block flex-shrink flex-grow-0">
                <input name="username" type="text"
                    class="bg-purple-white bg-white rounded-lg border-0 p-3 w-full @error('username') border-red-500 @enderror"
                    placeholder="Name" style="min-width:400px;" value="{{ auth()->user()->username }}">
                @error('username')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="relative hidden sm:block flex-shrink flex-grow-0">
                <input name="image" type="file"
                    class="bg-purple-white bg-white rounded-lg border-0 p-3 w-full @error('image') border-red-500 @enderror"
                    style="min-width:400px;" accept=".jpeg, .jpg, .png">
                @error('image')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <input type="submit" value="Save changes" class="flex items-center py-2 px-4 rounded-lg text-sm bg-blue-600 text-white shadow-lg text-center font-bold justify-center cursor-pointer">
        </form>
    </div>
@endsection
