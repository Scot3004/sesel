<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controlador
 *
 * @author scot3004
 */
class ControladorAsignatura {
    public function handleRequest() {
        /*//ob_start('limpiar');
        header("Content-type: text/xml");
        $asignatura = Asignatura::buscar(Array());
        $xml= new Array2xml();
        $xml->Array2xml(array(
            'Asignatura' => $asignatura));
        echo $xml->getXml();
        //ob_end_flush();*/
        $tblUsuarios=  aidan::array2table(Asignatura::buscar());
            render('usuarios', array(                    
                'title'     => 'Lista de Usuarios',		
                'usuarios'  => $tblUsuarios,
                'mensaje'   => 'Bienvenido'
            ));
    }
}

?>
