function save() {
    var valor = "correcto";
    var negocio_nombre = $('#negocio_nombre').val();
    var negocio_direccion = $('#negocio_direccion').val();
    var negocio_coordenadas = $('#negocio_coordenadas').val();
    var negocio_ruc = $('#negocio_ruc').val();
    var negocio_telefono = $('#negocio_telefono').val();
    var negocio_ciudad = $('#negocio_ciudad').val();


    if(negocio_nombre == ""){
        alertify.error('El campo Nombre Negocio está vacío');
        $('#negocio_nombre').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#negocio_nombre').css('border','');
    }

    if(negocio_direccion == ""){
        alertify.error('El campo Dirección está vacío');
        $('#negocio_direccion').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#negocio_direccion').css('border','');
    }

    if(negocio_coordenadas == ""){
        alertify.error('No se ha introducido las Coordenadas');
        $('#negocio_coordenadas').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#negocio_coordenadas').css('border','');
    }

    if(negocio_telefono == ""){
        alertify.error('El campo TELEFONO está vacío');
        $('#negocio_telefono').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#negocio_telefono').css('border','');
    }

     if(negocio_ciudad == ""){
        alertify.error('El campo de la Ciudad está vacío');
        $('#negocio_ciudad').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#negocio_ciudad').css('border','');
    }

    if (valor == "correcto"){
        var cadena = "negocio_nombre=" + negocio_nombre +
            "&negocio_ciudad="+ negocio_ciudad +
            "&negocio_direccion=" + negocio_direccion +
            "&negocio_coordenadas=" + negocio_coordenadas +
            "&negocio_ruc=" + negocio_ruc +
            "&negocio_telefono=" + negocio_telefono;

        $.ajax({
            type:"POST",
            url: urlweb + "api/Negocio/save",
            data: cadena,
            success:function (r) {
                switch (r) {
                    case "1":
                        alertify.success("¡Guardado!");
                        location.href = urlweb +  'Negocio/all';
                        break;
                    case "2":
                        alertify.error("Fallo el envio");
                        break;
                    default:
                        alertify.error("ERROR DESCONOCIDO");
                }
            }
        });
    }

}

function preguntarSiNo(id){
    alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?',
        function(){ deleter(id) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function deleter(id){
    var cadena = "id=" + id;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Negocio/delete",
        data : cadena,
        success:function (r) {
            if(r==1){
                alertify.success('Registro Eliminado');
                location.reload();
            } else {
                alertify.error('No se pudo realizar');
            }
        }
    });
}

function saveRoleUser() {
    var valor = "correcto";
    var user = $('#id_user').val();
    var role = $('#id_rol').val();
    var id = $('#id_negocio').val();


    if(user == ""){
        alertify.error('El campo Usuario no fue seleccionado');
        $('#id_user').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#id_user').css('border','');
    }

    if(role == ""){
        alertify.error('El campo del Rol no fue seleccionado');
        $('#id_rol').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#id_rol').css('border','');
    }


    if (valor == "correcto"){
        var cadena = "&user="+ user +
            "&role="+ role +
            "&id="+ id;


        $.ajax({
            type:"POST",
            url: urlweb + "api/Negocio/saveRoleUser",
            data: cadena,
            success:function (r) {
                switch (r) {
                    case "1":
                        alertify.success("¡Guardado!");
                        location.href = urlweb +  'Negocio/gestionar/' + id;
                        break;
                    case "2":
                        alertify.error("Fallo el envio");
                        break;
                    default:
                        alertify.error("ERROR DESCONOCIDO");
                }
            }
        });
    }

}