<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\IngredientsCategory;
use Yajra\DataTables\DataTables;
use Storage;
use Illuminate\Support\Facades\Auth;

class IngredientController extends Controller
{
    // Apply the path to the image, if needed
    // $ingredients->transform(function ($ingredient) {
    //     $ingredient->image = asset('storage/' . $ingredient->image);
    //     return $ingredient;
    // });

    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->role_as === 1) {
            if ($request->ajax()) {
                $ingredients = Ingredient::with('category')->latest()->get();

                $ingredients->transform(function ($item) {
                    $item->image = asset($item->image);
                    return $item;
                });

                return DataTables::of($ingredients)
                    ->addColumn('action', function ($ingredient) {
                        $editUrl = route('ingredients.edit', $ingredient->id);
                        $deleteUrl = route('ingredients.destroy', $ingredient->id);

                        $buttons = '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>';
                        $buttons .= '<form action="' . $deleteUrl . '" method="POST" class="d-inline">
                                        ' . csrf_field() . '
                                        ' . method_field('DELETE') . '
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm(\'Are you sure you want to delete this ingredient?\')">Delete</button>
                                    </form>';

                        return $buttons;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('Admin.ingredients.index');
        } else {
            $categories = IngredientsCategory::all();
            $ingredients = Ingredient::all();

            return view('User.ingredients.index', compact('categories', 'ingredients'));
        }
    }


    public function getIngredient(Request $request)
    {
        $tags = [];
        if ($search = $request->name) {
            $tags = Ingredient::where('name', 'LIKE', "%$search%")->get();
        }
        return response()->json($tags);
    }

    public function create()
    {
        $categories = IngredientsCategory::pluck('name', 'id');
        return view('Admin.ingredients.create', compact('categories'));
    }


    //======================================================
    //     public function insert(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'slug' => 'required|unique:categories',
    //         'description' => 'required',
    //         'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
    //     ]);

    //     $category = new Category;
    //     $category->name = $request->input('name');
    //     $category->slug = $request->input('slug');
    //     $category->description = $request->input('description');
    //     $category->status = $request->has('status');
    //     $category->popular = $request->has('popular');
    //     $category->meta_title = $request->input('meta_title');
    //     $category->meta_keywords = $request->input('meta_keywords');
    //     $category->meta_descrip = $request->input('meta_descrip');

    //     // Handle image upload
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $filename = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move('public/assets/uploads/categories/', $filename);
    //         $category->image = $filename;
    //     }

    //     $category->save();

    //     return redirect('categories')->with('status', 'Category added successfully!');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif', // Use the "image.*" syntax for multiple images
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'ingredient_category_id' => 'required|exists:ingredients_categories,id',
        ]);

        $ingredient = new Ingredient();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $uploadPath='image/ingredients/';
            $image->move($uploadPath, $filename);
            $url = $uploadPath.$filename;
            $ingredient->image = $filename;
        }

        Ingredient::create([
            'name' => $request->name,
            'description' => $request->description,
            // 'image' => implode('|', $images),
            'image' => $url,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'ingredient_category_id' => $request->ingredient_category_id,
        ]);

        return redirect()->route('ingredients.index')->with('success', 'Ingredient created successfully.');
    }


    public function edit(Ingredient $ingredient)
    {
        $categories = IngredientsCategory::pluck('name', 'id');
        return view('Admin.ingredients.edit', compact('ingredient', 'categories'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'ingredient_category_id' => 'required|exists:ingredients_categories,id',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'ingredient_category_id' => $request->ingredient_category_id,
        ];

        // if ($request->hasFile('image')) {
        //     // Delete old image
        //     Storage::delete('public/' . $ingredient->image);

        //     // Upload new image
        //     $imagePath = $request->file('image')->store('public/ingredients');
        //     $data['image'] = str_replace('public/', '', $imagePath);
        // }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $uploadPath='image/ingredients/';
            $image->move($uploadPath, $filename);
            $url = $uploadPath.$filename;
            $data['image'] = $url;
        }

        $ingredient->update($data);

        return redirect()->route('ingredients.index')->with('success', 'Ingredient updated successfully.');
    }

    public function destroy(Ingredient $ingredient)
    {
        // Delete image
        Storage::delete('public/' . $ingredient->image);

        $ingredient->delete();

        return redirect()->route('ingredients.index')->with('success', 'Ingredient deleted successfully.');
    }

    // public function productview($cate_slug, $prod_slug)
    // {
    //     if(Category::where('slug', $cate_slug)->exists())
    //     {
    //         if(Product::where('slug',$prod_slug)->exists())
    //         {  
    //             $products = Product::where('slug',$prod_slug)->first();
    //             return view('frontend.products.view', compact('products'));

    //         }
    //         else{
    //             return redirect('/')->with('status',"The link was broken");
    //         }
    //     }
    //     else{
    //         return redirect('/')->with('status',"No such category found");
    //     }
    // }

    public function ingredientsview($ingredientId)
    {
        $ingredient = Ingredient::find($ingredientId);

        if ($ingredient) {
            return view('User.ingredients.view', compact('ingredient'));
        } else {
            return redirect('/')->with('message', "No such ingredient found");
        }
    }



    //=======================================================================================================================
    // public function cart()
    // {
    //     return view('cart');
    // }
    // public function addToCart($id)
    // {
    //     $ingredient = Ingredient::findOrFail($id);

    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity']++;
    //     } else {
    //         $cart[$id] = [
    //             "name" => $ingredient->name,
    //             "quantity" => 1,
    //             "price" => $ingredient->price,
    //             "description" => $ingredient->description,
    //             "image" => $ingredient->image
    //         ];
    //     }

    //     session()->put('cart', $cart);
    //     return redirect()->back()->with('success', 'Product added to cart successfully!');
    // }

    // public function updatecart(Request $request)
    // {
    //     if ($request->id && $request->quantity) {
    //         $cart = session()->get('cart');
    //         $cart[$request->id]["quantity"] = $request->quantity;
    //         session()->put('cart', $cart);
    //         session()->flash('success', 'Cart updated successfully');
    //     }
    // }
    // public function remove(Request $request)
    // {
    //     if ($request->id) {
    //         $cart = session()->get('cart');
    //         if (isset($cart[$request->id])) {
    //             unset($cart[$request->id]);
    //             session()->put('cart', $cart);
    //         }
    //         session()->flash('success', 'Product removed successfully');
    //     }
    // }
}
