<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addIngredient(Request $request)
    {
        $ingredient_id = $request->input('ingredient_id');
        $ingredient_quantity = $request->input('ingredient_quantity');

        if (Auth::check()) {
            $ingredient = Ingredient::find($ingredient_id);

            if (!$ingredient) {
                return response()->json(['status' => 'Product not found']);
            }

            $cartItem = Cart::where('ingredient_id', $ingredient_id)->where('user_id', Auth::id())->first();
            if ($cartItem) {
                $cartItem->ingredient_quantity += $ingredient_quantity;
                $cartItem->save();
                return response()->json(['status' => $ingredient->name . " quantity updated in cart"]);
            } else {
                $cartItem = new Cart();
                $cartItem->ingredient_id = $ingredient_id;
                $cartItem->user_id = Auth::id();
                $cartItem->ingredient_quantity = $ingredient_quantity;
                $cartItem->save();
                return response()->json(['status' => $ingredient->name . " added to cart"]);
            }
        } else {
            return response()->json(['status' => "Login to continue"]);
        }
    }

    
    public function viewcart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        return view('cart', compact('cartItems'));
    }

    public function updatecart(Request $request)
    {
        $ingredient_id = $request->input('ingredient_id');
        $ingredient_quantity = $request->input('ingredient_quantity');

        if (Auth::check()) {
            if (Cart::where('ingredient_id', $ingredient_id)->where('user_id', Auth::id())->exists()) {
                $cartItem = Cart::where('ingredient_id', $ingredient_id)->where('user_id', Auth::id())->first();
                $cartItem->ingredient_quantity = $ingredient_quantity;
                $cartItem->update();
                return response()->json(['status' => "Quantity Updated"]);
            }
        }
    }

    public function deleteingredient(Request $request)
    {
        if (Auth::check()) {
            $ingredient_id = $request->input('ingredient_id');
            if (Cart::where('ingredient_id', $ingredient_id)->where('user_id', Auth::id())->exists()) {
                $cartItems = Cart::where('ingredient_id', $ingredient_id)->where('user_id', Auth::id())->first();
                $cartItems->delete();
                return response()->json(['status' => "Product deleted successfully"]);
            }
            return response()->json(['status' => "Product not found"]);
        } else {
            return response()->json(['status' => "Login to continue"]);
        }
    }

    public function cartcount()
    {
        $cartcount = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $cartcount]);
    }
}
