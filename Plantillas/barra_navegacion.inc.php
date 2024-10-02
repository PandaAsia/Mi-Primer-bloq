<?php
include_once 'app/control_sesion.inc.php';
include_once 'app/config.inc.php';


conexion:: abrir_conexion();
$total_usuarios=Repositorio_Usuario:: obtener_numeros_usuarios(conexion:: obtener_conexion());

?>

<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				 <div class="navbar-header">
				 	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				 		<span class="sr-only">Este Boton despliega la barra de navegacion
				 		</span>
				 		<span class="icon-bar"></span>
				 		<span class="icon-bar"></span>
				 		<span class="icon-bar"></span>
				 	</button>
				 	<a class="navbar-brand" href="<?php echo SERVIDOR;  ?>">PandaAsia</a>
				 </div>
				 <div id="navbar" class="navbar-collapse collapse">
				 	<?php 
				 	if (!control_sesion:: sesion_iniciada()) {
				 	?>
					 	<ul class="nav navbar-nav">
					 		<li><a href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Entradas</a></li>
					 		<li><a href="#"><span class="fa fa-heart" aria-hidden="true"></span> Favoritos</a></li>
					 		<li><a href="#"><span class="fa fa-user-secret" aria-hidden="true"></span> Autores</a></li>
					 	</ul>
					 	<?php }?>

				 	<ul class="nav navbar-nav navbar-right">
				 		<?php 
				 		if (control_sesion:: sesion_iniciada()) {
				 		?>
				 		<li>
				 			<a href="<?php echo RUTA_PERFIL ?>">
				 				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				 				<?php echo  ''.  $_SESSION['nombre_usuario']?>
				 			</a>
				 		</li>
				 		<li>
				 			<a href="<?php echo RUTA_GESTOR; ?>">
				 				<span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>gestor
				 			</a>
				 		</li>
				 		<li>
				 			<a href="<?php echo RUTA_LOGOUT; ?>">
				 				<span class="glyphicon glyphicon-log-out" aria-hidden="true">
				 					Cerrar Sesión
				 			</a>
				 		</li>
				 		<?php
				 		}else{
				 			?>
				 			<li><a href="#">
				 			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				 			<?php
				 				echo $total_usuarios;
				 			?>
				 		</a></li>
				 		<li><a href="<?php echo RUTA_LOGIN?>">
				 			<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
				 			Iniciar Sesion</a></li>
				 		<li><a href="<?php echo RUTA_REGISTRO?>">
				 			<span class="glyphicon glyphicon-plus" aria-hidden="true">
				 			Registro</a></li>
				 		<?php
				 		}
				 		?>
				 		
				 	</ul>				 	
				 </div>
			</div>
		</nav>