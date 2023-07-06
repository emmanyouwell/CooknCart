<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class IngredientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Ingredient::with('category')->latest()->get();
            return DataTables::of($data)
                ->addColumn('category', function ($ingredient) {
                    return $ingredient->category->name;
                })
                ->addColumn('action', function ($ingredient) {
                    $button = '<a href="' . route('ingredients.edit', $ingredient->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $ingredient->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
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
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|max:2048',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'ingredient_category_id' => 'required|exists:ingredient_categories,id',
            'ingredients' => 'required|array',
            'ingredients.*' => 'exists:ingredients,id', 
        ]);
    
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
    
        $ingredient = Ingredient::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'ingredient_category_id' => $request->ingredient_category_id,
        ]);
    
        $ingredient->ingredients()->attach($request->input('ingredients'));
      
        return redirect()->route('ingredients.index')->with('success', 'Ingredient created successfully.');
    }
    

    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient', 'categories'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|max:2048',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'ingredient_category_id' => 'required|exists:ingredient_categories,id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $ingredient->update(['image' => $imageName]);
        }

        $ingredient->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'ingredient_category_id' => $request->ingredient_category_id,
        ]);

        return redirect()->route('ingredients.index')->with('success', 'Ingredient updated successfully.');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return response()->json(['success' => 'Ingredient deleted successfully.']);
    }
}
