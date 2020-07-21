/**
 * SCRIPTS ESPECIFICOS PARA EL TRABAJO CON INFORMES DE AVANCES
 */

$(document).ready(function() {
    var view = $('#view').val();
    /* Formulario de Edición */
    if (view == 'edit') {
    }
    if (view == 'show') {
    }
});

function incluir_becario(id) {
    $('#becario_'+id).removeClass('becario_selected');
    if ($('#check_becario_'+id).is(':checked')) {
        $('#becario_'+id).addClass('becario_selected');
    }
}