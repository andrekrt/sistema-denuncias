<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Canal de Denúncias Friobom') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <script>
        window.flashMessages = {
            success: @json(session('success')),
            error: @json(session('error')),
            status: @json(session('status')),
            validationError: @json($errors->first()),
        };
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-900">
    <div class="min-h-screen flex flex-col">

        <header class="bg-gradient-to-r from-red-950 via-red-900 to-red-800 text-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="h-20 flex items-center justify-between">
                    <a href="{{ route('denuncias.create') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-branca.png') }}" alt="Friobom Distribuidora"
                            class="h-10 w-auto">

                        <div>
                            <div class="text-base font-bold leading-tight">
                                Friobom Distribuidora
                            </div>
                            <div class="text-sm text-red-100 leading-tight">
                                Canal de Denúncias
                            </div>
                        </div>
                    </a>

                    <nav class="hidden md:flex items-center gap-2 text-sm font-medium">
                        <a href="{{ route('denuncias.create') }}"
                            class="px-4 py-2 rounded-xl text-red-50 hover:bg-white/10 transition">
                            Registrar denúncia
                        </a>

                        <a href="{{ route('acompanhamento.form') }}"
                            class="px-4 py-2 rounded-xl text-red-50 hover:bg-white/10 transition">
                            Acompanhar denúncia
                        </a>

                        <a href="{{ route('login') }}"
                            class="ml-2 px-4 py-2 rounded-xl bg-white text-red-900 hover:bg-red-50 transition shadow-sm">
                            Área restrita
                        </a>
                    </nav>

                    <div class="md:hidden">
                        <a href="{{ route('login') }}"
                            class="px-3 py-2 rounded-xl bg-white text-red-900 text-sm font-semibold">
                            Entrar
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                {{ $slot }}
            </div>
        </main>

        <footer class="bg-white border-t border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 text-sm text-slate-500">
                    <p>
                        © {{ date('Y') }} Friobom Distribuidora. Todos os direitos reservados.
                    </p>

                    <p>
                        Canal seguro para registro e acompanhamento de denúncias.
                    </p>
                </div>
            </div>
        </footer>

    </div>

</body>

</html>
