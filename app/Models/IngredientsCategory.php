<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientsCategory extends Model
{
    use HasFactory;

    protected $fillable = ['ingredient_category_id','name','description','image','quantity','price'];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
