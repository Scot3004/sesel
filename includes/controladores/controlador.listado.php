<?php
class ControladorListado{
    public function handleRequest() {
        render('lista',array(
            'title'	=> 'Inicio de Sesi&oacute;n',
            'lista'	=> $_REQUEST["lista"],

        ));
    }
}
?>
