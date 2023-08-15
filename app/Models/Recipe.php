<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Spatie\Searchable\Searchable;
// use Spatie\Searchable\SearchResult;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;

class Recipe extends Model
{
    use Searchable;
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'preptime',
        'cooktime',
        'servings',
        'instruction',
        'image',
        'tags',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'recipe_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'recipe_id');
    }

    public function toSearchablearray()
    {
        return[
            'name'=> $this->name,
            'description'=> $this->description
        ];
    }
}
