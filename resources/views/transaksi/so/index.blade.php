@extends('layouts.my')

@section('content')
@include('layouts.sidenav')
<div class="main-content">
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
                                        @php
                                        $kode_transaksi = "SO";
                                        $tahun = date('Y');
                                        $kodeincrement = str_pad(++$kode,3,"0",STR_PAD_LEFT);
                                        $kode_transaksi_terakhir_final = $kode_transaksi.$tahun.$kodeincrement
                                        @endphp
                                        <div class="row">
                                            <label class="col-md-6 pt-2 text-right" for=""><b>No Sales Order</b></label>
                                            <input class="col-md-5 mt-2 form-control form-control-sm" type="text" value={{$kode_transaksi_terakhir_final}} readonly name="kd_so">
                                        </div>
                                        <div class="row">
                                            @php
                                            date_default_timezone_set('Asia/Jakarta');
                                            $dataTnggal = date("Y-m-d");
                                            @endphp
                                            <label class="col-md-6 pt-2 text-right" for=""><b>Tanggal</b></label>
                                            <input class="col-md-5 mt-2 mb-2 form-control form-control-sm" type="date" value="{{$dataTnggal}}" name="tanggal">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">

                                    <div id="master-transaksi">
                                        <div class="content">
                                            <div class="master-header">
                                                <div class="content-customer">
                                                    <div class="form-group row">
                                                        <div>
                                                        </div>
                                                        <label class="col-md-4 pt-2 text-right" for="">Pilih
                                                            Customer</label>
                                                        <select id="customersInfo" class="customersInfo form-control form-control-sm col-md-8 mb-1 mt-2">
                                                            <option value=0>Pilih Customer</option>
                                                            @foreach ($customers as $customer )
                                                            <option value={{$customer->kd_kstmr}}>
                                                                {{$customer->kd_kstmr}}</option>
                                                            @endforeach
                                                        </select>
                                                        <label class="col-md-4 text-right" for="">Nama Customer</label>
                                                        <input id="nama_customer" class="form-control form-control-sm col-md-8 mb-2" value={{$customer->nama_perusahaan}} type="text"></input>
                                                        <label class="col-md-4 text-right" for="">Alamat</label>
                                                        <textarea id="alamat_customer" class="form-control col-md-8" name="" rows="4"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section-barang">
                                <div class="row">
                                    <div class="col-md-8">
                                    <div class="form-group">
                                      <input class="form-control form-control-sm col-md-6" type="text" placeholder="Tekan F2 Untuk Mencari Barang .." name="search" id="seachBarang">
                                    </div>
                                    </div>
                                    <div class="col-md-4 bg-cyan">
                                        asas
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
