<table class="table">
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
                <td>{{$titular->reserva->tipo_reserva->TTR_Nombre_Tipo_Reserva}} {{($titular->reserva->tipo_reserva->TTR_Select_Ciudad_Tipo_Reserva == 1) ? ' - '.App\Models\Ciudad::obtener($titular->reserva->TRE_Ciudad_Id)->TCI_Nombre_Ciudad : (($titular->reserva->tipo_reserva->TTR_Select_Pais_Tipo_Reserva == 1) ? ' - '.App\Models\Pais::obtener($titular->reserva->TRE_Pais_Id)->TPA_Nombre_Pais_Espanol : '')}}</td>
                <td>{{Lang::get('messages.'.Carbon\Carbon::createFromFormat('m-d', $titular->reserva->TRE_Fecha_Reserva)->format('F')).' '.Carbon\Carbon::createFromFormat('m-d', $titular->reserva->TRE_Fecha_Reserva)->format('d')}}</td>
                <?php $horas = explode(',', $titular->reserva->TRE_Hora_Reserva); ?>
                <td>
                    @foreach ($horas as $hora)
                        @if ($hora != '')
                            <?php $splitHora = explode('-', $hora); ?>
                            <a href="#" class="editar-registro" data-info="{{'id='.$titular->id.'-hora='.$hora}}">
                                {{Carbon\Carbon::createFromFormat('H:i', $splitHora[0].':00')->format('g:i A').' - '.Carbon\Carbon::createFromFormat('H:i', $splitHora[1].':00')->format('g:i A')}}<br>
                            </a>
                        @endif
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>