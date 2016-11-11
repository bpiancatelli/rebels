CREATE SCHEMA `baseball`;


CREATE TABLE `baseball`.`division` (
  `id_division` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id_division`),
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC));

CREATE TABLE `baseball`.`equipe` (
  `id_equipe` INT NOT NULL AUTO_INCREMENT,
  `nom_long` VARCHAR(250) NOT NULL,
  `nom_court` VARCHAR(45) NOT NULL,
  `logo` VARCHAR(45) NULL,
  `is_active` VARCHAR(1) NOT NULL DEFAULT '1',
  `adresse` VARCHAR(250) NULL,
  `adresse_numero` INT NULL,
  `code_postal` INT NULL,
  `ville` VARCHAR(250) NULL,
  PRIMARY KEY (`id_equipe`),
  UNIQUE INDEX `nom_long_UNIQUE` (`nom_long` ASC));

CREATE TABLE `baseball`.`match` (
  `id_match` INT NOT NULL AUTO_INCREMENT,
  `id_division` INT NOT NULL,
  `id_adversaire` INT NOT NULL,
  `date_match` DATETIME NOT NULL,
  `reference` VARCHAR(45) NULL,
  `is_domicile` VARCHAR(1) NOT NULL DEFAULT '1',
  `score_home` INT NOT NULL DEFAULT 0,
  `score_away` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_match`),
  FOREIGN KEY (`id_division`) REFERENCES division (`id_division`),
  FOREIGN KEY (`id_adversaire`) REFERENCES equipe (`id_equipe`),
  UNIQUE INDEX `reference_UNIQUE` (`reference` ASC));

CREATE TABLE `baseball`.`membre` (
  `id_membre` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(250) NOT NULL,
  `prenom` VARCHAR(250) NOT NULL,
  `email` VARCHAR(250) NULL,
  `licence` VARCHAR(45) NULL,
  `login` VARCHAR(250) NOT NULL,
  `password` VARCHAR(250) NOT NULL,
  `date_inscription` DATETIME NULL,
  `derniere_connexion` DATETIME NULL,
  `is_actif` VARCHAR(1) NOT NULL DEFAULT '1',
  `is_administrateur` VARCHAR(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_membre`));

CREATE TABLE `baseball`.`match_membre` (
  `id_match_membre` INT NOT NULL AUTO_INCREMENT,
  `id_membre` INT NOT NULL,
  `id_match` INT NOT NULL,
  pa INT NOT NULL DEFAULT 0,
  ab INT NOT NULL DEFAULT 0,
  hit INT NOT NULL DEFAULT 0,
  simplehit INT NOT NULL DEFAULT 0,
  doublehit INT NOT NULL DEFAULT 0,
  triplehit INT NOT NULL DEFAULT 0,
  hr INT NOT NULL DEFAULT 0,
  roe INT NOT NULL DEFAULT 0,
  hbp INT NOT NULL DEFAULT 0,
  gofo INT NOT NULL DEFAULT 0,
  sac INT NOT NULL DEFAULT 0,
  bb INT NOT NULL DEFAULT 0,
  k INT NOT NULL DEFAULT 0,
  rbi INT NOT NULL DEFAULT 0,
  runs INT NOT NULL DEFAULT 0,
  sb INT NOT NULL DEFAULT 0,
  cs INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_match_membre`),
  FOREIGN KEY (`id_membre`) REFERENCES membre (`id_membre`),
  FOREIGN KEY (`id_match`) REFERENCES `match` (`id_match`)
);

CREATE TABLE `baseball`.`drivertool` (
  `id_driver_tool` INT NOT NULL AUTO_INCREMENT,  
  `id_match` INT NOT NULL,
  `id_membre` INT NOT NULL,
   tookhiscar VARCHAR(1) DEFAULT '0',
   travelcost double default 0.0, 
  PRIMARY KEY (`id_driver_tool`),
  FOREIGN KEY (`id_membre`) REFERENCES membre (`id_membre`),
  FOREIGN KEY (`id_match`) REFERENCES `match` (`id_match`)
);


insert into membre (nom, prenom, login, password, is_actif, is_administrateur)
  values ('Piancatelli','Benoit','bpiancatelli', md5('t'),'1','1');


select * from membre;

insert into division (nom) values ('Division 1');

insert into equipe (nom_long, nom_court)
values 
('Beveren Lions','Lions'),
('Brasschaat Braves','Braves'),
('Hoboken Pioneers','Pioneers'),
('K. Borgerhout Squirrels','Squirrels'),
('K. Deurne Spartans','Spartans'),
('K. Mortsel Stars','Stars'),
('Louvain La Neuve Phoenix','Phoenix'),
('Royal Greys','Greys'),
('Braine Black Rickers','Rickers'),
('Brussels Kangaroos','Kangaroos'),
('Liege Rebel Foxes','Rebel Foxes'),
('Namur Angels','Angels'),
('R. Antwerp Eagles','Eagles'),
('The Merchtem Cats','Cats'),
('Wielsbeke Pitbulls','Pitbulls'),
('Zonhoven Sunville Tigers','Tigers'),
('Frameries Atletics','Atletics'),
('Gent Knights','Knights'),
('Leuven Twins','Twins'),
('Oudenaarde Frogs','Frogs'),
('Zottegem Bebops','Bebops'),
('Andenne Black Bears','Black Bears'),
('Frontliners Poperige','Frontliners'),
('Seraing Brown Boys','Brown Boys'),
('Tournai Celtics','Celtics');