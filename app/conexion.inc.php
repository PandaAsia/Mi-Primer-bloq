<?php

class  conexion{
	
	private static $conexion;

	public static function abrir_conexion(){
		if(!isset(self::$conexion)){
			try{
				include_once 'config.inc.php';
				self::$conexion=new PDO('mysql:host='.NOMBRE_SERVICIO.'; dbname='.NOMBRE_BD, NOMBRE_USUARIO, PASSWORD);
				self::$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion -> exec("SET CHARACTER SET utf8");

			}catch(PDOException $ex){
				print "ERROR: ". $ex->getMessage() . "<br>";
				die();
			}
		}
	}

	public static function cerrar_conexion(){
		if(isset(self::$conexion)){
			self::$conexion=null;
		}
	}

	public static function obtener_conexion(){
		return self::$conexion;
	}

}