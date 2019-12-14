<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bills extends Model
{
    //
    protected $fillable = [
        'vehicle_number', 'vehicle_type','user_create','user_last_update'
    ];


    public function driver()
    {
        return $this->belongsTo('App\drivers');
    }
}
