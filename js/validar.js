console.log('probando formPHP...');


/**
* ENVIAR FORMULARIO MEDIANTE AJAX
* Función que se dispara al momento de enviar el formulario.
* @private
* @param {object} s La acción del botón de Submit
* @method enviar
* @return {void}
* @author Fernando Magrosoto V.
*/
function enviar(s) {
    
    // Esta sentencia es importante, porque así evitamos que 
    // el formulario se redireccione al recurso que usamos en el "action" del formulario.
    // Si NO quisiéramos usar AJAX, simplemente quitamos esta sentencia.
    s.preventDefault();
    
    // Se está enviando el formulario, pero lo primero
    // que hay que hacer es deshabilitar el botón de SUBMIT
    // para evitar que se mande varias veces al mismo tiempo.
    var boton = $('button[type=submit]'),
        txtOrBot = boton.html(); // El texto orginal del botón del submit.
    boton.prop('disabled', true); // Lo deshabilitamos.
    boton.text('Enviando...'); // Y le cambiamos de texto.
    
    
    // Luego, extraemos los valores de los campos.
    var f       = this,                 // El formulario como objeto
        nombre  = f.nombre.value,       // El valor del campo nombre
        correo  = f.correo.value,       // El valor del campo correo
        tel     = f.telefono.value,     // El valor del campo teléfono
        com     = f.comentarios.value,  // El valor del campo comentarios
        
        // Ahora algunas variables para el mensaje de alerta
        msgTxt  = 'El formulario se ha enviado satisfactoriamente',
        msgIcon = 'glyphicon glyphicon-ok',
        msgClass = 'alert alert-success';
    
    
    // Ahora, validar cada campo del formulario.
    // Esto se podría hacer con el atributo required de HTML5 pero algunos
    // navegadores no son compatibles con ese atributo, como SAFARI y EXPLORER.
    if (nombre === '' || nombre.length < 5) {
        alert('El campo NOMBRE está vacío o incompleto.');
        f.nombre.focus();
        boton.prop('disabled', false);
        boton.html(txtOrBot);
        return;
    }
    
    if (correo === '') {
        alert('El campo CORREO está vacío.');
        f.correo.focus();
        boton.prop('disabled', false);
        boton.html(txtOrBot);
        return;
    } else {
        // Validamos el correo a través de expresiones regulares
        // para que sea un nombre de correo válido
        var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!expr.test(correo)){
            alert('El campo CORREO no es válido.');
            f.correo.focus();
            boton.prop('disabled', false);
            boton.html(txtOrBot);
            return;
        }
    }
    
    if (tel === '' || tel.length < 5) {
        alert('El campo TElÉFONO está vacío o incompleto.');
        f.telefono.focus();
        boton.prop('disabled', false);
        boton.html(txtOrBot);
        return;
    }
    
    if (com === '' || com.length < 5) {
        alert('El campo COMENTARIOS está vacío o incompleto.');
        f.comentarios.focus();
        boton.prop('disabled', false);
        boton.html(txtOrBot);
        return;
    }
    
    
    // Una vez validados los campos, enviamos el formulario a través
    // de AJAX usando $.post de jQUERY.
    // Hay muchas formas de usar AJAX y de usar los métodos de jQUERY, esta es una de ellas.
    // Si NO quisiéramos usar AJAX, entonces simplemente quitamos esta parte.
    $.post('php/formulario.php', {
        'nombre':       nombre,
        'correo':       correo,
        'telefono':     tel,
        'comentarios':  com
    })
        // En caso de que la llamada a AJAX haya sido exitosa, entonces...
        .done(function (resp) {
        
            if (resp !== 'ok') {
                console.error(resp); // ver el error en la consola
                msgTxt  = 'Ha ocurrido un error. Intentar más tarde.',
                msgIcon = 'glyphicon glyphicon-remove',
                msgClass = 'alert alert-danger';
            }
        
        })
    
        // En caos de que haya ocurrido algún error con la llamada a AJAX...
        .fail(function (error) {
            console.error(error); // ver el error en la consola
            msgTxt  = 'Ha ocurrido un error interno.',
            msgIcon = 'glyphicon glyphicon-remove',
            msgClass = 'alert alert-danger';
        })
    
        // Independientemente de la llamada, después ejecutar esta sentencia...
        .always(function () {
            var msg = "<div class='" + msgClass + "'>" +
                "<span class='" + msgIcon +"'></span>&nbsp;" +
                msgTxt +
                "</div>";
            $('legend').after(msg);
            boton.prop('disabled', false);
            boton.html(txtOrBot);
            f.reset();
        });
    

}


// Sentencias que se ejecutarán al cargar la página.
$(document).ready(function () {
    
    // Colocar un listener para cuando se envíe el formulario.
    // La acción después del SUBMIT se irá a la función "enviar" declarada
    // al principio de este archivo.
    $('#elForm').submit(enviar);
    
});
