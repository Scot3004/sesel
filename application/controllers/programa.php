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
    }
    
    private function render($view, $params = array(), $titulo="Software") {
        $this->load->view('mobile', 
            array('view'=>$view, 
                'titulo'=>$titulo, 
                'params'=>$params));
    }
    
    public function index() {
        if ($this->session->userdata('tipo')) {
            try {
                $programas=$this->mPrograma->buscar($_POST);
                $this->render('software', array('array'=>$programas));
            } catch (Exception $e) {
                $data['titulo'] = 'Problemas al buscar datos';
                $data['detalle'] = $e->getMessage();
                $this->render('error', $data);
            }
        } else {
            $this->render('software');
        }
    }
    
    public function detalle($id){
        $programa=$this->mPrograma->buscarPrograma(array('idSoftware'=>$id));
        $this->render('detallesoftware', array('software'=>$programa));
    }
    
}

?>
