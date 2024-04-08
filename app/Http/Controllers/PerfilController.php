<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => [
                'required',
                'min:3',
                'max:20',
                'unique:users,username,' . auth()->user()->id,
                'not_in:admin,twitter,facebook,instagram,github,linkedin,gitlab,profile',
            ],
            'description' => ['min:5', 'max:60', 'nullable', 'string'],
            'role' => ['min:8', 'max:30', 'string'],
            'image' => ['image', 'max:4048', 'mimes:jpg,jpeg,png,gif,webp', 'dimensions:min_width=240,min_height=240'],
        ]);

        $user = User::find(auth()->user()->id);

        // Verificar si el nombre de usuario ha cambiado
        if ($user->username !== $request->username) {
            $user->username = $request->username;
        }

        // Verificar si la descripción ha cambiado
        if ($user->description !== $request->description) {
            $user->description = $request->description;
        }

        // Verificar si el rol ha cambiado
        if ($user->role !== $request->role) {
            $user->role = $request->role;
        }

        // Procesar la imagen si se ha cargado una nueva
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::uuid() . "." . $image->extension();

            $serverImage = Image::make($image);
            $serverImage->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $imagePath = 'profiles/' . $imageName;
            Storage::disk('public')->put($imagePath, (string) $serverImage->encode());

            // Borrar la imagen anterior si existe
            if ($user->image) {
                Storage::disk('public')->delete('profiles/' . $user->image);
            }

            $user->image = $imageName;
        }

        // Guardar los cambios si el usuario ha cambiado algo
        if ($user->isDirty()) {
            $user->save();
            return redirect()->route('post.index', $user->username)->with('success', 'Perfil actualizado con éxito');
        }
    }
}
