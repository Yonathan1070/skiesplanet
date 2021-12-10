<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{Lang::get('messages.certificado')}} - {{Lang::get('messages.appName')}}</title>
    <style>
        *{
            font-family: "Georgia", serif;";
        }

        body {
            margin: 0;
        }
        .image {
            position:absolute;
            width:100%; 
            height:100%; 
            background-image: url("{{asset('assets/images/certificado-fondo.jpg')}}");
            background-size:cover;
            background-attachment: local;
        }
        @page {
            margin: 5px;
            margin-right: 0;
        }
    </style>
</head>
<body>
    <div style="text-align:center;">
        <div style="text-align:center;" class="image">
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <span style="font-size:60px">{{Lang::get('messages.certificadoSec1')}}</span><br/><br/>
            <br/>
            <span style="font-size:70px">{{Lang::get('messages.certificadoSec2_1')}} {{($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $pais && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 1 && $ciudad) ? Lang::get('messages.reservasDescripcion1_2').$ciudad->TCI_Nombre_Ciudad.', '.$pais->TPA_Nombre_Pais_Espanol.' ' : (($tipoReserva->TTR_Select_Pais_Tipo_Reserva == 1 && $pais && $tipoReserva->TTR_Select_Ciudad_Tipo_Reserva == 0) ? Lang::get('messages.reservasDescripcion1_5').$pais->TPA_Nombre_Pais_Espanol : Lang::get('messages.reservasDescripcion1_3'))}} {{Lang::get('messages.certificadoSec2_2')}} {{Carbon\Carbon::createFromFormat('m-d', $fecha)->format('d').' '.Lang::get('messages.reservasDescripcion1_6').' '.Lang::get('messages.'.Carbon\Carbon::createFromFormat('m-d', $fecha)->format('F'))}},</span><br/>
            <span style="font-size:70px">
                {{Lang::get('messages.certificadoSec2_3')}} 
                <?php $splitHora = explode("-", $horas); ?>
                {{Carbon\Carbon::createFromFormat('H:i', $splitHora[0].':00')->format('g:i A').' - '.Carbon\Carbon::createFromFormat('H:i', $splitHora[1].':00')->format('g:i A').', '}}
                {{Lang::get('messages.certificadoSec2_4')}}
            </span>
            <br/><br/><br/><br/>
            <span style="font-size:80px; text-transform: uppercase;"><b>{{$titular->TUS_Nombre_Completo_Usuario}}</b></span>
            <br/><br/><br/>
            <span style="font-size:70px;">{{Lang::get('messages.certificadoSec4')}}</span>
            <br/><br/><br/>
            <span style="font-size:65px;">{{Lang::get('messages.slogan')}}</span> <br/><br/>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <span style="font-size:25px; display: block; float: left;">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{Lang::get('messages.certificadoTerminos')}}
            </span>
        </div>
    </div>
</body>
</html>