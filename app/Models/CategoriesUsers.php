<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriesUsers extends Model
{
    protected $fillable = ['category_id', 'user_id'];
}
