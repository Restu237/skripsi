@extends('layouts.my')

@section('content')
@include('layouts.sidenav')
<div class="main-content" id="panel">
    @include('layouts.navigasi')
    <div class="main-master pt-7">
        <div class="container-fluid mt--6">
            <div class="row justify-content-center">
                <div class=" col ">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h2 class="mb-0 text-center"><b>Sales Order</b></h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-md-4">
                                        <div id="master-transaksi" class="master-transaksi">
                                           <div class="content m-3">
                                            <div class="master-header">
                                                <div class="content-customer">
                                                    <div class="form-group row">
                                                        <label class="col-md-4" for="">Tes</label>
                                                        <input type="text" class="form-control col-md-8">
                                                    </div>
                                                </div>
                                            </div>
                                           </div>
                                        </div>
                                       
                                    </div>
                                    <div class="col-md-4">
                                        <div id="master-transaksi" class="master-transaksi">
                                            Kolom untuk Master Customer
                                        </div>
                                       
                                    </div>
                                    <div class="col-md-4">
                                        <div id="master-transaksi" class="master-transaksi">
                                            Kolom untuk Master Customer
                                        </div>
                                       
                                    </div>                               
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>       
</div>
@endsection
