@extends('layouts.app')

@section('slot')
<div class="flex items-center justify-center bg-gray-100 pt-2">
    <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg">
        
        <!-- Seção Esquerda: Título e Texto -->
        <div class="w-1/2 bg-blue-100 p-8 rounded-l-lg flex flex-col justify-center text-center">
            <h1 class="text-3xl font-bold text-indigo-600 mb-4">Mais liberdade para seu catálogo</h1>
            <p class="text-lg text-gray-700">Cadastre aqui os seus itens</p>
        </div>

        <!-- Seção Direita: Formulário -->
        <div class="w-1/2 p-8">
            <form method="POST" action="{{ route('roupas.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="imagem" :value="__('Adicione o anexo da sua imagem')" />
                    <x-text-input id="imagem" class="block w-full mt-1 p-2 border rounded-md" type="file" name="imagem" required autofocus />
                    <x-input-error :messages="$errors->get('imagem')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="nome" :value="__('Nome da peça')" />
                    <x-text-input id="nome" class="block w-full mt-1 p-2 border rounded-md" type="text" name="nome" required />
                    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="descrição" :value="__('Descrição')" />
                    <x-text-input id="descrição" class="block w-full mt-1 p-2 border rounded-md" type="text" name="descrição" required />
                    <x-input-error :messages="$errors->get('descrição')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="preço" :value="__('Preço')" />
                    <x-text-input id="preço" class="block w-full mt-1 p-2 border rounded-md" type="number" name="preço" required />
                    <x-input-error :messages="$errors->get('preço')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="quantidade" :value="__('Quantidade')" />
                    <x-text-input id="quantidade" class="block w-full mt-1 p-2 border rounded-md" type="number" name="quantidade" required />
                    <x-input-error :messages="$errors->get('quantidade')" class="mt-2" />
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-md font-semibold transition-colors duration-300">
                    Salvar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
