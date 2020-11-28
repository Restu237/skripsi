$(document).ready(function () {
    // get laporan
    $('#laporan').on("click", function () {
        $('#laporan td').remove();
        var to = $('#to').val();
        var from = $('#from').val();
        if (to == '' & from == '') {
            $('#myModal').modal('show')
        }
        // var dari = new Date(Date.UTC(to));
        // var ke = new Date(from)
        var text = ""
        text += "<h4> <u> Laporan Penjualan Periode Dari Tanggal "+ to +" Ke Tanggal "+ from +" </u></h4>"
        $("#laporanPeriode").append(text);
        $.ajax({
            url: "/laporan/penjualan/" + to + '/' + from,
            type: "get",
            dataType: "json",
            success: function (response) {
                // var data = response;
                // console.log(data);
                var dataTabel = "";
                var nomer = 1;
                $.each(response, function (index, row) {
                    dataTabel += "<tr>";
                    dataTabel += "<td> " + nomer++ + "</td>";
                    dataTabel += "<td> " + row.tanggal + " </td>";
                    dataTabel += "<td> " + row.kd_in + " </td>";
                    dataTabel += "<td> " + row.customers.nama_perusahaan + "</td>";
                    dataTabel += "<td>" + row.diskon + "</td>";
                    dataTabel += "<td class='ppn'>" + row.ppn + " </td>";
                    dataTabel += "<td class='jumlah'> " + row.total + "</td>";
                });
                $('#laporan tbody').append(dataTabel);
                var jumlahPpn = 0;
                $('.ppn').each(function(){
                    jumlahPpn += Number($(this).html());
                });
                $('#ppnjum').html(jumlahPpn);
                var jumlah1 = 0;
                $('.jumlah').each(function(){
                    jumlah1 += Number($(this).html());
                })
                $('#jumlah2').html(jumlah1);
            }
        })
        var cetak = "<a href='cetak/laporan/"+to+'/'+from+"' class='btn btn-sm btn-warning'><i class='fas fa-print'> &nbsp; </i>Cetak</a>";
        $('#cetak').append(cetak);
    })

});
