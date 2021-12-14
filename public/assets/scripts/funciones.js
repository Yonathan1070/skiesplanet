var skiesplanet = function (){
    return{
        notificaciones: function(mensaje, titulo, tipo, tiempo){
            $.toast({
                heading: titulo,
                text: mensaje,
                position: 'top-right',
                loaderBg:'#ff6849',
                icon: tipo,
                hideAfter: tiempo, 
                stack: 6
              });
        },
        
    }
}();