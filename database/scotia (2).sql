-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-12-2018 a las 08:37:28
-- Versión del servidor: 5.7.19
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `scotia`
--
CREATE DATABASE IF NOT EXISTS `scotia` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `scotia`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `codigo`, `nombres`, `apellidos`, `activo`, `created_at`, `updated_at`) VALUES
(1, 's3307767', 'Rosa Cecilia', 'Ruiz Marquez', 1, '2018-11-28 04:24:23', NULL),
(2, 's7467126', 'David Hubert', 'Silva Cordova', 1, NULL, NULL),
(3, 's2574308', 'Cristhian Jesus', 'Terris Angeles', 1, NULL, NULL),
(4, 's1513AZ1', 'Anthony Richard', 'Zevallos Jaco', 1, NULL, NULL),
(5, 's1122446', 'Victor Andres', 'Barrientos Espinoza', 1, NULL, NULL),
(6, 's3089390', 'Junior Alex', 'Curay Hualpa', 1, NULL, NULL),
(7, 's3149503', 'Paul', 'Llantoy Gallegos', 1, NULL, NULL),
(8, 's6524867', 'Silver', 'Rodriguez Lopez', 1, NULL, NULL),
(9, 's7892162', 'Victor', 'Dedios Champa', 1, NULL, NULL),
(10, 's3355008', 'Enrique', 'Gamarra Romero', 1, NULL, NULL),
(11, 's2428231', 'Frank Pool', 'Carrasco Trujillo', 1, NULL, NULL),
(12, 's6872846', 'Juan Omar', 'Motta Vega', 1, NULL, NULL),
(13, 's7309391', 'Miguel Angel', 'Quineche Noguchi', 1, NULL, NULL),
(14, 's5229321', 'Cesar Ruben', 'Garcia Silverio', 1, NULL, NULL),
(15, 's3775053', 'Jose Adrian', 'Huaracha Panocca', 1, NULL, NULL),
(16, 's1359687', 'Cristian Velery', 'Soto Villacris', 1, NULL, NULL),
(17, 's1126641', 'Andres Angel', 'Villanueva Melgarejo', 1, NULL, NULL),
(18, 's4296933', 'Jhordan Felix', 'Quilca Gutierrez', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleadosproyecto`
--

CREATE TABLE `empleadosproyecto` (
  `id` int(11) NOT NULL,
  `idProyecto` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleadosproyecto`
--

INSERT INTO `empleadosproyecto` (`id`, `idProyecto`, `idEmpleado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 2, 5, NULL, NULL),
(6, 2, 6, NULL, NULL),
(7, 2, 7, NULL, NULL),
(8, 2, 8, NULL, NULL),
(9, 3, 9, NULL, NULL),
(10, 3, 10, NULL, NULL),
(11, 3, 11, NULL, NULL),
(12, 3, 12, NULL, NULL),
(13, 3, 13, NULL, NULL),
(14, 3, 14, NULL, NULL),
(15, 3, 15, NULL, NULL),
(16, 3, 16, NULL, NULL),
(17, 3, 17, NULL, NULL),
(18, 3, 18, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcacions`
--

CREATE TABLE `marcacions` (
  `id` int(10) UNSIGNED NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `idTurno` int(11) NOT NULL,
  `entrada` datetime DEFAULT NULL,
  `salida` datetime DEFAULT NULL,
  `minutosTardanza` int(11) DEFAULT NULL,
  `horasEfectivas` int(11) DEFAULT NULL,
  `minutosEfectivos` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marcacions`
--

INSERT INTO `marcacions` (`id`, `idEmpleado`, `idTurno`, `entrada`, `salida`, `minutosTardanza`, `horasEfectivas`, `minutosEfectivos`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2018-11-28 04:50:00', NULL, NULL, NULL, NULL, '2018-11-28 09:50:00', '2018-11-28 09:50:00'),
(2, 1, 1, '2018-11-28 04:51:55', NULL, NULL, NULL, NULL, '2018-11-28 09:51:55', '2018-11-28 09:51:55'),
(3, 1, 1, '2018-11-28 04:57:32', NULL, NULL, NULL, NULL, '2018-11-28 09:57:32', '2018-11-28 09:57:32'),
(4, 2, 2, '2018-11-28 04:57:54', NULL, NULL, NULL, NULL, '2018-11-28 09:57:54', '2018-11-28 09:57:54'),
(5, 2, 2, '2018-11-29 04:57:58', '2018-11-29 00:47:12', NULL, NULL, NULL, '2018-11-28 09:57:58', '2018-11-29 05:47:12'),
(6, 4, 4, '2018-11-29 04:58:07', '2018-11-29 00:47:32', NULL, NULL, NULL, '2018-11-28 09:58:07', '2018-11-29 05:47:32'),
(7, 1, 1, '2018-11-29 04:58:12', '2018-11-29 00:53:34', NULL, NULL, NULL, '2018-11-28 09:58:12', '2018-11-29 05:53:34'),
(8, 3, 1, '2018-11-29 22:04:42', NULL, NULL, NULL, NULL, '2018-11-30 03:04:42', '2018-11-30 03:04:42'),
(9, 2, 2, '2018-11-30 02:16:18', '2018-11-30 03:42:38', NULL, 8, 2, '2018-11-30 07:16:18', '2018-11-30 08:42:38'),
(10, 3, 3, '2018-11-30 02:18:08', '2018-11-30 03:40:15', NULL, 9, 2, '2018-11-30 07:18:08', '2018-11-30 08:40:15'),
(11, 1, 1, '2018-11-30 02:34:59', '2018-11-30 03:41:26', NULL, 7, 2, '2018-11-30 07:34:59', '2018-11-30 08:41:27'),
(12, 1, 1, '2018-12-02 20:43:23', '2018-12-02 23:16:35', NULL, 3, 33, '2018-12-03 01:43:24', '2018-12-03 04:16:35'),
(13, 9, 1, '2018-12-02 23:17:04', NULL, NULL, NULL, NULL, '2018-12-03 04:17:04', '2018-12-03 04:17:04'),
(14, 18, 1, '2018-12-02 23:18:04', NULL, NULL, NULL, NULL, '2018-12-03 04:18:04', '2018-12-03 04:18:04'),
(15, 1, 1, '2018-12-03 02:39:23', '2018-12-03 02:40:16', NULL, 0, 0, '2018-12-03 07:39:23', '2018-12-03 07:40:16'),
(16, 5, 5, '2018-12-03 02:40:03', '2018-12-03 02:40:23', NULL, 0, 0, '2018-12-03 07:40:03', '2018-12-03 07:40:23'),
(17, 12, 1, '2018-12-03 02:40:34', NULL, NULL, NULL, NULL, '2018-12-03 07:40:34', '2018-12-03 07:40:34'),
(18, 3, 1, '2018-12-03 02:40:41', NULL, NULL, NULL, NULL, '2018-12-03 07:40:41', '2018-12-03 07:40:41'),
(19, 11, 11, '2018-12-03 02:40:48', '2018-12-03 02:40:57', NULL, 0, 0, '2018-12-03 07:40:48', '2018-12-03 07:40:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2018_11_02_114356_crear_tabla_empleados', 2),
(7, '2018_11_02_114421_crear_tabla_proyectos', 2),
(8, '2018_11_02_114439_crear_tabla_turnos', 2),
(9, '2018_11_02_114501_crear_tabla_marcacions', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id`, `nombre`, `descripcion`, `inicio`, `fin`, `created_at`, `updated_at`) VALUES
(1, 'Migracion Office 365', NULL, NULL, NULL, NULL, NULL),
(2, 'Patch Seguridad de Windows', NULL, NULL, NULL, NULL, NULL),
(3, 'Soporte a Usuarios SBP', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `codigo`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'FT-M', 'Turno Mañana - Lunes a Viernes 9:00 - 18:00', NULL, NULL),
(2, 'FT-MT', 'Turno Mañana Extendido - Lunes a Viernes 10:00 - 19:00', NULL, NULL),
(3, 'FT-ME', 'Turno Mañana Extendido - Lunes a Viernes 9:00 - 19:00', NULL, NULL),
(4, 'FT-T', 'Turno Tarde - Lunes a Viernes 9:00 - 19:00', NULL, NULL),
(5, 'FT-T', 'Turno Sabado 1 - Sabado 9:00 - 13:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnosproyecto`
--

CREATE TABLE `turnosproyecto` (
  `id` int(11) NOT NULL,
  `idProyecto` int(11) NOT NULL,
  `idTurno` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `turnosproyecto`
--

INSERT INTO `turnosproyecto` (`id`, `idProyecto`, `idTurno`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 2, 2, NULL, NULL),
(5, 3, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$9wz8l4eLkg18Sfil5HpCr.bCsh1gbwLz6MY1C8AS/ddvYnnH6lbQ6', 'y8nRtSGA1z8lU8QrNGDSEw63KpI4ORzVI9pWcBJVEKBBU52T8t6oKhOm4p8w', '2018-12-03 05:09:32', '2018-12-03 05:09:32');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleadosproyecto`
--
ALTER TABLE `empleadosproyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcacions`
--
ALTER TABLE `marcacions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turnosproyecto`
--
ALTER TABLE `turnosproyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `empleadosproyecto`
--
ALTER TABLE `empleadosproyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `marcacions`
--
ALTER TABLE `marcacions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `turnosproyecto`
--
ALTER TABLE `turnosproyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
