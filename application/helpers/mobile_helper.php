<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('render'))
{
     function render($view, $titulo = "Sesel", $params = array(), $extraparams=array()) {
        $CI =& get_instance();
        $extraparams['view']=$view;
        $extraparams['titulo']=$titulo;
        $extraparams['params']=$params;
        $CI->load->view('mobile', $extraparams);
    }
}
