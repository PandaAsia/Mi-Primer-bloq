<?php 
include_once 'app/config.inc.php';
include_once 'app/control_sesion.inc.php';
include_once 'app/Redireccion.inc.php';

control_sesion:: cerrar_sesion();
Redireccion:: redirigir(SERVIDOR);
?>