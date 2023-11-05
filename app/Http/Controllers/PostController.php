<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    public function create(Request $request)
    {
        $input = $request->all();
        return response()->json($input);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = Str::uuid() . "." . $image->extension();
            return response()->json(['image' => $imageName]);
        } else {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
    }

}
