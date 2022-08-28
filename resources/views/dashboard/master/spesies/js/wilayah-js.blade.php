<script>
    $(document).ready(function () {
        $('#provinsi').change(function(){
            var provinsi_id = $(this).val();    
            if(provinsi_id){
                ajaxLoadKabupaten(provinsi_id)
            }else{
                $("#kabupaten").empty();
                $("#kecamatan").empty();
            }      
        });

        $('#kabupaten').change(function(){
            var kabupaten_id = $(this).val();    
            if(kabupaten_id){
                ajaxLoadKecamatan(kabupaten_id)
            }else{
                $("#kecamatan").empty();
            }      
        });
    });

   function ajaxLoadKabupaten(provinsi_id) {
        $.ajax({
            type:"GET",
            url:"/getkabupaten?provinsi_id="+provinsi_id,
            dataType: 'JSON',
            success:function(res){               
                if(res){
                    $("#kabupaten").empty();
                    $("#kecamatan").empty();
                    // $("#kabupaten").append('<option value=""></option>');
                    // $("#kecamatan").append('<option value=""></option>');
                    let elements = '<option value="" selected></option>'
                    $.each(res,function(nama_kabupaten, id){
                        elements += '<option value="'+id+'">'+nama_kabupaten+'</option>'
                        // $("#kabupaten").append('<option value="'+id+'">'+nama_kabupaten+'</option>');
                        $("#kabupaten").html(elements)
                    });

                    $('#kabupaten option[value=""]').prop('selected', true);
                }else{
                $("#kabupaten").empty();
                $("#kecamatan").empty();
                }
            }
        });
   }

   function ajaxLoadKecamatan(kabupaten_id) {
        $.ajax({
           type:"GET",
           url:"/getkecamatan?kabupaten_id="+kabupaten_id,
           dataType: 'JSON',
           success:function(res){               
            if(res){
                $("#kecamatan").empty();
                $("#kecamatan").append('<option  value=""></option>');
                $.each(res,function(nama_kecamatan,id){
                    $("#kecamatan").append('<option value="'+id+'">'+nama_kecamatan+'</option>');
                });
            }else{
               $("#kecamatan").empty();
            }
           }
        });
   }

</script>