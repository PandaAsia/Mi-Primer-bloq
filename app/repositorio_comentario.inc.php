<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/comentario.inc.php';

class repositorio_comentario{
	public static function insertar_comentario($conexion, $comentario){
		$comentario_insertado=false;
		if (isset($conexion)) {
			try {
				$sql="INSERT INTO comentarios(autor_id, entrada_id, titulo, texto, fecha) VALUES(:autor_id,:entrada_id, :titulo, :texto, NOW())";

				$nom_item=$comentario -> obtener_autor_id();
				$autor_item=$comentario->obtener_entrada_id();
				$emaol_item=$comentario -> obtener_titulo();
				$pass_item=$comentario-> obtener_texto();

				$sentencia=$conexion->prepare($sql);
				$sentencia -> bindParam(':autor_id', $nom_item, PDO::PARAM_STR);
				$sentencia -> bindParam(':entrada_id', $autor_item, PDO::PARAM_STR);
                $sentencia -> bindParam(':titulo', $emaol_item, PDO::PARAM_STR);
                $sentencia -> bindParam(':texto', $pass_item, PDO::PARAM_STR);
				$comentario_insertado = $sentencia -> execute();
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $comentario_insertado;
	}

	public static function obtener_comentario($conexion, $entrada_id){
		$comentarios=array();
		if (isset($conexion)) {
			try {
				include_once 'comentario.inc.php';
				$sql='SELECT * FROM comentarios WHERE entrada_id =:entrada_id';
				$sentencia=$conexion->prepare($sql);
				$sentencia->bindParam(':entrada_id',$entrada_id, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado=$sentencia->fetchALL();

				if (count($resultado)) {
					foreach ($resultado as $fila) {
						$comentarios[]=new comentario(
							$fila['id'],$fila['autor_id'],$fila['entrada_id'],$fila['titulo'],$fila['texto'],$fila['fecha']
						);
					}
				}
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $comentarios;
	}

	public static function contar_comentarios_usuario($conexion, $id_usuario){
		$total_comentarios='';
		if (isset($conexion)) {
			try {
				$sql='SELECT COUNT(*) as total_comentario FROM comentarios WHERE autor_id=:autor_id';
				$sentencia = $conexion->prepare($sql);
				$sentencia ->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado=$sentencia->fetch();
				if (!empty($resultado)) {
					$total_comentarios =$resultado['total_comentario'];
				}
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $total_comentarios;
	}
}