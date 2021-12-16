<div class="card">
    <div class="card-content">
        <div class="card-body">
            <h4 class="card-title">{{Lang::get('messages.agregarReserva')}}</h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{route('guardar_reserva')}}" method="POST" id="form-general">
                @csrf
                @include('administracion.titulares.form-reserva')
                <div class="form-actions center">
                    <button type="submit" class="btn btn-outline-primary" id="guardarTitular" disabled>{{Lang::get('messages.guardar')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('messages.cerrar')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>