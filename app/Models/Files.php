<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{

    protected $fillable = ['file_gallery_id', 'file_path', 'original_name', 'extension', 'size', 'mime_type'];

    public function categoriesFile()
    {
        return $this->belongsToMany(Categories::class, 'links_categories_files')->withTimestamps();
    }

    public function usersFile()
    {
        return $this->belongsToMany(Users::class, 'links_files_users')->withTimestamps();
    }

    public function contentsFile()
    {
        return $this->belongsToMany(Contents::class, 'links_files_contents')->withTimestamps();
    }

    public function fileGallery()
    {
        return $this->belongsTo(FilesGalleries::class);
    }

    public function contents()
    {
        return $this->hasMany(ContentsFiles::class);
    }
}
