@extends('layout')

@section('title')
    {{Lang::get('messages.respuesta')}}
@endsection
@section('styles')
    
@endsection
@section('contenido')
<div class="container-fluid" id="booking"><br/><br/><br/><br/>
    <div class="row">
        <div class="col-md-6 main_grid_contact">
            <div class="form">
                <h4 class="text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
                    {{Lang::get('messages.inicioTituloCard1Sec3')}}
                </h4>
                <p>
                    {{Lang::get('messages.inicioDescripcionCard1Sec3')}}
                </p>
                <br/>
                <div class="feedback-grids">
                    <img src="{{asset('assets/images/certificado.jpg')}}" class="img-fluid"alt="">
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 main_grid_contact bg-light">
            <div class="feedback-grids">
                <h4 class="text-center text-uppercase text-dark font-weight-bold mb-sm-5 mb-4">
                    {{Lang::get('messages.respuestaTituloCard2Sec1')}}
                </h4>
                <ul class="w-hours list-unstyled">
                    <li class="d-flex justify-content-between">
                        <b>{{Lang::get('messages.referencia')}}:</b>
                        <span id="referencia"></span>
                    </li>
                    <li class="d-flex justify-content-between">
                        <b>{{Lang::get('messages.fechaTxn')}}:</b>
                        <span id="fecha"></span>
                    </li>
                    <li class="d-flex justify-content-between">
                        <b>{{Lang::get('messages.respuesta')}}:</b>
                        <span id="respuesta"></span>
                    </li>
                    <li class="d-flex justify-content-between">
                        <b>{{Lang::get('messages.motivo')}}:</b>
                        <span id="motivo"></span>
                    </li>
                    <li class="d-flex justify-content-between">
                        <b>{{Lang::get('messages.banco')}}:</b>
                        <span id="banco"></span>
                    </li>
                    <li class="d-flex justify-content-between">
                        <b>{{Lang::get('messages.recibo')}}:</b>
                        <span id="recibo"></span>
                    </li>
                    <li class="d-flex justify-content-between">
                        <b>{{Lang::get('messages.total')}}:</b>
                        <span id="total"></span>
                    </li>
                </ul>
                <div class="input-group1">
                    <a class="form-control btn" type="button" href="{{route('inicio')}}">{{Lang::get('messages.regresarInicio')}}</a>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        function getQueryParam(param) {
            location.search.substr(1).split('&').some(function(item) { // returns first occurence and stops
                return item.split('=')[0] == param && (param = item.split('=')[1])
            });
            return param
        }
        
        $(document).ready(function() {
            //llave publica del comercio
            //Referencia de payco que viene por url
            var ref_payco = getQueryParam('ref_payco');
            //Url Rest Metodo get, se pasa la llave y la ref_payco como paremetro
            var urlapp = 'https://secure.epayco.co/validation/v1/reference/' + ref_payco;
            $.get(urlapp, function(response) {
                if (response.success) {
                    if (response.data.x_cod_response == 1) {
                        //Codigo personalizado
                        console.log('transacción aceptada');
                    } //
                    //Transaccion Rechazada
                    if (response.data.x_cod_response == 2) {
                        console.log('transacción rechazada');
                    }
                    //Transaccion Pendiente
                    if (response.data.x_cod_response == 3) {
                        console.log('transacción pendiente');
                    } 
                    //Transaccion Fallida
                    if (response.data.x_cod_response == 4) {
                        console.log('transacción fallida');
                    }
                    $('#fecha').html(response.data.x_transaction_date);
                    $('#respuesta').html(response.data.x_response);
                    $('#referencia').text(response.data.x_id_invoice);
                    $('#motivo').text(response.data.x_response_reason_text);
                    $('#recibo').text(response.data.x_transaction_id);
                    $('#banco').text(response.data.x_bank_name);
                    $('#autorizacion').text(response.data.x_approval_code);
                    $('#total').text(response.data.x_amount + ' ' + response.data.x_currency_code);
                } else {
                    console.log('Error consultando la información');
                }
            });
        });
    </script>
@endsection