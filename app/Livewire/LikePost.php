<?php

namespace App\Livewire;

use App\Notifications\LikedPostNotification;
use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;

    public function mount($post)
    {
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $this->post->likes->count();
    }

    public function like()
    {
        if ($this->post->checkLike(auth()->user())) {
            $this->post->likes()->where('user_id', auth()->user()->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
            $this->isLiked = true;
            $this->likes++;

            $user = $this->post->user;

            // Enviar notificación al usuario que está siendo seguido.
            $user->notify(new LikedPostNotification($this->post, auth()->user()));
        }

        $this->dispatch('postLiked', $this->post->id);
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
