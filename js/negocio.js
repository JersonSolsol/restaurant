function save() {
    var valor = "correcto";
    var negocio_nombre = $('#negocio_nombre').val();
    var negocio_direccion = $('#negocio_direccion').val();
    var negocio_coordenadas_X = $('#negocio_coordenadas_X').val();
    var negocio_coordenadas_Y = $('#negocio_coordenadas_Y').val();
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

    if(negocio_coordenadas_X == ""){
        alertify.error('No se ha introducido las Coordenadas X');
        $('#negocio_coordenadas_X').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#negocio_coordenadas_X').css('border','');
    }

    if(negocio_coordenadas_Y == ""){
        alertify.error('No se ha introducido las Coordenadas Y');
        $('#negocio_coordenadas_Y').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#negocio_coordenadas_Y').css('border','');
    }

    if(negocio_ruc == ""){
        alertify.error('No se ha introducido el numero del RUC');
        $('#negocio_ruc').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#negocio_ruc').css('border','');
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
            "&negocio_coordenadas_X=" + negocio_coordenadas_X +
            "&negocio_coordenadas_Y=" + negocio_coordenadas_Y +
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
                    case "3":
                        alertify.error("El Nombre del negocio ya existe");
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
                    case "3":
                        alertify.error("EL usuario ya esta agregado a este negocio");
                        break;
                    default:
                        alertify.error("ERROR DESCONOCIDO");
                }
            }
        });
    }

}

function preguntarSiNoUser(id_negocio_user){
    alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?',
        function(){ deleterUser(id_negocio_user) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function deleterUser(id_negocio_user){
    var cadena = "id_negocio_user=" + id_negocio_user;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Negocio/deleteUser",
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


function saveSucursal() {

    var valor = "correcto";
    var sucursal_nombre = $('#sucursal_nombre').val();
    var sucursal_direccion = $('#sucursal_direccion').val();
    var sucursal_coordenadas_X = $('#sucursal_coordenadas_X').val();
    var sucursal_coordenadas_Y = $('#sucursal_coordenadas_Y').val();
    var sucursal_ruc = $('#sucursal_ruc').val();
    var sucursal_telefono = $('#sucursal_telefono').val();
    var sucursal_ciudad = $('#sucursal_ciudad').val();
    var id = $('#id_negocio').val();


    if(sucursal_nombre == ""){
        alertify.error('El campo Nombre Negocio está vacío');
        $('#sucursal_nombre').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#sucursal_nombre').css('border','');
    }

    if(sucursal_direccion == ""){
        alertify.error('El campo Dirección está vacío');
        $('#sucursal_direccion').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#sucursal_direccion').css('border','');
    }

    if(sucursal_coordenadas_X == ""){
        alertify.error('No se ha introducido las Coordenadas X');
        $('#sucursal_coordenadas_X').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#sucursal_coordenadas_X').css('border','');
    }

    if(sucursal_coordenadas_Y == ""){
        alertify.error('No se ha introducido las Coordenadas Y');
        $('#sucursal_coordenadas_Y').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#sucursal_coordenadas_Y').css('border','');
    }

    if(sucursal_ruc == ""){
        alertify.error('El campo TELEFONO está vacío');
        $('#sucursal_ruc').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#sucursal_ruc').css('border','');
    }

    if(sucursal_telefono == ""){
        alertify.error('El campo TELEFONO está vacío');
        $('#sucursal_telefono').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#sucursal_telefono').css('border','');
    }

    if(sucursal_ciudad == ""){
        alertify.error('El campo de la Ciudad está vacío');
        $('#sucursal_ciudad').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#sucursal_ciudad').css('border','');
    }

    if (valor == "correcto"){
        var cadena = "sucursal_nombre=" + sucursal_nombre +
            "&sucursal_direccion="+ sucursal_direccion +
            "&sucursal_ciudad="+ sucursal_ciudad +
            "&sucursal_coordenadas_X=" + sucursal_coordenadas_X +
            "&sucursal_coordenadas_Y=" + sucursal_coordenadas_Y +
            "&sucursal_ruc=" + sucursal_ruc +
            "&sucursal_telefono=" + sucursal_telefono +
            "&id="+ id;

        $.ajax({
            type:"POST",
            url: urlweb + "api/Negocio/saveSucursal",
            data: cadena,
            success:function (r) {
                switch (r) {
                    case "1":
                        alertify.success("¡Guardado!");
                        location.href = urlweb +  'Negocio/sucursal/'+ id;
                        break;
                    case "2":
                        alertify.error("Fallo el envio");
                        break;
                    case "3":
                        alertify.error("El Nombre del negocio ya existe");
                        break;
                    default:
                        alertify.error("ERROR DESCONOCIDO");
                }
            }
        });
    }

}


function preguntarSiNoSucursal(id_sucursal){
    alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?',
        function(){ deleterSucursal(id_sucursal) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function deleterSucursal(id_sucursal){
    var cadena = "id_sucursal=" + id_sucursal;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Negocio/deleteSucursal",
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