<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Denúncias
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Consulte, filtre e acompanhe as denúncias registradas.
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

            <div class="bg-red-950 rounded-3xl p-6 text-white shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <div
                            class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-sm font-semibold text-red-50 ring-1 ring-white/15">
                            Painel administrativo
                        </div>

                        <h3 class="mt-4 text-2xl font-bold">
                            Gestão de denúncias
                        </h3>

                        <p class="mt-2 text-sm text-red-100 max-w-2xl">
                            Visualize as denúncias registradas, acompanhe o status e acesse os detalhes para apuração.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/15 min-w-40">
                        <div class="text-xs uppercase tracking-wide text-red-100">
                            Total listado
                        </div>

                        <div class="mt-1 text-3xl font-bold">
                            {{ $denuncias->total() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 shadow-sm rounded-3xl overflow-hidden">
                <div
                    class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">
                            Denúncias registradas
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Listagem geral das denúncias recebidas pelo canal.
                        </p>
                    </div>
                </div>

                <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">
                    <form method="GET" action="{{ route('admin.denuncias.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-6 gap-4">
                            <div class="md:col-span-2 xl:col-span-2">
                                <label for="busca"
                                    class="block text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Busca
                                </label>

                                <input type="text" name="busca" id="busca"
                                    value="{{ $filtros['busca'] ?? '' }}"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                    placeholder="Protocolo, nome, e-mail ou local">
                            </div>

                            <div>
                                <label for="status"
                                    class="block text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Status
                                </label>

                                <select name="status" id="status"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20">
                                    <option value="">Todos</option>
                                    @foreach ($statusDisponiveis as $valor => $label)
                                        <option value="{{ $valor }}" @selected(($filtros['status'] ?? '') === $valor)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="tipo"
                                    class="block text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Tipo
                                </label>

                                <select name="tipo" id="tipo"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20">
                                    <option value="">Todos</option>
                                    @foreach ($tipos as $valor => $label)
                                        <option value="{{ $valor }}" @selected(($filtros['tipo'] ?? '') === $valor)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="identificacao"
                                    class="block text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Identificação
                                </label>

                                <select name="identificacao" id="identificacao"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-900 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20">
                                    <option value="">Todas</option>
                                    <option value="anonima" @selected(($filtros['identificacao'] ?? '') === 'anonima')>Anônima</option>
                                    <option value="identificada" @selected(($filtros['identificacao'] ?? '') === 'identificada')>Identificada</option>
                                </select>
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

                            <div class="md:col-span-2 flex items-end justify-end gap-3">
                                <a href="{{ route('admin.denuncias.index') }}"
                                    class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                                    Limpar
                                </a>

                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-xl bg-red-900 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2">
                                    Filtrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                @if ($denuncias->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Protocolo
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Tipo
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Status
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Identificação
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Data
                                    </th>

                                    <th
                                        class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Ações
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-200 bg-white">
                                @foreach ($denuncias as $denuncia)

                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-mono text-sm font-bold text-slate-900">
                                                {{ $denuncia->protocolo }}
                                            </div>

                                            <div class="mt-1 text-xs text-slate-500">
                                                ID #{{ $denuncia->id }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-slate-800">
                                                {{ $denuncia->tipoLabel() }}
                                            </div>

                                            <div class="mt-1 text-xs text-slate-500">
                                                Prioridade: {{ $denuncia->prioridadeLabel() }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $denuncia->statusClasses() }}">
                                                {{ $denuncia->statusLabel() }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($denuncia->anonima)
                                                <span
                                                    class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700 ring-1 ring-inset ring-slate-200">
                                                    Anônima
                                                </span>
                                            @else
                                                <div class="text-sm font-semibold text-slate-800">
                                                    {{ $denuncia->nome ?: 'Identificada' }}
                                                </div>

                                                @if ($denuncia->email)
                                                    <div class="mt-1 text-xs text-slate-500">
                                                        {{ $denuncia->email }}
                                                    </div>
                                                @endif
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-slate-900">
                                                {{ $denuncia->created_at->format('d/m/Y') }}
                                            </div>

                                            <div class="mt-1 text-xs text-slate-500">
                                                {{ $denuncia->created_at->format('H:i') }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <a href="{{ route('admin.denuncias.show', $denuncia) }}"
                                                class="inline-flex items-center justify-center rounded-xl bg-red-900 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-950">
                                                Ver detalhes
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                        {{ $denuncias->links() }}
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <div
                            class="mx-auto mb-3 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-50 border border-slate-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-slate-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414A1 1 0 0 1 19 9.414V19a2 2 0 0 1-2 2Z" />
                            </svg>
                        </div>

                        <p class="text-sm font-semibold text-slate-800">
                            Nenhuma denúncia registrada até o momento.
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            As denúncias recebidas aparecerão nesta listagem.
                        </p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
