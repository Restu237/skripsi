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
}
