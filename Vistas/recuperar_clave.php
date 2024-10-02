<?php 
$titulo='Recuperacion de contraseña';

include_once 'Plantillas/documento_declaracion.inc.php';
include_once 'Plantillas/barra_navegacion.inc.php'
?>
<div class="contanier">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>Recuperacion de Clave</h4>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="<?php echo RUTA_GENERAR_URL_SECRETA?>">
						<h2>Introduce tu gmail</h2>
						<br>
						<p>
							Escribe tu correo electronico, para enviar un codigo a tu gmail para restablecer a tu contraseña
						</p>
						<label for="email" class="sr-only">Email</label>
						<input type="email" name="email" id="email" class="form-control" placeholder="email" required autofocus>
						<br>
						<button type="submit" name="enviar_email" class="btn btn-lg btn-primary btn-block">Enviar</button>
					</form>
					<br>
					<br>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include_once 'Plantillas/documento_cierre.inc.php';
?>