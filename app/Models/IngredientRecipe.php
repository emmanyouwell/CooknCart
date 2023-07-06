<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientRecipe extends Model
{
    protected $fillable = [
      'recipe_id',
      'ingredient_id',
    ];

    public function Ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}