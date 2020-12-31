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
}
