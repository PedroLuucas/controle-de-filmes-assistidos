<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎬 {{ $film->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div class="bg-white border border-yellow-200 rounded-xl p-6 shadow-sm space-y-3">
                    <h2 class="text-lg font-semibold text-yellow-800 mb-4">📋 Informações</h2>

                    <div class="space-y-2">
                        <div class="flex items-center">
                            <span class="font-medium text-yellow-900 w-28">Diretor:</span>
                            <span class="text-yellow-800 break-words">{{ $film->diretor }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-medium text-yellow-900 w-28">Ano:</span>
                            <span class="text-yellow-800">{{ $film->ano }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-medium text-yellow-900 w-28">Status:</span>
                            <span class="text-yellow-800">{{ $film->assistido ? '✅ Assistido' : '⏳ Não assistido' }}</span>
                        </div>
                        @if($film->avaliacao)
                        <div class="flex items-center">
                            <span class="font-medium text-yellow-900 w-28">Nota:</span>
                            <span class="text-yellow-800">
                                <span class="text-yellow-500">{{ str_repeat('⭐', (int)$film->avaliacao) }}</span> {{ $film->avaliacao }}/10
                            </span>
                        </div>
                        @endif
                        <div class="flex items-center">
                            <span class="font-medium text-yellow-900 w-28">Adicionado:</span>
                            <span class="text-yellow-800">{{ $film->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        @if($film->updated_at != $film->created_at)
                        <div class="flex items-center">
                            <span class="font-medium text-yellow-900 w-28">Atualizado:</span>
                            <span class="text-yellow-800">{{ $film->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white border border-blue-200 rounded-xl p-6 shadow-sm space-y-4">
                    <h2 class="text-lg font-semibold text-blue-800 mb-2">💭 Observações</h2>
                    @if($film->observacoes)
                    <p class="text-blue-900 whitespace-pre-wrap break-words">{{ $film->observacoes }}</p>
                    @else
                    <p class="text-blue-600 italic mb-2">Nenhuma observação adicionada ainda.</p>
                    <a href="{{ route('films.edit', $film) }}"
                        class="text-blue-700 hover:text-blue-900 font-medium text-sm">
                        Adicionar observações →
                    </a>
                    @endif
                </div>

                <div class="mt-6">
                    <a href="{{ route('films.index') }}"
                        class="bg-blue-500 text-gray-800 px-6 py-2 rounded-lg hover:bg-blue-600 transition shadow-md inline-flex items-center">
                        ← Voltar para Meus Filmes
                    </a>
                </div>


            </div>
        </div>

    </div>
</x-app-layout>