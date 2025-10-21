-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-10-2025 a las 21:19:51
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kinesiologia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas_horas`
--

DROP TABLE IF EXISTS `fechas_horas`;
CREATE TABLE IF NOT EXISTS `fechas_horas` (
  `id_fechas_horas` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id_fechas_horas`),
  UNIQUE KEY `id_fechas_horas_UNIQUE` (`id_fechas_horas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

DROP TABLE IF EXISTS `metodos_pago`;
CREATE TABLE IF NOT EXISTS `metodos_pago` (
  `id_metodos_pago` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id_metodos_pago`),
  UNIQUE KEY `id_metodos_pago_UNIQUE` (`id_metodos_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_sesiones`
--

DROP TABLE IF EXISTS `pago_sesiones`;
CREATE TABLE IF NOT EXISTS `pago_sesiones` (
  `fk_metodos_pago` int NOT NULL,
  `fk_sesiones` int NOT NULL,
  `monto` decimal(10,0) NOT NULL,
  PRIMARY KEY (`fk_metodos_pago`,`fk_sesiones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

DROP TABLE IF EXISTS `personas`;
CREATE TABLE IF NOT EXISTS `personas` (
  `id_personas` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `dni` int NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` int NOT NULL,
  `email` varchar(60) NOT NULL,
  `contrasenia` varchar(45) NOT NULL,
  `fk_tipo_persona` int NOT NULL,
  PRIMARY KEY (`id_personas`),
  UNIQUE KEY `id_personas_UNIQUE` (`id_personas`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_personas`, `nombre`, `apellido`, `dni`, `fecha_nacimiento`, `telefono`, `email`, `contrasenia`, `fk_tipo_persona`) VALUES
(1, 'marcos', 'di filippo', 1111, '2007-06-26', 3525, 'marcos@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(2, 'juan', 'perez', 2222, '2005-06-26', 4000, 'secretario@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

DROP TABLE IF EXISTS `sesiones`;
CREATE TABLE IF NOT EXISTS `sesiones` (
  `id_sesiones` int NOT NULL AUTO_INCREMENT,
  `detalles` tinytext,
  `fk_personas` int NOT NULL,
  `fk_fechas_horas` int NOT NULL,
  PRIMARY KEY (`id_sesiones`,`fk_fechas_horas`),
  UNIQUE KEY `id_sesiones_UNIQUE` (`id_sesiones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones_tratamientos`
--

DROP TABLE IF EXISTS `sesiones_tratamientos`;
CREATE TABLE IF NOT EXISTS `sesiones_tratamientos` (
  `fk_sesiones` int NOT NULL,
  `fk_tratamientos` int NOT NULL,
  PRIMARY KEY (`fk_sesiones`,`fk_tratamientos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_persona`
--

DROP TABLE IF EXISTS `tipo_persona`;
CREATE TABLE IF NOT EXISTS `tipo_persona` (
  `id_tipo_persona` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo_persona`),
  UNIQUE KEY `id_tipo_persona_UNIQUE` (`id_tipo_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tipo_persona`
--

INSERT INTO `tipo_persona` (`id_tipo_persona`, `nombre`) VALUES
(1, 'admin'),
(2, 'secretario'),
(3, 'paciente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

DROP TABLE IF EXISTS `tratamientos`;
CREATE TABLE IF NOT EXISTS `tratamientos` (
  `id_tratamientos` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tratamientos`),
  UNIQUE KEY `id_tratamientos_UNIQUE` (`id_tratamientos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
