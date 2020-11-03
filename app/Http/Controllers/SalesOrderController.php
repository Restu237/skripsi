<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesOrderController extends Controller
{
    // public function 
    public function index(){
        return \view('transaksi.so.index');
    }
}
