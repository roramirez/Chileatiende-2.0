# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.0.29-MariaDB-0ubuntu0.16.04.1)
# Base de datos: chileatiende.cl
# Tiempo de Generación: 2018-01-17 19:32:02 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla api_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `api_users`;

CREATE TABLE `api_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(64) NOT NULL DEFAULT '',
  `last_name` varchar(128) NOT NULL DEFAULT '',
  `company` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;



# Volcado de tabla categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `featured` tinyint(1) NOT NULL,
  `exterior` tinyint(1) NOT NULL,
  `order` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `featured` (`featured`),
  KEY `order` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;



# Volcado de tabla category_page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category_page`;

CREATE TABLE `category_page` (
  `page_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`page_id`,`category_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_page_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `category_page_ibfk_3` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;



# Volcado de tabla category_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category_user`;

CREATE TABLE `category_user` (
  `category_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `category_user_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `category_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;



# Volcado de tabla hits
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hits`;

CREATE TABLE `hits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `count` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `page_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `hits_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;



# Volcado de tabla institutions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `institutions`;

CREATE TABLE `institutions` (
  `id` varchar(8) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `shortname` varchar(32) DEFAULT NULL,
  `url` varchar(512) DEFAULT NULL,
  `description` text NOT NULL,
  `ministry_id` varchar(8) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ministry_id` (`ministry_id`),
  CONSTRAINT `institutions_ibfk_1` FOREIGN KEY (`ministry_id`) REFERENCES `ministries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;



# Volcado de tabla locations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `id` varchar(11) NOT NULL DEFAULT '',
  `type` varchar(45) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `shortname` varchar(255) NOT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `url` varchar(512) DEFAULT NULL,
  `parent_id` varchar(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sector_sector1` (`parent_id`),
  CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `locations` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;



# Volcado de tabla logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned DEFAULT NULL,
  `page_version_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_historial_ficha1` (`page_id`),
  KEY `fk_historial_usuario_backend1` (`user_id`),
  KEY `ficha_version_id` (`page_version_id`),
  CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;



# Volcado de tabla ministries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ministries`;

CREATE TABLE `ministries` (
  `id` varchar(8) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` text,
  `shortname` varchar(45) DEFAULT NULL,
  `created_at` varchar(45) DEFAULT NULL,
  `updated_at` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;



# Volcado de tabla notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `institution_id` varchar(8) NOT NULL,
  `title` varchar(256) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `institution_id` (`institution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;



# Volcado de tabla offices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `offices`;

CREATE TABLE `offices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `address` varchar(512) NOT NULL DEFAULT '',
  `schedules` varchar(128) NOT NULL DEFAULT '',
  `phones` varchar(128) NOT NULL DEFAULT '',
  `fax` varchar(128) DEFAULT NULL,
  `location_id` varchar(11) NOT NULL DEFAULT '',
  `institution_id` varchar(8) NOT NULL DEFAULT '',
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `director` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `type` varchar(32) NOT NULL DEFAULT 'personas',
  `mobile` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_oficina_sector1` (`location_id`),
  KEY `fk_oficina_servicio1` (`institution_id`),
  CONSTRAINT `offices_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `offices_ibfk_2` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;



# Volcado de tabla page_related_page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_related_page`;

CREATE TABLE `page_related_page` (
  `page_id` int(10) unsigned NOT NULL,
  `related_page_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`page_id`,`related_page_id`),
  CONSTRAINT `page_related_page_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;



# Volcado de tabla page_similar_page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_similar_page`;

CREATE TABLE `page_similar_page` (
  `page_id` int(10) unsigned NOT NULL,
  `similar_page_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`page_id`,`similar_page_id`),
  KEY `similar_page_id` (`similar_page_id`),
  CONSTRAINT `page_similar_page_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `page_similar_page_ibfk_2` FOREIGN KEY (`similar_page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;



# Volcado de tabla pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` smallint(6) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(512) NOT NULL DEFAULT '',
  `objective` text NOT NULL,
  `details` text NOT NULL,
  `beneficiaries` text NOT NULL,
  `requirements` text NOT NULL,
  `online` tinyint(1) NOT NULL,
  `online_guide` text NOT NULL,
  `online_url` varchar(255) NOT NULL DEFAULT '',
  `office` tinyint(1) NOT NULL,
  `office_guide` text NOT NULL,
  `phone` tinyint(1) NOT NULL,
  `phone_guide` text NOT NULL,
  `mail` tinyint(1) NOT NULL,
  `mail_guide` text NOT NULL,
  `consulate` tinyint(1) NOT NULL,
  `consulate_guide` text NOT NULL,
  `legal` text NOT NULL,
  `keywords` text NOT NULL,
  `boost` int(10) unsigned NOT NULL DEFAULT '1',
  `status` varchar(16) DEFAULT NULL,
  `status_comment` text,
  `published` tinyint(1) NOT NULL,
  `published_at` datetime DEFAULT NULL,
  `master` tinyint(1) NOT NULL,
  `master_id` int(10) unsigned DEFAULT NULL,
  `institution_id` varchar(8) NOT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `weight` int(10) unsigned DEFAULT NULL,
  `costo` text,
  `vigencia` text,
  `plazo` text NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `actualizable` tinyint(1) DEFAULT NULL,
  `destacado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `genero_id` int(11) DEFAULT NULL,
  `convenio` tinyint(1) DEFAULT '0',
  `diagramacion` smallint(6) DEFAULT NULL,
  `cc_id` varchar(20) DEFAULT NULL,
  `cc_formulario` text,
  `cc_llavevalor` int(11) DEFAULT NULL,
  `comentarios` text NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `flujo` tinyint(4) NOT NULL DEFAULT '0',
  `tema_principal` int(10) unsigned NOT NULL,
  `keywords_old` varchar(255) DEFAULT NULL,
  `sic` varchar(255) DEFAULT NULL,
  `sello_chilesinpapeleo` tinyint(1) NOT NULL DEFAULT '0',
  `encuesta_calidad` int(11) DEFAULT NULL,
  `fps` tinyint(1) DEFAULT NULL,
  `puntaje_fps_min` int(11) DEFAULT NULL,
  `puntaje_fps_max` int(11) DEFAULT NULL,
  `formalizacion` tinyint(1) DEFAULT NULL,
  `venta_anual` int(3) DEFAULT NULL,
  `nro_trabajadores` int(3) DEFAULT NULL,
  `req_especial` text,
  `votos_positivos` int(11) NOT NULL DEFAULT '0',
  `votos_negativos` int(11) NOT NULL DEFAULT '0',
  `primera_version_publicada_id` int(10) unsigned DEFAULT NULL,
  `informacion_multimedia` text,
  `medio_pago_id` int(10) unsigned DEFAULT NULL,
  `metaficha` tinyint(1) NOT NULL,
  `metaficha_campos` text,
  `metaficha_servicios` text,
  `metaficha_opciones` text,
  `updated_data_at` datetime DEFAULT NULL,
  `resumen` text,
  `guia_chileatiende` text,
  `content_updated_data_at` datetime DEFAULT NULL,
  `guia_oficina_nombre` text,
  `es_tramite_exterior` tinyint(1) DEFAULT NULL,
  `es_tramite_mujer` tinyint(1) DEFAULT NULL,
  `es_tramite_mujer_destacado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order` (`order`),
  KEY `published` (`published`),
  KEY `master` (`master`),
  KEY `master_id` (`master_id`),
  KEY `institution_id` (`institution_id`),
  CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`master_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pages_ibfk_2` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='no se agrega relacion con tabla genero.';



# Volcado de tabla password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;



# Volcado de tabla searches
# ------------------------------------------------------------

DROP TABLE IF EXISTS `searches`;

CREATE TABLE `searches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `query` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `updated_at_idx` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;



# Volcado de tabla session_visits
# ------------------------------------------------------------

DROP TABLE IF EXISTS `session_visits`;

CREATE TABLE `session_visits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(128) NOT NULL DEFAULT '',
  `page_id` int(10) unsigned NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;



# Volcado de tabla suggestions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `suggestions`;

CREATE TABLE `suggestions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `query` varchar(512) NOT NULL DEFAULT '',
  `count` int(11) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;



# Volcado de tabla users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `ministerial` tinyint(1) NOT NULL,
  `interministerial` tinyint(1) NOT NULL,
  `institution_id` varchar(8) NOT NULL DEFAULT '' COMMENT 'Deprecated',
  `password` varchar(255) NOT NULL,
  `old_password` varchar(255) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` enum('admin','counterpart','operator') NOT NULL DEFAULT 'counterpart',
  `run` int(10) unsigned DEFAULT NULL,
  `dv` char(1) DEFAULT NULL,
  `backend` tinyint(1) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `nationality` char(3) DEFAULT NULL,
  `foreigner` tinyint(1) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `run` (`run`),
  KEY `fk_usuario_backend_servicio1` (`institution_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
