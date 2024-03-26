<ul class="absolute left-0 mt-6 w-64 bg-white rounded-lg shadow-lg py-2 text-gray-800 z-20">
    <li class="px-4 py-2 text-gray-500 text-sm">Posts</li>
    <hr class="border-t border-gray-300 mx-4">
    @foreach ($posts as $post)
        <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer post-item">{{ $post->text }}</li>
    @endforeach

    <li class="px-4 py-2 text-gray-500 text-sm">Usuarios</li>
    <hr class="border-t border-gray-300 mx-4">
    @foreach ($users as $user)
        <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer user-item flex items-center">
            <img class="h-8 w-8 bg-white p-1 rounded-full shadow mr-2"
                src="{{ $user->image()) }}" alt="">
            {{ $user->username }}
        </li>
    @endforeach
</ul>
