<?php

class Asignatura{
	
	/*
		The find static method selects categories
		from the database and returns them as
		an array of Category objects.
	*/
	
	public static function find($arr = array()){
		global $db;
		
		if(empty($arr)){
			$st = $db->prepare("SELECT * FROM Asignatura");
		}
		else if($arr['id']){
			$st = $db->prepare("SELECT * FROM Asignatura WHERE idAsignatura=:id");
		}
		else{
			throw new Exception("Propiedad No Soportada!");
		}
		
		$st->execute($arr);
		
		// Returns an array of Category objects:
		return $st->fetchAll(PDO::FETCH_CLASS, "Asignatura");
	}
}