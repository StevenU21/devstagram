<div>
    @if ($notifications->isEmpty())
        <div class="px-4 py-2 border-b bg-gray-100 text-lg font-semibold text-gray-700">
            <p>No hay notificaciones disponibles.</p>
        </div>
    @else
        <div class="px-4 py-2 flex justify-start gap-4 items-center">
            <x-button
                class="bg-red-500 hover:bg-red-600 flex items-center gap-2"
                wire:click.prevent="deleteAllNotifications">
                <i class="fas fa-trash"></i> Eliminar
            </x-button>
            <x-button
                class="flex items-center gap-2"
                wire:click.prevent="toggleAllNotifications">
                @if ($notifications->whereNull('read_at')->isEmpty())
                    <i class="fas fa-eye-slash"></i> Desmarcar Todos
                @else
                    <i class="fas fa-eye"></i> Marcar Todos
                @endif
            </x-button>
        </div>
        <!-- Notificaciones -->
        @foreach ($notifications as $notification)
            <a href="#" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 space-x-4 relative"
                wire:click.prevent="redirectToNotification('{{ $notification->id }}')">
                <img class="h-10 w-10 rounded-full object-cover" src="{{ $notification->data['profile_image'] }}"
                    alt="avatar">
                <div class="text-sm space-y-1">
                    <p class="text-gray-900 leading-none">{{ $notification->data['user_name'] }}</p>
                    <p class="text-gray-600"> {{ Str::limit($notification->data['message'], 24) }}
                    </p>
                    <p class="text-gray-600">{{ $notification->created_at->diffForHumans() }}</p>
                </div>
                <span
                    class="absolute top-1/2 transform -translate-y-1/2 right-4 px-2 py-0.5 text-xs text-white bg-{{ $notification->read_at ? 'green' : 'red' }}-500 rounded-full">{{ $notification->read_at ? 'Leído' : 'No leído' }}</span>
            </a>
        @endforeach
    @endif
</div>
