jQuery(document).ready(function() {
    // Tooltip
    $('.add-tooltip').tooltip();
    // Select 2
    if (typeof select2 !== 'undefined') {
        $('select').select2({
            language: "es"
        });
    }
    // HTML 5 Editor
    if (typeof html5editor !== 'undefined') {
        $('.html5editor').wysihtml5();
    }
    // Validate Form
    if (typeof validate !== 'undefined' && validate) {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }
});

function ampliar_imagen(titulo, url_imagen) {
    $('#modal_imagen_ampliada #modal_titulo span').html(titulo);
    $('#modal_imagen_ampliada #modal_imagen').attr('src', url_imagen);
    $('#modal_imagen_ampliada #modal_imagen').attr('alt', titulo);
    $('#modal_imagen_ampliada').modal('show');
}

function eliminar_imagen_form(campo_imagen) {
    var id = $('#id').val();
    var controller = $('#controller').val();
    var base_url = $('#base_url').val();
    var token = $('input[name="_token"]').val();
    var url = base_url + '/' + controller + '/delete_img';
    $.ajax({
        type: "POST",
        url: url,
        data: {_token: token, id: id, campo_imagen: campo_imagen},
        cache: false,
        success: function() {
            $('#form-field-'+campo_imagen+' .imagen-cargada').remove();
        }
    });
}

function imprimir(id) {
    $("#"+id).print({
        globalStyles: true,
        mediaPrint: true,
    });
}

function anim(id, animation) {
    element = $('#'+id);
    element.addClass('animated ' + animation);
    window.setTimeout( function() {
        element.removeClass('animated ' + animation);
    }, 1500);
}