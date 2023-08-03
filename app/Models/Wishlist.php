<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlists';
    protected $fillable =[
        'user_id',
        'ingredient_id',
    ];

    public function ingredient(){
        return $this->belongsTo(Ingredient::class,'ingredient_id','id');
    }
}
