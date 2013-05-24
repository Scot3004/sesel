<?php

if (!defined('BASEPATH'))
    exit('No está permitido acceder directamente al script');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
    }

    function _example_output($output = null) {
        if ($this->session->userdata('tipo') === "Administrador") {
            $this->load->view('admin.php', $output);
        } else {
            redirect('usuario/login', 'refresh');
        }
    }

    function index() {
        $output = $this->load->view('info', null, true);
        $this->_example_output((object) array('output' => $output, 'js_files' => array(), 'css_files' => array()));
    }

    function software_management() {
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

    function subject_management() {
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

    function user_management() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('usuario');
            $crud->set_subject('Usuario');
            $crud->change_field_type("clave", "password");

            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function recomend_management() {
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

    function group_management() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('grupo');
            $crud->set_subject('Grupo');
            $crud->set_relation('Docente_idDocente', 'docente', 'idDocente');
            $crud->set_relation('Asignatura_idAsignatura', 'asignatura', '{Nombre} - {Area}');
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function master_management() {
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

}
