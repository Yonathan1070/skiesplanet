function epayco(){
    var language = $('#locale').val();

    var tipoReserva = $('#nombre-tipo-reserva').val();
    var pais = $('#nombrePais').val();
    var ciudad = $('#nombreCiudad').val();
    var descripcion = "Reserva " + $('#nombre-tipo-reserva').val() + " para el día " + $('#fecha').val() + ", en la(s) hora(s) " + $('#horas-array').val() + " en " + (((pais != null || pais != undefined) && (ciudad != null || ciudad != undefined)) ? (pais+" ("+ciudad+")") : ((pais != null || pais != undefined) && (ciudad == null || ciudad == undefined)) ? pais : "el mundo");
    var total = $('#total').val();
    var fecha = new Date();
    var handler = ePayco.checkout.configure({
        key: 'e84f59c5aba1b0ef2592fb4a39962408',
        test: false
    });
    // var handler = ePayco.checkout.configure({
    //     key: '491d6a0b6e992cf924edd8d3d088aff1',
    //     test: true
    // });
	var invoice = "Ref_"+fecha.getDate()+""+fecha.getMonth()+""+fecha.getFullYear()+""+fecha.getHours()+""+fecha.getMinutes();
    var nombreCliente = $('#nombreCliente').val()+" "+$('#apellidoCliente').val();
    var telefonoCliente = $('#telefonoCliente').val();

    //Variables extra 
    var tipoId = $('#tipo-reserva').val();
    var fechaReserva = $('#fecha').val();
    var horas = $('#horas-array').val();
    var nombre = $('#nombreCliente').val();
    var apellido = $('#apellidoCliente').val();
    var email = $('#correoCliente').val();
    var telefono = $('#telefonoCliente').val();
    var nombrecert = $('#nombreTitular').val();
    var emailcert = $('#correoTitular').val();
    var pais = $('#paisId').val();
    var ciudad = $('#ciudadId').val();
    var paisn = $('#nombrePais').val();
    var ciudadn = $('#nombreCiudad').val();
    var data={
        //Parametros compra (obligatorio)
        name: tipoReserva,
        description: descripcion,
        invoice: invoice,
        currency: "usd",
        amount:total,
        tax_base: "0",
        tax: "0",
        country: "co",
        lang: language,
        //Parametros del pedido
        extra1: tipoId,
        extra2: fechaReserva,
        extra3: horas,
        extra4: nombre,
        extra5: apellido,
        extra6: email,
        extra7: telefono,
        extra8: nombrecert,
        extra9: emailcert,
        extra10: pais,
        extra11: ciudad,
        extra12: "es",
        extra13: paisn,
        extra14: ciudadn,
        //Páginas
        confirmation:"http://skiesplanet.test/confirmacion",
        response: "http://skiesplanet.test/respuesta",
        //Onpage="false" - Standard="true"
        external: "false",
        //Atributos cliente
        name_billing: nombre+" "+apellido,
        mobilephone_billing : telefono,
        type_doc_billing: "cc",

    }
    handler.open(data);
}