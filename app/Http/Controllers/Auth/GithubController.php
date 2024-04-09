<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $userGithub = Socialite::driver('github')->stateless()->user();

        $existingUser = User::all()->firstWhere('email', $userGithub->email);

        if ($existingUser) {
            $existingUser->github_id = $userGithub->id;
            $existingUser->save();
            $user = $existingUser;
        } else {
            $user = User::updateOrCreate(
                [
                    'github_id' => $userGithub->id,
                ],
                [
                    'name' => $userGithub->name,
                    'username' => $userGithub->nickname,
                    'email' => $userGithub->email,
                    'email_verified_at' => now(),
                    'password' => bcrypt($userGithub->token),
                ]
            );

            $githubImage = file_get_contents($userGithub->avatar);
            if ($githubImage !== false) {
                $slugName = Str::slug($user->name, '-');
                $imageName =  $user->id . '-' . $slugName . '-githubImg.jpg';
                $imagePath = 'profiles/' . $imageName;
                Storage::disk('public')->put($imagePath, $githubImage);

                $user->image = $imageName;
                $user->save();
            }
        }

        Auth::login($user);

        return redirect()->route('post.index', auth()->user()->username);
    }
}
