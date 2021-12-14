<div class="form-body">
    <div class="form-group">
        <h5 class="mt-2">{{Lang::get('messages.nombre')}}</h5>
        <input type="text" id="TTR_Nombre_Tipo_Reserva" class="form-control" placeholder="{{Lang::get('messages.nombre')}}" name="TTR_Nombre_Tipo_Reserva" value="{{old('TTR_Nombre_Tipo_Reserva', $tipoReserva->TTR_Nombre_Tipo_Reserva ?? '')}}" required>
    </div>
    <div class="form-group">
        <h5 class="mt-2">{{Lang::get('messages.descripcion')}}</h5>
        <textarea name="TTR_Descripcion_Tipo_Reserva" id="TTR_Descripcion_Tipo_Reserva" class="form-control" placeholder="{{Lang::get('messages.descripcion')}}" required>{{old('TTR_Descripcion_Tipo_Reserva', $tipoReserva->TTR_Descripcion_Tipo_Reserva ?? '')}}</textarea>
    </div>
    <div class="form-group">
        <h5 class="mt-2">{{Lang::get('messages.valor')}}</h5>
        <input type="number" min="0" id="TTR_Costo_Tipo_Reserva" class="form-control" placeholder="{{Lang::get('messages.valor')}}" name="TTR_Costo_Tipo_Reserva" value="{{old('TTR_Costo_Tipo_Reserva', $tipoReserva->TTR_Costo_Tipo_Reserva ?? '')}}" required>
    </div>
</div>