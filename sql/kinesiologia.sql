-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-11-2025 a las 22:24:45
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
-- Estructura de tabla para la tabla `estados_sesiones`
--

DROP TABLE IF EXISTS `estados_sesiones`;
CREATE TABLE IF NOT EXISTS `estados_sesiones` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `estados_sesiones`
--

INSERT INTO `estados_sesiones` (`id_estado`, `nombre`) VALUES
(1, 'pendiente'),
(2, 'proceso'),
(3, 'completada');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `fechas_horas`
--

INSERT INTO `fechas_horas` (`id_fechas_horas`, `fecha`, `hora`) VALUES
(1, '2025-11-03', '08:15:00'),
(2, '2025-11-03', '17:30:00'),
(3, '2025-11-04', '18:45:00'),
(4, '2025-11-20', '19:50:00'),
(5, '2025-11-04', '21:07:00'),
(6, '2025-11-09', '19:07:00'),
(7, '2025-11-14', '20:30:00'),
(8, '2025-11-21', '20:35:00'),
(9, '2025-11-29', '01:05:00'),
(10, '2025-11-13', '21:58:00'),
(11, '2025-11-29', '20:00:00'),
(12, '2025-11-15', '02:30:00'),
(13, '2025-11-15', '02:00:00'),
(14, '2025-11-17', '17:40:00'),
(15, '2025-11-10', '17:50:00'),
(16, '2025-11-17', '22:40:00'),
(17, '2025-11-29', '20:42:00'),
(18, '2025-11-19', '19:44:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `metodos_pago`
--

INSERT INTO `metodos_pago` (`id_metodos_pago`, `nombre`) VALUES
(1, 'efectivo'),
(2, 'tarjeta credito'),
(3, 'tarjeta debito'),
(4, 'transferencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_sesiones`
--

DROP TABLE IF EXISTS `pago_sesiones`;
CREATE TABLE IF NOT EXISTS `pago_sesiones` (
  `fk_metodos_pago` int NOT NULL,
  `fk_sesiones` int NOT NULL,
  PRIMARY KEY (`fk_metodos_pago`,`fk_sesiones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `pago_sesiones`
--

INSERT INTO `pago_sesiones` (`fk_metodos_pago`, `fk_sesiones`) VALUES
(1, 2),
(1, 3),
(1, 13),
(1, 15),
(2, 3),
(2, 7),
(2, 17),
(3, 7),
(3, 13),
(3, 15),
(4, 17);

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
  `fk_rol` int NOT NULL,
  `contrasenia` varchar(45) NOT NULL,
  PRIMARY KEY (`id_personas`),
  UNIQUE KEY `id_personas_UNIQUE` (`id_personas`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_personas`, `nombre`, `apellido`, `dni`, `fecha_nacimiento`, `telefono`, `email`, `fk_rol`, `contrasenia`) VALUES
(1, 'marcos', 'di filippo', 1111, '2007-06-26', 3525, 'admin@gmail.com', 1, '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'juan', 'perez', 2222, '2005-06-26', 3525555, 'secretario@gmail.com', 2, '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'benicio', 'mercante2', 14151421, '2006-02-02', 15151242, 'benicio@gmail.com', 3, '202cb962ac59075b964b07152d234b70'),
(10, 'benja', 'beltramini', 46372623, '2007-06-26', 15162452, 'benja@gmail.com', 3, '202cb962ac59075b964b07152d234b70'),
(13, 'galo', 'rose', 32674234, '2006-10-23', 47251331, 'galo@gmail.com', 3, '202cb962ac59075b964b07152d234b70'),
(14, 'marcos', 'prueba', 47911625, '2006-06-26', 678942, 'marcosp@gmail.com', 3, '0cc175b9c0f1b6a831c399e269772661');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  UNIQUE KEY `id_rol` (`id_rol`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`) VALUES
(1, 'admin'),
(2, 'secretario'),
(3, 'paciente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

DROP TABLE IF EXISTS `sesiones`;
CREATE TABLE IF NOT EXISTS `sesiones` (
  `id_sesiones` int NOT NULL AUTO_INCREMENT,
  `detalles` tinytext,
  `imagen` varchar(100) DEFAULT NULL,
  `fk_personas` int NOT NULL,
  `fk_fechas_horas` int NOT NULL,
  `fk_estado_sesion` int NOT NULL,
  `monto` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_sesiones`,`fk_fechas_horas`),
  UNIQUE KEY `id_sesiones_UNIQUE` (`id_sesiones`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`id_sesiones`, `detalles`, `imagen`, `fk_personas`, `fk_fechas_horas`, `fk_estado_sesion`, `monto`) VALUES
(2, '21000 + comision que es 3000', '1763063801.jpg', 10, 10, 3, 21000),
(3, 'a', '1763158173.jpg', 3, 11, 3, 12000),
(7, 'holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaholaaaaaaaaaaaa', '1763404852.jpg', 13, 18, 2, 34566);

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

--
-- Volcado de datos para la tabla `sesiones_tratamientos`
--

INSERT INTO `sesiones_tratamientos` (`fk_sesiones`, `fk_tratamientos`) VALUES
(2, 2),
(3, 1),
(7, 2),
(7, 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tratamientos`
--

INSERT INTO `tratamientos` (`id_tratamientos`, `nombre`) VALUES
(1, 'Masajes'),
(2, 'Electrodos'),
(3, 'Ultrasonido'),
(4, 'Rehabilitacion'),
(5, 'Estiramientos'),
(6, 'Fisioterapia'),
(7, 'Kinesiologia deportiva'),
(9, 'Termoterapia'),
(14, 'Nutricionista');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
