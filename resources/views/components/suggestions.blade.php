<?php

use App\Models\User;
$users = User::get();

?>

<div class="bg-white rounded-md p-4 shadow-md mt-6 w-full">
    <h2>Suggested for you</h2>
    <ul class="">
        @foreach ($users as $user)
            <li class="flex items-center">
                <a class="block bg-white p-1 rounded-full" href="{{ route('post.index', $user->username) }}">
                    <img class="w-10 rounded-full" src="{{ asset('profiles/' . $user->image) }}">
                </a>
                <div>
                    <a class="text-xs block bg-white p-1 rounded-full" href="{{ route('post.index', $user->username) }}">
                        {{ $user->username }}
                    </a>
                    <p class="text-xs text-gray-400">
                        Suggested for you
                    </span>
                </div>
            </li>
        @endforeach
    </ul>
</div>
