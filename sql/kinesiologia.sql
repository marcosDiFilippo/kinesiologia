-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-11-2025 a las 19:05:42
-- Versión del servidor: 10.11.13-MariaDB-0ubuntu0.24.04.1
-- Versión de PHP: 8.3.6

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
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id_admins` int(11) NOT NULL,
  `contrasenia` varchar(45) NOT NULL,
  `fk_personas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id_admins`, `contrasenia`, `fk_personas`) VALUES
(1, '81dc9bdb52d04dc20036dbd8313ed055', 1),
(2, '81dc9bdb52d04dc20036dbd8313ed055', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_sesiones`
--

CREATE TABLE `estados_sesiones` (
  `id_estado` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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

CREATE TABLE `fechas_horas` (
  `id_fechas_horas` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
(7, '2025-11-14', '20:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

CREATE TABLE `metodos_pago` (
  `id_metodos_pago` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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

CREATE TABLE `pago_sesiones` (
  `fk_metodos_pago` int(11) NOT NULL,
  `fk_sesiones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `pago_sesiones`
--

INSERT INTO `pago_sesiones` (`fk_metodos_pago`, `fk_sesiones`) VALUES
(1, 10),
(1, 13),
(1, 15),
(1, 16),
(2, 10),
(3, 13),
(3, 15),
(3, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_personas` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `dni` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `fk_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_personas`, `nombre`, `apellido`, `dni`, `fecha_nacimiento`, `telefono`, `email`, `fk_rol`) VALUES
(1, 'marcos', 'di filippo', 1111, '2007-06-26', 3525, 'admin@gmail.com', 1),
(2, 'juan', 'perez', 2222, '2005-06-26', 3525555, 'secretario@gmail.com', 2),
(3, 'beniciooooo', 'mercanteeeeee', 14151421, '2006-02-02', 15151242, 'benicio@gmail.com', 3),
(9, 'galo', 'rose', 13511241, '2025-11-07', 6311513, 'galo@gmail.com', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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

CREATE TABLE `sesiones` (
  `id_sesiones` int(11) NOT NULL,
  `detalles` tinytext DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `fk_personas` int(11) NOT NULL,
  `fk_fechas_horas` int(11) NOT NULL,
  `fk_estado_sesion` int(11) NOT NULL,
  `monto` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`id_sesiones`, `detalles`, `imagen`, `fk_personas`, `fk_fechas_horas`, `fk_estado_sesion`, `monto`) VALUES
(10, 'a', '1762164759.jpg', 3, 1, 3, 22222),
(16, 'gal rose', '1762547412.jpg', 9, 7, 3, 45000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones_tratamientos`
--

CREATE TABLE `sesiones_tratamientos` (
  `fk_sesiones` int(11) NOT NULL,
  `fk_tratamientos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `sesiones_tratamientos`
--

INSERT INTO `sesiones_tratamientos` (`fk_sesiones`, `fk_tratamientos`) VALUES
(10, 1),
(10, 2),
(10, 3),
(13, 1),
(13, 3),
(13, 5),
(15, 5),
(15, 6),
(15, 9),
(16, 1),
(16, 3),
(16, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

CREATE TABLE `tratamientos` (
  `id_tratamientos` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
(8, 'Crioterapia'),
(9, 'Termoterapia');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admins`),
  ADD UNIQUE KEY `id_admins_UNIQUE` (`id_admins`);

--
-- Indices de la tabla `estados_sesiones`
--
ALTER TABLE `estados_sesiones`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `fechas_horas`
--
ALTER TABLE `fechas_horas`
  ADD PRIMARY KEY (`id_fechas_horas`),
  ADD UNIQUE KEY `id_fechas_horas_UNIQUE` (`id_fechas_horas`);

--
-- Indices de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  ADD PRIMARY KEY (`id_metodos_pago`),
  ADD UNIQUE KEY `id_metodos_pago_UNIQUE` (`id_metodos_pago`);

--
-- Indices de la tabla `pago_sesiones`
--
ALTER TABLE `pago_sesiones`
  ADD PRIMARY KEY (`fk_metodos_pago`,`fk_sesiones`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_personas`),
  ADD UNIQUE KEY `id_personas_UNIQUE` (`id_personas`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD UNIQUE KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id_sesiones`,`fk_fechas_horas`),
  ADD UNIQUE KEY `id_sesiones_UNIQUE` (`id_sesiones`);

--
-- Indices de la tabla `sesiones_tratamientos`
--
ALTER TABLE `sesiones_tratamientos`
  ADD PRIMARY KEY (`fk_sesiones`,`fk_tratamientos`);

--
-- Indices de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD PRIMARY KEY (`id_tratamientos`),
  ADD UNIQUE KEY `id_tratamientos_UNIQUE` (`id_tratamientos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admins` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estados_sesiones`
--
ALTER TABLE `estados_sesiones`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fechas_horas`
--
ALTER TABLE `fechas_horas`
  MODIFY `id_fechas_horas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `id_metodos_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_personas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id_sesiones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `id_tratamientos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
