-- phpMyAdmin SQL Dump
-- version 3.3.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 21 Juillet 2015 à 13:32
-- Version du serveur: 5.5.13
-- Version de PHP: 5.5.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ecommerce`
--
CREATE DATABASE `ecommerce` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ecommerce`;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `image`) VALUES
(1, 'Jeux', 'Jeux', NULL),
(2, 'Informatique', 'Informatique', NULL),
(3, 'TV', 'TV', NULL),
(4, 'Téléphonie', 'Téléphonie', NULL),
(5, 'Photo', 'Photo', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `product_id` mediumint(5) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `mark` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`product_id`,`user_email`),
  KEY `fk_comment_user1_idx` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`product_id`, `user_email`, `comment`, `mark`, `date`) VALUES
(1, 'fds@fds.fds', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 4, '2014-07-10 10:27:09'),
(1, 'test@test.test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 1, '2014-07-10 10:27:09'),
(2, 'test@test.test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 1, '2014-07-10 10:27:20'),
(4, 'test@test.test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 3, '2014-07-10 13:26:59'),
(5, 'test@test.fr', 'test commentaire', 0, '2015-07-21 00:12:10'),
(8, 'fds@fds.fds', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 0, '2014-07-10 10:27:20'),
(8, 'test@test.fr', 'qdqsfdqsfqsdf', 2, '2015-07-21 00:02:53'),
(8, 'test@test.test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 2, '2014-07-10 13:27:12');

-- --------------------------------------------------------

--
-- Structure de la table `order_product`
--

CREATE TABLE IF NOT EXISTS `order_product` (
  `order_id` mediumint(6) NOT NULL,
  `product_id` mediumint(5) NOT NULL,
  `quantity` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `fk_order_has_product_product1_idx` (`product_id`),
  KEY `fk_order_has_product_order1_idx` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `quantity`) VALUES
(1, 4, 2),
(2, 5, 2),
(2, 6, 4);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `date` datetime DEFAULT NULL,
  `total` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_user1_idx` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`id`, `user_email`, `date`, `total`) VALUES
(1, 'test@test.test', '2014-07-11 13:43:40', 710),
(2, 'test@test.test', '2014-07-11 13:45:10', 2097.6);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` mediumint(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `image`, `price`, `rating`) VALUES
(1, 'Produit 1', '11Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 'images/product/1.jpg', 600, 4),
(2, 'Produit 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 'images/product/2.jpg', 559, 4),
(4, 'Produit 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 'images/product/4.jpg', 559, 4),
(5, 'Produit 5', '666Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 'images/product/5.jpg', 559, 4),
(6, 'Produit 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 'images/product/6.jpg', 559, 4),
(7, 'Produit 7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 'images/product/7.jpg', 559, 4),
(8, 'Produit 8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 'images/product/8.jpg', 60, 4);

-- --------------------------------------------------------

--
-- Structure de la table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `product_id` mediumint(5) NOT NULL,
  `category_id` tinyint(2) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`),
  KEY `fk_product_has_category_category1_idx` (`category_id`),
  KEY `fk_product_has_category_product_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(8, 1),
(1, 2),
(5, 2),
(8, 3),
(1, 4),
(5, 4),
(8, 4);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(100) NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`email`, `password`, `address`, `name`, `firstname`) VALUES
('fds@fds.fds', '1257ee4cb238affd46ef15d06714525c2c7c9018', 'fds', 'fds', 'fds'),
('test@test.fr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', 'LEMAIRE', 'Eric'),
('test@test.test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test', 'test', 'test');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comment_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `fk_order_has_product_order1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_has_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `fk_product_has_category_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_has_category_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
