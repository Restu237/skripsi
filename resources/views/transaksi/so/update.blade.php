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
                            <h2 class="mb-0 text-center"><b>Sales Order Edit Transaksi</b></h2>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div id="master-transaksi" class="master-transaksi">
                                        <div class="row">
                                            <label class="col-md-6 pt-2 text-right" for=""><b>No Sales Order</b></label>
                                            <input class="col-md-5 mt-2 form-control form-control-sm" type="text"
                                                value={{$update->kd_so}} readonly name="kd_so">
                                        </div>
                                        <div class="row">
                                            {{-- @php
                                            date_default_timezone_set('Asia/Jakarta');
                                            $dataTnggal = date("Y-m-d");
                                            @endphp --}}
                                            <label class="col-md-6 pt-2 text-right" for=""><b>Tanggal</b></label>
                                            <input class="col-md-5 mt-2 mb-2 form-control form-control-sm" type="date"
                                                value="{{$update->tanggal}}" name="tanggal">

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
                                                        <select name="kd_kstmr" id="customersInfo"
                                                            class="customersInfo form-control form-control-sm col-md-8 mb-1 mt-2">
                                                            <option value=0>Pilih Customer</option>
                                                            <option selected value={{$update->kd_kstmr}}>
                                                                {{$update->kd_kstmr}}</option>
                                                        </select>
                                                        <label class="col-md-4 text-right" for="">Nama Customer</label>
                                                        <input id="nama_customer"
                                                            class="form-control form-control-sm col-md-8 mb-2"
                                                            value={{$update->customer->nama_perusahaan}} type="text"></input>
                                                        <label class="col-md-4 text-right" for="">Alamat</label>
                                                        <textarea id="alamat_customer" class="form-control col-md-8"
                                                            name="" rows="4">{{$update->customer->alamat}}</textarea>
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
                                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#searchModal">
                                                <div class="fas fa-search"></div> Cari Barang
                                            </button> --}}
                                        </div>
                                        <table id="transaksi" class="table table-hover pt-2">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Kode Barang</th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <form id="formso" action="{{url('/home/transaksi/so',$update->kd_so)}}" method="POST">
                                                @method('PUT')
                                            @csrf
                                            <tbody>
                                               @foreach ($transaksi as $item)
                                               <tr>
                                               <input name="id[]" type="hidden" value="{{$item->id}}">
                                               <input name="kd_kstmr[]" type="hidden" value="{{$item->kd_kstmr}}">

                                                <td> <input type='text' readonly id='nama_barang' name='kd_barang[]' class='form-control' value="{{$item->kd_barang}}"> </td>
                                                <td> <input type='text' readonly class='form-control' value="Nama Barang"> </td>
                                                <td> <input type='text' readonly class='form-control' value="Harga Barang"> </td>
                                                <td> <input id='jumlahQty' min='1' type='number' value="{{$item->jumlah_qty}}" name='jumlah_qty[]' class='form-control jumlahQty'> </td>
                                                <td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><i class="fas fa-trash text-white"></i></button></td>
                                            </tr>
                                                @endforeach
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
                                        <button type="submit" class="btn btn-warning btn-md">
                                             <i class="fas fa-plus"></i> Update SO
                                        </button>
                                    <a href="/home/transaksi/so/delete/{{$update->kd_so}}" class="btn btn-md btn-danger"> <i class="fas fa-trash"></i> Delete SO</a>
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

<!-- Modal Barang -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="#modalSearch" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSearch">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="searchProduct" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Barang</th>
                            <th>Satuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangs as $barang)
                        <tr>
                            <td id="kode-barang">{{$barang->kd_barang}}</td>
                            <td>{{$barang->nama_barang}}</td>
                            @php
                            $hargaRupiah = "Rp. ".number_format($barang->harga_barang,0,',','.')
                            @endphp
                            <td>{{$hargaRupiah}}</td>
                            @if ($barang->type_barang == 0)
                            <td> Box </td>
                            @else
                            <td>Pcs</td>
                            @endif
                            <td><button id="btnAdd" class="btn btn-sm btn-circle"><i
                                        class="fas fa-plus text-primary"></i>Add</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
