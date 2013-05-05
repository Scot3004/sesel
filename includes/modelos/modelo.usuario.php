<?php

class Usuario{	
    public static function buscar($arr = array()){
        global $db;
        if(empty($arr)){
            //esta busca todos los usuarios
            $st = $db->prepare("SELECT identificacion, nombres, apellidos, direccion, telefono, email, nick, sexo FROM Usuario");
        }		
        $st->execute($arr);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscarUsuario($arr = array()){
        global $db;
        if(empty($arr)){
            throw new Exception("No se ha especificado un patrón de busqueda");          
        }else if($arr['nick']){
            //esta busca un usuario con determinado nick
            $st = $db->prepare("select * from usuario where nick=:nick");                
        }else if($arr['identificacion']){
            //esta busca un usuario segun su identificacion
            $st = $db->prepare("SELECT * FROM Usuario WHERE docID=:identificacion");
        }
        $st->execute($arr);
        return $st->fetch(PDO::FETCH_OBJ);
        //throw new Exception("Error no especificado en el modelo de usuario");
    }
    
    public static function login($arr = array()){
        global $db;
        if(empty($arr)){
            return false;
        }else{
            //
            $st = $db->prepare("SELECT tipo FROM Usuario WHERE nick=:nick AND clave=sha1(:clave)");
            $st->execute($arr);
            $result = $st->fetch(PDO::FETCH_OBJ);
            return $result->tipo;
        }
    }
    public static function registrar($arr = array()){
        global $db;
        if(!empty($arr)){
            $st = $db->prepare("INSERT INTO Usuario (identificacion, nombres,apellidos,direccion,telefono,email,sexo,fechanac,nick,clave) VALUES(:doc, :nombre,:apellido,:direccion,:telefono,:email,:genero,:fnacimiento,:nick,sha1(:clave))");
            $st->execute($arr);		
        }	
    }
}