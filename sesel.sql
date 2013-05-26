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
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
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
  `idDocente` int(11) NOT NULL,
  `especializacion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `experiencia` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `titulo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDocente`),
  KEY `fk_Docente_Usuario1` (`idUsuario`),
  CONSTRAINT `fk_Docente_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='i';

INSERT INTO `docente` (`idDocente`, `especializacion`, `experiencia`, `titulo`, `idUsuario`) VALUES
(1140,	'ninguna',	'1 año',	'Ingeniero de Sistemas',	2),
(114083,	'Seguridad Informática',	'0',	'Ingeniero de Sistemas',	4);

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE `grupo` (
  `nivelAcademico` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idGrupo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Docente_idDocente` int(11) NOT NULL,
  `Asignatura_idAsignatura` int(11) NOT NULL,
  PRIMARY KEY (`idGrupo`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  UNIQUE KEY `nivelAcademico_UNIQUE` (`nivelAcademico`),
  KEY `fk_Grupo_Docente1` (`Docente_idDocente`),
  KEY `fk_Grupo_Asignatura1` (`Asignatura_idAsignatura`),
  CONSTRAINT `fk_Grupo_Asignatura1` FOREIGN KEY (`Asignatura_idAsignatura`) REFERENCES `asignatura` (`idAsignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Grupo_Docente1` FOREIGN KEY (`Docente_idDocente`) REFERENCES `docente` (`idDocente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `grupo` (`nivelAcademico`, `nombre`, `clave`, `idGrupo`, `Docente_idDocente`, `Asignatura_idAsignatura`) VALUES
('1er Semestre',	'Calculo A1',	'1234',	'1',	1140,	1),
('8',	'8 grupo1',	'1234',	'801',	114083,	4),
('Jardin',	'Prejardin',	'1234',	'prejardin',	1140,	3);

DROP TABLE IF EXISTS `recomendacion`;
CREATE TABLE `recomendacion` (
  `idRecomendacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Detalle` text COLLATE utf8_spanish_ci NOT NULL,
  `Grupo_idGrupo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Software_idSoftware` int(11) NOT NULL,
  PRIMARY KEY (`idRecomendacion`),
  KEY `fk_Recomendacion_Grupo1` (`Grupo_idGrupo`),
  KEY `fk_Recomendacion_Software1` (`Software_idSoftware`),
  CONSTRAINT `fk_Recomendacion_Grupo1` FOREIGN KEY (`Grupo_idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Recomendacion_Software1` FOREIGN KEY (`Software_idSoftware`) REFERENCES `software` (`idSoftware`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `recomendacion` (`idRecomendacion`, `nombre`, `Detalle`, `Grupo_idGrupo`, `Software_idSoftware`) VALUES
(1,	'Sage',	'asd',	'1',	1),
(2,	'software gcompris',	'<p>\n	Software para que experimenten</p>\n',	'prejardin',	123),
(3,	'Klavaro',	'<p>\n	Software para practicar la escritura en el computador(Dactilograf&iacute;a)</p>\n',	'801',	0);

DROP TABLE IF EXISTS `software`;
CREATE TABLE `software` (
  `idSoftware` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ubicacion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `desarrollador` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `resumen` varchar(140) COLLATE utf8_spanish_ci DEFAULT NULL,
  `version` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idSoftware`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `software` (`idSoftware`, `nombre`, `ubicacion`, `desarrollador`, `url`, `descripcion`, `resumen`, `version`, `imagen`) VALUES
(0,	'Klavaro',	'klavaro.sourceforge.net/en/',	'Klavaro Community',	'klavaro.sourceforge.net/en/',	'<p>\n	Software para mecanografia, aprende escribiendo</p>\n',	'Software para mecanografia, aprende escribiendo',	'1',	''),
(1,	'SageMath',	'http://sagenb.org',	'Sage',	'http://sagemath.org',	'<p>\n	Software Matematico para realizar calculos Avanzados ...</p>\n<p>\n	puede trabajar:</p>\n<ul>\n	<li>\n		calculos algebraicos</li>\n	<li>\n		derivadas</li>\n	<li>\n		integrales</li>\n</ul>\n',	'Software Matematico para realizar calculos Avanzados',	'desconocida',	''),
(123,	'gcompris',	'ubica',	'desarrolador',	'asd',	'<p>\n	asd</p>\n',	'software niños',	'12',	'1'),
(234,	'Redes Sociales',	'www.facebook.com',	'RS Community',	'www.facebook.com',	'<p>\n	Sus funcionalidades mas significativas son :</p>\n<p>\n	1. Facildad</p>\n<p>\n	2. Usabilidad</p>\n<p>\n	3. Colaboracion</p>\n',	'redes sociales como apoyo a colaboracion',	'3.4.2',	'');

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `identificacion` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_spanish_ci DEFAULT '',
  `tipo` enum('Administrador','Estudiante','Docente') COLLATE utf8_spanish_ci DEFAULT NULL,
  `clave` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechanac` date DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sexo` enum('femenino','masculino') COLLATE utf8_spanish_ci DEFAULT NULL,
  `nick` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `nick_UNIQUE` (`nick`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `usuario` (`idUsuario`, `nombres`, `apellidos`, `direccion`, `identificacion`, `telefono`, `tipo`, `clave`, `fechanac`, `email`, `sexo`, `nick`) VALUES
(1,	'123',	'123',	NULL,	NULL,	NULL,	'Docente',	'40bd001563085fc35165329ea1ff5c5ecbdbbeef',	NULL,	NULL,	'masculino',	'123'),
(2,	'Sergio C.',	'Orozco Torres',	'Calle 60 # 18 - 60',	'1140',	'3045523',	'Administrador',	'40bd001563085fc35165329ea1ff5c5ecbdbbeef',	'1991-04-30',	'scot3004@gmail.com',	'masculino',	'scot'),
(3,	'4',	'4',	'4',	'4',	'4',	'Administrador',	'51eac6b471a284d3341d8c0c63d0f1a286262a18',	'2013-05-30',	'4@4',	'femenino',	'4'),
(4,	'Jorge Iván',	'Ibañez Fábregas',	'Cra 57 90 93',	'114083',	'3002102',	'Docente',	'40bd001563085fc35165329ea1ff5c5ecbdbbeef',	'1991-01-31',	'ibanezjorge@coruniamericana.edu.co',	'masculino',	'jiif');

DELIMITER ;;

CREATE TRIGGER `Usuario_bi` BEFORE INSERT ON `usuario` FOR EACH ROW
set new.clave=sha1(new.clave);;

CREATE TRIGGER `Usuario_bu` BEFORE UPDATE ON `usuario` FOR EACH ROW
IF NEW.clave <> OLD.clave THEN
set new.clave= sha1(new.clave);
end if;;

DELIMITER ;

-- 2013-05-26 18:08:24


GRANT USAGE ON *.* TO 'sesel'@'localhost' IDENTIFIED BY PASSWORD '*9A5D8799D4248DC3F52356A3BA1764BE93EB88E7';

GRANT ALL PRIVILEGES ON `sesel`.* TO 'sesel'@'localhost';

