<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\MultiRecipe;
use App\Models\MultiIngredients;
use Auth;

class ProfileController extends Controller
{
    public function profile(){
        $id = Auth::user()->id;
        $user = User::find($id);
        $recipes = Recipe::where('user_id',$id)->get();
        return view('user.profile.profile', compact('user','recipes'));
    }

    public function saveImage(Request $request){
        $user = User::find(Auth::user()->id);
        if($request->file()) {

            $image = $request->file('image');
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $uploadPath = 'image/dp/';
            $url = $uploadPath.$fileName;
            $image->move($uploadPath,$fileName);
        }
        $user->image = $url;
        $user->save();
        return redirect()->route('user.profile')->with('success','Image saved.');
    }
}
