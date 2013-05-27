<?php

class mDocente extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function buscar($arr = array()) {
        $this->db->select('*, concat(u.nombres, " ", u.apellidos) as nombre', false);
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

    public function buscarDocentes($arr = array()) {
        $this->db->select('concat(u.nombres, " ", u.apellidos) as nombre, d.idDocente, u.identificacion, u.idUsuario, u.nick', false);
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

    public function buscarGrupo($arr = array()) {
        /*$this->db->select($this->select_fields . ', d.idDocente', false);
        $this->db->from('software s');
        $this->db->join('recomendacion r', 's.idSoftware=r.Software_idSoftware', 'INNER');
        $this->db->join('grupo g', 'r.Grupo_idGrupo=g.idGrupo', 'INNER');
        $this->db->where($arr);
        return $this->db->get()->result();*/
        return null;
    }

    public function registrar($arr = array()) {
        if (!empty($arr)) {
            $this->db->insert('software', $arr);
        }
    }
}