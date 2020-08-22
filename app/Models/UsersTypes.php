<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersTypes extends Model
{
    protected $fillable = ['user_type'];

    public function getTableColumns()
    {
        return $this->getConnection()
            ->getSchemaBuilder()
            ->getColumnListing($this->getTable());
    }
}
