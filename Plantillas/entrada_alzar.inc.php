<?php 
	include_once 'app/escritor_entradas.inc.php';
?>
<div class="row">
	<div class="col-md-12">
		<hr>
		<h3>
			Otras Entradas Interesantes
		</h3>
	</div>
	<?php 
	for ($i=0; $i < count($entradas_alzar); $i++) { 
		$entrada_actual=$entradas_alzar[$i];
	?>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo $entrada_actual->obtener_titulo();?>
			</div>
			<div class="panel-body">
				<p class="text-justify">
					<?php echo escritor_entradas::resumir_texto(nl2br($entrada_actual->obtener_texto()))?>
				</p>
				
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="col-md-12">
		<hr>
	</div>
</div>