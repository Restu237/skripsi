<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    //deklare table 
    protected $table = "sales_order";

    // Guarded table
    protected $guarded = [];
}
