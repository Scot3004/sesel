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
    
    public function index(){
       // $this->render('info');
        $this->load->library('markdown');
        $markdown_file_path = 'README.md';
        $content=$this->markdown->parse_file($markdown_file_path);
        render("mensaje",lang('sesel_about'), array("title"=>lang('sesel_about'), "details"=>$content));
    }  
    
    public function readme($language=null){
       // $this->render('info');
        if($language===null)
            $language=$this->config->item('language');
        $this->load->library('markdown');
        $markdown_file_path = 'Readme/'.$language.".md";
        $content=$this->markdown->parse_file($markdown_file_path);
        render("mensaje",lang('sesel_about'), array("title"=>lang('sesel_about'), "details"=>$content));
    }  

    public function license($filename='README.md'){
        $file="licenses/".$filename.".txt";
        if(!file_exists($file)){
            show_404();
        }else{
            $f = fopen($file, "r");
            $content="";
            // Read line by line until end of file
            while(!feof($f)) { 
                $content.= fgets($f) . "<br />";
            }
            render("mensaje",lang('sesel_license'), array("title"=>$this->lang->line('sesel_license'), "details"=>$content));
            fclose($f);
        }
    }
    
    public function prueba(){
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
    
    public function menu($menu){
        render('menus/'.$menu);
    }
    
    public function notfound(){
        render('noencontrado');
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
