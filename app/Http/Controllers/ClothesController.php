<?php

namespace App\Http\Controllers;

use App\Models\Clothe;
use Illuminate\Http\Request;

class ClothesController extends Controller
{
    public function index()
    {
        $clothes = Clothe::paginate(10);
        return view('clothes.index', compact('clothes'));
    }

    public function create()
    {
        return view('clothes.create');
    }

    public function store(Request $request)
    {
        Clothe::create($request->all());
        return redirect()->route('clothes.index');
    }

    public function destroy(Clothe $clothe)
    {
        $clothe->delete();
        return redirect()->route('clothes.index');
    }
}
