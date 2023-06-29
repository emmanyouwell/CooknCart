<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Ingredient::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('ingredients.edit', $row->id);
                    $deleteUrl = route('ingredients.destroy', $row->id);
                    $btns = "<a href='{$editUrl}' class='btn btn-primary btn-sm'>Edit</a>";
                    $btns .= "<form action='{$deleteUrl}' method='POST' style='display:inline'>
                                " . method_field('DELETE') . csrf_field() . "
                                <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this ingredient?\")'>Delete</button>
                              </form>";
                    return $btns;
                })
                ->addColumn('image', function ($row) {
                    $imagePath = asset('storage/' . $row->image);
                    return "<img src='{$imagePath}' alt='Ingredient Image' width='50' height='50'>";
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        return view('ingredients.index');
    }
    public function create()
    {
        return view('ingredients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/ingredients', $imageName);
            $validatedData['image'] = 'ingredients/' . $imageName;
        }
        Ingredient::create($validatedData);

        return redirect()->route('ingredients.index')->with('success', 'Ingredient created successfully.');
    }
    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/ingredients', $imageName);
            $validatedData['image'] = 'ingredients/' . $imageName;
        }
        $ingredient->update($validatedData);

        return redirect()->route('ingredients.index')->with('success', 'Ingredient updated successfully.');
    }
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredients.index')->with('success', 'Ingredient deleted successfully.');
    }
}

