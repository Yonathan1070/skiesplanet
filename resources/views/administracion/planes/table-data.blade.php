<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Plan</th>
            <th>Descripción</th>
            <th>Valor</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($planes as $key => $plan)
            <tr>
                <th scope="row">{{++$key}}</th>
                <td>{{$plan->TTR_Nombre_Tipo_Reserva}}</td>
                <td>{{$plan->TTR_Descripción_Plan}}</td>
                <td>{{$plan->TTR_Costo_Tipo_Reserva}}</td>
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