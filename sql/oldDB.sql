-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2024 a las 19:48:44
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
-- Base de datos: `4485667_splusfitness`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `CodC` int(11) NOT NULL,
  `Valoracion` tinyint(4) NOT NULL,
  `Comentario` text NOT NULL,
  `CodU` int(11) NOT NULL,
  `CodR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE `ejercicios` (
  `CodE` int(11) NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Musculo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Series` int(11) NOT NULL,
  `Repeticiones` int(11) NOT NULL,
  `Descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Video` text NOT NULL,
  `CodU` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`CodE`, `Name`, `Musculo`, `Series`, `Repeticiones`, `Descripcion`, `Video`, `CodU`) VALUES
(1, 'Press de banca', 'Pecho', 3, 8, 'Press de banca plano con barra, entrenamiento de hipertrofia a 8 repeticiones con RIR 0 o 1.', 'https://www.youtube.com/embed/AePT3lqlaTQ?si=R51Oqc6g4pDbBH4p', 1),
(2, 'Aperturas en maquina', 'Pecho', 4, 10, 'Aperturas/contractora de pecho en maquina. Entrenamiento de hipertrofia.', 'https://www.youtube.com/embed/AePT3lqlaTQ?si=R51Oqc6g4pDbBH4p', 1),
(3, 'Extensión de cuadriceps', 'Cuadriceps', 4, 10, 'Extensión de cuádriceps en maquina de discos o de platos. Entrenamiento de hipertrofia.', 'https://www.youtube.com/embed/AePT3lqlaTQ?si=R51Oqc6g4pDbBH4p', 1),
(4, 'Tríceps en polea alta unilateral', 'Tríceps', 3, 12, 'Tríceps en polea alta con trenza de forma unilateral. Entrenamiento de hipertrofia.', 'https://www.youtube.com/embed/AePT3lqlaTQ?si=R51Oqc6g4pDbBH4p', 1),
(5, 'Jalón al pecho', 'Dorsales', 3, 8, 'Jalón al pecho con agarre abierto para incidir en los dorsales. Entrenamiento de hipertrofia', 'https://www.youtube.com/embed/AePT3lqlaTQ?si=R51Oqc6g4pDbBH4p', 2),
(6, 'Bicep con barra z', 'Biceps', 3, 4, 'Curl de bicep en barra en Z. Bajas repeticiones bastante peso. Entrenamiento de fuerza. ', 'https://www.youtube.com/embed/AePT3lqlaTQ?si=R51Oqc6g4pDbBH4p', 2),
(7, 'Curl femoral tumbado', 'Isquiotiviales', 4, 10, 'Curl femoral en maquina tumbada. Entrenamiento de hipertrofia.', 'https://www.youtube.com/embed/AePT3lqlaTQ?si=R51Oqc6g4pDbBH4p', 3),
(8, 'Sentadilla', 'Cuadriceps y Gluteo', 3, 6, 'Sentadilla libre con barra a bajas repeticiones y bastante peso. Entrenamiento de fuerza.', 'https://www.youtube.com/embed/AePT3lqlaTQ?si=R51Oqc6g4pDbBH4p', 3),
(19, 'Hiptrust', 'Gluteo', 4, 12, 'culete', 'https://www.youtube.com/embed/ABmezufBQqc?si=y0NrHtZyBb2rk75-', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutinas`
--

CREATE TABLE `rutinas` (
  `CodR` int(11) NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Dias` int(11) NOT NULL,
  `Duracion` int(11) NOT NULL,
  `Nivel` int(11) NOT NULL,
  `Musculos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `Descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `CodU` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutinas`
--

INSERT INTO `rutinas` (`CodR`, `Name`, `Dias`, `Duracion`, `Nivel`, `Musculos`, `Descripcion`, `CodU`) VALUES
(1, 'Rutina Empuje', 2, 60, 2, 'Pecho, tríceps', 'Rutina de dos días semanales para empuje', 1),
(2, 'Rutina de pierna', 1, 90, 3, 'Cuádriceps, glúteo y isquiotiv', 'Rutina de pierna de un día semanal', 1),
(3, 'Rutina de tiron', 1, 30, 1, 'Dorsales, bíceps', 'Rutina de un día semanal de tirón.', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutinas_ejercicios`
--

CREATE TABLE `rutinas_ejercicios` (
  `CodR` int(11) NOT NULL,
  `CodE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutinas_ejercicios`
--

INSERT INTO `rutinas_ejercicios` (`CodR`, `CodE`) VALUES
(1, 2),
(1, 1),
(1, 4),
(2, 7),
(2, 3),
(3, 5),
(3, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `CodU` int(11) NOT NULL,
  `Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `Img` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`CodU`, `Name`, `UserName`, `Email`, `Password`, `admin`, `Img`) VALUES
(1, 'Samuel', 'Samuel1984', 'samueltfg190804@gmail.com', '$2y$10$kHePj6gMo6gCMchzL/AXt.dVSyk6ievWX27s6o1dAI3vqh7psm.02', 1, 'Public/20240611_151451.jpg'),
(2, 'Samuel2', 'Simo6988', 'simonelviseras@gmail.com', '$2y$10$/v/jYxANmnJ7bDUZ3KmjnevBsOOOejppQW9d8Itg.uToPWcceUtMe', 0, 'Public/20240611_151537.png'),
(3, 'Jorge', 'Jorge1984', 'jorgenitales190804@gmail.com', '$2y$10$ObZxV2iwG3TrLP3.LmRvz.CGGWgOFb3PzjwCnDQhbtf.XQMc15dwK', 0, 'Public/20240611_151604.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`CodC`),
  ADD KEY `CodU` (`CodU`),
  ADD KEY `CodR` (`CodR`);

--
-- Indices de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD PRIMARY KEY (`CodE`),
  ADD KEY `CodU` (`CodU`);

--
-- Indices de la tabla `rutinas`
--
ALTER TABLE `rutinas`
  ADD PRIMARY KEY (`CodR`),
  ADD KEY `CodU` (`CodU`);

--
-- Indices de la tabla `rutinas_ejercicios`
--
ALTER TABLE `rutinas_ejercicios`
  ADD KEY `CodR` (`CodR`),
  ADD KEY `CodE` (`CodE`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`CodU`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `CodC` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  MODIFY `CodE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `rutinas`
--
ALTER TABLE `rutinas`
  MODIFY `CodR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `CodU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `Comentarios_ibfk_1` FOREIGN KEY (`CodU`) REFERENCES `usuarios` (`CodU`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Comentarios_ibfk_2` FOREIGN KEY (`CodR`) REFERENCES `rutinas` (`CodR`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD CONSTRAINT `Ejercicios_ibfk_1` FOREIGN KEY (`CodU`) REFERENCES `usuarios` (`CodU`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rutinas`
--
ALTER TABLE `rutinas`
  ADD CONSTRAINT `Rutinas_ibfk_1` FOREIGN KEY (`CodU`) REFERENCES `usuarios` (`CodU`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rutinas_ejercicios`
--
ALTER TABLE `rutinas_ejercicios`
  ADD CONSTRAINT `Rutinas_Ejercicios_ibfk_1` FOREIGN KEY (`CodE`) REFERENCES `ejercicios` (`CodE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Rutinas_Ejercicios_ibfk_2` FOREIGN KEY (`CodR`) REFERENCES `rutinas` (`CodR`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
