<?php 
class repositorio_recuperacion_clave{
	
	public static function generar_peticion($conexion, $id_usuario, $url_secreta){
		$peticion_generada=false;
		if (isset($conexion)) {
			try {
				$sql = "INSERT INTO recuperacion_clave (usuario_id, url_secreta, fecha) VALUES (:usuario_id, :url_secreta, NOW())";
				$sentencia=$conexion->prepare($sql);
				$sentencia->bindParam(':usuario_id', $id_usuario, PDO::PARAM_STR);
				$sentencia->bindParam(':url_secreta', $url_secreta, PDO::PARAM_STR);

				$peticion_generada=$sentencia->execute();
			} catch (PDOException $ex) {
				print 'ERROR' . $ex -> getMessage();
			}
		}
		return $peticion_generada;
	}

	public static function url_secreta_exite($conexion, $url_secreta){
			$url_exite=false;
		if(isset($conexion)){
			try{
				$sql="SELECT * from recuperacion_clave WHERE url_secreta=:url_secreta";
				$sentencia=$conexion->prepare($sql);
				$sentencia->bindParam(":url_secreta", $url_secreta, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado=$sentencia->fetchALL();
				if(count($resultado)){
					$url_exite=true;
				}else{
					$url_exite=false;
				}
			}catch (PDOException $e) {
				print "Error".$ex->getMessage();
			}
		}
		return $url_exite;
	}

	public static function obtener_id_mediate_url_secreta($conexion, $url_secreta){
			$url_exite=null;
		if(isset($conexion)){
			try{
				$sql="SELECT * from recuperacion_clave WHERE url_secreta=:url_secreta";
				$sentencia=$conexion->prepare($sql);
				$sentencia->bindParam(":url_secreta", $url_secreta, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado=$sentencia->fetch();

				if (!empty($resultado)) {
					$url_exite=$resultado['usuario_id'];
				}else{
					$url_exite=null;
				}
				
			}catch (PDOException $e) {
				print "Error".$ex->getMessage();
			}
		}
		return $url_exite;
	}
}
?>