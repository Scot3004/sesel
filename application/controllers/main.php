<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct(){
            parent::__construct();
    }
 
    function render($view, $params = array(), $titulo="Pagina Principal") {
         $this->load->view('mobile', 
                     array('view'=>$view, 
                         'titulo'=>$titulo, 
                         'params'=>$params));
    }
   
    public function index(){
        $this->render('info');
    }  
    
    public function info(){
        //$this->render('info');
        if ($this->ion_auth->logged_in()){
            echo "ok nuevo sistema";
        }else{
            echo "no has usado el nuevo login";
        }
        if ($this->ion_auth->in_group(array('admin', 'docente'))){
            echo "hola admin";
        }
    }
    
    
    public function notfound(){
        $this->render('noencontrado');
    }
    
    public function agent(){
            $this->load->library('user_agent');

       if ($this->agent->is_browser())
       {
           $agent = $this->agent->browser().' '.$this->agent->version();
       }
       elseif ($this->agent->is_robot())
       {
           $agent = $this->agent->robot();
       }
       elseif ($this->agent->is_mobile())
       {
           $agent = $this->agent->mobile();
       }
       else
       {
           $agent = 'Unidentified User Agent';
       }

       echo $agent;

       echo $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.) 
         }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
