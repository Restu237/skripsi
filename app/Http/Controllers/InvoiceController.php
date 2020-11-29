<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\DelveryOrder;
use App\do_transaksi;
use App\in_transaksi;
use DB;


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
        $invoicelist = Invoice::with('delveryorder', 'customers')->get();
        // return response()->json($invoicelist);
        // die;
        return view('transaksi.inv.index',[
            'kode' => $kode,
            'delveryorder' => $delveryorder,
            'invoicelist' => $invoicelist
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

    // function create
    public function create(Request $create){
        $data = $create->all();
        // return response()->json($data);
        // die;
        $buat = new Invoice();
        $buat->kd_in = $data['kd_in'];
        $buat->kd_kstmr = $data['kd_kstmr'];
        $buat->kd_so = $data['kd_so'];
        $buat->kd_do = $data['kd_do'];
        $buat->ppn = $data['ppn'];
        $buat->tanggal = $data['tanggal'];
        $buat->diskon = $data['diskon'];
        $buat->total = $data['total'];
        $buat->grand_total = $data['grand_total'];
        $buat->save();

        for($i=0; $i < count($create->kd_barang); $i++){
            DB::table('in_transaksis')->insert([
                'kd_in' => $data['kd_in'],
                'kd_barang' => $create->kd_barang[$i],
                'qty' => $create->qty[$i],
                'amount' => $create->amount[$i],
            ]);
        }
        return redirect()->back()->with('sukses', 'Berhasil Membuat Invoice');
    }

    public function edit(Request $update, $kd_in = null){
        $data = Invoice::find($kd_in);
        $transaksi = in_transaksi::where('kd_in', $kd_in)->with('barangs')->get();
        // return response()->json($transaksi);
        // die;
        return view('transaksi.inv.update',[
            'data' => $data,
            'transaksi' => $transaksi
        ]);
    }

    public function delete($kd_in){
        $transaksi = in_transaksi::where('kd_in', $kd_in)->delete();
        $invoice = Invoice::find($kd_in);
        $invoice->delete();
        return redirect('/home/transaksi/invoice')->with('sukses', 'Berhasil Membatalkan Invoices');
    }

    public function cetak($kd_in){
        $data = Invoice::with('customers')->find($kd_in);
        $transaksiin = in_transaksi::where('kd_in', $kd_in)->with('barangs')->get();
        //return response()->json($data);
        //return response()->json($transaksiin);
        return view('transaksi.inv.cetak',[
            'data' => $data,
            'transaksiin' => $transaksiin
        ]);
    }
}
