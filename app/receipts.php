<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class receipts extends Model
{
    //
    protected $fillable = [
        'receiptNo',
        'sender',
        'receiver',
        'source_city',
        'destination_city',
        'receipts_date',
        'number_of_packages',
        'package_type',
        'contents',
        'weight',
        'size',
        'marks',
        'notes',
        'prepaid',
        'collect_from_receiver',
        'prepaid_miscellaneous',
        'trans_miscellaneous',
        'remittances',
        'remittances_paid',
        'paid_date',
        'voucher_no',
        'received_name',
        'received_address',
        'received_mobile',
        'received_date',
        'discount',
        'bill_id',
        'user_create',
        'user_last_update'
    ];
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
    public function bill()
    {
        return $this->belongsTo('App\bills','bill_id','id');
    }
}
