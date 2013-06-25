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
    }

    public function index() {
        /*if ($this->ion_auth->logged_in()) {
            $user = $this->ion_auth->user()->row();
            $id = $user->id;
        }
        else
            $id = null;*/
        render("menus/software", lang('sesel_software'));
    }

    public function listar() {
        try {
            $programas = $this->mPrograma->buscar();
            render('software/list', lang('sesel_software_list'), array('programas' => $programas));
        } catch (Exception $e) {
            show_error($e->getMessage(), 200);
        }
    }

    public function detalle($id = null) {
        if ($id === null) {
            show_error($this->lang->line('sesel_software_not_found'));
        } else {
            $this->load->library('form_validation');
            $this->load->helper('language');
            $this->form_validation->set_rules('name', $this->lang->line('sesel_name'), 'required');
            $programa = $this->mPrograma->buscarPrograma(array('idSoftware' => $id));
            render('software/details', lang('sesel_software_details'), array('software' => $programa));
        }
    }

    public function asignatura($id = null) {
        if ($id !== null) {
            $programa = $this->mPrograma->buscarAsignatura(array('a.nombre' => $id));
            $asignatura = new stdClass();
            $asignatura->nombre = $id;
            $asignatura->programas = $programa;
            $asignaturas = array($asignatura);
        } else {
            $asignaturas = $this->mPrograma->buscar(array(), 'subject');
            foreach ($asignaturas as $asignatura) {
                $asignatura->programas = $this->mPrograma->buscarAsignatura(array('a.idSubject' => $asignatura->idSubject));
            }
        }
        render('software/list_category',lang('sesel_software_list_subject'), array('categorias' => $asignaturas));
    }

    public function docente($id = null) {
        if ($this->ion_auth->logged_in()) {
            if ($id !== null) {
                $categorias = $this->mDocente->buscarIDs(array('id' => $id));
            } else {
                $categorias = $this->mDocente->buscarIDs();
            }
            foreach ($categorias as $categoria) {
                $categoria->programas = $this->mPrograma->buscarDocente(array('u.id' => $categoria->idUsuario));
            }
            render('software/list_category',lang('sesel_software_list_teacher'), array('categorias' => $categorias));
        } else {
            render('noautorizado');
        }
    }

    public function galeria($id = null) {
        if ($id === null) {
            show_error($this->lang->line('sesel_software_not_found'));
        } else {
            $this->load->helper('directory');
            $carpeta = 'assets/uploads/files/' . $id;
            $map = directory_map($carpeta);
            $programa = $this->mPrograma->buscarPrograma(array('idSoftware' => $id));
            render('software/galeria', lang('sesel_software_gallery'),array('map' => $map, 'carpeta' => $carpeta, 'software' => $programa), array('css_files' => array('idangerous.swiper.css'),
                'js_files' => array('idangerous.swiper.js')
                    )
            );
        }
    }

    public function recomendar($id = null) {
        $this->load->library('form_validation');
        $this->load->helper('language');
        $this->load->helper('array');
        $this->load->model('mGrupo');
        if (!$this->ion_auth->logged_in()) {
            render('noautorizado');
            return;
        } else {
            $user = $this->ion_auth->user()->row();
            $grupos = $this->mGrupo->AssocNombre(array('teacher' => $user->id));
            $this->form_validation->set_rules('name', $this->lang->line('sesel_name'), 'required');
            $this->form_validation->set_rules('software', $this->lang->line('sesel_software'), 'required');
            if ($this->form_validation->run() == false) {
                 if($id===null){
                     $id=set_value('software');
                 }
                render('software/recommend', lang('sesel_recommendation'), array('software' => $id, 'grupos' => $grupos));
            } else if($id!==null){
                $grupos = $this->mGeneral->registrar('recommendation', elements(array('name', 'details', 'group', 'software'), $_POST));
                render('mensaje',lang('sesel_recommendation_saved'), array('title'=>lang('sesel_recommendation_saved'),'details'=>lang('sesel_recommendation_saved')));
            }else {
                $programas = $this->mPrograma->buscar();
                render('software/list', lang('sesel_software_list'), array('programas' => $programas, 'link'=>'software/recomendar/'));
            }
        }
    }

    function do_upload($id = null) {
        if (!$this->ion_auth->logged_in()) {
            render('noautorizado');
            return;
        } else {
            $config['upload_path'] = './assets/uploads/files/' . $id;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '9999999999999';
            $config['max_width'] = '9999';
            $config['max_height'] = '9999';
            $this->load->library('form_validation');

            $this->load->library('upload', $config);
            $pathToUpload = $config['upload_path'];
            if (!file_exists($pathToUpload)) {
                $create = mkdir($pathToUpload, 0777);
                $createThumbsFolder = mkdir($pathToUpload . '/thumbs', 0777);
                if (!$create || !$createThumbsFolder)
                    return;
            }

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors(), 'id' => $id);
                render('software/upload/form',lang('sesel_upload'), $error);
            } else {
                $data = array('upload_data' => $this->upload->data(), 'id' => $id);
                render('software/upload/success',lang('sesel_upload_success'), $data);
            }
        }
    }

}