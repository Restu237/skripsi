<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;

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
        return view('master.user.index',[
            'user' => $user
        ]);
       // dd($user->name);
    }

    public function delete($id){
        $delete = User::find($id);
        $delete->delete();
        return \redirect()->back()->with('sukses', 'Berhasil Menghapus');
    }
}
