<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('wishlist', compact('wishlist'));
    }

    public function add(Request $request)
    {
       if(Auth::check())
       {
        $ingredient_id = $request->input('ingredient_id');
        if(Ingredient::find($ingredient_id))
        {
            $wish = new Wishlist();
            $wish->ingredient_id = $ingredient_id;
            $wish->user_id = Auth::id();
            $wish->save();
            return response()->json(['status' => "Product added to wishlist"]);

        }
        else{
            return response()->json(['status' => "Product does not exist"]);
        }

       }
       else{
        return response()->json(['status'=>"Login to Continue"]);

       }
    }

    public function deleteitem(Request $request)
    {
        if (Auth::check()) {
            $ingredient_id = $request->input('ingredient_id');
            if (Wishlist::where('ingredient_id', $ingredient_id)->where('user_id', Auth::id())->exists()) {
                $wish = Wishlist::where('ingredient_id', $ingredient_id)->where('user_id', Auth::id())->first();
                $wish->delete();
                return response()->json(['status' => "Item Removed from Wishlist"]);
            }
            return response()->json(['status' => "Product not found"]);
        } else {
            return response()->json(['status' => "Login to continue"]);
        }
    }

    public function wishlistcount()
    {
        $wishcount = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count'=>$wishcount]);
    }
}
