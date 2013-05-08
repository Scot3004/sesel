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
class ControladorGrupo {
    public function handleRequest() {
            render('array2table', array(                    
                'title'     => 'Lista de Usuarios',		
                'array'  => Grupo::buscar(),
                'mensaje'   => 'Bienvenido'
            ));
    }
}

?>

