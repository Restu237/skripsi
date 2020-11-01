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
}
