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

    private function render($view, $params = array(), $titulo = null) {
        if($titulo===null)
            $titulo=$this->lang->line('sesel_subject');
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
        $this->load->library('markdown');
        $markdown_file_path = 'README.md';
        $content=$this->markdown->parse_file($markdown_file_path);
        $this->_example_output((object) array('output' => $content, 'js_files' => array(), 'css_files' => array()));
    }

    function software() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('software');
            $crud->set_subject('Software');

            $crud->display_as('name',$this->lang->line('sesel_name'));
            $crud->display_as('developer',$this->lang->line('sesel_developer'));            
            $crud->display_as('description',$this->lang->line('sesel_description')); 
            $crud->display_as('location',$this->lang->line('sesel_location')); 
            $crud->display_as('url',$this->lang->line('sesel_url')); 
            $crud->display_as('short_description',$this->lang->line('sesel_short_description')); 
            $crud->display_as('download',$this->lang->line('sesel_download')); 
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
            $crud->set_table('subject');
            $crud->set_subject($this->lang->line('sesel_subject'));
            $crud->display_as('name',$this->lang->line('sesel_name'));
            $crud->display_as('area',$this->lang->line('sesel_area'));
            $crud->display_as('weekly_hours',$this->lang->line('sesel_weekly_hours'));
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
            $crud->set_table('users');
            $crud->set_subject('Usuario');
            $crud->change_field_type("clave", "password");
            $crud->columns('first_name','last_name','address','email','phone','username','ip_address','active',$this->lang->line('sesel_groups'));
            $crud->fields('username','password','email','phone','first_name','last_name','address','active',$this->lang->line('sesel_groups'));
            $crud->set_relation_n_n($this->lang->line('sesel_groups'), 'users_groups', 'groups', 'user_id', 'group_id', 'name');
            $crud->display_as('first_name',$this->lang->line('sesel_first_name'));
            $crud->display_as('last_name',$this->lang->line('sesel_last_name'));
            $crud->display_as('address',$this->lang->line('sesel_address'));
            $crud->display_as('ip_address',$this->lang->line('sesel_ip_address'));
            $crud->display_as('phone',$this->lang->line('sesel_phone'));
            $crud->display_as('email',$this->lang->line('sesel_email'));
            $crud->display_as('username',$this->lang->line('sesel_username'));
            $crud->display_as('active',$this->lang->line('sesel_active'));
            $crud->callback_column('ip_address',array($this,'bin2hex'));
            $crud->unset_columns('clave');
            $crud->callback_before_insert(function($post_array){
                $ip_address = inet_pton($this->input->ip_address());
	        $post_array['created_on'] = time();
                //TODO colocar compatible con otros motores de db
                $post_array['ip_address'] = $ip_address;
                return $post_array;
            });
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
    function bin2hex($value){
        return bin2hex($value);
    }
    
    
    function oldusuario() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('datatables');
            $crud->set_table('usuario');
            $crud->set_subject('Usuario');
            $crud->change_field_type("clave", "password");
            $crud->set_relation_n_n('Grupos', 'estudiante', 'grupo', 'idUsuario', 'idGrupo', 'nombre');
            $crud->unset_columns('clave');
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
            $crud->set_table('groups');
            $crud->set_subject($this->lang->line('sesel_group'));
            $crud->change_field_type("password", "password"); 
            $crud->set_relation('subject', 'subject', '{name} - {area}');
            $crud->set_relation('teacher', 'users', '{first_name} {last_name}');
            $crud->set_relation_n_n($this->lang->line('sesel_users'), 'users_groups', 'users', 'group_id', 'user_id', '{first_name} {last_name}');
            $crud->display_as('name',$this->lang->line('sesel_name'));
            $crud->display_as('description',$this->lang->line('sesel_description'));
            $crud->display_as('teacher',$this->lang->line('sesel_teacher'));
            $crud->display_as('password',$this->lang->line('sesel_password'));
            $crud->display_as('level',$this->lang->line('sesel_level'));
            $crud->display_as('subject',$this->lang->line('sesel_subject'));
            $crud->display_as('type',$this->lang->line('sesel_type'));
            $output = $crud->render();
            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
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
            $crud->set_table('recommendation');
            $crud->set_subject($this->lang->line('sesel_recommendation'));
            $crud->set_relation('software', 'software', 'name');
            $crud->set_relation('group', 'groups', '{level} - {name}');
            $crud->display_as('name',$this->lang->line('sesel_name'));
            $crud->display_as('details',$this->lang->line('sesel_details'));
            $crud->display_as('group',$this->lang->line('sesel_group'));
            $crud->display_as('software',$this->lang->line('sesel_software'));
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
}
