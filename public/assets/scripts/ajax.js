//Modal de idiomas
const modal = $('#modal-seleccionar-idioma');
if (modal.length && modal.data('idiomaSet') == '0') {
    modal.modal('show');
}

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
                    ciudades();
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
            }else if(action == 'crear' || action == 'editar'){
                if(respuesta.tipo != 'error'){
                    $('#'+modal+' .modal-body').html(respuesta);
                    if(modal="accion-titular"){
                        tipoReservaChange();
                        fechaReserva();
                        validarReserva();
                    }
                    $('#'+modal).modal('show');
                }else{
                    $(".preloader").fadeOut();
                    skiesplanet.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
                }
            }else if(action == 'guardar'){
                if(respuesta.tipo == 'success'){
                    tablaData(respuesta.view, modal);
                }
                $(".preloader").fadeOut();
                skiesplanet.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
            }else if(action == 'actualizar'){
                if(respuesta.tipo == 'success'){
                    tablaData(respuesta.view, modal);
                }
                $(".preloader").fadeOut();
                skiesplanet.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
            }else if(action == 'eliminar'){
                if(respuesta.tipo == 'success'){
                    var row = document.getElementById('row'+respuesta.row);
                    row.parentNode.removeChild(row);
                }
                $(".preloader").fadeOut();
                skiesplanet.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
            }else if(action == 'traducir'){
                $('#'+modal+' .modal-body').html(respuesta);
                $('#'+modal).modal('show');
                $(".preloader").fadeOut();
                skiesplanet.notificaciones(respuesta.mensaje, respuesta.titulo, respuesta.tipo, 5000);
            }else if(action == 'horasDisponibles'){
                console.log("Tipo: "+respuesta.tipo);
                if(respuesta.tipo != 'error'){
                    $('#'+modal).html(respuesta);
                    horasChange();
                }else{
                    $("#siguienteReserva").show();
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
        $('#ciudad').hide();
        $('#horas').hide();
        $('#formTitular').hide();
        $('#siguienteReserva').show();
        $('#guardarTitular').attr('disabled', true);

        var data = {};
        data = {
            _token: $('input[name=_token]').val(),
            pais: $( "#paisId option:selected" ).val()
        };
        ajaxRequest($( "#paisId option:selected" ).data('url'), data, 'paises', 'ciudades');
    });
}

function ciudades(){
    $('#ciudadId').on('change', function() {
        $('#horas').hide();
        $('#formTitular').hide();
        $('#siguienteReserva').show();
        $('#guardarTitular').attr('disabled', true);
    });
}

ciudades();

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
            paisId: $('#paisId').val(),
            ciudadId: $('#ciudadId').val(),
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
            paisId: $('#paisId').val(),
            ciudadId: $('#ciudadId').val(),
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

$('#nuevo-registro').on('click', function(event){
    event.preventDefault();
    $(".preloader").fadeIn();
    var data = {};
    var modalName = $('#modalName').data('modal');
    data = {
        _token: $('input[name=_token]').val()
    };
    ajaxRequest($(this).attr('href'), data, 'crear', modalName);
});

//Traducir Registro
function traducirRegistro(){
    $('#data-table').on('click', '.traducir-registro', function(event){
        event.preventDefault();
        $(".preloader").fadeIn();
        var data = {};
        var modalName = $('#modalName').data('modal');
        data = {
            _method: 'POST',
            _token: $('input[name=_token]').val(),
            id: $(this).data('id'),
            tabla: $('#tableName').val()
        };
        
        ajaxRequest($(this).attr('href'), data, 'traducir', modalName);
    });
}

traducirRegistro();

//Traducir Registro
function editarRegistro(){
    $('#data-table').on('click', '.editar-registro', function(event){
        event.preventDefault();
        $(".preloader").fadeIn();
        var data = {};
        var modalName = $('#modalName').data('modal');
        if(modalName == 'accion-titular'){
            data = {
                _method: 'PUT',
                _token: $('input[name=_token]').val(),
                hora: $(this).data('hora')
            };
        }else{
            data = {
                _method: 'PUT',
                _token: $('input[name=_token]').val()
            };
        }
        
        ajaxRequest($(this).attr('href'), data, 'editar', modalName);
    });
}

editarRegistro();

function submitDelete(){
    $('#data-table').on('submit', '.eliminar-registro', function(event){
        event.preventDefault();
        const form = $(this);
        swalWarning(
            form,
            document.getElementById('SwalTitleWarning').value,
            document.getElementById('SwalDescWarning').value,
            document.getElementById('SwalTypeWarning').value,
            document.getElementById('SwalAcceptWarning').value,
            document.getElementById('SwalCancelWarning').value
        );
    });
}

submitDelete();

function swalWarning(form, title, text, type, confirm, cancel){
    swal({   
        title: title,   
        text: text,   
        type: type,   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: confirm,
        cancelButtonText: cancel
    }).then(function(result){
        if(result.value){
            $(".preloader").fadeIn();
            ajaxRequest(form.attr('action'), form.serialize(), 'eliminar', null, form);
        }
    });
}

function submitForm(){
    $('#'+$('#modalName').data('modal')).on('submit', '#form-general', function(event){
        event.preventDefault();
        if($('#modalName').data('modal') == 'accion-titular'){
            var nombre = $('#nombreTitular');
            if(nombre != undefined && nombre.val() == ''){
                nombre.addClass('is-invalid');
                nombre.focus();
                return false;
            }else{
                nombre.removeClass('is-invalid');
            }
            var correo = $('#correoTitular');
            if(correo != undefined && correo.val() == ''){
                correo.addClass('is-invalid');
                correo.focus();
                return false;
            }else{
                correo.removeClass('is-invalid');
            }
        }
        $(".preloader").fadeIn();
        const form = $(this);
        var modalName = $('#modalName').data('modal');

        ajaxRequest(form.attr('action'), form.serialize(), 'guardar', modalName);
    });
}

submitForm();

function tablaData(respuesta, modal){
    if(modal == 'traduccion'){
        $('#'+modal+' .modal-body').html(respuesta);
    }else{
        $('#paginador').remove();
        $('#tabla-data').html(respuesta);
        traducirRegistro();
        editarRegistro();
        submitDelete();
        $('#'+modal).modal('hide');
    }
    inicializarPaginador();
}

function inicializarPaginador(){
    $('.paginate').on('click', function(event){
        event.preventDefault(); 
        $(".preloader").fadeIn();
        var page = $(this).attr('href').split('page=')[1];
        var url = $(this).attr('data-url');
        pagination(page, url);
    });
}

inicializarPaginador();

function pagination(page, url){
    $.ajax({
        url:url+"?page="+page,
        success:function(data){
            $('#paginador').remove();
            $('#tabla-data').html(data);
            traducirRegistro();
            editarRegistro();
            submitDelete();
            inicializarPaginador();
            $(".preloader").fadeOut();
        }
    });
}

function tipoReservaChange(){
    $('#tipoId').on('change', function() {
        $('#pais').hide();
        $('#ciudad').hide();
        $('#horas').hide();
        $('#formTitular').hide();
        $('#siguienteReserva').show();
        $('#guardarTitular').attr('disabled', true);
        
        var data = {};
        data = {
            _token: $('input[name=_token]').val(),
            tipoReserva: $( "#tipoId option:selected" ).val()
        };
        ajaxRequest($( "#tipoId option:selected" ).data('url'), data, 'tipoReserva', 'paises');
    });
}

tipoReservaChange();

function fechaReserva(){
    $(function(){
        var dtToday = new Date();
    
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
    
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
    
        var minDate = year + "-01-01";
        var maxDate = year + "-12-31";
        $('#fecha').attr('min', minDate);
        $('#fecha').attr('max', maxDate);
    });

    $( "#fecha" ).blur(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
    
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
    
        /*var minDate = year + '-' + month + '-' + day;
        if(Date.parse(minDate) > Date.parse(this.value)) {
            document.getElementById('fecha').value = minDate;
        }*/
    });
}

fechaReserva();

function validarReserva(){
    $('#siguienteReserva').on('click', function(event){
        event.preventDefault();
        var tipoReserva = $('#tipoId');
        var pais = $('#paisId');
        var ciudad = $('#ciudadId');
        var fecha = $('#fecha');
        if(tipoReserva.val() == ''){
            tipoReserva.addClass('is-invalid');
            tipoReserva.focus();
        }else{
            tipoReserva.removeClass('is-invalid');
        }
        if(tipoReserva.val() != '' && pais.val() == ''){
            pais.addClass('is-invalid');
            pais.focus();
        }else{
            pais.removeClass('is-invalid');
        }
        if(pais.val() != '' && ciudad.val() == ''){
            ciudad.addClass('is-invalid');
            ciudad.focus();
        }else{
            ciudad.removeClass('is-invalid');
        }
        if(fecha.val() == ''){
            fecha.addClass('is-invalid');
            fecha.focus();
        }else{
            fecha.removeClass('is-invalid');
        }
        if(tipoReserva.val() != '' && pais.val() != '' && ciudad.val() != '' && fecha.val() != ''){
            $(this).hide();

            var data = {};
            data = {
                _token: $('input[name=_token]').val(),
                tipoReserva: $( "#tipoId option:selected" ).val(),
                pais: $( "#paisId option:selected" ).val(),
                ciudad: $( "#ciudadId option:selected" ).val(),
                fecha: $( "#fecha" ).val()
            };
            ajaxRequest($(this).data('url'), data, 'horasDisponibles', 'selectHoras');
        }

    });
}

function horasChange(){
    $('#hora').on('change', function() {
        if($(this).val() != ''){
            $('#formTitular').show();
            $('#guardarTitular').attr('disabled', false);
        }else{
            $('#formTitular').hide();
            $('#guardarTitular').attr('disabled', true);
        }
    });
}