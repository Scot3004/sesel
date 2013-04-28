<?php 
require_once "../includes/config.php";
require_once "../includes/connect.php";
global $db;

try{
if($_POST["clave"]==$_POST["rclave"]){
$arr=$_POST;
if(!empty($arr)){
	//$st = $db->prepare("INSERT INTO Usuarios (nombres, DocId) VALUES(:nombre, :doc)");
	$st = $db->prepare("INSERT INTO usuarios (DocID, nombres,apellidos,direccion,fechanac,telefono,sexo,nick,clave, cargo) VALUES(:doc, :nombre,:apellido,:direccion,:fnacimiento,:telefono,:genero,:nick,md5(:clave), 'Cliente')");
	
}

$st->execute(array(":doc" => $_POST["doc"], ":nombre" => $_POST["nombre"], ":apellido" => $_POST["apellido"],  ":direccion" => $_POST["direccion"], ":fnacimiento" => $_POST["fnacimiento"], ":telefono" => $_POST["telefono"], ":genero" => $_POST["genero"], ":nick" => $_POST["nick"], ":clave" => $_POST["clave"]));
header("Location:../");
}else
{ 
echo "No coinciden las claves";
}
}
catch(PDOException $e) {
	error_log($e->getMessage());
	die("Problemas en la base de datos<br/>".$e->getMessage());
}
// Returns an array of Category objects:
//return $st->fetchAll(PDO::FETCH_CLASS, "Category");
?>
