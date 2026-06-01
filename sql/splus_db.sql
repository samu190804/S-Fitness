-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 01-06-2026 a las 07:42:37
-- Versión del servidor: 10.11.16-MariaDB-ubu2204
-- Versión de PHP: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `splus_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exercises`
--

CREATE TABLE `exercises` (
  `CodE` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Musculo` varchar(50) DEFAULT NULL,
  `Series` int(11) NOT NULL,
  `Repeticiones` int(11) NOT NULL,
  `Descripcion` text NOT NULL,
  `Video` text NOT NULL,
  `CodU` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `exercises`
--

INSERT INTO `exercises` (`CodE`, `Name`, `Musculo`, `Series`, `Repeticiones`, `Descripcion`, `Video`, `CodU`, `created_at`, `updated_at`) VALUES
(3, 'Press plano', 'Pecho', 3, 8, 'Press plano con barra', 'https://youtu.be/IkiKQEqR-kg?si=ODthNHm8glMSLBAs', 8, '2026-05-25 11:48:13', '2026-05-25 11:48:13'),
(4, 'Jalon al Pecho', 'Dorsales', 4, 8, 'Jalon al pecho con polea alta', 'https://youtu.be/IkiKQEqR-kg?si=ODthNHm8glMSLBAs', 8, '2026-05-25 11:48:49', '2026-05-25 11:48:49'),
(5, 'Extensión de cuádriceps', 'Cuádriceps', 3, 10, 'Extensión de cuádriceps en máquina', 'https://youtu.be/IkiKQEqR-kg?si=ODthNHm8glMSLBAs', 8, '2026-05-25 11:57:18', '2026-05-25 11:57:18'),
(6, 'Gemelo en maquina', 'Gemelo', 3, 12, 'Gemelo en maquina de platos', 'https://youtu.be/tlSUjGc_iYE?si=B66T3UwNYdI4UCpA', 5, '2026-05-26 09:57:26', '2026-05-26 09:57:26'),
(9, 'Sentadillas', 'Cuadriceps, Gluteo', 3, 8, 'asdasdasad', 'https://youtu.be/IkiKQEqR-kg?si=ODthNHm8glMSLBAs', 20, '2026-05-27 10:44:42', '2026-05-27 10:44:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '2026_03_12_111219_create_exercises_table', 1),
(3, '2026_03_12_112716_create_routines_table', 1),
(4, '2026_03_23_120243_create_routines_exercises_table', 1),
(5, '2026_04_17_080403_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 3, 'auth-token', '9aac910c45123aaf94fe1ca4a3545e86f0a864aeb764edf5e47b6f649b7f090c', '[\"*\"]', NULL, NULL, '2026-05-05 13:26:01', '2026-05-05 13:26:01'),
(2, 'App\\Models\\User', 3, 'auth-token', '52607cd97b79402b5d81d7f9df3ff3270d7f27d39ea6f199c14f26e18d89e3a8', '[\"*\"]', NULL, NULL, '2026-05-05 13:27:07', '2026-05-05 13:27:07'),
(3, 'App\\Models\\User', 3, 'auth-token', 'f2f2b6a1a9707e3e6cb32bc2e4db313b3b05e50a098276647074d90d76aba8e3', '[\"*\"]', NULL, NULL, '2026-05-05 13:27:57', '2026-05-05 13:27:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `routines`
--

CREATE TABLE `routines` (
  `CodR` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Dias` int(11) NOT NULL,
  `Duracion` int(11) NOT NULL,
  `Nivel` int(11) NOT NULL,
  `Musculos` varchar(50) NOT NULL,
  `Descripcion` text NOT NULL,
  `CodU` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `routines`
--

INSERT INTO `routines` (`CodR`, `Name`, `Dias`, `Duracion`, `Nivel`, `Musculos`, `Descripcion`, `CodU`, `created_at`, `updated_at`) VALUES
(1, 'Rutina de Torso', 2, 60, 2, 'Pecho, Dorsal', 'Rutina de pecho y dorsal', 8, '2026-05-26 08:13:14', '2026-05-26 08:13:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `routines_exercises`
--

CREATE TABLE `routines_exercises` (
  `CodR` bigint(20) UNSIGNED NOT NULL,
  `CodE` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `routines_exercises`
--

INSERT INTO `routines_exercises` (`CodR`, `CodE`) VALUES
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `CodU` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `Img` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`CodU`, `Name`, `UserName`, `Email`, `Password`, `admin`, `Img`, `created_at`, `updated_at`) VALUES
(5, 'elias mamon', 'elioFermentao', 'elioFermentao@gmail.com', '$2y$12$c8T9/UTtztHO3I6KBVKuNuGjtKhzWsy0GFeFwbIFHVWITNw.oO0l.', 0, NULL, '2026-05-05 13:10:00', '2026-05-05 13:10:00'),
(6, 'Samuel Villaescusa', 'Samu19', 'samu@example.com', '$2y$12$SqODO0XIZwRhNUv5I0F6euG3Qm4VUH9Yiv4WWsaMi0xUDP1lWXsxS', 0, NULL, '2026-05-06 08:31:36', '2026-05-06 08:31:36'),
(8, 'Jordan25555', 'Jordan23', 'jordan@gmail.com', '$2y$12$.CgW/M05EqvUQJDOXBrq1OrziFFlOSHDD8B6Nfv6HE69OWXt6b1jK', 0, 'profile-photos/aEC2bJy2oQuCHz77gvrZJH8ZYEEV99tYfRbTLW4O.jpg', '2026-05-19 08:18:33', '2026-05-27 11:24:19'),
(20, 'pruebaFoto', 'pruebaFotoUpdate', 'foto@gmail.com', '$2y$12$rFz.4Bmu1CZboabT9KfjTe7x6EtPQ6LUTjtU74ZX.DtYtq4jTNAl2', 0, 'profile-photos/8hFuaYzkwjLOGpu3Dl3VbKLiGwbCGUXyIhlbTVeV.jpg', '2026-05-27 10:25:38', '2026-05-27 11:21:53');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`CodE`),
  ADD KEY `exercises_codu_foreign` (`CodU`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indices de la tabla `routines`
--
ALTER TABLE `routines`
  ADD PRIMARY KEY (`CodR`),
  ADD KEY `routines_codu_foreign` (`CodU`);

--
-- Indices de la tabla `routines_exercises`
--
ALTER TABLE `routines_exercises`
  ADD PRIMARY KEY (`CodR`,`CodE`),
  ADD KEY `routines_exercises_code_foreign` (`CodE`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`CodU`),
  ADD UNIQUE KEY `users_username_unique` (`UserName`),
  ADD UNIQUE KEY `users_email_unique` (`Email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `exercises`
--
ALTER TABLE `exercises`
  MODIFY `CodE` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `routines`
--
ALTER TABLE `routines`
  MODIFY `CodR` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `CodU` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `exercises_codu_foreign` FOREIGN KEY (`CodU`) REFERENCES `users` (`CodU`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `routines`
--
ALTER TABLE `routines`
  ADD CONSTRAINT `routines_codu_foreign` FOREIGN KEY (`CodU`) REFERENCES `users` (`CodU`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `routines_exercises`
--
ALTER TABLE `routines_exercises`
  ADD CONSTRAINT `routines_exercises_code_foreign` FOREIGN KEY (`CodE`) REFERENCES `exercises` (`CodE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `routines_exercises_codr_foreign` FOREIGN KEY (`CodR`) REFERENCES `routines` (`CodR`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
