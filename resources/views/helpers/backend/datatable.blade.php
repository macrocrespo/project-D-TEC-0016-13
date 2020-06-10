<div class="table-responsive">
    @if (count($registros) > 0)
    <table id="{{ $listado_id }}" class="display table listado table-hover table-striped table-bordered" cellspacing="0" width="100%">
        
        <thead>
            <tr>
                @foreach ($campos as $campo)
                    <th 
                    class="export 
                    @if (isset($alinear[$campo])) text-{{ $alinear[$campo] }} @endif
                    "
                    style="
                    @if (isset($ancho[$campo])) width: {{ $ancho[$campo] }}; @endif
                    "
                    @if (in_array($campo, $no_order)) data-orderable="false" @endif>{{ $tags[$campo] }}</th>
                @endforeach
                @if (isset($opciones))
                    <th class="text-center"
                    style="
                    @if (isset($ancho['opciones'])) width: {{ $ancho['opciones'] }}; @else width: 120px; @endif
                    "
                    data-orderable="false">{{ $tags['opciones'] }}</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @foreach($registros as $id => $registro)
            <tr id="tr-{{ $id }}">
                @foreach ($campos as $campo)
                    <td class=" 
                    @if (isset($alinear[$campo])) text-{{ $alinear[$campo] }} @endif
                    ">{!! $registro[$campo] !!}</td>
                @endforeach

                @if (isset($opciones))
                <td class="text-center">

                    @if (isset($opciones['detalles']) && $opciones['detalles'])
                    <button data-toggle="tooltip" title="Detalles" onclick="location.href='{{ url($admin_url.'/'.$controlador.'/'.$id) }}';" 
                        class="btn btn-sm waves-effect waves-light btn-outline-info"><i class="fas fa-check-circle"></i></button>
                    @endif

                    @if (isset($opciones['editar']) && $opciones['editar'])
                    <button data-toggle="tooltip" title="Editar" onclick="location.href='{{ url($admin_url.'/'.$controlador.'/'.$id.'/edit') }}';" 
                        class="btn btn-sm waves-effect waves-light btn-outline-warning"><i class="fas fa-pencil-alt"></i></button>
                    @endif
                    @if (isset($opciones['eliminar']) && $opciones['eliminar'])
                    <button data-toggle="tooltip" title="Eliminar" onclick="confirmar_eliminar(<?php echo $id; ?>);" 
                        class="btn btn-sm waves-effect waves-light btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                    @endif
                    @if (isset($opciones['adicionales']) && count($opciones['adicionales']) > 0)
                        @foreach ($opciones['adicionales'] as $opcion_adicional)
                            {!! str_replace('**id**', $id, $opcion_adicional) !!}
                        @endforeach
                    @endif
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>

    </table>
    <input type="hidden" id="{{ $listado_id }}_titulo" value="{{ $titulo }}">

    @if (isset($opciones) && (isset($opciones['eliminar'])) && $opciones['eliminar'])
    <div id="modal-eliminar" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header bg-danger text-white">
                    <h4 class="modal-title"><i class="fas fa-trash-alt m-r-5"></i> Confirmar eliminación</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    {{ $mensaje_eliminar }}
                    <input type="hidden" id="eliminar_id" value="" />
                    @csrf
                </div>
                <div class="modal-footer">
                    <button onclick="eliminar();" type="button" class="btn waves-effect waves-light btn-danger" data-dismiss="modal">
                        <i class="fas fa-trash-alt m-r-5"></i> Eliminar</button>
                    <button type="button" class="btn waves-effect waves-light btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @else
        <div class="alert alert-warning">{{ $mensaje }}</div>
    @endif
</div>
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    var listado_id = '{{ $listado_id }}';
    var config = datatable_config(listado_id);
    var table = $('#'+listado_id).DataTable(config);
});
</script>