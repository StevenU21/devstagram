<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Attributes\On;
use Livewire\Component;

class CountComments extends Component
{
    public $count;
    
    public function mount()
    {
        $this->count = Comment::count();
    }

    #[On('commented')]
    public function incrementCount()
    {
        $this->count++;
    }

    public function render()
    {
        return view('livewire.count-comments');
    }
}
