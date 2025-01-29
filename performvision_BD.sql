CREATE TABLE utilisateur(
   id_utilisateur INT AUTO_INCREMENT,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   mail VARCHAR(100),
   password VARCHAR(50),
   telephone INT,
   PRIMARY KEY(id_utilisateur)
);

CREATE TABLE client(
   id_utilisateur INT,
   societe VARCHAR(50),
   PRIMARY KEY(id_utilisateur),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE formateur(
   id_utilisateur INT,
   linkedin VARCHAR(50),
   cv VARCHAR,
   date_signature DATE,
   signatureElectronique INT,
   tauxHoraire INT,
   PRIMARY KEY(id_utilisateur),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE admin(
   id_utilisateur INT,
   PRIMARY KEY(id_utilisateur),
   FOREIGN KEY(id_utilisateur) REFERENCES formateur(id_utilisateur)
);

CREATE TABLE discussion(
   id_utilisateur INT,
   id_discussion INT,
   PRIMARY KEY(id_utilisateur, id_discussion),
   FOREIGN KEY(id_utilisateur) REFERENCES client(id_utilisateur)
);

CREATE TABLE activite(
   id_activite INT,
   nom_activite VARCHAR(50),
   image Varchar,
   texte VARCHAR(8000),
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_activite),
   FOREIGN KEY(id_utilisateur) REFERENCES admin(id_utilisateur)
);

CREATE TABLE categorie(
   id_categorie INT,
   nomCategorie VARCHAR(50),
   valideCategorie VARCHAR,
   id_categorie_compsé INT,
   PRIMARY KEY(id_categorie),
   FOREIGN KEY(id_categorie_compsé) REFERENCES categorie(id_categorie)
);

CREATE TABLE theme(
   id_theme INT,
   nomTheme VARCHAR(50),
   valideTheme VARCHAR,
   id_categorie INT NOT NULL,
   PRIMARY KEY(id_theme),
   FOREIGN KEY(id_categorie) REFERENCES categorie(id_categorie)
);

CREATE TABLE public(
   id_public INT,
   libelleP VARCHAR(50),
   PRIMARY KEY(id_public)
);
CREATE TABLE message(
	   id_message INT,
	   texte VARCHAR(50),
	   dateHeure DATE,
	   valideM VARCHAR,
	   lu VARCHAR,
	   id_utilisateur INT,
	   id_utilisateur_1 INT,
       id_discussion INT,
	   PRIMARY KEY(id_message),
	   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur),
	   FOREIGN KEY(id_utilisateur_1, id_discussion) REFERENCES discussion(id_utilisateur, id_discussion)
	);

CREATE TABLE niveau(
   id_niveau INT,
   libelleNiveau VARCHAR(50),
   PRIMARY KEY(id_niveau)
);

CREATE TABLE moderateur(
   id_utilisateur_1 INT,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_utilisateur_1),
   FOREIGN KEY(id_utilisateur_1) REFERENCES formateur(id_utilisateur),
   FOREIGN KEY(id_utilisateur) REFERENCES admin(id_utilisateur)
);

CREATE TABLE affranchir(
   id_utilisateur INT,
   id_utilisateur_1 INT,
   PRIMARY KEY(id_utilisateur, id_utilisateur_1),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur),
   FOREIGN KEY(id_utilisateur_1) REFERENCES moderateur(id_utilisateur_1)
);

CREATE TABLE expertiseProfessionnelle(
   id_utilisateur INT,
   id_theme INT,
   dureeExperience INT,
   commentaire VARCHAR(50),
   id_Niveau INT,
   PRIMARY KEY(id_utilisateur, id_theme),
   FOREIGN KEY(id_utilisateur) REFERENCES formateur(id_utilisateur),
   FOREIGN KEY(id_theme) REFERENCES theme(id_theme)
);

CREATE TABLE experiencePedagogique(
   id_utilisateur INT,
   id_theme INT,
   id_public INT,
   volumeHorraireMoyenSession INT,
   nbSessionEffectuee INT,
   commentaire VARCHAR(50),
   PRIMARY KEY(id_utilisateur, id_theme, id_public),
   FOREIGN KEY(id_utilisateur) REFERENCES formateur(id_utilisateur),
   FOREIGN KEY(id_theme) REFERENCES theme(id_theme),
   FOREIGN KEY(id_public) REFERENCES public(id_public)
);

CREATE TABLE avec(
   id_utilisateur INT,
   id_utilisateur_1 INT,
   id_discussion INT,
   PRIMARY KEY(id_utilisateur, id_utilisateur_1, id_discussion),
   FOREIGN KEY(id_utilisateur) REFERENCES formateur(id_utilisateur),
   FOREIGN KEY(id_utilisateur_1, id_discussion) REFERENCES discussion(id_utilisateur, id_discussion)
);

insert into utilisateur (id_utilisateur, prenom, nom, mail, password, telephone) values 
(1,	'Alexandre',	null,	null,	'Alexandre',	606060606),
(2,	'Vital',  null,' vital.formation@gmail.com', 'Vital',	600000000),
(3,	'Slim', null, 'slim.formation@gmail.com',	'SLIM',	601010101),
(15,	'Amar',	'Boguate','Amar20.client@gmail.com','AMAR',	606060679),
(12,	'Charles','Meunier','Charles.Meunier@gmail.com', 'CHARLES',	600000540),
(4,'	Morad',	null,	'morad.formation@gmail.com', 'morad',	602020202),
(10,'zina','djema','zina@formation.com','ZINA',054987530);
;
insert into client (id_utilisateur, societe) values 
(15,'codePro'),
(12,'DevWeb');

insert into formateur (id_utilisateur, linkedin, cv, date_signature, signatureelectronique, tauxhoraire) values 
(1,	'Alexandre_Dace', null, null, null, null),
(2,	'Vital Maxime', null,	null, null,	null),
(3,	'Slim_performVision',	null, null,	null, null),
(10,null,null,null,null,null);
;

insert into admin (id_utilisateur) Values
(2),
(3)
;

insert into moderateur (id_utilisateur_1, id_utilisateur) values 
(2,	2),
(3,	3)
;

insert into categorie (id_categorie, nomcategorie, validecategorie, "id_categorie_compsé") values 
(1,	'Bases', 'True',  null),
(2,	'POO', 'True', null),
(3,	'Python', 'True', 1),
(4,	'Python', 'True', 2),
(5,	'C', 'True', 1),
(6,	'Bases_POO', 'True', null),
(7,	'C++',	'True', 6),
(8,	'WebForms',	'True',  null),
(9,	'WinForms', 'True', null), 
(10, 'C#', 'True', 8),
(11,	'C#',	'True', 9),
(16, 'NoSQL',	'True',  null),
(17, 'Bases_POO', 'True',  null),
(18, 'Hebernate',	'True' , null),
(19, 'SQL', 'True' , null),
(20, 'Pl/Pgsql',	'True' , null),
(21, 'administartion', 'True', null),
(13, 'PostGreSQL',	'True', 19),
(22,	'PostGreSQL',	'True', 20),
(12,	'PostGreSQL',	'True', 21),
(23,	'Java',	'True', 17),
(24,	'Java',	'True', 18),
(14,	'SQL Server', 'True', 19),
(25,	'Transac-SQL', 'True', null),
(26,	'Administration (Plan de maintenance...)', 'True',  null),
(27,	'Administration (Cluster de basculement, AlwaysOn)', 'True' , null),
(28,	'SQL Server',	'True', null),
(30,	'SQL Server',	'True', 26),
(29,	'SQL Server',	'True', 25),
(31,	'SQL Server',	'True', 27),
(15,	'Oracle',	'True', 19),
(32,	'PL/Sql',	'True', null),
(34,	'Oracl',	'True', 32),
(33,	'Administration (Gestion des tablespace..)', 'True', null),
(35,	'Oracl', 'True', 33)
;

insert into theme (id_theme, nomtheme, validetheme, id_categorie) values 
(1,	'Programmation',	'True',3),
(2,	'Programmation',	'True',4),
(3, 'Programmation',	'True',5),
(4, 'Programmation',	'True',7),
(5, 'Programmation',	'True',10),
(6,	'Programmation',	'True',11),
(7,	'Base de données', 'True', 13),
(8, 'Base de données', 'True', 14),
(9,	'Base de données', 'True', 15),
(10, 'Base de données', 'True', 16),
(11, 'Base de données', 'True', 19),
(12, 'Base de données', 	'True', 26),
(13, 'Base de données', 	'True', 25),
(14, 'Base de données', 	'True', 27),
(15, 'Base de données',  'True', 32),
(16, 'Base de données', 'True', 33),
(17, 'Base de données', 	'True', 20),
(18, 'Base de données', 	'True', 21),
(19, 'Programmation',	'True',17),
(20, 'Programmation',	'True',18),
(21, 'Base de données', 	'True', 19) 
;

insert into niveau (id_niveau, libelleniveau) values 
(1,	'expert'),
(2,	'avancé'),
(3,	'initié'),
(4,	'débutant'),
(5,	'confirmé'),
(6,	'intermédiaire')
;

insert into expertiseprofessionnelle (id_utilisateur, id_theme, dureeexperience, commentaire, id_niveau) values 
(1,	1,	10, null,1),
(1, 4, 10,	null,5)
;




--insert into activite (id_activite, nom_activite, image, texte, id_utilisateur) values ;
-- insert into affranchir (id_utilisateur, id_utilisateur_1) values 
--;

-- insert into avec (id_utilisateur, id_utilisateur_1, id_discussion) values 
-- ;


-- insert into client (id_utilisateur, societe) values ;

--insert into discussion (id_utilisateur, id_discussion) values ;

--insert into experiencepedagogique (id_utilisateur, id_theme, id_public, volumehorrairemoyensession, nbsessioneffectuee, commentaire) values ;


--insert into message (id_message, texte, dateheure, validem, lu, id_utilisateur, id_utilisateur_1, id_discussion) values ;



--insert into public (id_public, libellep) values ;





