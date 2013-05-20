<?php

class mUsuario extends CI_Model{
   
    public function __construct()
	{
        parent::__construct();
            $this->load->database();
	} 
        
    public function buscar($arr = array()){
        if(empty($arr)){
            //esta busca todos los usuarios
            $usuarios = $this->db->query("SELECT identificacion, nombres, apellidos, direccion, telefono, email, nick, sexo FROM Usuario");
        }		
        return $usuarios->result_array();
    }

    public function buscarUsuario($arr = array()){
        if(empty($arr)){
            throw new Exception("No se ha especificado un patrón de busqueda");          
        }else if($arr['nick']){
            //esta busca un usuario con determinado nick
            $st = $this->db->prepare("select * from usuario where nick=?", $arr);                
        }else if($arr['identificacion']){
            //esta busca un usuario segun su identificacion
            $st = $this->db->prepare("SELECT * FROM Usuario WHERE docID=?", $arr);
        }
        $st->execute($arr);
        return $st->fetch(PDO::FETCH_OBJ);
        //throw new Exception("Error no especificado en el modelo de usuario");
    }
    
    public function login($arr = array()){
        if(empty($arr)){
            return false;
        }else{
            //
            $this->db->select('tipo');
            $this->db->where($arr); 
            $query = $this->db->get('Usuario');
            //$st = $this->db->query("SELECT tipo FROM Usuario WHERE nick=? AND clave=sha1(?)", $arr);
            $row = $query->row();
            return $row->tipo;
        }
    }
    public function registrar($arr = array()){
        if(!empty($arr)){
            $st = $this->db->prepare("INSERT INTO Usuario (identificacion, nombres,apellidos,direccion,telefono,email,sexo,fechanac,nick,clave) VALUES(:doc, :nombre,:apellido,:direccion,:telefono,:email,:genero,:fnacimiento,:nick,sha1(:clave))");
            $st->execute($arr);		
        }	
    }
}