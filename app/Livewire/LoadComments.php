<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Attributes\On;
use Livewire\Component;

class LoadComments extends Component
{
    public $post;
    public $comments;

    public function mount($post)
    {
        $this->post = $post;
        $this->loadComments();
    }

    #[On('commented')]
    public function loadComments()
    {
        $this->comments = Comment::with('user')
            ->where('post_id', $this->post->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.load-comments');
    }
}
