<div class="row">
	<div class="col-md-12">
		<button class="btn btn-primary form-control" data-toggle="collapse" data-target="#comentarios">
			<?php echo "Ver Comentario (". count($comentario). ")" ?>
		</button>
		<br>
		<br>
		<div id="comentarios" class="collapse">
			<?php 
				for ($i=0; $i <count($comentario) ; $i++) { 
					$comentarios =$comentario[$i];
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<?php echo $comentarios->obtener_titulo();?>
								</div>
								<div class="panel-body">
									<div class="col-md-2">
										<?php echo $comentarios->obtener_autor_id();?>
									</div>
									<div class="col-md-10">
										<p>
											<?php echo $comentarios->obtener_fecha();?>
										</p>
										<p>
											<?php echo nl2br($comentarios->obtener_texto());?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			?>
		</div>
	</div>
</div>
