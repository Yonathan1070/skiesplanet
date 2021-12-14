<table class="table" id="data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>{{Lang::get('messages.plan')}}</th>
            <th>{{Lang::get('messages.descripcion')}}</th>
            <th>{{Lang::get('messages.valor')}}</th>
            <th>{{Lang::get('messages.traduccion')}}</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($planes as $key => $plan)
            <tr id="row{{$plan->id}}">
                <th scope="row">{{++$key}}</th>
                <?php $campoNombre = App\Models\Traduccion::obtenerCampo('TBL_Tipo_Reserva', $plan->id, session()->get('locale'), 'TTR_Nombre_Tipo_Reserva'); ?>
                <td>{{(!$campoNombre) ? $plan->TTR_Nombre_Tipo_Reserva : $campoNombre->TTD_Descripcion_Traduccion}}</td>
                <?php $campoDescripcion = App\Models\Traduccion::obtenerCampo('TBL_Tipo_Reserva', $plan->id, session()->get('locale'), 'TTR_Descripcion_Tipo_Reserva'); ?>
                <td>{{(!$campoDescripcion) ? $plan->TTR_Descripcion_Tipo_Reserva : $campoDescripcion->TTD_Descripcion_Traduccion}}</td>
                <td>{{$plan->TTR_Costo_Tipo_Reserva}}</td>
                <td>
                    <a href="{{route('traduccion')}}" class="traducir-registro" data-id="{{$plan->id}}">
                        {{Lang::get('messages.traduccion')}}
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
                            <i class="la la-trash text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div id="paginador">
    <a href="{{$planes->previousPageUrl()}}" class="btn btn-info btn-min-width mr-1 mb-1 {{($planes->previousPageUrl() == '') ? 'disabled' : ''}} paginate" data-url="{{route('page_planes')}}">{{Lang::get('messages.Previous')}}</a>
    <a href="{{$planes->nextPageUrl()}}" class="btn btn-info btn-min-width mr-1 mb-1 {{($planes->nextPageUrl() == '') ? 'disabled' : ''}} paginate" data-url="{{route('page_planes')}}">{{Lang::get('messages.Next')}}</a>
</div>