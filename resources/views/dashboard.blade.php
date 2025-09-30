<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎬 Meus Filmes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Bem-vindo -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-2">Bem-vindo ao seu controle de filmes!</h3>
                    <p class="text-gray-600">
                        Aqui você pode gerenciar todos os filmes que já assistiu, adicionar novos e fazer suas avaliações.
                    </p>
                </div>
            </div>

            <!-- Estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">🎬</div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Total de Filmes</div>
                                <div class="text-2xl font-bold text-gray-900">0</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">✅</div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Assistidos</div>
                                <div class="text-2xl font-bold text-gray-900">0</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">⭐</div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Avaliação Média</div>
                                <div class="text-2xl font-bold text-gray-900">-</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ações Rápidas -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4">Ações Rápidas</h3>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200">
                            ➕ Adicionar Filme
                        </button>
                        <button class="border border-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-50 transition duration-200">
                            📋 Ver Todos os Filmes
                        </button>
                    </div>
                </div>
            </div>

            <!-- Lista de Filmes Recentes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4">Filmes Recentes</h3>
                    <div class="text-center py-8 text-gray-500">
                        <div class="text-6xl mb-4">🎬</div>
                        <p>Nenhum filme cadastrado ainda.</p>
                        <p class="text-sm mt-2">Comece adicionando seu primeiro filme!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
