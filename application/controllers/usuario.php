<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('mobile');
        $this->load->model('mUsuario');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    function render($view, $params = array()) {
        /* $this->mobile->header('Bienvenido a Sesel', 'b')->button('welcome/help', 'Help', 'info');
        $this->mobile->navbar(array(
            'usuario' => array('text' => 'Home', 'icon' => 'home'),
            'admin' => array('text' => 'Admin', 'icon' => 'gear')
                ), 'b');
        $this->mobile->footer('Sesel Es Software Educativo Libre', 'b'); */
        //$this->mobile->view($view, $params);
        $this->load->view($view, $params);
    }

    function index() {
        $this->render('login');
    }

    public function login() {
        $tipo=null;
        $this->form_validation->set_rules('nick', 'Usuario', 'required|min_lenght[5]|max_lenght[20]');
        $this->form_validation->set_rules('clave', 'Clave', 'required');
        if ($this->form_validation->run() == FALSE) { //si no supera las reglas de validación se recarga la vista del formulario
            $this->load->view('login');
        } else {
            $tipo = $this->mUsuario->login(array('nick' => $_POST['nick'],'clave' => sha1($_POST['clave']))); //pasamos los valores al modelo para que compruebe si existe el usuario con ese password

            if ($tipo!=null) {
                // si existe el usuario, registramos las variables de sesión y abrimos la página de exito

                $sesion_data = array(
                    'nick' => $_POST['nick'],
                    'tipo' => $tipo
                );
                $this->session->set_userdata($sesion_data);

                $data['nick'] = $this->session->userdata['nick'];
                $data['tipo'] = $this->session->userdata['tipo'];

                $this->load->view('login_success', $data);
            } else {
                // si es erroneo, devolvemos un mensaje de error
                $this->load->view('error', array('mensaje'=>'no se pudo iniciar sesión', 'urlmensaje'=>'el usuario o clave no es valido'));
            }
        }
        return $tipo;
    }

    public function salir() {
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
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión.
        session_destroy();
        session_unset();
        echo "Cerrando sesion...";
        echo '<meta http-equiv="Refresh" content="1;url=./">';
    }

    public function registro() {
        //aca se valida que solo el admin ingrese
        if (isset($_SESSION['tipo'])) {
            if ($_SESSION['tipo'] == "Administrador") {
                $usuario = new Usuario();
                if ($_REQUEST["id"]) {
                    //la consulta para cargar los datos del usuario
                    //$usuario=
                }
                $this->render('registro', array(
                    'title' => 'Registro de Usuarios',
                    'mensaje' => 'Bienvenido',
                    'admin' => $_SESSION["tipo"],
                    'usuario' => $usuario
                ));
                return;
            }
        } else {
            $this->render('login', array(
                'title' => 'Inicio de Sesi&oacute;n',
                'redir' => 'usuarios=registro',
                'mensaje' => 'Bienvenido, Este es un espacio para usuarios registrados'
            ));
            return;
        }
    }

}

