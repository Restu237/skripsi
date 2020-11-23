<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use App\DelveryOrder;
use App\SalesOrder;
use App\so_transaksi;



class DeliveryOrderController extends Controller
{
    // index function
    public function index(){
        $kdsekarang = DelveryOrder::get()->count();
        if($kdsekarang <= 0){
            $kode = 0;
        }else{
            $do = DelveryOrder::orderBy('kd_do', 'desc')->first();
            $kodedo = \substr($do['kd_do'], -3);
            $kode = intval($kodedo);
        }
        $salesorder = SalesOrder::get();
        return view('transaksi.do.index',[
            'kode' => $kode,
            'salesorder' => $salesorder
        ]);
    }

    // get so data function
    public function sodata($kd_so){
        $soInfo = SalesOrder::with('customer')->findOrFail($kd_so);
        return \response(\json_encode(\json_decode($soInfo)));
    }

    // get tr so data function
    public function sotrdata($kd_so){
        $sotransaksi = so_transaksi::where('kd_so', $kd_so)->with('barang')->get();
        return \response(\json_encode(\json_decode($sotransaksi)));
    }
}
