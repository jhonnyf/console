<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'sku',
        'weight',
        'width',
        'height',
        'length',
        'stock',
        'combo_code',
        'release_date',
        'expiration_date',
    ];

    public function contents()
    {
        return $this->hasMany(ContentsProducts::class);
    }

    public function prices()
    {
        return $this->hasMany(ProductsPrices::class);
    }

    public function files()
    {
        return $this->belongsToMany(Files::class, 'links_products_files')->withTimestamps()->with('fileGallery');
    }
}
