<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        // Get posts from followed users
        $followingIds = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $followingIds)->latest()->paginate(20);
    
        return view('home', [
            'posts' => $posts,
        ]);
    }
    
}
