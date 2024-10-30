SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `autores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `biografia` varchar(2000) COLLATE utf8mb4_general_ci NOT NULL,
  `ruta_de_imagen` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `idiomas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `idiomas` (`nombre`) VALUES 
('Español'),
('Inglés'),
('Francés'),
('Alemán'),
('Italiano'),
('Portugués'),
('Ruso'),
('Chino'),
('Japonés'),
('Coreano'),
('Árabe'),
('Hindi'),
('Griego'),
('Sueco'),
('Danés'),
('Finlandés'),
('Noruego'),
('Polaco'),
('Holandés'),
('Turco');

CREATE TABLE IF NOT EXISTS `libros` (
  `isbn` bigint NOT NULL,
  `titulo` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_de_publicacion` date NOT NULL,
  `editorial` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `idioma` int NOT NULL,
  `alto` smallint NOT NULL,
  `ancho` smallint NOT NULL,
  `grosor` smallint NOT NULL,
  `peso` mediumint NOT NULL,
  `encuadernado` enum('Tapa dura','Tapa blanda') COLLATE utf8mb4_general_ci NOT NULL,
  `sinopsis` varchar(2000) COLLATE utf8mb4_general_ci NOT NULL,
  `autor` int NOT NULL,
  `ruta_de_imagen` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`isbn`),
  KEY `idioma` (`idioma`,`autor`),
  KEY `libros_ibfk_1` (`autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `autores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`idioma`) REFERENCES `idiomas` (`id`) ON UPDATE CASCADE;



COMMIT;