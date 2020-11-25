<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use App\DelveryOrder;
use App\SalesOrder;
use App\so_transaksi;
use App\do_transaksi;



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
        $transaksiDO = DelveryOrder::with('customers')->get();
        // return response()->json($transaksiDO, 200);
        // die;
        return view('transaksi.do.index',[
            'kode' => $kode,
            'salesorder' => $salesorder,
            'transaksiDO' => $transaksiDO
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

    // create function
    public function create(Request $create){
        $data = $create->all();
        // dd($data['kd_do']);
        // return response()->json($data, 200);
        // die;
        $new = new DelveryOrder();
        $new->kd_do = $data['kd_do'];
        $new->kd_so = $data['kd_so'];
        $new->kd_kstmr = $data['kd_kstmr'];
        $new->user_id = $data['user_id'];
        $new->tanggal = $data['tanggal'];
        $new->keterangan = $data['keterangan'];
        $new->total_qty = $data['total_qty'];
        $new->save();

        for ($i=0; $i < count($create->kd_barang) ; $i++) {
            DB::table('do_transaksi')->insert([
                'kd_do' => $data['kd_do'],
                'kd_barang' => $create->kd_barang[$i],
                'qty' => $create->qty[$i],
            ]);
        }
        return redirect()->back()->with('sukses', 'Berhasil Membuat Delivery Order');
    }
}
