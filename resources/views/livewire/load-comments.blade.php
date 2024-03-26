 <x-card-footer class="flex space-y-4 overflow-y-auto max-h-48">
     @forelse ($comments as $comment)
         <x wire:key="{{ $comment->id }}">
             <img class="w-10 h-10 rounded-full" src="{{ asset('storage/profiles' . '/' . $comment->user->image) }}"
                 alt="User profile picture">
             <div class="space-y-1">
                 <p class="font-semibold text-sm text-blue-600">{{ $comment->user->username }}</p>
                 <p class="text-sm text-gray-700">{{ $comment->comment }}</p>
             </div>
         </x>
     @empty
         <p>No comments yet</p>
     @endforelse

     @if ($paginator->hasMorePages())
         <div class="mt-4 mb-4 flex justify-center">
             <x-button wire:click="loadMore">
                 Cargar más comentarios
             </x-button>
         </div>
     @endif
 </x-card-footer>
