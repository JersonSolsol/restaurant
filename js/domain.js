var urlweb = "http://localhost:8081/restaurant/";

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function registrarusuario() {
    alert('Usuario Registrado. Ahora inicie sesión.');
    location.href = urlweb + 'admin';
}

function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8 || tecla==46){
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

$(function () {
    $('#example2').DataTable({
        responsive: true,
        "language": {
            sEmptyTable: "No existen datos en esta tabla",
            sInfo: "Mostrando _START_ de _END_ de _TOTAL_ Entradas",
            sInfoEmpty: "0 de 0 de 0 Entradas",
            sInfoFiltered: "(Filtrado de un total de _MAX_ resultados)",
            sInfoPostFix: "",
            sInfoThousands: ".",
            sLengthMenu: "Mostrar _MENU_ Resultados",
            sLoadingRecords: "Cargando resultados...",
            sProcessing: "Espere por favor..",
            sSearch: "Buscar:",
            sZeroRecords: "No se han encontrado resultados.",
            oPaginate: {
                sFirst: "Primero",
                sPrevious: "Anterior",
                sNext: "Siguiente",
                sLast: "Último"
            },
            oAria: {
                sSortAscending: ":Habilitar para ordenar de forma ascendente",
                sSortDescending: ":Habilitar para ordenar de forma descendente"
            }
        }
    });
    $('#example3').DataTable({
        responsive: true,
        "language": {
            sEmptyTable: "No existen datos en esta tabla",
            sInfo: "Mostrando _START_ de _END_ de _TOTAL_ Entradas",
            sInfoEmpty: "0 de 0 de 0 Entradas",
            sInfoFiltered: "(Filtrado de un total de _MAX_ resultados)",
            sInfoPostFix: "",
            sInfoThousands: ".",
            sLengthMenu: "Mostrar _MENU_ Resultados",
            sLoadingRecords: "Cargando resultados...",
            sProcessing: "Espere por favor..",
            sSearch: "Buscar:",
            sZeroRecords: "No se han encontrado resultados.",
            oPaginate: {
                sFirst: "Primero",
                sPrevious: "Anterior",
                sNext: "Siguiente",
                sLast: "Último"
            },
            oAria: {
                sSortAscending: ":Habilitar para ordenar de forma ascendente",
                sSortDescending: ":Habilitar para ordenar de forma descendente"
            }
        }
    });

    $('#example4').DataTable({
        responsive: true,
        "language": {
            sEmptyTable: "No existen datos en esta tabla",
            sInfo: "Mostrando _START_ de _END_ de _TOTAL_ Entradas",
            sInfoEmpty: "0 de 0 de 0 Entradas",
            sInfoFiltered: "(Filtrado de un total de _MAX_ resultados)",
            sInfoPostFix: "",
            sInfoThousands: ".",
            sLengthMenu: "Mostrar _MENU_ Resultados",
            sLoadingRecords: "Cargando resultados...",
            sProcessing: "Espere por favor..",
            sSearch: "Buscar:",
            sZeroRecords: "No se han encontrado resultados.",
            oPaginate: {
                sFirst: "Primero",
                sPrevious: "Anterior",
                sNext: "Siguiente",
                sLast: "Último"
            },
            oAria: {
                sSortAscending: ":Habilitar para ordenar de forma ascendente",
                sSortDescending: ":Habilitar para ordenar de forma descendente"
            }
        }
    });

    $('#example5').DataTable({
        responsive: true,
        "language": {
            sEmptyTable: "No existen datos en esta tabla",
            sInfo: "Mostrando _START_ de _END_ de _TOTAL_ Entradas",
            sInfoEmpty: "0 de 0 de 0 Entradas",
            sInfoFiltered: "(Filtrado de un total de _MAX_ resultados)",
            sInfoPostFix: "",
            sInfoThousands: ".",
            sLengthMenu: "Mostrar _MENU_ Resultados",
            sLoadingRecords: "Cargando resultados...",
            sProcessing: "Espere por favor..",
            sSearch: "Buscar:",
            sZeroRecords: "No se han encontrado resultados.",
            oPaginate: {
                sFirst: "Primero",
                sPrevious: "Anterior",
                sNext: "Siguiente",
                sLast: "Último"
            },
            oAria: {
                sSortAscending: ":Habilitar para ordenar de forma ascendente",
                sSortDescending: ":Habilitar para ordenar de forma descendente"
            }
        }
    });
});


function solonumeros(e) {
    var key = e.keyCode || e.which;
    var teclado = String.fromCharCode(key);
    var numeros = "0123456789";
    var especiales = "8-37-38.46";
    var teclado_especial = false;

    for(var i in especiales){
        if (key==especiales[i]){
            teclado_especial=true;
        }

    }
    if(numeros.indexOf(teclado)==-1&& !teclado_especial){
        return false;
    }
}
function limitText(limitField, limitNum) {
    if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);
    }

}



