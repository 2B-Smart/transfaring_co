<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cars extends Model
{
    //
    protected $fillable = [
        'vehicle_number', 'vehicle_type','user_create','user_last_update'
    ];
}
