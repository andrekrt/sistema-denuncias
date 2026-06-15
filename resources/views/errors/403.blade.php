<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                Acesso negado
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Você não tem permissão para acessar esta área ou executar esta ação.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-white border border-slate-200 shadow-sm overflow-hidden">
                <div class="bg-red-950 p-8 text-white">
                    <div
                        class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 ring-1 ring-white/15">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3.75m0 3.75h.008v.008H12v-.008ZM10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                        </svg>
                    </div>

                    <h1 class="mt-5 text-3xl font-bold">
                        Permissão insuficiente
                    </h1>

                    <p class="mt-3 text-sm leading-6 text-red-100">
                        Seu perfil de acesso não permite visualizar esta página ou realizar esta operação.
                        Caso acredite que isso seja um erro, entre em contato com um administrador do sistema.
                    </p>
                </div>

                <div class="p-8">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm font-semibold text-slate-900">
                            Código do erro: 403
                        </p>

                        <p class="mt-1 text-sm text-slate-600">
                            A tentativa foi bloqueada pelas regras de permissão do Canal de Denúncias.
                        </p>
                    </div>

                    <div class="mt-6 flex flex-col sm:flex-row gap-3">
                        @auth
                            <a href="{{ route('admin.dashboard') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-red-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950">
                                Voltar ao dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-red-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950">
                                Fazer login
                            </a>
                        @endauth

                        <a href="{{ url()->previous() }}"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                            Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
