<x-guest-layout>
    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <div class="flex justify-center">
                <img
                    src="{{ asset('images/logo-friobom.png') }}"
                    alt="Friobom Distribuidora"
                    class="h-16 w-auto"
                >
            </div>

            <h1 class="mt-6 text-2xl font-bold text-slate-900">
                Criar nova senha
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Informe sua nova senha para acessar o painel administrativo.
            </p>
        </div>

        <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-6 sm:p-8">
            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-800">
                        E-mail
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $request->email) }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                    >

                    @error('email')
                        <p class="mt-2 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-800">
                        Nova senha
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                        placeholder="Mínimo de 8 caracteres"
                    >

                    @error('password')
                        <p class="mt-2 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-800">
                        Confirmar nova senha
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                        placeholder="Repita a nova senha"
                    >

                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="w-full inline-flex items-center justify-center rounded-xl bg-red-900 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2"
                >
                    Redefinir senha
                </button>
            </form>

            <div class="mt-6 text-center">
                <a
                    href="{{ route('login') }}"
                    class="text-sm font-semibold text-red-900 hover:text-red-950"
                >
                    Voltar para o login
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
