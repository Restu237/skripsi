<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // deklare table
    protected $primaryKey = 'kd_barang';
    protected $table = 'barang';
    public $incrementing = false;

    protected $guarded = [];

    public function sotransaksi(){
        return $this.hasMany('App\so_transaksi', 'id');
    }

    public function dotransaksi(){
        return $this.hasMany('App\do_transaksi', 'id');
    }

    public function intransaksi(){
        return $this.hasMany('App\in_transaksi', 'id');
    }

}
