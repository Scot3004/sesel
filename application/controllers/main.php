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
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('mobile');
	}
 
   function render($view, $params=array()){
       $this->mobile->header('Bienvenido a Sesel', 'b')->button('welcome/help', 'Help', 'info');
        $this->mobile->navbar(array(
                'usuario' 	=> array('text' => 'Home', 	'icon' => 'home'),
                'admin'	=> array('text' => 'Admin', 	'icon' => 'gear')
        ), 'b');
        $this->mobile->footer('Sesel Es Software Educativo Libre', 'b');
        $this->mobile->view($view, $params);
   }
   
	public function index()
	{
		$this->mobile->header('Welcome to CodeIgniter!', 'e')->button('welcome/help', 'Help', 'info');

		$this->mobile->navbar(array(
			'usuario' 	=> array('text' => 'Home', 		'icon' => 'home'),
			'admin'	=> array('text' => 'Settings', 	'icon' => 'gear', 'data-ajax'=>'false')
		), 'a');

		$this->mobile->footer('Footer', 'a');

		//$this->mobile->view('home');
                $this->mobile->view('info');
                //$this->mobile->view('menuadmin');
	}
            
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */