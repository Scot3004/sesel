SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE DATABASE IF NOT EXISTS sesel;
USE sesel;

-- -----------------------------------------------------
-- Table `sesel`.`Usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sesel`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT ,
  `nombres` VARCHAR(45) NULL ,
  `apellidos` VARCHAR(45) NULL ,
  `direccion` VARCHAR(45) NULL ,
  `identificacion` VARCHAR(11) NULL ,
  `telefono` VARCHAR(45) NULL DEFAULT '' ,
  `tipo` ENUM('Administrador','Estudiante', 'Docente') NULL ,
  `clave` VARCHAR(45) NULL ,
  `fechanac` DATE NULL ,
  `email` VARCHAR(45) NULL ,
  `sexo` ENUM('femenino','masculino') NULL ,
  `nick` VARCHAR(20) NULL ,
  PRIMARY KEY (`idUsuario`) ,
  UNIQUE INDEX `nick_UNIQUE` (`nick` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `sesel`.`Asignatura`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sesel`.`Asignatura` (
  `idAsignatura` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL ,
  PRIMARY KEY (`idAsignatura`) ,
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `sesel`.`Software`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sesel`.`Software` (
  `idSoftware` INT NOT NULL ,
  `nombre` VARCHAR(45) NULL ,
  `ubicacion` VARCHAR(45) NULL ,
  `desarrollador` VARCHAR(45) NULL ,
  `url` VARCHAR(45) NULL ,
  `descripcion` TEXT NULL ,
  `resumen` VARCHAR(140) NULL ,
  `version` VARCHAR(20) NULL ,
  PRIMARY KEY (`idSoftware`) ,
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `sesel`.`Docente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sesel`.`Docente` (
  `idDocente` INT NOT NULL ,
  `especializacion` VARCHAR(45) NULL ,
  `experiencia` VARCHAR(45) NULL ,
  `titulo` VARCHAR(45) NULL ,
  `idUsuario` INT NULL ,
  PRIMARY KEY (`idDocente`) ,
  INDEX `fk_Docente_Usuario1` (`idUsuario` ASC) ,
  CONSTRAINT `fk_Docente_Usuario1`
    FOREIGN KEY (`idUsuario` )
    REFERENCES `sesel`.`Usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci
COMMENT = 'i';


-- -----------------------------------------------------
-- Table `sesel`.`Grupo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sesel`.`Grupo` (
  `nivelAcademico` VARCHAR(45) NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `clave` VARCHAR(45) NULL ,
  `idGrupo` VARCHAR(45) NOT NULL ,
  `Docente_idDocente` INT NOT NULL ,
  `Asignatura_idAsignatura` INT NOT NULL ,
  PRIMARY KEY (`idGrupo`) ,
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) ,
  UNIQUE INDEX `nivelAcademico_UNIQUE` (`nivelAcademico` ASC) ,
  INDEX `fk_Grupo_Docente1` (`Docente_idDocente` ASC) ,
  INDEX `fk_Grupo_Asignatura1` (`Asignatura_idAsignatura` ASC) ,
  CONSTRAINT `fk_Grupo_Docente1`
    FOREIGN KEY (`Docente_idDocente` )
    REFERENCES `sesel`.`Docente` (`idDocente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Grupo_Asignatura1`
    FOREIGN KEY (`Asignatura_idAsignatura` )
    REFERENCES `sesel`.`Asignatura` (`idAsignatura` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


-- -----------------------------------------------------
-- Table `sesel`.`Recomendacion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sesel`.`Recomendacion` (
  `idRecomendacion` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NULL ,
  `Grupo` VARCHAR(45) NOT NULL ,
  `Grupo_idGrupo` VARCHAR(45) NOT NULL ,
  `Software_idSoftware` INT NOT NULL ,
  PRIMARY KEY (`idRecomendacion`) ,
  INDEX `fk_Recomendacion_Grupo1` (`Grupo_idGrupo` ASC) ,
  INDEX `fk_Recomendacion_Software1` (`Software_idSoftware` ASC) ,
  CONSTRAINT `fk_Recomendacion_Grupo1`
    FOREIGN KEY (`Grupo_idGrupo` )
    REFERENCES `sesel`.`Grupo` (`idGrupo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Recomendacion_Software1`
    FOREIGN KEY (`Software_idSoftware` )
    REFERENCES `sesel`.`Software` (`idSoftware` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

