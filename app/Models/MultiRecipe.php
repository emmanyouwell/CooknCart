<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiRecipe extends Model
{
    use HasFactory;
    protected $table =  'recipe_image';
    protected $fillable = [
        'recipe_id',
        'image',
    ];
    // protected $guarded = [];
}
