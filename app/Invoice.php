<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    // protected tbale
    protected $table = "invoices";
    protected $guarded = [];

    // deklare primarykey
    protected $primaryKey = 'kd_in';

    // off incrementing
    public $incrementing = false;

    // deklare keytype
    protected $keyType = 'string';

    // deklare relation with delivery order
    public function delveryorder(){
        return $this->belongsTo('App\DelveryOrder', 'kd_do');
    }

    // customer
    public function customers(){
        return $this->belongsTo('App\Customer', 'kd_kstmr');
    }

    //

}
