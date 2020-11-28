$(document).ready(function () {
    $("#user_master").DataTable();
    $(".nomor-telepon").bind("input", function () {
        if (isNaN($(this).val())) {
            $(this).val(0);
        }
        $(this).val($(this).val().replace(/ +?/g, ""));
    });
    // invoice form
    $(".doInfo").change(function () {
        var kd_do = $(this).val();
        // ajax function get data
        $.ajax({
            url: "/inv/do-info/" + kd_do,
            type: "get",
            dataType: "json",
            success: function (response) {
                var data = response;
                var kd_so = data["kd_so"];
                var kd_kstmr = data["kd_kstmr"];
                var nama_cutomer = data.customers["nama_perusahaan"];
                var alamat_customers = data.customers["alamat"];
                $("#kd_so").val(kd_so);
                $("#kd_kstmr").val(kd_kstmr);
                $("#nama_customer").val(nama_cutomer);
                $("#alamat_customer").val(alamat_customers)
                //console.log(data);
            }
        })
    })

    // append html table
    $("#doInfo").change(function () {
        var kd_do = $(this).val();
        $.ajax({
            url: "/inv/do-trksi/" + kd_do,
            type: "get",
            dataType: "json",
            success: function (response) {
                var dataTabel = "";
                $.each(response, function (index, row) {
                    //console.log(row.barang.nama_barang);
                    dataTabel += "<tr>";
                    dataTabel +=
                        "<td> <input type='text' readonly id='nama_barang' name='kd_barang[]' class='form-control' value='" +
                        row.kd_barang +
                        "'> </td>";
                    dataTabel +=
                        "<td> <input type='text' readonly class='form-control' value='" +
                        row.barang.nama_barang +
                        "'> </td>";
                    dataTabel +=
                        "<td> <input type='text' readonly class='form-control' value='Rp. " +
                        row.barang.harga_barang +
                        "'> </td>";
                    dataTabel +=
                        "<td> <input id='jumlahQty' readonly min='1' value='" +
                        row.qty +
                        "' type='number' name='qty[]' class='form-control jumlahQty'> </td>";
                    dataTabel +=
                        "<td> <input id='amount' readonly value='" +
                        row.qty * row.barang.harga_barang +
                        "' type='text' name='amount[]' class='form-control amount'> </td>";
                });
                $("#transaksi tbody").append(dataTabel);
                var sum = 0;
                $(".amount").each(function () {
                    sum += Number($(this).val());
                });
                $("#total").val(sum);
            }
        })
    })

    $("#diskon").change(function(){
        var sum = 0;
        $(".amount").each(function () {
            sum += Number($(this).val());
        });
        var diskon = $("#diskon").val();
        var diskon1 = diskon / 100;
        var total1 = diskon1 * sum;
        var jumlah = sum + total1;
        $('#total').val(jumlah);
       $('#grand_total').val(jumlah);
    })

    $("#ppn").on('click', function(){
        $('#grand_total').val(0);
        var ppn = $(this).val();
        var sebelum_ppn = $('#total').val();
        var julmlah_ppn = sebelum_ppn * ppn;
        var grandT = parseInt(julmlah_ppn)+parseInt(sebelum_ppn);
        $('#jumlahfinalppn').val(julmlah_ppn);
        $('#grand_total').val(grandT);
        // console.log(grandT);
    })
    $('#nonppn').on('click', function(){
        $('#grand_total').val(0);
        var ppn = $(this).val();
        var sebelum_ppn = $('#total').val();
        var julmlah_ppn = sebelum_ppn * ppn;
        var grandT = parseInt(julmlah_ppn)+parseInt(sebelum_ppn);
        $('#jumlahfinalppn').val(julmlah_ppn);
        $('#grand_total').val(grandT);
    })

    // so form
    $(".soInfo").change(function () {
        var kd_so = $(this).val();
        $("#transaksi td").remove();
        $.ajax({
            url: "/do/so-info/" + kd_so,
            type: "get",
            dataType: "json",
            success: function (response) {
                var data = response;
                var nama_customer = data.customer["nama_perusahaan"];
                var alamat_customer = data.customer["alamat"];
                var kd_kstmr = data.customer["kd_kstmr"];
                $("#nama_customer").val(nama_customer);
                $("#alamat_customer").val(alamat_customer);
                $("#kd_kstmr").val(kd_kstmr);
                //console.log(data.customer["nama_perusahaan"]);
            },
        });
    });
    // get data so transaksi
    $("#soInfo").change(function () {
        var kd_so = $(this).val();
        $.ajax({
            url: "/do/so-info-tr/" + kd_so,
            type: "get",
            dataType: "json",
            success: function (response) {
                //console.log(response);
                var dataTabel = "";
                $.each(response, function (index, row) {
                    //console.log(row.barang.nama_barang);
                    dataTabel += "<tr>";
                    dataTabel +=
                        "<td> <input type='text' readonly id='nama_barang' name='kd_barang[]' class='form-control' value='" +
                        row.kd_barang +
                        "'> </td>";
                    dataTabel +=
                        "<td> <input type='text' readonly class='form-control' value='" +
                        row.barang.nama_barang +
                        "'> </td>";
                    dataTabel +=
                        "<td> <input type='text' readonly class='form-control' value='Rp. " +
                        row.barang.harga_barang +
                        "'> </td>";
                    dataTabel +=
                        "<td> <input id='jumlahQty' min='1' value='" +
                        row.jumlah_qty +
                        "' type='number' name='qty[]' class='form-control jumlahQty'> </td>";
                });
                $("#transaksi tbody").append(dataTabel);
                var transaksiRow = $("#transaksi tr").length;
                var jumlahItem = transaksiRow - 1;
                $("#jumlahItem").text(jumlahItem);
                $(this).closest("tr").remove();
                var sum = 0;
                $(".jumlahQty").each(function () {
                    sum += Number($(this).val());
                });
                $("#totalQty").html(sum);
                $("#total_qty").val(sum);
            },
        });
    });
    // do form

    $(".customersInfo").change(function () {
        var kd_kstmr = $(this).val();
        $.ajax({
            url: "/customers/" + kd_kstmr,
            type: "get",
            dataType: "json",
            success: function (response) {
                var data = response;
                var nama_customer = data["nama_perusahaan"];
                var alamat = data["alamat"];
                $("#nama_customer").val(nama_customer);
                $("#alamat_customer").val(alamat);
            },
        });
    });

    $("#seachBarang").bind("keydown", function (event) {
        if (event.which && event.keyCode == 113) {
            $("#modalcreate").modal("show");
        }
    });

    $("#searchProduct").DataTable();
    $("#searchTransaksiSO").DataTable();

    // get value
    $("#searchProduct").on("click", "#btnAdd", function () {
        // getCurront RoW dATA
        var currentRow = $(this).closest("tr");
        var kd_barang = currentRow.find("#kode-barang").html();
        $.ajax({
            url: "/barang/" + kd_barang,
            type: "get",
            dataType: "json",
            success: function (response) {
                // menjadi respon menjadi 1 variable
                var data = response;
                var kode_barang = data["kd_barang"];
                var nama_barang = data["nama_barang"];
                var harga_barang = data["harga_barang"];
                var bilangan = harga_barang;
                var reverse = bilangan.toString().split("").reverse().join(""),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join(".").split("").reverse().join("");
                //alert(nama_barang);
                var count = 0;
                count++;
                var html = "";
                html += "<tr>";
                html +=
                    "<td> <input type='text' readonly id='nama_barang' name='kd_barang[]' class='form-control' value='" +
                    kode_barang +
                    "'> </td>";
                html +=
                    "<td> <input type='text' readonly class='form-control' value='" +
                    nama_barang +
                    "'> </td>";
                html +=
                    "<td> <input type='text' readonly class='form-control' value='Rp. " +
                    ribuan +
                    "'> </td>";
                html +=
                    "<td> <input id='jumlahQty' min='1' type='number' name='jumlah_qty' class='form-control jumlahQty'> </td>";
                html +=
                    '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><i class="fas fa-trash text-white"></i></button></td>';
                $("#transaksi tbody").append(html);

                var transaksiRow = $("#transaksi tr").length;
                var jumlahItem = transaksiRow - 1;
                $("#jumlahItem").text(jumlahItem);
            },
        });
        $("#searchModal").modal("toggle");
    });
    $(document).on("click", ".remove", function () {
        $(this).closest("tr").remove();
        var sum = 0;
        $(".jumlahQty").each(function () {
            sum += Number($(this).val());
        });
        $("#totalQty").html(sum);
    });
    var transaksiRow = $("#transaksi tr").length;
    var jumlahItem = transaksiRow - 1;
    $("#jumlahItem").text(jumlahItem);
    $(document)
        .on("change", "#jumlahQty", function () {
            var jumlahQty = $(this).val();
            if (jumlahQty < 0) {
                jumlahQty = 0;
            }
            var sum = 0;
            $(".jumlahQty").each(function () {
                sum += Number($(this).val());
            });
            $("#totalQty").html(sum);
        })
        .keyup();
});

var rupiah = document.getElementById("rupiah");
rupiah.addEventListener("keyup", function (e) {
    // menambhkan Rp. Ketika inputan harga
    // menggunkan formatRupiah() agar ketika angka yang diketik menggunakn value RP. Menjadi double biasa
    rupiah.value = formatRupiah(this.value, "Rp. ");
});

var rupiah1 = document.getElementById("rupiah1");
rupiah1.addEventListener("keyup", function (e) {
    // menambhkan Rp. Ketika inputan harga
    // menggunkan formatRupiah1() agar ketika angka yang diketik menggunakn value RP. Menjadi double biasa
    rupiah1.value = formatRupiah1(this.value, "Rp. ");
});

function formatRupiah1(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah1 = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah1 += separator + ribuan.join(".");
    }

    rupiah1 = split[1] != undefined ? rupiah1 + "," + split[1] : rupiah1;
    return prefix == undefined ? rupiah1 : rupiah1 ? "Rp. " + rupiah1 : "";
}

// fungsi formatRupiah
function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}
