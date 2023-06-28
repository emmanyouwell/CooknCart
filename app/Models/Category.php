<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';
    // relatiionship nila yieeeee
    protected $fillable = [
        'name', 
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_categories', 'category_id', 'recipe_id');
    }
}

