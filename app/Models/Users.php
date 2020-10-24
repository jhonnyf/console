<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Users extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'document', 'phone', 'cellphone'];
    protected $hidden   = ['password'];

    public function category()
    {
        return $this->belongsToMany(Categories::class, 'categories_users', 'user_id', 'category_id');
    }
}
