<?php

class mPrograma extends CI_Model{
   
    public function __construct()
	{
        parent::__construct();
            $this->load->database();
	} 
        
    public function buscar($arr = array()){
        $this->db->where($arr); 
        $query = $this->db->get('Software');
        if ($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return null;
        }
    }
    
    public function registrar($arr = array()){
        if(!empty($arr)){           
            $this->db->insert('Software', $arr); 	
        }	
    }
    public function buscarPrograma($arr = array()){
            $this->db->where($arr); 
            $query = $this->db->get('Software');
            //$st = $this->db->query("SELECT tipo FROMogin Usuario WHERE nick=? AND clave=sha1(?)", $arr);
            return $query->row();           
    }
}