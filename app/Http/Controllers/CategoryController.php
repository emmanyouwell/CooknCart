<?php

namespace App\Http\Controllers;

use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('Admin.categories.index', compact('categories'));
    }

    public function create()
    {
        // Show the create form
        return view('Admin.categories.create');
    }
    public function store(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        $category = Category::create([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        // Show the edit form
        return view('Admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        // Update the category
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Delete the category
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    public function importCategories(){
        return view('Admin.categories.import');
    }
    public function uploadCategories(Request $request){

    Excel::import(new CategoriesImport, $request->file);
        return redirect()->route('categories.index')->with('sucess','User Imported Sucessfully');
    }
}


   