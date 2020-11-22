<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SalesOrder;
USE App\Barang;
use App\Customer;
use App\so_transaksi;
use DB;
use Session;


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
        $barangs = Barang::get();
        $transaksiSo = SalesOrder::all();

        $customers = Customer::get();
        return \view('transaksi.so.index', [
            'kode' => $kode,
            'customers' => $customers,
            'barangs' => $barangs,
            'transaksiSo' => $transaksiSo,
        ]);
    }

    public function customerInfo($kd_kstmr){
        $customersDetail = Customer::find($kd_kstmr);
        // dd($customersDetail);
        // die;
        return \response(\json_encode(\json_decode($customersDetail)));
    }

    public function barangInfo($kd_barang){
        $barangDetail = Barang::find($kd_barang);
        return \response(\json_encode(\json_decode($barangDetail)));
    }

    public function create(Request $request){
        $data = $request->all();
        // dd($data);
        // die;
        $create = new SalesOrder();
        $create->kd_so = $data['kd_so'];
        $create->kd_kstmr = $data['kd_kstmr'];
        $create->tanggal = $data['tanggal'];
        $create->save();


        // dataset
        $kode_barang1 = [];
        foreach($request->get('kd_barang') as $kode_barang){
            $kode_barang1[] =[
                'kd_so' => $data['kd_so'],
                'kd_kstmr' => $data['kd_kstmr'],
                'kd_barang' => $kode_barang,
                'jumlah_qty' => $data['jumlah_qty'],
            ];
        }
        DB::table('so_transaksi')->insert($kode_barang1);
        // so_transaksi::insert([$kode_barang1]);
        // dd($kode_barang1);
        return redirect()->back()->with('sukses', 'Berhasil Membuat Sales Order Baru!');
    }

    public function update(Request $update, $kd_so = null){
        if($update->isMethod('PUT')){
            $data = $update->all();
            $transaksi = so_transaksi::where('kd_so', $kd_so)->get();
            for ($i=0; $i<count($update->id); $i++){
                DB::table('so_transaksi')->where('id', $update->id[$i])->update([
                    // 'kd_so' => $update->kd_so[$i],
                    // 'kd_kstmr' => $update->kd_kstmr[$i],
                    'kd_barang' => $update->kd_barang[$i],
                    'jumlah_qty' => $update->jumlah_qty[$i],
                ]);
            }
        return redirect()->back()->with('sukses', 'Berhasil Membuat Edit SO!');
    }


        $update = SalesOrder::find($kd_so);
        $barangs = Barang::get();
        $transaksi = so_transaksi::where('kd_so', $kd_so)->get();
        //dd($idTransaksi);
        return view('transaksi.so.update',[
            'update' => $update,
            'barangs' => $barangs,
            'transaksi' => $transaksi
        ]);
    }

    public function editTrksi(Request $update, $id = null){
        $data = $update->all();
        return response()->json($data);
    }

    public function delete($kd_so){
        $delete = SalesOrder::find($kd_so);
        $delete->transaksiso()->delete();
        $delete->delete();
        return redirect('/home/transaksi/so')->with('sukses', 'Berhasil Menghapus SO!');
    }
}
