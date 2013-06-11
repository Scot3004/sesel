<?php

if (!defined('BASEPATH'))
    exit('No está permitido acceder directamente al script');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');
        $this->load->model('mDocente');

        $this->load->library('grocery_CRUD');
    }

    private function render($view, $params = array(), $titulo = "Control de Usuarios") {
        $this->load->view('mobile', array('view' => $view,
            'titulo' => $titulo,
            'params' => $params));
    }
    
    function _example_output($output = null) {
        if ($this->ion_auth->is_admin()){
            $this->load->view('admin.php', $output);
        } else {
            $this->render('noautorizado');
        }
    }

    function index() {
        $output = $this->load->view('info', null, true);
        $this->_example_output((object) array('output' => $output, 'js_files' => array(), 'css_files' => array()));
    }

    function programa() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('software');
            $crud->set_subject('Software');

            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function asignatura() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('asignatura');
            $crud->set_subject('Asignatura');

            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function usuario() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('usuario');
            $crud->set_subject('Usuario');
            $crud->change_field_type("clave", "password");
            $crud->set_relation_n_n('Grupos', 'estudiante', 'grupo', 'idUsuario', 'idGrupo', 'nombre');
            
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function docente() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('docente');
            $crud->set_subject('Docente');
            $crud->set_relation('idUsuario', 'usuario', '{nombres} {apellidos}');

            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
    function grupo() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('grupo');
            $crud->set_subject('Grupo');
            $crud->change_field_type("clave", "password"); 
            $this->docentes=$this->mDocente->assocNombre();
            //$crud->set_relation('Docente_idDocente', 'docente', 'idDocente');
            $crud->field_type('Docente_idDocente','dropdown',$this->docentes);
            $crud->callback_column('Docente_idDocente',array($this,'nombredocente'));
            $crud->display_as('Docente_idDocente','Docente');
            $crud->set_relation('Asignatura_idAsignatura', 'asignatura', '{Nombre} - {Area}');
            $crud->set_relation_n_n('Estudiantes', 'estudiante', 'usuario', 'idGrupo', 'idUsuario', '{nombres} {apellidos}');
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
    function nombredocente($value){
        return $this->docentes[$value];
    }
    
    function estudiante() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('estudiante');
            $crud->set_subject('Estudiante');
            $crud->set_relation('idUsuario', 'usuario', '{nombres} {apellidos}');
            $crud->set_relation('idGrupo', 'grupo', '{nivelAcademico} - {nombre}');

            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
    function recomendacion() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('recomendacion');
            $crud->set_subject('Recomendación');
            $crud->set_relation('Software_idSoftware', 'software', 'nombre');
            $crud->set_relation('Grupo_idGrupo', 'grupo', '{nivelAcademico} - {nombre}');

            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
}
