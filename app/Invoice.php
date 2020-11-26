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

}
