<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $table = 'ingredients';
  
    protected $fillable = [
        'name', 
        'description', 
        'image',
        'quantity', 
        'price', 
        'ingredient_category_id'
    ];

    public function category()
    {
        return $this->belongsTo(IngredientsCategory::class, 'ingredient_category_id');
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'ingredient_recipe', 'ingredient_id', 'recipe_id');
    }
    
}

