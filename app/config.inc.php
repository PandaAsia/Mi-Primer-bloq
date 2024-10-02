<?php
//$NOMBRE_SERVIDOR='localhost';
//$NOMBRE_USUARIO='root';
//$PASSWORD='';
//$NOMBRE_BD= 'anime';


//info de la basedatos
define('NOMBRE_SERVICIO', 'localhost');
define('NOMBRE_USUARIO', 'root');
define('PASSWORD', '');
define('NOMBRE_BD', 'anime');

//Rutas de la red
define('SERVIDOR', 'http://localhost/anime');
define('RUTA_REGISTRO', SERVIDOR.'/registro');
define('RUTA_REGISTRO_CORRECTO', SERVIDOR.'/registro_correcto');
define('RUTA_LOGIN', SERVIDOR.'/login');
define('RUTA_ENTRADA', SERVIDOR.'/entrada');
define("RUTA_LOGOUT", SERVIDOR."/logout");
define("RUTA_GESTOR", SERVIDOR."/gestor");
define("RUTA_GESTOR_ENTRADAS", RUTA_GESTOR."/entradas");
define("RUTA_GESTOR_COMENTARIOS", RUTA_GESTOR."/comentarios");
define("RUTA_GESTOR_FAVORITOS", RUTA_GESTOR."/favoritos");
define('RUTA_NUEVA_ENTRADA', SERVIDOR.'/nueva_entrada');
define('RUTA_BORRA_ENTRADA', SERVIDOR.'/borrar_entradas');
define("RUTA_EDITAR_ENTRADA", SERVIDOR."/editar_entrada");
define("RUTA_RECUPERAR_CLAVE", SERVIDOR."/recuperar_clave");
define("RUTA_GENERAR_URL_SECRETA", SERVIDOR."/generar_url_secreta");
define("RUTA_PRUEBA_MAIL", SERVIDOR."/mail");
define("RUTA_RECUPERACION_CLAVE", SERVIDOR."/recuperacion_clave");
define("RUTA_BUSCAR", SERVIDOR."/buscar");
define("RUTA_PERFIL", SERVIDOR."/perfil");

//recursos
define('RUTA_CSS', SERVIDOR.'/css/');
define('RUTA_JS', SERVIDOR.'/js/');

define("DIRECTORIO_RAIZ", realpath(__DIR__."/.."));
?>