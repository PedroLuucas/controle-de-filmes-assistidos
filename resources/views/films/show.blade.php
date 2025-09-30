<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎬 {{ $film->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Mensagens de sucesso -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <!-- Cabeçalho com título e status -->
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between mb-8">
                        <div class="mb-4 lg:mb-0">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $film->titulo }}</h1>
                            <div class="flex items-center space-x-4">
                                @if($film->assistido)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        ✅ Assistido
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        ⏳ Não assistido
                                    </span>
                                @endif
                                
                                @if($film->avaliacao)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        ⭐ {{ $film->avaliacao }}/10
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Botões de ação -->
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('films.edit', $film) }}" 
                               class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition duration-200">
                                ✏️ Editar
                            </a>
                            
                            <form method="POST" action="{{ route('films.toggle-watched', $film) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-600 transition duration-200">
                                    {{ $film->assistido ? '❌ Marcar como não assistido' : '✅ Marcar como assistido' }}
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('films.destroy', $film) }}" class="inline" 
                                  onsubmit="return confirm('Tem certeza que deseja excluir este filme?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-200">
                                    🗑️ Excluir
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Informações do filme -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Detalhes principais -->
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">📋 Informações</h2>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <span class="font-medium text-gray-700 w-20">Diretor:</span>
                                    <span class="text-gray-900">{{ $film->diretor }}</span>
                                </div>
                                
                                <div class="flex items-center">
                                    <span class="font-medium text-gray-700 w-20">Ano:</span>
                                    <span class="text-gray-900">{{ $film->ano }}</span>
                                </div>
                                
                                <div class="flex items-center">
                                    <span class="font-medium text-gray-700 w-20">Status:</span>
                                    <span class="text-gray-900">
                                        {{ $film->assistido ? 'Assistido' : 'Não assistido' }}
                                    </span>
                                </div>
                                
                                @if($film->avaliacao)
                                    <div class="flex items-center">
                                        <span class="font-medium text-gray-700 w-20">Nota:</span>
                                        <span class="text-gray-900">{{ $film->avaliacaoFormatada }}</span>
                                    </div>
                                @endif
                                
                                <div class="flex items-center">
                                    <span class="font-medium text-gray-700 w-20">Adicionado:</span>
                                    <span class="text-gray-900">{{ $film->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                
                                @if($film->updated_at != $film->created_at)
                                    <div class="flex items-center">
                                        <span class="font-medium text-gray-700 w-20">Atualizado:</span>
                                        <span class="text-gray-900">{{ $film->updated_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Observações -->
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">💭 Observações</h2>
                            @if($film->observacoes)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-700 whitespace-pre-wrap">{{ $film->observacoes }}</p>
                                </div>
                            @else
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-500 italic">Nenhuma observação adicionada ainda.</p>
                                    <a href="{{ route('films.edit', $film) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm">
                                        Adicionar observações →
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Avaliação visual -->
                    @if($film->avaliacao)
                        <div class="mt-8">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">⭐ Avaliação</h2>
                            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-6">
                                <div class="flex items-center justify-center space-x-4">
                                    <div class="text-6xl font-bold text-gray-800">{{ $film->avaliacao }}</div>
                                    <div class="text-center">
                                        <div class="text-2xl mb-2">
                                            {{ str_repeat('⭐', (int)$film->avaliacao) }}
                                        </div>
                                        <div class="text-gray-600">de 10 estrelas</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Botão voltar -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('films.index') }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800">
                            ← Voltar para lista de filmes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
