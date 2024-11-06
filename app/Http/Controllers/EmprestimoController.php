<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Emprestimo;
use App\Models\Livro;
use Illuminate\Http\Request;


class EmprestimoController extends Controller
{
    public function index() {
        $emprestimos = Emprestimo::with('aluno', 'livro')->get();
        return view('emprestimos.index', compact('emprestimos'));
    }

    public function create() {
        $alunos = Aluno::all();
        $livros = Livro::all();
        return view('emprestimos.create', compact('alunos', 'livros'));
    }

    public function store(Request $request) {
        $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'livro_id' => 'required|exists:livros,id',
            'data_emprestimo' => 'required|date',
        ]);

        Emprestimo::create([
            'aluno_id' => $request->aluno_id,
            'livro_id' => $request->livro_id,
            'data_emprestimo' => $request->data_emprestimo,
        ]);

        return redirect()->route('emprestimos.index')->with('success', 'Livros emprestado com sucesso');
    }

    public function devolver(Emprestimo $emprestimo) {
        $emprestimo->update(['data_devolucao'=> now()]);

        return redirect()->route('emprestimos.index')->with('success', 'Livros devolvido com sucesso');
    }
}
