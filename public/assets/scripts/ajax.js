function ajaxRequest(url, data, action, modal, form){
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(respuesta){
            if (action == 'tipoReserva'){
                if(respuesta.tipo != 'error'){
                    $('#'+modal).html(respuesta);
                    paises();
                }else{
                    alert("Error");
                }
            }else if (action == 'paises'){
                if(respuesta.tipo != 'error'){
                    $('#'+modal).html(respuesta);
                }else{
                    alert("Error");
                }
            }else if (action == 'agregar-hora'){
                if(respuesta.tipo != 'error'){
                    $('#'+modal).html(respuesta);
                    data.horas_array = $('#horas-array').val();
                    var total = $('#cantidad-horas').val() * $('#precio-reserva').val();
                    $('#total').html(total.toString()+" US");
                    ajaxRequest(data.successUrl, data, 'actualizar_lista', 'horas_lista');
                }else{
                    alert("Error");
                }
            }else if (action == 'actualizar_lista'){
                if(respuesta.tipo != 'error'){
                    $('#'+modal).html(respuesta);
                    hora_0_12();
                    hora_12_24();
                }else{
                    alert("Error");
                }
            }else if (action == 'reservar'){
                if(respuesta.tipo != 'error'){
                    
                }else{
                    alert("Error");
                }
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown, error){
            $(".preloader").fadeOut();
            if (XMLHttpRequest.readyState == 4) {
                alert('HTTP: '+XMLHttpRequest.statusText);
            }
            else if (XMLHttpRequest.readyState == 0) {
                alert('Red: '+XMLHttpRequest.statusText);
            }
            else {
                var errors = error.responseJSON.errors;
                $.each(errors, function(key, val) {
                    $.each(val, function(key, mensaje){
                        console.log(mensaje);
                    });
                    return false;
                });
            }
        }
    });
}

function paises(){
    $('#paisId').on('change', function() {
        var data = {};
        data = {
            _token: $('input[name=_token]').val(),
            pais: $( "#paisId option:selected" ).val()
        };
        ajaxRequest($( "#paisId option:selected" ).data('url'), data, 'paises', 'ciudades');
    });
}

function hora_0_12(){
    $('#hora-0-12').on('click', '.hora', function(event){
        event.preventDefault();
        var selected = $(this).data('selected');
        if(selected == '0'){
            $(this).data('selected', '1');
        }else{
            $(this).data('selected', '0');
        }
        var data = {};
        
        data = {
            _token: $('input[name=_token]').val(),
            tipoReserva: $('#tipo-reserva').val(),
            fecha: $('#fecha').val(),
            hora: $(this).data('hora'),
            horas_array: $('#horas-array').val(),
            selected: selected,
            successUrl: $(this).data('successurl')
        };
        ajaxRequest($(this).attr('href'), data, 'agregar-hora', 'horas');
    });
}

function hora_12_24(){
    $('#hora-12-24').on('click', '.hora', function(event){
        event.preventDefault();
        var selected = $(this).data('selected');
        if(selected == '0'){
            $(this).data('selected', '1');
        }else{
            $(this).data('selected', '0');
        }
        
        var data = {};
        
        data = {
            _token: $('input[name=_token]').val(),
            tipoReserva: $('#tipo-reserva').val(),
            fecha: $('#fecha').val(),
            hora: $(this).data('hora'),
            horas_array: $('#horas-array').val(),
            selected: selected,
            successUrl: $(this).data('successurl')
        };
        ajaxRequest($(this).attr('href'), data, 'agregar-hora', 'horas');
    });
}

$('#accion-reservar').on('submit', '#form-general', function(event){
    var horasSeleccionadas = $('#horas_seleccionadas').val();
    if(horasSeleccionadas == '0'){
        var span = document.getElementById('spn_error');
        span.style.color = 'red';
        span.style.fontWeight = 'bold';
        return false;
    }
});