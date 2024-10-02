<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/respositorio_usuario.inc.php';
include_once 'app/Redireccion.inc.php';


/*if (isset($_GET['Nombre']) && !empty($_GET['Nombre'])) {
	$nombre = $_GET['Nombre'];
}else{
	Redireccion:: redirigir(SERVIDOR);
}*/

$titulo='Registro Correcto';

include_once 'Plantillas/documento_declaracion.inc.php';
include_once 'Plantillas/barra_navegacion.inc.php';
?>
<div class="container">
	<div class="row">
		<div class="col-md-2">	
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
					Registro Correcto
				</div>
				<div class="panel-body text-center">
					<p>¡Gracias Por Registrarte <strong><?php echo $nombre?></strong>!</p>
					<br>
					<p><a href="<?php echo RUTA_LOGIN?>">Iniciar Sesion</a> para commenzar a utilizar tu cuenta</p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include_once 'Plantillas/documento_cierre.inc.php';
?>