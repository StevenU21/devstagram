<div class="space-y-4 overflow-y-auto max-h-48">
    @forelse ($comments as $comment)
        <div wire:key="{{ $comment->id }}">
            <img class="w-10 h-10 rounded-full"  src="{{ asset('storage/profiles' . '/' . $comment->user->image) }}" alt="User profile picture">
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

    @if ($paginator->hasMorePages())
        <div class="mt-4 mb-4 flex justify-center">
            <button wire:click="loadMore"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                Cargar más comentarios
            </button>
        </div>
    @endif
</div>
