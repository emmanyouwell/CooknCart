<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Recipe;
use App\Models\Order; // Add this line to import the Order model


use App\Models\IngredientsCategory;
use App\Models\MultiIngredients;







use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Review;
use Yajra\DataTables\DataTables;
use Storage;
use Auth;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\MultiRecipe;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with('ratings')->get();
        $chartData = [];

        foreach ($recipes as $recipe) {
            $ratingsCount = $recipe->ratings->count();
            $totalRating = $recipe->ratings->sum('stars_rated');
            $averageRating = $ratingsCount > 0 ? round($totalRating / $ratingsCount, 2) : 0;

            $chartData[] = [
                'recipe_name' => $recipe->name,
                'average_rating' => $averageRating,
                'ratings_count' => $ratingsCount,
            ];
        }

        // Sort recipes by average rating in descending order
        usort($chartData, function ($a, $b) {
            return $b['average_rating'] <=> $a['average_rating'];
        });

        $completedOrders = Order::where('status', 2)->get();
        $salesChartData = [];

        foreach ($completedOrders as $order) {
            $salesChartData[] = [
                'order_id' => $order->id,
                'total_price' => $order->total_price,
            ];
        }

        return view('Admin.index', compact('chartData', 'salesChartData'));
    }

    public function recipeIndex(Request $request){
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
        }
    }
    public function ingIndex(Request $request){
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
        } 
    }
}
