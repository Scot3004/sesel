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
        $this->render("menus/grupo");
    } 
    
    public function listar() {
        try {
            $grupos = $this->mGrupo->buscar();
            //$this->output->enable_profiler(TRUE);
            //print_r($grupos);
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
            $arr=array('g.id' => $id);
            $grupo = $this->mGrupo->buscar($arr);
            print_r($grupo);
            $this->render('objeto', array('objeto' => $grupo[0]));
        }
    }
    
     public function asignatura($name=null){
        if($name!==null){
            $grupos = $this->mGrupo->buscar(array('s.name' => $name));
            $asignatura=new stdClass();
            $asignatura->name=$name;
            $asignatura->grupos=$grupos;
            //print_r($asignatura);
            $asignaturas=array($asignatura);
        }else {
            $asignaturas=$this->mGrupo->buscar2(array(),'subject');  
            foreach ($asignaturas as $asignatura){
                $asignatura->grupos=$this->mGrupo->buscar(array('g.subject'=>$asignatura->idSubject),'groups');
            }
        }
        $this->output->enable_profiler(TRUE);
        $this->render('groups/list_category', array('categorias' => $asignaturas));
    }
    
    public function docente($id=null){
        $this->output->enable_profiler(TRUE);
        if($id===null){
            $this->render('error', array('titulo'=>'No Docente', 'detalle'=>'No has escogido ningun docente'));
        }else{
            $grupos = $this->mGrupo->buscar(array('u.id'=>$id));
            print_r($grupos);
            $this->render('groups/list', array('groups' => $grupos));
        }
    }
}