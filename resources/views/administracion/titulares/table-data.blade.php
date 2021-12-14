<table class="table table-bordered table-striped" id="data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>{{Lang::get('messages.nombreTitular')}}</th>
            <th>{{Lang::get('messages.plan')}}</th>
            <th>{{Lang::get('messages.fecha')}}</th>
            <th>{{Lang::get('messages.horas')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($titulares as $key => $titular)
            <tr>
                <th scope="row">{{++$key}}</th>
                <td>{{$titular->reserva->titular->TUS_Nombre_Completo_Usuario}}</td>
                <?php $campoNombre = App\Models\Traduccion::obtenerCampo('TBL_Tipo_Reserva', $titular->reserva->tipo_reserva->id, session()->get('locale'), 'TTR_Nombre_Tipo_Reserva'); ?>
                <td>{{(!$campoNombre) ? $titular->reserva->tipo_reserva->TTR_Nombre_Tipo_Reserva : $campoNombre->TTD_Descripcion_Traduccion}} {{($titular->reserva->tipo_reserva->TTR_Select_Ciudad_Tipo_Reserva == 1) ? ' - '.App\Models\Ciudad::obtener($titular->reserva->TRE_Ciudad_Id)->TCI_Nombre_Ciudad : (($titular->reserva->tipo_reserva->TTR_Select_Pais_Tipo_Reserva == 1) ? ' - '.App\Models\Pais::obtener($titular->reserva->TRE_Pais_Id)->TPA_Nombre_Pais_Espanol : '')}}</td>
                <td>{{Lang::get('messages.'.Carbon\Carbon::createFromFormat('m-d', $titular->reserva->TRE_Fecha_Reserva)->format('F')).' '.Carbon\Carbon::createFromFormat('m-d', $titular->reserva->TRE_Fecha_Reserva)->format('d')}}</td>
                <?php $horas = explode(',', $titular->reserva->TRE_Hora_Reserva); ?>
                <td>
                    @foreach ($horas as $hora)
                        @if ($hora != '')
                            <?php $splitHora = explode('-', $hora); ?>
                            <a href="{{route('cambiar_titular', ['id'=>$titular->id])}}" class="editar-registro" data-hora="{{$hora}}">
                                {{Carbon\Carbon::createFromFormat('H:i', $splitHora[0].':00')->format('g:i A').' - '.Carbon\Carbon::createFromFormat('H:i', $splitHora[1].':00')->format('g:i A')}}<br>
                            </a>
                        @endif
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div id="paginador">
    <a href="{{$titulares->previousPageUrl()}}" class="btn btn-info btn-min-width mr-1 mb-1 {{($titulares->previousPageUrl() == '') ? 'disabled' : ''}} paginate" data-url="{{route('page_titulares')}}">{{Lang::get('messages.Previous')}}</a>
    <a href="{{$titulares->nextPageUrl()}}" class="btn btn-info btn-min-width mr-1 mb-1 {{($titulares->nextPageUrl() == '') ? 'disabled' : ''}} paginate" data-url="{{route('page_titulares')}}">{{Lang::get('messages.Next')}}</a>
</div>