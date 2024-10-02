<?php 
include_once 'repositorio_entradas.inc.php';
include_once 'validador.inc.php';

class validador_entradas extends validador{
	

	public function __construct($titulo, $url, $texto, $conexion){
		$this->aviso_inicio ="<br><div class='alert alert-danger' role='alert'>";
		$this->aviso_cierre="</div>";

		$this->titulo="";
		$this->url="";
		$this->texto="";

		$this->error_titulo=$this->validar_titulo($conexion, $titulo);
		$this->error_url=$this->validar_url($conexion, $url);
		$this->error_texto=$this->validar_texto($texto);

	}

	
}
