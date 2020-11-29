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

    // update
    public function update(Request $update, $kd_do = null){
       if($update->isMethod('PUT')){
           for ($i=0; $i < count($update->id) ; $i++) {
               # code...
               DB::table('do_transaksi')->where('id', $update->id[$i])->update([
                'qty' => $update->qty[$i],
               ]);
           }
        return redirect()->back()->with('sukses', 'Berhasil Memperbaharui Delivery Order');


       }
       $data = DelveryOrder::find($kd_do);
       $transaksiDO = do_transaksi::where('kd_do', $kd_do)->with('barang')->get();
       return view('transaksi.do.update',[
           'data' => $data,
           'transaksiDO' => $transaksiDO
       ]);
    }

    // delete function
    public function delete($kd_do){
        $delete = DelveryOrder::find($kd_do);
        $transaksiDO = do_transaksi::where('kd_do', $kd_do)->delete();
        // return response()->json($delete, 200);
        // die;
        // $delete->transaksido->delete();
        $delete->delete();
        return redirect('/home/transaksi/do')->with('sukses', 'Berhasil Menghapus DO!');
    }

    public function cetak($kd_do){
        $data = DelveryOrder::with('customers')->find($kd_do);
        $transaksido = do_transaksi::where('kd_do', $kd_do)->with('barang')->get();
        //return response()->json($data);
        //return response()->json($transaksido);
        return view('transaksi.do.cetak',[
            'data' => $data,
            'transaksido' => $transaksido
        ]);
    }
}
