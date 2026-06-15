<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Usuários
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Gerencie os usuários com acesso ao Canal de Denúncias.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.usuarios.create') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-red-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950">
                    Novo usuário
                </a>

                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                    Voltar ao dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="rounded-3xl bg-red-950 p-6 text-white shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <div
                            class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-sm font-semibold text-red-50 ring-1 ring-white/15">
                            Administração
                        </div>

                        <h3 class="mt-4 text-2xl font-bold">
                            Gestão de usuários
                        </h3>

                        <p class="mt-2 text-sm text-red-100 max-w-2xl">
                            Controle quem pode acessar, visualizar, acompanhar e administrar as denúncias.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/15 min-w-40">
                        <div class="text-xs uppercase tracking-wide text-red-100">
                            Total de usuários
                        </div>

                        <div class="mt-1 text-3xl font-bold">
                            {{ $usuarios->total() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 shadow-sm rounded-3xl overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-200">
                    <h3 class="text-lg font-bold text-slate-900">
                        Usuários cadastrados
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Altere o perfil de acesso conforme a função de cada usuário.
                    </p>
                </div>

                @if ($usuarios->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Usuário
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Perfil
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Criado em
                                    </th>

                                    <th
                                        class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Ações
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-200 bg-white">
                                @foreach ($usuarios as $usuario)


                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-slate-900">
                                                {{ $usuario->name }}
                                            </div>

                                            <div class="mt-1 text-xs text-slate-500">
                                                {{ $usuario->email }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $usuario->perfilClasses() }}">
                                                {{ $usuario->perfilLabel() }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-slate-900">
                                                {{ $usuario->created_at->format('d/m/Y') }}
                                            </div>

                                            <div class="mt-1 text-xs text-slate-500">
                                                {{ $usuario->created_at->format('H:i') }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <a href="{{ route('admin.usuarios.edit', $usuario) }}"
                                                class="inline-flex items-center justify-center rounded-xl bg-red-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-950">
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                        {{ $usuarios->links() }}
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <p class="text-sm font-semibold text-slate-800">
                            Nenhum usuário cadastrado.
                        </p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
