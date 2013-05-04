<?php class Software{
    // la busqueda retorna un arreglo con los elementos cargados de la base de datos.
    public static function buscar($arr=Array()){
        $st=Software::generarConsulta($arr);
        //aca se ejecuta la consulta sql
        $st->execute($arr);
        //return $st->fetchAll(PDO::FETCH_CLASS, "Software");
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function buscarObj($arr=Array()){
        global $db;
        $st=Software::generarConsulta($arr);
        //aca se ejecuta la consulta sql
        $st->execute($arr);
        return $st->fetchAll(PDO::FETCH_CLASS, "Software");
    }
   
    public static function generarConsulta($arr=Array()){
        global $db;
        if($arr['idSoftware']){
            //esta consulta trae un solo registro
            $st = $db->prepare("SELECT * FROM Software WHERE idSoftware=:idSoftware");
        }else if($arr['asignatura']){
            throw new Exception("Propiedad en implementación!");
            //aca va una consulta que haga desde software hasta asignatura
            //se cataloga el software segun lo que se ha recomendado
            $st = $db->prepare("SELECT * FROM Software s 
             inner join Recomendacion r on s.idSoftware=r.Software_idSoftware
             inner join Grupo g on r.Grupo_idGrupo=g.idGrupo 
             inner join Asignatura a on g.Asignatura_idAsignatura = a.idAsignatura
             WHERE a.nombre = :asignatura");
        }else if($arr['docente']){
            throw new Exception("Propiedad en implementación!");
            //aca va una consulta que haga desde software hasta el docente
            //se cataloga el software segun lo que se ha recomendado
            $st = $db->prepare("SELECT * FROM Software s 
             inner join Recomendacion r on s.idSoftware=r.Software_idSoftware
             inner join Grupo g on r.Grupo_idGrupo=g.idGrupo 
             inner join Docente d on g.Docente_idDocente = d.idDocente
             WHERE d.idDocente = :docente");
        }else if($arr['grupo']){
            throw new Exception("Propiedad en implementación!");
            //aca va una consulta que haga desde software hasta el grupo
            //se cataloga el software segun lo que se ha recomendado
            $st = $db->prepare("SELECT * FROM Software s 
             inner join Recomendacion r on s.idSoftware=r.Software_idSoftware
             inner join Grupo g on r.Grupo_idGrupo=g.idGrupo 
             WHERE g.idGrupo = :grupo");
        }else{
            //esta consulta lista todo el software
            $st = $db->prepare("SELECT * FROM Software");
        }     
        return $st;
    }
}