@extends('layouts.app')

@section('slot')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Lista de Emprestimos</h1>

                    <a href="{{ route('emprestimos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Novo Emprestimo</a>

                    <div class="overflow-x-auto">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aluno</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Livro</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Data do Emprestimo</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Data de Devolucao</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($emprestimos as $emprestimo)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $emprestimo->aluno->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $emprestimo->livro->titulo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ date('d/m/y', strtotime($emprestimo->data_emprestimo)) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $emprestimo->data_devolucao ? date('d/m/y',strtotime($emprestimo->data_devolucao)) : 'Ainda nao devolvido' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (!$emprestimo->data_devolucao)
                                            <form action="{{ route('emprestimos.devolver', $emprestimo->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-900">Devolver</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500 dark:text-gray-300">Nenhum emprestimo encontrado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
