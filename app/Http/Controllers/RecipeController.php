<?php
namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
//Datatables
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Recipe::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('recipes.edit', $row->recipe_id);
                    $deleteUrl = route('recipes.destroy', $row->recipe_id);
                    $btns = "<a href='{$editUrl}' class='btn btn-primary btn-sm'>Edit</a>";
                    $btns .= "<form action='{$deleteUrl}' method='POST' style='display:inline'>
                                " . method_field('DELETE') . csrf_field() . "
                                <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this recipe?\")'>Delete</button>
                              </form>";
                    return $btns;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('recipes.index');
    }
    public function create()
    {
        return view('recipes.create');
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required',
        'ingredients' => 'required',
        'instructions' => 'required',
        'image' => 'nullable|image',
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('recipe_images', 'public');
        $validatedData['image'] = $imagePath;
    }

    $validatedData['user_id'] = auth()->user()->id;

    Recipe::create($validatedData);

    return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
}
    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }
    public function update(Request $request, Recipe $recipe)
{
    $validatedData = $request->validate([
        'title' => 'required',
        'ingredients' => 'required',
        'instructions' => 'required',
        'image' => 'nullable|image',
    ]);
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('recipe_images', 'public');
        $validatedData['image'] = $imagePath;
    }
    $recipe->update($validatedData);

    return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully.');
}
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully.');
    }
}
