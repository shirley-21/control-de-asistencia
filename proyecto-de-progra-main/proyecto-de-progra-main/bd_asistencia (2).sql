-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3360
-- Tiempo de generación: 22-01-2021 a las 00:48:06
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_asistencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `codigo_asignatura` char(18) NOT NULL,
  `nombre` char(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `fecha` char(18) DEFAULT NULL,
  `observaciones` char(18) DEFAULT NULL,
  `estado` char(18) DEFAULT NULL,
  `ID_asistencia` char(18) NOT NULL,
  `codigo_estudiante` char(18) NOT NULL,
  `codigo_asignatura` char(18) NOT NULL,
  `codigo_docente` char(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `idusuario` char(18) DEFAULT NULL,
  `codigo_docente` char(18) NOT NULL,
  `nombre_docente` char(18) DEFAULT NULL,
  `apellido_docente` char(18) DEFAULT NULL,
  `correo_docente` char(18) DEFAULT NULL,
  `Telefono_docente` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_asignatura`
--

CREATE TABLE `docente_asignatura` (
  `codigo_asignatura` char(18) NOT NULL,
  `codigo_docente` char(18) NOT NULL,
  `semestre` char(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `codigo_estudiante` char(18) NOT NULL,
  `nombre` char(18) DEFAULT NULL,
  `apellidos` char(18) DEFAULT NULL,
  `idusuario` char(18) DEFAULT NULL,
  `correo` char(200) DEFAULT NULL,
  `Telefono` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`codigo_estudiante`, `nombre`, `apellidos`, `idusuario`, `correo`, `Telefono`) VALUES
('1005120182', 'Nico', 'Vila', 'k1.teddy', 'alexvq1003@hotmail.com', '965887485');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `codigo_estudiante` char(18) NOT NULL,
  `codigo_asignatura` char(18) NOT NULL,
  `semestre` char(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` char(18) NOT NULL,
  `contraseña` varchar(200) DEFAULT NULL,
  `rol` char(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `contraseña`, `rol`) VALUES
('k1.teddy', '$2y$10$361akhnaMx9wt9Ahuev5S.Q5EYoEtcJY0e/lNIgpbMfwN2RNKrZz2', 'Alumno');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`codigo_asignatura`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`ID_asistencia`),
  ADD KEY `R_12` (`codigo_estudiante`,`codigo_asignatura`),
  ADD KEY `R_13` (`codigo_asignatura`,`codigo_docente`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`codigo_docente`),
  ADD KEY `R_3` (`idusuario`);

--
-- Indices de la tabla `docente_asignatura`
--
ALTER TABLE `docente_asignatura`
  ADD PRIMARY KEY (`codigo_asignatura`,`codigo_docente`),
  ADD KEY `R_5` (`codigo_docente`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`codigo_estudiante`),
  ADD KEY `R_2` (`idusuario`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`codigo_estudiante`,`codigo_asignatura`),
  ADD KEY `R_4` (`codigo_asignatura`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `R_12` FOREIGN KEY (`codigo_estudiante`,`codigo_asignatura`) REFERENCES `matricula` (`codigo_estudiante`, `codigo_asignatura`),
  ADD CONSTRAINT `R_13` FOREIGN KEY (`codigo_asignatura`,`codigo_docente`) REFERENCES `docente_asignatura` (`codigo_asignatura`, `codigo_docente`);

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `R_3` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `docente_asignatura`
--
ALTER TABLE `docente_asignatura`
  ADD CONSTRAINT `R_5` FOREIGN KEY (`codigo_docente`) REFERENCES `docente` (`codigo_docente`),
  ADD CONSTRAINT `R_9` FOREIGN KEY (`codigo_asignatura`) REFERENCES `asignatura` (`codigo_asignatura`);

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `R_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `R_4` FOREIGN KEY (`codigo_asignatura`) REFERENCES `asignatura` (`codigo_asignatura`),
  ADD CONSTRAINT `R_7` FOREIGN KEY (`codigo_estudiante`) REFERENCES `estudiante` (`codigo_estudiante`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
