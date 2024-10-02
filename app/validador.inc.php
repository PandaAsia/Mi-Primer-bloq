<?php 

abstract class validador{
	protected $aviso_inicio;
	protected $aviso_cierre;

	protected $titulo;
	protected $url;
	protected $texto;

	protected $error_titulo;
	protected $error_url;
	protected $error_texto;


	function __construct(){

	}

	protected function varible_iniciada($variable){
 		if(isset($variable) && !empty($variable)){
 			return true;
 		}else{
 			return false;
 		}
 	}

 	protected function validar_titulo($conexion, $titulo){
 		if (!$this -> varible_iniciada($titulo)) {
 			return "Debes Escribir un Titulo";
 		}else{
 			$this->titulo=$titulo;
 		}
 		if (strlen($titulo) > 255) {
 			return "el titulo es demasiado grande";
 		}
 		if (repositorio_entradas::titulo_exite($conexion, $titulo)) {
 			return "ya existe este titulo escoger  otro";
 		}
 	}

 	protected function validar_url($conexion, $url){
 		if (!$this->varible_iniciada($url)) {
 			return "debes insertar un url";
 		}else{
 			$this->url=$url;
 		}

 		$url_tratada=str_replace(' ', '', $url);
 		$url_tratada=preg_replace('/\s+/', '', $url_tratada);

 		if (strlen($url)!= strlen($url_tratada)) {
 			return "la url no puede contener espacios vacios";
 		}
 		if (repositorio_entradas::url_exite($conexion, $url)) {
 			return "ya exite esta url escribe otra";
 		}
 	}

 	protected function validar_texto($conexion, $texto){
 	 	if (!$this ->varible_iniciada($texto)) {
 	 		return "el contenido no puede estar vacío";
 	 	}else{
 	 		$this->texto=$texto;
 	 	}
 	}

 	public function obtener_titulo(){
 		return $this->titulo;
 	}

 	public function obtener_url(){
 		return $this->url;
 	}

 	public function obtener_texto(){
 		return $this->texto;
 	}

 	public function mostrar_titulo(){
 		if ($this->titulo!="") {
 			echo 'value="'.$this->titulo.'"';
 		}
 	}

 	public function mostrar_url(){
 		if ($this->url!="") {
 			echo 'value="'.$this->url.'"';
 		}
 	}

 	public function mostrar_texto(){
 		if ($this->texto!="" && strlen(trim($this->texto))>0) {
 			echo $this->texto;
 		}
 	}

 	public function mostrar_error_titulo(){
 		if ($this->error_titulo!="") {
 			echo $this->aviso_inicio.$this->error_titulo.$this->aviso_cierre;
 		}
 	}

 	public function mostrar_error_url(){
 		if ($this->error_url!="") {
 			echo $this->aviso_inicio.$this->error_url.$this->aviso_cierre;
 		}
 	}
 	public function mostrar_error_texto(){
 		if ($this->error_texto!="") {
 			echo $this->aviso_inicio.$this->error_texto.$this->aviso_cierre;
 		}
 	}

 	public function entrada_valida(){
 		if ($this->error_titulo=="" && $this->error_url=="" && $this->error_texto=="") {
 			return true;
 		}else{
 			return false;
 		}
 	}
}
?>