@if ($view == 'edit')
<hr class="m-t-0 m-b-20">
@endif
<div class="row">
    @if (count($imagenes) > 0)
        @foreach ($imagenes as $r)
            <div id="image_{{ $r->id }}" class="col-md-2">
                <!-- Card -->
                <div class="card img-thumbnail">
                    <a title="Ampliar" class="image-list add-tooltip" onclick="ampliar_imagen('Imagen', '{{ url('image/original/'.$r->id.'_'.$r->imagen) }}')">
                        <img class="card-img-top img-responsive" src="{{ url('image/medium/'.$r->id.'_'.$r->imagen) }}" alt="Imagen">
                    </a>
                    @if ($view == 'edit')
                    <a href="javascript:void(0)" title="Eliminar" data-placement="left" onclick="eliminar_imagen({{ $r->id }})" class="btn btn-danger delete-image-list add-tooltip"><i class="fas fa-trash-alt"></i> </a>
                    @endif
                </div>
                <!-- Card -->
            </div>
        @endforeach
    @else
        <div class="col-md-12">
            <div class="alert alert-warning alert-rounded"> 
                <i class="fa fa-exclamation-triangle"></i> 
                No hay imagenes asociadas a este informe.
            </div>
        </div>
    @endif

</div>
{{ Backend::modal_ampliar_imagen() }}

<script>
$(document).ready(function() {
    // Tooltip
    $('.add-tooltip').tooltip();
});
</script>