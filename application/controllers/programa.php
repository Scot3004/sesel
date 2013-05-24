<?php

/**
 * Description of Software
 *
 * @author scot3004
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Programa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mPrograma');
    }

    private function render($view, $params = array(), $titulo = "Software") {
        $this->load->view('mobile', array('view' => $view,
            'titulo' => $titulo,
            'params' => $params));
    }

    public function index() {
        try {
            if ($this->session->userdata('tipo')) {
                $programas = $this->mPrograma->buscar();
                $this->render('software', array('array' => $programas));
            } else {
                redirect('usuario/login', 'refresh');
            }
        } catch (Exception $e) {
            $data['titulo'] = 'Problemas al buscar datos';
            $data['detalle'] = $e->getMessage();
            $this->render('error', $data);
        }
    }

    public function detalle($id=null) {
        $programa = $this->mPrograma->buscarPrograma(array('idSoftware' => $id));
        $this->render('detallesoftware', array('software' => $programa));
    }
    public function asignatura($id=NULL){
        if(isset($id))
        $programa = $this->mPrograma->buscarAsignatura(array('a.nombre' => $id));
        else 
            $programa = $this->mPrograma->buscarAsignatura();
        print_r($programa);
//$this->render('software', array('array' => $programa));
    }

}

?>
