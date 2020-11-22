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
                            <h3 class="mb-0 text-center"><b>MASTER BARANG</b></h3>
                        </div>

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
                        <div class="card-body">
                            <div class="baru pb-2">
                                <button id="buat-baru" type="button" class="btn btn-sm" data-toggle="modal"
                                    data-target="#create-customers-baru"><i class="fas fa-plus"></i> </button>
                                <p class="text-baru">Buat Barang Baru</p>
                            </div>
                            <table id="user_master" class="table table-striped table-bordered" style="width:100%">
                                <thead style="text-wight: bold; text-size: 20px;">
                                    <tr>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Barang</th>
                                        <th>Type Barang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($databrg as $item)
                                    <tr>
                                        <td>{{$item->kd_barang}}</td>
                                        <td>{{$item->nama_barang}}</td>
                                        @php
                                            $hargaRupiah = "Rp. ".number_format($item->harga_barang,0,',','.')
                                        @endphp
                                        <td>{{$hargaRupiah}}</td>
                                        @if ($item->type_barang == 0)
                                            <td> Box </td>
                                        @else
                                        <td>Pcs</td>
                                        @endif
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#edit{{$item->kd_barang}}">Edit</button><button type="button"
                                                data-toggle="modal" data-target="#modalKonfirmasi{{$item->kd_barang}}"
                                                class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="edit{{$item->kd_barang}}" tabindex="-1" role="dialog"
                                        aria-labelledby="editUser" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title text-white" id="editUser">Edit Customers</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="POST" action="/home/master/barang/{{$item->kd_barang}}">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group row">
                                                            <label for="kd_barang" class="col-md-4 col-form-label text-md-left">Kode Barang</label>
                                                            <div class="col-md-4">
                                                            <input type="text" name="kd_barang" value="{{$item->kd_barang}}" readonly class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="nama_barang" class="col-md-4 col-form-label text-md-left">Nama Produk</label>
                                                            <div class="col-md-8">
                                                                <input id="nama_barang" type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                                            name="nama_barang" value="{{$item->nama_barang}}" autofocus>

                                                                @error('nama_barang')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="rupiah"
                                                                class="col-md-4 col-form-label text-md-left">Harga Barang</label>
                                                                @php
                                                                $hargaRupiah = "Rp. ".number_format($item->harga_barang,0,',','.')
                                                            @endphp


                                                            <div class="col-md-4">
                                                            <input id="rupiah" type="text" value="{{$hargaRupiah}}" class="form-control @error('rupiah') is-invalid @enderror"
                                                                    name="harga_barang">

                                                                @error('harga_barang')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="type_barang"
                                                                class="col-md-4 col-form-label text-md-left"> Pilih Satuan Barang</label>
                                                            <div class="col-md-2">
                                                                <select class="form-control" id="type_barang" name="type_barang">
                                                                    {{-- @foreach ($customers as $customer)
                                                                <option value="{{$customer->kd_kstmr}}">{{$customer->nama_perusahaan}}</option>
                                                                    @endforeach --}}
                                                                    @if ($item->type_barang == 0)
                                                                    <option selected value="0">Box</option>
                                                                    <option value="1">Pcs</option>
                                                                    @else
                                                                    <option value="0">Box</option>
                                                                    <option selected value="1">Pcs</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-8 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('Update') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="modal fade" id="modalKonfirmasi{{$item->kd_barang}}" tabindex="-1"
                                            role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                                            <div class="modal-dialog modal-danger modal-dialog-centered modal-"
                                                role="document">
                                                <div class="modal-content bg-gradient-danger">

                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="modal-title-notification">Konfirmasi
                                                            Hapus File !</h6>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">

                                                        <div class="py-3 text-center">
                                                            <i class="fas fa-trash fa-3x"></i>
                                                            <h4 class="heading mt-4">Anda Yakin Menghapus Barang Berikut :
                                                            </h4>
                                                            <h3 class="text-white">{{$item->nama_barang}}</h3>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <a href="/home/master/barang/delete/{{$item->kd_barang}}"
                                                            class="btn btn-md text-danger mr-auto bg-white">Ya, Saya
                                                            Yakin!</a>
                                                        <button type="button" class="btn btn-link text-white ml-auto"
                                                            data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                            @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="create-customers-baru" tabindex="-1" role="dialog" aria-labelledby="buatuserBaru"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="buatuserBaru">Buat Produk Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/home/master/barang">
                    @csrf
                    <div class="form-group row">
                        @php
                           $kode_transaksi = "PD";
                           $tahun = date('Y');
                           $kodeincrement =  str_pad(++$kdsekarang,3,"0",STR_PAD_LEFT);
                        @endphp
                        <label for="kd_barang" class="col-md-4 col-form-label text-md-left">Kode Barang</label>
                        <div class="col-md-4">
                        <input type="text" name="kd_barang" value="{{$kode_transaksi.$tahun.$kodeincrement}}" readonly class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_barang" class="col-md-4 col-form-label text-md-left">Nama Produk</label>
                        <div class="col-md-8">
                            <input id="nama_barang" type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                name="nama_barang" autofocus>

                            @error('nama_perusahaan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rupiah1"
                            class="col-md-4 col-form-label text-md-left">Harga Barang</label>

                        <div class="col-md-4">
                            <input id="rupiah1" type="text"  class="form-control @error('rupiah1') is-invalid @enderror"
                                name="harga_barang">

                            @error('rupiah1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type_barang"
                            class="col-md-4 col-form-label text-md-left"> Pilih Satuan Barang</label>
                        <div class="col-md-2">
                            <select class="form-control" id="type_barang" name="type_barang">
                                {{-- @foreach ($customers as $customer)
                            <option value="{{$customer->kd_kstmr}}">{{$customer->nama_perusahaan}}</option>
                                @endforeach --}}
                                <option value="0">Box</option>
                                <option value="1">Pcs</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
