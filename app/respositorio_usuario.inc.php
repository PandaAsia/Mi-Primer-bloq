<?php
include_once 'app/Usuario.inc.php';

class Repositorio_Usuario{
	public static function obtener_todos($conexion){
		$usuarios = array();

		if(isset($conexion)){
				try {
					include_once 'Usuario.inc.php';
					$sql="SELECT * from usuario";
					$sentencia=$conexion->prepare($sql);
					$sentencia -> execute();
					$resultado=$sentencia->fetchALL();
					if(count($resultado)){
						foreach ($resultado as $fila) {
							$usuarios[]=new Usuario(
								$fila['id'], $fila['nombre'], $fila['email'], $fila['password'],$fila['fecha_registro'], $fila['activo']
							);

						}
					}else{
						print("No hay usuarios");
					}
					
				} catch (PDOException $e) {
					print "Error: ".$ex->getMessage();
				}
		}
		return $usuarios;
	}

	public static function obtener_numeros_usuarios($conexion) {
		$total_usuarios=null;
		if(isset($conexion)){
			try {
				$sql="SELECT COUNT(*) as total FROM usuario";
				$sentencia=$conexion->prepare($sql);
				$sentencia->execute();
				$resultado=$sentencia->fetch();

				$total_usuarios=$resultado['total'];
			} catch (PDOException $e) {
				print "Error: ".$ex->getMessage();
			}

		}
		return $total_usuarios;
	}

	public static function insertar_usuario($conexion, $usuario){
		$usuario_insertado=false;
		if (isset($conexion)) {
			try {
				$sql="INSERT INTO usuario(nombre, email, password, fecha_registro, activo) VALUES(:nombre, :email, :password, NOW(), 0)";
				$nom_item=$usuario -> obtener_nombre();
				$emaol_item=$usuario -> obtener_email();
				$pass_item=$usuario -> obtener_password();

				$sentencia=$conexion->prepare($sql);
				$sentencia -> bindParam(':nombre', $nom_item, PDO::PARAM_STR);
                $sentencia -> bindParam(':email', $emaol_item, PDO::PARAM_STR);
                $sentencia -> bindParam(':password', $pass_item, PDO::PARAM_STR);
				$usuario_insertado = $sentencia -> execute();
			} catch (PDOException $e) {
				print "Error".$ex->getMessage();
			}
		}
		return $usuario_insertado;
	}

	public static function nombre_exite($conexion, $nombre){
		$nombre_exite=true;
		if(isset($conexion)){
			try{
				$sql="SELECT * from usuario WHERE nombre=:nombre";
				$sentencia=$conexion->prepare($sql);
				$sentencia->bindParam(":nombre", $nombre, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado=$sentencia->fetchALL();
				if(count($resultado)){
					$nombre_exite=true;
				}else{
					$nombre_exite=false;
				}
			}catch (PDOException $e) {
				print "Error".$ex->getMessage();
			}
		}
		return $nombre_exite;
	} 

	public static function email_exite($conexion, $email){
		$email_exite=true;
		if(isset($conexion)){
			try{
				$sql="SELECT * from usuario WHERE email=:email";
				$sentencia=$conexion->prepare($sql);
				$sentencia->bindParam(":email", $email, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado=$sentencia->fetchALL();
				if(count($resultado)){
					$email_exite=true;
				}else{
					$email_exite=false;
				}
			}catch (PDOException $e) {
				print "Error".$ex->getMessage();
			}
		}
		return $email_exite;
	} 
	
	public static function obtener_usuario_por_email($conexion, $email){
		$usuario = null;
		if(isset($conexion)){
			try {
				include_once 'Usuario.inc.php';

				$sql="SELECT * FROM usuario WHERE email=:email";
				$sentencia=$conexion->prepare($sql);
				$sentencia->bindParam(":email", $email, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado=$sentencia-> fetch();
				if(!empty($resultado)){
					$usuario= new Usuario($resultado['id'], $resultado['nombre'], $resultado['email'], $resultado['password'],$resultado['fecha_registro'], $resultado['activo']);
				}
			} catch (PDOException $e) {
				print "Error".$ex->getMessage();
			}
		}
		return $usuario;
	}

	public static function obtener_usuario_por_id($conexion, $id){
		$usuario = null;
		if(isset($conexion)){
			try {
				include_once 'Usuario.inc.php';

				$sql="SELECT * FROM usuario WHERE id=:id";
				$sentencia=$conexion->prepare($sql);
				$sentencia->bindParam(":id", $id, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado=$sentencia-> fetch();
				if(!empty($resultado)){
					$usuario= new Usuario($resultado['id'], $resultado['nombre'], $resultado['email'], $resultado['password'],$resultado['fecha_registro'], $resultado['activo']);
				}
			} catch (PDOException $e) {
				print "Error".$ex->getMessage();
			}
		}
		return $usuario;
	}
	public static function actualizar_password($conexion, $id_usuario, $nueva_clave){
		$actulizacion_correcta = false;
		if (isset($conexion)) {
			try {
				$sql="UPDATE usuario SET  password = :password WHERE id =:id";
				$sentencia = $conexion ->prepare($sql);
				$sentencia->bindParam(":password", $nueva_clave, PDO::PARAM_STR);
				$sentencia->bindParam(":id", $id_usuario, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado=$sentencia->rowCount();
				if (count($resultado)) {
					$actulizacion_correcta=true;
				}else{
					$actulizacion_correcta = false;
				}

			} catch (PDOException $e) {
				print "Error".$ex->getMessage();
			}
		}
		return $actulizacion_correcta;
	}
	
}