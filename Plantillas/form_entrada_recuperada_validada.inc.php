<input type="hidden" name="id_entrada" id="id_entrada" value="<?php echo $id_entrada; ?>">
<div class="form-group">
	<label for="titulo">Titulo</label>
	<input type="text" id="titulo" class="form-control" placeholder="titulo" name="titulo"
		value="<?php echo $validador->obtener_titulo() ?>">
	<input type="hidden" name="titulo_original" id="titulo_original" value="<?php echo $entrada_recuperada->obtener_titulo(); ?>">
	<?php 
	$validador->mostrar_error_titulo();
	?>
</div>
<div class="form-group">
	<label for="url">URL</label>
	<input type="text" id="url" class="form-control" placeholder="url" name="url"
		value="<?php echo $validador-> obtener_url() ?>">
	<input type="hidden" id="url_original" name="url_original" value="<?php echo $entrada_recuperada-> obtener_url() ?>">
	<?php 
	$validador->mostrar_error_url();
	?>
</div>
<div class="form-group">
	<label for="contenido">Contenido</label>
	<textarea class="form-control" rows="4" id="texto" name="texto" placeholder="escribe el contenido"><?php 
		echo $validador->obtener_texto();
		?></textarea>
	<input type="hidden" id="texto_original" name="texto_original" value="<?php echo $entrada_recuperada-> obtener_texto() ?>">
	<?php 
	$validador->mostrar_error_texto();
	?>
</div>
<div class="checkbox">
	<label><input type="checkbox" name="publica" value="si"
		<?php if ($validador->obtener_checkbox()) {
			echo "checked";
		} ?>>Marca este Recuardo que  se active
		<input type="hidden" name="publicar_original" id="publicar_original" value="<?php echo $entrada_recuperada->esta_activa() ?>">
	</label>
</div>
<br>
<button type="submit" class="btn btn-default btn-primary" name="guardar_cambios_entrada">Guardar Cambios</button>
