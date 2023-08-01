<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $fillable = [
        'user_id',
        'ingredient_id',
        'ingrdient_quantity',
    ];

    public function products(){
        return $this->belongsTo(Product::class,'ingredient_id','ingredient_quantity');
    }
}
