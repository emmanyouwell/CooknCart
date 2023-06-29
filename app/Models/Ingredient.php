<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $primaryKey = 'ingredient_id';
    // relatiionship nila yieeeee
    protected $fillable = [
        'name',
        'image',
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients', 'ingredient_id', 'recipe_id')
            ->withPivot('quantity', 'measurement_unit');
    }
}

