<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $userGoogle = Socialite::driver('google')->stateless()->user();


        $user = User::updateOrCreate(
            [
                'google_id' => $userGoogle->id,
            ],
            [
                'name' => $userGoogle->name,
                'username' => explode(" ", $userGoogle->name)[0],
                'email' => $userGoogle->email,
                'password' => bcrypt($userGoogle->token),
            ]
        );

        $userId = DB::table('users')->where('google_id', $userGoogle->id)->value('id');

        $googleImage = file_get_contents($userGoogle->avatar);
        if ($googleImage !== false) {
            $slugName = Str::slug($user->name, '-');
            $imageName =  $user->id . '-' . $slugName . '-googleImg.jpg';
            $imagePath = 'profiles/' . $imageName;
            Storage::disk('public')->put($imagePath, $googleImage);
        
            $user = User::find($userId);
            $user->image = $imageName;
            $user->save();
        }

        Auth::login($user);

        return redirect()->route('post.index', auth()->user()->username);
    }
}
