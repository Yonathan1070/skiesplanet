<div class="form-body">
    <div class="form-group">
        <h5 class="mt-2">{{Lang::get('messages.nombreTitular')}}</h5>
        <input type="text" id="TUS_Nombre_Completo_Usuario" class="form-control" placeholder="{{Lang::get('messages.nombreTitular')}}" name="TUS_Nombre_Completo_Usuario" value="{{old('TUS_Nombre_Completo_Usuario', $pago->reserva->titular->TUS_Nombre_Completo_Usuario ?? '')}}" required>
    </div>
    <div class="form-group">
        <h5 class="mt-2">{{Lang::get('messages.correoTitular')}}</h5>
        <input type="email" name="TUS_Correo_Electronico_Usuario" id="TUS_Correo_Electronico_Usuario" class="form-control" placeholder="{{Lang::get('messages.correoTitular')}}" value="{{old('TUS_Correo_Electronico_Usuario', $pago->reserva->titular->TUS_Correo_Electronico_Usuario ?? '')}}" required>
    </div>
    <div class="form-group">
        <h5 class="mt-2">{{Lang::get('messages.tipoReserva')}}</h5>
        <?php $campoNombre = App\Models\Traduccion::obtenerCampo('TBL_Tipo_Reserva', $pago->reserva->tipo_reserva->id, session()->get('locale'), 'TTR_Nombre_Tipo_Reserva'); ?>
        <h5 class="mt-2">{{(!$campoNombre) ? $pago->reserva->tipo_reserva->TTR_Nombre_Tipo_Reserva : $campoNombre->TTD_Descripcion_Traduccion}}</h5>
    </div>
    <div class="form-group">
        <h5 class="mt-2">{{Lang::get('messages.fecha')}}</h5>
        <h5 class="mt-2">{{Lang::get('messages.'.Carbon\Carbon::createFromFormat('m-d', $pago->reserva->TRE_Fecha_Reserva)->format('F')).' '.Carbon\Carbon::createFromFormat('m-d', $pago->reserva->TRE_Fecha_Reserva)->format('d')}}</h5>
    </div>
    <div class="form-group">
        <h5 class="mt-2">{{Lang::get('messages.hora')}}</h5>
        <?php $splitHora = explode('-', $hora); ?>
        <h5 class="mt-2">{{Carbon\Carbon::createFromFormat('H:i', $splitHora[0].':00')->format('g:i A').' - '.Carbon\Carbon::createFromFormat('H:i', $splitHora[1].':00')->format('g:i A')}}</h5>
    </div>
</div>