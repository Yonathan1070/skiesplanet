<div class="card">
    <div class="card-content">
        <div class="card-body">
            <h4 class="card-title">{{Lang::get('messages.agregarPlan')}}</h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{route('guardar_plan')}}" method="POST" id="form-general">
                @csrf
                @include('administracion.planes.form')
                <div class="form-actions center">
                    <button type="submit" class="btn btn-outline-primary">{{Lang::get('messages.guardar')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('messages.cerrar')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>