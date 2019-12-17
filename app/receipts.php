<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receipts extends Model
{
    //
    //get sender data
    public function customer_sender()
    {
        return $this->belongsTo('App\customers','sender','id');
    }
    //get receiver data
    public function customer_receiver()
    {
        return $this->belongsTo('App\customers','receiver','id');
    }
}
