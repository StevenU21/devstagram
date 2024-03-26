 <x-card-footer class="flex space-y-4 overflow-y-auto max-h-48">
     @forelse ($comments as $comment)
         <div class="text-black antialiased flex">
             <img class="rounded-full h-8 w-8 mr-2 mt-1 "
                 src="{{ asset('storage/profiles' . '/' . $comment->user->image) }}" alt="User profile picture"/>
             <div>
                 <div class="bg-gray-100 rounded-lg px-4 pt-2 pb-2.5">
                     <div class="font-semibold text-sm leading-relaxed">{{ $comment->user->username }}</div>
                     <div class="text-xs leading-snug md:leading-normal">{{ $comment->comment }}</div>
                 </div>
                 <div class="text-xs  mt-0.5 text-gray-500">14 w</div>
             </div>
         </div>
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
