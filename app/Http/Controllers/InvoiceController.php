<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\DelveryOrder;
use App\do_transaksi;


class InvoiceController extends Controller
{
    //index controller
    public function index(){
        // get pengkodean
        $kdsekarang = Invoice::get()->count();
        if($kdsekarang <= 0){
            $kode = 0;
        }else{
            $inv = Invoice::orderBy('kd_in', 'desc')->first();
            $kodeinv = \substr($inv['kd_in'], -3);
            $kode = intval($kodeinv);
        }
        // get data DO
        $delveryorder = DelveryOrder::with('salesorder')->get();
        // return response()->json($delveryorder);
        // die;
        return view('transaksi.inv.index',[
            'kode' => $kode,
            'delveryorder' => $delveryorder
        ]);
    }

    // function get do info
    public function diInfo($kd_do){
        $doInfo = DelveryOrder::with('salesorder', 'customers')->find($kd_do);
        return response()->json($doInfo);
    }

    // function to get transaksi
    public function dtrInfo($kd_do){
        $trDo = do_transaksi::where('kd_do',$kd_do)->with('barang')->get();
        return response()->json($trDo);
    }
}
