<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{

    protected $fillable = ['file_gallery_id', 'file_path', 'original_name', 'extension', 'size', 'mime_type'];

    public function categoriesFile()
    {
        return $this->belongsToMany(Categories::class)->withTimestamps();
    }

    public function usersFile()
    {
        return $this->belongsToMany(Users::class)->withTimestamps();
    }

    public function contentsFile()
    {
        return $this->belongsToMany(Contents::class, 'files_contents')->withTimestamps();
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
