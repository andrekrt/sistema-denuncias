<x-guest-layout>
    <div class="max-w-md mx-auto">
        <div class="text-center mb-8">
            <div class="flex justify-center">
                <img src="{{ asset('images/logo-friobom.png') }}" alt="Friobom Distribuidora" class="h-16 w-auto">
            </div>

            <h1 class="mt-6 text-2xl font-bold text-slate-900">
                Recuperar senha
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Informe seu e-mail para receber o link de redefinição de senha.
            </p>
        </div>

        <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-6 sm:p-8">
            <div class="mb-6 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-900">
                Enviaremos um link para que você possa criar uma nova senha de acesso ao painel.
            </div>

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-800">
                        E-mail
                    </label>

                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-2 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm focus:border-red-800 focus:outline-none focus:ring-2 focus:ring-red-800/20"
                        placeholder="seuemail@exemplo.com">

                    @error('email')
                        <p class="mt-2 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full inline-flex items-center justify-center rounded-xl bg-red-900 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-800 focus:ring-offset-2">
                    Enviar link de recuperação
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-red-900 hover:text-red-950">
                    Voltar para o login
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
