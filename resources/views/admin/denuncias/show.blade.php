<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    Denúncia {{ $denuncia->protocolo }}
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Detalhes, acompanhamento, mensagens, anexos e histórico da denúncia.
                </p>
            </div>

            <a href="{{ route('admin.denuncias.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                Voltar para listagem
            </a>
        </div>
    </x-slot>

    @php
        $statusLabel = $denuncia->statusLabel();
        $statusClasses = $denuncia->statusClasses();
        $tipoLabel = $denuncia->tipoLabel();
    @endphp

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <aside class="lg:col-span-1 space-y-6">
                    <div class="rounded-3xl bg-red-950 p-6 text-white shadow-sm">
                        <div class="text-xs uppercase tracking-wide text-red-100">
                            Protocolo
                        </div>

                        <div class="mt-2 font-mono text-2xl font-bold break-all">
                            {{ $denuncia->protocolo }}
                        </div>

                        <div class="mt-5 flex flex-wrap gap-2">
                            <span
                                class="inline-flex items-center rounded-full bg-white px-3 py-1 text-xs font-bold text-red-950">
                                {{ $tipoLabel }}
                            </span>

                            <span
                                class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold ring-1 ring-inset {{ $statusClasses }}">
                                {{ $denuncia->statusLabel() }}
                            </span>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3 text-sm">
                            <div class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/15">
                                <div class="text-xs text-red-100">
                                    Registro
                                </div>

                                <div class="mt-1 font-semibold text-white">
                                    {{ $denuncia->created_at->format('d/m/Y') }}
                                </div>

                                <div class="text-xs text-red-100">
                                    {{ $denuncia->created_at->format('H:i') }}
                                </div>
                            </div>

                            <div class="rounded-2xl bg-white/10 p-4 ring-1 ring-white/15">
                                <div class="text-xs text-red-100">
                                    Identificação
                                </div>

                                <div class="mt-1 font-semibold text-white">
                                    {{ $denuncia->anonima ? 'Anônima' : 'Identificada' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (auth()->user()->podeAtuarEmDenuncias())
                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-lg font-bold text-slate-900">
                                Alterar status
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Atualize o andamento da denúncia.
                            </p>

                            <form method="POST" action="{{ route('admin.denuncias.update-status', $denuncia) }}"
                                class="mt-5 space-y-4 js-confirm-status">
                                @csrf
                                @method('PATCH')

                                <div>
                                    <label for="status" class="block text-sm font-semibold text-slate-800">
                                        Status da denúncia
                                    </label>

                                    <select name="status" id="status"
                                        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                        required>
                                        <option value="recebida" @selected($denuncia->status === 'recebida')>
                                            Recebida
                                        </option>

                                        <option value="em_analise" @selected($denuncia->status === 'em_analise')>
                                            Em análise
                                        </option>

                                        <option value="em_apuracao" @selected($denuncia->status === 'em_apuracao')>
                                            Em apuração
                                        </option>

                                        <option value="aguardando_informacoes" @selected($denuncia->status === 'aguardando_informacoes')>
                                            Aguardando informações
                                        </option>

                                        <option value="concluida" @selected($denuncia->status === 'concluida')>
                                            Concluída
                                        </option>

                                        <option value="arquivada" @selected($denuncia->status === 'arquivada')>
                                            Arquivada
                                        </option>
                                    </select>

                                    @error('status')
                                        <p class="mt-2 text-sm text-red-700">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center rounded-xl bg-red-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2">
                                    Salvar status
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-lg font-bold text-slate-900">
                                Status da denúncia
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Seu perfil permite apenas visualizar as informações da denúncia.
                            </p>

                            <div class="mt-5">
                                <span
                                    class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold ring-1 ring-inset {{ $statusClasses }}">
                                    {{ $denuncia->statusLabel() }}
                                </span>
                            </div>
                        </div>
                    @endif

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900">
                            Anexos
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Arquivos enviados pelo denunciante.
                        </p>

                        <div class="mt-5">
                            @if ($denuncia->anexos->count())
                                <div class="space-y-3">
                                    @foreach ($denuncia->anexos as $anexo)
                                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                            <div class="text-sm font-bold text-slate-900 break-all">
                                                {{ $anexo->nome_original }}
                                            </div>

                                            <div class="mt-1 text-xs text-slate-500">
                                                {{ $anexo->mime_type ?: 'Tipo desconhecido' }}

                                                @if ($anexo->tamanho)
                                                    · {{ number_format($anexo->tamanho / 1024, 1, ',', '.') }} KB
                                                @endif
                                            </div>

                                            <a href="{{ route('admin.anexos.download', $anexo) }}"
                                                class="mt-3 inline-flex w-full items-center justify-center rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                                                Baixar anexo
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 text-sm text-slate-600">
                                    Nenhum anexo enviado.
                                </div>
                            @endif
                        </div>
                    </div>
                </aside>

                <section class="lg:col-span-2 space-y-6">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">
                                    Informações gerais
                                </h3>

                                <p class="mt-1 text-sm text-slate-500">
                                    Dados principais informados no registro da denúncia.
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4">
                                <div class="text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Tipo
                                </div>

                                <div class="mt-1 font-semibold text-slate-900">
                                    {{ $tipoLabel }}
                                </div>
                            </div>

                            <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4">
                                <div class="text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Prioridade
                                </div>

                                <div class="mt-1 font-semibold text-slate-900">
                                    {{ ucfirst($denuncia->prioridade) }}
                                </div>
                            </div>

                            <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4">
                                <div class="text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Data do ocorrido
                                </div>

                                <div class="mt-1 font-semibold text-slate-900">
                                    {{ $denuncia->data_ocorrido ? $denuncia->data_ocorrido->format('d/m/Y') : 'Não informada' }}
                                </div>
                            </div>

                            <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4">
                                <div class="text-xs font-bold uppercase tracking-wide text-slate-500">
                                    Local ou setor
                                </div>

                                <div class="mt-1 font-semibold text-slate-900">
                                    {{ $denuncia->local ?: 'Não informado' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (!$denuncia->anonima)
                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-lg font-bold text-slate-900">
                                Identificação do denunciante
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Dados informados voluntariamente pelo denunciante.
                            </p>

                            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4">
                                    <div class="text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Nome
                                    </div>

                                    <div class="mt-1 font-semibold text-slate-900">
                                        {{ $denuncia->nome ?: 'Não informado' }}
                                    </div>
                                </div>

                                <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4">
                                    <div class="text-xs font-bold uppercase tracking-wide text-slate-500">
                                        E-mail
                                    </div>

                                    <div class="mt-1 font-semibold text-slate-900 break-all">
                                        {{ $denuncia->email ?: 'Não informado' }}
                                    </div>
                                </div>

                                <div class="rounded-2xl bg-slate-50 border border-slate-200 p-4">
                                    <div class="text-xs font-bold uppercase tracking-wide text-slate-500">
                                        Telefone
                                    </div>

                                    <div class="mt-1 font-semibold text-slate-900">
                                        {{ $denuncia->telefone ?: 'Não informado' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900">
                            Descrição do ocorrido
                        </h3>

                        <div
                            class="mt-4 rounded-2xl bg-slate-50 border border-slate-200 p-5 whitespace-pre-line text-sm leading-6 text-slate-800">
                            {{ $denuncia->descricao }}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-lg font-bold text-slate-900">
                                Pessoas envolvidas
                            </h3>

                            <div
                                class="mt-4 rounded-2xl bg-slate-50 border border-slate-200 p-5 whitespace-pre-line text-sm leading-6 text-slate-800">
                                {{ $denuncia->envolvidos ?: 'Não informado' }}
                            </div>
                        </div>

                        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-lg font-bold text-slate-900">
                                Testemunhas
                            </h3>

                            <div
                                class="mt-4 rounded-2xl bg-slate-50 border border-slate-200 p-5 whitespace-pre-line text-sm leading-6 text-slate-800">
                                {{ $denuncia->testemunhas ?: 'Não informado' }}
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900">
                            Comentários e mensagens
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Registre comentários internos ou envie mensagens visíveis ao denunciante.
                        </p>

                        <div class="mt-6">
                            @if ($denuncia->comentarios->count())
                                <div class="space-y-4">
                                    @foreach ($denuncia->comentarios->sortByDesc('created_at') as $comentario)
                                        <div
                                            class="rounded-2xl border p-5 {{ $comentario->visivel_denunciante ? 'border-amber-200 bg-amber-50' : 'border-slate-200 bg-slate-50' }}">
                                            <div
                                                class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                                <div class="text-sm text-slate-700">
                                                    <strong>{{ $comentario->usuario->name ?? 'Usuário' }}</strong>
                                                    em {{ $comentario->created_at->format('d/m/Y H:i') }}
                                                </div>

                                                @if ($comentario->visivel_denunciante)
                                                    <span
                                                        class="inline-flex w-fit items-center rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-800 ring-1 ring-inset ring-amber-200">
                                                        Visível ao denunciante
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex w-fit items-center rounded-full bg-slate-200 px-2.5 py-1 text-xs font-bold text-slate-700 ring-1 ring-inset ring-slate-300">
                                                        Interno
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="mt-3 whitespace-pre-line text-sm leading-6 text-slate-800">
                                                {{ $comentario->mensagem }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div
                                    class="rounded-2xl border border-slate-200 bg-slate-50 p-5 text-sm text-slate-600">
                                    Nenhum comentário ou mensagem registrado até o momento.
                                </div>
                            @endif
                        </div>

                        @if (auth()->user()->podeAtuarEmDenuncias())
                            <form method="POST" action="{{ route('admin.denuncias.comentarios.store', $denuncia) }}"
                                class="mt-6 space-y-4 js-confirm-visible-message">
                                @csrf

                                <div>
                                    <label for="mensagem" class="block text-sm font-semibold text-slate-800">
                                        Nova mensagem ou comentário
                                    </label>

                                    <textarea name="mensagem" id="mensagem" rows="4"
                                        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                                        placeholder="Digite aqui o comentário interno ou mensagem ao denunciante." required>{{ old('mensagem') }}</textarea>

                                    @error('mensagem')
                                        <p class="mt-2 text-sm text-red-700">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <label
                                    class="flex items-start gap-3 rounded-2xl border border-amber-200 bg-amber-50 p-4">
                                    <input type="checkbox" name="visivel_denunciante" value="1"
                                        class="mt-1 h-4 w-4 rounded border-amber-300 text-red-900 focus:ring-red-800"
                                        @checked(old('visivel_denunciante'))>

                                    <span>
                                        <span class="block text-sm font-bold text-slate-900">
                                            Tornar visível ao denunciante
                                        </span>

                                        <span class="mt-1 block text-sm text-slate-600">
                                            Se marcado, esta mensagem aparecerá na tela pública de acompanhamento.
                                        </span>
                                    </span>
                                </label>

                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="inline-flex items-center justify-center rounded-xl bg-red-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2">
                                        Adicionar
                                    </button>
                                </div>
                            </form>
                        @else
                            <div
                                class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-5 text-sm text-slate-600">
                                Seu perfil permite apenas visualizar os comentários e mensagens desta denúncia.
                            </div>
                        @endif
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900">
                            Histórico de ações
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Registro de auditoria das ações administrativas.
                        </p>

                        <div class="mt-6">
                            @if ($denuncia->logs->count())
                                <div class="space-y-3">
                                    @foreach ($denuncia->logs->sortByDesc('created_at') as $log)
                                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                            <div class="text-sm text-slate-800">
                                                <strong>{{ $log->usuario->name ?? 'Usuário não identificado' }}</strong>
                                                — {{ str_replace('_', ' ', ucfirst($log->acao)) }}
                                            </div>

                                            @if ($log->descricao)
                                                <div class="mt-1 text-sm text-slate-600">
                                                    {{ $log->descricao }}
                                                </div>
                                            @endif

                                            <div class="mt-2 text-xs text-slate-500">
                                                {{ $log->created_at->format('d/m/Y H:i') }}

                                                @if ($log->ip)
                                                    · IP: {{ $log->ip }}
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div
                                    class="rounded-2xl border border-slate-200 bg-slate-50 p-5 text-sm text-slate-600">
                                    Nenhuma ação registrada até o momento.
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
</x-app-layout>
