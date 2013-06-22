<?php
class mGeneral extends CI_Model {
    public function registrar($tabla='usuario',$arr = array()){
        if(!empty($arr)){           
            $this->db->insert($tabla, $arr); 	
        }	
    }
     public function buscar($tabla = 'software',$arr = array()) {
        $this->db->where($arr);
        $query = $this->db->get($tabla);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    public function buscarArray($tabla = 'software',$arr = array()) {
        $this->db->where($arr);
        $query = $this->db->get($tabla);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }
}
