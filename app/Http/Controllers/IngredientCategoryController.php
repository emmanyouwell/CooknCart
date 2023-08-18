<?php

namespace App\Http\Controllers;
use App\Exports\ingredientsCategoriesExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Imports\ingredientCategoriesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\IngredientsCategory;
use Illuminate\Http\Request;
use DataTables;
use Barryvdh\DomPDF\Facade\Pdf;



class IngredientCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $ingredientscategories = IngredientsCategory::select(['id', 'name', 'description']);
            return DataTables::of($ingredientscategories)
                ->addColumn('action', function ($ingredientscategory) {
                    $editUrl = route('categories_ingredients.edit', $ingredientscategory->id);
                    $deleteUrl = route('categories_ingredients.destroy', $ingredientscategory->id);
                    $btns = "<a href='{$editUrl}' class='btn btn-primary btn-sm'>Edit</a>";
                    $btns .= "<form action='{$deleteUrl}' method='POST' style='display:inline'>
                                " . method_field('DELETE') . csrf_field() . "
                                <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this category?\")'>Delete</button>
                              </form>";
                    return $btns;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Admin.categories_ingredients.index');
    }

    public function create()
    {
        // Show the create form
        return view('Admin.categories_ingredients.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        // Create the category
        $ingredientscategories = IngredientsCategory::create($validatedData);

        // Debug and inspect the data
        //dd($category);

        return redirect()->route('categories_ingredients.index')->with('success', 'Category added successfully.');
    }

    public function edit(IngredientsCategory $ingredientscategories)
    {
        // Show the edit form
        return view('Admin.categories_ingredients.edit', compact('ingredientscategories'));
    }

    public function update(Request $request, IngredientsCategory $ingredientscategories)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        // Update the category
        $ingredientscategories->update($validatedData);

        return redirect()->route('categories_ingredients.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(IngredientsCategory $ingredientscategories)
    {
        // Delete the category
        $ingredientscategories->delete();

        return redirect()->route('categories_ingredients.index')->with('success', 'Category deleted successfully.');
    }

    public function importingredientCategory()
    {
        return view('Admin.categories_ingredients.import');
    }
    public function uploadingredientCategories(Request $request)
    {

        Excel::import(new ingredientCategoriesImport, $request->file);
        return redirect()->route('categories_ingredients.index')->with('sucess', 'User Imported Sucessfully');
    }
    public function exportingredientCategories(Request $request)
    {
        $data = IngredientsCategory::all();

        $pdf = PDF::loadView('Admin.categories_ingredients.pdf', ['data' => $data]);
        return $pdf->download('categoriesingredient.pdf');
    }

    public function export()
    {
        return Excel::download(new ingredientsCategoriesExport, 'ingredientCategory.xlsx');
    }
}
