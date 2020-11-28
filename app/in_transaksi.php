<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class in_transaksi extends Model
{
    // deklare table
    protected $table = 'in_transaksis';
    // deklare guarded table
    protected $guarded = [];


    // relations with transaksi
    public function barangs(){
        return $this->belongsTo('App\Barang', 'kd_barang');
    }

}
