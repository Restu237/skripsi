<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DelveryOrder;
use App\Invoice;
use App\SalesOrder;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $datado = DelveryOrder::get()->count();
        $datain = Invoice::get()->count();
        $dataso = SalesOrder::get()->count();
        return view('dashboard.home',[
            'datado' => $datado,
            'datain' => $datain,
            'dataso' => $dataso
        ]);
    }
}
