<div class="flex w-full mt-1 pt-2 pl-5">
    @foreach ($profileImages as $image)
        <img class="inline-block object-cover w-8 h-8 text-white border-2 border-white rounded-full shadow-sm cursor-pointer mr-2"
            src="{{ $image }}" alt="Perfil de usuario">
    @endforeach
</div>