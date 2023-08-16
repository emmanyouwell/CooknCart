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
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\MultiRecipe;
class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $search_param = $request->query('q');

        if ($search_param) {
            // Handle the search and return the search view
            $categories = Category::all();
            $recipes_query = Recipe::query();
            $recipes_query = Recipe::search($search_param);
            $recipes = $recipes_query->get();

            $categories = Category::all();
            $ingredients = Ingredient::all();

            return view('User.recipes.search', compact('recipes', 'categories', 'ingredients', 'search_param'));
        }

        if (Auth::check() && Auth::user()->role_as === 1) {
            if ($request->ajax()) {
                $recipes_query = Recipe::with('user')->latest();
                $recipes = $recipes_query->get();

                return DataTables::of($recipes)
                    ->addColumn('category', function ($recipe) {
                        return $recipe->category->pluck('name')->implode(', ');
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
            return view('Admin.recipes.index');
        } else {
            $recipes = Recipe::all();
            $categories = Category::all();
            $ingredients = Ingredient::all();


            return view('User.recipes.index', compact('recipes', 'categories', 'ingredients', 'search_param'));
        }
    }

    public function autocomplete(Request $request)
{
    $search = $request->input('q');
    $recipes = Recipe::where('name', 'LIKE', "%$search%")->limit(10)->get();

    return response()->json($recipes);
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

            'preptime' => 'required',
            'cooktime' => 'required',
            'servings' => 'required',

        'instruction.*.step' => 'required',
        'category_id' => 'required|exists:categories,id',
        // 'images' => 'required|image|max:2048',
        'tags' => 'required',
        // 'ingredients.*' => 'exists:ingredients,id',
    ]);
  
        $multipleImage=array();
        if($files = $request->file('images')) {
            foreach($files as $file){
                $fileName = time().'_'.$file->getClientOriginalName();
                $uploadPath = 'image/recipes/multiple/';
                $url = $uploadPath.$fileName;
                Image::make($file)->resize(770,520)->save($url);
                // $file->move($uploadPath,$fileName);
                $multipleImage[]=$url;
            }
            
            
        }
        if($request->file()) {

            $image = $request->file('image');
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $uploadPath = 'image/recipes/';
            $url = $uploadPath.$fileName;
            $image->move($uploadPath,$fileName);
        }
    // dd($path);
    // $imagePath = $request->file('image')->store('recipes', 'public');
    
    $recipe = Recipe::create([
        'user_id' => auth()->user()->id,
        'name' => $request->name,
        'description' => $request->description,

            'preptime' => $request->preptime,
            'cooktime' => $request->cooktime,
            'servings' => $request->servings,

        'instruction' => json_encode($request->instruction),
        'category_id' => $request->category_id,
        'image' => $url,
        'tags' => json_encode($request->tags)
    ]);
    MultiRecipe::insert([
        'image' => implode("|", $multipleImage),
        'recipe_id' => $recipe->id,
        'created_at'=>now(),
    ]);

        // $recipe->ingredients()->attach($request->ingredients);

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
    }

    public function display(){
        $images = MultiRecipe::where('recipe_id',33)->first();
        // dd($images->image);
        $test = array();
        $test = explode('|',$images->image);
        // dd($test);
        return view('Admin.recipes.test', compact('test'));
    }
    public function edit(Recipe $recipe)
    {
        $categories = Category::pluck('name', 'id');
        $ingredients = Ingredient::pluck('name', 'id');
        $multi = MultiRecipe::where('recipe_id', $recipe->id)->first();
        $img = array();
        $img = explode('|', $multi->image);


        return view('Admin.recipes.edit', compact('recipe', 'categories', 'ingredients','img'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',

            'preptime' => 'required',
            'cooktime' => 'required',
            'servings' => 'required',

            'instruction' => 'required',
            'category_id' => 'required',
            'tags' => 'required',
            // 'ingredients.*' => 'exists:ingredients,id',
            //'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // $validatedData['tags'] = json_encode($request->tags);
        // $validatedData['instruction'] = json_encode($request->instruction);
        // $recipe->name = $validatedData['name'];
        // $recipe->description = $validatedData['description'];
        // $recipe->instruction = $validatedData['instruction'];
        // $recipe->category_id = $validatedData['category_id'];
        // $recipe->tags = $validatedData['tags'];

        // if ($request->hasFile('image')) {
        //     $fileName = time() . '_' . $request->file('image')->getClientOriginalName();

        //     // $filePath = $request->file('img_path')->storeAs('uploads', $fileName,'public');
        //     // dd($fileName,$filePath);

        //     $path = Storage::putFileAs(
        //         'public/images',
        //         $request->file('image'),
        //         $fileName
        //     );

        //     $recipe->image = '/storage/images/' . $fileName;
        // }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $uploadPath = 'image/recipes/';
            $image->move($uploadPath, $filename);
            $url = $uploadPath . $filename;
            $recipe->image = $url;
        }
        Recipe::where('id', $recipe->id)->update([
            'name' => $request->name,
            'description' => $request->description,

            'preptime' => $request->preptime,
            'cooktime' => $request->cooktime,
            'servings' => $request->servings,

            'instruction' => json_encode($request->instruction),
            'category_id' => $request->category_id,
            'tags' => json_encode($request->tags),
            // 'image' =>$url,
        ]);
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
        $reviews = Review::where('recipe_id', $recipe->id)->get();
        // dd($recipe->id);
        $multiImage = MultiRecipe::where('recipe_id',$recipe->id)->first();
        // dd($multiImage);
        $img = array();
        $img = explode('|', $multiImage->image);

        if ($recipe) {
            return view('User.recipes.view', compact('recipe', 'reviews', 'img'));
        } else {
            return redirect('/')->with('message', "No such ingredient found");
        }
    }
}
