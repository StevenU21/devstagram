<?php

namespace App\View\Components;

use App\Models\User;
use App\Models\Follower;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Suggestions extends Component
{
    public $users;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $userId = auth()->user()->id;

        $this->users = User::query()
            ->select('users.*')
            ->leftJoin('followers', function ($join) use ($userId) {
                $join->on('users.id', '=', 'followers.user_id')->where('followers.follower_id', '=', $userId);
            })
            ->whereNull('followers.user_id')
            ->where('users.id', '!=', $userId) //Evitar que el usuario se siga a si mismo
            ->limit(10)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.suggestions', ['users' => $this->users]);
    }
}
