<?php

class Software{
	
	// The find static method returns an array
	// with Product objects from the database.
	
	public static function buscar($arr){
		global $db;
		
		if($arr['idSoftware']){
			$st = $db->prepare("SELECT * FROM Software WHERE idSoftware=:idSoftware");
		}
		else if($arr['asignatura']){
			throw new Exception("Propiedad en implementación!");
			//aca va una consulta que haga desde software hasta asignatura
			//se cataloga el software segun lo que se ha recomendado
			$st = $db->prepare("SELECT * FROM Software s 
			 inner join Recomendacion r on s.idSoftware=r.Software_idSoftware
			 inner join Grupo g on r.Grupo_idGrupo=g.idGrupo 
			 inner join Asignatura a on g.Asignatura_idAsignatura = a.idAsignatura
			 WHERE Asignatura = :asignatura");
		}
		else{
			throw new Exception("Propiedad no Soportada!");
		}
		
		$st->execute($arr);
		
		return $st->fetchAll(PDO::FETCH_CLASS, "Software");
	}
}

?>
