<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {
    
    function index()
    {
            $this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
    }
    function _example_output($output = null)
    {
            $this->load->view('main.php',$output);	
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
        return $logged;
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

    public function buscar(){
        render('array2table', array(                    
                'title'     => 'Lista de Usuarios',		
                'array'  => Usuario::buscar(),
                'mensaje'   => 'Bienvenido'
            ));
    }
    
    public function registro(){
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

