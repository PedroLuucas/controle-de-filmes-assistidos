<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center gap-2">
            🎬 <span>Meus Filmes</span>
        </h2>
    </x-slot>

    <div class="py-10 mt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Mensagem de sucesso -->
            @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded shadow-sm">
                ✅ {{ session('success') }}
            </div>
            @endif

            <!-- Pesquisa e Filtros -->
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">🔍 Pesquisar e Filtrar</h3>
                <form method="GET" action="{{ route('films.index') }}" class="space-y-4">
                    <div class="flex flex-wrap gap-4">
                        <div class="flex-1 max-w-xs">
                            <label for="titulo" class="text-sm font-medium text-gray-700">Título</label>
                            <input type="text" id="titulo" name="titulo"
                                value="{{ request('titulo') }}"
                                placeholder="Digite o título..."
                                class="w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="w-40">
                            <label for="status" class="text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status"
                                class="w-full mt-1 rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Todos</option>
                                <option value="assistido" {{ request('status') === 'assistido' ? 'selected' : '' }}>Assistidos</option>
                                <option value="nao_assistido" {{ request('status') === 'nao_assistido' ? 'selected' : '' }}>Não Assistidos</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="submit"
                            class="bg-blue-600 text-gray-800 px-6 py-2 rounded-lg hover:bg-blue-700 transition shadow-md">
                            🔍 Buscar
                        </button>
                        @if(request()->hasAny(['titulo', 'status']))
                        <a href="{{ route('films.index') }}"
                            class="bg-gray-500 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-600 transition shadow-md">
                            ✖️ Limpar
                        </a>
                        @endif
                    </div>
                </form>
            </div>


            <!-- Lista de Filmes -->
            <div class="bg-white shadow-md rounded-xl p-6 mt-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        📋 Lista de Filmes
                        @if($films->count() > 0)
                        <span class="text-sm text-gray-500 font-normal">
                            (Mostrando {{ $films->firstItem() }} a {{ $films->lastItem() }} de {{ $films->total() }})
                        </span>
                        @endif
                    </h3>

                    <!-- Botão Adicionar dentro do card -->
                    <a href="{{ route('films.create') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition shadow-sm inline-flex items-center gap-2 text-sm">
                        ➕ Adicionar Filme
                    </a>
                </div>

                @if($films->count() > 0)
                <div class="space-y-4">
                    @foreach($films as $film)
                    <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition flex flex-col lg:flex-row justify-between gap-4">
                        <!-- Info -->
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="text-xl font-semibold text-gray-900">{{ $film->titulo }}</h4>
                                <span class="px-3 py-1 rounded-full text-sm font-medium
                                            {{ $film->assistido ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $film->assistido ? '✅ Assistido' : '⏳ Não Assistido' }}
                                </span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 text-sm text-gray-600">
                                <div><span class="font-medium">🎬 Diretor:</span> {{ $film->diretor }}</div>
                                <div><span class="font-medium">📅 Ano:</span> {{ $film->ano }}</div>
                                <div>
                                    @if($film->avaliacao)
                                    <span class="font-medium">⭐ Avaliação:</span>
                                    <span class="text-yellow-500">{{ str_repeat('⭐', min(5, (int)$film->avaliacao)) }}</span>
                                    <span class="text-gray-600">({{ $film->avaliacao }}/10)</span>
                                    @else
                                    <span class="text-gray-400 italic">Sem avaliação</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Ações -->
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('films.show', $film) }}"
                                class="bg-blue-100 text-blue-700 px-3 py-2 rounded-lg text-sm hover:bg-blue-200 transition">👁️ Ver</a>
                            <a href="{{ route('films.edit', $film) }}"
                                class="bg-yellow-100 text-yellow-700 px-3 py-2 rounded-lg text-sm hover:bg-yellow-200 transition">✏️ Editar</a>
                            <form method="POST" action="{{ route('films.toggle-watched', $film) }}">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    class="bg-purple-100 text-purple-700 px-3 py-2 rounded-lg text-sm hover:bg-purple-200 transition">
                                    {{ $film->assistido ? '❌ Desmarcar' : '✅ Marcar' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('films.destroy', $film) }}"
                                onsubmit="return confirm('Excluir este filme?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="bg-red-100 text-red-700 px-3 py-2 rounded-lg text-sm hover:bg-red-200 transition">🗑️ Excluir</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Paginação -->
                <div class="mt-6">
                    {{ $films->appends(request()->query())->links() }}
                </div>
                @else
                <!-- Estado vazio -->
                <div class="text-center py-16">
                    <div class="text-7xl mb-4">🎬</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">
                        Nenhum filme encontrado
                    </h3>
                    <p class="text-gray-600 mb-6">
                        @if(request()->hasAny(['titulo', 'status']))
                        Ajuste os filtros ou adicione um novo filme.
                        @else
                        Adicione seu primeiro filme à coleção!
                        @endif
                    </p>
                    <a href="{{ route('films.create') }}"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition shadow-md inline-flex items-center gap-2">
                        ➕ Adicionar Filme
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>