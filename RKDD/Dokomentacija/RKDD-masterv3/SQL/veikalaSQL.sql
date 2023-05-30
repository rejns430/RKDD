-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema veikals
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema veikals
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `veikals` DEFAULT CHARACTER SET utf8 ;
USE `veikals` ;

-- -----------------------------------------------------
-- Table `veikals`.`klienti`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `veikals`.`klienti` (
  `klientiID` INT NOT NULL AUTO_INCREMENT,
  `vards` VARCHAR(45) NULL,
  `kontakti` VARCHAR(45) NULL,
  `adresse` VARCHAR(45) NULL,
  PRIMARY KEY (`klientiID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `veikals`.`piegades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `veikals`.`piegades` (
  `piegadesID` INT NOT NULL AUTO_INCREMENT,
  `datums` VARCHAR(45) NULL,
  `klienti_klientiID` INT NOT NULL,
  PRIMARY KEY (`piegadesID`, `klienti_klientiID`),
 CONSTRAINT `fk_piegades_klienti1`
    FOREIGN KEY (`klienti_klientiID`)
    REFERENCES `veikals`.`klienti` (`klientiID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `veikals`.`kategorijas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `veikals`.`kategorijas` (
  `kategorijaID` INT NOT NULL AUTO_INCREMENT,
  `kategorijasvards` VARCHAR(45) NULL,
  `kategorijasveids` VARCHAR(45) NULL,
  `klienti_klientiID` INT NOT NULL,
  PRIMARY KEY (`kategorijaID`, `klienti_klientiID`),
 CONSTRAINT `fk_kategorijas_klienti1`
    FOREIGN KEY (`klienti_klientiID`)
    REFERENCES `veikals`.`klienti` (`klientiID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `veikals`.`produkts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `veikals`.`produkts` (
  `porduktsID` INT NOT NULL AUTO_INCREMENT,
  `produktavards` VARCHAR(45) NULL,
  `kategorijas_kategorijaID` INT NOT NULL,
  PRIMARY KEY (`porduktsID`, `kategorijas_kategorijaID`),
 CONSTRAINT `fk_produkts_kategorijas`
    FOREIGN KEY (`kategorijas_kategorijaID`)
    REFERENCES `veikals`.`kategorijas` (`kategorijaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `veikals`.`maksajums`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `veikals`.`maksajums` (
  `maksajumaID` INT NOT NULL AUTO_INCREMENT,
  `datums` VARCHAR(45) NULL,
  `piegades_piegadesID` INT NOT NULL,
  `produkts_porduktsID` INT NOT NULL,
  `produkts_kategorijas_kategorijaID` INT NOT NULL,
  PRIMARY KEY (`maksajumaID`, `piegades_piegadesID`, `produkts_porduktsID`, `produkts_kategorijas_kategorijaID`),
   CONSTRAINT `fk_maksajums_piegades1`
    FOREIGN KEY (`piegades_piegadesID`)
    REFERENCES `veikals`.`piegades` (`piegadesID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_maksajums_produkts1`
    FOREIGN KEY (`produkts_porduktsID` , `produkts_kategorijas_kategorijaID`)
    REFERENCES `veikals`.`produkts` (`porduktsID` , `kategorijas_kategorijaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `veikals`.`lietotajs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `veikals`.`lietotajs` (
  `lietotajsID` INT NOT NULL AUTO_INCREMENT,
  `lietotajvards` VARCHAR(45) NULL,
  `parole` VARCHAR(255) NULL,
  PRIMARY KEY (`lietotajsID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `veikals`.`pasutijumi`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `veikals`.`pasutijumi` (
  `pasutijumiID` INT NOT NULL AUTO_INCREMENT,
  `datums` VARCHAR(45) NULL,
  `klienti_klientiID` INT NOT NULL,
  `maksajums_maksajumaID` INT NOT NULL,
  `maksajums_piegades_piegadesID` INT NOT NULL,
  `maksajums_produkts_porduktsID` INT NOT NULL,
  `maksajums_produkts_kategorijas_kategorijaID` INT NOT NULL,
  `lietotajs_lietotajsID` INT NOT NULL,
  PRIMARY KEY (`pasutijumiID`, `klienti_klientiID`, `maksajums_maksajumaID`, `maksajums_piegades_piegadesID`, `maksajums_produkts_porduktsID`, `maksajums_produkts_kategorijas_kategorijaID`, `lietotajs_lietotajsID`),
  CONSTRAINT `fk_pasutijumi_klienti1`
    FOREIGN KEY (`klienti_klientiID`)
    REFERENCES `veikals`.`klienti` (`klientiID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pasutijumi_maksajums1`
    FOREIGN KEY (`maksajums_maksajumaID` , `maksajums_piegades_piegadesID` , `maksajums_produkts_porduktsID` , `maksajums_produkts_kategorijas_kategorijaID`)
    REFERENCES `veikals`.`maksajums` (`maksajumaID` , `piegades_piegadesID` , `produkts_porduktsID` , `produkts_kategorijas_kategorijaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pasutijumi_lietotajs1`
    FOREIGN KEY (`lietotajs_lietotajsID`)
    REFERENCES `veikals`.`lietotajs` (`lietotajsID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `veikals`.`rekins`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `veikals`.`rekins` (
  `rekinsID` INT NOT NULL AUTO_INCREMENT,
  `klienti_klientiID` INT NOT NULL,
  `datums` VARCHAR(45) NULL,
  PRIMARY KEY (`rekinsID`, `klienti_klientiID`),
 
  CONSTRAINT `fk_rekins_klienti1`
    FOREIGN KEY (`klienti_klientiID`)
    REFERENCES `veikals`.`klienti` (`klientiID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `veikals`.`pardevejs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `veikals`.`pardevejs` (
  `pardevajaID` INT NOT NULL AUTO_INCREMENT,
  `vards` VARCHAR(45) NULL,
  PRIMARY KEY (`pardevajaID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `veikals`.`produkts_has_pardevejs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `veikals`.`produkts_has_pardevejs` (
  `produkts_porduktsID` INT NOT NULL AUTO_INCREMENT,
  `produkts_kategorijas_kategorijaID` INT NOT NULL,
  `pardevejs_pardevajaID` INT NOT NULL,
  PRIMARY KEY (`produkts_porduktsID`, `produkts_kategorijas_kategorijaID`, `pardevejs_pardevajaID`),
  CONSTRAINT `fk_produkts_has_pardevejs_produkts1`
    FOREIGN KEY (`produkts_porduktsID` , `produkts_kategorijas_kategorijaID`)
    REFERENCES `veikals`.`produkts` (`porduktsID` , `kategorijas_kategorijaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produkts_has_pardevejs_pardevejs1`
    FOREIGN KEY (`pardevejs_pardevajaID`)
    REFERENCES `veikals`.`pardevejs` (`pardevajaID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=0;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


INSERT INTO `veikals`.`kategorijas` (`kategorijasvards`, `kategorijasveids`, `klienti_klientiID`) VALUES ('Jauns', 'Jauns', '1');
INSERT INTO `veikals`.`kategorijas` (`kategorijasvards`, `kategorijasveids`, `klienti_klientiID`) VALUES ('Lietots', 'Kā jauns', '2');
INSERT INTO `veikals`.`kategorijas` (`kategorijasvards`, `kategorijasveids`, `klienti_klientiID`) VALUES ('Lietots', 'Labā stāvoklī', '3');
INSERT INTO `veikals`.`kategorijas` (`kategorijasvards`, `kategorijasveids`, `klienti_klientiID`) VALUES ('Lietots', 'Ar deffektiem', '4');

INSERT INTO `veikals`.`klienti` (`vards`, `kontakti`, `adresse`) VALUES ('Reinis', 'Kede', 'basejns3');
INSERT INTO `veikals`.`klienti` (`vards`, `kontakti`, `adresse`) VALUES ('Matiss', 'Petrausks', 'Brivibs iel 2');
INSERT INTO `veikals`.`klienti` (`vards`, `kontakti`, `adresse`) VALUES ('olivers', 'murjnieks', 'eduartise');
INSERT INTO `veikals`.`klienti` (`vards`, `kontakti`, `adresse`) VALUES ('Murjanis', 'Zejmelis', 'Liela iela 69');

INSERT INTO `veikals`.`maksajums` (`datums`, `piegades_piegadesID`, `produkts_porduktsID`, `produkts_kategorijas_kategorijaID`) VALUES ('2023-01-01', '1', '1', '1');
INSERT INTO `veikals`.`maksajums` (`datums`, `piegades_piegadesID`, `produkts_porduktsID`, `produkts_kategorijas_kategorijaID`) VALUES ('2023-01-01', '2', '2', '2');
INSERT INTO `veikals`.`maksajums` (`datums`, `piegades_piegadesID`, `produkts_porduktsID`, `produkts_kategorijas_kategorijaID`) VALUES ('2023-01-01', '3', '3', '3');
INSERT INTO `veikals`.`maksajums` (`datums`, `piegades_piegadesID`, `produkts_porduktsID`, `produkts_kategorijas_kategorijaID`) VALUES ('2023-01-01', '4', '4', '4');

INSERT INTO `veikals`.`pardevejs` (`vards`) VALUES ('Olegs');
INSERT INTO `veikals`.`pardevejs` (`vards`) VALUES ('Raivis');
INSERT INTO `veikals`.`pardevejs` (`vards`) VALUES ('Rivo');
INSERT INTO `veikals`.`pardevejs` (`vards`) VALUES ('Aigars');

INSERT INTO `veikals`.`pasutijumi` (`datums`, `klienti_klientiID`, `maksajums_maksajumaID`, `maksajums_piegades_piegadesID`, `maksajums_produkts_porduktsID`, `maksajums_produkts_kategorijas_kategorijaID`) VALUES ('2023-01-01', '1', '1', '1', '1', '1');
INSERT INTO `veikals`.`pasutijumi` (`datums`, `klienti_klientiID`, `maksajums_maksajumaID`, `maksajums_piegades_piegadesID`, `maksajums_produkts_porduktsID`, `maksajums_produkts_kategorijas_kategorijaID`) VALUES ('2023-01-01', '2', '2', '2', '2', '2');
INSERT INTO `veikals`.`pasutijumi` (`datums`, `klienti_klientiID`, `maksajums_maksajumaID`, `maksajums_piegades_piegadesID`, `maksajums_produkts_porduktsID`, `maksajums_produkts_kategorijas_kategorijaID`) VALUES ('2023-01-01', '3', '3', '3', '3', '3');
INSERT INTO `veikals`.`pasutijumi` (`datums`, `klienti_klientiID`, `maksajums_maksajumaID`, `maksajums_piegades_piegadesID`, `maksajums_produkts_porduktsID`, `maksajums_produkts_kategorijas_kategorijaID`) VALUES ('2023-01-01', '4', '4', '4', '4', '4');

INSERT INTO `veikals`.`piegades` (`datums`, `klienti_klientiID`) VALUES ('2023-01-01', '1');
INSERT INTO `veikals`.`piegades` (`datums`, `klienti_klientiID`) VALUES ('2023-01-01', '2');
INSERT INTO `veikals`.`piegades` (`datums`, `klienti_klientiID`) VALUES ('2023-01-01', '3');
INSERT INTO `veikals`.`piegades` (`datums`, `klienti_klientiID`) VALUES ('2023-01-01', '4');

INSERT INTO `veikals`.`produkts` (`produktavards`, `kategorijas_kategorijaID`) VALUES ('Disks5Skr', '1');
INSERT INTO `veikals`.`produkts` (`produktavards`, `kategorijas_kategorijaID`) VALUES ('Disks4Skr', '2');
INSERT INTO `veikals`.`produkts` (`produktavards`, `kategorijas_kategorijaID`) VALUES ('DisksUniversal', '3');
INSERT INTO `veikals`.`produkts` (`produktavards`, `kategorijas_kategorijaID`) VALUES ('DiskuModelis', '4');

INSERT INTO `veikals`.`produkts_has_pardevejs` (`produkts_kategorijas_kategorijaID`, `pardevejs_pardevajaID`) VALUES ('1', '1');
INSERT INTO `veikals`.`produkts_has_pardevejs` (`produkts_kategorijas_kategorijaID`, `pardevejs_pardevajaID`) VALUES ('2', '2');
INSERT INTO `veikals`.`produkts_has_pardevejs` (`produkts_kategorijas_kategorijaID`, `pardevejs_pardevajaID`) VALUES ('3', '3');
INSERT INTO `veikals`.`produkts_has_pardevejs` (`produkts_kategorijas_kategorijaID`, `pardevejs_pardevajaID`) VALUES ('4', '4');

INSERT INTO `veikals`.`rekins` (`klienti_klientiID`, `datums`) VALUES ('1', '2023-01-01');
INSERT INTO `veikals`.`rekins` (`klienti_klientiID`, `datums`) VALUES ('2', '2023-01-01');
INSERT INTO `veikals`.`rekins` (`klienti_klientiID`, `datums`) VALUES ('3', '2023-01-01');
INSERT INTO `veikals`.`rekins` (`klienti_klientiID`, `datums`) VALUES ('4', '2023-01-01');

INSERT INTO `veikals`.`lietotajs` (`lietotajvards`, `parole`) VALUES ('admin', 'admin');
INSERT INTO `veikals`.`lietotajs` (`lietotajvards`, `parole`) VALUES ('admin1', 'admin1');
INSERT INTO `veikals`.`lietotajs` (`lietotajvards`, `parole`) VALUES ('admin2', 'admin2');
INSERT INTO `veikals`.`lietotajs` (`lietotajvards`, `parole`) VALUES ('admin3', 'admin3');






