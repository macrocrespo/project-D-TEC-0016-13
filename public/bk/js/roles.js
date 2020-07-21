/**
 * SCRIPTS ESPECIFICOS PARA EL TRABAJO CON ROLES
 */

$(document).ready(function() {
    var view = $('#view').val();
    /* Formulario de Edición */
    if (view == 'edit') {
        $('input[type="radio"]').on('change', function () {
            var id = $('#id').val();
            var name = $(this).attr('name');
            var value = 0;
            if( $('#'+name+'_si').is(':checked')) {  
                value = 1;
            }
            var base_url = $('#base_url').val();
            var controller = $('#controller').val();
            var token = $('input[name="_token"]').val();
            var url = base_url + '/' + controller + '/permiso';
            $.ajax({
                type: "POST",
                url: url,
                data: {_token: token, id: id, permiso: name, value: value},
                cache: false,
                success: function () {
                    
                }
            });
        });
    }
});