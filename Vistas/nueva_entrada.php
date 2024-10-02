<?php 
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/Entradas.inc.php';
include_once 'app/repositorio_entradas.inc.php';
include_once 'app/validador_entrada.inc.php';
include_once 'app/control_sesion.inc.php';
include_once 'app/Redireccion.inc.php';

$entrada_publica = 0;
if (isset($_POST['guardar'])) {
	conexion::abrir_conexion();
	$validador=new validador_entradas($_POST['titulo'], $_POST['url'], htmlspecialchars($_POST['texto']), conexion::obtener_conexion());
	if(isset($_POST['publica']) && $_POST['publica']=='si'){
		$entrada_publica=1;
	}
	if ($validador->entrada_valida()) {
		if (control_sesion::sesion_iniciada()) {
			$entrada =new Entradas('', $_SESSION['id_usuario'], $validador->obtener_url(), $validador->obtener_titulo(), $validador->obtener_texto(), '', $entrada_publica);
			$entrada_insertada= repositorio_entradas::insertar_entradas(conexion::obtener_conexion(), $entrada);
			if ($entrada_insertada) {
				Redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
			}
		}else{
			Redireccion::redirigir(RUTA_LOGIN);
		}
		conexion::cerrar_conexion();
	}
}

$titulo='Nueva Entrada';

include_once 'Plantillas/documento_declaracion.inc.php';
include_once 'Plantillas/barra_navegacion.inc.php';

?>

<div class="container">
	<div class="jumbotron">
			<h1 class="text-center">
				Nueva Entrada
			</h1>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form class="form_nueva_entrada" method="post" action="<?php echo RUTA_NUEVA_ENTRADA?>">
				<?php 
				if (isset($_POST['guardar'])) {
					include_once 'Plantillas/form_nueva_entrada_validado.inc.php';
				}else{
					include_once 'Plantillas/form_nueva_entrada_vacio.inc.php';
				}
				?>
			</form>
		</div>
	</div>
</div>

<?php
include_once 'Plantillas/documento_cierre.inc.php'
?>