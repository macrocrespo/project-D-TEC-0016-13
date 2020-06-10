/**
 * SCRIPTS ESPECIFICOS PARA EL TRABAJO CON INFORMES COMUNES
 */

$(document).ready(function() {
    var view = $('#view').val();
    /* Formulario de Edición */
    if (view == 'edit') {
        $('#form_upload_image').on('submit', function(event) {
            event.preventDefault();
            upload_image();
        });
        $('#form-field-nueva_imagen #nueva_imagen').on('click', function () {
            $('#form-field-nueva_imagen').removeClass('error');
        });
        listado_imagenes();
    }
    if (view == 'show') {
        listado_imagenes();
    }
});

function upload_image()
{
    var imagen = $('#nueva_imagen').val();
    if (imagen.length > 0) {
        $('#form-field-nueva_imagen').removeClass('error');
        var base_url = $('#base_url').val();
        var controller = $('#controller').val();
        var token = $('input[name="_token"]').val();
        var url = base_url + '/' + controller + '/images_add';

        var form = $('#form_upload_image')[0];
        var data = new FormData(form);
        $("#btn_upload_image").attr('disabled', 'disabled');
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: url,
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (result) {
                $("#btn_upload_image").removeAttr("disabled");
                $('#form_upload_image span[data-dismiss="fileinput"]').click();
                listado_imagenes();
            },
        });
    }
    else {
        $('#form-field-nueva_imagen').addClass('error');
    }
}

function listado_imagenes() {
    var base_url = $('#base_url').val();
    var controller = $('#controller').val();
    var token = $('input[name="_token"]').val();
    var url = base_url + '/' + controller + '/images_list';
    var id = $('#id').val();
    var view = $('#view').val();

    $.ajax({
        type: "POST",
        url: url,
        data: {_token: token, id: id, view: view},
        cache: false,
        success: function (html) {
            $('#listado_imagenes').html(html);
        },
    });
}

function eliminar_imagen(id) {
    var base_url = $('#base_url').val();
    var controller = $('#controller').val();
    var token = $('input[name="_token"]').val();
    var url = base_url + '/' + controller + '/images_delete';

    $.ajax({
        type: "POST",
        url: url,
        data: {_token: token, id: id},
        cache: false,
        success: function () {
            $('#image_'+id).fadeOut('slow', function() {
                listado_imagenes();
            });
        },
    });
}