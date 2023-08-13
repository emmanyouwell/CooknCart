<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Review;
use Yajra\DataTables\DataTables;
use Storage;
use Auth;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        
        if (Auth::check() && Auth::user()->role_as === 1) {
            if ($request->ajax()) {
                $recipes = Recipe::with('user')->latest()->get();

                // Apply the path to the image
                // $recipes->transform(function ($recipe) {
                //     $recipe->image = asset('storage/' . $recipe->image);
                //     return $recipe;
                // });

                return DataTables::of($recipes)
                    ->addColumn('category', function ($recipe) {
                        return $recipe->categories->pluck('name')->implode(', ');
                    })
                    ->addColumn('ingredients', function ($recipe) {
                        
                        return json_decode($recipe->tags);
                    })
                    ->addColumn('action', function ($recipe) {
                        $editUrl = route('recipes.edit', $recipe->id);
                        $deleteUrl = route('recipes.destroy', $recipe->id);

                        $buttons = '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>';
                        $buttons .= '<form action="' . $deleteUrl . '" method="POST" class="d-inline">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm(\'Are you sure you want to delete this recipe?\')">Delete</button>
                    </form>';

                        return $buttons;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('Admin.recipes.index');//
        } else {
            $recipes = Recipe::all();
            $categories = Category::all();
            $ingredients = Ingredient::all();
            
            return view('User.recipes.index', compact('recipes', 'categories', 'ingredients'));
        }
    }
    
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $ingredients = Ingredient::pluck('name', 'id');
        $ingredients = Ingredient::all();

        return view('Admin.recipes.create', compact('categories', 'ingredients'));
    }

    //     $images = [];
    // if ($files = $request->file('image')) {
    //     foreach ($files as $file) {
    //         $ext = strtolower($file->getClientOriginalExtension());
    //         $image_name = time() . '_' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    //         $image_full_name = $image_name . '.' . $ext;
    //         $upload_path = '/images/dp/';
    //         $image_url = $upload_path . $image_full_name;
    //         $file->move($upload_path, $image_full_name);
    //         $images[] = $image_url;
    //     }
    // }

    //baba ng tags 
    // 'ingredients.*' => 'exists:ingredients,id',


    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'instruction' => 'required',
        'category_id' => 'required|exists:categories,id',
        'image' => 'required|image|max:2048',
        'tags' => 'required',
        // 'ingredients.*' => 'exists:ingredients,id',
    ]);
  
    
        if($request->file()) {
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
           
            // $filePath = $request->file('img_path')->storeAs('uploads', $fileName,'public');
            // dd($fileName,$filePath);
           
            $path = Storage::putFileAs(
                'public/images', $request->file('image'), $fileName
            );
        }
    // dd($path);
    // $imagePath = $request->file('image')->store('recipes', 'public');
    
    $recipe = Recipe::create([
        'user_id' => auth()->user()->id,
        'name' => $request->name,
        'description' => $request->description,
        'instruction' => $request->instruction,
        'category_id' => $request->category_id,
        'image' => '/storage/images/' . $fileName,
        'tags' => json_encode($request->tags)
    ]);

    // $recipe->ingredients()->attach($request->ingredients);

    return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
}

    public function edit(Recipe $recipe)
    {
        $categories = Category::pluck('name', 'id');
        $ingredients = Ingredient::pluck('name', 'id');


        return view('Admin.recipes.edit', compact('recipe', 'categories', 'ingredients'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'instruction' => 'required',
            'category_id' => 'required',
            'tags' => 'required',
            // 'ingredients.*' => 'exists:ingredients,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $validatedData['tags'] = json_encode($request->tags);
        $recipe->name = $validatedData['name'];
        $recipe->description = $validatedData['description'];
        $recipe->instruction = $validatedData['instruction'];
        $recipe->category_id = $validatedData['category_id'];
        $recipe->tags = $validatedData['tags'];
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();

            // $filePath = $request->file('img_path')->storeAs('uploads', $fileName,'public');
            // dd($fileName,$filePath);

            $path = Storage::putFileAs(
                'public/images',
                $request->file('image'),
                $fileName
            );

            $recipe->image = '/storage/images/' . $fileName;
        }

        $recipe->save();



        return redirect()->route('recipes.index')->with('success', 'Recipe updated successfully.');
    }

    public function destroy(Recipe $recipe)
    {
        // $recipe->ingredients()->detach();
        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully.');
    }
    public function recipesview($recipeId)
    {
        $recipe = Recipe::find($recipeId);
        $ingredients = Ingredient::pluck('name', 'id');
        $reviews = Review::where('recipe_id',$recipe->id)->get();

        if ($recipe) {
            return view('User.recipes.view', compact('recipe','reviews'));
        } else {
            return redirect('/')->with('message', "No such ingredient found");
        }
    }
}
