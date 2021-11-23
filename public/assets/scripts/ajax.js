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

$('#hora-0-12').on('click', '.hora', function(event){
    event.preventDefault();
    
    var data = {};
    
    data = {
        _token: $('input[name=_token]').val(),
        hora: $(this).data('hora'),
        horas_array: $('#horas-array').val()
    };
    ajaxRequest($(this).attr('href'), data, 'agregar-hora', 'horas');
});

$('#hora-12-24').on('click', '.hora', function(event){
    event.preventDefault();
    alert($('#horas-array').val());
    
    var data = {};
    
    data = {
        _token: $('input[name=_token]').val(),
        hora: $(this).data('hora'),
        horas_array: $('#horas-array').val()
    };
    ajaxRequest($(this).attr('href'), data, 'agregar-hora', 'horas');
});