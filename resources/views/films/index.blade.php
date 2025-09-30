<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎬 Meus Filmes
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Mensagens de sucesso -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Barra de filtros e ações -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <!-- Formulário de busca -->
                        <form method="GET" action="{{ route('films.index') }}" class="flex flex-col sm:flex-row gap-3">
                            <input type="text" 
                                   name="titulo" 
                                   value="{{ request('titulo') }}"
                                   placeholder="Buscar por título..." 
                                   class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            
                            <select name="status" class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Todos os status</option>
                                <option value="assistido" {{ request('status') === 'assistido' ? 'selected' : '' }}>Assistidos</option>
                                <option value="nao_assistido" {{ request('status') === 'nao_assistido' ? 'selected' : '' }}>Não Assistidos</option>
                            </select>
                            
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200">
                                🔍 Buscar
                            </button>
                            
                            @if(request()->hasAny(['titulo', 'status']))
                                <a href="{{ route('films.index') }}" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-50 transition duration-200">
                                    ✖️ Limpar
                                </a>
                            @endif
                        </form>

                        <!-- Botão adicionar filme -->
                        <a href="{{ route('films.create') }}" 
                           class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200 inline-flex items-center">
                            ➕ Adicionar Filme
                        </a>
                    </div>
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
                                <div class="text-2xl font-bold text-gray-900">{{ $films->total() }}</div>
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
                                <div class="text-2xl font-bold text-gray-900">{{ auth()->user()->filmesAssistidos()->count() }}</div>
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

            <!-- Lista de filmes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($films->count() > 0)
                        <div class="grid gap-4">
                            @foreach($films as $film)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-2">
                                                <h3 class="text-lg font-semibold text-gray-900">{{ $film->titulo }}</h3>
                                                @if($film->assistido)
                                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">✅ Assistido</span>
                                                @else
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">⏳ Não assistido</span>
                                                @endif
                                            </div>
                                            <p class="text-gray-600 mb-1"><strong>Diretor:</strong> {{ $film->diretor }}</p>
                                            <p class="text-gray-600 mb-1"><strong>Ano:</strong> {{ $film->ano }}</p>
                                            @if($film->avaliacao)
                                                <p class="text-gray-600"><strong>Avaliação:</strong> {{ $film->avaliacaoFormatada }}</p>
                                            @endif
                                        </div>
                                        
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('films.show', $film) }}" 
                                               class="bg-blue-100 text-blue-800 px-3 py-1 rounded text-sm hover:bg-blue-200 transition duration-200">
                                                👁️ Ver
                                            </a>
                                            <a href="{{ route('films.edit', $film) }}" 
                                               class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-sm hover:bg-yellow-200 transition duration-200">
                                                ✏️ Editar
                                            </a>
                                            <form method="POST" action="{{ route('films.toggle-watched', $film) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="bg-purple-100 text-purple-800 px-3 py-1 rounded text-sm hover:bg-purple-200 transition duration-200">
                                                    {{ $film->assistido ? '❌ Marcar como não assistido' : '✅ Marcar como assistido' }}
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('films.destroy', $film) }}" class="inline" 
                                                  onsubmit="return confirm('Tem certeza que deseja excluir este filme?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="bg-red-100 text-red-800 px-3 py-1 rounded text-sm hover:bg-red-200 transition duration-200">
                                                    🗑️ Excluir
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Paginação -->
                        <div class="mt-6">
                            {{ $films->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-6xl mb-4">🎬</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum filme encontrado</h3>
                            @if(request()->hasAny(['titulo', 'status']))
                                <p class="text-gray-600 mb-4">Tente ajustar os filtros ou fazer uma nova busca.</p>
                            @else
                                <p class="text-gray-600 mb-4">Comece adicionando seu primeiro filme!</p>
                            @endif
                            <a href="{{ route('films.create') }}" 
                               class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-200 inline-block">
                                ➕ Adicionar Primeiro Filme
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
