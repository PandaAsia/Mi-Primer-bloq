<?php 
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';

$titulo='Gestion';

include_once 'Plantillas/documento_declaracion.inc.php';
include_once 'Plantillas/barra_navegacion.inc.php';

include_once 'Plantillas/panel_control_declaracion.inc.php';


switch ($gestor_actual) {
	case '':
		$cantidad_entradas_activas=repositorio_entradas::contar_entradas_activas_usuario(conexion::obtener_conexion(), $_SESSION['id_usuario']);
		$cantidad_entradas_inactivas=repositorio_entradas::contar_entradas_inactivas_usuario(conexion::obtener_conexion(), $_SESSION['id_usuario']);
		$cantidad_comentarios=repositorio_comentario::contar_comentarios_usuario(conexion::obtener_conexion(), $_SESSION['id_usuario']);
		include_once 'Plantillas/gestor_generico.inc.php';
		break;
	case 'entradas':

		$array_entradas=repositorio_entradas::obtener_entradas_usuarios_fecha_decendente(conexion::obtener_conexion(),$_SESSION['id_usuario']);
		
		include_once 'Plantillas/gestor_entradas.inc.php';
		break;
	case 'comentarios':
		include_once 'Plantillas/gestor_comentarios.inc.php';
		break;
	case 'favoritos':
		include_once 'Plantillas/gestor_favoritos.inc.php';
		break;
include_once 'Plantillas/panel_control_cierre.inc.php';
}
?>
<?php
include_once 'Plantillas/documento_cierre.inc.php';
?>