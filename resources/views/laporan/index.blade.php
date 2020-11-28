@extends('layouts.my')

@section('content')
@include('layouts.sidenav')
<div class="main-content" id="panel">
    @include('layouts.navigasi')

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="container-fluid mt-2">
                <h1 class="text-center"><u>Laporan Penjualan</u></h1>
                <div class="row">
                    <div class="col-md-3">
                        <h3 class="text-right">Periode</h3>
                    </div>
                    <div class="col-md-3">
                        <input id="to" class="form-control form-control-sm" type="date" value="Periode">
                    </div>
                    <div class="col-md-3">
                        <input id="from" class="form-control form-control-sm" type="date" value="Periode">
                    </div>
                    <div class="col-md-3">
                        <button id="laporan" class="btn btn-sm btn-primary">Lihat Laporan</button>
                    </div>
                </div>
            </div>
            <div class="pt-2" id="laporanPeriode">

            </div>
            <div class="pt-1">
                <table class="table table-bordered table-hover table-striped" id="laporan">
                    <thead>
                        <th scope="col"><b>No</b></th>
                        <th scope="col"><b>Tanggal Transaksi</b></th>
                        <th scope="col"><b>No. Invoice</b></th>
                        <th scope="col"><b>Nama Customer</b></th>
                        <th scope="col"><b>Diskon</b></th>
                        <th scope="col"><b>Pajak</b></th>
                        <th scope="col"><b>Jumlah</b></th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <table>

                            <tr>
                                <td class="pr-2"><b>Total Ppn</b></td>
                                <td id="ppnjum" class="pl-5"></td>
                            </tr>
                            <tr>
                                <td class="pr-2"><b>Total Penjualan</b></td>
                                <td id="jumlah2" class="pl-5"></td>
                            </tr>
                            <tr id="cetak">

                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal"
                aria-hidden="true">
                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content bg-gradient-danger">

                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-notification">Periode Tidak Di isi!</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="py-3 text-center">
                                <i class="ni ni-bell-55 ni-3x"></i>
                                <h4 class="heading mt-4">Perhatian!</h4>
                                <p>Mohon isi Paramter Tanggal anda.</p>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-white ml-auto"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>

</div>

@endsection
