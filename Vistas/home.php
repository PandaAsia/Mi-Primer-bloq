<?php
include_once 'app/conexion.inc.php';
include_once 'app/respositorio_usuario.inc.php';
include_once 'app/escritor_entradas.inc.php';

$titulo='PandaAsia';

include_once 'Plantillas/documento_declaracion.inc.php';
include_once 'Plantillas/barra_navegacion.inc.php';
?>
		<div class="container">
			<div class="jumbotron">
				<h1>
					Panda Asia
				</h1>
				<p>
					Esta pagina solo es por divercion
				</p>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel panel-heading">
									<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Búsqueda
								</div>
								<div class="panel-body">
									<form method="post" role="form" action="<?php echo RUTA_BUSCAR; ?>">
									<div class="form-group">
										<input type="search" class="form-control" placeholder="¿Qué buscas?" name="termino_buscar" >
									</div>
									<button class="form-control btn btn-primary" type="submit" name="buscar">Buscar</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel panel-heading">
									<span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Filtros
								</div>
								<div class="panel-body">

								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel panel-heading">
									<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Archivos
								</div>
								<div class="panel-body">

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<?php
						escritor_entradas::escribir_entradas();
					?>
				</div>
			</div>
		</div>
<?php
include_once 'Plantillas/documento_cierre.inc.php';
?>
