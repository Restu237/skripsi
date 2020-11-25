<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // deklare table
    protected $primaryKey = 'kd_kstmr';
    protected $table = 'customers';
    public $incrementing = false;

    protected $guarded = [];

    // relasi
    public function salesorder(){
        return $this->hasMany('App/SalesOrder', 'kd_so');
    }

    // public function salesorder(){
    //     return $this->belongsTo('App/SalesOrder');
    // }
    // relasi
    public function deliveryorder(){
        return $this->hasMany('App/DelveryOrder', 'kd_do');
    }
}
