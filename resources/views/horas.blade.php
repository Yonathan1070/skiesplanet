<input type="hidden" name="horas-array" id="horas-array" value="{{$horas_array}}">
<input type="hidden" name="cantidad-horas" id="cantidad-horas" value="{{$cantidad}}">
<li class="d-flex justify-content-between"><b>{{Lang::get('messages.hora')}}:</b>
    <ul class="w-hours list-unstyled">
        <input type="hidden" name="horas_seleccionadas" id="horas_seleccionadas" value="{{($horas_array == "," || $horas_array == "") ? '0' : '1'}}">
        @if ($horas_array == "," || $horas_array == "")
            <span id="spn_error">{{Lang::get('messages.errorHoras')}}</span>
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

<li class="d-flex justify-content-between">
    <b>{{Lang::get('messages.total')}}:</b>
    <span id="total">0 US</span>
</li>