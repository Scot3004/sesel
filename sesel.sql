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

INSERT INTO `asignatura` (`idAsignatura`, `nombre`, `area`) VALUES
(1,	'calculo',	'ciencias basicas'),
(2,	'fisica',	'ciencias basicas'),
(3,	'infantes',	'niños'),
(4,	'Dactilografía',	'Informática'),
(5,	'Quimica',	'Ciencias Basicas');

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

INSERT INTO `docente` (`idDocente`, `titulo`, `idUsuario`, `especializacion`, `experiencia`) VALUES
(0,	'Ingeniero de Sistemas',	2,	'ninguna',	'1 año'),
(1,	'Ingeniero de Sistemas',	4,	'Seguridad Informática',	'0');

DROP TABLE IF EXISTS `estudiante`;
CREATE TABLE `estudiante` (
  `idEstudiante` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `idGrupo` int(11) NOT NULL,
  PRIMARY KEY (`idEstudiante`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idGrupo` (`idGrupo`),
  CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  CONSTRAINT `estudiante_ibfk_2` FOREIGN KEY (`idGrupo`) REFERENCES `grupo` (`idGrupo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


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

INSERT INTO `grupo` (`idGrupo`, `nivelAcademico`, `nombre`, `clave`, `Docente_idDocente`, `Asignatura_idAsignatura`) VALUES
(1,	'1er Semestre',	'Calculo A1',	'40bd001563085fc35165329ea1ff5c5ecbdbbeef',	0,	1),
(2,	'Jardin',	'Prejardin',	'40bd001563085fc35165329ea1ff5c5ecbdbbeef',	0,	3),
(3,	'8',	'8 grupo1',	'40bd001563085fc35165329ea1ff5c5ecbdbbeef',	1,	4);

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
  `descarga` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idSoftware`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `software` (`idSoftware`, `nombre`, `desarrollador`, `descripcion`, `version`, `ubicacion`, `url`, `resumen`, `descarga`) VALUES
(1,	'SageMath',	'Sage',	'<p>\n	Software Matematico para realizar calculos Avanzados ...</p>\n<p>\n	puede trabajar:</p>\n<ul>\n	<li>\n		calculos algebraicos</li>\n	<li>\n		derivadas</li>\n	<li>\n		integrales</li>\n</ul>\n',	'desconocida',	'http://sagenb.org',	'http://sagemath.org',	'Software Matematico para realizar calculos Avanzados',	NULL),
(2,	'gcompris',	'desarrolador',	'<p>\r\n	asd</p>\r\n',	'12',	'ubica',	'asd',	'software niños',	NULL),
(3,	'Redes Sociales',	'RS Community',	'<p>\r\n	Sus funcionalidades mas significativas son :</p>\r\n<ol>\r\n	<li>Facildad</li>\r\n\r\n	<li>Usabilidad</li>\r\n\r\n	<li>Colaboracion</li>\r\n</ol>',	'3.4.2',	'www.facebook.com',	'www.facebook.com',	'redes sociales como apoyo a colaboracion',	NULL),
(4,	'Klavaro',	'Klavaro Community',	'<p>\r\n	Software para mecanografia, aprende escribiendo</p>\r\n',	'1',	'klavaro.sourceforge.net/en/',	'klavaro.sourceforge.net/en/',	'Software para mecanografia, aprende escribiendo',	NULL);

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

INSERT INTO `usuario` (`idUsuario`, `identificacion`, `nombres`, `apellidos`, `direccion`, `telefono`, `email`, `tipo`, `nick`, `clave`, `fechanac`, `sexo`) VALUES
(2,	'1140',	'Sergio C.',	'Orozco Torres',	'Calle 60 # 18 - 60',	'3045523',	'scot3004@gmail.com',	'Administrador',	'scot',	'40bd001563085fc35165329ea1ff5c5ecbdbbeef',	'1991-04-30',	'masculino'),
(4,	'114083',	'Jorge Iván',	'Ibañez Fábregas',	'Cra 57 # 90 - 93',	'3002102',	'ibanezjorge@coruniamericana.edu.co',	'Docente',	'jiif',	'40bd001563085fc35165329ea1ff5c5ecbdbbeef',	'1991-01-31',	'masculino');

DELIMITER ;;

CREATE TRIGGER `Usuario_bi` BEFORE INSERT ON `usuario` FOR EACH ROW
set new.clave=sha1(new.clave);;

CREATE TRIGGER `Usuario_bu` BEFORE UPDATE ON `usuario` FOR EACH ROW
IF NEW.clave <> OLD.clave THEN
set new.clave= sha1(new.clave);
end if;;

DELIMITER ;

-- 2013-05-27 17:59:20
