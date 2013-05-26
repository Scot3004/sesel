<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mUsuario');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    private function render($view, $params = array(), $titulo = "Control de Usuarios") {
        $this->load->view('mobile', array('view' => $view,
            'titulo' => $titulo,
            'params' => $params));
    }

    function index() {
        if ($this->session->userdata('tipo')) {
            $data['titulo'] = $this->session->userdata('tipo');
            $data['detalle'] = $this->session->userdata('nick');
            $this->render('error', $data);
        } else {
            $this->render('login');
        }
    }

    public function login() {
        $tipo = null;
        $this->form_validation->set_rules('nick', 'Usuario', 'required'); //|min_lenght[3]|max_lenght[20]');
        $this->form_validation->set_rules('clave', 'Clave', 'required');
        if ($this->form_validation->run() == FALSE) { //si no supera las reglas de validación se recarga la vista del formulario
            $this->render('login');
        } else {
            $tipo = $this->mUsuario->login(array('nick' => $_POST['nick'], 'clave' => sha1($_POST['clave']))); //pasamos los valores al modelo para que compruebe si existe el usuario con ese password

            if ($tipo != null) {
                // si existe el usuario, registramos las variables de sesión y abrimos la página de exito
                $sesion_data = array(
                    'nick' => $_POST['nick'],
                    'tipo' => $tipo
                );
                $this->session->set_userdata($sesion_data);
                $data['titulo'] = $this->session->userdata('tipo');
                $data['detalle'] = $this->session->userdata('nick');
                $this->render('error', $data);
            } else {
                // si es erroneo, devolvemos un mensaje de error
                $this->render('error', array('titulo' => 'no se pudo iniciar sesi&oacute;n', 'detalle' => 'el usuario o clave no es valido'));
            }
        }
        return $tipo;
    }

    public function salir() {
        $this->session->unset_userdata('nick');
        $this->session->unset_userdata('tipo');
        $data['titulo'] = "Cierre de Sesion";
        $data['detalle'] = "Ya has finalizado sesión";
        $this->render('error', $data);
    }

    public function buscar() {
        if ($this->session->userdata('tipo')) {
            try {
                print_r($this->mUsuario->buscar($_POST));
            } catch (Exception $e) {
                $data['titulo'] = 'Problemas al buscar datos';
                $data['detalle'] = $e->getMessage();
                $this->render('error', $data);
            }
        }
    }

    public function registro() {
        //aca se valida que solo el admin ingrese
        if ($this->session->userdata('tipo') === "Administrador") {
            //$usuario = new Usuario();
            if (isset($_POST["identificacion"])) {
                $arr = $_POST;
                if ($arr['clave'] === $arr['rclave']) {
                    unset($arr['rclave']);
                    unset($arr['registrar']);
                    $this->mUsuario->registrar($arr);
                    redirect('main', 'refresh');
                }
            } else {
                $this->render('registro');
            }return;
        } else {
            $this->render('login');
            return;
        }
    }

}

