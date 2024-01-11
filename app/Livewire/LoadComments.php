<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class LoadComments extends Component
{
    use WithPagination;

    public $post;
    public $commentsPerPage = 10;
    public $comments = [];
    private $paginator;

    public function mount($post)
    {
        $this->post = $post;
        $this->loadComments();
    }

    #[On('commented')]
    public function loadComments()
    {
        $this->paginator = Comment::with('user')
            ->where('post_id', $this->post->id)
            ->orderBy('created_at', 'desc')
            ->paginate($this->commentsPerPage);

        $this->comments = $this->paginator->items();
    }

    public function loadMore()
    {
        $this->commentsPerPage += 15;
        $this->loadComments();
    }

    public function render()
    {
        return view(
            'livewire.load-comments',
            [
                'comments' => $this->comments,
                'paginator' => $this->paginator,
            ]
        );
    }
}
