<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class so_transaksi extends Model
{
    //deklare table
    protected $table = 'so_transaksi';

    protected $guarded = [];

    protected $primaryKey = 'id';

    public function salesorder(){
        return $this->belongsTo('App\SalesOrder', 'kd_so');
    }

    public function barang(){
        return $this->belongsTo('App\Barang', 'kd_barang');
    }
}
