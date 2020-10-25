<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class MasterController extends Controller
{
    // Index Method 
    public function index(){
        return view('master.index');
    }

    // Master User Method 
    public function masterUser(){
        return view('master.user.index');
    }
}
