<!-- resources/views/livros/edit.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
</head>
<body>
    <h1>Editar Livro</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('livros.update', $livro->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $livro->titulo) }}" required><br>

        <label for="autor">Autor:</label>
        <input type="text" name="autor" id="autor" value="{{ old('autor', $livro->autor) }}" required><br>

        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn" id="isbn" value="{{ old('isbn', $livro->isbn) }}" required><br>

        <label for="editora">Editora:</label>
        <input type="text" name="editora" id="editora" value="{{ old('editora', $livro->editora) }}" required><br>

        <label for="ano_publicacao">Ano de Publicação:</label>
        <input type="number" name="ano_publicacao" id="ano_publicacao" value="{{ old('ano_publicacao', $livro->ano_publicacao) }}" required><br>

        <button type="submit">Atualizar</button>
    </form>

    <a href="{{ route('livros.index') }}">Voltar para a lista de livros</a>
</body>
</html>
