<?php 

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified".gmdate("D, d M Y H:i:s"). "GMT");
header("Cache-Control: no-store, no-cache, must-fevalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$titulo='Perfil de Usuario';
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/control_sesion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/respositorio_usuario.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'Plantillas/documento_declaracion.inc.php';
include_once 'Plantillas/barra_navegacion.inc.php';

if (!control_sesion::sesion_iniciada()) {
	Redireccion::redirigir(RUTA_LOGIN);
}else{
	conexion::abrir_conexion();
	$id= $_SESSION['id_usuario'];
	$usuario=Repositorio_Usuario::obtener_usuario_por_id(conexion::obtener_conexion(), $id);
}

if (isset($_POST['guardar_imagen']) && !empty($_FILES['archivo_subido']['tmp_name'])) {
	$directorio =DIRECTORIO_RAIZ."/subidas/";
	$carpeta_objetivo = $directorio.basename($_FILES['archivo_subido']['name']);
	$subidas_correcta=1;
	$tipo_imagen=pathinfo($carpeta_objetivo, PATHINFO_EXTENSION);

	$comprobacion=getimagesize($_FILES['archivo_subido']['tmp_name']);
	if ($comprobacion!==false) {
		$subidas_correcta=1;
	}else{
		$subidas_correcta=0;
	}

	if ($_FILES['archivo_subido']['size']>500000) {
		echo "El arvhivo no puede ocupar más de 500kb";
		$subidas_correcta=0;
	}

	if ($tipo_imagen!="jpg" && $tipo_imagen!="png" && $tipo_imagen!="jpeg" && $tipo_imagen!="gif") {
		echo "Solo se admiten los formatos JPG,JPEG,PNG Y GIF";
	}
	if ($subidas_correcta==0) {
		echo "Tu archivo no puede subirse";
	}else{
		if (move_uploaded_file($_FILES['archivo_subido']['tmp_name'] , DIRECTORIO_RAIZ."/subidas/".$usuario->obtener_id() )) {
			echo "el archivo".basename($_FILES['archivo_subido']['name'])."h sido subido" ;
		}else{
			echo "ha ocurrido un error";
		}
	}
}
?>

<div class="container perfil">
	<div class="row">
		<div class="col-md-3">
			<?php 
				if (file_exists(DIRECTORIO_RAIZ."/subidas/".$usuario->obtener_id())) {
					?>
					<img src="<?php echo SERVIDOR.'/subidas/'.$usuario->obtener_id(); ?>" class="img-responsive">
					<?php
				}else{
					?>
					<img src="img/44948.png" class="img-responsive">
					<?php
				}
			?>
			
			<br>
			<form class="text-center" action="<?php echo RUTA_PERFIL; ?>" method="post" enctype="multipart/form-data">
				<label for="archivo_subido" id="label_archivo">Sube una Imagen</label>
				<input type="file" name="archivo_subido" id="archivos_subidos" class="boton_subir">
				<br>
				<br>
				<input type="submit" name="guardar_imagen" value="Guardar" class="form-control">
			</form>
		</div>
		<div class="col-md-9">
			<h4><small>Nombre de Usuario</small></h4>
			<h4><?php echo $usuario->obtener_nombre(); ?></h4>
			<br>
			<h4><small>Email</small></h4>
			<h4><?php echo $usuario->obtener_email(); ?></h4>
			<br>
			<h4><small>Nombre de Uusuario</small></h4>
			<h4><?php echo $usuario->obtener_fecha_registro(); ?></h4>
			<br>
		</div>
	</div>
</div>

<?php
include_once 'Plantillas/documento_cierre.inc.php';
?>