<?php

/*
	This is the main include file.
	It is only used in index.php and keeps it much cleaner.
*/

require_once "includes/config.php";
require_once "includes/connect.php";
require_once "includes/helpers.php";
require_once "includes/modelos/modelo.usuario.php";
require_once "includes/modelos/modelo.software.php";
require_once "includes/controladores/controlador.inicio.php";
require_once "includes/controladores/controlador.usuario.php";
require_once "includes/controladores/controlador.software.php";

// This will allow the browser to cache the pages of the store.

header('Cache-Control: max-age=3600, public');
header('Pragma: cache');
header("Last-Modified: ".gmdate("D, d M Y H:i:s",time())." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s",time()+3600)." GMT");

?>
