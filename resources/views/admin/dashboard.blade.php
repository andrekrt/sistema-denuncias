<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Dashboard
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Visão geral do Canal de Denúncias da Friobom.
                </p>
            </div>

            <a href="{{ route('admin.denuncias.index') }}"
                class="inline-flex items-center justify-center rounded-xl bg-red-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2">
                Ver todas as denúncias
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <div class="lg:col-span-1">
                    <div class="h-full rounded-3xl bg-red-950 p-6 text-white shadow-sm">
                        <div
                            class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 ring-1 ring-white/20 mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414A1 1 0 0 1 19 9.414V19a2 2 0 0 1-2 2Z" />
                            </svg>
                        </div>

                        <div class="text-sm font-medium text-red-100">
                            Total de denúncias
                        </div>

                        <div class="mt-3 text-5xl font-bold tracking-tight">
                            {{ $total }}
                        </div>

                        <p class="mt-4 text-sm leading-6 text-red-100">
                            Quantidade total de denúncias registradas no sistema.
                        </p>

                        <div class="mt-6 rounded-2xl bg-white/10 p-4 ring-1 ring-white/15">
                            <div class="text-xs uppercase tracking-wide text-red-100">
                                Atualizado em
                            </div>

                            <div class="mt-1 text-sm font-semibold text-white">
                                {{ now()->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-semibold text-slate-500">
                                    Recebidas
                                </div>

                                <div
                                    class="h-10 w-10 rounded-2xl bg-red-50 text-red-800 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8.25V18a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V8.25m-18 0A2.25 2.25 0 0 1 5.25 6h13.5A2.25 2.25 0 0 1 21 8.25m-18 0 9 5.25 9-5.25" />
                                    </svg>
                                </div>
                            </div>

                            <div class="mt-4 text-3xl font-bold text-slate-900">
                                {{ $contadores['recebidas'] }}
                            </div>

                            <div class="mt-2 text-sm text-slate-500">
                                Novas denúncias aguardando análise.
                            </div>
                        </div>

                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-semibold text-slate-500">
                                    Em análise
                                </div>

                                <div
                                    class="h-10 w-10 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="mt-4 text-3xl font-bold text-slate-900">
                                {{ $contadores['em_analise'] }}
                            </div>

                            <div class="mt-2 text-sm text-slate-500">
                                Casos em avaliação inicial.
                            </div>
                        </div>

                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-semibold text-slate-500">
                                    Em apuração
                                </div>

                                <div
                                    class="h-10 w-10 rounded-2xl bg-orange-50 text-orange-700 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6l4 2m6-2a10 10 0 1 1-20 0 10 10 0 0 1 20 0Z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="mt-4 text-3xl font-bold text-slate-900">
                                {{ $contadores['em_apuracao'] }}
                            </div>

                            <div class="mt-2 text-sm text-slate-500">
                                Casos em investigação.
                            </div>
                        </div>

                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-semibold text-slate-500">
                                    Aguardando informações
                                </div>

                                <div
                                    class="h-10 w-10 rounded-2xl bg-yellow-50 text-yellow-700 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm3.75 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm3.75 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 0 1-4-.8L3 20l1.2-3.6A7.7 7.7 0 0 1 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8Z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="mt-4 text-3xl font-bold text-slate-900">
                                {{ $contadores['aguardando_informacoes'] }}
                            </div>

                            <div class="mt-2 text-sm text-slate-500">
                                Pendentes de dados adicionais.
                            </div>
                        </div>

                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-semibold text-slate-500">
                                    Concluídas
                                </div>

                                <div
                                    class="h-10 w-10 rounded-2xl bg-green-50 text-green-700 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="mt-4 text-3xl font-bold text-slate-900">
                                {{ $contadores['concluidas'] }}
                            </div>

                            <div class="mt-2 text-sm text-slate-500">
                                Casos finalizados.
                            </div>
                        </div>

                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-semibold text-slate-500">
                                    Arquivadas
                                </div>

                                <div
                                    class="h-10 w-10 rounded-2xl bg-slate-100 text-slate-700 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m20.25 7.5-.625 10.632A2.25 2.25 0 0 1 17.378 20.25H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="mt-4 text-3xl font-bold text-slate-900">
                                {{ $contadores['arquivadas'] }}
                            </div>

                            <div class="mt-2 text-sm text-slate-500">
                                Casos arquivados.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 shadow-sm rounded-3xl overflow-hidden">
                <div
                    class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">
                            Últimas denúncias
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Registros mais recentes recebidos pelo canal.
                        </p>
                    </div>

                    <a href="{{ route('admin.denuncias.index') }}"
                        class="text-sm font-semibold text-red-900 hover:text-red-950">
                        Ver listagem completa
                    </a>
                </div>

                @if ($ultimasDenuncias->count())
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
                                        Data
                                    </th>

                                    <th
                                        class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Ações
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-200 bg-white">
                                @foreach ($ultimasDenuncias as $denuncia)
                                    @php
                                        $statusLabel = match ($denuncia->status) {
                                            'recebida' => 'Recebida',
                                            'em_analise' => 'Em análise',
                                            'em_apuracao' => 'Em apuração',
                                            'aguardando_informacoes' => 'Aguardando informações',
                                            'concluida' => 'Concluída',
                                            'arquivada' => 'Arquivada',
                                            default => ucfirst(str_replace('_', ' ', $denuncia->status)),
                                        };

                                        $statusClasses = match ($denuncia->status) {
                                            'recebida' => 'bg-red-50 text-red-800 ring-red-100',
                                            'em_analise' => 'bg-amber-50 text-amber-800 ring-amber-100',
                                            'em_apuracao' => 'bg-orange-50 text-orange-800 ring-orange-100',
                                            'aguardando_informacoes' => 'bg-yellow-50 text-yellow-800 ring-yellow-100',
                                            'concluida' => 'bg-green-50 text-green-800 ring-green-100',
                                            'arquivada' => 'bg-slate-100 text-slate-700 ring-slate-200',
                                            default => 'bg-slate-100 text-slate-700 ring-slate-200',
                                        };

                                        $tipoLabel = match ($denuncia->tipo) {
                                            'assedio_moral' => 'Assédio moral',
                                            'assedio_sexual' => 'Assédio sexual',
                                            'discriminacao' => 'Discriminação',
                                            'fraude' => 'Fraude ou desvio',
                                            'conflito_interesses' => 'Conflito de interesses',
                                            'seguranca_trabalho' => 'Segurança do trabalho',
                                            'outros' => 'Outros',
                                            default => ucfirst(str_replace('_', ' ', $denuncia->tipo)),
                                        };
                                    @endphp

                                    <tr class="hover:bg-slate-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="font-mono text-sm font-semibold text-slate-900">
                                                {{ $denuncia->protocolo }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-slate-700">
                                                {{ $tipoLabel }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $statusClasses }}">
                                                {{ $statusLabel }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-slate-900">
                                                {{ $denuncia->created_at->format('d/m/Y') }}
                                            </div>

                                            <div class="text-xs text-slate-500">
                                                {{ $denuncia->created_at->format('H:i') }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <a href="{{ route('admin.denuncias.show', $denuncia) }}"
                                                class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                                                Ver detalhes
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-6 py-10 text-center">
                        <div
                            class="mx-auto mb-3 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-50 border border-slate-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414A1 1 0 0 1 19 9.414V19a2 2 0 0 1-2 2Z" />
                            </svg>
                        </div>

                        <p class="text-sm font-semibold text-slate-800">
                            Nenhuma denúncia registrada até o momento.
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            As denúncias recebidas aparecerão aqui.
                        </p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
