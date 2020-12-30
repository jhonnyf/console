<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    protected $fillable = ['slug', 'date', 'title', 'subtitle', 'content', 'link', 'video'];

    public function files()
    {
        return $this->belongsToMany(Files::class, 'links_files_contents')->withTimestamps()->with('fileGallery');
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'links_categories_contents')->withTimestamps();
    }
}
