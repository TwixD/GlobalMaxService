<?php
#MAIL
define('MAIL_ALLOW' , 'jdcastano@gane.com.co,juandavidcrivera@hotmail.com');
#LOGS
define('LOG_ERROR', 'log/error.log');
define('LOG_SUCCESS', 'log/success.log');
define('LOG_DESC', '['.date("d-m-Y h:i:s").']:[');
#-------------.............--MESSAGE ERROR USERS--------------------------
#GENERAL ERROS
define('NO_EXIST', 'No existe');
define('EMPTY_FIELD', 'Vacio');
define('WRONG_CAMP', 'Erroneo');
define('EXIST_DATA', 'No disponible');
define('ADV', 'Advertencia');
define('TOTAL_FAILED', 'Comuniquese con el administrador');
#ROL ERRORS
define('ROL_ERROR_1', 'Por favor ingrese un identificador valido de Rol.');
#PAIS ERRORS
define('PAIS_ERROR_1', 'No se encuentran Paises.');
#REGION ERRORS
define('REGION_ERROR_1', 'No se encuentran Regiones.');
#CIUDAD ERRORS
define('CIUDAD_ERROR_1', 'No se encuentran Ciudades.');
define('CIUDAD_ERROR_2', 'La ciudad no existe.');
#TARJETA ERRORS
define('TARJETA_ERROR_1', 'Ingrese el numero de tarjeta.');
define('TARJETA_ERROR_2', 'Tarjeta invalida.');
define('TARJETA_ERROR_3', 'Debe comprar la tarjeta.');
#PIN ERRORS
define('PIN_ERROR_1', 'Ingrese el numero de pin.');
define('PIN_ERROR_2', 'Ingrese un numero de pin correcto.');
#USUARIO ERRORS
define('USUARIO_ERROR_1', 'Ingrese el usuario por favor.');
define('USUARIO_ERROR_2', 'Ingrese el password por favor.');
define('USUARIO_ERROR_3', 'Credenciales no validas.');
define('USUARIO_ERROR_4', 'Todos los campos son necesarios.');
define('USUARIO_ERROR_5', 'Cambie el nombre del usuario.');
#PERSONA ERRORS
define('PERSONA_ERROR_1', 'Ingrese la cedula por favor');
define('PERSONA_ERROR_2', 'Ingrese el numero de tarjeta por favor');
define('PERSONA_ERROR_3', 'Ingrese el codigo de ciudad por favor');
define('PERSONA_ERROR_4', 'Ingrese el nombre por favor');
define('PERSONA_ERROR_5', 'Ingrese el apellido por favor');
define('PERSONA_ERROR_6', 'Ingrese la direccion por favor');
define('PERSONA_ERROR_7', 'Ingrese el barrio por favor');
define('PERSONA_ERROR_8', 'Ingrese el telefono por favor');
define('PERSONA_ERROR_9', 'Ingrese el celular por favor');
define('PERSONA_ERROR_10', 'Ingrese el email por favor');
define('PERSONA_ERROR_11', 'Ingrese la fecha de nacimiento por favor');
define('PERSONA_ERROR_12', 'Ya hay un cliente registrado con la cedula');
#-------------------------------------------------------------------------
#YAML
define('ORIGINAL_FILE', 'config/route/main.yaml');
define('COMPILED_FILE', 'config/route/cache/main.yaml');
#-------------.............--MESSAGE SUCCESS USERS------------------------
define('USUARIO_SUCCES_1', '{"msg":"Acceso garantizado"}');
define('USUARIO_SUCCES_2', '{"msg":"El usuario a sido creado"}');
#PERSONA SUCCESS
define('PERSONA_SUCCES_1', '{"msg":"Tarjeta Activada"}');
?>