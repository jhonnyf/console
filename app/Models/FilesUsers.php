<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilesUsers extends Model
{
    protected $fillable = ['files_id', 'users_id'];
}
