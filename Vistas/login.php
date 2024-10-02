<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/respositorio_usuario.inc.php';
include_once 'app/validador_Login.inc.php';
include_once 'app/control_sesion.inc.php';
include_once 'app/Redireccion.inc.php';

if (control_sesion:: sesion_iniciada()) {
	Redireccion:: redirigir(SERVIDOR);
}

if (isset($_POST['login'])) {
	conexion:: abrir_conexion();

	$validar=new validador_login($_POST['email'], $_POST['clave'], conexion:: obtener_conexion());

	if ($validar->obtener_error()==="" && !is_null($validar->obtener_usuario())) {
		control_sesion:: iniciar_sesion(
			$validar->obtener_usuario()->obtener_id(),
			$validar->obtener_usuario()->obtener_nombre());
		Redireccion:: redirigir(SERVIDOR);

	}
  conexion:: cerrar_conexion();
}

$titulo='Iniciar Sesion';

include_once 'Plantillas/documento_declaracion.inc.php';
include_once 'Plantillas/barra_navegacion.inc.php'
?>
<div class="contanier">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>Iniciar Sesión</h4>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="<?php echo RUTA_LOGIN; ?>">
						<h2>Introduce tus datos</h2>
						<br>
						<label for="email" class="sr-only">Email</label>
						<input type="email" name="email" id="email" class="form-control" placeholder="email"
						<?php
							if (isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email'])) {
								echo 'value="'.$_POST['email'].'"';
							}
						?>
						required autofocus>
						<br>
						<label for="clave" class="sr-only">Contraseña</label>
						<input type="Password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required>
						<br>
            <?php
            if (isset($_POST['login'])) {
								$validar -> mostrar_error();
            }
            ?>
            <button type="submit" name="login" class="btn btn-lg btn-primary btn-block">
              Iniciar sesión
          	</button>
					</form>
					<br>
					<br>
					<div class="text-center">
						<a href="<?php echo RUTA_RECUPERAR_CLAVE ?>">¿Olvidates Tu constraseña?</a>
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include_once 'Plantillas/documento_cierre.inc.php';
?>
