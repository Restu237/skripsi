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
                            <h3 class="mb-0">Transaksi Panel</h3>
                        </div>
                        <div class="card-body">
                            <div class="row icon-examples">
                                <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn-icon-clipboard" data-clipboard-text="active-40"
                                        title="" data-original-title="Buat Sales Order">
                                        <a href="/home/transaksi/so">
                                            <div>
                                                <i class="fas fa-shopping-cart"></i>
                                                <span>Sales Order</span>
                                            </div>
                                        </a>
                                    </button>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn-icon-clipboard" data-clipboard-text="air-baloon"
                                        title="" data-original-title="Konfigurasi Barang">
                                        <div>
                                            <a href="/home/transaksi/do">
                                                <i class="fas fa-car"></i>
                                                <span>DO / Surat Jalan</span>
                                            </a>
                                        </div>
                                    </button>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn-icon-clipboard" data-clipboard-text="album-2"
                                        title="" data-original-title="Konfigurasi Kustomer">
                                        <div>
                                            <a href="/home/transaksi/invoice">
                                                <i class="fas fa-file-invoice-dollar"></i>
                                            <span>Invoice</span>
                                            </a>
                                        </div>
                                    </button>
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
