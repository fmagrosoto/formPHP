<?php

##########################################################
## formPHP                                              ##
## -----------------------------------------------------##
## Script PHP para recibir un formulario de contacto y  ## 
## enviarlo por correo electrónico a un destinatario    ##
## específico.                                          ##
## -----------------------------------------------------##
## Autor: Fernando Magrosoto V.                         ##
## Contacto: fmagrosoto@gmail.com                       ##
## Historia: febrero 2017                               ##
## Versión: 1.0                                         ##
## Licencia: MIT                                        ##
## Clóname en: https://github.com/fmagrosoto/formPHP    ##
##########################################################


// Un poco de seguridad y protección.
// Vamos a ver si esta página ha sido resultado de
// enviar un formulario con el método (verbo) POST.
// De no ser así, entonces devolver la página con un
// mensaje de advertencia.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Primero, recibir los campos del formulario a través del método POST.
    // La manera en cómo recibirlos es lo mismo usando AJAX que usando ACTION del formulario.
    // Es necesario que PHP sanitice los campos para evitar algún ataque.
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $comentarios = filter_input(INPUT_POST, 'comentarios', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    $hoy = date("F j, Y, g:i a");

    // Puedes cambiar el nombre por el de tu empresa o por el de tu cliente.
    $empresa = "Empresas Ficticias";

    // Plantilla de correo en HTML.
    // Examina esta plantilla y notarás que hay placeholders en forma de {{placeholder}}.
    // Puedes poner los placeholders que quieras y puedes hacer el diseño web que quieras.
    // La función file_get_contents() lee el contenido de un archivo y lo pasa a una variable,
    // como si se tratara de una cadena de texto.
    // Pasamos a la variable $plantilla el html de la plantilla.
    $plantilla = file_get_contents('plantilla.html');

    // Dinámicamente vamos a hacer que PHP reemplace los placeholders.
    // Para eso, sera necesario poner los nombre de los placeholders 
    // de la plantilla HTML en un array.
    // OJO, que deberás de poderlos en el orden correcto (consecutivo), no te saltes ni uno.
    $variables = array(
        '{{empresa}}',
        '{{nombre}}',
        '{{telefono}}',
        '{{correo}}',
        '{{comentarios}}',
        '{{fecha}}'
    );

    // Luego, en el mismo orden que pusiste el array de $variables
    // hay que hacer un array con los valores a reemplazar:
    $valores = array(
        $empresa,
        $nombre,
        $telefono,
        $correo,
        $comentarios,
        $hoy
    );
    // Fíjate que tanto el HTML como el array $variables 
    // y el array $valores tienen el mismo orden.


    // Ahora, para reemplazarlo, usamos la función str_replace() de PHP.
    // Esta función nos pide tres parámetros:
    // 1) El array con los nombres de los placeholders
    // 2) El arrayt con los valores a reemplazar
    // 3) La cadena de texto donde hará la búsqueda y el reemplazo
    $mensaje = str_replace($variables, $valores, $plantilla);


    // Preparamos la salida del correo:
    $para = 'correo@destinatario.com'; // Correo a quien le va a llegar el formulario.
    $subject = "Formulario de contacto para " . $empresa; // El ASUNTO del correo.

    // Para enviar un correo en formato HTML, debe establecerse la cabecera Content-type
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    // Cabeceras adicionales
    $cabeceras .= 'From: Webmaster <webmaster@dominio.com>' . "\r\n";


    // Usamos la función mail() de PHP para mandar un correo electrónico
    // y las cabeceras para mandarlo con formato HTML.
    // El resultado del if(mail){} será true si se ha enviado correctamente
    // y false si algo ha fallado.

    if (mail($para, $subject, $mensaje, $cabeceras)) {

        // Si todo ha salido bien, entonces enviamos un OK
        // Si usas AJAX, será este mensaje el que le llegará a Javascript.
        // Si no usas AJAX, lo más conveniente es que no uses echo para poder permitir
        // la salida del HTML tal y como se explica al final del archivo.
        echo 'ok';

    } else {

        // Si ha ocurrido un problema, simplemente enviamos la advertencia.
        // Hay varios métodos para saber el origen de algún fallo pero va más allá
        // del alcance de este tutorial.
        // Si usas AJAX, será este mensaje el que le llegará a Javascript.
        // Si no usas AJAX, lo más conveniente es que no uses echo para poder permitir
        // la salida del HTML tal y como se explica al final del archivo.
        echo 'No se puede mandar correos.';

    }
    
} else {
    
    // No fue desde POST
    // entonces, rechazarlo.
    echo "Es necesario que sea llamada la página desde un POST";
    
}



// Si has usado AJAX se enviará como response text el resultado de la salida del IF(mail){}.
// Y hasta aquí terminaría el script.

// Si usas ACTION del formulario, entonces aquí podrás continuar con la 
// página de confirmación, agregándole el HTML que quieras, incluyendo <html><head><body>
// justo debajo de estas líneas.
