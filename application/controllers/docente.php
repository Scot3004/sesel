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
            $str="";
            $docente = $this->mDocente->buscar(array('idDocente'=>$id));
            $class_vars = get_object_vars($docente[0]);
            foreach ($class_vars as $name => $value) {
                $str.= "$name : $value <br/>";
            }
            $this->render('error', array('titulo'=>$id, 'detalle'=>$str));
        }
    }
}
