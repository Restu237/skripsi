<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;
use App\Customer;
USE App\Barang;

class MasterController extends Controller
{
    // Index Method 
    public function index(){
        return view('master.index');
    }

    // Master User Method 
    public function masterUser(Request $createuser){
        if($createuser->isMethod('POST')){
            $save = $createuser->all();
            $databaru = new User;
            $databaru->name = $save['name'];
            $databaru->email = $save['email'];
            $databaru->password =  Hash::make($save['password']);
            $databaru->save();
            return \redirect()->back()->with('sukses', 'Berhasil Menambhkan User');
        }
        $user = User::get();
        $customers = Customer::get();
        return view('master.user.index',[
            'user' => $user,
            'customers' => $customers,
        ]);
       // dd($user->name);
    }

    // Update User menunggu Master Cutomer Beres
    public function updateUser(Request $update, $id=null){
        $data = $update->all();
        // return response()->json($data);
        $updateData = User::find($id);
        $updateData->kd_kstmr = $data['kd_kstmr'];
        $updateData->name = $data['name'];
        $updateData->email = $data['email'];
        $updateData->password =  Hash::make($data['password']);
        $updateData->save();
        return \redirect()->back()->with('sukses', 'Berhasil Memperbharui User');
    }

    // Delete User
    public function delete($id){
        $delete = User::find($id);
        $delete->delete();
        return \redirect()->back()->with('sukses', 'Berhasil Menghapus');
    }


    // Master Customers
    public function masterCustomers(Request $request){
        if($request->isMethod('POST')){
            $data = $request->all();
            // dd($data);
            // die; 
            $create = new Customer;
            $create->kd_kstmr = $data['kd_kstmr'];
            $create->nama_perusahaan = $data['nama_perusahaan'];
            $create->telepon = $data['telepon'];
            $create->alamat = $data['alamat'];
            $create->contact_person = $data['contact_person'];
            $create->handphone = $data['handphone'];
            $create->save();
            return \redirect()->back()->with('sukses', 'Berhasil Menambhkan Customers');
        }
        //$data = Customer::get();
        $customer = Customer::orderBy('kd_kstmr','desc')->first();
        $kdcustomer = \substr($customer->kd_kstmr, -3);
        $kdsekarang = intval($kdcustomer); 
        $datakstmr = Customer::get();      
       // return response()->json($kdsekarang);
        return \view('master.customers.index',[
            'kdsekarang' => $kdsekarang,
            'datakstmr' => $datakstmr
        ]);
    }

    // Update Customers
    public function updateCustomers(Request $request,$kd_kstmr = null){
        $data = $request->all();
        $update = Customer::where('kd_kstmr', $kd_kstmr)->first();
        // return response()->json($data);
        //dd($data);
        // die;
        $update->kd_kstmr = $data['kd_kstmr'];
        $update->nama_perusahaan = $data['nama_perusahaan'];
        $update->telepon = $data['telepon'];
        $update->alamat = $data['alamat'];
        $update->contact_person = $data['contact_person'];
        $update->handphone = $data['handphone'];
        $update->save();
        return \redirect()->back()->with('sukses', 'Berhasil Memperbaharui Data Customers');
    }

    // delete cust
    public function delCustomers($kd_kstmr){
        $data = Customer::where('kd_kstmr', $kd_kstmr)->first();
        $data->delete();
        return \redirect()->back()->with('sukses', 'Data Berhasil Di Hapus');
    }


    // Mater Barang 
    public function masterbarangIndex(Request $create){
        if($create->isMethod('POST')){
            $data = $create->all();
            return response()->json($data);
        }
         //$data = Customer::get();
         $barang = Barang::orderBy('kd_barang','desc')->first();
         $kdbarang = \substr($barang->kd_barang, -3);
         $kdsekarang = intval($kdbarang); 
         $databrg = Barang::get();      
         //return response()->json($kdsekarang);
         return view('master.barang.index', [
             'kdsekarang' => $kdsekarang,
             'databrg' => $databrg,
         ]);
    }
}
