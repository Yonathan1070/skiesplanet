<div class="row">
    <div class="col-md-6 bg-light main_grid_contact">
        <div class="form">
            <div class="feedback-grids">
                <div class="list-group" id="hora-0-12">
                    @foreach ($horas0_12 as $hora)
                        <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                            data-hora="{{$hora[0]}}" data-selected="{{$hora[1]}}" data-successurl="{{route('actualizar_lista_horas')}}">
                            <?php $hora_split = explode("-", $hora[0]); ?>
                            {{$hora_split[0].':00'}} - {{$hora_split[1].':00'}}
                            <span class="badge {{($hora[1] == 0) ? 'bg-success' : 'bg-danger'}} rounded-pill text-white">{{($hora[1] == 0) ? 'Disponible' : 'Ocupado'}}</span>
                        </a>
                    @endforeach
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 main_grid_contact">
        <div class="form">
            <div class="feedback-grids">
                <div class="list-group" id="hora-12-24">
                    @foreach ($horas12_24 as $hora)
                        <a href="{{route('agregar_hora')}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-cente hora"
                            data-hora="{{$hora[0]}}" data-selected="{{$hora[1]}}" data-successurl="{{route('actualizar_lista_horas')}}">
                            <?php $hora_split = explode("-", $hora[0]); ?>
                            {{$hora_split[0].':00'}} - {{$hora_split[1].':00'}}
                            <span class="badge {{($hora[1] == 0) ? 'bg-success' : 'bg-danger'}} rounded-pill text-white">{{($hora[1] == 0) ? 'Disponible' : 'Ocupado'}}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>