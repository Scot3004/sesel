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
    
    public function listar() {
        try {
            if ($this->session->userdata('tipo')) {
                $programas = $this->mPrograma->buscar();
                $asignaturas=new stdClass();
                $asignaturas->nombre="";
                $asignaturas->programas=$programas;
                $this->render('software', array('categorias' => array($asignaturas)));
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
    
    public function asignatura($id=null){
        if($id!==null){
            $programa = $this->mPrograma->buscarAsignatura(array('a.nombre' => $id));
            $asignatura=new stdClass();
            $asignatura->nombre=$id;
            $asignatura->programas=$programa;
            $asignaturas=array($asignatura);
        }else {
            $asignaturas=$this->mPrograma->buscar(array(),'asignatura');           
            foreach ($asignaturas as $asignatura){
                $asignatura->programas=$this->mPrograma->buscarAsignatura(array('a.nombre'=>$asignatura->nombre));
            }
            
        }
        $this->render('software', array('categorias' => $asignaturas));
    }
    public function docente($id=null){
        if($id!==null){
            $categorias=$this->mDocente->buscarDocentes(array('d.idDocente' => $id));
        }else {
            $categorias=$this->mDocente->buscarDocentes();         
        }
        foreach ($categorias as $categoria){
            $categoria->programas=$this->mPrograma->buscarDocente(array('d.idDocente'=>$categoria->idDocente));
        }        
        //print_r($categorias);
        $this->render('software', array('categorias' => $categorias));
    }
}

?>
