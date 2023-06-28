<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $primaryKey = 'recipe_id';

    protected $fillable = [
        'title',
        'ingredients',
        'instructions',
        'image',
        'user_id', 
    ];

    // relatiionship nila yieeeee
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'recipe_categories', 'recipe_id', 'category_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients', 'recipe_id', 'ingredient_id')
            ->withPivot('quantity', 'measurement_unit');
    }
}
