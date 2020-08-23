<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = ['user_type_id', 'name', 'email', 'password', 'document', 'phone', 'cellphone'];
    protected $hidden   = ['password'];
}
