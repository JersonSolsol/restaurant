function saveAgente() {
    var valor = "correcto";
    var agente_nombre = $('#agente_nombre').val();
    var agente_direccion = $('#agente_direccion').val();
    var agente_telefono = $('#agente_telefono').val();
    var agente_ciudad = $('#agente_ciudad').val();


    if(agente_nombre == ""){
        alertify.error('El campo Nombre Agente está vacío');
        $('#agente_nombre').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#agente_nombre').css('border','');
    }

    if(agente_direccion == ""){
        alertify.error('El campo Dirección está vacío');
        $('#agente_direccion').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#agente_direccion').css('border','');
    }

    if(agente_telefono == ""){
        alertify.error('El campo TELEFONO está vacío');
        $('#agente_telefono').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#agente_telefono').css('border','');
    }

    if(agente_ciudad == ""){
        alertify.error('El campo de la Ciudad está vacío');
        $('#agente_ciudad').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#agente_ciudad').css('border','');
    }

    if (valor == "correcto"){
        var cadena = "agente_nombre=" + agente_nombre +
            "&agente_ciudad="+ agente_ciudad +
            "&agente_direccion=" + agente_direccion +
            "&agente_telefono=" + agente_telefono;

        $.ajax({
            type:"POST",
            url: urlweb + "api/Agente/saveAgente",
            data: cadena,
            success:function (r) {
                switch (r) {
                    case "1":
                        alertify.success("¡Agente Guardado!");
                        location.href = urlweb +  'Agente/listar';
                        break;
                    case "2":
                        alertify.error("Fallo el envio");
                        break;
                    case "3":
                        alertify.error("El Nombre del Agente ya existe");
                        break;
                    default:
                        alertify.error("ERROR DESCONOCIDO");
                }
            }
        });
    }

}

function editarAgente() {
    var valor = "correcto";
    var agente_nombre = $('#agente_nombre').val();
    var agente_direccion = $('#agente_direccion').val();
    var agente_telefono = $('#agente_telefono').val();
    var agente_ciudad = $('#agente_ciudad').val();
    var id = $('#id_agente').val();


    if(agente_nombre == ""){
        alertify.error('El campo Nombre Agente está vacío');
        $('#agente_nombre').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#agente_nombre').css('border','');
    }

    if(agente_direccion == ""){
        alertify.error('El campo Dirección está vacío');
        $('#agente_direccion').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#agente_direccion').css('border','');
    }

    if(agente_telefono == ""){
        alertify.error('El campo TELEFONO está vacío');
        $('#agente_telefono').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#agente_telefono').css('border','');
    }

    if(agente_ciudad == ""){
        alertify.error('El campo de la Ciudad está vacío');
        $('#agente_ciudad').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#agente_ciudad').css('border','');
    }

    if (valor == "correcto"){
        var cadena = "agente_nombre=" + agente_nombre +
            "&agente_ciudad="+ agente_ciudad +
            "&agente_direccion=" + agente_direccion +
            "&agente_telefono=" + agente_telefono +
            "&id=" + id;


        $.ajax({
            type:"POST",
            url: urlweb + "api/Agente/saveAgente",
            data: cadena,
            success:function (r) {
                switch (r) {
                    case "1":
                        alertify.success("¡Agente Guardado!");
                        location.href = urlweb +  'Agente/listar';
                        break;
                    case "2":
                        alertify.error("Fallo el envio");
                        break;
                    case "3":
                        alertify.error("El Nombre del Agente ya existe");
                        break;
                    default:
                        alertify.error("ERROR DESCONOCIDO");
                }
            }
        });
    }

}


function preguntarSiNoAgente(id){
    alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?',
        function(){ deleter(id) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function deleter(id){
    var cadena = "id=" + id;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Agente/deleteAgente",
        data : cadena,
        success:function (r) {
            if(r==1){
                alertify.success('Agente Eliminado');
                location.reload();
            } else {
                alertify.error('No se pudo realizar');
            }
        }
    });
}