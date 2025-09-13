<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_frog;

class controller_frog extends Controller
{
    public function index()
    {
        $frogs = model_frog::all();
        return view('frog.index', compact('frogs'));
    }

    public function create()
    {
        return view('frog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'habitat' => 'required|string|max:255',
            'is_poisonous' => 'required|boolean',
            'description' => 'required|string',
            'weight' => 'required|numeric|min:0'
        ]);

        model_frog::create($request->all());

        return redirect()->route('frog.index')->with('success', 'Frog added successfully!');
    }
}
