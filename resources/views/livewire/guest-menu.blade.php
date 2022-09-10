
<nav x-data="{ open: false }" class="bg-blue-700 py-4">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center">
            <div class="shrink-0 flex items-center">
                <a href="{{ url('/') }}">
                    <x-jet-application-mark class="block h-9 w-auto" />
                </a>
            </div>
        </div>
        

        {{-- links --}}
        {{-- <div class="flex gap-2 justify-center">
            <x-nav-link href="{{ url('/') }}" :active="request()->is('/')">
                {{ __('Inicio') }}
            </x-nav-link>
            <x-nav-link href="{{ url('/') }}" :active="request()->is('menu')">
                {{ __('Nuestro Menu') }}
            </x-nav-link>
            <x-nav-link href="{{ url('/') }}" :active="request()->is('contacto')">
                {{ __('Contacto') }}
            </x-nav-link>
            <x-nav-link href="{{ url('/') }}" :active="request()->is('nosotros')">
                {{ __('Nosotros') }}
            </x-nav-link>
            <x-jet-button wire:click="createShowModal">
                {{ __('Ordenar Ahora') }}
            </x-jet-button>
        </div> --}}

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 px-2 space-y-1 text-center">
            <x-jet-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-jet-responsive-nav-link>
        </div>
            @auth
                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                        @endif

                        <div>
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    
                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                            {{ __('Profile') }}
                        </x-jet-responsive-nav-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                {{ __('API Tokens') }}
                            </x-jet-responsive-nav-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-jet-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
</nav>
