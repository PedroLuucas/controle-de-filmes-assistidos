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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 lg:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">🎬</div>
                            </div>
                            <div class="ml-4 min-w-0 flex-1">
                                <div class="text-sm font-medium text-gray-500 truncate">Total de Filmes</div>
                                <div class="text-2xl font-bold text-gray-900">{{ auth()->user()->films()->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 lg:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">✅</div>
                            </div>
                            <div class="ml-4 min-w-0 flex-1">
                                <div class="text-sm font-medium text-gray-500 truncate">Assistidos</div>
                                <div class="text-2xl font-bold text-gray-900">{{ auth()->user()->filmesAssistidos()->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:col-span-2 lg:col-span-1">
                    <div class="p-4 lg:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="text-2xl">⭐</div>
                            </div>
                            <div class="ml-4 min-w-0 flex-1">
                                <div class="text-sm font-medium text-gray-500 truncate">Avaliação Média</div>
                                <div class="text-2xl font-bold text-gray-900">
                                    @php
                                        $avg = auth()->user()->films()->whereNotNull('avaliacao')->avg('avaliacao');
                                        echo $avg ? number_format($avg, 1) : '-';
                                    @endphp
                                </div>
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
                        <a href="{{ route('films.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200">
                            ➕ Adicionar Filme
                        </a>
                        <a href="{{ route('films.index') }}" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-50 transition duration-200">
                            📋 Ver Todos os Filmes
                        </a>
                    </div>
                </div>
            </div>

            <!-- Lista de Filmes Recentes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4">Filmes Recentes</h3>
                    @php
                        $filmesRecentes = auth()->user()->films()->latest()->take(5)->get();
                    @endphp
                    
                    @if($filmesRecentes->count() > 0)
                        <div class="space-y-3">
                            @foreach($filmesRecentes as $filme)
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-3 border border-gray-200 rounded-lg gap-3">
                                    <div class="min-w-0 flex-1">
                                        <h4 class="font-medium text-gray-900 truncate">{{ $filme->titulo }}</h4>
                                        <p class="text-sm text-gray-600 truncate">{{ $filme->diretor }} • {{ $filme->ano }}</p>
                                        <div class="mt-1">
                                            @if($filme->assistido)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-100 text-green-800">
                                                    ✅ Assistido
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-800">
                                                    ⏳ Não assistido
                                                </span>
                                            @endif
                                            @if($filme->avaliacao)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-800 ml-1">
                                                    ⭐ {{ $filme->avaliacao }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('films.show', $filme) }}" 
                                           class="text-blue-600 hover:text-blue-800 text-sm whitespace-nowrap">
                                            Ver detalhes →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('films.index') }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm">
                                Ver todos os filmes →
                            </a>
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <div class="text-6xl mb-4">🎬</div>
                            <p>Nenhum filme cadastrado ainda.</p>
                            <p class="text-sm mt-2">Comece adicionando seu primeiro filme!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
