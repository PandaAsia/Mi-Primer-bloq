<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/Entradas.inc.php';

class repositorio_entradas{
	public static function insertar_entradas($conexion, $Entradas){
		$entrada_insertado=false;
		if (isset($conexion)) {
			try {
				$sql="INSERT INTO entradas(autor_id,url,titulo, texto, fecha, activa) VALUES(:autor_id, :url, :titulo, :texto, NOW(), :activa)";

				$activa = 0;

                if ($Entradas -> esta_activa()) {
                	$activa = 1;
                }

				$nom_item=$Entradas -> obtener_autor_id();
				$url_item=$Entradas -> obtener_url();
				$emaol_item=$Entradas -> obtener_titulo();
				$pass_item=$Entradas -> obtener_texto();

				$sentencia=$conexion->prepare($sql);
				$sentencia -> bindParam(':autor_id', $nom_item, PDO::PARAM_STR);
				$sentencia ->bindParam(':url', $url_item, PDO::PARAM_STR);
                $sentencia -> bindParam(':titulo', $emaol_item, PDO::PARAM_STR);
                $sentencia -> bindParam(':texto', $pass_item, PDO::PARAM_STR);
                $sentencia -> bindParam(':activa', $activa, PDO::PARAM_STR);

				$entrada_insertado = $sentencia -> execute();
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $entrada_insertado;
	}

	public static function obtener_todo_fecha_descendiente($conexion){
		$entradas=[];
		if (isset($conexion)) {
			try {
				$sql='SELECT * FROM entradas ORDER BY fecha DESC LIMIT 7';
				$sentencia=$conexion->prepare($sql);
				$sentencia -> execute();
				$resultado=$sentencia->fetchALL();
				if(count($resultado)){
					foreach ($resultado as $fila) {
						$entradas[]=new Entradas($fila['id'],$fila['autor_id'], $fila['url'], $fila['titulo'],$fila['texto'], $fila['fecha'], $fila['activa']);

						}
					}

			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $entradas;
	}

	public static function obtener_entrada_por_url($conexion, $url){
		$entrada=null;
		if (isset($conexion)) {
			try {
				$sql='SELECT * FROM entradas WHERE url LIKE :url';
				$sentencia = $conexion->prepare($sql);
				$sentencia ->bindParam(':url', $url, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado=$sentencia->fetch();
				if (!empty($resultado)) {
					$entrada=new Entradas(
						$resultado['id'], $resultado['autor_id'], $resultado['url'], $resultado['titulo'], $resultado['texto'], $resultado['fecha'], $resultado['activa']);
				}
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $entrada;
	}

	public static function obtener_entrada_por_id($conexion, $id){
		$entrada=null;
		if (isset($conexion)) {
			try {
				$sql='SELECT * FROM entradas WHERE id=:id';
				$sentencia = $conexion->prepare($sql);
				$sentencia ->bindParam(':id', $id, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado=$sentencia->fetch();
				if (!empty($resultado)) {
					$entrada=new Entradas(
						$resultado['id'], $resultado['autor_id'], $resultado['url'], $resultado['titulo'], $resultado['texto'], $resultado['fecha'], $resultado['activa']);
				}
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $entrada;
	}

	public static function obtener_entradas_alazar($conexion, $limite){
		$entrada=[];
		if (isset($conexion)) {
			try {
				$sql="SELECT * FROM entradas ORDER BY RAND() LIMIT $limite";
				$sentencia=$conexion->prepare($sql);
				$sentencia ->execute();
				$resultado=$sentencia->fetchALL();
				if(count($resultado)){
					foreach ($resultado as $fila) {
						$entrada[]=new Entradas($fila['id'],$fila['autor_id'], $fila['url'], $fila['titulo'],$fila['texto'], $fila['fecha'], $fila['activa']);
					}
				}
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}

		}
		return $entrada;
	}

	public static function contar_entradas_activas_usuario($conexion, $id_usuario){
		$total_entradas='';
		if (isset($conexion)) {
			try {
				$sql='SELECT COUNT(*) as total_entrada FROM entradas WHERE autor_id=:autor_id AND activa=1';
				$sentencia = $conexion->prepare($sql);
				$sentencia ->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado=$sentencia->fetch();
				if (!empty($resultado)) {
					$total_entradas =$resultado['total_entrada'];
				}
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $total_entradas;
	}

	public static function contar_entradas_inactivas_usuario($conexion, $id_usuario){
		$total_entradas='';
		if (isset($conexion)) {
			try {
				$sql='SELECT COUNT(*) as total_entrada FROM entradas WHERE autor_id=:autor_id AND activa=0';
				$sentencia = $conexion->prepare($sql);
				$sentencia ->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado=$sentencia->fetch();
				if (!empty($resultado)) {
					$total_entradas =$resultado['total_entrada'];
				}
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $total_entradas;
	}

	public static function obtener_entradas_usuarios_fecha_decendente($conexion, $id_usuario){
		$entradas_obtenidas=[];
		if (isset($conexion)) {
			try {
				$sql="SELECT a.id, a.autor_id, a.url, a.titulo, a.texto, a.fecha, a.activa, COUNT(b.id) AS 'cantidad_comentarios' ";
				$sql.="FROM entradas a ";
				$sql.="LEFT JOIN comentarios b ON a.id=b.entrada_id ";
				$sql.="WHERE a.autor_id=:autor_id ";
				$sql.="GROUP BY a.id ";
				$sql.="ORDER BY a.fecha DESC ";

				$sentencia=$conexion->prepare($sql);
				$sentencia ->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
				$sentencia ->execute();
				$resultado=$sentencia->fetchALL();
				if(count($resultado)){
					foreach ($resultado as $fila) {
						$entradas_obtenidas[]=array(
							new Entradas(
								$fila['id'],$fila['autor_id'], $fila['url'], $fila['titulo'],$fila['texto'], $fila['fecha'], $fila['activa']
							),
							$fila['cantidad_comentarios']
						);
					}
				}
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}

		}
		return $entradas_obtenidas;
	}

	public static function titulo_exite($conexion, $titulo){
		$titulo_existe=true;
		if (isset($conexion)) {
			try {
				$sql="SELECT * FROM entradas WHERE titulo=:titulo";
				$sentencia=$conexion->prepare($sql);
				$sentencia->bindParam(":titulo", $titulo, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado=$sentencia->fetchALL();
				if( count($resultado)){
					$titulo_existe=true;
				}else{
					$titulo_existe=false;
				}

			}catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}

		return $titulo_existe;
	}

	public static function url_exite($conexion, $url){
		$url_exite=true;
		if (isset($conexion)) {
			try {
				$sql="SELECT * FROM entradas WHERE url=:url";
				$sentencia=$conexion->prepare($sql);
				$sentencia->bindParam(":url", $url, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado=$sentencia->fetchALL();
				if( count($resultado)){
					$url_exite=true;
				}else{
					$url_exite=false;
				}

			}catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}

		return $url_exite;
	}

	public static function eliminar_comentarios_y_entradas($conexion, $entrada_id){
		if (isset($conexion)) {
			try {
				$conexion->beginTransaction();

				$sql1="DELETE  FROM comentarios WHERE  entrada_id=:entrada_id";
				$sentencia1=$conexion->prepare($sql1);
				$sentencia1->bindParam(':entrada_id', $entrada_id, PDO::PARAM_STR);
				$sentencia1->execute();

				$sql2="DELETE  FROM entradas WHERE  id=:id";
				$sentencia2=$conexion->prepare($sql2);
				$sentencia2->bindParam(':id', $entrada_id, PDO::PARAM_STR);
				$sentencia2->execute();

				$conexion->commit();
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
				$conexion->rollback();
			}
		}
	}

	public static function actualizar_entrada($conexion, $id, $titulo, $url, $texto, $activa){
		$actualizacion_correcto=false;

		if (isset($conexion)) {
			try {
				$sql="UPDATE entradas SET titulo=:titulo, url=:url, texto=:texto, activa=:activa WHERE id=:id";
				$sentencia =$conexion->prepare($sql);
				$sentencia->bindParam(':titulo', $titulo, PDO::PARAM_STR);
				$sentencia->bindParam(':url', $url, PDO::PARAM_STR);
				$sentencia->bindParam(':texto', $texto, PDO::PARAM_STR);
				$sentencia->bindParam(':activa', $activa, PDO::PARAM_STR);
				$sentencia->bindParam(':id', $id, PDO::PARAM_STR);

				$sentencia->execute();
				$resultado=$sentencia->rowCount();

				if ($resultado) {
					$actualizacion_correcto=true;
				}else{
					$actualizacion_correcto=false;
				}
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $actualizacion_correcto;

	}

	public static function buscar_entradas_todos_campos($conexion, $termino_busqueda, $orden){
		$entradas = [];
		$termino_busqueda = '%'. $termino_busqueda. '%';
		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM entradas WHERE titulo LIKE :busqueda OR texto LIKE :busqueda ORDER BY fecha $orden LIMIT 25";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':busqueda', $termino_busqueda, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado=$sentencia->fetchALL();
				if(count($resultado)){
					foreach ($resultado as $fila) {
						$entradas[]=new Entradas($fila['id'],$fila['autor_id'], $fila['url'], $fila['titulo'],$fila['texto'],
						$fila['fecha'], $fila['activa']);

						}
					}
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $entradas;
	}

	public static function buscar_entradas_titulo($conexion, $termino_busqueda, $orden){
		$entradas = [];
		$termino_busqueda = '%'. $termino_busqueda. '%';
		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM entradas WHERE titulo LIKE :busqueda ORDER BY fecha $orden LIMIT 25";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':busqueda', $termino_busqueda, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado=$sentencia->fetchALL();
				if(count($resultado)){
					foreach ($resultado as $fila) {
						$entradas[]=new Entradas($fila['id'],$fila['autor_id'], $fila['url'], $fila['titulo'],$fila['texto'], $fila['fecha'], $fila['activa']);

						}
					}
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $entradas;
	}

	public static function buscar_entradas_contenido($conexion, $termino_busqueda, $orden){
		$entradas = [];
		$termino_busqueda = '%'. $termino_busqueda. '%';
		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM entradas WHERE texto LIKE :busqueda ORDER BY fecha $orden LIMIT 25";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':busqueda', $termino_busqueda, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado=$sentencia->fetchALL();
				if(count($resultado)){
					foreach ($resultado as $fila) {
						$entradas[]=new Entradas($fila['id'],$fila['autor_id'], $fila['url'], $fila['titulo'],$fila['texto'], $fila['fecha'], $fila['activa']);

						}
					}
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $entradas;
	}

	public static function buscar_entradas_autor($conexion, $termino_busqueda, $orden){
		$entradas = [];
		$autor = '%'. $termino_busqueda. '%';
		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM entradas e JOIN usuario u ON u.id = e.autor_id WHERE u.nombre LIKE :autor ORDER BY e.fecha $orden LIMIT 25";
				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':autor', $autor, PDO::PARAM_STR);
				$sentencia->execute();
				$resultado=$sentencia->fetchALL();
				if(count($resultado)){
					foreach ($resultado as $fila) {
						$entradas[]=new Entradas($fila['id'],$fila['autor_id'], $fila['url'], $fila['titulo'],$fila['texto'], $fila['fecha'], $fila['activa']);

						}
					}
			} catch (PDOException $ex) {
				print "Error".$ex->getMessage();
			}
		}
		return $entradas;
	}

}
