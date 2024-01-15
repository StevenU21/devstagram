<?php

namespace App\Livewire;

use App\Models\Comment;
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

        $this->dispatch('commented');
        $this->reset('comment');
    }

    public function render()
    {
        return view('livewire.comment-post');
    }
}
