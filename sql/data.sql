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
                                                                                                                             (1,	'Dupont',	'Jean',	'jean.dupont@example.com',	'0601020304',	'0140203040',	'Développeur',	'image1.jpg'),
                                                                                                                             (2,	'Martin',	'Marie',	'marie.martin@example.com',	'0605060708',	'0140506070',	'Recruteur',	'image2.jpg'),
                                                                                                                             (3,	'Durand',	'Pierre',	'pierre.durand@example.com',	'0608091011',	'0140809100',	'Responsable Marketing',	'image3.jpg'),
                                                                                                                             (4,	'Bernard',	'Luc',	'luc.bernard@example.com',	'0603030303',	'0140303030',	'Analyste Financier',	'image4.jpg'),
                                                                                                                             (5,	'Petit',	'Sophie',	'sophie.petit@example.com',	'0604040404',	'0140404040',	'Gestionnaire de Stock',	'image5.jpg'),
                                                                                                                             (6,	'Moreau',	'Claire',	'claire.moreau@example.com',	'0605050505',	'0140505050',	'Responsable des Ventes',	'image6.jpg'),
                                                                                                                             (7,	'Fournier',	'Louis',	'louis.fournier@example.com',	'0606060606',	'0140606060',	'Technicien Support',	'image7.jpg'),
                                                                                                                             (8,	'Rousseau',	'Anne',	'anne.rousseau@example.com',	'0607070707',	'0140707070',	'Chercheur',	'image8.jpg'),
                                                                                                                             (9,	'Girard',	'Paul',	'paul.girard@example.com',	'0608080808',	'0140808080',	'Chef de Production',	'image9.jpg'),
                                                                                                                             (10,	'Gauthier',	'Emma',	'emma.gauthier@example.com',	'0609090909',	'0140909090',	'Secrétaire',	'image10.jpg'),
                                                                                                                             (11,	'Lefevre',	'Chloe',	'chloe.lefevre@example.com',	'0610101010',	'0140101010',	'Développeur',	'image11.jpg'),
                                                                                                                             (12,	'David',	'Lucas',	'lucas.david@example.com',	'0611111111',	'0141111111',	'Recruteur',	'image12.jpg'),
                                                                                                                             (13,	'Robert',	'Julie',	'julie.robert@example.com',	'0612121212',	'0142121212',	'Responsable Marketing',	'image13.jpg'),
                                                                                                                             (14,	'Richard',	'Antoine',	'antoine.richard@example.com',	'0613131313',	'0143131313',	'Analyste Financier',	'image14.jpg'),
                                                                                                                             (15,	'Simon',	'Alice',	'alice.simon@example.com',	'0614141414',	'0144141414',	'Gestionnaire de Stock',	'image15.jpg'),
                                                                                                                             (16,	'Michel',	'Thomas',	'thomas.michel@example.com',	'0615151515',	'0145151515',	'Responsable des Ventes',	'image16.jpg'),
                                                                                                                             (17,	'Leroy',	'Margaux',	'margaux.leroy@example.com',	'0616161616',	'0146161616',	'Technicien Support',	'image17.jpg'),
                                                                                                                             (18,	'Renaud',	'Nicolas',	'nicolas.renaud@example.com',	'0617171717',	'0147171717',	'Chercheur',	'image18.jpg'),
                                                                                                                             (19,	'Marchand',	'Sarah',	'sarah.marchand@example.com',	'0618181818',	'0148181818',	'Chef de Production',	'image19.jpg'),
                                                                                                                             (20,	'Dufour',	'Elodie',	'elodie.dufour@example.com',	'0619191919',	'0149191919',	'Secrétaire',	'image20.jpg'),
                                                                                                                             (21,	'Becker',	'Doryann',	'crafteur55100-verdun@hotmail.com',	'0783722613',	'0000000000',	'Karatéka dangereux',	'image1.jpg'),
                                                                                                                             (22,	'Formet',	'Romain',	'romain.formet@gmail.com',	'0677509018',	'0000000000',	'Gros Bg',	'image2.jpg'),
                                                                                                                             (23,	'Durand',	'Quentin',	'quentindurand04@gmail.com',	'0623736043',	'0000000000',	'Big Boss',	'image3.jpg');

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