<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\User;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    // mostrar todas as prendas
    public function index()
    {
        $gifts = Gift::with('user')->get();

        return view('gifts.index', compact('gifts'));
    }

    // Mostrar formulário para criar prendas
    public function create()
    {
        $users = User::all();

        return view('gifts.create', compact('users'));
    }

    // Mostrar detalhes da prenda
    public function show(Gift $gift)
    {
        return view('gifts.show', compact('gift'));
    }

    // Apagar prenda
    public function destroy(Gift $gift)
    {
        $gift->delete();

        return redirect()->route('gifts.index')->with('success', 'Prenda apagada com sucesso!');
    }

    // Guardar
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'expected_value' => 'required|numeric|min:0',
            'spent_value' => 'nullable|numeric|min:0',
            'user_id' => 'required|exists:users,id',
        ]);

        Gift::create($request->only([
            'name',
            'expected_value',
            'spent_value',
            'user_id',
        ]));

        return redirect()->route('gifts.index')->with('success', 'Prenda criada com sucesso!');
    }
}
