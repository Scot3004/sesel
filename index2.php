<?php

session_start();

require_once "principal.php";

try {
	if(isset($_GET['usuarios'])){
		$c = new ControladorUsuario();
	} else if(isset($_GET['lista'])){
		$c = new ControladorListado();
	} else if(isset($_GET['software'])){
		$c = new ControladorSoftware();
	} else if(isset($_GET['asignatura'])){
		$c = new ControladorAsignatura();
	} else if(isset($_GET['docente'])){
		$c = new ControladorDocente();
	} else if(isset($_GET['grupo'])){
                $c = new ControladorGrupo();
	}  else if(empty($_GET)){
		$c = new HomeController();
	} else {
            throw new Exception('Error en la Pagina!');
        }
	$c->handleRequest();
}
catch(Exception $e) {
	$urlmensaje=$_GET['error'];
	if($urlmensaje=='404')
		$urlmensaje="404: Pagina no encontrada";
	if($urlmensaje=='403')
		$urlmensaje="403: Acceso no autorizado";
	if($urlmensaje=='1062')
		$urlmensaje="1062: Dato ya existe";
	render('error',array('message'=>$e->getMessage(), 'urlmessage'=>$urlmensaje));
}

?>