<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::select(['id', 'name', 'description']);
            return DataTables::of($categories)
                ->addColumn('action', function ($category) {
                    $editUrl = route('categories.edit', $category->id);
                    $deleteUrl = route('categories.destroy', $category->id);
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

        return view('Admin.categories.index');
    }

    public function create()
    {
        // Show the create form
        return view('Admin.categories.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        // Create the category
        $category = Category::create($validatedData);

        // Debug and inspect the data
        //dd($category);

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
}
