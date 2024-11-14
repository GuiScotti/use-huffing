<?php

namespace App\Http\Controllers;

use App\Models\Roupa;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class RoupaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roupas = Roupa::paginate(4);
        return view('roupas.index', compact('roupas'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roupa = $request->validate([
            'nome' => 'required|string|max:255',
            'descrição' => 'nullable|string',
            'preço' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'quantidade' => 'required|integer',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('clothes', 'public');

            $roupa['imagem'] = 'storage/' . $path;
        }

        Roupa::create($roupa);

        return redirect()->route('roupas.index')->with('success', 'Roupa cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $roupa = Roupa::findOrFail($id);
        return view('roupas.show', compact('roupa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roupa = Roupa::findOrFail($id);
        return view('roupas.edit', compact('roupa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'descrição' => 'required|string',
            'preço' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'quantidade' => 'required|integer',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $roupa = Roupa::findOrFail($id);

        if ($request->hasFile('imagem')) {
            if ($roupa->imagem && file_exists(storage_path('app/public' . $roupa->imagem))) {
                unlink(storage_path('app/public' . $roupa->imagem));
            }

            $path = $request->file('imagem')->store('roupas', 'public');
            $data['imagem'] = 'storage/' . $path;
        }

        $roupa->update($data);

        return redirect()->route('roupas.index')->with('success', 'Roupa atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roupa = Roupa::findOrFail($id);

        // Verificando se a imagem existe e deletando
        if ($roupa->imagem && file_exists(storage_path('app/public/' . $roupa->imagem))) {
            unlink(storage_path('app/public/' . $roupa->imagem));
        }

        // Deletando a roupa do banco de dados
        $roupa->delete();

        return redirect()->route('roupas.index')->with('success', 'Roupa excluída com sucesso!');
    }

    public function favorito(Request $request, $id)
    {
        $user = $request->user();
        $roupa = Roupa::findOrFail($id);

        if ($user->favoritos->contains($id)) {
            $user->favoritos()->detach($id);
        } else {
            $user->favoritos()->attach($id);
        }

        return redirect()->back();
    }

    public function favoritos(Request $request)
    {
        $user = $request->user();
    
        $roupasFavoritas = $user->favoritos;
    
        return view('roupas.favoritos', compact('roupasFavoritas'));
    }
}
