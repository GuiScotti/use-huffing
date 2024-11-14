@extends('layouts.app')

@section('slot')
    @if (Auth::user()->role !== 'user')
        <h1 class="text-3xl font-bold my-2 text-center">Mais liberdade para seu catálogo.</h1>
        <p class="text-center mb-3 text-gray-600">Cadastre aqui os seus itens e veja-os listados abaixo.</p>
    @else
        <h1 class="text-3xl font-bold my-2 text-center">Produtos disponíveis</h1>
    @endif

    <div class="flex flex-wrap justify-center gap-6 px-7">
        @foreach ($roupas as $roupa)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden w-64 flex flex-col h-96"> <!-- Fixando altura do card -->
                <img src="{{ asset($roupa->imagem) }}" alt="{{ $roupa->nome }}" class="w-full h-48 object-cover"> <!-- Altura fixa para as imagens -->

                <div class="flex flex-col p-3 flex-grow">
                    <div class="flex justify-between items-ce   nter">
                        <h2 class="text-xl font-semibold">{{ $roupa->nome }}</h2>

                        @if (Auth::user()->role === 'user')
                            <form action="{{ route('roupas.favorito', $roupa->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    @if (Auth::user()->favoritos->contains($roupa->id))
                                        <i class="fas fa-heart text-red-500"></i>
                                    @else
                                        <i class="far fa-heart text-red-500"></i>
                                    @endif
                                </button>
                            </form>
                        @else
                            <form action="{{ route('roupas.destroy', $roupa->id) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir esta roupa?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 ml-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    </div>

                    <p class="text-gray-600 mt-1 break-words">{{ $roupa->descrição }}</p>
                    <p class="text-gray-600 mt-1">Estoque: {{ $roupa->quantidade }}</p>
                </div>

                <div class="bg-white p-3 text-lg font-bold text-indigo-600">
                    R$ {{ number_format($roupa->preço, 2, ',', '.') }}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginação -->
    <div class="fixed bottom-0 left-0 w-full bg-white shadow-lg z-10 p-4">
        <div class="flex justify-center">
            {{ $roupas->links('pagination::tailwind') }}
        </div>
    </div>
@endsection