@extends('layouts.app')

@section('title')
    {{ auth()->user()->username }}
@endsection

@section('content')
    <x-card class="max-w-lg">
        <x-card-header>
            <x-card-title>{{ auth()->user()->username }}</x-card-title>
        </x-card-header>

        <x-card-content>
            <form method="POST" action="{{ route('perfil.update', auth()->user()->id) }}" class="flex flex-col w-full mx-auto"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nombre de usuario -->
                <div class="mb-6">
                    <x-label for="username">Username</x-label>
                    <x-input name="username" id="username" type="text"
                        class="mt-1 p-2 h-10 w-full rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500"
                        placeholder="Username" value="{{ old('username', auth()->user()->username) }}" />

                    @error('username')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Descripcion -->
                <div class="mb-6">
                    <x-label for="description">Description</x-label>
                    <x-input type="text" name="description" id="description"
                        class="mt-1 p-2 h-10 w-full rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500"
                        placeholder="Description" value="{{ old('description', auth()->user()->description) }}" />

                    @error('description')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Vista previa de la imagen -->
                <div class="mb-6">
                    <x-label for="image">Profile Image</x-label>
                    <x-input name="image" id="image" type="file" accept=".jpeg, .jpg, .png"
                        onchange="previewImage(event)" />
                    <div class="mt-2">
                        <img id="image-preview" class="hidden rounded-lg max-w-full h-auto" alt="Preview">
                    </div>

                    @error('image')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="flex justify-center gap-4">
                    <!-- Botón de envío -->
                    <x-button type="submit">
                        Save changes
                    </x-button>

                    <x-link href="{{ URL::previous() }}">
                        Return
                    </x-link>
                </div>
            </form>
        </x-card-content>
    </x-card>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
