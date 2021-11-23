@if ($tipoReserva)
    @if ($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1)
        <div class="form-group" id="pais">
            <label class="mb-2">País</label>
            <select class="form-control" id="paisId" name="paisId" required>
                <option selected data-url="{{route('get_ciudades')}}">Seleccione una opción</option>
                @foreach ($paises as $pais)
                    <option value="{{$pais->id}}" data-url="{{route('get_ciudades')}}">{{$pais->TPA_Nombre_Pais_Espanol}}</option>
                @endforeach
            </select>
        </div>
    @endif
    @if ($tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1)
        <div id="ciudades"></div>
    @endif
@endif