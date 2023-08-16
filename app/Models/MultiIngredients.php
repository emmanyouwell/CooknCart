<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiIngredients extends Model
{
    use HasFactory;
    protected $table = 'ingredient_image';
    protected $fillable = [
        'ingredient_id',
        'image',
    ];
}
