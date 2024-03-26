<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class CountComments extends Component
{
    public $count;
    public $post;

    public function mount($postId)
    {
        $this->post = Post::withCount('comments')->find($postId);
        $this->count = $this->post->comments_count;
    }

    #[On('commented')]
    public function incrementCount()
    {
        $this->count = $this->post->comments()->count();
    }

    public function render()
    {
        return view('livewire.count-comments');
    }
}