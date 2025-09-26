<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\model_frog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class controller_frog extends Controller
{
    public function index()
    {
        $frogs = model_frog::whereNull('deleted_at')->get();
        return view('frog.index', compact('frogs'));
    }

    public function create()
    {
        return view('frog.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:frog,name',
            'picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'color' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'habitat' => 'required|string|max:255',
            'is_poisonous' => 'required|boolean',
            'description' => 'string',
            'weight' => 'required|numeric|min:0'
        ], [
            'picture.image' => 'Picture must be an image.',
            'picture.mimes' => 'Picture must be jpeg, png, jpg, or gif.',
            'picture.max' => 'Picture must not be greater than 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Handle picture upload
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('frogs', $filename, 'public');
            $data['picture'] = $path;
        }

        model_frog::create($data);

        return redirect()->route('frog.index')->with('success', 'Froggy berhasil!');
    }

    public function edit($id)
    {
        $frog = model_frog::findOrFail($id);
        return view('frog.edit', compact('frog'));
    }

    public function update(Request $request, $id)
    {
        $frog = model_frog::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:frog,name,' . $frog->id,
            'picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'color' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'habitat' => 'required|string|max:255',
            'is_poisonous' => 'required|boolean',
            'description' => 'string',
            'weight' => 'required|numeric|min:0'
        ], [
            'picture.image' => 'Picture must be an image.',
            'picture.mimes' => 'Picture must be jpeg, png, jpg, or gif.',
            'picture.max' => 'Picture must not be greater than 2MB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Handle picture upload
        if ($request->hasFile('picture')) {
            // Delete old image if exists
            if ($frog->picture) {
                Storage::disk('public')->delete($frog->picture);
            }

            $file = $request->file('picture');
            $filename = time() . '_' . $frog->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('frogs', $filename, 'public');
            $data['picture'] = $path;
        }

        $frog->update($data);

        return redirect()->route('frog.index')->with('success', 'Frog updated successfully!');
    }

    public function destroy($id)
    {
        $frog = model_frog::findOrFail($id);
        $frog->delete();

        return redirect()->route('frog.index')->with('success', 'Frog deleted successfully!');
    }

    public function restoreAll()
    {
        model_frog::onlyTrashed()->restore();

        return redirect()->route('frog.index')->with('success', 'All deleted frogs have been restored!');
    }
}
