<?php

/**
 * Description of Software
 *
 * @author scot3004
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Software extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mPrograma');
        $this->load->model('mDocente');
        $this->load->helper('directory');
    }

    private function render($view, $params = array(), $titulo = "Software") {
        $this->load->view('mobile', array('view' => $view,
            'titulo' => $titulo,
            'params' => $params));
    }

    public function index() {
        $this->render("menus/software");
    }

    public function listar() {
        try {
            $programas = $this->mPrograma->buscar();
            $this->render('software/list', array('programas' => $programas));
        } catch (Exception $e) {
            $data['titulo'] = 'Problemas al buscar datos';
            $data['detalle'] = $e->getMessage();
            $this->render('error', $data);
        }
    }

    public function detalle($id=null) {
        if($id===null){
            show_error($this->lang->line('sesel_software_not_found'));
        }else{
            $programa = $this->mPrograma->buscarPrograma(array('idSoftware' => $id));
            $this->render('software/details', array('software' => $programa));
        }
    }
    
    public function asignatura($id=null){
        if($id!==null){
            $programa = $this->mPrograma->buscarAsignatura(array('a.nombre' => $id));
            $asignatura=new stdClass();
            $asignatura->nombre=$id;
            $asignatura->programas=$programa;
            $asignaturas=array($asignatura);
        }else {
            $asignaturas=$this->mPrograma->buscar(array(),'subject');           
            foreach ($asignaturas as $asignatura){
                $asignatura->programas=$this->mPrograma->buscarAsignatura(array('a.idSubject'=>$asignatura->idSubject));
            }
            
        }
        $this->render('software/list_category', array('categorias' => $asignaturas));
    }
    public function docente($id=null){
        if ($this->ion_auth->logged_in()) {
            if($id!==null){
                $categorias=$this->mDocente->buscarIDs(array('id' => $id));
            }else {
                $categorias=$this->mDocente->buscarIDs();         
            }
            foreach ($categorias as $categoria){
                $categoria->programas=$this->mPrograma->buscarDocente(array('u.id'=>$categoria->idDocente));
            }        
            $this->render('software/list_category', array('categorias' => $categorias));
        } else {
            $this->render('noautorizado');
        }
    }
    
    public function galeria($id=null){
        if($id===null){
            show_error($this->lang->line('sesel_software_not_found'));
        }else{
            $carpeta='assets/uploads/files/'.$id;
            $map = directory_map($carpeta);
            $programa = $this->mPrograma->buscarPrograma(array('idSoftware' => $id));
            $this->render('galeria', array('map'=>$map, 'carpeta'=>$carpeta, 'software'=>$programa));
        }
    }
}

?>
