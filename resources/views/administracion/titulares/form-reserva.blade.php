<div class="form-body">
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label class="mb-2">{{Lang::get('messages.tipoReserva')}}</label>
                <select class="form-control" id="tipoId" name="tipoId" required>
                    <option data-url="{{route('get_paises')}}" value="" selected>{{Lang::get('messages.seleccioneOpcion')}}</option>
                    @foreach ($tipoReservas as $tipo)
                        <?php $campoNombre = App\Models\Traduccion::obtenerCampo('TBL_Tipo_Reserva', $tipo->id, session()->get('locale'), 'TTR_Nombre_Tipo_Reserva'); ?>
                        <option value="{{$tipo->id}}" data-selectpais="{{$tipo->TTR_Select_Pais_Tipo_Reserva}}" data-selectciudad="{{$tipo->TTR_Select_Ciudad_Tipo_Reserva}}" data-url="{{route('get_paises')}}">{{(!$campoNombre) ? $tipo->TTR_Nombre_Tipo_Reserva : $campoNombre->TTD_Descripcion_Traduccion}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-8">
            <div id="paises"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label class="mb-2">{{Lang::get('messages.fecha')}}</label>
                <input class="form-control" type="date" id="fecha" name="fecha" required>
            </div>
        </div>
        <div class="col-lg-4">
            <div id="selectHoras"></div>
        </div>
    </div>
    <div class="row" style="display: none;" id="formTitular">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="mb-2">{{Lang::get('messages.nombreTitular')}}</label>
                <input type="text" class="form-control" name="nombreTitular" id="nombreTitular">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="mb-2">{{Lang::get('messages.correoTitular')}}</label>
                <input type="email" class="form-control" name="correoTitular" id="correoTitular">
            </div>
        </div>
    </div>
    <div class="row">
        <button type="button" id="siguienteReserva" class="btn btn-primary" data-url="{{route('horas_disponibles')}}">{{Lang::get('messages.Next')}}</button>
    </div>
</div>