<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cities extends Model
{
    protected $fillable = [
        'city_name','user_create','user_last_update'
    ];
}
