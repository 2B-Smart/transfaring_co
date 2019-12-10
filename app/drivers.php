<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class drivers extends Model
{
    //
    protected $fillable = [
        'full_name', 'national_id_number', 'mobile_number','user_create','user_last_update'
    ];
}
