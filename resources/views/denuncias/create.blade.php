<x-guest-layout>
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <aside class="lg:col-span-1">
                <div class="bg-red-950 text-white rounded-3xl p-6 shadow-sm sticky top-6">
                    <div class="mb-5">
                        <img src="{{ asset('images/logo-branca.png') }}" alt="Friobom Distribuidora"
                            class="h-12 w-auto">
                    </div>

                    <h1 class="text-2xl font-bold leading-tight">
                        Canal de Denúncias
                    </h1>

                    <p class="mt-3 text-sm text-red-100 leading-6">
                        Este é o canal oficial para relatar condutas inadequadas, irregularidades,
                        assédio, discriminação, fraude ou situações que contrariem os princípios da empresa.
                    </p>

                    <div class="mt-6 space-y-4 text-sm">
                        <div class="flex gap-3">
                            <div class="mt-1 h-2 w-2 rounded-full bg-amber-400"></div>
                            <p class="text-red-50">
                                Você pode registrar a denúncia de forma anônima.
                            </p>
                        </div>

                        <div class="flex gap-3">
                            <div class="mt-1 h-2 w-2 rounded-full bg-amber-400"></div>
                            <p class="text-red-50">
                                Ao final, será gerado um protocolo e uma senha de acompanhamento.
                            </p>
                        </div>

                        <div class="flex gap-3">
                            <div class="mt-1 h-2 w-2 rounded-full bg-amber-400"></div>
                            <p class="text-red-50">
                                Guarde essas informações para acompanhar o andamento.
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 rounded-2xl bg-white/10 p-4 ring-1 ring-white/15">
                        <p class="text-sm font-semibold text-white">
                            Já possui protocolo?
                        </p>

                        <a href="{{ route('acompanhamento.form') }}"
                            class="mt-3 inline-flex w-full items-center justify-center rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-red-950 hover:bg-red-50 transition">
                            Acompanhar denúncia
                        </a>
                    </div>
                </div>
            </aside>

            <section class="lg:col-span-2">
                <div class="mb-6">
                    <div
                        class="inline-flex items-center rounded-full bg-red-50 px-3 py-1 text-sm font-semibold text-red-800 ring-1 ring-inset ring-red-100">
                        Registro seguro
                    </div>

                    <h2 class="mt-4 text-3xl font-bold tracking-tight text-slate-900">
                        Registrar denúncia
                    </h2>

                    <p class="mt-3 text-slate-600">
                        Preencha as informações abaixo com o máximo de detalhes possível.
                        Campos marcados com <span class="font-semibold text-red-800">*</span> são obrigatórios.
                    </p>
                </div>

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

                <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-6 sm:p-8">
                    <form method="POST" action="{{ route('denuncias.store') }}" enctype="multipart/form-data"
                        class="space-y-8 js-confirm-public-denuncia">
                        @csrf

                        <div>
                            <h3 class="text-lg font-bold text-slate-900">
                                Informações da denúncia
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Informe o tipo da situação e descreva o ocorrido.
                            </p>
                        </div>

                        <div>
                            <label for="tipo" class="block text-sm font-semibold text-slate-800">
                                Tipo da denúncia <span class="text-red-800">*</span>
                            </label>

                            <select name="tipo" id="tipo" required
                                class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20">
                                <option value="">Selecione uma opção</option>
                                <option value="assedio_moral" @selected(old('tipo') === 'assedio_moral')>Assédio moral</option>
                                <option value="assedio_sexual" @selected(old('tipo') === 'assedio_sexual')>Assédio sexual</option>
                                <option value="discriminacao" @selected(old('tipo') === 'discriminacao')>Discriminação</option>
                                <option value="fraude" @selected(old('tipo') === 'fraude')>Fraude ou desvio</option>
                                <option value="conflito_interesses" @selected(old('tipo') === 'conflito_interesses')>Conflito de interesses
                                </option>
                                <option value="seguranca_trabalho" @selected(old('tipo') === 'seguranca_trabalho')>Segurança do trabalho
                                </option>
                                <option value="outros" @selected(old('tipo') === 'outros')>Outros</option>
                            </select>
                        </div>

                        <div>
                            <label for="descricao" class="block text-sm font-semibold text-slate-800">
                                Descrição do ocorrido <span class="text-red-800">*</span>
                            </label>

                            <textarea name="descricao" id="descricao" rows="7" required
                                class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                placeholder="Descreva o que aconteceu, quando ocorreu, onde ocorreu e quem estava envolvido.">{{ old('descricao') }}</textarea>
                            <div class="mt-2 flex items-center justify-between gap-3">
                                <p class="text-sm text-slate-500">
                                    Descreva com detalhes. Mínimo de <strong>20 caracteres</strong>.
                                </p>

                                <p id="contador-descricao" class="text-sm font-semibold text-slate-500">
                                    0/20
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="data_ocorrido" class="block text-sm font-semibold text-slate-800">
                                    Data aproximada do ocorrido
                                </label>

                                <input type="date" name="data_ocorrido" id="data_ocorrido"
                                    value="{{ old('data_ocorrido') }}"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20">
                            </div>

                            <div>
                                <label for="local" class="block text-sm font-semibold text-slate-800">
                                    Local ou setor
                                </label>

                                <input type="text" name="local" id="local" value="{{ old('local') }}"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                    placeholder="Ex.: estoque, financeiro, entrega...">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="envolvidos" class="block text-sm font-semibold text-slate-800">
                                    Pessoas envolvidas
                                </label>

                                <textarea name="envolvidos" id="envolvidos" rows="4"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                    placeholder="Informe nomes, cargos ou setores, se souber.">{{ old('envolvidos') }}</textarea>
                            </div>

                            <div>
                                <label for="testemunhas" class="block text-sm font-semibold text-slate-800">
                                    Testemunhas, se houver
                                </label>

                                <textarea name="testemunhas" id="testemunhas" rows="4"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                    placeholder="Informe possíveis testemunhas.">{{ old('testemunhas') }}</textarea>
                            </div>
                        </div>

                        <div class="border-t border-slate-200 pt-8">
                            <h3 class="text-lg font-bold text-slate-900">
                                Identificação
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Você pode se identificar ou manter a denúncia anônima.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">
                            <label class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <input type="checkbox" name="anonima" id="anonima" value="1"
                                    class="mt-1 h-4 w-4 rounded border-slate-300 text-red-900 focus:ring-red-800"
                                    @checked(old('anonima'))>

                                <span>
                                    <span class="block text-sm font-bold text-slate-900">
                                        Desejo permanecer anônimo
                                    </span>

                                    <span class="mt-1 block text-sm text-slate-600">
                                        Seus dados de identificação não serão exigidos. O acompanhamento será feito pelo
                                        protocolo e senha.
                                    </span>
                                </span>
                            </label>
                        </div>

                        <div id="aviso-anonima"
                            class="hidden rounded-2xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-900">
                            <strong>Denúncia anônima selecionada.</strong>
                            Os campos de nome, e-mail e telefone foram ocultados. Guarde o protocolo e a senha gerados
                            após o envio para acompanhar a denúncia.
                        </div>

                        <div id="campos-identificacao" class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div>
                                <label for="nome" class="block text-sm font-semibold text-slate-800">
                                    Nome
                                </label>

                                <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                    placeholder="Opcional">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-800">
                                    E-mail
                                </label>

                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                    placeholder="Opcional">
                            </div>

                            <div>
                                <label for="telefone" class="block text-sm font-semibold text-slate-800">
                                    Telefone
                                </label>

                                <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}"
                                    class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                    placeholder="Opcional">
                            </div>
                        </div>

                        <div class="border-t border-slate-200 pt-8">
                            <h3 class="text-lg font-bold text-slate-900">
                                Anexos
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Envie prints, fotos ou documentos que possam ajudar na apuração.
                            </p>
                        </div>

                        <div>
                            <label for="anexos" class="block text-sm font-semibold text-slate-800">
                                Arquivos
                            </label>

                            <input type="file" name="anexos[]" id="anexos" multiple
                                class="mt-2 block w-full rounded-xl border border-dashed border-slate-300 bg-slate-50 px-4 py-4 text-sm text-slate-700 file:mr-4 file:rounded-lg file:border-0 file:bg-red-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-red-950"
                                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">

                            <p class="mt-2 text-sm text-slate-500">
                                Formatos permitidos: JPG, PNG, PDF, DOC e DOCX. Máximo de 5 arquivos, até 5 MB cada.
                            </p>

                            <div id="info-anexos"
                                class="mt-3 hidden rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-700">
                                Nenhum arquivo selecionado.
                            </div>

                            @error('anexos')
                                <p class="mt-2 text-sm text-red-700">
                                    {{ $message }}
                                </p>
                            @enderror

                            @error('anexos.*')
                                <p class="mt-2 text-sm text-red-700">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div
                            class="border-t border-slate-200 pt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <p class="text-sm text-slate-500">
                                Após o envio, será exibido um protocolo e uma senha de acompanhamento.
                            </p>

                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-red-900 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2">
                                Enviar denúncia
                            </button>
                        </div>
                    </form>
                </div>
            </section>

        </div>
    </div>
</x-guest-layout>
