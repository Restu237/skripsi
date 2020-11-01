$(document).ready(function () {
    $('#user_master').DataTable();
    $('.nomor-telepon').bind('input', function () {
        //   $(this).val(function(_, v){
        //    return v.replace(/\s+/g, '');
        //   });
        if (isNaN($(this).val())) {
            $(this).val(0);
        }
        $(this).val($(this).val().replace(/ +?/g, ''));
    });
})

var rupiah = document.getElementById('rupiah');
rupiah.addEventListener('keyup', function (e) {
    // menambhkan Rp. Ketika inputan harga 
    // menggunkan formatRupiah() agar ketika angka yang diketik menggunakn value RP. Menjadi double biasa
    rupiah.value = formatRupiah(this.value, "Rp. ");
});

var rupiah1 = document.getElementById('rupiah1');
rupiah1.addEventListener('keyup', function (e) {
    // menambhkan Rp. Ketika inputan harga 
    // menggunkan formatRupiah1() agar ketika angka yang diketik menggunakn value RP. Menjadi double biasa
    rupiah1.value = formatRupiah1(this.value, "Rp. ");
});

function formatRupiah1(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah1 = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah1 += separator + ribuan.join('.');
  }

  rupiah1 = split[1] != undefined ? rupiah1 + ',' + split[1] : rupiah1;
  return prefix == undefined ? rupiah1 : (rupiah1 ? 'Rp. ' + rupiah1 : '');
}




// fungsi formatRupiah 
function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

