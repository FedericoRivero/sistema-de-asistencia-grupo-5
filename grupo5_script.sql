-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2021 a las 16:13:09
-- Versión del servidor: 10.1.39-MariaDB
-- Versión de PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grupo5`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `email` varchar(40) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `dni` varchar(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `telefono` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`email`, `created_at`, `updated_at`, `dni`, `nombre`, `apellido`, `telefono`) VALUES
('alicialaura@gmail.com', '2021-12-16 20:10:34', '2021-12-17 06:59:49', '39123456', 'Alicia laura', 'Sepulveda C', '2645414456'),
('fede@gmail.com', '2021-12-16 20:10:07', '2021-12-17 06:34:07', '39653545', 'Federico Gu', 'Rivero', '2645414545'),
('fer@gmail.com', '2021-12-16 20:09:38', '2021-12-16 20:09:38', '39653421', 'Fernando', 'Icazatti', '2645414841');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `nombre_curso` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `estado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `created_at`, `updated_at`, `nombre_curso`, `email`, `estado`) VALUES
(45, '2021-12-17 05:55:26', '2021-12-17 05:55:26', 'javascript', 'fede@gmail.com', 'P'),
(46, '2021-12-17 07:01:10', '2021-12-17 07:01:10', 'javascript', 'fede@gmail.com', 'P');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `nombre_curso` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `inicio` date NOT NULL,
  `final` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`nombre_curso`, `created_at`, `updated_at`, `inicio`, `final`) VALUES
('css', '2021-12-15 16:48:13', '2021-12-15 16:48:13', '2021-01-01', '2021-12-31'),
('html', '2021-12-15 16:48:13', '2021-12-15 16:48:13', '2021-01-01', '2021-12-31'),
('javascript', '2021-12-15 16:48:13', '2021-12-15 16:48:13', '2021-01-01', '2021-12-31'),
('php', '2021-12-15 04:24:42', '2021-12-15 04:24:42', '2021-12-08', '2021-12-22'),
('python', '2021-12-15 16:48:13', '2021-12-15 16:48:13', '2021-01-01', '2021-12-31'),
('sql', '2021-12-15 16:48:13', '2021-12-15 16:48:13', '2021-01-01', '2021-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `realiza`
--

CREATE TABLE `realiza` (
  `id_asistencia` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `nombre_curso` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `realiza`
--

INSERT INTO `realiza` (`id_asistencia`, `created_at`, `updated_at`, `nombre_curso`, `email`) VALUES
(1, '2021-12-20 00:48:16', '2021-12-17 06:59:49', 'javascript', 'alicialaura@gmail.com'),
(3, '2021-12-22 01:20:58', '2021-12-24 01:20:58', 'javascript', 'fede@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `nombre_curso` (`nombre_curso`,`email`),
  ADD KEY `email` (`email`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`nombre_curso`);

--
-- Indices de la tabla `realiza`
--
ALTER TABLE `realiza`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `nombre_curso` (`nombre_curso`,`email`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `realiza`
--
ALTER TABLE `realiza`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`email`) REFERENCES `alumnos` (`email`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`nombre_curso`) REFERENCES `cursos` (`nombre_curso`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
