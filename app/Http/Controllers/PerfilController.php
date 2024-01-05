<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('profile.index');
    }
    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'username' => ['required', 'min:3', 'max:20', 'unique:users,username,' . auth()->user()->id, 'not_in:admin,twitter,facebook,instagram,github,linkedin,gitlab,profile,'],
        ]);

        if ($request->image) {
            $input = $request->all();
            $image = $request->file('image');
            $imageName = Str::uuid() . "." . $image->extension();
            $serverImage =  Image::make($image);
            $serverImage->fit(1000, 1000);
            $imagePath = public_path('profiles') . '/' . $imageName;
            $serverImage->save($imagePath);
        }

        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->image = $imageName ?? auth()->user()->image ?? null;
        $user->save();

        //Return user to profile
        return redirect()->route('post.index', $user->username);
    }
}
