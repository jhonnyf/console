<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['name'];

    public function categoryPrimary()
    {
        return $this->belongsToMany(Categories::class, 'categories_categories', 'secondary_id', 'primary_id');
    }

    public function categorySecondary()
    {
        return $this->belongsToMany(Categories::class, 'categories_categories', 'primary_id', 'secondary_id');
    }
}
