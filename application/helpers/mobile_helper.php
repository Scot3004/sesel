<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('render'))
{
     function render($view, $titulo = "Sesel", $params = array(), $extraparams=array()) {
        $CI =& get_instance();
         if ($CI->ion_auth->logged_in()) {
            $user = $CI->ion_auth->user()->row();
            $CI->load->model('mGeneral');
            $teacher=$CI->mGeneral->contar_todo('groups',array('teacher'=>$user->id));
            $admin=$CI->ion_auth->is_admin();
        }else{
            $user=null;
            $teacher=0;
            $admin=false;
        }
        $params['user']=$user;
        $params['teacher']=$teacher;
        $params['admin']=$admin;
        $extraparams['view']=$view;
        $extraparams['titulo']=$titulo;
        $extraparams['params']=$params;
        $extraparams['user']=$user;
        $extraparams['teacher']=$teacher;
        $extraparams['admin']=$admin;
        $CI->load->view('mobile', $extraparams);
    }
}
