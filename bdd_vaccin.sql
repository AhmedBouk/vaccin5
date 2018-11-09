-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 09 nov. 2018 à 15:49
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `vaccination_bdd191018`
--

-- --------------------------------------------------------

--
-- Structure de la table `bdd_vaccin`
--

CREATE TABLE `bdd_vaccin` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `obligatoire` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `rappel` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bdd_vaccin`
--

INSERT INTO `bdd_vaccin` (`id`, `nom`, `obligatoire`, `created_at`, `rappel`) VALUES
(33, ' Le Tétanos ', 1, '0000-00-00 00:00:00', '0000-00-00'),
(34, ' La Poliomyélite', 1, '0000-00-00 00:00:00', '0000-00-00'),
(35, ' L’Haemophilius Influenzae B ', 1, '0000-00-00 00:00:00', '0000-00-00'),
(36, ' La Coqueluche', 1, '0000-00-00 00:00:00', '0000-00-00'),
(37, ' L’Hépatite B', 1, '0000-00-00 00:00:00', '0000-00-00'),
(38, ' La Rougeole', 1, '0000-00-00 00:00:00', '0000-00-00'),
(39, ' Les Oreillons', 1, '0000-00-00 00:00:00', '0000-00-00'),
(40, ' La Rubéole', 1, '0000-00-00 00:00:00', '0000-00-00'),
(41, ' Le Méningocoque C', 1, '0000-00-00 00:00:00', '0000-00-00'),
(42, ' Le Pneumocoque', 1, '0000-00-00 00:00:00', '0000-00-00'),
(46, 'Le Papillomavirus Humains ', 0, '0000-00-00 00:00:00', '0000-00-00'),
(47, 'Fièvre typhoïde', 0, '0000-00-00 00:00:00', '0000-00-00'),
(48, 'La Rage', 0, '0000-00-00 00:00:00', '0000-00-00'),
(49, 'La Leptospirose', 0, '0000-00-00 00:00:00', '0000-00-00'),
(50, 'L’Encéphalite japonaise', 0, '0000-00-00 00:00:00', '0000-00-00'),
(51, 'L’Encéphalite à Tiques', 0, '0000-00-00 00:00:00', '0000-00-00'),
(52, 'La Fièvre jaune', 0, '0000-00-00 00:00:00', '0000-00-00'),
(53, 'L\'Hépatite A', 0, '0000-00-00 00:00:00', '0000-00-00'),
(54, 'Le Choléra', 0, '0000-00-00 00:00:00', '0000-00-00'),
(55, 'La Grippe', 0, '0000-00-00 00:00:00', '0000-00-00'),
(56, 'La poliomyélite', 0, '0000-00-00 00:00:00', '0000-00-00'),
(57, 'La Diphtérie', 0, '0000-00-00 00:00:00', '0000-00-00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bdd_vaccin`
--
ALTER TABLE `bdd_vaccin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bdd_vaccin`
--
ALTER TABLE `bdd_vaccin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
