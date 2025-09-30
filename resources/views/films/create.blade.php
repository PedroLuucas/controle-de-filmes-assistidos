<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Adicionar Novo Filme
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('films.store') }}">
                        @csrf
                        
                        <!-- Título -->
                        <div class="mb-4">
                            <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">
                                Título do Filme *
                            </label>
                            <input type="text" 
                                   id="titulo" 
                                   name="titulo" 
                                   value="{{ old('titulo') }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('titulo') border-red-500 @enderror"
                                   required>
                            @error('titulo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Diretor -->
                        <div class="mb-4">
                            <label for="diretor" class="block text-sm font-medium text-gray-700 mb-2">
                                Diretor *
                            </label>
                            <input type="text" 
                                   id="diretor" 
                                   name="diretor" 
                                   value="{{ old('diretor') }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('diretor') border-red-500 @enderror"
                                   required>
                            @error('diretor')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ano -->
                        <div class="mb-4">
                            <label for="ano" class="block text-sm font-medium text-gray-700 mb-2">
                                Ano de Lançamento *
                            </label>
                            <input type="number" 
                                   id="ano" 
                                   name="ano" 
                                   value="{{ old('ano') }}"
                                   min="1900" 
                                   max="{{ date('Y') + 5 }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('ano') border-red-500 @enderror"
                                   required>
                            @error('ano')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Avaliação -->
                        <div class="mb-4">
                            <label for="avaliacao" class="block text-sm font-medium text-gray-700 mb-2">
                                Avaliação (0 a 10)
                            </label>
                            <div class="flex items-center space-x-2">
                                <input type="number" 
                                       id="avaliacao" 
                                       name="avaliacao" 
                                       value="{{ old('avaliacao') }}"
                                       min="0" 
                                       max="10" 
                                       step="0.1"
                                       class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('avaliacao') border-red-500 @enderror"
                                       placeholder="Ex: 8.5">
                                <span class="text-gray-500 text-sm">⭐</span>
                            </div>
                            <p class="text-gray-500 text-xs mt-1">Deixe em branco se ainda não assistiu</p>
                            @error('avaliacao')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Assistido -->
                        <div class="mb-4">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       id="assistido" 
                                       name="assistido" 
                                       value="1"
                                       {{ old('assistido') ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="assistido" class="ml-2 block text-sm text-gray-700">
                                    ✅ Já assisti este filme
                                </label>
                            </div>
                        </div>

                        <!-- Observações -->
                        <div class="mb-6">
                            <label for="observacoes" class="block text-sm font-medium text-gray-700 mb-2">
                                Observações
                            </label>
                            <textarea id="observacoes" 
                                      name="observacoes" 
                                      rows="4"
                                      class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('observacoes') border-red-500 @enderror"
                                      placeholder="Suas impressões, comentários, etc...">{{ old('observacoes') }}</textarea>
                            @error('observacoes')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botões -->
                        <div class="flex items-center justify-between">
                            <a href="{{ route('films.index') }}" 
                               class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition duration-200">
                                ← Cancelar
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-200">
                                💾 Salvar Filme
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Dicas -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h3 class="text-sm font-medium text-blue-800 mb-2">💡 Dicas:</h3>
                <ul class="text-sm text-blue-700 space-y-1">
                    <li>• Todos os campos com * são obrigatórios</li>
                    <li>• A avaliação pode ser deixada em branco se você ainda não assistiu</li>
                    <li>• Use as observações para anotar suas impressões ou lembretes</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
