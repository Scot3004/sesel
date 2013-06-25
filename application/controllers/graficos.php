<?php

class Graficos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mGeneral');
        $this->load->library('jpgraph');
    }

    public function line($tabla, $columna = null, $jointable = null, $joinfield = null, $joinshow = null) {
        $datos = $this->mGeneral->contar2($tabla, $columna, array(), $jointable, $joinfield, $joinshow);
        $graph = $this->jpgraph->linechart($datos["cuenta"], $datos[$columna], lang('sesel_graph_line'));
        $graph->Stroke();
    }

    public function pie($tabla, $columna = null, $jointable = null, $joinfield = null, $joinshow = null) {
        $datos = $this->mGeneral->contar2($tabla, $columna, array(), $jointable, $joinfield, $joinshow);
        $cantidad = array_sum($datos['cuenta']);
        $graph = $this->jpgraph->pie($datos["cuenta"], $datos[$columna], lang('sesel_'.$tabla)." - ".lang('sesel_'.$columna), lang('sesel_graph_pie_center') . "\n" . $cantidad);
        $graph->Stroke();
    }

    public function data($tabla, $columna = null, $jointable = null, $joinfield = null, $joinshow = null) {
        $datos = $this->mGeneral->contar2($tabla, $columna, array(), $jointable, $joinfield, $joinshow);
        $cantidad = array_sum($datos['cuenta']);
        print_r($datos);
    }

    public function index() {
        $carpeta = 'graficos/pie';
        $map = array('subject/area',
            'recommendation/group',
            'recommendation/software',
            'groups/teacher',
            'groups/subject',
            'software/developer',
            'subject/weekly_hours',
            );
        render('software/galeria', lang('sesel_software_gallery'), array('map' => $map, 'carpeta' => $carpeta), array('css_files' => array('idangerous.swiper.css'),
            'js_files' => array('idangerous.swiper.js')
                )
        );
    }

}
