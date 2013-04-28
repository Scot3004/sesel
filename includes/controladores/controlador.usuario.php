<?php

class ControladorUsuario{
	public static function registrar() {
		if($_POST["clave"]==$_POST["rclave"]) {
			if(!empty($_POST)) {
				Usuario::registrar(array(
					":doc" => $_POST["doc"],
					":nombre" => $_POST["nombre"], 
					":apellido" => $_POST["apellido"],  
					":direccion" => $_POST["direccion"], 					
					":telefono" => $_POST["telefono"], 
					":email" => $_POST["email"], 
					":genero" => $_POST["genero"], 
					":fnacimiento" => $_POST["fnacimiento"], 
					":nick" => $_POST["nick"], 
					":clave" => $_POST["clave"]));
				}
			header("Location:./");
		} else { 
			echo "No coinciden las claves";
		}
	}
	
	public function login(){          
		$logged=Usuario::login(array(
			'nick'		=> $_POST['nick'],
			'clave'		=> $_POST['clave']
		));                
		if($logged){
			$_SESSION['nick']=$_POST['nick'];
                        $_SESSION['tipo']=$logged; 
                        echo '<meta http-equiv="Refresh" content="1;url=?'.$_REQUEST["usuarios"].'">';
		}else{
			render('login',array(
				'title'		=> 'Inicio de Sesi&oacute;n',
				'redir'		=> $_REQUEST["usuarios"],
				'mensaje'	=> 'Bienvenido <br/> Has ingresado un usuario o contrase&ntilde;a no valido'.$logged
			));
		}
	}
	
	public function handleRequest(){
		/*if($_GET["usuarios"]=="buscar"){
			render('home', array(
				'title'		=> 'Registro de Usuarios',
				'redir'		=> $_GET["usuarios"],
				'mensaje'	=> 'Bienvenido'
			));
		} else */if($_POST["nombre"]){
			$this->registrar();
			return;
		} else if($_POST["nick"]){
			$this->login();
			return;
		} else if($_GET["usuarios"]=="registro"){
			//aca se valida que solo el admin ingrese
			if($_SESSION['tipo']=="Administrador"){
                            render('registro', array(
                                    'title'	=> 'Registro de Usuarios',
                                    'mensaje'	=> 'Bienvenido'
                            ));	
                            return;	
                        }else{
                            render('login',array(
                                    'title'	=> 'Inicio de Sesi&oacute;n',
                                    'redir'	=> 'usuarios=registro',
                                    'mensaje'	=> 'Bienvenido, Solo el administrador está autorizado a registrar usuarios'
                            ));
                            return;
                        }
		}else{
                    render('login',array(
                            'title'		=> 'Inicio de Sesi&oacute;n',
                            'redir'		=> $_REQUEST["usuarios"],
                            'mensaje'	=> 'Bienvenido, Por favor ingrese su usuario y clave'
                    ));
                }
		
	}
}

?>
