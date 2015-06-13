-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Utilizadores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Utilizadores` (
  `idUtilizador` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(255) NOT NULL,
  `Password` VARCHAR(255) NOT NULL,
  `Email` VARCHAR(255) NOT NULL,
  `Contacto` INT NULL,
  `NCondutor` INT NOT NULL DEFAULT 0,
  `NPassageiro` INT NULL DEFAULT 0,
  PRIMARY KEY (`idUtilizador`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Alteracoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Alteracoes` (
  `idAlteracao` INT NOT NULL AUTO_INCREMENT,
  `Descricao` VARCHAR(255) NULL,
  `DataAlteracao` VARCHAR(255) NULL,
  `Utilizadores_idUtilizador` INT NOT NULL,
  PRIMARY KEY (`idAlteracao`),
  INDEX `fk_Alteracoes_Utilizadores1_idx` (`Utilizadores_idUtilizador` ASC),
  CONSTRAINT `fk_Alteracoes_Utilizadores1`
    FOREIGN KEY (`Utilizadores_idUtilizador`)
    REFERENCES `mydb`.`Utilizadores` (`idUtilizador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Repeticoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Repeticoes` (
  `idRepeticao` INT NOT NULL AUTO_INCREMENT,
  `DiaSemana` VARCHAR(45) NULL,
  `Intervalo` VARCHAR(45) NOT NULL,
  `DataInicio` DATE NOT NULL,
  `DataFim` DATE NOT NULL,
  PRIMARY KEY (`idRepeticao`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Boleias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Boleias` (
  `idBoleia` INT NOT NULL AUTO_INCREMENT,
  `NLugares` INT NOT NULL DEFAULT 4,
  `Partida` VARCHAR(255) NULL,
  `Destino` VARCHAR(255) NULL,
  `Data` DATE NOT NULL,
  `HoraInicio` TIME NOT NULL,
  `Duracao` INT NOT NULL,
  `idUtilizador` INT NOT NULL,
  `idParametro` INT NULL,
  PRIMARY KEY (`idBoleia`),
  INDEX `fk_Boleias_Utilizadores1_idx` (`idUtilizador` ASC),
  INDEX `fk_Boleias_Parametros1_idx` (`idParametro` ASC),
  CONSTRAINT `fk_Boleias_Utilizadores1`
    FOREIGN KEY (`idUtilizador`)
    REFERENCES `mydb`.`Utilizadores` (`idUtilizador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Boleias_Parametros1`
    FOREIGN KEY (`idParametro`)
    REFERENCES `mydb`.`Repeticoes` (`idRepeticao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Passageiros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Passageiros` (
  `Nota` VARCHAR(45) NULL,
  `ViagemUnica` INT(1) NOT NULL DEFAULT 0,
  `idUtilizador` INT NOT NULL,
  `idBoleia` INT NOT NULL,
  PRIMARY KEY (`idBoleia`, `idUtilizador`),
  INDEX `fk_Passageiros_Utilizadores1_idx` (`idUtilizador` ASC),
  INDEX `fk_Passageiros_Boleias1_idx` (`idBoleia` ASC),
  CONSTRAINT `fk_Passageiros_Utilizadores1`
    FOREIGN KEY (`idUtilizador`)
    REFERENCES `mydb`.`Utilizadores` (`idUtilizador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Passageiros_Boleias1`
    FOREIGN KEY (`idBoleia`)
    REFERENCES `mydb`.`Boleias` (`idBoleia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
