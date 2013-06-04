<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupo extends CI_Controller {
    public function __construct(){
            parent::__construct();
            $this->load->model('mGrupo');
            $this->load->model('mPrograma');
            $this->load->model('mDocente');
    }
 
    function render($view, $params = array(), $titulo="Pagina Principal") {
         $this->load->view('mobile', 
                     array('view'=>$view, 
                         'titulo'=>$titulo, 
                         'params'=>$params));
    }
   
    public function index(){
        $this->listar();
    } 
    
    public function listar() {
        try {
            $grupos = $this->mGrupo->buscar();
            $this->render('grupo', array('grupos' => $grupos));
            
        } catch (Exception $e) {
            $data['titulo'] = 'Problemas al buscar datos';
            $data['detalle'] = $e->getMessage();
            $this->render('error', $data);
        }
    }
    
    public function detalle($id=NULL){
        $arr=array('idGrupo' => $id);
        $grupo = $this->mGrupo->buscarGrupo($arr);
        $docentes=$this->mDocente->buscarDocentes(array('idDocente'=>$grupo->Docente_idDocente));
        $grupo->docente=$docentes[0];
        print_r($grupo);
        $this->render('objeto', array('objeto' => $grupo));
    }
}