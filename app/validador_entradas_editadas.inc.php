<?php 
include_once 'repositorio_entradas.inc.php';
include_once 'validador.inc.php';


class validador_entradas_editadas extends validador{

	private $cambios_realizadas;

	private $checkbox;

	private $titulo_original;
	private $url_original;
	private $texto_original;
	private $checkbox_original;

	public function __construct($titulo, $titulo_original,  $url, $url_original, $texto, $texto_original, $checkbox, $checkbox_original, $conexion){

		$this -> titulo=$this->devolver_variable_si_iniciada($titulo);
		$this -> url=$this->devolver_variable_si_iniciada($url);
		$this -> texto=$this->devolver_variable_si_iniciada($texto);
		$this -> checkbox=$this->devolver_variable_si_iniciada($checkbox);

		$this -> titulo_original=$this->devolver_variable_si_iniciada($titulo_original);
		$this -> url_original=$this->devolver_variable_si_iniciada($url_original);
		$this -> texto_original=$this->devolver_variable_si_iniciada($texto_original);
		$this -> checkbox_original=$this->devolver_variable_si_iniciada($checkbox_original);

		if ($this -> titulo ==$this -> titulo_original &&
			$this -> url==$this -> url_original &&
			$this -> texto==$this -> texto_original &&
			$this -> checkbox==$this -> checkbox_original) {
			$this-> cambios_realizadas=false;
		}else{
			$this -> cambios_realizadas=true;
		}
		
		if ($this -> cambios_realizadas) {
			echo 'hay cambios';
			$this->aviso_inicio ="<br><div class='alert alert-danger' role='alert'>";
			$this->aviso_cierre="</div>";

			if ($this -> titulo !==$this -> titulo_original) {
				$this -> error_titulo=$this->validar_titulo($conexion, $this -> titulo);
			}else{
				$this -> error_titulo="";
			}

			if ($this -> url !==$this -> url_original) {
				$this -> error_url=$this->validar_url($conexion, $this -> url);
			}else{
				$this -> error_url="";
			}

			if ($this -> texto !==$this -> texto_original) {
				$this -> error_texto=$this->validar_texto($conexion, $this -> texto);
			}else{
				$this -> error_texto="";
			}
		}else{
			echo 'no hay Cambios';
		}
	}

	private function devolver_variable_si_iniciada($varible){
		if($this->varible_iniciada($varible)){
			return $varible;
		}else{
			return "";
		}
	}

	public function hay_cambios(){
		return $this-> cambios_realizadas;
	}

	public function obtener_titulo_original(){
		return $this-> titulo_original;
	}

	public function obtener_url_original(){
		return $this-> url_original;
	}

	public function obtener_texto_original(){
		return $this-> texto_original;
	}

	public function obtener_checkbox_original(){
		return $this-> checkbox_original;
	}

	public function obtener_checkbox(){
		return $this-> checkbox;
	}
}
?>