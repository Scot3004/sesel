<?php

class mPrograma extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->select_fields = 's.idSoftware, s.nombre, s.resumen, s.desarrollador ';
    }

    public function buscar($arr = array(), $tabla = 'software') {
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
        $this->db->from('software s');
        $this->db->join('recomendacion r', 's.idSoftware=r.Software_idSoftware', 'INNER');
        $this->db->join('grupo g', 'r.Grupo_idGrupo=g.idGrupo', 'INNER');
        $this->db->join('asignatura a', 'g.Asignatura_idAsignatura = a.idAsignatura', 'LEFT');
        $this->db->where($arr);
        return $this->db->get()->result();
    }

    public function buscarDocente($arr = array()) {
        $this->db->select($this->select_fields . ', d.idDocente', false);
        $this->db->from('software s');
        $this->db->join('recomendacion r', 's.idSoftware=r.Software_idSoftware', 'INNER');
        $this->db->join('grupo g', 'r.Grupo_idGrupo=g.idGrupo', 'INNER');
        $this->db->join('docente d', 'g.Docente_idDocente = d.idDocente', 'LEFT');
        $this->db->where($arr);
        return $this->db->get()->result();
    }

    public function buscarGrupo($arr = array()) {
        $this->db->select($this->select_fields . ', d.idDocente', false);
        $this->db->from('software s');
        $this->db->join('recomendacion r', 's.idSoftware=r.Software_idSoftware', 'INNER');
        $this->db->join('grupo g', 'r.Grupo_idGrupo=g.idGrupo', 'INNER');
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