SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

USE `cc409_gastosse` ;

-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Entidad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Entidad` (
  `id_entidad` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `apellido_paterno` VARCHAR(45) NULL ,
  `apellido_materno` VARCHAR(45) NULL ,
  `RFC` VARCHAR(13) NOT NULL ,
  PRIMARY KEY (`id_entidad`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Cliente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Cliente` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT ,
  `Entidad_id_entidad` INT NOT NULL ,
  `persona_fisica` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id_cliente`) ,
  INDEX `fk_Cliente_Entidad1_idx` (`Entidad_id_entidad` ASC) ,
  CONSTRAINT `fk_Cliente_Entidad1`
    FOREIGN KEY (`Entidad_id_entidad` )
    REFERENCES `cc409_gastosse`.`Entidad` (`id_entidad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Cuenta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Cuenta` (
  `id_cuenta` INT NOT NULL AUTO_INCREMENT ,
  `Cliente_id_cliente` INT NOT NULL ,
  `nombre_usuario` VARCHAR(30) NOT NULL ,
  `clave_acceso` VARCHAR(45) NOT NULL ,
  `admin` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id_cuenta`) ,
  INDEX `fk_Cuenta_Cliente1_idx` (`Cliente_id_cliente` ASC) ,
  CONSTRAINT `fk_Cuenta_Cliente1`
    FOREIGN KEY (`Cliente_id_cliente` )
    REFERENCES `cc409_gastosse`.`Cliente` (`id_cliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Contrato`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Contrato` (
  `id_contrato` INT NOT NULL AUTO_INCREMENT ,
  `Cuenta_id_cuenta` INT NOT NULL ,
  `Entidad_id_contacto` INT NOT NULL ,
  `fecha_contrato` DATE NOT NULL ,
  `periodo_fiscal` VARCHAR(45) NOT NULL ,
  `presupuesto` DECIMAL NULL ,
  `plazos` TINYINT(1) NOT NULL ,
  `renovacion` VARCHAR(45) NULL ,
  `saldado` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id_contrato`) ,
  INDEX `fk_Contrato_Cuenta1_idx` (`Cuenta_id_cuenta` ASC) ,
  INDEX `fk_Contrato_Entidad1_idx` (`Entidad_id_contacto` ASC) ,
  CONSTRAINT `fk_Contrato_Cuenta1`
    FOREIGN KEY (`Cuenta_id_cuenta` )
    REFERENCES `cc409_gastosse`.`Cuenta` (`id_cuenta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Contrato_Entidad1`
    FOREIGN KEY (`Entidad_id_contacto` )
    REFERENCES `cc409_gastosse`.`Entidad` (`id_entidad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Domicilio`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Domicilio` (
  `id_domicilio` INT NOT NULL AUTO_INCREMENT ,
  `calle` VARCHAR(45) NOT NULL ,
  `num_interior` INT NULL DEFAULT NULL ,
  `num_exterior` INT NULL DEFAULT NULL ,
  `colonia` VARCHAR(45) NOT NULL ,
  `codigo_postal` VARCHAR(45) NOT NULL ,
  `stado` VARCHAR(45) NOT NULL ,
  `municipio` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_domicilio`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Cuenta_Bancaria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Cuenta_Bancaria` (
  `id_cuenta_Bancaria` INT NOT NULL AUTO_INCREMENT ,
  `Entidad_id_entidad` INT NOT NULL ,
  `num_cuenta` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_cuenta_Bancaria`) ,
  INDEX `fk_Cuenta_Bancaria_Entidad1_idx` (`Entidad_id_entidad` ASC) ,
  CONSTRAINT `fk_Cuenta_Bancaria_Entidad1`
    FOREIGN KEY (`Entidad_id_entidad` )
    REFERENCES `cc409_gastosse`.`Entidad` (`id_entidad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Telefono`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Telefono` (
  `id_telefono` INT NOT NULL AUTO_INCREMENT ,
  `Entidad_id_entidad` INT NOT NULL ,
  `telefono` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_telefono`) ,
  INDEX `fk_Telefono_Entidad1_idx` (`Entidad_id_entidad` ASC) ,
  CONSTRAINT `fk_Telefono_Entidad1`
    FOREIGN KEY (`Entidad_id_entidad` )
    REFERENCES `cc409_gastosse`.`Entidad` (`id_entidad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Email`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Email` (
  `id_email` INT NOT NULL AUTO_INCREMENT ,
  `Entidad_id_entidad` INT NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_email`) ,
  INDEX `fk_Email_Entidad1_idx` (`Entidad_id_entidad` ASC) ,
  CONSTRAINT `fk_Email_Entidad1`
    FOREIGN KEY (`Entidad_id_entidad` )
    REFERENCES `cc409_gastosse`.`Entidad` (`id_entidad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Gasto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Gasto` (
  `id_gasto` INT NOT NULL AUTO_INCREMENT ,
  `Contrato_id_contrato` INT NOT NULL ,
  `costo` DECIMAL NOT NULL ,
  `precio` DECIMAL NOT NULL ,
  `comentario` VARCHAR(45) NOT NULL ,
  `categoria` VARCHAR(45) NOT NULL ,
  `cuenta_origen` VARCHAR(45) NULL ,
  `cuenta_destino` VARCHAR(45) NULL ,
  `comision` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_gasto`) ,
  INDEX `fk_Gasto_Contrato1_idx` (`Contrato_id_contrato` ASC) ,
  CONSTRAINT `fk_Gasto_Contrato1`
    FOREIGN KEY (`Contrato_id_contrato` )
    REFERENCES `cc409_gastosse`.`Contrato` (`id_contrato` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Modo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Modo` (
  `id_modo_pago` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_modo_pago`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Pago`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Pago` (
  `id_pago` INT NOT NULL AUTO_INCREMENT ,
  `Contrato_id_contrato` INT NOT NULL ,
  `monto` DECIMAL NOT NULL ,
  `fecha_pago` DATE NOT NULL ,
  PRIMARY KEY (`id_pago`) ,
  INDEX `fk_Pago_Contrato1_idx` (`Contrato_id_contrato` ASC) ,
  CONSTRAINT `fk_Pago_Contrato1`
    FOREIGN KEY (`Contrato_id_contrato` )
    REFERENCES `cc409_gastosse`.`Contrato` (`id_contrato` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Asunto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Asunto` (
  `id_asunto` INT NOT NULL AUTO_INCREMENT ,
  `asunto` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id_asunto`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Gasto_has_Modo_Pago`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Gasto_has_Modo_Pago` (
  `Gasto_id_gasto` INT NOT NULL ,
  `Modo_Pago_id_modo_pago` INT NOT NULL ,
  PRIMARY KEY (`Gasto_id_gasto`, `Modo_Pago_id_modo_pago`) ,
  INDEX `fk_Gasto_has_Modo_Pago_Modo_Pago1_idx` (`Modo_Pago_id_modo_pago` ASC) ,
  INDEX `fk_Gasto_has_Modo_Pago_Gasto1_idx` (`Gasto_id_gasto` ASC) ,
  CONSTRAINT `fk_Gasto_has_Modo_Pago_Gasto1`
    FOREIGN KEY (`Gasto_id_gasto` )
    REFERENCES `cc409_gastosse`.`Gasto` (`id_gasto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Gasto_has_Modo_Pago_Modo_Pago1`
    FOREIGN KEY (`Modo_Pago_id_modo_pago` )
    REFERENCES `cc409_gastosse`.`Modo` (`id_modo_pago` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Pago_has_Modo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Pago_has_Modo` (
  `Pago_id_pago` INT NOT NULL ,
  `Modo_id_modo_pago` INT NOT NULL ,
  PRIMARY KEY (`Pago_id_pago`, `Modo_id_modo_pago`) ,
  INDEX `fk_Pago_has_Modo_Modo1_idx` (`Modo_id_modo_pago` ASC) ,
  INDEX `fk_Pago_has_Modo_Pago1_idx` (`Pago_id_pago` ASC) ,
  CONSTRAINT `fk_Pago_has_Modo_Pago1`
    FOREIGN KEY (`Pago_id_pago` )
    REFERENCES `cc409_gastosse`.`Pago` (`id_pago` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pago_has_Modo_Modo1`
    FOREIGN KEY (`Modo_id_modo_pago` )
    REFERENCES `cc409_gastosse`.`Modo` (`id_modo_pago` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Contrato_has_Asunto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Contrato_has_Asunto` (
  `Contrato_id_contrato` INT NOT NULL ,
  `Asunto_id_asunto` INT NOT NULL ,
  `presupuestado` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`Contrato_id_contrato`, `Asunto_id_asunto`) ,
  INDEX `fk_Contrato_has_Asunto_Asunto1_idx` (`Asunto_id_asunto` ASC) ,
  INDEX `fk_Contrato_has_Asunto_Contrato1_idx` (`Contrato_id_contrato` ASC) ,
  CONSTRAINT `fk_Contrato_has_Asunto_Contrato1`
    FOREIGN KEY (`Contrato_id_contrato` )
    REFERENCES `cc409_gastosse`.`Contrato` (`id_contrato` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Contrato_has_Asunto_Asunto1`
    FOREIGN KEY (`Asunto_id_asunto` )
    REFERENCES `cc409_gastosse`.`Asunto` (`id_asunto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Entidad_has_Domicilio`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Entidad_has_Domicilio` (
  `Entidad_id_entidad` INT NOT NULL ,
  `Domicilio_id_domicilio` INT NOT NULL ,
  PRIMARY KEY (`Entidad_id_entidad`, `Domicilio_id_domicilio`) ,
  INDEX `fk_Entidad_has_Domicilio_Domicilio1_idx` (`Domicilio_id_domicilio` ASC) ,
  INDEX `fk_Entidad_has_Domicilio_Entidad1_idx` (`Entidad_id_entidad` ASC) ,
  CONSTRAINT `fk_Entidad_has_Domicilio_Entidad1`
    FOREIGN KEY (`Entidad_id_entidad` )
    REFERENCES `cc409_gastosse`.`Entidad` (`id_entidad` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Entidad_has_Domicilio_Domicilio1`
    FOREIGN KEY (`Domicilio_id_domicilio` )
    REFERENCES `cc409_gastosse`.`Domicilio` (`id_domicilio` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Banco`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Banco` (
  `id_banco` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_banco`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cc409_gastosse`.`Cuenta_Bancaria_has_Banco`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `cc409_gastosse`.`Cuenta_Bancaria_has_Banco` (
  `Cuenta_Bancaria_id_cuenta_Bancaria` INT NOT NULL ,
  `Banco_id_banco` INT NOT NULL ,
  PRIMARY KEY (`Cuenta_Bancaria_id_cuenta_Bancaria`, `Banco_id_banco`) ,
  INDEX `fk_Cuenta_Bancaria_has_Banco_Banco1_idx` (`Banco_id_banco` ASC) ,
  INDEX `fk_Cuenta_Bancaria_has_Banco_Cuenta_Bancaria1_idx` (`Cuenta_Bancaria_id_cuenta_Bancaria` ASC) ,
  CONSTRAINT `fk_Cuenta_Bancaria_has_Banco_Cuenta_Bancaria1`
    FOREIGN KEY (`Cuenta_Bancaria_id_cuenta_Bancaria` )
    REFERENCES `cc409_gastosse`.`Cuenta_Bancaria` (`id_cuenta_Bancaria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cuenta_Bancaria_has_Banco_Banco1`
    FOREIGN KEY (`Banco_id_banco` )
    REFERENCES `cc409_gastosse`.`Banco` (`id_banco` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `cc409_gastosse` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
