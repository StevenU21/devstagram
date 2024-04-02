<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserFollowedNotification;
use App\Notifications\UserUnfollowNotification;

class FollowerController extends Controller
{
    public function store(User $user)
    {
        if (auth()->user()->id === $user->id) {
            return back()->withErrors(['error' => 'You cannot follow yourself.']);
        }

        $user->followers()->attach(auth()->user()->id);

        // Enviar notificación al usuario que está siendo seguido.
        $user->notify(new UserFollowedNotification(auth()->user(), $user));

        return redirect()->back()->with('success', 'Has comenzado a seguir a ' . $user->username);
    }

    public function destroy(User $user)
    {
        $user->followers()->detach(auth()->user()->id);

        // Enviar notificación al usuario que ha dejado de ser seguido.
        $user->notify(new UserUnfollowNotification(auth()->user()));

        return back();
    }
}
