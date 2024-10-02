<?php 

//sesion_star();
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entradas.inc.php';
include_once 'app/comentario.inc.php';

include_once 'app/respositorio_usuario.inc.php';
include_once 'app/repositorio_entradas.inc.php';
include_once 'app/repositorio_comentario.inc.php';

$componentes_url=parse_url($_SERVER['REQUEST_URI']); //$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']

$ruta = $componentes_url['path'];

$parte_ruta = explode('/', $ruta);
$parte_ruta=array_filter($parte_ruta);
$parte_ruta=array_slice($parte_ruta, 0);

$ruta_eligida = 'Vistas/404.php';

if ($parte_ruta[0]=='anime') {
	if (count($parte_ruta)==1) {
		$ruta_eligida="Vistas/home.php";
	}elseif (count($parte_ruta)==2) {
		switch ($parte_ruta[1]) {
			case 'login':
				$ruta_eligida='Vistas/login.php';
				break;
			case 'logout':
					$ruta_eligida='Vistas/logout.php';
					break;
			case 'registro':
				$ruta_eligida='Vistas/registro.php';
				break;
			case 'relleno_dov':
				$ruta_eligida='Script/scrip-relleno.php';
				break;
			case 'logout':
                $ruta_elegida = 'Vistas/logout.php';
                break;
            case 'gestor':
				$ruta_eligida='Vistas/gestor.php';
				$gestor_actual='';
				break;
			case 'nueva_entrada':
				$ruta_eligida='Vistas/nueva_entrada.php';
				break;
			case 'borrar_entradas':
				$ruta_eligida='Script/borrar_entradas.php';
				break;
			case 'editar_entrada':
				$ruta_eligida='Vistas/editar_entrada.php';
				break;
			case 'recuperar_clave':
				$ruta_eligida='Vistas/recuperar_clave.php';
				break;
			case 'generar_url_secreta':
				$ruta_eligida='Script/generar_url_secreta.php';
				break;
			case 'mail':
				$ruta_eligida='Vistas/prueba_mail.php';
				break;
			case 'buscar':
				$ruta_eligida='Vistas/buscar.php';
				break;
			case 'perfil':
				$ruta_eligida='Vistas/perfil.php';
				break;

		}
	}elseif (count($parte_ruta)==3) {
		if ($parte_ruta[1]=='registro_correcto') {
			$nombre=$parte_ruta[2]; 
			$ruta_eligida='Vistas/registro_correcto.php';
		}
		if ($parte_ruta[1]=='entrada') {
			$url=$parte_ruta[2];
			conexion::abrir_conexion();
			$entrada=repositorio_entradas :: obtener_entrada_por_url(conexion::obtener_conexion(), $url);
			if ($entrada !=null) {
				$autor=Repositorio_Usuario :: obtener_usuario_por_id(conexion::obtener_conexion(),
						$entrada->obtener_autor_id());
				$comentario=repositorio_comentario::obtener_comentario(conexion::obtener_conexion(), $entrada->obtener_id());

				$entradas_alzar=repositorio_entradas::obtener_entradas_alazar(conexion::obtener_conexion(), 3);

				$ruta_eligida='Vistas/entrada.php';
			}
		}
		if ($parte_ruta[1]=='gestor') {
			switch ($parte_ruta[2]) {
				case 'entradas':
					$gestor_actual='entradas';
					$ruta_eligida='Vistas/gestor.php';
					break;
				case 'comentarios':
					$gestor_actual='comentarios';
					$ruta_eligida='Vistas/gestor.php';
					break;
				case 'favoritos':
					$gestor_actual='favoritos';
					$ruta_eligida='Vistas/gestor.php';
					break;
			}
		}
		if ($parte_ruta[1]=='recuperacion_clave') {
			$url_personal=$parte_ruta[2];
			$ruta_eligida = 'Vistas/recuperacion_clave.php';
		}
	}
}

include_once $ruta_eligida;
