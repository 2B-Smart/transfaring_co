<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bills extends Model
{
    //
    protected $fillable = [
        'bill_date','source_city','destination_city','driver_id','v_number', 'has_done','user_create','user_last_update'
    ];


    public function driver()
    {
        return $this->belongsTo('App\drivers');
    }
    public function car()
    {
        return $this->belongsTo('App\cars','v_number','vehicle_number');
    }

    /**
     * Get the receipts for the blog post.
     */
    public function receipts()
    {
        return $this->hasMany('App\receipts','bill_id');
    }
}
