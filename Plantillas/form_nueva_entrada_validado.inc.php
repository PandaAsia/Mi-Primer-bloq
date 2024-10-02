<div class="form-group">
				<label for="titulo">Titulo</label>
				<input type="text" id="titulo" class="form-control" placeholder="titulo" name="titulo"
				<?php $validador->mostrar_titulo(); ?> >
				<?php 
					$validador->mostrar_error_titulo();
				?>
			</div>
			<div class="form-group">
				<label for="url">URL</label>
				<input type="text" id="url" class="form-control" placeholder="url" name="url"
				<?php $validador->mostrar_url() ?> >
				<?php $validador->mostrar_error_url() ?>
			</div>
			<div class="form-group">
				<label for="contenido">Contenido</label>
				<textarea class="form-control" rows="4" id="contenido" name="texto" placeholder="escribe el contenido"><?php $validador->mostrar_texto(); ?></textarea>
				<?php $validador->mostrar_error_texto() ?>
			</div>
			<div class="checkbox">
				<label><input type="checkbox" name="publica" value="si"
					<?php  
						if ($entrada_publica) {
							echo 'checked';
						}
					?>
					>Marca este Recuardo que  se active</label>
			</div>
			<br>
			<button type="submit" class="btn btn-default btn-primary" name="guardar">Guardar Entrada</button>