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
        $this->load->model('mGeneral');
        $this->load->helper('directory');
    }

    private function render($view, $params = array(), $titulo = "Software") {
        $this->load->view('mobile', array('view' => $view,
            'titulo' => $titulo,
            'params' => $params));
    }

    public function index() {
        $user = $this->ion_auth->user()->row();
        $this->render("menus/software", array('docente'=>$user->id));
    }

    public function listar() {
        try {
            $programas = $this->mGeneral->buscar('software');
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
            $this->load->library('form_validation');
            $this->load->helper('language');
            $this->form_validation->set_rules('name', $this->lang->line('sesel_name'), 'required');
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
                $categoria->programas=$this->mPrograma->buscarDocente(array('u.id'=>$categoria->idUsuario));
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
    public function recomendar($id=null){
        $this->load->library('form_validation');
	$this->load->helper('language');
        $this->load->helper('array');
        $this->load->model('mGrupo');
        if (!$this->ion_auth->logged_in()){
            $this->render('noautorizado');
            return;
        }else{
            $user = $this->ion_auth->user()->row();
                
                echo $user->id;
            $grupos=$this->mGrupo->AssocNombre(array('teacher'=>$user->id));
            $this->form_validation->set_rules('name', $this->lang->line('sesel_name'), 'required');
            if ($this->form_validation->run() == false){
                $this->render('recommend', array('software'=>  set_value('software'), 'grupos'=>$grupos));
            }else{
               $grupos=$this->mGeneral->registrar('recommendation', 
                       elements(array('name','details','group','software'), $_POST));
               
            }
                
            
        }
    }
     function do_upload($id=null)
	{
		$config['upload_path'] = './assets/uploads/files/'.$id;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100000';
		$config['max_width']  = '9999';
		$config['max_height']  = '9999';
 $this->load->library('form_validation');
	
		$this->load->library('upload', $config);
                $pathToUpload=$config['upload_path'];
                if ( ! file_exists($pathToUpload) ){
                    $create = mkdir($pathToUpload, 0777);
                    $createThumbsFolder = mkdir($pathToUpload . '/thumbs', 0777);
                    if ( ! $create || ! $createThumbsFolder)
                    return;
                }

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors(), 'id'=>$id);

			$this->load->view('software/upload/form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data(), 'id'=>$id);

			$this->load->view('software/upload/success', $data);
		}
	}
}