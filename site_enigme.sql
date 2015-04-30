-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 30 Avril 2015 à 10:50
-- Version du serveur :  5.6.16
-- Version de PHP :  5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `site_enigme`
--

-- --------------------------------------------------------

--
-- Structure de la table `enigme`
--

CREATE TABLE IF NOT EXISTS `enigme` (
  `id_enigme` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `enonce` text,
  `image` varchar(100) DEFAULT NULL,
  `reponse` varchar(100) DEFAULT NULL,
  `point` int(10) DEFAULT NULL,
  `num_enigme` varchar(45) DEFAULT NULL,
  `auteur_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_enigme`),
  KEY `fk_enigme_user1_idx` (`auteur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=169 ;

--
-- Contenu de la table `enigme`
--

INSERT INTO `enigme` (`id_enigme`, `titre`, `enonce`, `image`, `reponse`, `point`, `num_enigme`, `auteur_id`) VALUES
(1, 'titre', 'enonce nouveau', '3.jpg', 'reponse25', 3, NULL, NULL),
(5, 'Enigme 2', 'super énoncé êogjepzmiqjrekdlqfnre gptjzig fohde ouf !!', '2.jpg', 'reponseeee', 3, NULL, NULL),
(6, 'Titre de la première énigme', 'Enoncé de la première énigme', '1.jpg', 'coucou', 2, NULL, 22),
(9, 'titre', 'enoncé', '', 'coucoua', 3, NULL, 37),
(11, 'eqer', 'fdgfdsg', '', 'fdgffd', 5, NULL, 37),
(12, 'uzefozrfzehol', 'jsdfegjlge', '', 'ut', 5, NULL, 37),
(163, 'Qui suis-je?', 'Je suis souvent là à Noël.', '1(1).jpg', 'saumon', 5, '0', NULL),
(164, 'Je suis un...', 'Cette jeune fille m''agite toute une chanson.', '2(1).jpg', 'poireau', 6, '1', NULL),
(165, 'Qui suis-je?', 'Je ne suis pas une princesse', '3(1).jpg', 'link', 5, '2', NULL),
(166, 'Enigme #004', '', '4.png', 'salameche', 5, '3', NULL),
(167, 'Qui suis-je?', '', '5.jpg', 'totoro', 5, '4', NULL),
(168, 'enigme de l''évaluation', 'De lamoooooort', '10859511_10205456913919882_1713147676_n.jpg', 'chat', 10, '5', 39);

-- --------------------------------------------------------

--
-- Structure de la table `indice`
--

CREATE TABLE IF NOT EXISTS `indice` (
  `id_indice` int(11) NOT NULL AUTO_INCREMENT,
  `num_indice` int(10) DEFAULT NULL,
  `prix` int(10) DEFAULT NULL,
  `enonce` text,
  `idEnigme` int(11) NOT NULL,
  PRIMARY KEY (`id_indice`),
  KEY `fk_indice_enigme1_idx` (`idEnigme`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `indice`
--

INSERT INTO `indice` (`id_indice`, `num_indice`, `prix`, `enonce`, `idEnigme`) VALUES
(5, 1, 2, 'J''aime les papillotes.', 163),
(6, 2, 5, 'Je suis un poisson.', 163),
(7, 1, 5, 'Cette chanson est interprété par le groupe Loituma.', 164),
(8, 1, 3, 'Je suis le héros d''un jeu vidéo', 165),
(9, 2, 5, 'Le nom de ma princesse du jeu commence par un Z.', 165),
(10, 1, 3, 'Je préfère les endroits chauds. En cas de pluie, de la vapeur se forme autour de ma queue.', 166),
(11, 2, 5, 'Dans les versions Rouge, Jaune et Bleue je suis un des pokemons de départ.\r\n', 166),
(12, 1, 5, 'Je suis la mascotte des studios ghibli.', 167),
(13, 1, 4, 'Je suis un animal', 168);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `objet` varchar(100) DEFAULT NULL,
  `destinataire` varchar(45) DEFAULT NULL,
  `expediteur` varchar(45) DEFAULT NULL,
  `texte` text,
  `date` datetime DEFAULT NULL,
  `lu` tinyint(1) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `fk_message_user_idx` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id_message`, `objet`, `destinataire`, `expediteur`, `texte`, `date`, `lu`, `image`, `idUser`) VALUES
(1, 'Objet du message 1', 'Alichou', 'User', 'Coucou c''est un chouette message non ? Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être.\r\nAllez salut !', '2015-03-20 11:00:00', 1, NULL, 37),
(2, 'Objet du message 2', 'Alichou', 'User', 'NUMERO 2 :\r\nCoucou c''est un chouette message non ? Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être. Un peu répétitif peut être.\r\nCiaoooo hahahahaha', '2015-03-20 19:00:00', 1, NULL, 37),
(3, 'Message envoyé !', 'User', 'Alichou', 'coucoucoucocucoucozduhielzfhvofhqe avgjefvbgksehf vaeflijv lzef vimef vilzhefv ihjvf ezlhv klzrhv izhlrvb znkr fvizmh vfkz vamekjrv  bloubloubmoublobulboubloublublobublu', '2015-03-20 09:17:32', 1, NULL, 22),
(4, 'TEST', 'User', 'Alichou', 'Coucou c''est un message', '2015-03-24 11:33:48', 1, NULL, 37),
(5, 'bouh', 'Alichou', 'Alichou', 'coucou moi même !', '2015-03-24 11:43:27', 1, NULL, 37),
(6, 'coucou', 'User', 'Alichou', 'dknféoféo"', '2015-03-24 11:47:56', 1, NULL, 22),
(7, 'A l''aide', 'Ausecours', 'chocolat', 'Je cherche le mot saumon', '2015-03-31 14:11:34', 0, NULL, 39),
(8, 'bloubloublou', 'Alichou', 'Alichou', 'Nouveau message ouiouioui ! :D', '2015-04-28 19:03:54', 1, NULL, 37),
(9, 'dggrq', 'Alichou', 'Alichou', 'rzoljgskdz,f;x', '2015-04-28 19:52:57', 1, NULL, 37);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nom_user` varchar(45) NOT NULL,
  `mdp_user` varchar(32) NOT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `statut` varchar(45) NOT NULL,
  `point_user` int(10) DEFAULT NULL,
  `indice_achete` int(10) DEFAULT NULL,
  `cle` varchar(32) DEFAULT NULL,
  `actif` int(11) DEFAULT NULL,
  `idEnigme` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `nom_user`, `mdp_user`, `mail`, `statut`, `point_user`, `indice_achete`, `cle`, `actif`, `idEnigme`) VALUES
(22, 'User', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'mail@mail.com', 'joueur', 10, 0, NULL, NULL, 0),
(31, 'bloup', 'd20eb72848b95d5913898d57515d298b', 'coizehf@fozfel.fr', 'joueur', 10, 0, NULL, NULL, 0),
(37, 'Alichou', 'c9c5384adec41a13eea91ed4d20d809e', 'alice.maixent@gmail.com', 'joueur', 15, 0, NULL, NULL, 3),
(39, 'Ausecours', '657f8b8da628ef83cf69101b6817150a', 'help@help.fr', 'joueur', 46, 0, NULL, NULL, 6),
(40, 'Enigman', '76a339ba1bf71ced34da63d7f9b6b630', 'enigman@enigme.com', 'joueur', 10, 0, NULL, NULL, 0),
(42, 'Alice', '721a9b52bfceacc503c056e3b9b93cfa', 'alice.alice@alice.fr', 'joueur', 23, 0, NULL, NULL, 3),
(43, 'Clouclou', 'fdf7ea0e85a96e3d524bec6da1917bfb', 'clou@clou.fr', 'joueur', 13, 2, NULL, NULL, 2),
(44, 'Poneyman', 'f1a84f832a297fed720738ea6c42a719', 'poney@gmail.com', 'joueur', 13, 1, NULL, NULL, 2),
(45, 'Bibou', 'fdf7ea0e85a96e3d524bec6da1917bfb', 'chat@chat.fr', 'joueur', 16, 0, NULL, NULL, 2),
(46, 'Maya', '65f8577e2e350b5dde4e0bebe32d7460', 'bzzz@croustille.fr', 'joueur', 3, 2, NULL, NULL, 0),
(47, 'Bulleman', 'f806477ed445cd9d663b37a75f69a5e6', 'bubulle@man.com', 'joueur', 26, 1, NULL, NULL, 4),
(49, 'eval', '2eed1fe0db36d674643b5f84d2adf46e', 'dzjedzjl@zjkzd.fr', 'joueur', 46, 0, NULL, NULL, 6),
(50, 'licette17', 'a9734f267bb04b8e982c08b089c364f3', 'alice.maixent@gmail.com', 'joueur', 10, 0, '3e39c5ccf88cd2175b7f04a0f0dc212e', 1, 0),
(51, 'abcde', 'ab56b4d92b40713acc5af89985d4b786', 'alice.maixent@gmail.com', 'joueur', 10, 0, 'eec044dde2b7b118986e69fb69610bbe', 1, 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `enigme`
--
ALTER TABLE `enigme`
  ADD CONSTRAINT `enigme_ibfk_1` FOREIGN KEY (`auteur_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `indice`
--
ALTER TABLE `indice`
  ADD CONSTRAINT `indice_ibfk_1` FOREIGN KEY (`idEnigme`) REFERENCES `enigme` (`id_enigme`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
