<div class="form-group" id="horas">
    <label class="mb-2">{{Lang::get('messages.horas')}}</label>
    <?php $splitHoras = explode(",", $horas); ?>
    <select class="form-control" id="hora" name="hora" required>
        <option selected value="">{{Lang::get('messages.seleccioneOpcion')}}</option>
        @foreach ($splitHoras as $hora)
            <option value="{{$hora}}">
                <?php $splitHora = explode("-", $hora); ?>
                {{Carbon\Carbon::createFromFormat('H:i', $splitHora[0].':00')->format('g:i A').' - '.Carbon\Carbon::createFromFormat('H:i', $splitHora[1].':00')->format('g:i A').', '}}
            </option>
        @endforeach
    </select>
</div>