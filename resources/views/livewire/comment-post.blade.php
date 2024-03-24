<form wire:submit.prevent="storeComment"
    class="relative flex items-center self-center w-full max-w-xl p-4 overflow-hidden text-gray-600 focus-within:text-gray-400">
    <img class="w-10 h-10 object-cover rounded-full shadow mr-2 cursor-pointer" alt="User avatar"
        src="{{ auth()->user()->url() }}">

    <x-label>
        <x-input wire:model.live="comment" type="search" name="comment"
        placeholder="Post a comment..." autocomplete="off" />
        <span class="mr-4">
            <span class="emoji-button focus:outline-none focus:shadow-none hover:text-blue-500"
                id="emojiButton{{ $post->id }}" style="cursor: pointer;">
                <svg class="w-6 h-6 transition ease-out duration-300 hover:text-blue-500 text-gray-400"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
            </span>
        </span>
    </x-label>

    @error('comment')
        <div class="mt-2">
            <span class="text-red-500 text-xs">{{ $message }}</span>
        </div>
    @enderror
</form>
