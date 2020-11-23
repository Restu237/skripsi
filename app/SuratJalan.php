<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    // deklare table
    protected $table = "surat_jalan";

    // guarded table
    protected $guarded = [];
    // deklare primaryKey
    protected $primaryKey = 'kd_do';
    // incrementing
    protected $incrementing = false;
    // key type
    protected $keyType = 'string';

    // relation
    public function salesorrder(){
        return $this->hasOne('App\SalesOrder', 'kd_so');
    }

    // relation transaksi so
    public function transaksiso(){
        return $this->hasMany('App\SalesOrder', 'id');
    }
}
