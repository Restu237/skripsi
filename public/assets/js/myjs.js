$(document).ready(function(){
    $('#user_master').DataTable();
        $('.nomor-telepon').bind('input', function(){
        //   $(this).val(function(_, v){
        //    return v.replace(/\s+/g, '');
        //   });
        if(isNaN($(this).val())) {
            $(this).val(0);
          }
          $(this).val($(this).val().replace(/ +?/g, ''));
        });
})

