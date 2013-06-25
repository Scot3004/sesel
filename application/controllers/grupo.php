<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grupo extends CI_Controller {
    public function __construct(){
            parent::__construct();
            $this->load->model('mGrupo');
            $this->load->model('mGeneral');
    }
 
    public function index(){
        if ($this->ion_auth->logged_in()) {
            render("menus/grupo",lang('sesel_groups'));
        } else {
            render('noautorizado');
        }
    } 
    
    public function listar() {
        if ($this->ion_auth->logged_in()) {
            try {
                $grupos = $this->mGrupo->buscar();
                //$this->output->enable_profiler(TRUE);
                //print_r($grupos);
                render('groups/list',lang('sesel_groups_list'), array('groups' => $grupos));
            } catch (Exception $e) {
                show_error($e->getMessage());
            }
        } else {
            render('noautorizado');
        }
    }
    
    public function detalle($id=NULL){
        if ($this->ion_auth->logged_in()) {
            if($id===null){
                show_error($this->lang->line('sesel_groups_not_found'));
            }else{
                $arr=array('g.id' => $id);
                $grupo = $this->mGrupo->buscar($arr);
                print_r($grupo);
                render('objeto',  lang('sesel_group_details'), array('objeto' => $grupo[0]));
            }
        } else {
            render('noautorizado');
        }            
    }
    
     public function asignatura($name=null){
        if ($this->ion_auth->logged_in()) {
            if($name!==null){
                $grupos = $this->mGrupo->buscar(array('s.name' => $name));
                $asignatura=new stdClass();
                $asignatura->name=$name;
                $asignatura->grupos=$grupos;
                $asignaturas=array($asignatura);
            }else {
                $asignaturas=$this->mGeneral->buscar('subject',array());  
                foreach ($asignaturas as $asignatura){
                    $asignatura->grupos=$this->mGrupo->buscar(array('g.subject'=>$asignatura->idSubject),'groups');
                }
            }
            render('groups/list_category',lang('sesel_groups_list_subject'), array('categorias' => $asignaturas));
        } else {
            render('noautorizado');
        }   
     }
    
    public function docente($id=null){
        if ($this->ion_auth->logged_in()) {  
            if($id===null){
                show_error(lang('sesel_no_teacher'),200);
            }else{
                $grupos = $this->mGrupo->buscar(array('u.id'=>$id));
                render('groups/list', lang('sesel_groups_list_teacher'), array('groups' => $grupos));
            }
        } else {
            render('noautorizado');
        }    
    }
    
    public function prueba(){
        echo img("grupo/grafico_docente");
    }
    
    public function grafico_docente(){
        
    }
}