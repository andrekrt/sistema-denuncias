<x-guest-layout>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white border border-slate-200 shadow-sm rounded-3xl overflow-hidden">

            <div class="bg-red-950 px-6 sm:px-8 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-5">
                    <div>
                        <div
                            class="inline-flex items-center justify-center h-12 w-12 rounded-2xl bg-white/10 ring-1 ring-white/20 mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-300" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414A1 1 0 0 1 19 9.414V19a2 2 0 0 1-2 2Z" />
                            </svg>
                        </div>

                        <h1 class="text-3xl font-bold tracking-tight">
                            Acompanhamento da denúncia
                        </h1>

                        <p class="mt-3 text-red-100">
                            Consulte abaixo o status atual e as mensagens públicas relacionadas à sua denúncia.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/10 ring-1 ring-white/15 px-4 py-3">
                        <div class="text-xs uppercase tracking-wide text-red-100">
                            Protocolo
                        </div>

                        <div class="mt-1 font-mono text-lg font-bold text-white">
                            {{ $denuncia->protocolo }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 sm:p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <div class="text-sm font-semibold text-slate-500">
                            Status atual
                        </div>

                        <div class="mt-2 text-lg font-bold text-slate-900">
                            {{ $statusFormatado }}
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <div class="text-sm font-semibold text-slate-500">
                            Registrada em
                        </div>

                        <div class="mt-2 text-lg font-bold text-slate-900">
                            {{ $denuncia->created_at->format('d/m/Y') }}
                        </div>

                        <div class="mt-1 text-sm text-slate-500">
                            {{ $denuncia->created_at->format('H:i') }}
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <div class="text-sm font-semibold text-slate-500">
                            Mensagens públicas
                        </div>

                        <div class="mt-2 text-lg font-bold text-slate-900">
                            {{ $denuncia->comentarios->count() }}
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">
                    <div class="flex gap-3">
                        <div class="mt-0.5 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3.75m0 3.75h.008v.008H12V16.5Zm9-4.5a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-sm font-bold text-amber-900">
                                Informação
                            </h2>

                            <p class="mt-1 text-sm text-amber-800">
                                Esta tela exibe apenas informações públicas de acompanhamento. Comentários internos do
                                comitê não são exibidos aqui.
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between gap-4 mb-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">
                                Mensagens sobre sua denúncia
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Respostas e atualizações disponibilizadas pelo comitê responsável.
                            </p>
                        </div>
                    </div>

                    @if ($denuncia->comentarios->count())
                        <div class="space-y-4">
                            @foreach ($denuncia->comentarios as $comentario)
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                                    <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                                        {{ $comentario->created_at->format('d/m/Y H:i') }}
                                    </div>

                                    <div class="mt-3 whitespace-pre-line text-sm leading-6 text-slate-800">
                                        {{ $comentario->mensagem }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 text-center">
                            <div
                                class="mx-auto mb-3 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white border border-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 0 1-4-.8L3 20l1.2-3.6A7.7 7.7 0 0 1 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8Z" />
                                </svg>
                            </div>

                            <p class="text-sm font-semibold text-slate-800">
                                Ainda não há mensagens públicas para esta denúncia.
                            </p>

                            <p class="mt-1 text-sm text-slate-500">
                                Consulte novamente mais tarde para verificar novas atualizações.
                            </p>
                        </div>
                    @endif
                </div>

                <div
                    class="border-t border-slate-200 pt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <a href="{{ route('acompanhamento.form') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-red-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2">
                        Consultar outra denúncia
                    </a>

                    <a href="{{ route('denuncias.create') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Registrar nova denúncia
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
