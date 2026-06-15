<x-guest-layout>
    <div class="max-w-xl mx-auto py-10">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-4">
                Acompanhar denúncia
            </h1>

            <p class="text-gray-600 mb-6">
                Informe o protocolo e a senha de acompanhamento recebidos no momento do registro.
            </p>

            @if ($errors->any())
                <div class="mb-6 rounded-md bg-red-50 p-4 text-red-700">
                    <strong>Verifique os campos abaixo:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('acompanhamento.show') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="protocolo" class="block font-medium text-sm text-gray-700">
                        Protocolo
                    </label>
                    <input type="text" name="protocolo" id="protocolo" value="{{ old('protocolo') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300" placeholder="Ex.: FRB-2026-000001">
                </div>

                <div>
                    <label for="senha_acompanhamento" class="block font-medium text-sm text-gray-700">
                        Senha de acompanhamento
                    </label>
                    <input type="text" name="senha_acompanhamento" id="senha_acompanhamento" required
                        class="mt-1 block w-full rounded-md border-gray-300">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Consultar denúncia
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
<x-guest-layout>
    <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">

            <aside class="lg:col-span-2">
                <div class="bg-red-950 text-white rounded-3xl p-6 shadow-sm">
                    <div
                        class="inline-flex items-center justify-center h-12 w-12 rounded-2xl bg-white/10 ring-1 ring-white/20 mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414A1 1 0 0 1 19 9.414V19a2 2 0 0 1-2 2Z" />
                        </svg>
                    </div>

                    <h1 class="text-2xl font-bold leading-tight">
                        Acompanhe sua denúncia
                    </h1>

                    <p class="mt-3 text-sm text-red-100 leading-6">
                        Informe o protocolo e a senha gerados no momento do registro para consultar o andamento da
                        denúncia.
                    </p>

                    <div class="mt-6 space-y-4 text-sm">
                        <div class="flex gap-3">
                            <div class="mt-1 h-2 w-2 rounded-full bg-amber-400"></div>
                            <p class="text-red-50">
                                O acompanhamento pode ser feito sem informar seus dados pessoais.
                            </p>
                        </div>

                        <div class="flex gap-3">
                            <div class="mt-1 h-2 w-2 rounded-full bg-amber-400"></div>
                            <p class="text-red-50">
                                A senha de acompanhamento só é exibida uma vez após o registro.
                            </p>
                        </div>

                        <div class="flex gap-3">
                            <div class="mt-1 h-2 w-2 rounded-full bg-amber-400"></div>
                            <p class="text-red-50">
                                Mensagens públicas do comitê aparecerão nesta área.
                            </p>
                        </div>
                    </div>
                </div>
            </aside>

            <section class="lg:col-span-3">
                <div class="mb-6">
                    <div
                        class="inline-flex items-center rounded-full bg-red-50 px-3 py-1 text-sm font-semibold text-red-800 ring-1 ring-inset ring-red-100">
                        Consulta segura
                    </div>

                    <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-900">
                        Consultar denúncia
                    </h2>

                    <p class="mt-3 text-slate-600">
                        Preencha os dados recebidos na tela de confirmação do registro.
                    </p>
                </div>

                <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-6 sm:p-8">
                    @if ($errors->any())
                        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5 text-red-800">
                            <strong>Verifique os campos abaixo:</strong>

                            <ul class="mt-2 list-disc list-inside space-y-1 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('acompanhamento.show') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="protocolo" class="block text-sm font-semibold text-slate-800">
                                Protocolo
                            </label>

                            <input type="text" name="protocolo" id="protocolo" value="{{ old('protocolo') }}"
                                required
                                class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 font-mono text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                placeholder="Ex.: FRB-2026-000001">
                        </div>

                        <div>
                            <label for="senha_acompanhamento" class="block text-sm font-semibold text-slate-800">
                                Senha de acompanhamento
                            </label>

                            <input type="text" name="senha_acompanhamento" id="senha_acompanhamento" required
                                class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 font-mono text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                placeholder="Digite a senha recebida">
                        </div>

                        <div class="pt-2 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <a href="{{ route('denuncias.create') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                                Registrar nova denúncia
                            </a>

                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-red-900 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2">
                                Consultar denúncia
                            </button>
                        </div>
                    </form>
                </div>
            </section>

        </div>
    </div>
</x-guest-layout>
