-- Adminer 3.7.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '-05:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `sesel`;
CREATE DATABASE `sesel` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `sesel`;

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

INSERT INTO `estudiante` (`idEstudiante`, `idUsuario`, `idGrupo`) VALUES
(1,	4,	3);

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `subject` int(11) DEFAULT NULL,
  `teacher` int(11) unsigned DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject`),
  KEY `teacher` (`teacher`),
  CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`subject`) REFERENCES `subject` (`idSubject`),
  CONSTRAINT `groups_ibfk_2` FOREIGN KEY (`teacher`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `groups` (`id`, `name`, `description`, `subject`, `teacher`, `level`, `password`) VALUES
(1,	'admin',	'Administrator',	NULL,	NULL,	NULL,	NULL),
(2,	'members',	'General User',	NULL,	NULL,	NULL,	NULL);

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

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `recommendation`;
CREATE TABLE `recommendation` (
  `idRecommendation` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `details` text COLLATE utf8_spanish_ci NOT NULL,
  `group` mediumint(8) unsigned NOT NULL,
  `software` int(11) unsigned NOT NULL,
  PRIMARY KEY (`idRecommendation`),
  KEY `fk_Recomendacion_Grupo1` (`group`),
  KEY `fk_Recomendacion_Software1` (`software`),
  CONSTRAINT `recommendation_ibfk_2` FOREIGN KEY (`group`) REFERENCES `groups` (`id`),
  CONSTRAINT `recommendation_ibfk_1` FOREIGN KEY (`software`) REFERENCES `software` (`idSoftware`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


DROP TABLE IF EXISTS `software`;
CREATE TABLE `software` (
  `idSoftware` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `developer` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `version` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `location` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `short_description` varchar(140) COLLATE utf8_spanish_ci DEFAULT NULL,
  `download` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idSoftware`),
  UNIQUE KEY `nombre_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `software` (`idSoftware`, `name`, `developer`, `description`, `version`, `location`, `url`, `short_description`, `download`) VALUES
(1,	'SageMath',	'Sage',	'<p>\n	Software Matematico para realizar calculos Avanzados ...</p>\n<p>\n	puede trabajar:</p>\n<ul>\n	<li>\n		calculos algebraicos</li>\n	<li>\n		derivadas</li>\n	<li>\n		integrales</li>\n</ul>\n',	'desconocida',	'http://sagenb.org',	'http://sagemath.org',	'Software Matematico para realizar calculos Avanzados',	NULL),
(2,	'gcompris',	'desarrolador',	'<p>\r\n	asd</p>\r\n',	'12',	'ubica',	'asd',	'software niños',	NULL),
(3,	'Redes Sociales',	'RS Community',	'<p>\r\n	Sus funcionalidades mas significativas son :</p>\r\n<ol>\r\n	<li>Facildad</li>\r\n\r\n	<li>Usabilidad</li>\r\n\r\n	<li>Colaboracion</li>\r\n</ol>',	'3.4.2',	'www.facebook.com',	'www.facebook.com',	'redes sociales como apoyo a colaboracion',	NULL),
(4,	'Klavaro',	'Klavaro Community',	'<p>\r\n	Software para mecanografia, aprende escribiendo</p>\r\n',	'1',	'klavaro.sourceforge.net/en/',	'klavaro.sourceforge.net/en/',	'Software para mecanografia, aprende escribiendo',	NULL);

DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `idSubject` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `area` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idSubject`),
  UNIQUE KEY `nombre_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

INSERT INTO `subject` (`idSubject`, `name`, `area`) VALUES
(1,	'calculo',	'ciencias basicas'),
(2,	'fisica',	'ciencias basicas'),
(3,	'infantes',	'niños'),
(4,	'Dactilografía',	'Informática'),
(5,	'Quimica',	'Ciencias Basicas');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `address`, `phone`) VALUES
(1,	UNHEX('7F000001'),	'administrator',	'59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4',	'9462e8eee0',	'admin@admin.com',	'',	NULL,	NULL,	'9d029802e28cd9c768e8e62277c0df49ec65c48c',	1268889823,	1371335818,	1,	'Admin',	'istrator',	'ADMIN',	'123'),
(2,	UNHEX(''),	'123',	'123',	NULL,	'123',	NULL,	NULL,	NULL,	NULL,	0,	NULL,	1,	'123',	'123',	'123',	'123');

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(3,	1,	1),
(4,	2,	2);

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

-- 2013-06-15 19:27:22
