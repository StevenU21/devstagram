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

        // Verificar si el correo electrónico ya existe
        $existingUser = User::all()->firstWhere('email', $userGoogle->email);

        if ($existingUser) {
            $existingUser->google_id = $userGoogle->id;
            $existingUser->save();
            $user = $existingUser;
        } else {
            $user = User::updateOrCreate(
                [
                    'google_id' => $userGoogle->id,
                ],
                [
                    'name' => $userGoogle->name,
                    'username' => explode(" ", $userGoogle->name)[0],
                    'email' => $userGoogle->email,
                    'email_verified_at' => now(),
                    'password' => bcrypt($userGoogle->token),
                ]
            );

            $googleImage = file_get_contents($userGoogle->avatar);
            if ($googleImage !== false) {
                $slugName = Str::slug($user->name, '-');
                $imageName =  $user->id . '-' . $slugName . '-googleImg.jpg';
                $imagePath = 'profiles/' . $imageName;
                Storage::disk('public')->put($imagePath, $googleImage);

                $user->image = $imageName;
                $user->save();
            }
        }

        Auth::login($user);

        return redirect()->route('post.index', auth()->user()->username);
    }
}
