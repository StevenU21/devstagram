<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchInput = $request->input('searchInput');

        // Buscar posts
        $post = Post::where('text', 'like', '%' . $searchInput . '%')->first();

        // Buscar usuario
        $user = User::where('username', 'like', '%' . $searchInput . '%')->first();

        if ($post) {
            return redirect()->route('post.show', ['user' => $post->user->username, 'post' => $post->id]);
        } elseif ($user) {
            return redirect()->route('post.index', ['user' => $user]);
        } else {
            return redirect()->back()->with('error', 'No se encontró el post o el usuario');
        }
    }

    public function autocomplete(Request $request)
    {
        $query = $request->get('query');

        // Buscar posts
        $posts = Post::where('text', 'like', '%' . $query . '%')
            ->limit(5)
            ->get();

        // Buscar usuarios
        $users = User::where('username', 'like', '%' . $query . '%')
            ->limit(5)
            ->get();

        return view('search.autocomplete', compact('posts', 'users'));
    }
}
