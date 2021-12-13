<div class="card">
    <div class="card-content">
        <div class="card-body">
            <h4 class="card-title">Traducir registro {{$nombre}}</h4>
        </div>
        <div class="card-body">
            <form class="form" action="{{route('guardar_traduccion')}}" method="POST" id="form-general">
                @csrf
                <input type="hidden" name="tableName" id="tableName" value="TBL_Tipo_Reserva">
                <input type="hidden" name="idRegistro" id="idRegistro" value="{{$id}}">
                <div class="form-body">
                    <div class="form-group">
                        <h5 class="mt-2">Idioma</h5>
                        <fieldset class="form-group">
                            <select class="form-control" id="TTD_Idioma_Traduccion" name="TTD_Idioma_Traduccion">
                                <option>Select Option</option>
                                @foreach (config('locale.languages') as $idioma)
                                    <option value="{{$idioma[0]}}">{{Lang::get('messages.'.$idioma[0])}}</option>
								@endforeach
                            </select>
                        </fieldset>
                    </div>
                    <div class="form-group">
                        <h5 class="mt-2">Plan</h5>
                        <input type="hidden" name="campoNombre" id="campoNombre" value="TTR_Nombre_Tipo_Reserva">
                        <input type="text" id="nombre" class="form-control" placeholder="Plan" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <h5 class="mt-2">Descripción</h5>
                        <input type="hidden" name="campoDescripcion" id="campoDescripcion" value="TTR_Descripcion_Tipo_Reserva">
                        <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" required></textarea>
                    </div>
                </div>
                <div class="form-actions center">
                    <button type="submit" class="btn btn-outline-primary">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{Lang::get('messages.Close')}}</button>
                </div>
            </form>

            @if (count($traducciones) > 0)
                <table class="table" id="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Campo</th>
                            <th>Idioma</th>
                            <th>Descripción</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($traducciones as $key => $traduccion)
                            <tr>
                                <th scope="row">{{++$key}}</th>
                                <td>{{$traduccion->TTD_Campo_Traduccion}}</td>
                                <td>{{Lang::get('messages.'.$traduccion->TTD_Idioma_Traduccion)}}</td>
                                <td>{{$traduccion->TTD_Descripcion_Traduccion}}</td>
                                <td>
                                    <a href="{{route('editar_traduccion', $traduccion->id)}}" class="editar-registro">
                                        <i class="la la-pencil"></i>
                                    </a>
                                    <form action="{{route('eliminar_traduccion', $traduccion->id)}}" class="eliminar-registro d-inline" method="POST">
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
            @else
                No hay registros
            @endif
        </div>
    </div>
</div>
