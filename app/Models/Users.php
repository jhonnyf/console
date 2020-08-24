<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Users extends Model
{
    protected $fillable = ['user_type_id', 'name', 'email', 'password', 'document', 'phone', 'cellphone'];
    protected $hidden   = ['password'];

    public function userType()
    {
        return $this->belongsTo(UsersTypes::class);
    }
}
