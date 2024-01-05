<div class="text-black p-4 antialiased flex">
    <img class="rounded-full h-8 w-8 mr-2 mt-1 " src="https://picsum.photos/id/1027/200/200">
    <div>
        <div class="bg-gray-100 rounded-lg px-4 pt-2 pb-2.5">
            <a href="{{ route('post.index', $comment->user) }}" class="text-gray-600 text-sm font-semibold">{{ $comment->user->username }}</a>
            <div class="text-xs leading-snug md:leading-normal">{{ $comment->comment }}</div>
        </div>
        <div class="text-xs  mt-0.5 text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
    </div>
</div>
