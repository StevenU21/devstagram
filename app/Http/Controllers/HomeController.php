<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth']);
    // }

    public function __invoke()
    {
        //Get our posts
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->paginate(20);

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
