<div class="bg-white shadow rounded-lg mb-6 p-4">
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    @endpush
    <form action="{{ route('images.store') }}" method="POST" id="dropzone" enctype="multipart/form-data"
        class="w-24 h-24 bg-neutral-100 mb-2 rounded-lg border-dashed border border-blue flex items-center justify-center cursor-pointer text-3xl text-gray-500 dropzone">
        @csrf
        +
    </form>
    <form action="{{ route('post.store') }}" method="POST">
        @csrf
        <textarea name="title" placeholder="Type something..."
            class="w-full rounded-lg p-2 text-sm bg-gray-100 border border-transparent appearance-none rounded-tg placeholder-gray-400"></textarea>
        {{-- <div name='image' id="dropzone" class=" w-32 h-32 bg-sky-100 rounded-lg grid place-content-center border-dashed border-sky-200 border-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </div> --}}
        @error('title')
            <p class="text-red-500">{{ $message }}</p>
        @enderror
        <div class="">
            <input type="hidden" name="image" value="{{ old('image') }}">
        </div>
        @error('image')
        <p class="text-red-500">{{ $message }}</p>
        @enderror
        <footer class="flex justify-between mt-2">
            <div class="flex gap-2">
                <span
                    class="flex items-center transition ease-out duration-300 hover:bg-blue-500 hover:text-white bg-blue-100 w-8 h-8 px-2 rounded-full text-blue-400 cursor-pointer">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                        fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                </span>
                <span
                    class="flex items-center transition ease-out duration-300 hover:bg-blue-500 hover:text-white bg-blue-100 w-8 h-8 px-2 rounded-full text-blue-400 cursor-pointer">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                        fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </span>
                <span
                    class="flex items-center transition ease-out duration-300 hover:bg-blue-500 hover:text-white bg-blue-100 w-8 h-8 px-2 rounded-full text-blue-400 cursor-pointer">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                        fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                        <polyline points="4 17 10 11 4 5"></polyline>
                        <line x1="12" y1="19" x2="20" y2="19"></line>
                    </svg>
                </span>
            </div>
            <button type="submit"
                class="flex items-center py-2 px-4 rounded-lg text-sm bg-blue-600 text-white shadow-lg">Send
                <svg class="ml-1" viewBox="0 0 24 24" width="16" height="16" stroke="currentColor"
                    stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
            </button>
        </footer>
    </form>

</div>
