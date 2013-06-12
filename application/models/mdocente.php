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
        $this->db->select('*', false);
        $this->db->from('docente d');
        $this->db->join('grupo g', 'd.idDocente=g.Docente_idDocente', 'INNER');
        $this->db->where($arr);
        return $this->db->get()->result();
    }

    public function assocNombre($arr=array()){
        $this->db->select('concat(u.nombres, " ", u.apellidos) as nombre, d.idDocente, u.identificacion', false);
        $this->db->from('docente d', false);
        $this->db->join('usuario u', 'u.idUsuario = d.idusuario', 'INNER');
        $this->db->where($arr);
        $query = $this->db->get();
        $result = $query->result();
        $return=array();
        foreach($result as $row){
            $return[$row->idDocente]=$row->nombre;
        }
        return $return;
    }
        
    public function registrar($arr = array()) {
        if (!empty($arr)) {
            $this->db->insert('software', $arr);
        }
    }
}