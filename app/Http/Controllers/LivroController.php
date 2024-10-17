<?php
namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index() { 
        $livros = Livro::all();
        return view('livros.index', compact('livros'));
    }

    public function create() { 
        return view('livros.create');
    }

    public function store(Request $request) { 
        $request->validate([ 
            'titulo'=>'required',
            'autor'=>'required',
            'isbn'=>'required|unique:livros',
            'editora'=>'required',
            'ano_publicacao'=>'required|numeric',
        ]);

        Livro::create($request->all());

        return redirect()->route('livros.index')->with('success', 'Livro criado com sucesso!');
    }

    public function show($id) { 
        $livro = Livro::findOrFail($id);
        return view('livros.show', compact('livro'));
    }

    public function edit($id) { 
        $livro = Livro::findOrFail($id);
        return view('livros.edit', compact('livro'));
    }

    public function update(Request $request, $id) { 
        $request->validate([ 
            'titulo' => 'required',
            'autor' => 'required',
            'isbn' => 'required|unique:livros,isbn,'.$id,
            'editora' => 'required',
            'ano_publicacao' => 'required|numeric',
        ]);

        $livro = Livro::findOrFail($id);
        $livro->update($request->all());

        return redirect()->route('livros.index')->with('success',  'Livro atualizado com sucesso!');
    }

    public function destroy($id) { 
        $livro = Livro::findOrFail($id);
        $livro->delete();

        return redirect()->route('livros.index')->with('success', 'Livro removido com sucesso!');
    }
}
