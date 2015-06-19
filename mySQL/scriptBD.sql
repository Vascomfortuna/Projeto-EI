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
DROP TABLE IF EXISTS `mydb`.`Utilizadores` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Utilizadores` (
  `idUtilizador` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(255) NOT NULL,
  `Password` VARCHAR(255) NOT NULL,
  `Email` VARCHAR(255) NOT NULL,
  `Contacto` INT NULL,
  `NCondutor` INT NOT NULL DEFAULT 0,
  `NPassageiro` INT NOT NULL DEFAULT 0,
  `NPessoasLevadas` INT NOT NULL DEFAULT 0,
  `Iniciais` VARCHAR(45) NOT NULL,
  `Cor` VARCHAR(45) NOT NULL,
  `VOIP` VARCHAR(45) NULL,
  `NLugares` INT NOT NULL DEFAULT 4,
  `Partida` VARCHAR(255) NULL COMMENT 'Partida do utilizador por defeito.',
  `Destino` VARCHAR(255) NULL COMMENT 'Destino do utilizador por defeito.',
  PRIMARY KEY (`idUtilizador`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Boleias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Boleias` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Boleias` (
  `idBoleia` INT NOT NULL AUTO_INCREMENT,
  `NLugares` INT NOT NULL COMMENT 'Por omissão, fica com o número de lugares do utilizador',
  `Partida` VARCHAR(255) NULL,
  `Destino` VARCHAR(255) NULL,
  `Data` DATE NOT NULL,
  `HoraInicio` TIME NOT NULL,
  `HoraFim` TIME NOT NULL,
  `idUtilizador` INT NOT NULL,
  `Boleias_idBoleia` INT NULL COMMENT 'Se for uma boleia criada a partir de uma repetição, fica com o id da original. Senão, fica a null.',
  `Ativo` TINYINT(1) NOT NULL DEFAULT 1,
  `DiaSemana` INT(1) NOT NULL,
  `RepeticaoInicio` DATE NULL COMMENT 'Indica a data em que começa a repetição, se não tiver repetição, fica a null.',
  `RepeticaoFim` DATE NULL COMMENT 'Indica a data de fim da repetição. Se não tiver repetição, fica a null.',
  `NSemanaRep` VARCHAR(45) NOT NULL DEFAULT '*' COMMENT 'Numero da semana para a repetição caso a repeticao seja mensal. Senão fica \'*\', para indicar que ocorre todas as semanas',
  `NDiaRep` VARCHAR(45) NOT NULL DEFAULT '*' COMMENT 'Numero do dia para a repetição caso a repeticao seja semanal ou mensal. Senão fica \'*\', para indicar que ocorre todos os dias.',
  `Nota` VARCHAR(255) NULL,
  PRIMARY KEY (`idBoleia`),
  INDEX `fk_Boleias_Utilizadores1_idx` (`idUtilizador` ASC),
  INDEX `fk_Boleias_Boleias1_idx` (`Boleias_idBoleia` ASC),
  CONSTRAINT `fk_Boleias_Utilizadores1`
    FOREIGN KEY (`idUtilizador`)
    REFERENCES `mydb`.`Utilizadores` (`idUtilizador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Boleias_Boleias1`
    FOREIGN KEY (`Boleias_idBoleia`)
    REFERENCES `mydb`.`Boleias` (`idBoleia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Passageiros`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Passageiros` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Passageiros` (
  `Nota` VARCHAR(45) NULL,
  `ViagemUnica` INT(1) NOT NULL DEFAULT 0,
  `idUtilizador` INT NOT NULL,
  `idBoleia` INT NOT NULL,
  `Ativo` TINYINT(1) NOT NULL DEFAULT 1,
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


-- -----------------------------------------------------
-- Table `mydb`.`Alteracoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Alteracoes` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Alteracoes` (
  `idAlteracao` INT NOT NULL AUTO_INCREMENT,
  `Descricao` VARCHAR(255) NULL,
  `DataAlteracao` VARCHAR(255) NULL,
  `Passageiros_idBoleia` INT NOT NULL,
  `Passageiros_idUtilizador` INT NOT NULL,
  `Nota` VARCHAR(255) NULL COMMENT 'Justificação do utilizador da alteração',
  PRIMARY KEY (`idAlteracao`),
  INDEX `fk_Alteracoes_Passageiros1_idx` (`Passageiros_idBoleia` ASC, `Passageiros_idUtilizador` ASC),
  CONSTRAINT `fk_Alteracoes_Passageiros1`
    FOREIGN KEY (`Passageiros_idBoleia` , `Passageiros_idUtilizador`)
    REFERENCES `mydb`.`Passageiros` (`idBoleia` , `idUtilizador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Configuracoes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Configuracoes` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Configuracoes` (
  `idConfiguracao` INT NOT NULL,
  `idUtilizador` INT NOT NULL,
  `DataInicio` DATE NULL,
  `DataFim` DATE NULL,
  `HoraInicio` TIME NULL,
  `HoraFim` TIME NULL,
  `HoraPreferencial` TIME NULL,
  `DiaSemana` INT(1) NULL,
  PRIMARY KEY (`idConfiguracao`),
  INDEX `fk_Configuracoes_Utilizadores1_idx` (`idUtilizador` ASC),
  CONSTRAINT `fk_Configuracoes_Utilizadores1`
    FOREIGN KEY (`idUtilizador`)
    REFERENCES `mydb`.`Utilizadores` (`idUtilizador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Estatisticas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Estatisticas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Estatisticas` (
  `idEstatistica` INT NOT NULL COMMENT 'Estas estatísticas são mensais.',
  `idUtilizador` INT NOT NULL,
  `Mês` DATE NOT NULL,
  `Distancia` INT NOT NULL,
  `PCarbono` INT NOT NULL,
  `NCondutor` INT NOT NULL DEFAULT 0,
  `NPassageiro` INT NOT NULL DEFAULT 0,
  `NPessoasLevadas` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`idEstatistica`, `idUtilizador`),
  INDEX `fk_Estatisticas_Utilizadores1_idx` (`idUtilizador` ASC),
  CONSTRAINT `fk_Estatisticas_Utilizadores1`
    FOREIGN KEY (`idUtilizador`)
    REFERENCES `mydb`.`Utilizadores` (`idUtilizador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
