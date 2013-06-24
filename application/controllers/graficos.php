<?php

class Graficos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mGeneral');
        $this->load->library('jpgraph');
    }

    public function line($tabla, $columna = null, $where = array(), $jointable = null, $joinfield = null, $joinshow = null) {
        $datos = $this->mGeneral->contar2($tabla, $columna, $where, $jointable, $joinfield, $joinshow);
        $graph = $this->jpgraph->linechart($datos["cuenta"], $datos[$columna], lang('sesel_graph_line'));
        $graph->Stroke();
    }

    public function pie($tabla, $columna = null, $where = array(), $jointable = null, $joinfield = null, $joinshow = null) {
        $datos = $this->mGeneral->contar2($tabla, $columna, $where, $jointable, $joinfield, $joinshow);
        $graph = $this->jpgraph->pie($datos["cuenta"], $datos[$columna], lang('sesel_graph_pie'), lang('sesel_graph_pie_center'));
    }
/*
    public function show($type,$params) {
        echo $type."<br>".$params;
        
    }
 */
}
