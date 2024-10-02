<?php 
include_once 'app/respositorio_usuario.inc.php';

class validador_login{

	private $usuario;
	private $error;

	public function __construct($email, $clave, $conexion){
		$this-> error = "";

		if (!$this -> varible_iniciada($email) || !$this -> varible_iniciada($clave)) {
			$this-> usuario=null;
			$this-> error="Debes Introducir tu email y contraseña";
		}else{
			$this-> usuario=Repositorio_Usuario:: obtener_usuario_por_email($conexion, $email);
			if(is_null($this->usuario) || !password_verify($clave, $this-> usuario->obtener_password())){
				$this->error="Datos incorrectos";
			}
		}
	}

	private function varible_iniciada($variable){
 		if(isset($variable) && !empty($variable)){
 			return true;
 		}else{
 			return false;
 		}
 	}

 	public function obtener_usuario(){
 		return $this->usuario;
 	}

 	public function obtener_error(){
 		return $this->error;
 	}

 	public  function mostrar_error(){
 		if ($this->error!=='') {
 			echo "<br> <div class 'alert alert-danger' role='alert'>";
 			echo $this->error;
 			echo "</div><br>";
 		}
 	}
}