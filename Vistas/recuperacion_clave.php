<?php 
include_once 'app/repositorio_recuperacion_clave.inc.php';
include_once 'app/Redireccion.inc.php';


conexion::abrir_conexion();

if (repositorio_recuperacion_clave::url_secreta_exite(conexion::obtener_conexion(), $url_personal)) {
	$id_usuario= repositorio_recuperacion_clave::obtener_id_mediate_url_secreta(conexion::obtener_conexion(), $url_personal);
}else{
	echo "404";
}
if (isset($_POST['guardar_clave'])) {
	//vlidar k¿la clave 1
	//comprobar si la clave 2 coincide

	$clave_cifrada = password_hash($_POST['clave'], PASSWORD_DEFAULT);
	$clave_actualizada = Repositorio_Usuario::actualizar_password(conexion::obtener_conexion(), $id_usuario, $clave_cifrada);
	//eliminar la url de recuperarla contraseña
	//redirigir a notificaciones de actulizaciones  correcta y ofrecer link a login
	if ($clave_actualizada) {
		Redireccion::redirigir(RUTA_LOGIN);
	}else{
		//informar el error
		echo "error";
	}
}
conexion::cerrar_conexion();

$titulo = "Recupercion de contraseña";

include_once 'Plantillas/documento_declaracion.inc.php';
include_once 'Plantillas/barra_navegacion.inc.php';
?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>Crea una nueva contraseña</h4>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="<?php echo RUTA_RECUPERACION_CLAVE."/".$url_personal?>">

						<br>
						<div class="form-group">
							<label for="clave">Nueva contraseña</label>
							<input type="password" name="clave" id="clave" class="form-control" placeholder="Mínimo 6 caracteres" required>
						</div>

						<div class="form-group">
							<label for="clave2">Escribe de nuevo la contraseña</label>
							<input type="password" name="clave2" id="clave2" class="form-control" placeholder="Debe coincidir" required>
						</div>

						<button type="submit" name="guardar_clave" class="btn btn-lg btn-primary btn-block">
							Guardar contraseña
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>