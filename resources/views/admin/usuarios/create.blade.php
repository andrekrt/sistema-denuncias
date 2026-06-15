<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Novo usuário
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Cadastre um novo usuário com acesso ao Canal de Denúncias.
                </p>
            </div>

            <a href="{{ route('admin.usuarios.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                Voltar para usuários
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="rounded-3xl bg-red-950 p-6 text-white shadow-sm">
                <div class="flex items-start gap-4">
                    <div
                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/10 text-xl font-bold ring-1 ring-white/15">
                        +
                    </div>

                    <div>
                        <div class="text-xs uppercase tracking-wide text-red-100">
                            Cadastro
                        </div>

                        <h3 class="mt-1 text-2xl font-bold">
                            Criar usuário
                        </h3>

                        <p class="mt-1 text-sm text-red-100">
                            Defina nome, e-mail, senha inicial e perfil de acesso.
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-6 sm:p-8">
                <form method="POST" action="{{ route('admin.usuarios.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-800">
                            Nome <span class="text-red-800">*</span>
                        </label>

                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                            placeholder="Nome do usuário">

                        @error('name')
                            <p class="mt-2 text-sm text-red-700">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-800">
                            E-mail <span class="text-red-800">*</span>
                        </label>

                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                            placeholder="usuario@empresa.com.br">

                        @error('email')
                            <p class="mt-2 text-sm text-red-700">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="password" class="block text-sm font-semibold text-slate-800">
                                Senha <span class="text-red-800">*</span>
                            </label>

                            <input type="password" name="password" id="password" required
                                class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                placeholder="Mínimo de 8 caracteres">

                            @error('password')
                                <p class="mt-2 text-sm text-red-700">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-slate-800">
                                Confirmar senha <span class="text-red-800">*</span>
                            </label>

                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                placeholder="Repita a senha">
                        </div>
                    </div>

                    <div>
                        <label for="perfil" class="block text-sm font-semibold text-slate-800">
                            Perfil de acesso <span class="text-red-800">*</span>
                        </label>

                        <select name="perfil" id="perfil" required
                            class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20">
                            <option value="">Selecione um perfil</option>
                            @foreach ($perfils as $valor => $label)
                                <option value="{{ $valor }}" @selected(old('perfil')) === $valor>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>

                        @error('perfil')
                            <p class="mt-2 text-sm text-red-700">
                                {{ $message }}
                            </p>
                        @enderror

                        <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
                            <strong class="text-slate-900">Permissões:</strong>

                            <ul class="mt-2 list-disc list-inside space-y-1">
                                <li><strong>Admin:</strong> gerencia usuários e acessa todas as funções.</li>
                                <li><strong>Comitê:</strong> acessa denúncias, altera status e registra comentários.
                                </li>
                                <li><strong>Visualizador:</strong> apenas visualiza denúncias e detalhes.</li>
                            </ul>
                        </div>
                    </div>

                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-t border-slate-200 pt-6">
                        <p class="text-sm text-slate-500">
                            O usuário poderá acessar o sistema usando o e-mail e a senha cadastrados.
                        </p>

                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-red-900 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2">
                            Criar usuário
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
