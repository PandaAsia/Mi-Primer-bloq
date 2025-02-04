<div class="row parte_gestor_entrada">
	<div class="col-md-12">
		<h2>
			Gestión de Entradas
		</h2>
		<br>
		<a href="<?php echo RUTA_NUEVA_ENTRADA ?>" class="btn btn-lg btn-primary" role="button" id="button_nueva_entrada">Crear Entrada</a>
		<br>
	</div>
</div>
<div class="row parte_gestor_entrada">
	<div class="col-md-12">
		<?php 
			if (count($array_entradas) >0 ) {

				?>
				<table class="table table-striped">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Título</th>
					<th>Estado</th>
					<th>Comentario</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				for ($i=0; $i < count($array_entradas); $i++) { 
				 	$entrada_actual=$array_entradas[$i][0];
				 	$comentario_entrada_actual=$array_entradas[$i][1];
				 	?>
				 		<tr>
							<td><?php echo $entrada_actual->obtener_fecha(); ?></td>
							<td><?php echo $entrada_actual->obtener_titulo(); ?></td>
							<td><?php echo $entrada_actual-> esta_activa(); ?></td>
							<td><?php echo $comentario_entrada_actual; ?></td>
							<td>
								<form method="post" action="<?php echo RUTA_EDITAR_ENTRADA ?>">
									<input type="hidden" name="id_editar" value="<?php echo $entrada_actual->obtener_id(); ?>">
									<button type="submit" class="btn btn-default btn-xs" name="editar_entrada">
									Editar
								</button>
								</form>
							</td>
							<td>
								<form method="post" action="<?php echo RUTA_BORRA_ENTRADA ?>">
									<input type="hidden" name="id_borrar" value="<?php echo $entrada_actual->obtener_id(); ?>">
									<button type="submit" class="btn btn-default btn-xs" name="borrar_entrada">
									borrar
								</button>
								</form>
							</td>
						</tr>
				 	<?php
				 } 
				?>
			</tbody>
		</table>
				<?php
				
			}else{
				?>
				<h3 class="text-center">Todavía no has escrito ninguna entradas</h3>
				<br>
				<br>
			<?php
			}
		?>
		
	</div>
</div>