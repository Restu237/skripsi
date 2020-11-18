<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class so_transaksi extends Model
{
    //deklare table 
    protected $table = 'so_transaksi';

    protected $guarded = [];

    public function so_transaksi(){
        return $this->belongsTo('App\SalesOrder');
    }
}
