<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    //
    protected $fillable = [
        'customer_name', 'customer_address', 'customer_mobile','user_create','user_last_update'
    ];
}
