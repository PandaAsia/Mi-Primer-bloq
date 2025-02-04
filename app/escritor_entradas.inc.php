<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/repositorio_entradas.inc.php';
include_once 'app/Entradas.inc.php';

class escritor_entradas{
	public static function escribir_entradas(){
		$entradas=repositorio_entradas:: obtener_todo_fecha_descendiente(conexion:: obtener_conexion());
		if(count($entradas)){
			foreach ($entradas as $entrada) {
				self:: escribir_entrada($entrada);
			}
		}
	}

	public static function escribir_entrada($entrada){
			if(!isset($entrada)){
				return;
			}
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php
				echo $entrada->obtener_titulo();
				?>
			</div>
			<div class="panel-body">
				<p>
					<strong>
						<?php
							echo $entrada->obtener_fecha();
						?>
					</strong>
				</p>
				<div class="text-justify">
					<?php
					echo nl2br(self::resumir_texto($entrada->obtener_texto()));
				?>
				</div>
				<br>
				<div class="text-center">
					<a href="<?php echo RUTA_ENTRADA . '/'. $entrada->obtener_url() ?>" class="btn btn-primary" role="button">seguir leyendo</a>
				</div>
			</div>
		</div>
	</div>
</div>

			<?php
	}

	public static function mostrar_entradas_busqueda($entradas){
		for ($i=1; $i <= count($entradas); $i++) {
			if ($i % 3 == 0) {
				?>
				<div class="row">
				<?php
			}

			$entrada = $entradas[$i - 1];
			self:: mostrar_entrada($entrada);

			if ($i % 3 ==0) {
				?>
				</div>
				<?php
			}
		}
	}

	public static function mostrar_entradas_busqueda_multiple($entradas){
		for ($i=1; $i < count($entradas); $i++) {
				?>
				<div class="row">
				<?php

			$entrada = $entradas[$i];
			self:: mostrar_entrada_multiple($entrada);
				?>
				</div>
				<?php
		}
	}

	public static function mostrar_entrada($entrada){
			if(!isset($entrada)){
				return;
			}
		?>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php
				echo $entrada->obtener_titulo();
				?>
			</div>
			<div class="panel-body">
				<p>
					<strong>
						<?php
							echo $entrada->obtener_fecha();
						?>
					</strong>
				</p>
				<div class="text-justify">
					<?php
					echo nl2br(self::resumir_texto($entrada->obtener_texto()));
				?>
				</div>
				<br>
				<div class="text-center">
					<a href="<?php echo RUTA_ENTRADA . '/'. $entrada->obtener_url() ?>" class="btn btn-primary" role="button">seguir leyendo</a>
				</div>
			</div>
		</div>
	</div>


			<?php
	}

	public static function mostrar_entrada_multiple($entrada){
			if(!isset($entrada)){
				return;
			}
		?>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php
				echo $entrada->obtener_titulo();
				?>
			</div>
			<div class="panel-body">
				<p>
					<strong>
						<?php
							echo $entrada->obtener_fecha();
						?>
					</strong>
				</p>
				<div class="text-justify">
					<?php
					echo nl2br(self::resumir_texto($entrada->obtener_texto()));
				?>
				</div>
				<br>
				<div class="text-center">
					<a href="<?php echo RUTA_ENTRADA . '/'. $entrada->obtener_url() ?>" class="btn btn-primary" role="button">seguir leyendo</a>
				</div>
			</div>
		</div>
	</div>


			<?php
	}

	public static function resumir_texto($texto){
		$longitud_maxima =400;
		$resultado='';

		if(strlen($texto)>=$longitud_maxima){
			/*for ($i=0; $i < $longitud_maxima; $i++) {
				$resultado .=substr($texto, $i, 1);
		}*/
			$resultado= substr($texto, 0, $longitud_maxima);
			$resultado .='...';

		}else{
			$resultado=$texto;
		}
		return $resultado;
	}
}
