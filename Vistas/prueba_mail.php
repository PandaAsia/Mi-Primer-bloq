<?php 

$destinatario = "pojacewov@1thecity.biz";
$asunto = "prueba de email";
$mensaje = "esto es una Prueba";

$exito = mail($destinatario, $asunto, $mensaje);

if ($exito) {
	echo "email enviado";
}else{
	echo "envio fallido";
}