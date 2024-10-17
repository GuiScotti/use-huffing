<!-- resources/views/livros/show.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Livro</title>
</head>
<body>
    <h1>Detalhes do Livro</h1>

    <p><strong>ID:</strong> {{ $livro->id }}</p>
    <p><strong>Título:</strong> {{ $livro->titulo }}</p>
    <p><strong>Autor:</strong> {{ $livro->autor }}</p>
    <p><strong>ISBN:</strong> {{ $livro->isbn }}</p>
    <p><strong>Editora:</strong> {{ $livro->editora }}</p>
    <p><strong>Ano de Publicação:</strong> {{ $livro->ano_publicacao }}</p>

    <a href="{{ route('livros.index') }}">Voltar para a lista de livros</a>
    <a href="{{ route('livros.edit', $livro->id) }}">Editar</a>
    <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Excluir</button>
    </form>
</body>
</html>
