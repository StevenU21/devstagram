<div class="space-y-4">
    @forelse ($comments as $comment)
        <div class="flex items-start space-x-2 p-3 bg-white rounded-lg shadow">
            <img class="w-10 h-10 rounded-full" src="{{ $comment->user->url() }}" alt="{{ $comment->user->name }}">
            <div class="space-y-1">
                <p class="font-semibold text-sm text-blue-600">{{ $comment->user->username }}</p>
                <p class="text-sm text-gray-700">{{ $comment->comment }}</p>
            </div>
        </div>
    @empty
        <div class="text-gray-500 text-sm mb-6 mx-3 px-2 py-4">
            No comments yet
        </div>
    @endforelse
</div>
