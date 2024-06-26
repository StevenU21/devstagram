<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    public function __invoke()
    {
        $followingIds = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::with(['user', 'likes', 'comments'])
            ->whereIn('user_id', $followingIds)
            ->latest()
            ->paginate(5);


        return view('home', [
            'posts' => $posts,
        ]);
    }
}
