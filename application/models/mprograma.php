<?php

class mPrograma extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->select_fields = 's.idSoftware, s.name, s.short_description, s.developer';
    }

    public function buscar($arr = array(), $tabla = 'software') {
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
        $this->db->select('concat(first_name, " ", last_name) as name', false);
        $this->db->where($arr);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function buscarAsignatura($arr = array()) {
        $this->db->select($this->select_fields . ', a.name as categoria');
        $this->db->from('software s');
        $this->db->join('recommendation r', 's.idSoftware=r.software', 'INNER');
        $this->db->join('groups g', 'r.group=g.id', 'INNER');
        $this->db->join('subject a', 'g.subject = a.idSubject', 'LEFT');
        $this->db->where($arr);
        return $this->db->get()->result();
    }

    public function buscarDocente($arr = array()) {
        $this->db->select($this->select_fields . ', u.id, concat(u.first_name, " ", u.last_name) as category', false);
        $this->db->from('software s');
        $this->db->join('recommendation r', 's.idSoftware=r.software', 'INNER');
        $this->db->join('groups g', 'r.group=g.id', 'INNER');
        $this->db->join('users u', 'g.teacher = u.id', 'LEFT');
        $this->db->where($arr);
        return $this->db->get()->result();
    }

    public function buscarGrupo($arr = array()) {
        $this->db->select($this->select_fields . ', d.idDocente', false);
        $this->db->from('software s');
        $this->db->join('recommendation r', 's.idSoftware=r.software', 'INNER');
        $this->db->join('grupo g', 'r.group=g.idGrupo', 'INNER');
        $this->db->where($arr);
        return $this->db->get()->result();
    }

    public function registrar($arr = array()) {
        if (!empty($arr)) {
            $this->db->insert('software', $arr);
        }
    }

    public function buscarPrograma($arr = array()) {
        $this->db->where($arr);
        $query = $this->db->get('software');
        return $query->row();
    }

}