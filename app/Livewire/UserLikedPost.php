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

    public function mount($postId)
    {
        $this->postId = $postId;
        $this->likedProfiles = Session::get('likedProfiles_' . $postId, collect());
    }

    #[On('postLiked')]
    public function updateLikedProfiles($postId)
    {
        if ($postId == $this->postId) {
            $this->post = Post::find($postId);

            if ($this->post) {
                $this->likedProfiles = $this->post->likes()
                    ->with('user')
                    ->latest()
                    ->take(4)
                    ->get();
            }

            $profileUrls = $this->likedProfiles->map(function ($like) {
                return optional($like->user)->url() ?? '';
            });

            $this->dispatch('updateLikedProfiles', $profileUrls);

            Session::put('likedProfiles_' . $postId, $this->likedProfiles);
        }
    }

    public function render()
    {
        return view('livewire.user-liked-post', ['likedProfiles' => $this->likedProfiles]);
    }
}
