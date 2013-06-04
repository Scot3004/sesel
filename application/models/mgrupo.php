<?php
class mGrupo extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->select_fields = 'g.nombre, g.nivelAcademico';
    }

    public function buscar($arr = array(), $tabla = 'grupo') {
        $this->db->where($arr);
        $this->db->order_by('nombre');
        $query = $this->db->get($tabla);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function buscarDocentes($arr = array()) {
        $this->db->select('concat(u.nombres, " ", u.apellidos) as nombre, d.idDocente', false);
        $this->db->from('docente d', false);
        $this->db->join('usuario u', 'u.idUsuario = d.idusuario', 'INNER');
        $this->db->where($arr);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function buscarAsignatura($arr = array()) {
        $this->db->select($this->select_fields . ', a.nombre as categoria');
        $this->db->from('grupo g');
        $this->db->join('asignatura a', 'g.Asignatura_idAsignatura = a.idAsignatura', 'LEFT');
        $this->db->where($arr);
        return $this->db->get()->result();
    }

    public function buscarDocente($arr = array()) {
        $this->db->select($this->select_fields . ', d.idDocente', false);
        $this->db->from('grupo g');
        $this->db->join('docente d', 'g.Docente_idDocente = d.idDocente', 'LEFT');
        $this->db->where($arr);
        return $this->db->get()->result();
    }

    public function buscarPrograma($arr = array()) {
        $this->db->select($this->select_fields . ', s.nombre', false);
        $this->db->from('grupo g');
        $this->db->join('recomendacion r', 'r.Grupo_idGrupo=g.idGrupo', 'INNER');
        $this->db->join('software s', 's.idSoftware=r.Software_idSoftware', 'INNER');
        $this->db->where($arr);
        return $this->db->get()->result();
    }
    
    public function buscarGrupo($arr = array()) {
        $this->db->where($arr);
        $query = $this->db->get('grupo');
        return $query->row();
    }
}
