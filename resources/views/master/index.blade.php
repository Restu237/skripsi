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
                            <h3 class="mb-0">Panel Master</h3>
                        </div>
                        <div class="card-body">
                            <div class="row icon-examples">
                                <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn-icon-clipboard" data-clipboard-text="active-40"
                                        title="" data-original-title="Konfigurasi User">
                                        <a href="/home/master/user">
                                            <div>
                                                <i class="fas fa-user"></i>
                                                <span>Master Users</span>
                                            </div>
                                        </a>
                                       
                                    </button>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn-icon-clipboard" data-clipboard-text="album-2"
                                        title="" data-original-title="Konfigurasi Kustomer">
                                        <div>
                                            <a href="/home/master/customers">
                                                <i class="fas fa-users"></i>
                                            <span>Master Customers</span>
                                            </a>
                                        </div>
                                    </button>
                                </div>
                            
                                <div class="col-lg-4 col-md-6">
                                    <button type="button" class="btn-icon-clipboard" data-clipboard-text="air-baloon"
                                        title="" data-original-title="Konfigurasi Barang">
                                        <div>
                                            <a href="">
                                                <i class="fas fa-box"></i>
                                                <span>Master Barang</span>
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
