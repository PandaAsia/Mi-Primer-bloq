<?php 
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/Entradas.inc.php';
include_once 'app/repositorio_entradas.inc.php';
include_once 'app/validador_entrada.inc.php';
include_once 'app/control_sesion.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/validador_entradas_editadas.inc.php';

conexion::abrir_conexion();

if (isset($_POST['guardar_cambios_entrada'])) {
	$entrada_pubblica_nueva = 0;
	if (isset($_POST['publica']) && $_POST['publica']=="si") {
		$entrada_pubblica_nueva=1;
	}

	$validador =new validador_entradas_editadas($_POST['titulo'], $_POST['titulo_original'], $_POST['url'], $_POST['url_original'], htmlspecialchars($_POST['texto']), $_POST['texto_original'], $_POST['publica'], $_POST['publicar_original'], conexion::obtener_conexion());
	if (!$validador->hay_cambios()) {
		Redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
	}else{
		if ($validador->entrada_valida()) {
			$cambios_afctuados=repositorio_entradas::actualizar_entrada(conexion::obtener_conexion(), $_POST['id_entrada'],
			$validador->obtener_titulo(), $validador->obtener_url(), $validador->obtener_texto(), $validador->obtener_checkbox());
			if ($cambios_afctuados) {
				Redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
			}
		}
	}
}

$titulo='Editar Entrada';
include_once 'Plantillas/documento_declaracion.inc.php';
include_once 'Plantillas/barra_navegacion.inc.php';
?>
<div class="container">
	<div class="jumbotron">
			<h1 class="text-center">
				Editar Entrada
			</h1>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form class="form_nueva_entrada" method="post" action="<?php echo RUTA_EDITAR_ENTRADA?>">
				<?php 
				if (isset($_POST['editar_entrada'])) {
					$id_entrada=$_POST['id_editar'];
					conexion::abrir_conexion();
					$entrada_recuperada=repositorio_entradas::obtener_entrada_por_id(conexion::obtener_conexion(), $id_entrada);

					include_once 'Plantillas/form_entrada_recuperada.inc.php';
					conexion::cerrar_conexion();
				}elseif (isset($_POST['guardar_cambios_entrada'])) {
					$id_entrada=$_POST['id_entrada'];
					$entrada_recuperada=repositorio_entradas::obtener_entrada_por_id(conexion::obtener_conexion(), $id_entrada);
				 	include_once 'Plantillas/form_entrada_recuperada_validada.inc.php';	
				}
				?>
			</form>
		</div>
	</div>
</div>
<?php
include_once 'Plantillas/documento_cierre.inc.php';
?>

