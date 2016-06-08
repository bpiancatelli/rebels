/*Forum :

Dossier
|--Thematique
   |--Sujet
      |--Message


Dossier :
- Général
	Thematique : 
	- FAQ
		Sujet :
		Utilisation du site
			Message :
			<content>
- Comité

Admin : 
	Crée : 
		Dossier
		Thematique
		Sujet
		Message
	Modifie : 
		Dossier
		Thematique
		Sujet
		Message
	Supprimer :
		Dossier
		Thematique
		Sujet
		Message
Comité : 
	Crée : 
		Thematique
		Sujet
		Message
	Modifie : 
		Thematique
		Sujet
		Message
	Supprimer :
		Thematique
		Sujet
		Message
Autre : 
	Crée : 
		Message
	Modifie : 
		Message
	Supprimer :
		Message
	

*/

drop table if exists `forum_dossier`;
drop table if exists `forum_thematique`;
drop table if exists `forum_sujet`;
drop table if exists `forum_message`;

create table `forum_dossier` (
	`id_forum_dossier` int(11) NOT NULL AUTO_INCREMENT,
	`nom_dossier` varchar(50) NOT NULL,		-- Général / Comité / etc.
	PRIMARY KEY (`id_forum_dossier`),
	UNIQUE KEY `id_forum_dossier_UNIQUE` (`id_forum_dossier`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

create table `forum_thematique` (
	`id_forum_thematique` int(11) NOT NULL AUTO_INCREMENT,
	`nom_thematique` varchar(255) NOT NULL, 	-- FAQ / etc.
	`id_forum_dossier` int(11) NOT NULL,
	`sujet` int(11) NOT NULL DEFAULT 0, 		-- nombre de sujet
	`reponse` int(11) NOT NULL DEFAULT 0, 		-- nombre de réponse
	`isLocked` tinyint(1) NOT NULL DEFAULT 0, 	-- thematique ferme ?
	CONSTRAINT `forum_dossier` FOREIGN KEY (`id_forum_dossier`) REFERENCES `forum_dossier` (`id_forum_dossier`),
	PRIMARY KEY (`id_forum_thematique`),
	UNIQUE KEY `id_forum_thematique_UNIQUE` (`id_forum_thematique`)
)  ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

create table `forum_sujet` (
	`id_forum_sujet` int(11) NOT NULL AUTO_INCREMENT,
	`nom_sujet` varchar(255) NOT NULL, 		-- titre du sujet
	`sujet` varchar(255) NOT NULL, 			-- contenu du sujet
	`id_forum_thematique` int(11) NOT NULL,
	`id_membre` int(11) NOT NULL,
	`date_creation` DATE NOT NULL,
	`reponse` int(11) NOT NULL DEFAULT 0,		-- nombre de reponse
	`isLocked` tinyint(1) NOT NULL DEFAULT 0,	-- sujet ferme ?
	`isImportant` tinyint(1) NOT NULL DEFAULT 0,	-- if 1 -> mettre en premier
	CONSTRAINT `forum_thematique` FOREIGN KEY (`id_forum_thematique`) REFERENCES `forum_thematique` (`id_forum_thematique`),
	CONSTRAINT `sujet_createur` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`),
	PRIMARY KEY (`id_forum_sujet`),
	UNIQUE KEY `id_forum_sujet_UNIQUE` (`id_forum_sujet`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

create table `forum_message` (
	`id_forum_message` int(11) NOT NULL AUTO_INCREMENT,
	`nom_message` varchar(255) NOT NULL,		-- nom du message
	`message` varchar(255) NOT NULL,		-- contenu du message
	`id_forum_sujet` int(11) NOT NULL,
	`id_membre` int(11) NOT NULL,
	`date_creation` DATE NOT NULL,
	CONSTRAINT `forum_sujet` FOREIGN KEY (`id_forum_sujet`) REFERENCES `forum_sujet` (`id_forum_sujet`),
	CONSTRAINT `message_createur` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`),
	PRIMARY KEY (`id_forum_message`),
	UNIQUE KEY `id_forum_message_UNIQUE` (`id_forum_message`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;   
      

