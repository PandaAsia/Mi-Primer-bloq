<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entradas.inc.php';
include_once 'app/comentario.inc.php';

include_once 'app/respositorio_usuario.inc.php';
include_once 'app/repositorio_entradas.inc.php';
include_once 'app/repositorio_comentario.inc.php';

$titulo = $entrada->obtener_titulo();

include_once 'Plantillas/documento_declaracion.inc.php';
include_once 'Plantillas/barra_navegacion.inc.php';

?>
<div class="container contenido-articulo">
	<div class="row">
		<div class="col-md-12">
			<h1><?php echo $entrada->obtener_titulo();?></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p>
			  Por:<a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			  	<?php echo $autor->obtener_nombre()?>
			  </a>	
			  el
			  <?php echo $entrada->obtener_fecha(); ?>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<article class="text-justify">
				<?php echo nl2br($entrada->obtener_texto())?>
			</article>
		</div>
	</div>
	<?php 
		include_once 'Plantillas/entrada_alzar.inc.php';
	?>
	<br>
	<?php 
	if (count($comentario)>0) {
		include_once 'Plantillas/comentarios_entradas.inc.php';
	}else{
		echo '<p>¡Toadabia no hay Comentario!</p>';
	}
	?>
</div>

<?php
include_once 'Plantillas/documento_cierre.inc.php'
?>

