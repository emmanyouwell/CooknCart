<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function add(Request $request) {
        $stars_rated = $request->input('stars_rated');
        $recipe_id = $request->input('recipe_id');
    
        $recipe = Recipe::find($recipe_id);
    
        if ($recipe) {
            $existingRating = Rating::where('recipe_id', $recipe_id)
                                    ->where('user_id', Auth::id())
                                    ->first();
    
            if ($existingRating) {
                // Rating already exists, update it
                $existingRating->stars_rated = $stars_rated;
                $existingRating->save();
                return redirect()->back()->with('success', 'Rating updated successfully');
            }
    
            // Create a new rating
            $newRating = new Rating();
            $newRating->user_id = Auth::id();
            $newRating->recipe_id = $recipe_id;
            $newRating->stars_rated = $stars_rated;
            $newRating->save();
    
            return redirect()->back()->with('success', 'Rating added successfully');
        }
    
        return redirect()->back()->with('error', 'Recipe not found');
    }
}
