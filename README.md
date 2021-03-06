# formPHP

![Packagist](https://img.shields.io/badge/PHP-project-green.svg)
![Packagist](https://img.shields.io/badge/HTML-5-yellowgreen.svg)
[![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)](LICENSE)
![Packagist](https://img.shields.io/badge/Versi%C3%B3n-Estable%201.0-orange.svg)

Script PHP para recibir un formulario de contacto y enviarlo por correo electrónico a un destinatario específico.

## Información
Este proyecto está hecho con el único propósito de tener a la mano la funcionalidad
de un script escrito en PHP para recibir un formulario de contacto (o cualquier otro formulario) y enviar los campos a un correo electrónico específico.

Este tipo de recursos es muy utilizado a la hora de diseñar cualquier página web,
como en la sección de **Contáctanos**, por ejemplo.

La idea es hacer una plantilla en HTML y agregar algunos campos con *placeholders*
que sirvan después para poder reemplazarlos dinámicamente con PHP y con los campos
recibidos desde el formulario.

Estaremos usando la función *mail* de PHP para enviar correos en formato HTML.

El uso normal de esta función es:

```PHP
mail($para, $titulo, $mensaje);
```

Iremos ajustando cada parámetro de acuerdo a nuestras necesidades.

Para efectos de prueba, estaremos haciendo la página del formulario con **Bootstrap**
e incluiremos algunas rutinas en **Javascript** para validar los campos.  
Siguiendo con la página de prueba, mandaremos el formulario a través de AJAX, usando
**jQuery** y de acuerdo a la respuesta del servidor (*response*) añadiremos un cuadro
de *alert* para notificar al usuario que se ha mandado (o no) el formulario.

No es la intención de este ejercicio enseñar a usar **Bootstrap** ni **jQuery** sino
el *script* hecho en PHP para recibir el formulario y enviarlo por correo.

Así que, pueden hacer la página que quieran usando su propio HTML y/o CSS. Incluso 
mandando el formulario a través de ```method="POST" action="confirmacion.php"``` o por medio de AJAX.

Este *script* funciona perfectamente para versiones de PHP 5, 6 y 7.

## Cómo usarlo
Simplemente copia todos los archivos del repositorio a una carpeta dentro de tu servicio
de hosting que tengas contratado. Recuerda que necesitas un stock de desarrollo **LAMP**, 
es decir, que tu proveedor de hosting tenga sus servicios bajo LINUX, que use APACHE
como servidor web y que tenga el intérprete de PHP instalado.

Si usas ```method="POST" action="confirmacion.php"``` entonces, el script lo deberás 
de poner en el archivo **confirmacion.php** o el que quieras (solo recuerda cambiarlo
en el atributo **action** del formulario).

Al mandarlo por medio del formulario a otra página, recuerda usar el ```method="POST"```
para que no se muestre en el URL el contenido del formulario.

Si deseas usarlo por medio de AJAX, entonces el URL será **confirmacion.php** y
tendrás que esperar el **response text** que sea igual a OK. En Javascript podrás
compararlo y de ahí mostrar el mensaje de alerta correspondiente.

Lee los diferentes comentarios en el archivo PHP para que tengas el control de acuerdo
al método de envío que seleccionaste.

## Desarrollo
* Autor: Fernando Magrosoto [@fmagrosoto](https://twitter.com/fmagrosoto)
* Historia: Febrero 2017
* Frameworks usados: Bootstrap 3, jQuery 3
* Stack de desarrollo: LAMPP
* Versión de PHP: 7
* Tecnologías: HTML5, CSS3, Javascript, PHP
* Licencia: [MIT](LICENSE)

## Git Ignore
En este repositorio se han contemplado una serie de herramientas, sistemas operativos, 
editores de código, IDE's, etc., que se han puesto en el archivo .gitignore con el 
propósito de mantener lo más limpio este proyecto.  

Si decides clonar este repositorio para mejorarlo o añadirle funcionalidades y quieres 
hacer un PR para que nosotros lo integremos, entonces te pido que incluyas en el 
.gitignore tu entorno de desarrollo para continuar con este propósito de mantener 
lo más limpio posible este ejercicio.

## Notas
Este repositorio está hecho bajo una licencia [MIT](LICENCE).
Puedes hacer lo que quieras con el, pero siempre respetando la autoría original.

Para cualquier comentario, puedes contactarme aquí mismo o en [Twitter](https://twitter.com/fmagrosoto).

***

Copyleft 2017.  
Fernando Magrosoto Vásquez  
\#HappyCoding
