<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    //deklare table 
    protected $table = "sales_order";

    // Guarded table
    protected $guarded = [];

    // relations
    public function transaksi_so(){
        return $this->hasMany('App\so_transaksi');
    }

    // public function customer(){
    //     return $this->hasOne('App\Customer');
    // }
    public function customer(){
        return $this->belongsTo('App\Customer', 'kd_kstmr');
    }
}
