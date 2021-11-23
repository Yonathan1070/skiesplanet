<input type="hidden" name="horas-array" id="horas-array" value="{{$horas_array}}">
<li class="d-flex justify-content-between"><b>Hora:</b>
    <ul class="w-hours list-unstyled">
        @if ($horas_array == "," || $horas_array == "")
            Seleccione una hora
        @endif
        @foreach ($horas as $horas_seleccionadas)
            @if ($horas_seleccionadas != "")
                <li class="d-flex justify-content-between">
                    <?php $horas_2 = explode("-", $horas_seleccionadas) ?>
                    {{$horas_2[0].":00 - ".$horas_2[1].":00"}}
                </li>
            @endif
        @endforeach
    </ul>
</li>