<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Web-Fonts -->
	<link href="//fonts.googleapis.com/css?family=Lato:100,200,300,500,800,900" rel="stylesheet">
    <title>{{Lang::get('messages.certificado')}} - {{Lang::get('messages.appName')}}</title>
    <style>
        * {
            font-family:'Lato', sans-serif;
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
    <div style="width:985px; height:745px; padding:20px; text-align:center; border: 10px solid #0197fd">
        <div style="width:935px; height:695px; padding:20px; text-align:center; border: 5px solid #0197fd" class="image">
            <br><br>
            <br><br>
            <br><br><br>
            <span style="font-size:40px">{{Lang::get('messages.certificadoSec1')}}</span><br/><br/>
            <br><br>
            <span style="font-size:25px"><b>{{Lang::get('messages.certificadoSec2_1')}} Pais(Ciudad) {{Lang::get('messages.certificadoSec2_2')}} dd de mm,</b></span><br/><br/>
            <span style="font-size:25px"><b>{{Lang::get('messages.certificadoSec2_3')}} 00:00, 00:00, {{Lang::get('messages.certificadoSec2_4')}}</b></span> <br/><br/>
            <span style="font-size:40px; text-transform: uppercase;"><b>{{$titular->USU_Nombre_Usuario}}</b></span> <br/><br/><br/><br/><br/>
            <span style="font-size:25px;"><b>{{Lang::get('messages.certificadoSec4')}}</b></span> <br/><br/><br/><br/>
            <br><br><br>
            <br><br><br>
            <br>
            <span style="font-size:15px; display: block; float: left;"><b>{{Lang::get('messages.certificadoTerminos')}}</b></span>
        </div>
    </div>
</body>
</html>