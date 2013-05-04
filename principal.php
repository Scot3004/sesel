<?php
require_once "includes/config.php";
require_once "includes/connect.php";
require_once "includes/helpers.php";
require_once "includes/modelos/modelo.usuario.php";
require_once "includes/modelos/modelo.software.php";
require_once "includes/controladores/controlador.inicio.php";
require_once "includes/controladores/controlador.usuario.php";
require_once "includes/controladores/controlador.software.php";
require_once "includes/controladores/controlador.listado.php";
require_once "includes/controladores/array2xml.class.php";
// This will allow the browser to cache the pages of the store.

//header('Cache-Control: max-age=3600, public');
header('Cache-Control: max-age=0, public');
header('Pragma: cache');
header("Last-Modified: ".gmdate("D, d M Y H:i:s",time())." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s",time()+3600)." GMT");
