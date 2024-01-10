<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class LoadPost extends Component
{
    public $post;

    public function mount($post)
    {
        $this->post = $post;
    }

    #[On('commented')] 
    public function updated()
    {
        $this->post = Post::with(['comments' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->find($this->post->id);
    }

    public function render()
    {
        return view('livewire.load-post', [
            'comments' => $this->post->comments,
        ]);
    }
}
