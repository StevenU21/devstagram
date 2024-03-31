<?php

namespace App\Livewire;

use App\Events\NewPostComent;
use App\Models\Comment;
use App\Notifications\CommentedPostNotification;
use Livewire\Component;

class CommentPost extends Component
{
    public $post;
    public $comment;

    public function mount($post)
    {
        $this->post = $post;
    }

    protected $rules = [
        'comment' => 'required',
    ];

    public function storeComment()
    {
        $this->validate();

        // Crear el comentario
        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id,
            'comment' => $this->comment,
        ]);

        // Enviar notificación al usuario que creó el post
        $this->post->user->notify(new CommentedPostNotification($this->post, auth()->user()));
        $this->dispatch('commented');
        $this->reset('comment');
    }

    public function render()
    {
        return view('livewire.comment-post');
    }
}
