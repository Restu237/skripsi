<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/assets/vendor/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('/assets/css/my.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">


<title>{{$data->kd_in}}</title>
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

                        <h5 class="pt-2"><b><u>INVOICES</u></b></h5>
                        <p>
                        Nomor Delivery Order: <b>{{$data->kd_in}}</b>
                        <br class="pt-1">
                        </p>
                        @php
                        $tanggal1 = $data->tanggal;
                        $timestamp = strtotime($tanggal1);
                        $tanggalin = date('d F Y', $timestamp);
                        @endphp
                        <p>
                            Tanggal : <b>{{$tanggalin}}</b>
                            <br class="pt-1">
                        </p>

                        Nama Customer : <b>{{$data->customers->nama_perusahaan}}</b>
                        <br class="pt-1">
                        Kode SO : <b>{{$data->kd_so}}</b>
                        <br>
                        Kode DO : <b>{{$data->kd_do}}</b>
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
                                    <td><b>Alamat Pengiriman</b></td>
                                    <td>
                                        {{$data->customers->alamat}}
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
                            <th scope="col"><b>Nama Barang</b></th>
                            <th scope="col"><b>Harga Barang</b></th>
                            <th scope="col"><b>Qty</b></th>
                            <th scope="col"><b>Amount</b></th>
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
                            @foreach ($transaksiin as $item)
                            <tr>
                                <td>{{$nomer++}}</td>
                                <td>{{$item->kd_barang}}</td>
                                <td>{{$item->barangs->nama_barang}}</td>
                                <td>{{rupiah($item->barangs->harga_barang)}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{rupiah($item->amount)}}</td>
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
                                        <td><b>Amount &nbsp; &nbsp; &nbsp;&nbsp;:</b></td>
                                        <td><b>{{rupiah($transaksiin->sum('amount'))}}</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Diskon &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:</b></td>
                                        <td><b>{{rupiah($data->diskon)}}</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Total PPN &nbsp; &nbsp;:</b></td>
                                        <td><b>{{rupiah($data->ppn)}}</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Grand Total :</b></td>
                                        <td><b>{{rupiah($data->grand_total)}}</b></td>
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
