<div class="card">
    <div class="card-content">
        <div class="card-body">
            <h4 class="card-title">{{Lang::get('messages.editarPlan')}} {{$tipoReserva->TTR_Nombre_Tipo_Reserva}}</h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{route('actualizar_plan', ['id' => $tipoReserva->id])}}" method="POST" id="form-general">
                @csrf @method('put')
                @include('administracion.planes.form')
                <div class="form-actions center">
                    <button type="submit" class="btn btn-outline-primary">{{Lang::get('messages.guardar')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('messages.cerrar')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>