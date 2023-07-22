function listar_municipio(codigo_estado){
    $.ajax({
        url:'../../controllers',
        type:'POST',
        data:{
            codigo_estado: codigo_estado
        }
    }).done(function(resp){
        var data = JSON.parse(resp);
        var cadena="";
        if(data.length > 0){
            for (var i = 0; i < data.length; i++) {
                cadena += "<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            $("#sel_municipio").html(cadena);
        }else{
            cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
            $("#sel_municipio").html(cadena);
        }
    });
}
