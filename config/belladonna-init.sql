-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.6.24 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela belladonna.actions
CREATE TABLE IF NOT EXISTS `actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(50) NOT NULL,
  `action_label` varchar(50) NOT NULL,
  `appear` enum('0','1') NOT NULL DEFAULT '0',
  `area_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_actions_areas1_idx` (`area_id`),
  CONSTRAINT `fk_actions_areas1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela belladonna.actions: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `actions` DISABLE KEYS */;
INSERT INTO `actions` (`id`, `action`, `action_label`, `appear`, `area_id`, `created`, `modified`) VALUES
	(1, 'index', 'Todas', '1', 4, '2015-10-08 00:43:27', '2015-10-08 00:43:27'),
	(2, 'add', 'Criar nova', '0', 4, '2015-10-08 00:43:27', '2015-10-08 00:43:27'),
	(3, 'edit', 'Editar', '0', 4, '2015-10-08 00:43:27', '2015-10-08 00:43:27'),
	(4, 'view', 'Visualizar', '0', 4, '2015-10-08 00:43:27', '2015-10-08 00:43:27'),
	(5, 'delete', 'Remover', '0', 4, '2015-10-08 00:43:27', '2015-10-08 00:43:27'),
	(51, 'index', 'Todos', '1', 2, '2015-10-15 11:51:27', '2015-10-15 11:51:27'),
	(52, 'add', 'Criar novo', '0', 2, '2015-10-15 11:51:27', '2015-10-15 11:51:27'),
	(53, 'edit', 'Editar', '0', 2, '2015-10-15 11:51:27', '2015-10-15 11:51:27'),
	(54, 'view', 'Visualizar', '0', 2, '2015-10-15 11:51:27', '2015-10-15 11:51:27'),
	(55, 'delete', 'Remover', '0', 2, '2015-10-15 11:51:27', '2015-10-15 11:51:27'),
	(56, 'index', 'Todos', '1', 3, '2015-10-15 11:51:33', '2015-10-15 11:51:33'),
	(57, 'add', 'Criar novo', '0', 3, '2015-10-15 11:51:33', '2015-10-15 11:51:33'),
	(58, 'edit', 'Editar', '0', 3, '2015-10-15 11:51:33', '2015-10-15 11:51:33'),
	(59, 'view', 'Visualizar', '0', 3, '2015-10-15 11:51:33', '2015-10-15 11:51:33'),
	(60, 'delete', 'Remover', '0', 3, '2015-10-15 11:51:34', '2015-10-15 11:51:34');
/*!40000 ALTER TABLE `actions` ENABLE KEYS */;


-- Copiando estrutura para tabela belladonna.areas
CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `icon_menu_class` varchar(50) DEFAULT NULL,
  `controller` varchar(50) NOT NULL,
  `controller_label` varchar(100) NOT NULL,
  `abstract` enum('0','1') NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_areas_areas1_idx` (`parent_id`),
  CONSTRAINT `fk_areas_areas1` FOREIGN KEY (`parent_id`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela belladonna.areas: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` (`id`, `parent_id`, `icon_menu_class`, `controller`, `controller_label`, `abstract`, `created`, `modified`) VALUES
	(1, NULL, 'glyphicon glyphicon-lock', 'Security', 'Segurança', '1', '2015-09-27 14:32:33', '2015-10-08 00:30:36'),
	(2, 1, 'glyphicon glyphicon-user', 'Users', 'Usuários', '0', '0000-00-00 00:00:00', '2015-10-15 11:51:27'),
	(3, 1, 'glyphicon glyphicon-tags', 'Profiles', 'Perfís de Usuários', '0', '0000-00-00 00:00:00', '2015-10-15 11:51:33'),
	(4, NULL, 'glyphicon glyphicon-menu-hamburger', 'Areas', 'Áreas', '0', '2015-09-30 00:47:14', '2015-10-08 00:43:27');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;


-- Copiando estrutura para tabela belladonna.profiles
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela belladonna.profiles: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` (`id`, `name`, `created`, `modified`) VALUES
	(1, 'Administrador(a)', '2015-09-27 09:50:00', '2015-10-19 19:34:18'),
	(2, 'Teste', '2015-09-27 13:30:12', '2015-11-04 22:16:34');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;


-- Copiando estrutura para tabela belladonna.profiles_actions
CREATE TABLE IF NOT EXISTS `profiles_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`profile_id`,`action_id`),
  KEY `fk_profiles_has_actions_actions1_idx` (`action_id`),
  KEY `fk_profiles_has_actions_profiles1_idx` (`profile_id`),
  CONSTRAINT `fk_profiles_has_actions_actions1` FOREIGN KEY (`action_id`) REFERENCES `actions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_profiles_has_actions_profiles1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela belladonna.profiles_actions: ~21 rows (aproximadamente)
/*!40000 ALTER TABLE `profiles_actions` DISABLE KEYS */;
INSERT INTO `profiles_actions` (`id`, `profile_id`, `action_id`) VALUES
	(3, 1, 1),
	(52, 2, 1),
	(4, 1, 2),
	(5, 1, 3),
	(6, 1, 4),
	(27, 2, 4),
	(7, 1, 5),
	(42, 1, 51),
	(59, 2, 51),
	(43, 1, 52),
	(44, 1, 53),
	(45, 1, 54),
	(60, 2, 54),
	(46, 1, 55),
	(47, 1, 56),
	(61, 2, 56),
	(48, 1, 57),
	(49, 1, 58),
	(50, 1, 59),
	(62, 2, 59),
	(51, 1, 60);
/*!40000 ALTER TABLE `profiles_actions` ENABLE KEYS */;


-- Copiando estrutura para tabela belladonna.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `otp_password` varchar(100) DEFAULT NULL,
  `pass_switched` enum('0','1') NOT NULL DEFAULT '0',
  `profile_id` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_profiles_idx` (`profile_id`),
  CONSTRAINT `fk_users_profiles` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela belladonna.users: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `otp_password`, `pass_switched`, `profile_id`, `last_login`, `created`, `modified`) VALUES
	(1, 'Administrador', 'admin', '$2y$10$3G4urINmmjXEeZtXNqx.z.d847PieU/K7pQRYQNj/W1CnpGPzfVY2', NULL, '1', 1, '2015-09-27 10:30:41', '2015-09-27 10:30:42', '2015-11-05 10:28:02'),
	(2, 'Belladonna', 'belladonna@belladonna.com', '$2y$10$/fUFWiRWV6uFBrjmm0fFZODMeIJ0FyKe6fTdcwAbMPDIgbYEIXMFG', NULL, '0', 2, NULL, '2015-09-27 14:21:21', '2015-11-05 10:58:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
