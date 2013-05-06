<?php

class Docente{
	
	/*
		The find static method selects categories
		from the database and returns them as
		an array of Category objects.
	*/
	
	public static function buscar($arr = array()){
            global $db;
            $st = $db->prepare("SELECT * FROM Docente d inner join Usuario u on d.idUsuario=u.idUsuario");
            $st->execute($arr);
            // Returns an array of Category objects:
            return $st->fetchAll(PDO::FETCH_ASSOC);
        }	
}
?>
