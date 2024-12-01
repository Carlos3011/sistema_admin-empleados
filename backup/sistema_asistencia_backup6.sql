-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2024 a las 23:10:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_asistencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `apellido`, `correo`, `password`, `activo`, `id_rol`) VALUES
(1, 'Carlos', 'García', 'admin@empresa.com', 'admin123', 1, 1),
(2, 'Ana', 'López', 'empleado@empresa.com', 'empleado123', 1, 2),
(3, 'Luis', 'Martínez', 'luis@empresa.com', 'empleado123', 1, 2),
(4, 'María', 'Garcia', 'maria@empresa.com', 'empleado123', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_turnos`
--

CREATE TABLE `empleados_turnos` (
  `id_asignacion` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_turno` int(11) NOT NULL,
  `fecha_asignacion` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados_turnos`
--

INSERT INTO `empleados_turnos` (`id_asignacion`, `id_empleado`, `id_turno`, `fecha_asignacion`) VALUES
(1, 1, 1, '2024-11-27'),
(2, 3, 3, '2024-11-27'),
(3, 4, 2, '2024-11-27'),
(4, 2, 1, '2024-11-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `tipo_permiso` varchar(100) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `estado` enum('pendiente','aprobado','rechazado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `id_empleado`, `tipo_permiso`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(2, 3, 'Vacaciones', '2024-11-26 08:00:00', '2024-11-26 17:00:00', 'pendiente'),
(7, 1, 'Vacaciones', '2024-11-30 02:00:00', '2024-11-30 11:03:00', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros_asistencia`
--

CREATE TABLE `registros_asistencia` (
  `id_registro` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `tipo_evento` enum('entrada','salida_a_comer','regreso_de_comer','salida_final') NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registros_asistencia`
--

INSERT INTO `registros_asistencia` (`id_registro`, `id_empleado`, `tipo_evento`, `fecha_hora`, `comentario`) VALUES
(1, 2, 'entrada', '2024-11-25 09:00:00', NULL),
(2, 2, 'salida_a_comer', '2024-11-25 13:00:00', NULL),
(3, 2, 'regreso_de_comer', '2024-11-25 14:00:00', NULL),
(4, 2, 'salida_final', '2024-11-25 17:00:00', NULL),
(5, 3, 'entrada', '2024-11-25 14:00:00', NULL),
(6, 3, 'salida_final', '2024-11-25 22:00:00', NULL),
(7, 1, 'entrada', '2024-12-01 13:59:56', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'administrador'),
(2, 'empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id_empleado` int(11) NOT NULL,
  `auth_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`id_empleado`, `auth_token`) VALUES
(1, 'ae1f263765b2426431f2b4e8d150342a'),
(2, '5be3c524b1865b7e7c0b83562acee1c2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos_laborales`
--

CREATE TABLE `turnos_laborales` (
  `id_turno` int(11) NOT NULL,
  `nombre_turno` varchar(100) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos_laborales`
--

INSERT INTO `turnos_laborales` (`id_turno`, `nombre_turno`, `hora_inicio`, `hora_fin`) VALUES
(1, 'Matutino', '07:00:00', '16:00:00'),
(2, 'Vespertino', '14:00:00', '22:00:00'),
(3, 'Nocturno', '22:00:00', '06:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `correo_2` (`correo`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `empleados_turnos`
--
ALTER TABLE `empleados_turnos`
  ADD PRIMARY KEY (`id_asignacion`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_turno` (`id_turno`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `registros_asistencia`
--
ALTER TABLE `registros_asistencia`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `turnos_laborales`
--
ALTER TABLE `turnos_laborales`
  ADD PRIMARY KEY (`id_turno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `empleados_turnos`
--
ALTER TABLE `empleados_turnos`
  MODIFY `id_asignacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `registros_asistencia`
--
ALTER TABLE `registros_asistencia`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `turnos_laborales`
--
ALTER TABLE `turnos_laborales`
  MODIFY `id_turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

--
-- Filtros para la tabla `empleados_turnos`
--
ALTER TABLE `empleados_turnos`
  ADD CONSTRAINT `empleados_turnos_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`),
  ADD CONSTRAINT `empleados_turnos_ibfk_2` FOREIGN KEY (`id_turno`) REFERENCES `turnos_laborales` (`id_turno`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`);

--
-- Filtros para la tabla `registros_asistencia`
--
ALTER TABLE `registros_asistencia`
  ADD CONSTRAINT `registros_asistencia_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`);

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `sesiones_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
