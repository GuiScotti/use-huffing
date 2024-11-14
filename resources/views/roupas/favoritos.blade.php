@extends('layouts.app')

@section('slot')
    <h1 class="text-3xl font-bold my-6 text-center">Meus Favoritos</h1>

    @if ($roupasFavoritas->isEmpty())
        <p class="text-center text-gray-600">Você não tem nenhum item favoritado ainda.</p>
    @else
        <div class="flex flex-wrap justify-center gap-6 px-7">
            @foreach ($roupasFavoritas as $roupa)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden w-64 flex flex-col h-full">
                    <img src="{{ asset($roupa->imagem) }}" alt="{{ $roupa->nome }}" class="w-full h-40 object-cover">

                    <div class="p-4 flex-grow">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold">{{ $roupa->nome }}</h2>
                            <!-- Botão de favorito com FontAwesome -->
                            <form action="{{ route('roupas.favorito', $roupa->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    @if (auth()->user()->favoritos->contains($roupa->id))
                                        <i class="fas fa-heart text-red-500"></i> <!-- Coração preenchido -->
                                    @else
                                        <i class="far fa-heart text-red-500"></i> <!-- Coração vazio -->
                                    @endif
                                </button>
                            </form>
                        </div>

                        <p class="text-gray-600 mt-2">{{ $roupa->descrição }}</p>
                        <p class="text-gray-600 mt-2">Estoque: {{ $roupa->quantidade }}</p>
                        <div class="text-lg font-bold mt-4 text-indigo-600">
                            R$ {{ number_format($roupa->preço, 2, ',', '.') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection