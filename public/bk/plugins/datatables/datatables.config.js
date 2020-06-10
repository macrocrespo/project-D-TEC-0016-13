function datatable_config(listado_id) {
    // Título
    var title = $('#'+listado_id+'_titulo').val();
    if (title == '') { title = document.title; }
    else { title = 'Guía Master - '+title; }
    // Config
    return {
        "initComplete": function(settings, json) {
            /*listado_completo();*/
        },
        "dom": 'Bfrtip',
        "language": 
        {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ resultados",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "No se encontraron resultados",
            "sInfo":           "Mostrando del _START_ al _END_. Total: _TOTAL_",
            "sInfoEmpty":      "Mostrando 0 resultados",
            "sInfoFiltered":   "| Total general: _MAX_",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "&Uacute;ltimo",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Ordenar ascendente",
                "sSortDescending": ": Ordenar descendente"
            }
        },
    
        // setup buttons extentension: http://datatables.net/extensions/buttons/
        buttons: [
            {titleAttr: 'Exportar a Excel', title: title, text: '<i class="fas fa-file-excel"></i>', extend:"excel",className:"btn btn-outline-success", exportOptions: {columns: '.export'}},
            {titleAttr: 'Generar PDF', title: title, text: '<i class="fas fa-file-pdf"></i>', extend:"pdf",className:"btn btn-outline-danger", exportOptions: {columns: '.export'}},
            {titleAttr: 'Imprimir', title: title, text: '<i class="fas fa-print"></i>', extend:"print",className:"btn btn-outline-secondary", exportOptions: {columns: '.export'}}
        ],
        // setup responsive extension: http://datatables.net/extensions/responsive/
        responsive: false,
        "order": [],
        "lengthMenu": [
            [5, 10, 20, 50, -1],
            [5, 10, 20, 50, "Todos"] // change per page values here
        ],
        // set the initial value
        "pageLength": 10,
        "autoWidth": false,
    };
}