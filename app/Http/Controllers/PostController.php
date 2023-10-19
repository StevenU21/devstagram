<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(User $user) {
        return view('layout.dashboard', [
            'user'=>$user
        ]);
    }
    public function create(User $user) {
        dd('creando post');
        return view('layout.dashboard', [
            'user'=>$user
        ]);
    }
}
