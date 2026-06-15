<nav x-data="{ open: false }" class="bg-red-950 text-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ auth()->user()?->podeAcessarDenuncias() ? route('admin.dashboard') : route('dashboard') }}"
                        class="flex items-center gap-3">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('images/logo-branca.png') }}" alt="Friobom Distribuidora"
                                class="h-10 w-auto">

                            <div class="leading-tight">
                                <div class="font-bold text-white">
                                    Canal de Denúncias
                                </div>
                                <div class="text-xs text-red-100">
                                    Friobom Distribuidora
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-2 sm:ms-10 sm:flex sm:items-center">

                    @if (auth()->user()?->podeAcessarDenuncias())
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-red-100 hover:text-white">
                            Dashboard
                        </x-nav-link>

                        <x-nav-link :href="route('admin.denuncias.index')" :active="request()->routeIs('admin.denuncias.*')" class="text-red-100 hover:text-white">
                            Denúncias
                        </x-nav-link>

                        @if (auth()->user()->podeGerenciarUsuarios())
                            <x-nav-link :href="route('admin.usuarios.index')" :active="request()->routeIs('admin.usuarios.*')" class="text-red-100 hover:text-white">
                                Usuários
                            </x-nav-link>

                            <x-nav-link :href="route('admin.auditoria.index')" :active="request()->routeIs('admin.auditoria.*')" class="text-red-100 hover:text-white">
                                Auditoria
                            </x-nav-link>
                        @endif
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="mr-4 text-right">
                    <div class="text-sm font-semibold text-white">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="text-xs text-red-100">
                        {{ ucfirst(Auth::user()->perfil ?? 'usuário') }}
                    </div>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center justify-center h-10 w-10 rounded-2xl bg-white/10 ring-1 ring-white/20 hover:bg-white/15 focus:outline-none transition">
                            <svg class="fill-current h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Meu perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Sair
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-xl text-red-100 hover:text-white hover:bg-white/10 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden border-t border-white/10">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Início
            </x-responsive-nav-link>

            @if (auth()->user()?->podeAcessarDenuncias())
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    Dashboard
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('admin.denuncias.index')" :active="request()->routeIs('admin.denuncias.*')">
                    Denúncias
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-white/10">
            <div class="px-4">
                <div class="font-medium text-base text-white">
                    {{ Auth::user()->name }}
                </div>

                <div class="font-medium text-sm text-red-100">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Meu perfil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Sair
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
