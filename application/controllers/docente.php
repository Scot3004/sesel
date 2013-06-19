<?php

/**
 * Description of Software
 *
 * @author scot3004
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Docente extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mDocente');
        $this->load->library('grocery_CRUD');
    }
    
      function _example_output($output = null) {
        if ($this->session->userdata('tipo') === "Docente") {
            $this->load->view('admin.php', $output);
        } else {
            redirect('usuario/login', 'refresh');
        }
    }
    
    private function render($view, $params = array(), $titulo = "Software") {
        $this->load->view('mobile', array('view' => $view,
            'titulo' => $titulo,
            'params' => $params));
    }

    public function index() {
        $this->render("menusoftware");
    }
    
    public function perfil($id=null){
        if($id===null){
            $this->render('error', array('titulo'=>'No Docente', 'detalle'=>'No has escogido ningun docente'));
        }else{
            $docente = $this->mDocente->buscar(array('idDocente'=>$id));
            $this->render('objeto', array('titulo'=>$id, 'objeto'=>$docente[0]));
        }
    }
    
    function grupo($id=null){
        if($id===null){
            $this->render('error', array('titulo'=>'No Docente', 'detalle'=>'No has escogido ningun docente'));
        }else{
            $docente = $this->mGrupo->buscarGrupo(array('Docente_idDocente'=>$id));
            //print_r($docente);
            $this->render('grupo', array('grupos' => $docente));
        }
    }
    
    function grupoadm() {
        try {
            if ($this->session->userdata('tipo') === "Docente"||$this->session->userdata('tipo') === "Administrador") {
                $crud = new grocery_CRUD();
                $crud->set_theme('datatables');
                $crud->set_table('grupo');
                $crud->set_subject('Grupo');
                $crud->change_field_type("clave", "password");
                //$crud->set_relation('Docente_idDocente', 'docente', 'idDocente');
                $crud->set_relation('Asignatura_idAsignatura', 'asignatura', '{Nombre} - {Area}');
                $docente=$this->mDocente->buscarDocentes(array('u.nick'=>$this->session->userdata('nick')));
                $crud->where('Docente_idDocente', $docente[0]->idDocente);
                $crud->field_type('Docente_idDocente', 'hidden', $docente[0]->idDocente);
                $output = $crud->render();
                $this->_example_output($output);
            }            
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
}
