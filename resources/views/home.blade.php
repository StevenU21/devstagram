@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container mx-auto px-4">
        @if ($posts->count() > 0)
            <div class="py-6">
                @foreach ($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 text-2xl">No posts from followed users found.</p>
        @endif
    </div>
@endsection