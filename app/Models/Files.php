<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{

    protected $fillable = ['file_gallery_id', 'file_path', 'original_name', 'extension', 'size', 'mime_type'];

    public function categoryFiles()
    {
        return $this->belongsToMany(Categories::class)->withTimestamps();
    }

    public function userFiles()
    {
        return $this->belongsToMany(Users::class)->withTimestamps();
    }

    public function contentFiles()
    {
        return $this->belongsToMany(Contents::class)->withTimestamps();
    }

    public function fileGallery()
    {
        return $this->belongsTo(FilesGalleries::class);
    }

    public function contentFile()
    {
        return $this->hasMany(ContentsFiles::class);
    }
}
