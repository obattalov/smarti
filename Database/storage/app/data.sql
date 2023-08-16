-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.4.28-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*
DROP TABLE IF EXISTS `pokemons`;
DROP TABLE IF EXISTS `types`;
DROP TABLE IF EXISTS `type_pokemon`;
*/

DROP TABLE IF EXISTS `pokemons`;
CREATE TABLE IF NOT EXISTS `pokemons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `pokemons`;
INSERT INTO `pokemons` (`id`, `name`, `image`, `weight`) VALUES
	(1, 'Charmander', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/charmander.avif', 560),
	(2, 'Pidgeys', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/pidgey.avif', 300),
	(4, 'Beedrilly', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/zubat.avif', 200),
	(5, 'Kakunat', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/kakuna.avif', 400),
	(6, 'Weedle', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/weedle.avif', 430),
	(7, 'Butterfreeze', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/butterfree.avif', 1200),
	(8, 'Pidgey', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/vileplume.avif', 900),
	(9, 'Beedrill', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/beedrill.avif', 1000),
	(10, 'Kakuna', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/meowth.avif', 1000),
	(11, 'Weedler', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/nidoran-f.avif', 760),
	(12, 'Butterfree', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/venonat.avif', 840),
	(13, 'Metapod', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/metapod.avif', 760),
	(14, 'Caterpie', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/caterpie.avif', 220),
	(15, 'Blastoise', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/blastoise.avif', 345),
	(16, 'Wartortle', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/wartortle.avif', 890),
	(17, 'Squirtle', 'https://img.pokemondb.net/sprites/home/normal/2x/avif/squirtle.avif', 896);

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `types`;
INSERT INTO `types` (`id`, `name`) VALUES
	(1, 'type1'),
	(2, 'type2'),
	(3, 'type3'),
	(4, 'type4'),
	(5, 'type5'),
	(6, 'type6'),
	(7, 'type7');

DROP TABLE IF EXISTS `type_pokemon`;
CREATE TABLE IF NOT EXISTS `type_pokemon` (
  `pokemon_id` bigint(20) unsigned NOT NULL,
  `type_id` bigint(20) unsigned NOT NULL,
  KEY `type_pokemon_pokemon_id_foreign` (`pokemon_id`),
  KEY `type_pokemon_type_id_foreign` (`type_id`),
  CONSTRAINT `type_pokemon_pokemon_id_foreign` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `type_pokemon_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DELETE FROM `type_pokemon`;
INSERT INTO `type_pokemon` (`pokemon_id`, `type_id`) VALUES
	(1, 1),
	(1, 3),
	(2, 2),
	(2, 3),
	(9, 3),
	(9, 6),
	(4, 5),
	(15, 2),
	(15, 4),
	(12, 5),
	(7, 1),
	(7, 4),
	(7, 3),
	(14, 2),
	(10, 5),
	(5, 6),
	(13, 2),
	(13, 4),
	(8, 1),
	(17, 6),
	(16, 5),
	(6, 4),
	(11, 5),
	(11, 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
