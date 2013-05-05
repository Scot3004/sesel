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
                    'mensaje'	=> 'Bienvenido <br/> 
                        Has ingresado un usuario o contrase&ntilde;a no valido'
                        .$logged
            ));
        }
    }

    public function salir(){
        // Inicializar la sesión.
        // Si está usando session_name("algo"), ¡no lo olvide ahora!
        session_start();
        unset($_SESSION["tipo"]);
        unset($_SESSION["nick"]);
        // Destruir todas las variables de sesión.
        $_SESSION = array();

        // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
        // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión.
        session_destroy();
        session_unset();
        echo "Cerrando sesion...";
        echo '<meta http-equiv="Refresh" content="1;url=./">';
    }

    public function handleRequest(){
        if($_POST["nombre"]){
            $this->registrar();
            return;
        } else if($_POST["nick"]){
            $this->login();
            return;
        } else if($_GET["usuarios"]=="salir"){
            $this->salir();
            return;
        } else if($_REQUEST["usuarios"]=="registro"){
            $this->generarFormRegistro();
        }else if($_GET["usuarios"]=="buscar"){
            render('usuarios', array(                    
                'title'     => 'Lista de Usuarios',		
                'usuarios'  => Usuario::buscar(),
                'mensaje'   => 'Bienvenido'
            ));
        }else{
            render('login',array(
                'title'		=> 'Inicio de Sesi&oacute;n',
                'redir'		=> $_REQUEST["usuarios"],
                'mensaje'	=> 'Bienvenido, Por favor ingrese su usuario y clave'
            ));
            return;
        }		
    }
    public function generarFormRegistro(){
        //aca se valida que solo el admin ingrese
        if(isset($_SESSION['tipo'])){
            if($_SESSION['tipo']=="Administrador"){
                $usuario= new Usuario();
                if($_REQUEST["id"]){
                    //la consulta para cargar los datos del usuario
                    //$usuario=

                }
                render('registro', array(
                    'title'     => 'Registro de Usuarios',
                    'mensaje'   => 'Bienvenido',
                    'admin'     => $_SESSION["tipo"],
                    'usuario'   => $usuario
                ));	
                return;
            }
        }else{
            render('login',array(
                'title'	=> 'Inicio de Sesi&oacute;n',
                'redir'	=> 'usuarios=registro',
                'mensaje'	=> 'Bienvenido, Este es un espacio para usuarios registrados'
            ));
            return;
        }
    }
}

