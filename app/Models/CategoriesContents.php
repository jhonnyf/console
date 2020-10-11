<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriesContents extends Model
{
    protected $fillable = ['category_id', 'content_id'];
}
