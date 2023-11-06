<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(User $user)
    {
        return view('layout.dashboard', [
            'user' => $user
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
}
