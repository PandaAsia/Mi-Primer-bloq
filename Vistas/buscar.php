<?php
include_once "app/escritor_entradas.inc.php";

$busqueda=null;
$resultado = null;

$buscar_titulo=false;
$buscar_contenido=false;
$buscar_tags=false;
$buscar_autor=false;

if (isset($_POST['buscar']) && isset($_POST['termino_buscar']) && !empty($_POST['termino_buscar'])) {
	$busqueda=$_POST['termino_buscar'];
	conexion::abrir_conexion();
	$resultado= repositorio_entradas::buscar_entradas_todos_campos(conexion:: obtener_conexion(), $busqueda, $orden);
	conexion::cerrar_conexion();
}

if (isset($_POST['busqueda_avanzada']) && isset($_POST['campos'])) {

	if (in_array("titulo", $_POST['campos'])) {
		$buscar_titulo=true;
	}
	if (in_array("contenido", $_POST['campos'])) {
		$buscar_contenido=true;
	}
	if (in_array("tags", $_POST['campos'])) {
		$buscar_tags=true;
	}
	if (in_array("autor", $_POST['campos'])) {
		$buscar_autor=true;
	}
	if ($_POST['fecha']=='recientes') {
		$orden='DESC';
	}
	if ($_POST['fecha']=='antiguas') {
		$orden='ASC';
	}

	if (isset($_POST['termino_buscar']) && !empty($_POST['termino_buscar'])) {
		$busqueda=$_POST['termino_buscar'];

		conexion::abrir_conexion();
		if ($buscar_titulo) {
			$entrada_titulo=repositorio_entradas::buscar_entradas_titulo(conexion::obtener_conexion(), $busqueda, $orden);
		}
		if ($buscar_contenido) {
			$entrada_contenido=repositorio_entradas::buscar_entradas_contenido(conexion::obtener_conexion(), $busqueda, $orden);
		}
		if ($buscar_tags) {
			echo "Todavía no implementada";
		}
		if ($buscar_autor) {
			$entrada_autor=repositorio_entradas::buscar_entradas_autor(conexion::obtener_conexion(), $busqueda, $orden);
		}
	}
}

$titulo='Buscar';

include_once 'Plantillas/documento_declaracion.inc.php';
include_once 'Plantillas/barra_navegacion.inc.php';
 ?>

 <div class="container">
	 <div class="row">
	 <div class="jumbotron">
		 <h1>
			 Buscar en PandaAsia
		 </h1>
		 <div class="row">
			 <div class="col-md-2">
			 </div>
			 <div class="col-md-8">
				 <form method="post" role="form" action="<?php echo RUTA_BUSCAR; ?>">
				 <div class="form-group">
					 <input type="search" class="form-control" placeholder="¿Qué buscas?" name="termino_buscar"
					 <?php echo "value='". $busqueda ."'";?> required>
				 </div>
				 <button class="form-control btn btn-primary btn_buscar" type="submit" name="buscar">Buscar</button>
				 </form>
			 </div>
		 </div>
	 </div>
 </div>
 </div>

 <div class="container">
	 <div class="row">
		 <div class="panel-group">
			 <div class="panel panel-default">
				 <div class="panel-heading">
					 <h4 class="panel-title">
						 <a data-toggle="collapse" href="#avanzada">Búsqueda Avanzada</a>
					 </h4>
				 </div>
				 <div class="panel-collapse collapse" id="avanzada">
					 <div class="panel-body">
					 	<form method="post" role="form" action="<?php echo RUTA_BUSCAR; ?>">
							<div class="form-group">
 							 <input type="search" class="form-control" placeholder="¿Qué buscas?" name="termino_buscar"
 							 <?php echo "value='". $busqueda ."'";?> required>
 						 </div>
							<p>Buscar en las siguientes Categorisas:</p>
							<label class="checkbox-inline"><input type="checkbox" name="campos[]" value="titulo"
									<?php
										if (isset($_POST['busqueda_avanzada'])) {
											if ($buscar_titulo) {
												echo "checked";
											}else {
												echo "checked";
											}
										}
									?>
								>Título</label>
							<label class="checkbox-inline"><input type="checkbox" name="campos[]" value="contenido"
								<?php
									if (isset($_POST['busqueda_avanzada'])) {
										if ($buscar_contenido) {
											echo "checked";
										}
									}else {
											echo "checked";
									}
								?>
								>Contenido</label>
							<label class="checkbox-inline"><input type="checkbox" name="campos[]" value="tags"
								<?php
									if (isset($_POST['busqueda_avanzada'])) {
										if ($buscar_tags) {
											echo "checked";
										}
									}else {
											echo "checked";
									}
								?>
								>Tags</label>
							<label class="checkbox-inline"><input type="checkbox" name="campos[]" value="autor"
								<?php
									if (isset($_POST['busqueda_avanzada'])) {
										if ($buscar_autor) {
											echo "checked";
										}
									}else{
										echo "checked";
									}
								?>
								>Autor</label>
							<hr>
							<p> Ordenar por:</p>
							<label class="radio-inline">
								<input type="radio" name="fecha" value="recientes"
									<?php
										if (isset($_POST['busqueda_avanzada']) && isset($orden) && $orden=="DESC") {
											echo "checked";
										}

										if (!isset($_POST['busqueda_avanzada'])) {
											echo "checked";
										}
									?>
								>Entradas más recientes
							</label>
							<label class="radio-inline">
								<input type="radio" name="fecha" value="antiguas"
								<?php
									if (isset($_POST['busqueda_avanzada']) && isset($orden) && $orden=="ASC") {
										echo "checked";
									}
									?>
								>Entradas más antiguas
							</label>
							<hr>
							<button class="form-control btn btn-primary" type="submit" name="busqueda_avanzada">Buscar</button>
						</form>
					 </div>
				 </div>
			 </div>
		 </div>
	 </div>
 </div>

 <div class="container" id="resultado">
	 <div class="row">
		 <div class="col-md-12">
			 <div class="page-header">
				 <h1>Resultado
					 <?php
					 if (isset($_POST['buscar']) && isset($resultado)) {
					 	echo " ";
						?>
						<small><?php echo count($resultado); ?></small>
						<?php
					}else if (isset($_POST['busqueda_avanzada'])) {
						// pendiente
					}
					 ?>
				 </h1>
			 </div>
		 </div>
	 </div>
	 <?php
	 	if (isset($_POST['buscar'])) {
	 		if (isset($resultado)) {
	 			escritor_entradas::mostrar_entradas_busqueda($resultado);
	 		}else{
	 			?>
	 			<h3>sin Coincidencia</h3>
	 			<hr>
	 			<?php
	 		}
	 	}elseif (isset($_POST['busqueda_avanzada'])) {
	 		if (count($entrada_titulo) || count($entrada_contenido) || count($entrada_autor)) {
	 			$parametros = count($_POST['campos']);
	 			$ancho_colummnos = 12/$parametros;
	 			?>
	 				<div class="row">
	 					<?php
	 						for ($i=0; $i < $parametros; $i++) { 
	 							?>
	 							<div class="<?php echo 'col-md-'.$ancho_colummnos; ?> text-center">
	 								<h4><?php echo 'Coincidencia en'.$_POST['campos'][$i]; ?></h4>
	 								<br>
	 								<?php
	 								switch ($_POST['campos'][$i]) {
	 									case 'titulo':
	 										escritor_entradas::mostrar_entradas_busqueda_multiple($entrada_titulo);
	 										break;
	 									case 'contenido':
	 										escritor_entradas::mostrar_entradas_busqueda_multiple($entrada_contenido);
	 										break;
	 									case 'tags':
	 										# code...
	 										break;
	 									case 'autor':
	 										escritor_entradas::mostrar_entradas_busqueda_multiple($entrada_autor);
	 										break;
	 								}
	 								?>
	 							</div>
	 						<?php
	 						}
	 					?>
	 				</div>
	 			<?php
	 		}else{
	 			?>
	 			<h3>Sin Coincidencias</h3>
	 			<br>
	 			<?php
	 		}
	 	}
	  ?>
 </div>

 <?php
 include_once 'Plantillas/documento_cierre.inc.php';
 ?>
