-- Adminer 4.8.1 MySQL 11.4.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `AppartientAuxDepartement`;
CREATE TABLE `AppartientAuxDepartement` (
                                            `idPersonne` int(11) NOT NULL,
                                            `idDepartement` int(11) NOT NULL,
                                            PRIMARY KEY (`idPersonne`,`idDepartement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `AppartientAuxDepartement` (`idPersonne`, `idDepartement`) VALUES
                                                                           (1,	1),
                                                                           (2,	2),
                                                                           (3,	3),
                                                                           (4,	4),
                                                                           (5,	5),
                                                                           (6,	6),
                                                                           (7,	7),
                                                                           (8,	8),
                                                                           (9,	9),
                                                                           (10,	10),
                                                                           (11,	1),
                                                                           (12,	2),
                                                                           (13,	3),
                                                                           (14,	4),
                                                                           (15,	5),
                                                                           (16,	6),
                                                                           (17,	7),
                                                                           (18,	8),
                                                                           (19,	9),
                                                                           (20,	10),
                                                                           (21,	11),
                                                                           (22,	11),
                                                                           (23,	11);

DROP TABLE IF EXISTS `Département`;
CREATE TABLE `Département` (
                               `id` int(11) NOT NULL AUTO_INCREMENT,
                               `nom` varchar(50) NOT NULL,
                               `etagePrincipale` int(11) NOT NULL,
                               `description` text NOT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `Département` (`id`, `nom`, `etagePrincipale`, `description`) VALUES
                                                                              (1,	'Informatique',	3,	'Département responsable du développement des logiciels et de la gestion des systèmes informatiques.'),
                                                                              (2,	'Ressources Humaines',	2,	'Département chargé du recrutement, de la formation et de la gestion du personnel.'),
                                                                              (3,	'Marketing',	4,	'Département en charge de la promotion et de la publicité des produits.'),
                                                                              (4,	'Finance',	5,	'Département responsable de la gestion financière de l\'entreprise.'),
(5,	'Logistique',	1,	'Département en charge de la gestion des stocks et de la distribution des produits.'),
(6,	'Ventes',	4,	'Département responsable des ventes et de la relation client.'),
(7,	'Support Technique',	2,	'Département fournissant une assistance technique aux clients.'),
(8,	'Recherche et Développement',	6,	'Département en charge de l\'innovation et du développement de nouveaux produits.'),
                                                                              (9,	'Production',	7,	'Département responsable de la fabrication des produits.'),
                                                                              (10,	'Administration',	1,	'Département en charge des tâches administratives et de la gestion quotidienne.'),
                                                                              (11,	'Direction',	8,	'Département de la haute direction, responsable de la prise de décisions stratégiques.');

DROP TABLE IF EXISTS `Personne`;
CREATE TABLE `Personne` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `Nom` varchar(100) NOT NULL,
                            `Prenom` varchar(100) NOT NULL,
                            `email` varchar(100) NOT NULL,
                            `NuméroTelephone` varchar(100) NOT NULL,
                            `NuméroTelephoneBureau` varchar(100) NOT NULL,
                            `Fonction` varchar(100) NOT NULL,
                            `image` varchar(100) NOT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `Personne` (`id`, `Nom`, `Prenom`, `email`, `NuméroTelephone`, `NuméroTelephoneBureau`, `Fonction`, `image`) VALUES
                                                                                                                             (1,	'Docteur',	'Vegapunk',	'OnePiece@roger.com',	'0601020304',	'0140203040',	'Développeur',	'vegapunk.png'),
                                                                                                                             (2,	'Ketchum',	'Sacha',	'LigueChamp@kanto.com',	'0605060708',	'0140506070',	'Recruteur',	'sacha.png'),
                                                                                                                             (3,	'Agent',	'47',	'mission00@assassin.com',	'0608091011',	'0140809100',	'Responsable Marketing',	'hitman.png'),
                                                                                                                             (4,	'Duck',	'Picsou',	'rat-daim@pognon.com',	'0603030303',	'0140303030',	'Analyste Financier',	'picsou.png'),
                                                                                                                             (5,	'White',	'Walter',	'MyName@poudre.com',	'0604040404',	'0140404040',	'Gestionnaire de Stock',	'walter.png'),
                                                                                                                             (6,	'Grise-Toison',	'Eorlund',	'DieuSoisLoué@bordeciel.com',	'0605050505',	'0140505050',	'Responsable des Ventes',	'skyrim.png'),
                                                                                                                             (7,	'Docteur',	'Hegman',	'Sanic@perdant.com',	'0606060606',	'0140606060',	'Technicien Support',	'hegman.png'),
                                                                                                                             (8,	'NoName',	'Steve',	'fullD@wordl.com',	'0607070707',	'0140707070',	'Chercheur',	'steve.png'),
                                                                                                                             (9,	'Vi Britannia',	'Lelouch',	'BestUserOfGeass@empereur.com',	'0608080808',	'0140808080',	'Chef de Production',	'lelouch.png'),
                                                                                                                             (10,	'NewLeaf',	'Marie',	'pasdidée@example.com',	'0609090909',	'0140909090',	'Secrétaire',	'marie.png'),
                                                                                                                             (11,	'Gordon',	'Freeman',	'muteSound@science.com',	'0610101010',	'0140101010',	'Développeur',	'freeman.png'),
                                                                                                                             (12,	'Hedghog',	'Sonic',	'MieuxQueMario@herisson.com',	'0611111111',	'0141111111',	'Recruteur',	'sonic.png'),
                                                                                                                             (13,	'Solid',	'Snake',	'SNAAAAAAAAKE@mission.com',	'0612121212',	'0142121212',	'Responsable Marketing',	'snake.png'),
                                                                                                                             (14,	'Ruel',	'Stroud',	'fauxPauvre@kamas.com',	'0613131313',	'0143131313',	'Analyste Financier',	'stroud.png'),
                                                                                                                             (15,	'Hero of Time',	'Link',	'ehya@zelda.com',	'0614141414',	'0144141414',	'Gestionnaire de Stock',	'link.png'),
                                                                                                                             (16,	'ThGod',	'Kratos',	'GodSlayer@Olympe.com',	'0615151515',	'0145151515',	'Responsable des Ventes',	'kratos.png'),
                                                                                                                             (17,	'Aran',	'Samus',	'FalseRobote@SSBU.com',	'0616161616',	'0146161616',	'Technicien Support',	'samus.png'),
                                                                                                                             (18,	'Drake',	'Nathan',	'nicolas.renaud@example.com',	'0617171717',	'0147171717',	'Chercheur',	'nathan.jpg'),
                                                                                                                             (19,	'Vegeta',	'Bulma',	'RenneDesSayanEtDeLaScience@dbz.com',	'0618181818',	'0148181818',	'Chef de Production',	'bulma.png'),
                                                                                                                             (20,	'II',	'Terminator',	'SarahConnor@JudgementDay.com',	'0619191919',	'0149191919',	'Secrétaire',	'terminator.png'),
                                                                                                                             (21,	'Becker',	'Doryann',	'crafteur55100-verdun@hotmail.com',	'0783722613',	'0000000000',	'CEO',	'doryann.png'),
                                                                                                                             (22,	'Formet',	'Romain',	'romain.formet@gmail.com',	'0677509018',	'0000000000',	'Gros Bg',	'romain.png'),
                                                                                                                             (23,	'Durand',	'Quentin',	'quentindurand04@gmail.com',	'0623736043',	'0000000000',	'Casseur de Git',	'quentin.png');

DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `email` varchar(70) NOT NULL,
                        `password` varchar(70) NOT NULL,
                        `role` int(11) NOT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `User` (`id`, `email`, `password`, `role`) VALUES
                                                           (2,	'doryann@hotmail.com',	'$2y$10$M36GruGi0rq9gDUx5BkIiO7dWzlm/b/4HdjDzuzOxFIXW8AcsDT4K',	1),
                                                           (3,	'SuperAdmin@admin.fr',	'$2y$10$FKXt/DTdhU9cV5pOVJ.xseyvi14oXU7T5MTXu5.Zj1zWJHgsfbdZC',	100);

-- 2024-06-14 09:05:35