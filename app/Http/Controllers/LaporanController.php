<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\in_transaksi;
use App\Invoice;

class LaporanController extends Controller
{
    //
    public function index(){
        return view('laporan.index');
    }

    public function laporan($to,$from){
        //return response()->json('berhasil');
        $data=[$to,$from];
        $datalaporan = Invoice::whereBetween('tanggal', [$data[0],$data[1]])->with('customers')->get();
        return response()->json($datalaporan);
    }
    public function cetak($to,$from){
        //return response()->json('berhasil');
        $data=[$to,$from];
        $datalaporan = Invoice::whereBetween('tanggal', [$data[0],$data[1]])->with('customers')->get();
        return response()->json($datalaporan);
    }
}
