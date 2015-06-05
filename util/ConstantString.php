<?php
#CONEXION
//PRODUCCION
/*
define('CON_HOST', 'localhost');
define('CON_USER', 'globalmx_ws');
define('CON_PASS', '+ZFv51F!A1U-');
define('CON_DB', 'globalmx_ws');*/
//DESARROLLO
define('CON_HOST', 'localhost');
define('CON_USER', 'root');
define('CON_PASS', 'twix');
define('CON_DB', 'globalmx');
#PARAMETROS CONFIG
define('MIN_RECARGA', 10000);
define('MAX_RECARGA', 10000000);
#MAIL
define('MAIL_ALLOW' , 'juandavidcrivera@hotmail.com');
#LOGS
define('LOG_ERROR', 'log/error.log');
define('LOG_SUCCESS', 'log/success.log');
define('LOG_SECURITY', 'log/security.log');
define('LOG_TRANSATION', 'log/transation.log');
define('LOG_DESC', '['.date("d-m-Y H:i:s").']:[');
define('HACK_1', 'Try connect from:[');
define('HACK_2', '] Trama:[');
define('HACK_3', '] Nit:[');
define('MSG_JSON', '{"msg":"');
define('MSG_JSON2', '"}');
#-------------.............--MESSAGE ERROR USERS--------------------------
#GENERAL ERROS
define('ERR', 'Error');
define('NO_EXIST', 'No existe');
define('EMPTY_FIELD', 'Vacio');
define('WRONG_CAMP', 'Erroneo');
define('EXIST_DATA', 'No disponible');
define('ADV', 'Advertencia');
define('TOTAL_FAILED', 'Comuniquese con el administrador');
#ROL ERRORS
define('ROL_ERROR_1', 'Por favor ingrese un identificador valido de Rol.');
define('ROL_ERROR_2', 'No se pudo guardar el rol');
define('ROL_ERROR_3', 'No se pudo modificar el rol');
define('ROL_ERROR_4', 'No se pudo encontrar el rol');
define('ROL_ERROR_5', 'No se encuentran roles.');
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
define('TARJETA_ERROR_4', 'No se pudo guardar la tarjeta');
define('TARJETA_ERROR_5', 'No se pudo encontrar la tarjeta');
define('TARJETA_ERROR_6', 'No se pudo modificar la tarjeta');
#PIN ERRORS
define('PIN_ERROR_1', 'Ingrese el numero de pin.');
define('PIN_ERROR_2', 'Ingrese un numero de pin correcto.');
define('PIN_ERROR_3', 'Pin no asignado a la tarjeta.');
define('PIN_ERROR_4', 'No se pudo guardar el pin');
define('PIN_ERROR_5', 'No se pudo modificar el pin');
define('PIN_ERROR_6', 'No se pudo encontrar el pin');
define('PIN_ERROR_7', 'No se encuentran Pines.');
#USUARIO ERRORS
define('USUARIO_ERROR_1', 'Ingrese el usuario por favor.');
define('USUARIO_ERROR_2', 'Ingrese el password por favor.');
define('USUARIO_ERROR_3', 'Credenciales no validas.');
define('USUARIO_ERROR_4', 'Todos los campos son necesarios.');
define('USUARIO_ERROR_5', 'Cambie el nombre del usuario.');
define('USUARIO_ERROR_6', 'Ingrese el id del usuario');
define('USUARIO_ERROR_7', 'El usuario no fue encontrado');
define('USUARIO_ERROR_8', 'No es posible eliminar el usuario, tiene tarjetas asignadas');
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
#ESTADO ERRORS
define('ESTADO_ERROR_1', 'Estado invalido.');
define('ESTADO_ERROR_2', 'No se pudo modificar el estado');
define('ESTADO_ERROR_3', 'No se pudo encontrar el estado');
define('ESTADO_ERROR_4', 'No se encuentran Estados.');
define('ESTADO_ERROR_5', 'No se pudo guardar el estado');
#TRANSATION ERRORS
define('TRANSA_ERROR_1', 'Ingrese el valor a recargar.');
define('TRANSA_ERROR_2', 'El valor minimo a recargar es :');
define('TRANSA_ERROR_3', 'El valor minimo a recargar es :');
define('TRANSA_ERROR_4', 'Error en la transaccion.');
#EMPRESA ERRORS
define('EMPRESA_ERROR_1', 'No se pudo guardar la empresa');
define('EMPRESA_ERROR_2', 'No se pudo modificar la empresa');
define('EMPRESA_ERROR_3', 'No se pudo encontrar la empresa');
define('EMPRESA_ERROR_4', 'No se encuentran Empresas.');
#IMPRESION ERRORS
define('IMPRESION_ERROR_1', 'No se pudo guardar la impresion');
define('IMPRESION_ERROR_2', 'No se pudo modificar la impresion');
define('IMPRESION_ERROR_3', 'No se pudo encontrar la impresion');
define('IMPRESION_ERROR_4', 'No se encuentran impresiones.');
#-------------------------------------------------------------------------
#YAML
define('ORIGINAL_FILE', 'config/route/main.yaml');
define('COMPILED_FILE', 'config/route/cache/main.yaml');
#-------------.............--MESSAGE SUCCESS USERS------------------------
define('USUARIO_SUCCES_1', '{"msg":"Acceso garantizado"}');
define('USUARIO_SUCCES_2', '{"msg":"El usuario a sido creado"}');
define('USUARIO_SUCCES_3', '{"msg":"El usuario fue eliminado"}');
define('USUARIO_SUCCES_4', '{"msg":"El usuario a sido modificado"}');
#PERSONA SUCCESS
define('PERSONA_SUCCES_1', '{"msg":"Tarjeta Activada"}');
#TRANSATION SUCCESS
define('TRANS_SUCCES_1', '{"msg":"Transaccion Exitosa."}');
define('TRANS_SUCCES_2', '{"msg":"Compra Exitosa."}');
#TARJETA SUCCESS
define('TARJETA_SUCCES_1', '{"msg":"Tarjeta creada"}');
define('TARJETA_SUCCES_2', '{"msg":"La tarjeta a sido modificada"}');
#EMPRESA SUCCESS
define('EMPRESA_SUCCES_1', '{"msg":"Empresa creada"}');
define('EMPRESA_SUCCES_2', '{"msg":"La empresa a sido modificada"}');
#PIN SUCCESS
define('PIN_SUCCES_1', '{"msg":"Pin creado"}');
define('PIN_SUCCES_2', '{"msg":"El pin a sido modificado"}');
#ESTADO SUCCESS 
define('ESTADO_SUCCES_1', '{"msg":"Estado creado"}');
define('ESTADO_SUCCES_2', '{"msg":"El estado a sido modificado"}');
#IMPRESION SUCCESS
define('IMPRESION_SUCCES_1', '{"msg":"Impresion creado"}');
define('IMPRESION_SUCCES_2', '{"msg":"La impresion a sido modificada"}');
#ROL SUCCESS
define('ROL_SUCCES_1', '{"msg":"Rol creado"}');
define('ROL_SUCCES_2', '{"msg":"El rol a sido modificado"}');
?>