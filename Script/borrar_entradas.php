<?php 
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/repositorio_entradas.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_POST['borrar_entrada'])) {
	$id_entrada=$_POST['id_borrar'];
	conexion:: abrir_conexion();
	repositorio_entradas::eliminar_comentarios_y_entradas(conexion::obtener_conexion(), $id_entrada);
	conexion::cerrar_conexion();
	Redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
}
?>