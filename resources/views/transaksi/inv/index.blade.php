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
                            <h2 class="mb-0 text-center"><b>Invoices</b></h2>
                            <button class="btn btn-md btn-info" data-toggle="modal" data-target="#list-transaksi">List
                                Invoices</button>
                        </div>
                        <form id="formdo" action="{{url('/invoice/create')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div id="master-transaksi" class="master-transaksi">
                                            @php
                                            $kode_transaksi = "IN";
                                            $tahun = date('Y');
                                            $kodeincrement = str_pad(++$kode,3,"0",STR_PAD_LEFT);
                                            $kode_transaksi_terakhir_final = $kode_transaksi.$tahun.$kodeincrement
                                            @endphp
                                            <div class="row">
                                                <label class="col-md-6 pt-2 text-right" for=""><b>No Invoice</b></label>
                                                <input class="col-md-5 mt-2 form-control form-control-sm" type="text"
                                                    value={{$kode_transaksi_terakhir_final}} readonly name="kd_in">
                                            </div>
                                            <div class="row">
                                                @php
                                                date_default_timezone_set('Asia/Jakarta');
                                                $dataTnggal = date("Y-m-d");
                                                @endphp
                                                <label class="col-md-6 pt-2 text-right" for=""><b>Tanggal</b></label>
                                                <input class="col-md-5 mt-2 mb-2 form-control form-control-sm"
                                                    type="date" value="{{$dataTnggal}}" name="tanggal">

                                            </div>
                                            <div class="row">
                                                <label class="col-md-6 text-right" for=""><b>Catatan</b></label>
                                                <input class="col-md-5 mb-2 form-control form-control-sm"
                                                    placeholder="Keterangan" value="Catatan" type="text"
                                                    name="keterangan">
                                            </div>
                                            <div class="row">
                                                <label class="col-md-6 text-right" for=""><b>Pengirim</b></label>
                                                <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
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
                                                                DO</label>
                                                            <select name="kd_do" id="doInfo"
                                                                class="doInfo form-control form-control-sm col-md-8 mb-1 mt-2">
                                                                <option aria-readonly="true">Pilih Nomor DO</option>
                                                                @foreach ($delveryorder as $delveryorder )
                                                                <option value={{$delveryorder->kd_do}}>
                                                                    {{$delveryorder->kd_do}}</option>
                                                                @endforeach
                                                            </select>
                                                            <label class="col-md-4 text-right" for="">Nomor SO</label>
                                                            <input id="kd_so" readonly
                                                                class="form-control form-control-sm col-md-8 mb-2"
                                                                value="" name="kd_so" type="text"></input>
                                                            <label class="col-md-4 text-right" for="">Nomor
                                                                Customer</label>
                                                            <input id="kd_kstmr" readonly
                                                                class="form-control form-control-sm col-md-8 mb-2"
                                                                value="" name="kd_kstmr" type="text"></input>
                                                            <label class="col-md-4 text-right" for="">Nama Customer
                                                                Sesuai SO</label>
                                                            <input id="nama_customer" readonly
                                                                class="form-control form-control-sm col-md-8 mb-2"
                                                                value="" type="text"></input>
                                                            <label class="col-md-4 text-right" for="">Alamat Pengiriman
                                                                DO</label>
                                                            <textarea readonly id="alamat_customer"
                                                                class="form-control col-md-8" name=""
                                                                rows="4"></textarea>
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
                                                        <th scope="col">Amount</th>
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
                                                <b>
                                                    <h2>Kalkulasi</h2>
                                                </b>
                                            </div>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class="pt-2"><b>Diskon %</b></td>
                                                        <td class="pt-2"><input type="number" min="0" max="100"
                                                            value="0" id="diskon" class="form-control form-control-sm col-md-4"></input>
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" id="jumlahdiskon" name="diskon" value="">
                                                    <tr>
                                                        <td class="pt-2"><b>Total</b></td>
                                                        <td class="pt-2"><input readonly id="total" name="total"
                                                                class="form-control form-control-sm"></input></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input id="ppn" type="radio" value="0.10"> PPN 10%<br>
                                                        </td>
                                                        <td><input id="nonppn" type="radio" name="ppn" value="0"> NON PPN<br>
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" id="jumlahppn" name="ppn" value="">
                                                    <tr>
                                                        <td class="pt-2"><b>Jumlah PPN</b></td>
                                                        <td class="pt-2"><input readonly id="jumlahfinalppn"
                                                                class="form-control form-control-sm"></input></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="pt-2">
                                                            <h3>Grand Total</h3>
                                                        </td>
                                                        <td class="pt-2"><input readonly
                                                            name="grand_total" id="grand_total" class="form-control form-control-sm"></input></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-warning btn-md">
                                            <i class="fas fa-plus"></i> Create Invoice
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
<div class="modal fade" id="list-transaksi" tabindex="-1" role="dialog" aria-labelledby="#modalTransaksi"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTransaksi">Search Transkasi Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="searchTransaksiSO" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode IN</th>
                            <th>Kode SO</th>
                            <th>Kode DO</th>
                            <th>Naman Customer</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoicelist as $transaksi)
                        <tr>
                            <td id="kode-in">{{$transaksi->kd_in}}</td>
                        <td>{{$transaksi->kd_so}}</td>
                        <td>{{$transaksi->kd_do}}</td>
                        <td>{{$transaksi->customers->nama_perusahaan}}</td>
                        <td>{{$transaksi->created_at}}</td>
                        <td>Rp. {{$transaksi->total}}</td>


                        <td><a class="btn btn-sm btn-circle" href="/home/transaksi/invoice/{{$transaksi->kd_in}}"><i
                                    class="fas fa-eye text-primary"></i>Detial</a></td>
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
