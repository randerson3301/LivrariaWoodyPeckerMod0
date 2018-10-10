-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema db_woody_woodpecker
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_woody_woodpecker
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_woody_woodpecker` DEFAULT CHARACTER SET utf8 ;
USE `db_woody_woodpecker` ;

-- -----------------------------------------------------
-- Table `db_woody_woodpecker`.`tbl_autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_woody_woodpecker`.`tbl_autor` (
  `idAutor` INT(11) NOT NULL,
  `nome` VARCHAR(90) NOT NULL,
  `dtFalecimento` DATE NULL DEFAULT NULL,
  `dtNascimento` DATE NOT NULL,
  `cidadeNascimento` VARCHAR(100) NOT NULL,
  `breveBiografia` TEXT NOT NULL,
  `autorEmDestaque` TINYINT(1) NULL DEFAULT NULL,
  `imgAutor` VARCHAR(45) NULL DEFAULT NULL,
  `isAtivado` TINYINT(4) NOT NULL,
  PRIMARY KEY (`idAutor`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_woody_woodpecker`.`tbl_editora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_woody_woodpecker`.`tbl_editora` (
  `cnpjEditora` VARCHAR(14) NOT NULL,
  `razaoSocial` VARCHAR(50) NOT NULL,
  `nomeFantasia` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`cnpjEditora`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_woody_woodpecker`.`tbl_livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_woody_woodpecker`.`tbl_livro` (
  `isbn` VARCHAR(20) NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `numeroPaginas` INT(11) NOT NULL,
  `anoPublicacao` YEAR NOT NULL,
  `edicao` VARCHAR(2) NOT NULL,
  `volume` VARCHAR(2) NOT NULL,
  `livroEmDestaque` TINYINT(1) NOT NULL,
  `preco` DECIMAL(4,2) NOT NULL,
  `imgLivro` VARCHAR(45) NOT NULL,
  `descricao` TEXT NOT NULL,
  `isAtivado` TINYINT(4) NOT NULL,
  `cnpjEditora` VARCHAR(14) NOT NULL,
  PRIMARY KEY (`isbn`),
  INDEX `fk_tbl_livro_tbl_editora1_idx` (`cnpjEditora` ASC),
  CONSTRAINT `fk_tbl_livro_tbl_editora`
    FOREIGN KEY (`cnpjEditora`)
    REFERENCES `db_woody_woodpecker`.`tbl_editora` (`cnpjEditora`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_woody_woodpecker`.`tbl_autor_livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_woody_woodpecker`.`tbl_autor_livros` (
  `id` INT(11) NOT NULL,
  `isbn` VARCHAR(20) NOT NULL,
  `idAutor` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_autor_livros_tbl_livro1_idx` (`isbn` ASC),
  INDEX `fk_tbl_autor_idAutor_idx` (`idAutor` ASC),
  CONSTRAINT `fk_tbl_autor_livros_tbl_livro1`
    FOREIGN KEY (`isbn`)
    REFERENCES `db_woody_woodpecker`.`tbl_livro` (`isbn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_autor_idAutor`
    FOREIGN KEY (`idAutor`)
    REFERENCES `db_woody_woodpecker`.`tbl_autor` (`idAutor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_woody_woodpecker`.`tbl_lojas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_woody_woodpecker`.`tbl_lojas` (
  `idLoja` INT(11) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `descricao` TEXT NOT NULL,
  `imgLoja` VARCHAR(45) NOT NULL,
  `isAtivado` TINYINT(4) NOT NULL,
  PRIMARY KEY (`idLoja`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_woody_woodpecker`.`tbl_endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_woody_woodpecker`.`tbl_endereco` (
  `id` INT(11) NOT NULL,
  `logradouro` VARCHAR(25) NOT NULL,
  `bairro` VARCHAR(45) NOT NULL,
  `cidade` VARCHAR(95) NOT NULL,
  `uf` VARCHAR(2) NOT NULL,
  `cep` VARCHAR(8) NOT NULL,
  `telefone` VARCHAR(16) NOT NULL,
  `cnpjEditora` VARCHAR(14) NOT NULL,
  `idLoja` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_endereco_tbl_editora1_idx` (`cnpjEditora` ASC),
  INDEX `fk_tbl_endereco_tbl_lojas1_idx` (`idLoja` ASC),
  CONSTRAINT `fk_tbl_endereco_tbl_editora1`
    FOREIGN KEY (`cnpjEditora`)
    REFERENCES `db_woody_woodpecker`.`tbl_editora` (`cnpjEditora`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_endereco_tbl_lojas1`
    FOREIGN KEY (`idLoja`)
    REFERENCES `db_woody_woodpecker`.`tbl_lojas` (`idLoja`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_woody_woodpecker`.`tbl_fale_conosco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_woody_woodpecker`.`tbl_fale_conosco` (
  `id` INT(11) NOT NULL,
  `nomeContato` VARCHAR(90) NOT NULL,
  `sexoContato` VARCHAR(2) NOT NULL,
  `profissao` VARCHAR(45) NOT NULL,
  `celular` VARCHAR(11) NOT NULL,
  `telefone` VARCHAR(10) NULL DEFAULT NULL,
  `homePage` VARCHAR(45) NULL DEFAULT NULL,
  `infoProduto` TEXT NULL DEFAULT NULL,
  `critica_ou_sugestao` TEXT NULL DEFAULT NULL,
  `emailContato` VARCHAR(100) NOT NULL,
  `contaFacebook` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_woody_woodpecker`.`tbl_livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_woody_woodpecker`.`tbl_livros` (
  `isbn` VARCHAR(14) NOT NULL,
  `titulo` VARCHAR(50) NOT NULL,
  `descricao` TEXT NOT NULL,
  `imgCapa` VARCHAR(30) NOT NULL,
  `numeroPaginas` INT(11) NOT NULL,
  `anoPublicacao` YEAR NOT NULL,
  `edicao` VARCHAR(2) NOT NULL,
  `volume` VARCHAR(2) NOT NULL,
  `tbl_editora_cnpjEditora` VARCHAR(14) NOT NULL,
  `livroEmDestaque` TINYINT(1) NOT NULL,
  `tbl_promocao_id` INT(11) NOT NULL,
  PRIMARY KEY (`isbn`),
  INDEX `fk_tbl_livros_tbl_editora1_idx` (`tbl_editora_cnpjEditora` ASC),
  CONSTRAINT `fk_tbl_livros_tbl_editora1`
    FOREIGN KEY (`tbl_editora_cnpjEditora`)
    REFERENCES `db_woody_woodpecker`.`tbl_editora` (`cnpjEditora`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_woody_woodpecker`.`tbl_nivel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_woody_woodpecker`.`tbl_nivel` (
  `idNivel` INT(11) NOT NULL AUTO_INCREMENT,
  `nomeNivel` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idNivel`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_woody_woodpecker`.`tbl_promocao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_woody_woodpecker`.`tbl_promocao` (
  `id` INT(11) NOT NULL,
  `percentualDesconto` DECIMAL(2,1) NOT NULL,
  `isbn` VARCHAR(14) NOT NULL,
  `isAtivado` TINYINT(4) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `isbn_idx` (`isbn` ASC),
  CONSTRAINT `isbn`
    FOREIGN KEY (`isbn`)
    REFERENCES `db_woody_woodpecker`.`tbl_livro` (`isbn`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_woody_woodpecker`.`tbl_sobre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_woody_woodpecker`.`tbl_sobre` (
  `id` INT(11) NOT NULL,
  `descricao` TEXT NOT NULL,
  `imgSobre` VARCHAR(45) NOT NULL,
  `isAtivado` TINYINT(4) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_woody_woodpecker`.`tbl_usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_woody_woodpecker`.`tbl_usuarios` (
  `matricula` INT(11) NOT NULL,
  `nomeUsuario` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(40) NOT NULL,
  `emailUsuario` VARCHAR(100) NOT NULL,
  `loginNome` VARCHAR(100) NOT NULL,
  `isAtivado` TINYINT(4) NOT NULL,
  `idNivel` INT(11) NOT NULL,
  PRIMARY KEY (`matricula`),
  INDEX `fk_tbl_usuarios_tbl_nivel1_idx` (`idNivel` ASC),
  CONSTRAINT `fk_tbl_usuarios_tbl_nivel1`
    FOREIGN KEY (`idNivel`)
    REFERENCES `db_woody_woodpecker`.`tbl_nivel` (`idNivel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_woody_woodpecker`.`tbl_slider`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_woody_woodpecker`.`tbl_slider` (
  `idSlider` INT NOT NULL,
  `imgSlider` VARCHAR(100) NOT NULL,
  `isAtivado` TINYINT NOT NULL,
  PRIMARY KEY (`idSlider`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
