<?php 

class recuperacion_clave{
	private $id;
	private $usuario_url;
	private $url_secreta;
	private $fecha;

	public function __construct($id, $usuario_url, $url_secreta, $fecha){
		$this -> id = $id;
		$this -> usuario_url = $usuario_url;
		$this -> url_secreta = $url_secreta;
		$this -> fecha = $fecha;
	}
}

?>