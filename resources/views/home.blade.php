@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="flex flex-col-reverse lg:flex-row gap-6 justify-center px-4">
        <div>
            @if ($posts->count() > 0)
                <div class="py-6">
                    @foreach ($posts as $post)
                        <x-post-card :post="$post" />
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center h-screen">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-12 w-12 text-gray-500 mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <p class="text-center text-gray-500 text-2xl">No posts from followed users found.</p>
                </div>
            @endif
        </div>
        <div>
            <x-suggestions></x-suggestions>
        </div>
    </div>
@endsection