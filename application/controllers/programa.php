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
        $this->load->helper('directory');
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
            
                $programas = $this->mPrograma->buscar();
                $this->render('programa', array('programas' => $programas));
            
        } catch (Exception $e) {
            $data['titulo'] = 'Problemas al buscar datos';
            $data['detalle'] = $e->getMessage();
            $this->render('error', $data);
        }
    }

    public function detalle($id=null) {
        if($id===null){
            $this->render('error', array('titulo'=>'No Programa', 'detalle'=>'No has escogido ningun Programa'));
        }else{
            $programa = $this->mPrograma->buscarPrograma(array('idSoftware' => $id));
            $this->render('detallesoftware', array('software' => $programa));
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
            $asignaturas=$this->mPrograma->buscar(array(),'asignatura');           
            foreach ($asignaturas as $asignatura){
                $asignatura->programas=$this->mPrograma->buscarAsignatura(array('a.nombre'=>$asignatura->nombre));
            }
            
        }
        $this->render('software', array('categorias' => $asignaturas));
    }
    public function docente($id=null){
        if ($this->ion_auth->logged_in()) {
            if($id!==null){
                $categorias=$this->mDocente->buscarDocentes(array('d.idDocente' => $id));
            }else {
                $categorias=$this->mDocente->buscarDocentes();         
            }
            foreach ($categorias as $categoria){
                $categoria->programas=$this->mPrograma->buscarDocente(array('d.idDocente'=>$categoria->idDocente));
            }        
            $this->render('software', array('categorias' => $categorias));
        } else {
            $this->render('noautorizado');
        }
    }
    
    public function galeria($id=null){
        if($id===null){
            $this->render('error', array('titulo'=>'No existe o no se encuentra este Software', 'detalle'=>'Error al encontrar software!'));
        }else{
            $carpeta='assets/uploads/files/'.$id;
            $map = directory_map($carpeta);
            $programa = $this->mPrograma->buscarPrograma(array('idSoftware' => $id));
            $this->render('galeria', array('map'=>$map, 'carpeta'=>$carpeta, 'software'=>$programa));
        }
    }
}

?>
