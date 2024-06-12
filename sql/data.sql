SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

-- Création des tables

DROP TABLE IF EXISTS `AppartientAuxDepartement`;
CREATE TABLE `AppartientAuxDepartement` (
                                            `idPersonne` int(11) NOT NULL,
                                            `idDepartement` int(11) NOT NULL,
                                            PRIMARY KEY (`idPersonne`, `idDepartement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

DROP TABLE IF EXISTS `Département`;
CREATE TABLE `Département` (
                               `id` int(11) NOT NULL,
                               `nom` varchar(50) NOT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

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

-- Insertion des données

INSERT INTO `Personne` (`Nom`, `Prenom`, `email`, `NuméroTelephone`, `NuméroTelephoneBureau`, `Fonction`, `image`) VALUES
('Dupont', 'Jean', 'jean.dupont@example.com', '0601020304', '0140203040', 'Développeur', 'image1.jpg'),
('Martin', 'Marie', 'marie.martin@example.com', '0605060708', '0140506070', 'Recruteur', 'image2.jpg'),
('Durand', 'Pierre', 'pierre.durand@example.com', '0608091011', '0140809100', 'Responsable Marketing', 'image3.jpg'),
('Bernard', 'Luc', 'luc.bernard@example.com', '0603030303', '0140303030', 'Analyste Financier', 'image4.jpg'),
('Petit', 'Sophie', 'sophie.petit@example.com', '0604040404', '0140404040', 'Gestionnaire de Stock', 'image5.jpg'),
('Moreau', 'Claire', 'claire.moreau@example.com', '0605050505', '0140505050', 'Responsable des Ventes', 'image6.jpg'),
('Fournier', 'Louis', 'louis.fournier@example.com', '0606060606', '0140606060', 'Technicien Support', 'image7.jpg'),
('Rousseau', 'Anne', 'anne.rousseau@example.com', '0607070707', '0140707070', 'Chercheur', 'image8.jpg'),
('Girard', 'Paul', 'paul.girard@example.com', '0608080808', '0140808080', 'Chef de Production', 'image9.jpg'),
('Gauthier', 'Emma', 'emma.gauthier@example.com', '0609090909', '0140909090', 'Secrétaire', 'image10.jpg'),
('Lefevre', 'Chloe', 'chloe.lefevre@example.com', '0610101010', '0140101010', 'Développeur', 'image11.jpg'),
('David', 'Lucas', 'lucas.david@example.com', '0611111111', '0141111111', 'Recruteur', 'image12.jpg'),
('Robert', 'Julie', 'julie.robert@example.com', '0612121212', '0142121212', 'Responsable Marketing', 'image13.jpg'),
('Richard', 'Antoine', 'antoine.richard@example.com', '0613131313', '0143131313', 'Analyste Financier', 'image14.jpg'),
('Simon', 'Alice', 'alice.simon@example.com', '0614141414', '0144141414', 'Gestionnaire de Stock', 'image15.jpg'),
('Michel', 'Thomas', 'thomas.michel@example.com', '0615151515', '0145151515', 'Responsable des Ventes', 'image16.jpg'),
('Leroy', 'Margaux', 'margaux.leroy@example.com', '0616161616', '0146161616', 'Technicien Support', 'image17.jpg'),
('Renaud', 'Nicolas', 'nicolas.renaud@example.com', '0617171717', '0147171717', 'Chercheur', 'image18.jpg'),
('Marchand', 'Sarah', 'sarah.marchand@example.com', '0618181818', '0148181818', 'Chef de Production', 'image19.jpg'),
('Dufour', 'Elodie', 'elodie.dufour@example.com', '0619191919', '0149191919', 'Secrétaire', 'image20.jpg'),
('Becker', 'Doryann', 'crafteur55100-verdun@hotmail.com', '0783722613', '0000000000', 'CEO', 'image1.jpg'),
('Formet', 'Romain', 'romain.formet@gmail.com', '0677509018', '0000000000', 'sous-fifre', 'image2.jpg'),
('Durand', 'Quentin', 'quentindurand04@gmail.com', '0627636920', '0000000000', 'sous-fifre', 'image3.jpg');

INSERT INTO `Département` (`id`, `nom`) VALUES
(1, 'Informatique'),
(2, 'Ressources Humaines'),
(3, 'Marketing'),
(4, 'Finance'),
(5, 'Logistique'),
(6, 'Ventes'),
(7, 'Support Technique'),
(8, 'Recherche et Développement'),
(9, 'Production'),
(10, 'Administration'),
(11 , 'Direction');

INSERT INTO `AppartientAuxDepartement` (`idPersonne`, `idDepartement`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 1),
(12, 2),
(13, 3),
(14, 4),
(15, 5),
(16, 6),
(17, 7),
(18, 8),
(19, 9),
(20, 10),
(21, 11),
(22, 11),
(23, 11);

SET foreign_key_checks = 1;
