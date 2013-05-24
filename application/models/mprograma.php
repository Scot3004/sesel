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
    
    public function buscarAsignatura($arr = array()){
        $this->db->select('s.nombre, a.nombre as categoria, s.resumen, s.desarrollador');
        $this->db->from('software s');
        $this->db->join('recomendacion r', 's.idSoftware=r.Software_idSoftware', 'INNER');
        $this->db->join('grupo g', 'r.Grupo_idGrupo=g.idGrupo', 'INNER');
        $this->db->join('asignatura a', 'g.Asignatura_idAsignatura = a.idAsignatura', 'LEFT');
        $this->db->where($arr); 
        return $this->db->get()->result();
        /*
         * aca va una consulta que haga desde software hasta asignatura
            se cataloga el software segun lo que se ha recomendado
            $st = $db->prepare("SELECT * FROM Software s 
             inner join Recomendacion r on s.idSoftware=r.Software_idSoftware
             inner join Grupo g on r.Grupo_idGrupo=g.idGrupo 
             inner join Asignatura a on g.Asignatura_idAsignatura = a.idAsignatura
             WHERE a.nombre = :asignatura");
        
         * aca va una consulta que haga desde software hasta el docente
            //se cataloga el software segun lo que se ha recomendado
            $st = $db->prepare("SELECT * FROM Software s 
             inner join Recomendacion r on s.idSoftware=r.Software_idSoftware
             inner join Grupo g on r.Grupo_idGrupo=g.idGrupo 
             inner join Docente d on g.Docente_idDocente = d.idDocente
             WHERE d.idDocente = :docente");
         * aca va una consulta que haga desde software hasta el grupo
            //se cataloga el software segun lo que se ha recomendado
             SELECT * FROM Software s 
             inner join Recomendacion r on s.idSoftware=r.Software_idSoftware
             inner join Grupo g on r.Grupo_idGrupo=g.idGrupo 
             WHERE g.idGrupo = :grupo
        }*/
    }
    
    public function registrar($arr = array()){
        if(!empty($arr)){           
            $this->db->insert('software', $arr); 	
        }	
    }
    public function buscarPrograma($arr = array()){
        $this->db->where($arr); 
        $query = $this->db->get('software');
        return $query->row();           
    }
}