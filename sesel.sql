-- Adminer 3.7.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '-05:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `sesel` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `sesel`;

DROP TABLE IF EXISTS `asignatura`;
CREATE TABLE `asignatura` (
  `idAsignatura` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `area` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idAsignatura`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `docente`;
CREATE TABLE `docente` (
  `idDocente` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `especializacion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `experiencia` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idDocente`),
  KEY `fk_Docente_Usuario1` (`idUsuario`),
  CONSTRAINT `fk_Docente_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='i';


DROP TABLE IF EXISTS `grupo`;
CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL AUTO_INCREMENT,
  `nivelAcademico` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Docente_idDocente` int(11) NOT NULL,
  `Asignatura_idAsignatura` int(11) NOT NULL,
  PRIMARY KEY (`idGrupo`),
  UNIQUE KEY `nombre` (`nombre`),
  KEY `fk_Grupo_Docente1` (`Docente_idDocente`),
  KEY `fk_Grupo_Asignatura1` (`Asignatura_idAsignatura`),
  CONSTRAINT `fk_Grupo_Asignatura1` FOREIGN KEY (`Asignatura_idAsignatura`) REFERENCES `asignatura` (`idAsignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`Docente_idDocente`) REFERENCES `docente` (`idDocente`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DELIMITER ;;

CREATE TRIGGER `Grupo_bi` BEFORE INSERT ON `grupo` FOR EACH ROW
set new.clave=sha1(new.clave);;

CREATE TRIGGER `Grupo_bu` BEFORE UPDATE ON `grupo` FOR EACH ROW
IF NEW.clave <> OLD.clave THEN
set new.clave= sha1(new.clave);
end if;;

DELIMITER ;

DROP TABLE IF EXISTS `recomendacion`;
CREATE TABLE `recomendacion` (
  `idRecomendacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Detalle` text COLLATE utf8_spanish_ci NOT NULL,
  `Grupo_idGrupo` int(11) NOT NULL,
  `Software_idSoftware` int(11) NOT NULL,
  PRIMARY KEY (`idRecomendacion`),
  KEY `fk_Recomendacion_Grupo1` (`Grupo_idGrupo`),
  KEY `fk_Recomendacion_Software1` (`Software_idSoftware`),
  CONSTRAINT `fk_Recomendacion_Software1` FOREIGN KEY (`Software_idSoftware`) REFERENCES `software` (`idSoftware`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `recomendacion_ibfk_1` FOREIGN KEY (`Grupo_idGrupo`) REFERENCES `grupo` (`idGrupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `software`;
CREATE TABLE `software` (
  `idSoftware` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `desarrollador` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `version` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `resumen` varchar(140) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idSoftware`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT '',
  `email` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` enum('Administrador','Estudiante','Docente') COLLATE utf8_spanish_ci DEFAULT NULL,
  `nick` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `clave` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechanac` date DEFAULT NULL,
  `sexo` enum('femenino','masculino') COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `identificacion` (`identificacion`),
  UNIQUE KEY `nick_UNIQUE` (`nick`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DELIMITER ;;

CREATE TRIGGER `Usuario_bi` BEFORE INSERT ON `usuario` FOR EACH ROW
set new.clave=sha1(new.clave);;

CREATE TRIGGER `Usuario_bu` BEFORE UPDATE ON `usuario` FOR EACH ROW
IF NEW.clave <> OLD.clave THEN
set new.clave= sha1(new.clave);
end if;;

DELIMITER ;

-- 2013-05-27 14:46:54


GRANT USAGE ON *.* TO 'sesel'@'localhost' IDENTIFIED BY PASSWORD '*9A5D8799D4248DC3F52356A3BA1764BE93EB88E7';

GRANT ALL PRIVILEGES ON `sesel`.* TO 'sesel'@'localhost';

