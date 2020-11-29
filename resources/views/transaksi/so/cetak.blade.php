<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/assets/vendor/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('/assets/css/my.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">


<title>{{$data->kd_so}}</title>
</head>

<body>
    <div id="content-print" class="content-print">
        <div class="container">
            <div class="row header">
                <div class="col">
                    <div class="logo-keterangan">
                        <div class="logo-img">
                            <img style="max-height: 60px;" src="{{asset('assets/img/logo.png')}}" alt="Oxone">
                        </div>
                    </div>
                    <div class="judul-lap">

                        <h5 class="pt-2"><b><u>SALES ORDER</u></b></h5>
                        <p>
                        Nomor Sales Order : <b>{{$data->kd_so}}</b>
                        <br class="pt-1">
                        </p>
                        @php
                        $tanggal1 = $data->tanggal;
                        $timestamp = strtotime($tanggal1);
                        $tanggalso = date('d F Y', $timestamp);
                        @endphp
                        <p>
                            Tanggal : <b>{{$tanggalso}}</b>
                            <br class="pt-1">
                        </p>

                        Nama Customer : <b>{{$data->customer->nama_perusahaan}}</b>
                        <br class="pt-1">
                        Kode Customer : <b>{{$data->kd_kstmr}}</b>
                        </p>


                    </div>
                </div>
                <div class="col">
                    <div class="keterangan">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><b>Alamat</b></td>
                                    <td>Jl. Jemb. 3 Raya No.2H, RT.3/RW.16, Penjaringan, Kec. Penjaringan, Kota Jkt
                                        Utara, Daerah Khusus Ibukota Jakarta 14450</td>
                                </tr>
                                <tr>
                                    <td><b>Telepon</b></td>
                                    <td>0859-5988-3300</td>
                                </tr>
                                <tr>
                                    <td><b>Alamat Customer</b></td>
                                    <td>
                                        {{$data->customer->alamat}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row isi">
                <div class="col">
                    <table class="table">
                        <thead>
                            <th scope="col"><b>No</b></th>
                            <th scope="col"><b>Kode Barang</b></th>
                            <th scope="col"><b>Nama Baarang</b></th>
                            <th scope="col"><b>Harga</b></th>
                            <th scope="col"><b>Qty</b></th>
                        </thead>
                        <tbody>
                            @php
                            function rupiah($angka){
                            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                            return $hasil_rupiah;
                            }
                            @endphp
                            @php
                            $nomer = 1;
                            @endphp
                            @foreach ($datatransaksi as $item)
                            <tr>
                                <td>{{$nomer++}}</td>
                                <td>{{$item->kd_barang}}</td>
                                <td>{{$item->barang->nama_barang}}</td>
                                <td>{{rupiah($item->barang->harga_barang)}}</td>
                                <td>{{$item->jumlah_qty}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="total-kalkulasi d-flex">
                        <div class="kanan">
                            <button class="btn btn-md btn-primary d-print-none" onclick="window.print()"> <i class="fas fa-print"></i> Print </button>
                        </div>
                        <div class="ml-auto">
                            <table class="table">
                                <tr>
                                    <td><b>Total Qty &nbsp;:</b></td>
                                    <td><b>{{$datatransaksi->sum('jumlah_qty')}}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Total Item :</b></td>
                                    <td><b>{{$datatransaksi->count()}}</b></td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
