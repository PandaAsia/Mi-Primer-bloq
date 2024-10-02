<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<?php 
		if(!isset($titulo) || empty($titulo)){
			$titulo='PandaAsia';
		}
			
		echo "<title>$titulo</title>"?>
		
		
	
		<!--<title><?php echo $titulo?></title>-->

		<link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>estilos.css">

	</head>
	<body>