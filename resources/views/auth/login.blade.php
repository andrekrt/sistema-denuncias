<x-guest-layout>
    <div class="max-w-md mx-auto">
        <div class="mb-8 text-center">

            <div class="text-center">
                <div class="flex justify-center">
                    <img src="{{ asset('images/logo-friobom.png') }}" alt="Friobom Distribuidora" class="h-16 w-auto">
                </div>

                <h1 class="mt-6 text-2xl font-bold text-slate-900">
                    Área restrita
                </h1>

                <p class="mt-2 text-sm text-slate-500">
                    Acesse o painel administrativo do Canal de Denúncias.
                </p>
            </div>
        </div>

        <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-6 sm:p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-800">
                        E-mail
                    </label>

                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        autocomplete="username"
                        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                        placeholder="seuemail@empresa.com.br">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-800">
                        Senha
                    </label>

                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                        placeholder="Digite sua senha">
                </div>

                <div class="flex items-center justify-between gap-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="h-4 w-4 rounded border-slate-300 bg-white text-red-900 focus:ring-red-800">

                        <span class="ml-2 text-sm text-slate-700">
                            Lembrar acesso
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm font-semibold text-red-900 hover:text-red-950">
                            Esqueci minha senha
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full inline-flex items-center justify-center rounded-xl bg-red-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2">
                    Entrar no painel
                </button>
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('denuncias.create') }}" class="text-sm font-semibold text-slate-700 hover:text-red-900">
                Voltar ao Canal de Denúncias
            </a>
        </div>
    </div>
</x-guest-layout>
