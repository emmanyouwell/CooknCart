<?php

// namespace App\Http\Controllers;

// use App\Models\Recipe;
// use Illuminate\Http\Request;
// use Spatie\Searchable\Search;

// class SearchController extends Controller
// {
//     public function index(Request $request)
//     {
//         $recipes_query = Recipe::query();

//         $search_param = $request->query('q');

//         if ($search_param) {

//             $recipes_query = Recipe::search($search_param);
//         }
//         $recipes = $recipes_query->get();

//         return view('User.recipes.search', compact('recipes', 'search_param'));
//     }
//     public function autocompleteSearch(Request $request)
//     {
//         $term = $request->input('term');

//         $results = Recipe::where('name', 'like', '%' . $term . '%')
//             ->orWhere('description', 'like', '%' . $term . '%')
//             ->pluck('name');

//         return response()->json($results);
//     }
// }

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $recipes_query = Recipe::query();

        $search_param = $request->query('q');

        if ($search_param) {
            $recipes_query = Recipe::search($search_param);
        }

        $recipes = $recipes_query->get();

        return view('User.recipes.search', compact('recipes', 'search_param'));
    }

    public function autocompleteSearch(Request $request)
    {
        $term = $request->input('term');

        $recipes = Recipe::where('name', 'like', '%' . $term . '%')
            ->orWhere('description', 'like', '%' . $term . '%')
            ->pluck('name');

        return response()->json($recipes);
    }
}
