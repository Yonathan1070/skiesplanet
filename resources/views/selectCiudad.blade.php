<div class="form-group" id="ciudad">
    <label class="mb-2">Ciudad</label>
    <select class="form-control" id="ciudadId" name="ciudadId" required>
        <option selected value="">Seleccione una opción</option>
        @foreach ($ciudades as $ciudad)
        <option value="{{$ciudad->id}}">{{$ciudad->TCI_Nombre_Ciudad}}</option>
        @endforeach
    </select>
</div>