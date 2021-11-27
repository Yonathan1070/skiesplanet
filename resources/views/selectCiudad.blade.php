<div class="form-group" id="ciudad">
    <label class="mb-2">{{Lang::get('messages.ciudad')}}</label>
    <select class="form-control" id="ciudadId" name="ciudadId" required>
        <option selected value="">{{Lang::get('messages.seleccioneOpcion')}}</option>
        @foreach ($ciudades as $ciudad)
        <option value="{{$ciudad->id}}">{{$ciudad->TCI_Nombre_Ciudad}}</option>
        @endforeach
    </select>
</div>