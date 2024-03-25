<?php

use App\Models\User;
use App\Models\Follower;

$userId = auth()->user()->id;

$users = User::query()
    ->select('users.*')
    ->leftJoin('followers', function($join) use ($userId) {
        $join->on('users.id', '=', 'followers.user_id')
             ->where('followers.follower_id', '=', $userId);
    })
    ->whereNull('followers.user_id')
    ->limit(10)
    ->get();

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
                        <x-button variant="text" type="submit">
                            Unfollow
                        </x-button>
                    </form>
                @else
                    <form method="POST" action="{{ route('users.follow', $user) }}">
                        @csrf
                        <x-button type="submit" variant="text" class="text-blue-500">
                            Follow
                        </x-button>
                    </form>
                @endif
                </div>
        @endforeach
    </x-card-content>
</x-card>
