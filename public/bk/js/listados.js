/**
 * SCRIPTS ESPECIFICOS PARA EL TRABAJO CON LISTADOS
 */

jQuery(document).ready(function() {
    if (typeof cargar_listado !== 'undefined')
        listado();
    if (typeof aplicar_filtro !== 'undefined')
        filtro();
    if (typeof listado_2 !== 'undefined')
        cargar_listado_2();
});

function listado() {
    var base_url = $('#base_url').val();
    var token = $('input[name="_token"]').val();
    var url = base_url + '/' + controller + url_listado;
    $.ajax({
        type: "POST",
        url: url,
        data: {_token: token},
        cache: false,
        beforeSend: function(){ 
            $("#loading").show(); 
        },
        success: function(html) {
            $('#listado_wrapper').html(html);
            listado_completo();
        }
    });
}

function listado_completo() {
    $("#loading").hide();
    if (typeof call_function_after_listado !== 'undefined')
        after_listado();
}

function confirmar_eliminar(id) {
    var base_url = $('#base_url').val();
    var token = $('input[name="_token"]').val();
    var controller_verify = controller;
    if (controller2 !== '')
        controller_verify = controller2;
    var url = base_url + '/' + controller_verify + '/verify';
    $.ajax({
        type: "POST",
        data: {id: id, _token: token},
        url: url,
        cache: false,
        success: function(respuesta){
            respuesta = parseInt(respuesta);
            if (respuesta == 1) { // Puede eliminar
                $('#eliminar_id').val(id);
                $("#modal-eliminar").modal('show');
            }
            else {
                // $('#mensaje_no_eliminar').modal('show');
            }
        }
    });
}

function eliminar() {
    var base_url = $('#base_url').val();
    var id = $('#eliminar_id').val();
    var token = $('input[name="_token"]').val();
    var controller_delete = controller;
    if (controller2 !== '')
        controller_delete = controller2;
    var url = base_url + '/' + controller_delete + '/delete';
    $.ajax({
        type: "POST",
        data: {id: id, _token: token},
        url: url,
        cache: false,
        success: function() {
            listado();
        }
    });
}

function filtro() {
    $('#form-filtro-'+controller).submit(function(e){
        e.preventDefault();
        var base_url = $('#base_url').val();
        var url = base_url + controller + url_filtro;
        $.ajax({
            type: "POST",
            data: $('#form-filtro-'+controller).serialize(),
            url: url,
            cache: false,
            beforeSend: function(){ 
                $("#loading").show(); 
            },
            success: function(html){
                $('#listado_wrapper').html(html);
                listado_completo();
            }
        });
    });
}

function detalles(id) {
    var url = base_url + controller + url_detalles + '/' + id;
    $.ajax({
        type: "GET",
        url: url,
        cache: false,
        success: function(html){
            $('#modal-detalles #modal-body').html(html);
            $('#modal-detalles').modal('show');
        }
    });
}

function cargar_listado_2() {
    var base_url = $('#base_url').val();
    var url = base_url + controller + url_listado_2;
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        beforeSend: function(){ 
            $('#'+listado_2+'_loading').show(); 
        },
        success: function(html){
            $('#'+listado_2+'_wrapper').html(html);
            listado_2_completo();
        }
    });
}

function listado_2_completo() {
    $('#'+listado_2+'_loading').hide();
}