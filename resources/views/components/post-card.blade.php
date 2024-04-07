<div class="bg-white shadow rounded-lg mb-6 max-w-xl w-full mx-auto">
    <div class="flex flex-row px-2 py-3 mx-3 justify-between items-center">
        <div class="flex">
            <a href="{{ route('post.index', $post->user->username) }}" class="w-auto h-auto rounded-full">
                <img class="w-12 h-12 object-cover rounded-full shadow cursor-pointer" alt="User avatar"
                    src="{{ $post->user->image() }}">
            </a>
            <div class="flex flex-col mb-2 ml-4 mt-1">
                <a href="{{ route('post.index', $post->user->username) }}"
                    class="text-gray-600 text-sm font-semibold">{{ $post->user->username }}</a>
                <div class="flex w-full mt-1">
                    <div class="text-blue-700 font-base text-xs mr-1 cursor-pointer">
                        {{ strtoupper($post->user->role) }}
                    </div>
                    <div class="text-gray-400 font-thin text-xs">
                        {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
        @auth
            @if ($post->user_id === auth()->user()->id)
                <form action="{{ route('post.destroy', $post) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </form>
            @endif
        @endauth
    </div>
    <div class="border-b border-gray-100"></div>
    <div class="text-gray-400 font-medium text-sm mb-7 mt-6 mx-3 px-2 ">
        <a href="{{ route('post.show', ['post' => $post, 'user' => $post->user]) }}">
            <img class="h-full w-full object-cover rounded-xl" src="{{ asset('uploads') . '/' . $post->image }}"
                alt="">
        </a>

    </div>
    <div class="text-gray-500 text-sm mb-4 mx-3 px-2">
        {{ $post->text }}
    </div>
    <div class="flex justify-start mb-2 border-t border-gray-100">
        {{-- <div class="flex w-full mt-1 pt-2 pl-5">
            <span
                class="bg-white transition ease-out duration-300 hover:text-red-500 border w-8 h-8 px-2 pt-2 text-center rounded-full text-gray-400 cursor-pointer mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="14px" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                </svg>
            </span>
            <img class="inline-block object-cover w-8 h-8 text-white border-2 border-white rounded-full shadow-sm cursor-pointer"
                src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                alt="">
            <img class="inline-block object-cover w-8 h-8 -ml-2 text-white border-2 border-white rounded-full shadow-sm cursor-pointer"
                src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                alt="">
            <img class="inline-block object-cover w-8 h-8 -ml-2 text-white border-2 border-white rounded-full shadow-sm cursor-pointer"
                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=634&amp;q=80"
                alt="">
            <img class="inline-block object-cover w-8 h-8 -ml-2 text-white border-2 border-white rounded-full shadow-sm cursor-pointer"
                src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2.25&amp;w=256&amp;h=256&amp;q=80"
                alt="">
        </div> --}}

        <livewire:user-liked-post :postId="$post->id" />

        @php
        $url = route('post.show', ['post' => $post, 'user' => $post->user]);
        $title = $post->title;
        $platforms = [
            'Facebook' => ['url' => 'https://www.facebook.com/sharer/sharer.php?u=', 'color' => 'blue'],
            'Twitter' => ['url' => 'https://twitter.com/intent/tweet?url=', 'color' => 'blue'],
            'Pinterest' => ['url' => 'https://pinterest.com/pin/create/button/?url=', 'color' => 'red'],
        ];
    @endphp
        <div class="flex justify-end w-full mt-1 pt-2 pr-5 space-x-2">
            <div id="dropdownMenu" class="relative">
                <button onclick="toggleDropdown(event)" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="14px" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z">
                        </path>
                    </svg>
                </button>
            
                <div id="dropdown" class="absolute bg-white rounded shadow-md bottom-full py-1 w-48 hidden">
                    @foreach ($platforms as $name => $platform)
                        @php
                            $shareUrl = $platform['url'] . urlencode($url) . '&title=' . urlencode($title);
                        @endphp
                        <a href="{{ $shareUrl }}" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fab fa-{{ strtolower($name) }}-square text-{{ $platform['color'] }}-600 mr-2"></i>{{ $name }}
                        </a>
                    @endforeach
                </div>
            </div>
            <script>
                function toggleDropdown(event) {
                    event.stopPropagation();
                    var dropdown = document.getElementById("dropdown");
                    dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
                }

                document.addEventListener('click', function(event) {
                    var dropdown = document.getElementById("dropdown");
                    dropdown.style.display = "none";
                });
            </script>

            <x-link variant="icon" href="#" id="copyLink"
                data-url="{{ route('post.show', ['post' => $post, 'user' => $post->user]) }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                </svg>
            </x-link>

            @auth
                <livewire:like-post :post="$post" />
            @endauth
        </div>
    </div>
    {{-- <div class="flex w-full border-t border-gray-100">
        <div class="mt-3 mx-5 flex flex-row text-xs">
            <div class="flex text-gray-700 font-normal rounded-md mb-2 mr-4 items-center">Comments:
                <div class="ml-1 text-gray-400 text-ms">{{ $post->comments->count() }}</div>
            </div>
        </div>
    </div> --}}

    <livewire:count-comments :postId="$post->id" />

    @auth
        <livewire:comment-post :post="$post" />

        <div>
            @error('comment')
                <p class="text-red-500 text-sm mb-6 mx-3 px-2">
                    {{ $message }}
                </p>
            @enderror
            @if (session('message'))
                <p class="text-green-500 text-sm mb-6 mx-3 px-2">{{ session('message') }}</p>
            @endif
        </div>
    @endauth

    {{-- comentarios --}}
    <livewire:load-comments :post="$post" />
    {{-- fin comentarios --}}
</div>

<script src="https://cdn.jsdelivr.net/clipboard.js/2.0.0/clipboard.min.js"></script>
<script>
    document.getElementById('copyLink').addEventListener('click', function(event) {
        event.preventDefault();
        var postUrl = this.getAttribute('data-url');

        var tempInput = document.createElement('input');
        tempInput.value = postUrl;
        document.body.appendChild(tempInput);

        tempInput.select();
        document.execCommand('copy');

        document.body.removeChild(tempInput);

        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'URL copiada al portapapeles',
            showConfirmButton: true,
        });
    });
</script>
