<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $primaryKey = 'id';
  
    protected $fillable = [
        'name', 
        'description', 
        'image',
        'quantity', 
        'price', 
        'ingredient_category_id'
    ];

    public function IngredientCategories()
{
    return $this->belongsTo(IngredientCategory::class, 'ingredient_category_id','id');
}


    public function recipes()
{
    return $this->belongsToMany(Recipe::class, 'ingredient_recipe', 'ingredient_id', 'recipe_id');
}
    
}

