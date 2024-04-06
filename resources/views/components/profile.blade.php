<div>
    @auth <div class="flex justify-center">
            <div x-data="{
                open: false,
                toggle() {
                    if (this.open) {
                        return this.close()
                    }

                    this.$refs.button.focus()

                    this.open = true
                },
                close(focusAfter) {
                    if (!this.open) return

                    this.open = false

                    focusAfter && focusAfter.focus()
                }
            }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']"
                class="relative">

                <div class="flex items-center justify-center gap-4">
                    <!-- Button -->
                    @livewire('notifications.load-notifications')
                    <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                        :aria-controls="$id('dropdown-button')" type="button" class="rounded-full overflow-clip w-10 h-10 ">
                        <img src="{{ auth()->user()->image() }}" alt="profile" class="object-cover">
                    </button>
                </div>


                <!-- Panel -->
                <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
                    :id="$id('dropdown-button')" style="display: none;"
                    class="absolute right-0 mt-2 w-40 rounded-md bg-white shadow-md">

                    <a href="{{ route('post.index', auth()->user()->username) }}"
                        class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                        Perfil
                    </a>

                    <a href="{{ route('perfil.update', auth()->user()->username) }}"
                        class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                        Editar Perfil
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" variant="icon"
                            class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500">
                            Cerrar sesion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endauth

</div>
