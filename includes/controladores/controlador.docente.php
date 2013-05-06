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
class ControladorDocente {
    public function handleRequest() {
        $tblUsuarios=  aidan::array2table(Docente::buscar());
            render('usuarios', array(                    
                'title'     => 'Lista de Usuarios',		
                'usuarios'  => $tblUsuarios,
                'mensaje'   => 'Bienvenido'
            ));
    }
}

?>

