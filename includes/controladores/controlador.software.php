<?php
function limpiar($buffer){
    return trim($buffer);
}

class ControladorSoftware {
    public function handleRequest() {
        if ($_GET["software"]) {
            $software = Software::buscar(array('idSoftware' => $_GET['software']));
            render('detallesoftware', array(
                'software' => $software[0]
            ));
        } else {
            //ob_start('limpiar');
            header("Content-type: text/xml");
            $software = Software::buscar(Array());
            $xml= new Array2xml();
            $xml->Array2xml(array(
                'Software' => $software));
            echo $xml->getXml();
            //ob_end_flush();
        }
    }
    

}