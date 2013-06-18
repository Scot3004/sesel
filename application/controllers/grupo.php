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
            $this->render('groups/list', array('groups' => $grupos));
            
        } catch (Exception $e) {
            $data['titulo'] = 'Problemas al buscar datos';
            $data['detalle'] = $e->getMessage();
            $this->render('error', $data);
        }
    }
    
    public function detalle($id=NULL){
        if($id===null){
            show_error($this->lang->line('sesel_groups_not_found'));
        }else{
            $arr=array('id' => $id);
            $grupo = $this->mGrupo->buscarGrupo($arr);
            $docentes=$this->mDocente->buscarDocentes(array('idDocente'=>$grupo->Docente_idDocente));
            $grupo->docente=$docentes[0];
            print_r($grupo);
            $this->render('objeto', array('objeto' => $grupo));
        }
    }
    
     public function asignatura($name=null){
        if($name!==null){
            $grupos = $this->mGrupo->buscarAsignatura(array('s.name' => $name));
            $asignatura=new stdClass();
            $asignatura->name=$name;
            $asignatura->grupos=$grupos;
            //print_r($asignatura);
            $asignaturas=array($asignatura);
        }else {
            $asignaturas=$this->mGrupo->buscar(array(),'subject');           
            foreach ($asignaturas as $asignatura){
                $asignatura->grupos=$this->mGrupo->buscarAsignatura(array('s.idSubject'=>$asignatura->idSubject));
            }
            
        }
        //$this->output->enable_profiler(TRUE);
        $this->render('groups/list_category', array('categorias' => $asignaturas));
    }
    
    public function docente($id=null){
        if($id===null){
            $this->render('error', array('titulo'=>'No Docente', 'detalle'=>'No has escogido ningun docente'));
        }else{
            $grupos = $this->mGrupo->buscar(array('u.id'=>$id));
            $this->render('grupo', array('grupos' => $grupos));
        }
    }
}