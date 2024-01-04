<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth')->except(['index','show']);
     }
    public function index(User $user)
    {
        $posts  = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('layout.dashboard', [
            'user' => $user,
            'posts'=>$posts
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255'],
            'image' => ['required']
        ]);
        Post::create([
            'title'=> '',
            'text' => $request->title,
            'image'=> $request->image,
            'user_id'=>auth()->user()->id
        ]);
    }

    public function show( User $user, Post $post)
    {
        return view('posts.show',['post'=>$post, 'user'=>$user]);
    }
}
