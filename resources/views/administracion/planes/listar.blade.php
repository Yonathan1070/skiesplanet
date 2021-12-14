@extends('administracion.general.layout')

@section('title')
    {{Lang::get('messages.planes')}}
@endsection
@section('styles')
    
@endsection
@section('contenido')
    <input type="hidden" id="modalName" data-modal="accion-plan">
    <input type="hidden" id="tableName" value="TBL_Tipo_Reserva">
    @csrf
    <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2"></div>
        <div class="content-header-right col-md-8 col-12"></div>
    </div>
    <div class="content-body"><!-- Basic Tables start -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{Lang::get('messages.listadoPlanes')}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a href="{{route('crear_plan')}}" id="nuevo-registro"><i class="la la-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="table-responsive" id="tabla-data">
                                @include('administracion.planes.table-data')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="accion-plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
@endsection