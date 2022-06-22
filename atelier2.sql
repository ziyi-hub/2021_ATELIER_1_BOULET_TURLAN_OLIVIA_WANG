-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Nov 05, 2021 at 10:30 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atelier`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int NOT NULL,
  `nomCategorie` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descriptionCategorie` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `nomCategorie`, `descriptionCategorie`) VALUES
(1, 'Boissons fraîches', 'Cela comprend non seulement les jus fraîchement pressés, mais également les thés et les cafés biologiques.'),
(2, 'Viandes', 'Cela comprend non seulement de la viande fraîchement, mais également du viande surgelés et aliment cuit'),
(3, 'Poissons', 'Cela comprend non seulement des poissons, mais également des produits de la mer\r\n'),
(4, 'Légumes', 'Légumes de saison et bio, très frais'),
(5, 'Fruits', 'Choisir des fruits cultivées en Guadeloupe et Martinique c\'est soutenir l\'agriculture française !'),
(6, 'Fromage', 'Lait et produits à base de lait');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `idCommande` int NOT NULL,
  `montant` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `statutPayer` tinyint(1) DEFAULT NULL,
  `statutLivraison` tinyint(1) DEFAULT NULL,
  `idUtilisateur` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`idCommande`, `montant`, `statutPayer`, `statutLivraison`, `idUtilisateur`) VALUES
(1, '6.00', 1, 1, 3),
(2, '16.20', 0, 0, 4),
(3, '11.00', 1, 1, 2),
(4, '9.00', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

CREATE TABLE `facture` (
  `numFacture` int NOT NULL,
  `montant` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idCommande` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `facture`
--

INSERT INTO `facture` (`numFacture`, `montant`, `idCommande`) VALUES
(1, '6.00', 1),
(2, '11.00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `idPanier` int NOT NULL,
  `idProduit` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idcommande` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantite` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `panier`
--

INSERT INTO `panier` (`idPanier`, `idProduit`, `idcommande`, `quantite`) VALUES
(1, '8', '1', '2'),
(2, '2', '2', '1'),
(3, '1', '2', '3'),
(4, '15', '3', '1'),
(5, '10', '3', '2'),
(6, '6', '4', '2'),
(7, '9', '4', '1');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `idProduit` int NOT NULL,
  `nomProduit` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tarifUnitaire` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lienImage` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `idCategorie` int DEFAULT NULL,
  `idUtilisateur` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`idProduit`, `nomProduit`, `description`, `tarifUnitaire`, `lienImage`, `idCategorie`, `idUtilisateur`) VALUES
(1, 'Filet de poulet Le Gaulois', 'L\'apport énergétique du produit Filet de poulet est de 95 calories (ou 397 KJ) pour une portion d\'environ 100 grammes. Cela représente environ 5% de l\'apport journalier pour un régime moyen à 2000 calories.', '3.50', 'https://media.auchan.fr/MEDIASTEP131876553_512x512/B2CD/', 2, 2),
(2, 'Côtes De Porc BBQ', 'L\'apport énergétique du produit Côtes De Porc BBQ est de 207 calories (ou 867 KJ) pour une portion d\'environ 100 grammes. Cela représente environ 10% de l\'apport journalier pour un régime moyen à 2000 calories.', '5.70', 'https://media.auchan.fr/MEDIASTEP65027314_512x512/B2CD/', 2, 4),
(3, 'Saucisse Yanabrese Cayenne', 'L\'apport énergétique du produit Saucisse Yanabrese Cayenne est de calories (ou KJ) pour une portion d\'environ 100 grammes. Cela représente environ % de l\'apport journalier pour un régime moyen à 2000 calories.', '4.00', 'https://media.auchan.fr/MEDIASTEP59105562_512x512/B2CD/', 2, 2),
(4, 'Jambon blanc', 'L\'apport énergétique du produit Jambon blanc est de calories (ou KJ) pour une portion d\'environ 100 grammes. Cela représente environ % de l\'apport journalier pour un régime moyen à 2000 calories.', '3.00', 'https://media.auchan.fr/MEDIASTEP131876553_512x512/B2CD/', 2, 4),
(5, 'Pommes bicolores', 'La pomme Gala a une robe bicolore avec une dominante de rouge, sa saveur douce est à la fois sucrée et acide.', '3.00', 'https://media.auchan.fr/MEDIASTEP130374601_512x512/B2CD/', 5, 2),
(6, 'Mangue bio', 'La Mangue bio a une robe bicolore avec une dominante de rouge, sa saveur douce est à la fois sucrée et acide.', '3.00', 'https://media.auchan.fr/MEDIASTEP86443507_512x512/B2CD/', 5, 2),
(7, 'Bananes Antilles françaises', 'Choisir La Banane Française cultivée en Guadeloupe et Martinique c\'est soutenir l\'agriculture française ! La Banane Française est clairement identifiable par son ruban bleu, blanc, rouge.', '3.00', 'https://media.auchan.fr/MEDIASTEP67301987_512x512/B2CD/', 5, 4),
(8, 'Avocat bio', 'Très bon mur à point et gouteux', '3.00', 'https://media.auchan.fr/MEDIASTEP82317656_512x512/B2CD/', 5, 4),
(9, 'Carottes fanes ', 'Carottes ultra fraîches, croquantes et très sucrées', '3.00', 'https://media.auchan.fr/MEDIASTEP104759468_512x512/B2CD/', 4, 2),
(10, 'Brocoli bio', 'Brocoli bio ultra fraîches et bio', '3.00', 'https://media.auchan.fr/MEDIASTEP59251105_512x512/B2CD/', 4, 2),
(11, 'Chou fleur', 'Très frais et délicieux', '3.00', 'https://media.auchan.fr/MEDIASTEP103389428_512x512/B2CD/', 4, 4),
(12, 'Poisson à la Parisienne', 'Portions de bloc de filets de colin d\'Alaska MSC** (poisson) (Theragra chalcogramma) 50%, eau, champignons 8,8%, crème fraîche 8%', '5.00', 'https://media.auchan.fr/MEDIASTEP84621709_512x512/B2CD/', 4, 2),
(13, 'Paupiette de saumon', 'Filet de saumon (Salmo salar)  36%.Farce 64%: poissons blancs 24%, saumon 18%, noix de St Jacques* 5%, huile végétale de tournesol', '5.00', 'https://media.auchan.fr/MEDIASTEP124463162_512x512/B2CD/', 4, 4),
(14, 'Nectar d\'abricot', 'Nectar d\'abricot à base de purée d\'abricot - teneur en fruits : 40% minimum', '2.00', 'https://media.auchan.fr/MEDIASTEP70614685_512x512/B2CD/', 1, 4),
(15, 'Comté AOP affiné 20 mois', 'LAIT cru de vache, ferments lactiques, présure, sel', '5.00', 'https://media.auchan.fr/MEDIASTEP77262201_512x512/B2CD/', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int NOT NULL,
  `nomUtilisateur` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `motDePasse` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `roleId` int DEFAULT NULL,
  `numTel` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nomUtilisateur`, `adresse`, `mail`, `motDePasse`, `roleId`, `numTel`) VALUES
(1, 'Ziyi', '61 rue de Boudonville 54000 Nancy France', 'ziyiwang1027@gmail.com', 'btow', 0, '06 25 98 36 93'),
(2, 'Tania', '33 rue de Lavigerie 54000 Nancy France', 'taniaolivia9@gmail.com', 'btow', 1, '06 29 34 97 04'),
(3, 'Clement', '2 Avenue Milton 54000 Nancy France', 'clement.boulet60510@gmail.com', 'btow', 2, '06 18 95 20 52'),
(4, 'Guillaume', '5 Rue Coldion 54000 Nancy France', 'guillaume.turlan@orange.fr', 'btow', 1, '07 28 44 26 02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `FK_commande_utilisateur` (`idUtilisateur`);

--
-- Indexes for table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`numFacture`),
  ADD KEY `FK_facture_commande` (`idCommande`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`idPanier`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `FK_produit_utilisateur` (`idUtilisateur`),
  ADD KEY `FK_produit_categorie` (`idCategorie`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `idCommande` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `facture`
--
ALTER TABLE `facture`
  MODIFY `numFacture` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `panier`
--
ALTER TABLE `panier`
  MODIFY `idPanier` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `idProduit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D5D419CCB` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Constraints for table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `FK_FE8664103D498C26` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`);

--
-- Constraints for table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC275D419CCB` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `FK_29A5EC27B597FD62` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
