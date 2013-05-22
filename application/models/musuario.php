<?php

class mUsuario extends CI_Model{
   
    public function __construct()
	{
        parent::__construct();
            $this->load->database();
	} 
        
    public function buscar($arr = array()){
        if(empty($arr)){
            throw new Exception("No se ha especificado un patrón de busqueda");          
        }else {
            $this->db->select('identificacion, nombres, apellidos, direccion, telefono, email, nick, sexo');
            $this->db->where($arr); 
        }
        return $this->db->get('Usuario');
    }
    
    public function login($arr = array()){
        if(empty($arr)){
            return false;
        }else{
            //
            $this->db->select('tipo');
            $this->db->where($arr); 
            $query = $this->db->get('Usuario');
            //$st = $this->db->query("SELECT tipo FROMogin Usuario WHERE nick=? AND clave=sha1(?)", $arr);
            $row = $query->row();
            if($row)
            return $row->tipo;
            else return false;
        }
    }
    
    public function registrar($arr = array()){
        if(!empty($arr)){           
            $this->db->insert('Usuario', $arr); 	
        }	
    }
}