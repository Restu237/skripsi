<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class do_transaksi extends Model
{
    // deklare table
    protected $table = "do_transaksi";

    // deklare guarded table
    protected $guarded = [];

    // relation with DelveryOrder
    public function delveryorder(){
        return $this->belongsTo('App\DelveryOrder', 'kd_do');
    }

    // relations to baranag
    public function barang(){
        return $this->belongsTo('App\Barang', 'kd_barang');
    }
}
