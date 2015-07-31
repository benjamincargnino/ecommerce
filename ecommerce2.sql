-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 31 Juillet 2015 à 14:29
-- Version du serveur: 5.5.43-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ecommerce`
--

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
(1, 'Jeux', 'Jeux de cartes\r\nJeux de billes\r\nJeux de boules', 'images/category/1.jpg'),
(2, 'Informatique', 'clavier souris ', 'images/category/2.jpg'),
(3, 'TV', 'LCD, PLASMA, CURVED', 'images/category/3.jpg'),
(4, 'Téléphonie', 'Smartphone, GSM, dual-sim', 'images/category/4.jpg'),
(5, 'Photo', 'photographie, objectifs, polaroïds', 'images/category/5.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `product_id` mediumint(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `mark` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `validated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`,`user_email`),
  KEY `fk_comment_user1_idx` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `orders`
--

INSERT INTO `orders` (`id`, `user_email`, `date`, `total`) VALUES
(1, 'test@test.test', '2014-07-11 13:43:40', 710),
(2, 'test@test.test', '2014-07-11 13:45:10', 2097.6),
(3, 'CarBen@gmail.com', '2015-07-28 11:50:29', 1118),
(4, 'CarBen@gmail.com', '2015-07-28 12:01:36', 850),
(5, 'CarBen@gmail.com', '2015-07-28 12:08:11', 559),
(6, 'CarBen@gmail.com', '2015-07-28 12:12:25', 559),
(7, 'CarBen@gmail.com', '2015-07-28 12:40:41', 200),
(8, 'CarBen@gmail.com', '2015-07-28 12:41:58', 200),
(9, 'CarBen@gmail.com', '2015-07-28 12:54:34', 549),
(10, 'carcarbenben@gmail.com', '2015-07-29 12:45:44', 600),
(11, 'CarBen@gmail.com', '2015-07-29 15:46:47', 549),
(12, 'CarBen@gmail.com', '2015-07-29 17:10:14', 1609);

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
(2, 6, 4),
(4, 3, 1),
(5, 5, 1),
(7, 4, 1),
(8, 4, 1),
(9, 1, 1),
(10, 4, 3),
(11, 1, 1),
(12, 2, 1),
(12, 3, 1),
(12, 4, 1);

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
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `image`, `price`, `rating`, `active`) VALUES
(1, 'Xperia Z3', 'Jour et nuit', 'images/product/1.jpg', 549.99, 4, 1),
(2, 'Produit 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 'images/product/2.jpg', 359.99, 4, 1),
(3, 'Iphone6+', 'Apple trop cher', 'images/product/3.jpg', 850, 0, 1),
(4, 'SAMSUMG ZQ-284', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 'images/product/4.jpg', 756, 4, 1),
(5, 'Alienware mx-241', '666Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 'images/product/5.jpg', 999.99, 4, 1),
(6, 'Produit 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit justo massa, sit amet suscipit felis pharetra vel. Duis non tristique velit, quis sodales mauris. Mauris auctor rutrum elit, ac rutrum elit consequat consequat. Aenean laoreet id odio ut imperdiet. Sed interdum purus non velit rutrum venenatis. Etiam congue adipiscing magna sed posuere. Suspendisse cursus massa eget eros mollis, nec posuere nisi tincidunt. Maecenas porttitor enim sed massa feugiat suscipit. Pellentesque ha', 'images/product/6.jpg', 559, 4, 1),
(11, 'Canon x84', 'bla bla bla bla bla bla bla bla bla bla bla bla', 'images/product/11.jpg', 699, 0, 1);

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
(3, 1),
(5, 1),
(2, 2),
(5, 2),
(2, 3),
(3, 3),
(4, 3),
(2, 4),
(3, 4),
(3, 5),
(11, 5);

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
  `cp` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`email`, `password`, `address`, `name`, `firstname`, `cp`, `city`, `role`) VALUES
('CarBen@gmail.com', 'e2b47a5b6992ce2d66d88c098f6b07b76115b10d', '10 Villa Emile Bergerat', 'Cargnino', 'Benjamin', '92200', 'Neuilly-sur-Seine', 2),
('carcarbenben@gmail.com', 'e45ac058c50aab1bf5ea0c9e644cda9a2e123001', '12 rue du roseau', 'CarCar', 'BenBen', '9292', 'NeuNeu', 1),
('fds@fds.fds', '1257ee4cb238affd46ef15d06714525c2c7c9018', 'fds', 'fds', 'fds', '92310', 'Sevres', 1),
('RosCap@gmail.com', '601f1889667efaebb33b8c12572835da3f027f78', '60 rue Blomet', 'Rosset', 'Capucine', '75015', 'Paris', 1),
('sebastienbarret@gmail.com', 'e45ac058c50aab1bf5ea0c9e644cda9a2e123001', '71 allée georges askinazi', 'Barret', 'Sébastien', '92100', 'Boulogne', 1),
('test@test.fr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', 'LEMAIRE', 'Eric', '13000', 'Marseille', 1),
('test@test.test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'test', 'test', 'test', '78000', 'Versailles', 1);

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
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `fk_order_has_product_order1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_has_product_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `fk_product_has_category_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_has_category_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
