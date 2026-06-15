<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Auditoria
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Consulte os registros de ações administrativas do sistema.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                Voltar ao dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="rounded-3xl bg-red-950 p-6 text-white shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <div
                            class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-sm font-semibold text-red-50 ring-1 ring-white/15">
                            Segurança
                        </div>

                        <h3 class="mt-4 text-2xl font-bold">
                            Histórico de auditoria
                        </h3>

                        <p class="mt-2 text-sm text-red-100 max-w-2xl">
                            Acompanhe alterações de usuários, status, comentários, downloads e demais ações sensíveis.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/15 min-w-40">
                        <div class="text-xs uppercase tracking-wide text-red-100">
                            Total listado
                        </div>

                        <div class="mt-1 text-3xl font-bold">
                            {{ $logs->total() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 shadow-sm rounded-3xl overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-200">
                    <h3 class="text-lg font-bold text-slate-900">
                        Filtros
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Filtre por usuário, ação, descrição, protocolo, IP ou período.
                    </p>
                </div>

                <div class="px-6 py-5 bg-slate-50 border-b border-slate-200">
                    <form method="GET" action="{{ route('admin.auditoria.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="md:col-span-2">
                                <label for="busca"
                                    class="block text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Busca
                                </label>

                                <input type="text" name="busca" id="busca"
                                    value="{{ $filtros['busca'] ?? '' }}"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                    placeholder="Usuário, e-mail, descrição, protocolo ou IP">
                            </div>

                            <div>
                                <label for="acao"
                                    class="block text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Ação
                                </label>

                                <select name="acao" id="acao"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20">
                                    <option value="">Todas</option>

                                    @foreach ($acoes as $acao)
                                        <option value="{{ $acao }}" @selected(($filtros['acao'] ?? '') === $acao)>
                                            {{ ucfirst(str_replace('_', ' ', $acao)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-end">
                                <a href="{{ route('admin.auditoria.index') }}"
                                    class="inline-flex w-full items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                                    Limpar
                                </a>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label for="data_inicio"
                                    class="block text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Data inicial
                                </label>

                                <input type="date" name="data_inicio" id="data_inicio"
                                    value="{{ $filtros['data_inicio'] ?? '' }}"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20">
                            </div>

                            <div>
                                <label for="data_fim"
                                    class="block text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Data final
                                </label>

                                <input type="date" name="data_fim" id="data_fim"
                                    value="{{ $filtros['data_fim'] ?? '' }}"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20">
                            </div>

                            <div class="md:col-span-2 flex items-end justify-end">
                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-xl bg-red-900 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2">
                                    Filtrar auditoria
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                @if ($logs->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Data
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Usuário
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Ação
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Descrição
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                        IP
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-200 bg-white">
                                @foreach ($logs as $log)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-slate-900">
                                                {{ $log->created_at->format('d/m/Y') }}
                                            </div>

                                            <div class="mt-1 text-xs text-slate-500">
                                                {{ $log->created_at->format('H:i') }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-slate-900">
                                                {{ $log->usuario->name ?? 'Usuário não identificado' }}
                                            </div>

                                            @if ($log->usuario?->email)
                                                <div class="mt-1 text-xs text-slate-500">
                                                    {{ $log->usuario->email }}
                                                </div>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700 ring-1 ring-inset ring-slate-200">
                                                {{ ucfirst(str_replace('_', ' ', $log->acao)) }}
                                            </span>

                                            @if ($log->denuncia)
                                                <div class="mt-2 text-xs text-slate-500">
                                                    Denúncia:
                                                    <a href="{{ route('admin.denuncias.show', $log->denuncia) }}"
                                                        class="font-semibold text-red-900 hover:text-red-950">
                                                        {{ $log->denuncia->protocolo }}
                                                    </a>
                                                </div>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="max-w-xl text-sm leading-6 text-slate-700">
                                                {{ $log->descricao ?: 'Sem descrição.' }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-mono text-xs text-slate-600">
                                                {{ $log->ip ?: '-' }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                        {{ $logs->links() }}
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <p class="text-sm font-semibold text-slate-800">
                            Nenhum registro de auditoria encontrado.
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            As ações administrativas registradas aparecerão aqui.
                        </p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
