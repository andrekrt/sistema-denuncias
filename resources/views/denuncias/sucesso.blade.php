<x-guest-layout>
    <div class="max-w-3xl mx-auto">
        <div class="bg-white border border-slate-200 shadow-sm rounded-3xl overflow-hidden">

            <div class="bg-red-950 px-6 sm:px-8 py-8 text-white">
                <div
                    class="inline-flex items-center justify-center h-14 w-14 rounded-2xl bg-white/10 ring-1 ring-white/20 mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-300" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>

                <h1 class="text-3xl font-bold tracking-tight">
                    Denúncia registrada com sucesso
                </h1>

                <p class="mt-3 text-red-100">
                    Guarde o protocolo e a senha abaixo. Eles serão necessários para acompanhar o andamento da denúncia.
                </p>
            </div>

            <div class="p-6 sm:p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <div class="text-sm font-semibold text-slate-500">
                            Protocolo
                        </div>

                        <div class="mt-2 font-mono text-xl font-bold text-slate-900 break-all">
                            {{ $denuncia->protocolo }}
                        </div>
                    </div>

                    <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">
                        <div class="text-sm font-semibold text-amber-700">
                            Senha de acompanhamento
                        </div>

                        <div class="mt-2 font-mono text-xl font-bold text-slate-900 break-all">
                            {{ $senhaAcompanhamento }}
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-red-200 bg-red-50 p-5">
                    <div class="flex gap-3">
                        <div class="mt-0.5 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-800" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3.75m0 3.75h.008v.008H12V16.5Zm9-4.5a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="text-sm font-bold text-red-900">
                                Atenção
                            </h2>

                            <p class="mt-1 text-sm text-red-800">
                                Por segurança, esta senha não será exibida novamente. Anote ou salve essas informações
                                em local seguro.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5">
                    <h2 class="text-base font-bold text-slate-900">
                        Próximo passo
                    </h2>

                    <p class="mt-2 text-sm text-slate-600">
                        Use o protocolo e a senha de acompanhamento para consultar o status da denúncia e visualizar
                        mensagens públicas do comitê responsável.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-2">
                    <a href="{{ route('acompanhamento.form') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-red-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2">
                        Acompanhar denúncia
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
