<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    //deklare table
    protected $table = "sales_order";

    // Guarded table
    protected $guarded = [];
    protected $primaryKey = 'kd_so';
    public $incrementing = false;
    protected $keyType = 'string';


    // relations with so transaksi
    public function transaksiso(){
        return $this->hasMany('App\so_transaksi', 'id');
    }
    // relations with customer
    public function customer(){
        return $this->belongsTo('App\Customer', 'kd_kstmr');
    }

    // relations with do
    public function delveryorder(){
        return $this->hasOne('App\DelveryOrder', 'kd_do');
    }
}
