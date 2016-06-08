ALTER TABLE `baseball`.`drivertool` 
ADD COLUMN `travelCost` DOUBLE NOT NULL DEFAULT 0 AFTER `isTookHisCar`;

ALTER TABLE `baseball`.`equipe` 
DROP FOREIGN KEY `equipe_ibfk_1`;
ALTER TABLE `baseball`.`equipe` 
DROP COLUMN `id_division`,
ADD COLUMN `adresse` VARCHAR(250) NULL AFTER `active`,
ADD COLUMN `adresse_numero` INT NULL AFTER `adresse`,
ADD COLUMN `code_postal` INT NULL AFTER `adresse_numero`,
ADD COLUMN `ville` VARCHAR(45) NULL AFTER `code_postal`,
DROP INDEX `id_division` ;
