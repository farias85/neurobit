-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-10-2018 a las 16:58:16
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `neurobit`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE `asignacion` (
  `id` int(11) NOT NULL,
  `equipo` int(11) DEFAULT NULL,
  `prueba` int(11) DEFAULT NULL,
  `tiempo` int(11) NOT NULL,
  `disponible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `id` int(11) NOT NULL,
  `media` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `para_entity_id` int(11) NOT NULL,
  `para_entity_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `options` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicacion`
--

CREATE TABLE `indicacion` (
  `id` int(11) NOT NULL,
  `solicitud` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `tipo_media` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `entity_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `entity_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `procedencia` int(11) DEFAULT NULL,
  `ci` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` tinyint(1) NOT NULL,
  `edad` int(11) NOT NULL,
  `ingresado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Planificacion`
--

CREATE TABLE `planificacion` (
  `id` int(11) NOT NULL,
  `asignacion` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedencia`
--

CREATE TABLE `procedencia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `fuera_provincia` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE `prueba` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id` int(11) NOT NULL,
  `especialidad` int(11) DEFAULT NULL,
  `paciente` int(11) DEFAULT NULL,
  `especialista` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `motivo_consulta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `impresion_diagnostica` text COLLATE utf8_unicode_ci NOT NULL,
  `sintomas` text COLLATE utf8_unicode_ci,
  `signos` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_media`
--

CREATE TABLE `tipo_media` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `id` int(11) NOT NULL,
  `planificacion` int(11) DEFAULT NULL,
  `hora_inicio` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno_indicacion`
--

CREATE TABLE `turno_indicacion` (
  `turno` int(11) NOT NULL,
  `indicacion` int(11) NOT NULL,
  `fecha_real` datetime NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_25629271C49C530B` (`equipo`),
  ADD KEY `IDX_2562927146711E43` (`prueba`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6B12EC76A2CA10C` (`media`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `indicacion`
--
ALTER TABLE `indicacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1C9E0AF196D27CC0` (`solicitud`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6A2CA10C6C903BC4` (`tipo_media`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C6CBA95EBE7CFDCD` (`procedencia`);

--
-- Indices de la tabla `Planificacion`
--
ALTER TABLE `planificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_320E413D25629271` (`asignacion`);

--
-- Indices de la tabla `procedencia`
--
ALTER TABLE `procedencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_96D27CC0ACB064F9` (`especialidad`),
  ADD KEY `IDX_96D27CC0C6CBA95E` (`paciente`);

--
-- Indices de la tabla `tipo_media`
--
ALTER TABLE `tipo_media`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E7976762320E413D` (`planificacion`);

--
-- Indices de la tabla `turno_indicacion`
--
ALTER TABLE `turno_indicacion`
  ADD PRIMARY KEY (`turno`,`indicacion`),
  ADD KEY `IDX_63B7C9F6E7976762` (`turno`),
  ADD KEY `IDX_63B7C9F61C9E0AF1` (`indicacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `indicacion`
--
ALTER TABLE `indicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Planificacion`
--
ALTER TABLE `planificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `procedencia`
--
ALTER TABLE `procedencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_media`
--
ALTER TABLE `tipo_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD CONSTRAINT `FK_2562927146711E43` FOREIGN KEY (`prueba`) REFERENCES `prueba` (`id`),
  ADD CONSTRAINT `FK_25629271C49C530B` FOREIGN KEY (`equipo`) REFERENCES `equipo` (`id`);

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `FK_B6B12EC76A2CA10C` FOREIGN KEY (`media`) REFERENCES `media` (`id`);

--
-- Filtros para la tabla `indicacion`
--
ALTER TABLE `indicacion`
  ADD CONSTRAINT `FK_1C9E0AF196D27CC0` FOREIGN KEY (`solicitud`) REFERENCES `solicitud` (`id`);

--
-- Filtros para la tabla `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `FK_6A2CA10C6C903BC4` FOREIGN KEY (`tipo_media`) REFERENCES `tipo_media` (`id`);

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `FK_C6CBA95EBE7CFDCD` FOREIGN KEY (`procedencia`) REFERENCES `procedencia` (`id`);

--
-- Filtros para la tabla `Planificacion`
--
ALTER TABLE `planificacion`
  ADD CONSTRAINT `FK_320E413D25629271` FOREIGN KEY (`asignacion`) REFERENCES `asignacion` (`id`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `FK_96D27CC0ACB064F9` FOREIGN KEY (`especialidad`) REFERENCES `especialidad` (`id`),
  ADD CONSTRAINT `FK_96D27CC0C6CBA95E` FOREIGN KEY (`paciente`) REFERENCES `paciente` (`id`);

--
-- Filtros para la tabla `turno`
--
ALTER TABLE `turno`
  ADD CONSTRAINT `FK_E7976762320E413D` FOREIGN KEY (`planificacion`) REFERENCES `planificacion` (`id`);

--
-- Filtros para la tabla `turno_indicacion`
--
ALTER TABLE `turno_indicacion`
  ADD CONSTRAINT `FK_63B7C9F61C9E0AF1` FOREIGN KEY (`indicacion`) REFERENCES `indicacion` (`id`),
  ADD CONSTRAINT `FK_63B7C9F6E7976762` FOREIGN KEY (`turno`) REFERENCES `turno` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
