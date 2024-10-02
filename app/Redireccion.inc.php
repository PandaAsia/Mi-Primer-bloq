<?php
class Redireccion{
	public function redirigir($url){
		header('Location: ' . $url, true, 301);
		exit();
	}
}