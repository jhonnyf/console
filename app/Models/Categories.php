<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['category'];

    public function content()
    {
        return $this->hasMany(ContentsCategories::class);
    }

    public function files()
    {
        return $this->belongsToMany(Files::class)->with('fileGallery');
    }

    public function categoryPrimary()
    {
        return $this->belongsToMany(Categories::class, 'categories_categories', 'secondary_id', 'primary_id')->withTimestamps()->where('active', '<>', 2);
    }

    public function categorySecondary()
    {
        return $this->belongsToMany(Categories::class, 'categories_categories', 'primary_id', 'secondary_id')->withTimestamps()->where('active', '<>', 2);
    }
}
