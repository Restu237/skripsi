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
                            <h2 class="mb-0 text-center"><b>Delviery Order</b></h2>
                            {{-- <button class="btn btn-md btn-info" data-toggle="modal"
                            data-target="#list-transaksi">List Transaksi DO</button> --}}
                        </div>
                        <form id="formdo" action="{{url('/home/transaksi/do',$data->kd_do)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div id="master-transaksi" class="master-transaksi">
                                        <div class="row">
                                            <label class="col-md-6 pt-2 text-right" for=""><b>No Delivery Order</b></label>
                                            <input class="col-md-5 mt-2 form-control form-control-sm" type="text"
                                                value={{$data->kd_do}} readonly name="kd_do">
                                        </div>
                                        <div class="row">
                                            <label class="col-md-6 pt-2 text-right" for=""><b>Tanggal</b></label>
                                            <input class="col-md-5 mt-2 mb-2 form-control form-control-sm" type="date"
                                                value="{{$data->tanggal}}" name="tanggal">

                                        </div>
                                        <div class="row">
                                            <label class="col-md-6 text-right" for=""><b>Catatan</b></label>
                                            <input class="col-md-5 mb-2 form-control form-control-sm" placeholder="Keterangan" value="Catatan" type="text" name="keterangan">
                                        </div>
                                        <div class="row">
                                            <label class="col-md-6 text-right" for=""><b>Pengirim</b></label>
                                            <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                        <input type="hidden" name="user_id" value="{{$data->user_id}}">
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
                                                            <option selected value={{$data->kd_so}}>
                                                                {{$data->kd_so}}</option>

                                                        </select>
                                                        <label class="col-md-4 text-right" for="">Nomor Customer</label>
                                                        <input id="kd_kstmr" readonly
                                                            class="form-control form-control-sm col-md-8 mb-2"
                                                            value="" name="kd_kstmr" type="text"></input>
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

                                                @foreach ($transaksiDO as $item)
                                            <input type="hidden" name="id[]" value="{{$item->id}}">
                                                <tr>
                                                <td> <input type='text' readonly id='nama_barang' name='kd_barang[]' class='form-control' value='{{$item->kd_barang}}'> </td>

                                                <td> <input type='text' readonly class='form-control' value='{{$item->barang->nama_barang}}'> </td>

                                                <td> <input type='text' readonly class='form-control' value='Rp. {{$item->barang->harga_barang}}'> </td>

                                                <td> <input id='jumlahQty' min='1' value='{{$item->qty}}' type='number' name='qty[]' class='form-control jumlahQty'> </td>
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
                                                    <input type="hidden" id="total_qty" name="total_qty">

                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-warning btn-md">
                                             <i class="fas fa-plus"></i> Create DO
                                        </button>
                                        <a href="/home/transaksi/do/delete/{{$data->kd_do}}" class="btn btn-md btn-danger"> <i class="fas fa-trash"></i> Delete SO</a>
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

@endsection
