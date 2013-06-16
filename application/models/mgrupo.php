<?php
class mGrupo extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->select_fields = 'g.name, g.level, g.id';
    }

    public function buscar($arr = array(), $tabla = 'groups') {
        $this->db->where($arr);
        $this->db->order_by('name');
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
        $this->db->select($this->select_fields . ', s.name as categoria');
        $this->db->from('groups g');
        $this->db->join('subject s', 's.idSubject = g.subject', 'RIGHT');
        $this->db->where($arr);
        return $this->db->get()->result();
    }

    public function buscarDocente($arr = array()) {
        $this->db->select($this->select_fields . ', u.id, concat(u.first_name, " ", u.last_name) as name', false);
        $this->db->from('grupo g');
        $this->db->join('users u', 'g.teacher = u.id', 'LEFT');
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
        $query = $this->db->get('groups');
        return $query->row();
    }
}
