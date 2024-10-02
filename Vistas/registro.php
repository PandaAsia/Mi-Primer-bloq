<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/respositorio_usuario.inc.php';
include_once 'app/registro_vadacion.inc.php';
include_once 'app/Redireccion.inc.php';


if(isset($_POST['enviar'])){
	conexion:: abrir_conexion();

	$validador=new registro_validacion($_POST['Nombre'], $_POST['Email'], 
		$_POST['clave1'], $_POST['clave2'], conexion:: obtener_conexion());

	if($validador->registro_valido()){
		$Usuario=new Usuario('', $validador->obtener_nombre(), $validador->obtener_email(), 
			password_hash($validador->obtener_clave(), PASSWORD_DEFAULT), '', '');
		$usuario_insertado=Repositorio_Usuario:: insertar_usuario(conexion:: obtener_conexion(),$Usuario);
		if($usuario_insertado){
			Redireccion:: redirigir(RUTA_REGISTRO_CORRECTO . '/'.$Usuario->obtener_nombre());
		}
	}
	conexion:: cerrar_conexion();
}

$titulo='Registro';

include_once 'Plantillas/documento_declaracion.inc.php';
include_once 'Plantillas/barra_navegacion.inc.php';
?>

<div class="container">
	<div class="jumbotron">
			<h1 class="text-center">
				Registro
			</h1>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-5 text-center">
			<div class="panel panel-defaul">
				<div class="panel panel-heading">
					<h3 class="panel-title">
						Instrucciones para Registrarte
					</h3>
			</div>
			<div class="panel panel-body">
				<br>
				<p>
				 Solo Registrate ya!
				</p>
				<br>
				<a href="#">¿ya tienes Cuenta?</a>
				<br>
				<br>
				<a href="">¿Olvidaste tu  Contraseña?</a>
			</div>
			</div>
		</div>
		<div class="col-md-7 text-center">
			<div class="panel panel-defaul">
				<div class="panel panel-heading">
				<h3 class="panel-title">
						Introduce tus Datos
					</h3>
			</div>
			<div class="panel panel-body">
				<form role="form" method="post" action="<?php echo RUTA_REGISTRO//$_SERVER['PHP_SELF'];?>">
					<?php 
						if(isset($_POST['enviar'])){
							include_once 'Plantillas/registro_validado.inc.php';
						}else{
							include_once 'Plantillas/registro_vacio.inc.php';
						}
					?>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
include_once 'Plantillas/documento_cierre.inc.php'
?>