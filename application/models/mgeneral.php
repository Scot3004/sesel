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
    
    public function contar($tabla, $columna=null, $where=array(),$jointable=null,$joinfield=null,$joinshow=null){
        if($jointable){
            $this->db->join($jointable, $tabla.".".$columna."=".$jointable.".".$joinfield, 'INNER');
            $show=$jointable.".".$joinshow;
        }else{
            $show=$columna;
        }
        $this->db->select($columna.",count(*) cuenta",false);
        if($columna!==null)
             $this->db->group_by($tabla.".".$columna);
        $this->db->from($tabla);
        $this->db->where($where);
        return $this->db->get()->result();  
    }
    
    public function contar2($tabla, $columna=null, $where=array(),$jointable=null,$joinfield=null,$joinshow=null){
       $datos=$this->contar($tabla, $columna, $where,$jointable,$joinfield,$joinshow);
       $i=0;
       foreach ($datos as $dato){
           $result["cuenta"][$i]=$dato->cuenta;
           $result[$columna][$i]=utf8_decode($dato->$columna);;
           $i++;
       }
       return $result;
    }
    
    public function contar_todo($tabla){
       return $this->db->count_all_results($tabla);
    }
}
