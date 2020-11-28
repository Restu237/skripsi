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
                            {{-- <button class="btn btn-md btn-info" data-toggle="modal" data-target="#list-transaksi">List
                                Invoices</button> --}}
                        </div>
                        <form id="formdo" action="{{url('/invoice/create')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div id="master-transaksi" class="master-transaksi">
                                            <div class="row">
                                                <label class="col-md-6 pt-2 text-right" for=""><b>No Invoice</b></label>
                                                <input class="col-md-5 mt-2 form-control form-control-sm" type="text"
                                                    value={{$data->kd_in}} readonly name="kd_in">
                                            </div>
                                            <div class="row">
                                                <label class="col-md-6 pt-2 text-right" for=""><b>Tanggal</b></label>
                                                <input class="col-md-5 mt-2 mb-2 form-control form-control-sm"
                                                    type="text" value="{{$data->created_at}}" name="tanggal">

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
                                                                <option selected value={{$data->kd_do}}>
                                                                    {{$data->kd_do}}</option>
                                                            </select>
                                                            <label class="col-md-4 text-right" for="">Nomor SO</label>
                                                            <input id="kd_so" readonly
                                                                class="form-control form-control-sm col-md-8 mb-2"
                                                                value="{{$data->kd_so}}" name="kd_so"
                                                                type="text"></input>
                                                            <label class="col-md-4 text-right" for="">Nomor
                                                                Customer</label>
                                                            <input id="kd_kstmr" readonly
                                                                class="form-control form-control-sm col-md-8 mb-2"
                                                                value="{{$data->kd_kstmr}}" name="kd_kstmr"
                                                                type="text"></input>
                                                            <label class="col-md-4 text-right" for="">Nama Customer
                                                                Sesuai SO</label>
                                                            <input id="nama_customer" readonly
                                                                class="form-control form-control-sm col-md-8 mb-2"
                                                                value="{{$data->customers->nama_perusahaan}}"
                                                                type="text"></input>
                                                            <label class="col-md-4 text-right" for="">Alamat Pengiriman
                                                                DO</label>
                                                            <textarea readonly id="alamat_customer"
                                                                class="form-control col-md-8" name=""
                                                                rows="4">{{$data->customers->alamat}}</textarea>
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
                                                    @foreach ($transaksi as $item)
                                                    <tr>
                                                        <td><input type='text' readonly id='nama_barang'
                                                                name='kd_barang[]' class='form-control'
                                                                value='{{$item->kd_barang}}'></td>
                                                        <td> <input type='text' readonly class='form-control'
                                                                value='{{$item->barangs->nama_barang}}'></td>
                                                        <td><input type='text' readonly class='form-control'
                                                                value='Rp. {{$item->barangs->harga_barang}}'></td>
                                                        <td><input id='jumlahQty' readonly min='1'
                                                                value='{{$item->qty}}' type='number' name='qty[]'
                                                                class='form-control jumlahQty'></td>
                                                        <td> <input id='amount' readonly value='{{$item->amount}}'
                                                                type='text' name='amount[]' class='form-control amount'>
                                                        </td>
                                                    </tr>

                                                    @endforeach
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
                                                        value="{{$data->diskon}}" id="diskon" readonly
                                                                class="form-control form-control-sm col-md-8"></input>
                                                        </td>
                                                    </tr>
                                                    <input type="hidden" id="jumlahdiskon" name="diskon" value="">
                                                    <tr>
                                                        <td class="pt-2"><b>Total</b></td>
                                                        <td class="pt-2"><input readonly id="total" name="total"
                                                        value="{{$data->total}}"   class="form-control form-control-sm"></input></td>
                                                    </tr>
                                                    <tr>
                                                        @if ($data->ppn == 0)
                                                        <td><input checked id="nonppn" type="radio" name="ppn" value="0"> NON
                                                            PPN<br>
                                                        </td>
                                                        @else
                                                        <td><input checked id="ppn" type="radio" value="0.10"> PPN 10%<br>
                                                        </td>
                                                        @endif

                                                    </tr>
                                                    <input type="hidden" id="jumlahppn" name="ppn" value="">
                                                    <tr>
                                                        <td class="pt-2"><b>Jumlah PPN</b></td>
                                                        <td class="pt-2"><input readonly id="jumlahfinalppn"
                                                        value="{{$data->ppn}}"   class="form-control form-control-sm"></input></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="pt-2">
                                                            <h3>Grand Total</h3>
                                                        </td>
                                                        <td class="pt-2"><input readonly name="grand_total"
                                                        id="grand_total" value="{{$data->grand_total}}"
                                                                class="form-control form-control-sm"></input></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-danger btn-md">
                                            <i class="fas fa-trash"></i> Batalkan Invoice
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

@endsection
