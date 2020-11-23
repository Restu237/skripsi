@extends('layouts.my')

@section('content')
@include('layouts.sidenav')
<div class="main-content">
    @include('layouts.navigasi')
    <div class="main-master pt-7">
        <div class="container-fluid mt--6">
            <div class="row justify-content-center">
                <div class=" col ">
                    @if (Session::has('sukses'))
                    <div class="pesan m-4">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-icon"><i class="fas fa-check""></i></span>
                            <span class=" alert-text">{!! Session::get('sukses') !!}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h2 class="mb-0 text-center"><b>Sales Order</b></h2>
                            <button class="btn btn-md btn-info" data-toggle="modal"
                            data-target="#list-transaksi">List Transaksi SO</button>
                        </div>
                        <form id="formso" action="{{url('so/create')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div id="master-transaksi" class="master-transaksi">
                                        @php
                                        $kode_transaksi = "DO";
                                        $tahun = date('Y');
                                        $kodeincrement = str_pad(++$kode,3,"0",STR_PAD_LEFT);
                                        $kode_transaksi_terakhir_final = $kode_transaksi.$tahun.$kodeincrement
                                        @endphp
                                        <div class="row">
                                            <label class="col-md-6 pt-2 text-right" for=""><b>No Delivery Order</b></label>
                                            <input class="col-md-5 mt-2 form-control form-control-sm" type="text"
                                                value={{$kode_transaksi_terakhir_final}} readonly name="kd_do">
                                        </div>
                                        <div class="row">
                                            @php
                                            date_default_timezone_set('Asia/Jakarta');
                                            $dataTnggal = date("Y-m-d");
                                            @endphp
                                            <label class="col-md-6 pt-2 text-right" for=""><b>Tanggal</b></label>
                                            <input class="col-md-5 mt-2 mb-2 form-control form-control-sm" type="date"
                                                value="{{$dataTnggal}}" name="tanggal">

                                        </div>
                                        <div class="row">
                                            <label class="col-md-6 text-right" for=""><b>Catatan</b></label>
                                            <input class="col-md-5 mb-2 form-control form-control-sm" placeholder="Keterangan" type="text" name="keterangan">
                                        </div>
                                        <div class="row">
                                            <label class="col-md-6 text-right" for=""><b>Pengirim</b></label>
                                            <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
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
                                                            SO</label>
                                                        <select name="kd_so" id="soInfo"
                                                            class="soInfo form-control form-control-sm col-md-8 mb-1 mt-2">
                                                            <option aria-readonly="true">Pilih Nomor SO</option>
                                                            @foreach ($salesorder as $salesorder )
                                                            <option value={{$salesorder->kd_so}}>
                                                                {{$salesorder->kd_so}}</option>
                                                            @endforeach
                                                        </select>
                                                        <label class="col-md-4 text-right" for="">Nama Customer Sesuai SO</label>
                                                        <input id="nama_customer" readonly
                                                            class="form-control form-control-sm col-md-8 mb-2"
                                                            value="" type="text"></input>
                                                        <label class="col-md-4 text-right" for="">Alamat Pengiriman SO</label>
                                                        <textarea readonly id="alamat_customer" class="form-control col-md-8"
                                                            name="" rows="4"></textarea>
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
                                        {{-- <div class="form-group">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#searchModal">
                                                <div class="fas fa-search"></div> Cari Barang
                                            </button>
                                        </div> --}}
                                        <table id="transaksi" class="table table-hover pt-2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Kode Barang</th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form action="#" method="post">

                                                </form>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="kalkulasi" class="card">
                                            <div class="card-header" id="kalkulasi">
                                                <b class="judul-card">Kalkulasi</b>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="dol-md-6"><h3>Jumlah Item :</h3></div>
                                                    <div class="dol-md-6 pl-2"> <h3><b id="jumlahItem">  </b> </h3></div>
                                                </div>
                                                <div class="row">
                                                    <div class="dol-md-6"><h3>Jumlah Qty :</h3></div>
                                                    <div class="dol-md-6 pl-2"> <h3><b id="totalQty"></b> </h3></div>
                                                    <div class="dol-md-6 pl-2"> <h3><b id="totalQty1"></b> </h3></div>

                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-md">
                                             <i class="fas fa-plus"></i> Create SO
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal So --}}
<div class="modal fade" id="list-transaksi" tabindex="-1" role="dialog" aria-labelledby="#modalTransaksi" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTransaksi">Search Transkasi Sales Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="searchTransaksiSO" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode SO</th>
                            <th>Kode Kustomer</th>
                            <th>Nama Kustomer</th>
                            <th>Tanggal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    {{-- <tbody>
                        @foreach($transaksiSo as $transaksi)
                        <tr>
                            <td id="kode-so">{{$transaksi->kd_so}}</td>
                            <td>{{$transaksi->kd_kstmr}}</td>
                            <td>{{$transaksi->customer->nama_perusahaan}}</td>
                            <td>{{$transaksi->tanggal}}</td>
                            <td><a class="btn btn-sm btn-circle" href="/home/transaksi/so/{{$transaksi->kd_so}}"><i
                                class="fas fa-eye text-primary"></i>Detial</a></td>
                        </tr>
                        @endforeach
                    </tbody> --}}
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
