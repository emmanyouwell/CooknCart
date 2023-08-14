<?php

namespace App\Http\Controllers;
use App\Models\Recipe;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    public function add(Request $request) {
        $user_review = $request->input('user_review');
        $recipe_id = $request->input('recipe_id');
    
        $recipe = Recipe::find($recipe_id);
    
        if ($recipe) {
            // Create a new review
            $newReview = new Review();
            $newReview->user_id = Auth::id();
            $newReview->recipe_id = $recipe_id;
            $newReview->user_review = $user_review;
            $newReview->save();
    
            return redirect()->back()->with('success', 'Review added successfully');
        }
    
        return redirect()->back()->with('error', 'Recipe not found');
    }
    
    public function edit(Request $request, $id) {
        $user_review = $request->input('user_review');
    
        $review = Review::find($id);
    
        if (!$review) {
            return redirect()->back()->with('error', 'Review not found');
        }
    
        $review->user_review = $user_review;
        $review->save();
    
        return redirect()->back()->with('success', 'Review updated successfully');
    }
    
    public function delete($id) {
        $review = Review::find($id);
    
        if (!$review) {
            return redirect()->back()->with('error', 'Review not found');
        }
    
        $review->delete();
    
        return redirect()->back()->with('success', 'Review deleted successfully');
    }
    
}
