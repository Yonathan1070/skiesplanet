<table class="table" id="data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Plan</th>
            <th>Descripción</th>
            <th>Valor</th>
            <th>Traducción</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($planes as $key => $plan)
            <tr>
                <th scope="row">{{++$key}}</th>
                <?php $campoNombre = App\Models\Traduccion::obtenerCampo('TBL_Tipo_Reserva', $plan->id, session()->get('locale'), 'TTR_Nombre_Tipo_Reserva'); ?>
                <td>{{(!$campoNombre) ? $plan->TTR_Nombre_Tipo_Reserva : $campoNombre->TTD_Descripcion_Traduccion}}</td>
                <?php $campoDescripcion = App\Models\Traduccion::obtenerCampo('TBL_Tipo_Reserva', $plan->id, session()->get('locale'), 'TTR_Descripcion_Tipo_Reserva'); ?>
                <td>{{(!$campoDescripcion) ? $plan->TTR_Descripcion_Tipo_Reserva : $campoDescripcion->TTD_Descripcion_Traduccion}}</td>
                <td>{{$plan->TTR_Costo_Tipo_Reserva}}</td>
                <td>
                    <a href="{{route('traduccion')}}" class="traducir-registro" data-id="{{$plan->id}}">
                        Traducción
                    </a>
                </td>
                <td>
                    <a href="{{route('editar_plan', $plan->id)}}" class="editar-registro">
                        <i class="la la-pencil"></i>
                    </a>
                    <form action="{{route('eliminar_plan', $plan->id)}}" class="eliminar-registro d-inline" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn-accion-tabla">
                            <i class="la la-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>