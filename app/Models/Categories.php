<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['category'];


    public function users()
    {
        return $this->belongsToMany(Users::class)->withTimestamps();
    }

    public function contents()
    {
        return $this->hasMany(ContentsCategories::class);
    }

    public function files()
    {
        return $this->belongsToMany(Files::class)->withTimestamps()->with('fileGallery');
    }

    public function contentsCategory()
    {
        return $this->belongsToMany(Contents::class)->withTimestamps();
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
