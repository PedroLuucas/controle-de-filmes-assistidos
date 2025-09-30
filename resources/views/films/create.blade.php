<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center gap-2">
            ➕ <span>Adicionar Novo Filme</span>
        </h2>
    </x-slot>

    <div class="py-10 mt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card do formulário -->
            <div class="bg-white rounded-xl shadow-md p-6">
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
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('titulo') border-red-500 @enderror"
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
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('diretor') border-red-500 @enderror"
                               required>
                        @error('diretor')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ano e Avaliação -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="ano" class="block text-sm font-medium text-gray-700 mb-2">
                                Ano de Lançamento *
                            </label>
                            <input type="number"
                                   id="ano"
                                   name="ano"
                                   value="{{ old('ano') }}"
                                   min="1900" max="{{ date('Y') + 5 }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('ano') border-red-500 @enderror"
                                   required>
                            @error('ano')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="avaliacao" class="block text-sm font-medium text-gray-700 mb-2">
                                Avaliação (0 a 10)
                            </label>
                            <div class="flex items-center space-x-2">
                                <input type="number"
                                       id="avaliacao"
                                       name="avaliacao"
                                       value="{{ old('avaliacao') }}"
                                       min="0" max="10" step="0.1"
                                       placeholder="Ex: 8.5"
                                       class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('avaliacao') border-red-500 @enderror">
                                <span class="text-gray-500 text-sm">⭐</span>
                            </div>
                            <p class="text-gray-500 text-xs mt-1">Deixe em branco se ainda não assistiu</p>
                            @error('avaliacao')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status Assistido -->
                    <div class="mb-4">
                        <label class="flex items-center gap-2">
                            <input type="checkbox"
                                   id="assistido"
                                   name="assistido"
                                   value="1"
                                   {{ old('assistido') ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <span class="text-sm text-gray-700">✅ Já assisti este filme</span>
                        </label>
                    </div>

                    <!-- Observações -->
                    <div class="mb-6">
                        <label for="observacoes" class="block text-sm font-medium text-gray-700 mb-2">
                            Observações
                        </label>
                        <textarea id="observacoes"
                                  name="observacoes"
                                  rows="4"
                                  placeholder="Suas impressões, comentários, etc..."
                                  class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('observacoes') border-red-500 @enderror">{{ old('observacoes') }}</textarea>
                        @error('observacoes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botões -->
                    <div class="flex flex-col sm:flex-row sm:justify-between gap-3">
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('films.index') }}"
                               class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition shadow-sm text-center">
                                ← Voltar
                            </a>
                            <button type="submit"
                                    class="bg-green-500 text-gray-800 font-medium px-6 py-2 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition shadow-md">
                                Salvar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
