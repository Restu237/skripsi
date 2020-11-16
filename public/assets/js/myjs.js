$(document).ready(function () {
    $("#user_master").DataTable();
    $(".nomor-telepon").bind("input", function () {
        //   $(this).val(function(_, v){
        //    return v.replace(/\s+/g, '');
        //   });
        if (isNaN($(this).val())) {
            $(this).val(0);
        }
        $(this).val($(this).val().replace(/ +?/g, ""));
    });

    $('.customersInfo').change(function () {
        var kd_kstmr = $(this).val();
        // console.log(kd_kstmr);
        $.ajax({
            url: '/customers/' + kd_kstmr,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                var data = response;
                var nama_customer = data['nama_perusahaan'];
                var alamat = data['alamat'];
                $('#nama_customer').val(nama_customer);
                $('#alamat_customer').val(alamat);

            }
        })
    })

    $('#seachBarang').bind("keydown", function (event) {
        if (event.which && event.keyCode == 113) {
            $('#modalcreate').modal('show')
        }

    })

    $('#searchProduct').DataTable();

    // get value 
    $('#searchProduct').on('click', '#btnAdd', function () {
        // getCurront RoW dATA 
        var currentRow = $(this).closest("tr");
        var kd_barang = currentRow.find("#kode-barang").html();
        $.ajax({
            url: '/barang/' + kd_barang,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                // menjadi respon menjadi 1 variable 
                var data = response;
                var kode_barang = data['kd_barang'];
                var nama_barang = data['nama_barang'];
                var harga_barang = data['harga_barang'];
                var bilangan = harga_barang;
                var reverse = bilangan.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                    ribuan = ribuan.join('.').split('').reverse().join('');


                //alert(nama_barang);
                var count = 0;
                count++;
                var html = '';
                html += "<tr>";
                html += "<td> <input type='text' id='nama_barang' name='barang_so[]' class='form-control' value='" + kode_barang + "'> </td>";
                html += "<td> <input type='text' name='barang_so[]' class='form-control' value='" + nama_barang + "'> </td>";
                html += "<td> <input type='text' name='barang_so[]' class='form-control' value='Rp. " + ribuan + "'> </td>";
                html += "<td> <input type='number' name='barang_so[]' class='form-control'> </td>";
                html += '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><i class="fas fa-trash text-white"></i></button></td>';
                $('#transaksi tbody').append(html);
            }
            
        })
        $('#searchModal').modal('toggle');
    })
    $(document).on('click', '.remove', function(){
        $(this).closest('tr').remove();
      });
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
