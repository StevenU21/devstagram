<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class UserLikedPost extends Component
{
    public $postId;
    public $likedProfiles;
    public $post;
    public $profileImages; // Nueva propiedad para almacenar las imágenes de perfil

    public function mount($postId)
    {
        $this->postId = $postId;
        $this->likedProfiles = collect();
        $this->profileImages = collect(); // Inicializar la colección de imágenes de perfil

        // Cargar las imágenes de perfil inmediatamente
        $this->updateLikedProfiles($postId);
    }

    #[On('postLiked')]
    public function updateLikedProfiles($postId)
    {
        if ($postId == $this->postId) {
            $this->post = Post::with('likes.user') // Carga ansiosa de las relaciones necesarias
                ->find($postId);
    
            if ($this->post) {
                $this->likedProfiles = $this->post->likes;
    
                // Actualizar las imágenes de perfil
                $this->profileImages = $this->likedProfiles->map(function ($like) {
                    return optional($like->user)->image() ?? '';
                });
            }
        }
    }
    
    public function render()
    {
        return view('livewire.user-liked-post', ['likedProfiles' => $this->likedProfiles, 'profileImages' => $this->profileImages]);
    }
}
