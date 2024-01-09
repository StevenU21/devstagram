@extends('.layout.app')
@section('title')
    Home
@endsection

@section('content')
    <div class="flex flex-col-reverse lg:flex-row gap-6 justify-center px-4">

        <div>
            @if ($posts)
                <div class="py-6">
                    @foreach ($posts as $post)
                        <x-post-card :post="$post" />
                    @endforeach
                </div>
            @else
                <p class="text-center">No Post Found, start following someone</p>
            @endif
        </div>
        <div>
            <x-suggestions></x-suggestions>
        </div>
    </div>
@endsection
