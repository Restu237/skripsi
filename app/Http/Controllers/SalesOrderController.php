<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;
USE App\Barang;
use App\Customer;


class SalesOrderController extends Controller
{
    // public function 
    public function index(){
        $kdsekarang = Barang::get()->count();
        if($kdsekarang <= 0){
            $kode = 0;
        }else{
            $so = SalesOrder::orderBy('kd_so', 'desc')->first();
            $kodeso = \substr($so['kd_so'], -3);
            $kode = intval($kodeso); 
        }

        $customers = Customer::get();
        return \view('transaksi.so.index', [
            'kode' => $kode,
            'customers' => $customers
        ]);
    }

    public function customerInfo($kd_kstmr){
        $customersDetail = Customer::find($kd_kstmr);
        // dd($customersDetail);
        // die;
        return \response(\json_encode(\json_decode($customersDetail)));
    }
}