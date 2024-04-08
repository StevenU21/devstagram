<div>
    <div class="relative inline-block text-left">
        @if ($notifications->isEmpty())
            <x-button variant="icon" id="dropdownButton">
                <!-- Icono de la campana -->
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.60124 1.25086C8.60124 1.75459 8.26278 2.17927 7.80087 2.30989C10.1459 2.4647 12 4.41582 12 6.79999V10.25C12 11.0563 12.0329 11.7074 12.7236 12.0528C12.931 12.1565 13.0399 12.3892 12.9866 12.6149C12.9333 12.8406 12.7319 13 12.5 13H8.16144C8.36904 13.1832 8.49997 13.4513 8.49997 13.75C8.49997 14.3023 8.05226 14.75 7.49997 14.75C6.94769 14.75 6.49997 14.3023 6.49997 13.75C6.49997 13.4513 6.63091 13.1832 6.83851 13H2.49999C2.2681 13 2.06664 12.8406 2.01336 12.6149C1.96009 12.3892 2.06897 12.1565 2.27638 12.0528C2.96708 11.7074 2.99999 11.0563 2.99999 10.25V6.79999C2.99999 4.41537 4.85481 2.46396 7.20042 2.3098C6.73867 2.17908 6.40036 1.75448 6.40036 1.25086C6.40036 0.643104 6.89304 0.150421 7.5008 0.150421C8.10855 0.150421 8.60124 0.643104 8.60124 1.25086ZM7.49999 3.29999C5.56699 3.29999 3.99999 4.86699 3.99999 6.79999V10.25L4.00002 10.3009C4.0005 10.7463 4.00121 11.4084 3.69929 12H11.3007C10.9988 11.4084 10.9995 10.7463 11 10.3009L11 10.25V6.79999C11 4.86699 9.43299 3.29999 7.49999 3.29999Z"
                        fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </x-button>
        @else
            <x-button variant="icon" id="dropdownButton" class="bg-red-500 text-white">
                <!-- Icono de la campana -->
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.60124 1.25086C8.60124 1.75459 8.26278 2.17927 7.80087 2.30989C10.1459 2.4647 12 4.41582 12 6.79999V10.25C12 11.0563 12.0329 11.7074 12.7236 12.0528C12.931 12.1565 13.0399 12.3892 12.9866 12.6149C12.9333 12.8406 12.7319 13 12.5 13H8.16144C8.36904 13.1832 8.49997 13.4513 8.49997 13.75C8.49997 14.3023 8.05226 14.75 7.49997 14.75C6.94769 14.75 6.49997 14.3023 6.49997 13.75C6.49997 13.4513 6.63091 13.1832 6.83851 13H2.49999C2.2681 13 2.06664 12.8406 2.01336 12.6149C1.96009 12.3892 2.06897 12.1565 2.27638 12.0528C2.96708 11.7074 2.99999 11.0563 2.99999 10.25V6.79999C2.99999 4.41537 4.85481 2.46396 7.20042 2.3098C6.73867 2.17908 6.40036 1.75448 6.40036 1.25086C6.40036 0.643104 6.89304 0.150421 7.5008 0.150421C8.10855 0.150421 8.60124 0.643104 8.60124 1.25086ZM7.49999 3.29999C5.56699 3.29999 3.99999 4.86699 3.99999 6.79999V10.25L4.00002 10.3009C4.0005 10.7463 4.00121 11.4084 3.69929 12H11.3007C10.9988 11.4084 10.9995 10.7463 11 10.3009L11 10.25V6.79999C11 4.86699 9.43299 3.29999 7.49999 3.29999Z"
                        fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg>
            </x-button>
        @endif

        <div id="dropdownContent"
            class="absolute right-0 mt-1 w-[310px] sm:w-[350px] sm:ml-0 mx-auto bg-white rounded-lg shadow-lg overflow-auto max-h-96 z-10 translate-x-[87px] sm:translate-x-[10px]"
            style="display: none;">
            <!-- Encabezado -->
            <x-card class="border">
                <x-card-header>
                    <x-card-title>Notificaciones</x-card-title>
                </x-card-header>
                <hr>
                @if ($notifications->isEmpty())
                    <x-card-content>
                        <x-card-subtitule>No hay notificaciones disponibles.</x-card-subtitule>
                    </x-card-content>
                @else
                    <div class="px-4 py-2 flex justify-start gap-4 items-center">
                        <x-button class="bg-red-500 hover:bg-red-600 flex items-center gap-2"
                            wire:click.prevent="deleteAllNotifications">
                            <i class="fas fa-trash"></i> Eliminar
                        </x-button>
                        <x-button class="flex items-center gap-2" wire:click.prevent="toggleAllNotifications">
                            @if ($notifications->whereNull('read_at')->isEmpty())
                                <i class="fas fa-eye-slash"></i> Desmarcar
                            @else
                                <i class="fas fa-eye"></i> Marcar
                            @endif
                        </x-button>
                    </div>
                    <!-- Notificaciones -->
                    @foreach ($notifications as $notification)
                        <a href="#"
                            class="flex items-center px-4 py-3 border-b hover:bg-gray-100 space-x-4 relative"
                            wire:click.prevent="redirectToNotification('{{ $notification->id }}')">
                            <img class="h-10 w-10 rounded-full object-cover"
                                src="{{ $notification->data['profile_image'] }}" alt="avatar">
                            <div class="text-sm space-y-1">
                                <p class="text-gray-900 leading-none">{{ $notification->data['user_name'] }}</p>
                                <p class="text-gray-600"> {{ Str::limit($notification->data['message'], 23) }}
                                </p>
                                <p class="text-gray-600">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>

                            <span
                                class="absolute top-1/2 transform -translate-y-1/2 right-4 px-2 py-0.5 text-xs text-white rounded-full {{ $notification->read_at ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $notification->read_at ? 'Leído' : 'No leído' }}
                            </span>
                        </a>
                    @endforeach
                @endif
            </x-card>
        </div>
    </div>
</div>
