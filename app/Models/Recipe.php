<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'instruction',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_recipe', 'recipe_id', 'ingredient_id');
    }
    
}
