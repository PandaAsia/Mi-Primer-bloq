<?php

include_once "respositorio_usuario.inc.php";

 class registro_validacion{

 	private $aviso_inicio;
 	private $aviso_cierre;

 	private $nombre;
 	private $email;
 	private $clave;

 	private $error_nombre;
 	private $error_email;
 	private $error_clave1;
 	private $error_clave2;


 	public function __construct($nombre, $email, $clave1,$clave2, $conexion){
 		$this-> aviso_inicio="<br><div class='alert alert-danger' role='alert'>";
 		$this-> aviso_cierre="</div>";

 		$this-> nombre="";
 		$this-> email="";
 		$this-> clave="";

 		$this-> error_nombre=$this->validar_nombre($conexion, $nombre);
 		$this-> error_email=$this->validar_email($conexion, $email);
 		$this-> error_clave1=$this->validar_clave1($clave1);
 		$this-> error_clave2=$this->validar_clave2($clave1,$clave2);

 		if($this->error_clave1 ==="" && $this->error_clave2 ===""){
 			$this->clave=$clave1;
 		}
 	}

 	private function varible_iniciada($variable){
 		if(isset($variable) && !empty($variable)){
 			return true;
 		}else{
 			return false;
 		}
 	}
 	private function validar_nombre($conexion, $nombre){
 		if(!$this->varible_iniciada($nombre)){
 			return "Debes escribir un nombre de usuarios.";
 		}else{
 			$this->nombre=$nombre;
 		}
 		if (strlen($nombre) < 4) {
 			return "El nombre debe ser más largo que 4 caracteres";
 		}
 		if (strlen($nombre)>20) {
 			return "El nombre no puede ocupar más de 20caracteres";
 		}
 		if(Repositorio_Usuario:: nombre_exite($conexion, $nombre)){
 			return "Este Nombre de usuario ya está en uso, Por favor, prueba con otro nombre.";
 		}
 		return "";
 	}

 	private function validar_email($conexion, $email){
 		if(!$this->varible_iniciada($email)){
 			return "Debes porporcionar un email";
 		}else{
 			$this->email=$email;
 		}
 		if(Repositorio_Usuario:: email_exite($conexion, $email)){
 			return "Este email  ya está en uso, Por favor, prueba con otro email.  <a href='#'>Intente recuperar tu Contraseña</a>";
 		}
 		return "";
 	}

 	private function validar_clave1($clave1){
 		if(!$this->varible_iniciada($clave1)){
 			return "Debes porporcionar un password";
 		}
 		return "";
 	}

 	private function validar_clave2($clave1,$clave2){
 		if(!$this->varible_iniciada($clave1)){
 			return "Primero debes rellenar la contraseña";
 		}
 		if(!$this->varible_iniciada($clave2)){
 			return "Debes repitir otra vez la contraseña";
 		}
 		if($clave1!==$clave2){
 			return "Ambas password deben coincidir";
 		}
 		return "";
 	}

 	public function obtener_nombre(){
 		return  $this-> nombre;
 	}
 	public function obtener_email(){
 		return  $this-> email;
 	}
 	public function obtener_clave(){
 		return $this-> clave;
 	}
 	public function obtener_error_nombre(){
 		return  $this-> error_nombre;
 	}
 	public function obtener_error_email(){
 		return  $this-> error_email;
 	}
 	public function obtener_error_clave1(){
 		return  $this-> error_clave1;
 	}
 	public function obtener_error_clave2(){
 		return  $this-> error_clave2;
 	}

 	public function mostrar_nombre(){
 		if($this-> nombre !== ""){
 				echo 'value="'.$this-> nombre.'"';
 		}
 	}

 	public function mostar_error_nombre(){
 		if($this-> error_nombre){
 			echo $this-> aviso_inicio.$this-> error_nombre.$this-> aviso_cierre;
 		}
 	}

 	public function mostrar_email(){
 		if($this-> email !== ""){
 				echo 'value="'.$this->email.'"';
 		}
 	}

 	public function mostar_error_email(){
 		if($this-> error_email!== ""){
 			echo $this->aviso_inicio.$this->error_email.$this->aviso_cierre;
 		}
 	}

 	public function mostar_error_clave1(){
 		if($this-> error_clave1!== ""){
 			echo $this->aviso_inicio.$this->error_clave1.$this->aviso_cierre;
 		}
 	}
 	public function mostar_error_clave2(){
 		if($this-> error_clave2!== ""){
 			echo $this->aviso_inicio.$this->error_clave2.$this->aviso_cierre;
 		}
 	}

 	public function registro_valido(){
 		if($this-> error_nombre==="" &&
 			$this-> error_email==="" &&
 			$this-> error_clave1==="" &&
 			$this-> error_clave2===""){
 			return true;
 		}else{
 			return false;
 		}
 	}

 }