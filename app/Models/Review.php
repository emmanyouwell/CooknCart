<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table ='ratings';
    protected $fillable =[
        'user_id',
        'recipe_id',
        'user_review'

    ];
}
