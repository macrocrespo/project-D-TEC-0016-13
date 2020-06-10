<tr id="{{ $campo }}" @if ($class != '') class="{{ $class }}" @endif>
    <th id="{{ $campo }}-label" style="@if ($width > 0) width: {{ $width }}px; @endif" scope="row">{{ $label }}</th>
    <td id="{{ $campo }}-value">
        @if ($imagen)
            @if ($value != '' && $value != '-')
            <a data-toggle="tooltip" title="Ampliar imagen" class="img-thumbnail row_details_img" onclick="ampliar_imagen('{{ $label }}', '{{ $value }}')">
                <img style="max-height: 50px; max-width: 100%;" src="{{ $value }}" />
            </a>
            @else
            -
            @endif
        @endif

        @if ($link != '')
            <a target="_blank" href="{{ $link }}">{{ $prefix.$value.$suffix }}</a>
        @elseif (!$imagen && !$archivo)
            {!! $prefix.$value.$suffix !!}
        @endif
    </td>
</tr>