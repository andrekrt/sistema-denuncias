<x-guest-layout>
    <div class="max-w-xl mx-auto py-10">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-4">
                Muitas tentativas
            </h1>

            <p class="text-gray-700 mb-4">
                Recebemos muitas tentativas de envio em pouco tempo.
            </p>

            <p class="text-gray-600 mb-6">
                Aguarde alguns minutos e tente novamente.
            </p>

            <a href="{{ route('denuncias.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Voltar ao formulário
            </a>
        </div>
    </div>
</x-guest-layout>
