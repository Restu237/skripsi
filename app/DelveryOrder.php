<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DelveryOrder extends Model
{
    // deklare gable
    protected $table = "delvery_orders";

    // guarded table
    protected $guarded = [];

    // deklare primarykey
    protected $primaryKey = 'kd_do';

    // off incrementing
    public $incrementing = false;

    // deklare keytype
    protected $keyType = 'string';

    // relations so
    public function transaksido(){
        return $this->hasMany('App\do_transaksi', 'id');
    }

    // realations with  so table
    public function salesorder(){
        return $this->belongsTo('App\SalesOrder', 'kd_so');
    }
}
