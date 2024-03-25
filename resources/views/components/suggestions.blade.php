<?php

use App\Models\User;
$users = User::get();

?>

<x-card class="bg-white rounded-md p-4 shadow-md mt-6 w-full">
    <x-card-subtitule>Suggested for you</x-card-subtitule>
    <x-card-content class="flex flex-col">
        @foreach ($users as $user)
            <div class="flex items-center">
                <a class="block bg-white p-1 rounded-full" href="{{ route('post.index', $user->username) }}">
                    <img class="w-10 rounded-full" src="{{ asset('storage/profiles' . '/' . $user->image) }}">
                </a>
                <div>
                    <a class="text-xs font-bold block bg-white p-1 rounded-full"
                        href="{{ route('post.index', $user->username) }}">
                        {{ $user->username }}
                    </a>
                    <p class="text-xs text-gray-400">
                        Suggested for you
                        </span>
                </div>
                @if ($user->following(auth()->user()))
                    <form method="POST" action="{{ route('users.unfollow', $user) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 text-xs ml-2">
                            Unfollow
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('users.follow', $user) }}">
                        @csrf
                        <button type="submit" href="" class="text-blue-500 text-xs ml-2">
                            Follow
                        </button>
                    </form>
                @endif
                </div>
        @endforeach
    </x-card-content>
</x-card>
