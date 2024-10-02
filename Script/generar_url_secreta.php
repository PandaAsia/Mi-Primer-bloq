<?php 

include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Recuperacion_clave.inc.php';

include_once 'app/respositorio_usuario.inc.php';
include_once 'app/repositorio_recuperacion_clave.inc.php';

include_once 'app/Redireccion.inc.php';


function sa($longitud) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres);
    $string_aleatorio = '';
    
    for ($i = 0; $i < $longitud; $i++) {
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)];
    }
    
    return $string_aleatorio;
}

if (isset($_POST['enviar_email'])) {
	$email=$_POST['email'];

	conexion::abrir_conexion();

	if (!Repositorio_Usuario:: email_exite(conexion::obtener_conexion(), $email)) {
		return;
	}

	$usuario=Repositorio_Usuario:: obtener_usuario_por_email(conexion::obtener_conexion(), $email);

	$nombre_usurio=$usuario->obtener_nombre();

	$string_aleatorio=sa(10);

	$url_secreto = hash('sha256',$string_aleatorio . $nombre_usurio);

	$peticion_generada = repositorio_recuperacion_clave:: generar_peticion(conexion::obtener_conexion(), $usuario->obtener_id(), $url_secreto);
	conexion::cerrar_conexion();

	if ($peticion_generada) {
		Redireccion:: redirigir(RUTA_REGISTRO);
	}
}
?>