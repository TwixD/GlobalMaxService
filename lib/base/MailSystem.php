<?php
function sendMail($data=null){
$to      = MAIL_ALLOW;
$subject = '<<Activar>> Cliente '.$data->nombre.' ' . $data->apellido ;
$headers = "From: comunicaciones@globalmaxsocios.com\r\n";
$headers .= "Reply-To: comunicaciones@globalmaxsocios.com\r\n";
$headers .= "CC: sistemas@globalmaxsocios.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<img src="http://clubdecomprasusa.com/ActivarBlackCard/img/logoletra.png"/>';
$message .= '<p>El usuario se encuentra registrado correctamente en la base de datos</p>';
$message .= '<p>Cualquier inconsistencia con la informacion, puede ingresar por el modulo administrativo y modificarlo.</br>';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Cedula:</strong> </td><td>" .$data->cedula . "</td></tr>";
$message .= "<tr><td><strong>Numero de tarjeta:</strong> </td><td>" .$data->globalmx_tarjeta_numero . "</td></tr>";
$message .= "<tr><td><strong>Codigo de ciudad:</strong> </td><td>" .$data->globalmx_ciudad_cityid . "</td></tr>";
$message .= "<tr><td><strong>Nombre:</strong> </td><td>" .$data->nombre . "</td></tr>";
$message .= "<tr><td><strong>Apellido:</strong> </td><td>" .$data->apellido . "</td></tr>";
$message .= "<tr><td><strong>Nombre 2:</strong> </td><td>" .$data->nombre2 . "</td></tr>";
$message .= "<tr><td><strong>Apellido 2:</strong> </td><td>" .$data->apellido2 . "</td></tr>";
$message .= "<tr><td><strong>Direccion:</strong> </td><td>" .$data->direccion . "</td></tr>";
$message .= "<tr><td><strong>Barrio:</strong> </td><td>" .$data->barrio . "</td></tr>";
$message .= "<tr><td><strong>Telefono:</strong> </td><td>" .$data->telefono . "</td></tr>";
$message .= "<tr><td><strong>Celular:</strong> </td><td>" .$data->celular . "</td></tr>";
$message .= "<tr><td><strong>eMail:</strong> </td><td>" .$data->email . "</td></tr>";
$message .= "<tr><td><strong>Codigo postal:</strong> </td><td>" .$data->codigo_postal . "</td></tr>";
$message .= "<tr><td><strong>Fecha nacimiento</strong> </td><td>" .$data->fecha_nacimiento . "</td></tr>";
$message .= "</table>";
$message .= "<h2>Imagen Documento Identidad</h2>";
$message .= '<img src="http://clubdecomprasusa.com/ActivarBlackCard/membersImages/doc'.$data->cedula.'.jpg"/>';
$message .= "<h2>Imagenes Recibos publicos</h2>";
$message .= '<img src="http://clubdecomprasusa.com/ActivarBlackCard/membersImages/oth0'.$data->cedula.'.jpg"/>';
$message .= '<img src="http://clubdecomprasusa.com/ActivarBlackCard/membersImages/oth1'.$data->cedula.'.jpg"/>';
$message .= '<img src="http://clubdecomprasusa.com/ActivarBlackCard/membersImages/oth2'.$data->cedula.'.jpg"/>';
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
}

function sendMailRecharge($data=null){
$to      = MAIL_ALLOW;
$subject = '<<Recarga>> Transaccion de recarga Tarjeta #'.$data->globalmx_tarjeta_numero;
$headers = "From: comunicaciones@globalmaxsocios.com\r\n";
$headers .= "Reply-To: comunicaciones@globalmaxsocios.com\r\n";
$headers .= "CC: sistemas@globalmaxsocios.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<img src="http://clubdecomprasusa.com/ActivarBlackCard/img/logoletra.png"/>';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Numero de tarjeta</strong> </td><td>" .$data->globalmx_tarjeta_numero . "</td></tr>";
$message .= "<tr><td><strong>Tipo de transaccion</strong> </td><td>" .$data->tipo_transaccion . "</td></tr>";
$message .= "<tr><td><strong>Valor recargado</strong> </td><td>" .$data->valor . "</td></tr>";
$message .= "<tr><td><strong>Nit empresa</strong> </td><td>" .$data->globalmx_empresa_nit . "</td></tr>";
$message .= "<tr><td><strong>Punto de venta</strong> </td><td>" .$data->punto_venta . "</td></tr>";
$message .= "</table>";
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
}	
function sendMailBuy($data=null){
$to      = MAIL_ALLOW;
$subject = '<<Compra>> Transaccion de compra Tarjeta #'.$data->globalmx_tarjeta_numero;
$headers = "From: comunicaciones@globalmaxsocios.com\r\n";
$headers .= "Reply-To: comunicaciones@globalmaxsocios.com\r\n";
$headers .= "CC: sistemas@globalmaxsocios.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<img src="http://clubdecomprasusa.com/ActivarBlackCard/img/logoletra.png"/>';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Numero de tarjeta</strong> </td><td>" .$data->globalmx_tarjeta_numero . "</td></tr>";
$message .= "<tr><td><strong>Tipo de transaccion</strong> </td><td>" .$data->tipo_transaccion . "</td></tr>";
$message .= "<tr><td><strong>Valor compra</strong> </td><td>" .$data->valor . "</td></tr>";
$message .= "<tr><td><strong>Nit empresa</strong> </td><td>" .$data->globalmx_empresa_nit . "</td></tr>";
$message .= "<tr><td><strong>Punto de venta</strong> </td><td>" .$data->punto_venta . "</td></tr>";
$message .= "</table>";
$message .= '</body></html>';
mail($to, $subject, $message, $headers);
}		       
?>