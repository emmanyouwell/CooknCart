<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Recipe;
use App\Models\Order; // Add this line to import the Order model
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
}
