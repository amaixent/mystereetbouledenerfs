-- -----------------------------------------------------
-- Schema site_enigme
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `site_enigme` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `site_enigme` ;

-- -----------------------------------------------------
-- Table `site_enigme`.`enigme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_enigme`.`enigme` (
  `id_enigme` INT NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(255) NULL,
  `enonce` TEXT NULL,
  `image` VARCHAR(100) NULL,
  `reponse` VARCHAR(100) NULL,
  `point` INT(10) NULL,
  `num_enigme` VARCHAR(45) NULL,
  `auteur_id` INT NULL,
  PRIMARY KEY (`id_enigme`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `site_enigme`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_enigme`.`user` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `nom_user` VARCHAR(45) NOT NULL,
  `mdp_user` VARCHAR(32) NOT NULL,
  `mail` VARCHAR(100) NULL,
  `statut` VARCHAR(45) NOT NULL,
  `point_user` INT(10) NULL,
  `idEnigme` INT NULL,
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `site_enigme`.`indice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_enigme`.`indice` (
  `id_indice` INT NOT NULL AUTO_INCREMENT,
  `num_indice` INT(10) NULL,
  `prix` INT(10) NULL,
  `enonce` TEXT NULL,
  `idEnigme` INT NOT NULL,
  PRIMARY KEY (`id_indice`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `site_enigme`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_enigme`.`message` (
  `id_message` INT NOT NULL AUTO_INCREMENT,
  `objet` VARCHAR(100) NULL,
  `destinataire` VARCHAR(45) NULL,
  `expediteur` VARCHAR(45) NULL,
  `texte` TEXT NULL,
  `date` DATETIME NULL,
  `lu` TINYINT(1) NULL,
  `image` VARCHAR(45) NULL,
  `idUser` INT NOT NULL,
  PRIMARY KEY (`id_message`))
ENGINE = InnoDB;