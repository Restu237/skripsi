<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/assets/vendor/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('/assets/css/my.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">


    <title>Print Laporan</title>
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
                        @php
                        $dari = $data[0];
                        $timestamp = strtotime($dari);
                        $formattedDate = date('d F Y', $timestamp);
                        $ke = $data[1];
                        $timestamp1 = strtotime($ke);
                        $formattedDate1 = date('d F Y', $timestamp1);
                        @endphp
                        <h2>Laporan Penjualan</h2>
                        <p>
                            <b>Periode: {{ $formattedDate}} Ke {{$formattedDate1}}</b>
                        </p>
                        <p>
                            Dicetak Tanggal {{date('d F Y')}} Oleh <b> {{ Auth::user()->name }}</b>
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
                            <th scope="col"><b>Tanggal Transaksi</b></th>
                            <th scope="col"><b>No. Invoice</b></th>
                            <th scope="col"><b>Nama Customer</b></th>
                            <th scope="col"><b>Diskon</b></th>
                            <th scope="col"><b>Pajak</b></th>
                            <th scope="col"><b>Jumlah</b></th>
                        </thead>
                        <tbody>
                            @php
                            $nomer = 1;
                            @endphp
                            @foreach ($datalaporan as $item)
                            <tr>
                                <td>{{$nomer++}}</td>
                                <td>{{$item->tanggal}}</td>
                                <td>{{$item->kd_in}}</td>
                                <td>{{$item->customers->nama_perusahaan}}</td>
                                <td>{{$item->diskon}}</td>
                                <td>{{$item->ppn}}</td>
                                <td>{{$item->grand_total}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="total-kalkulasi d-flex">
                        @php
                        function rupiah($angka){
                        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                        return $hasil_rupiah;
                        }
                        @endphp
                        <div class="kanan">
                            <button class="btn btn-md btn-primary d-print-none" onclick="window.print()"> <i class="fas fa-print"></i> Print </button>
                        </div>
                        <div class="ml-auto">
                            <table class="table">
                                <tr>
                                    <td><b>Total PPN &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:</b></td>
                                    <td><b>{{rupiah($datalaporan->sum('ppn'))}}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Total Transaksi :</b></td>
                                    <td><b>{{rupiah($datalaporan->sum('grand_total'))}}</b></td>
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
