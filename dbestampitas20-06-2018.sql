-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2018 a las 07:55:57
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbestampitas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativos`
--

CREATE TABLE `correlativos` (
  `id` int(10) UNSIGNED NOT NULL,
  `cite` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` int(11) NOT NULL,
  `gestion` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` int(10) UNSIGNED NOT NULL,
  `cantidad_nueva` decimal(18,2) NOT NULL,
  `cantidad_actual` decimal(18,2) NOT NULL,
  `cantidad_total` decimal(18,2) NOT NULL,
  `idtematica` int(10) UNSIGNED NOT NULL,
  `userid_registra` int(10) UNSIGNED NOT NULL,
  `userid_actualiza` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(15, '2018_06_19_234841_create_tematica_table', 2),
(16, '2018_06_20_001011_create_correlativo_table', 3),
(17, '2018_06_20_001654_create_unidad_table', 4),
(18, '2018_06_20_001825_create_regional_table', 5),
(19, '2018_06_20_002442_create_ingreso_table', 6),
(21, '2018_06_20_003332_create_salida_table', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('edwincon85@hotmail.com', '$2y$10$oi7dON/9aWYtygr5EVpm2uGuXjGDMXu/5Y0tteVMKMTBZ/NtzNJee', '2017-11-01 21:03:38'),
('sistemas@zaire.com.bo', '$2y$10$wM6g.FXZAz3Pn33Xy265Ae05IEMfEBpSdyrC3Q/t3PdpC/395LgzK', '2017-11-01 21:24:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regionales`
--

CREATE TABLE `regionales` (
  `id` int(10) UNSIGNED NOT NULL,
  `regional` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `idunidad` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha_salida` date NOT NULL,
  `cite_manual` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idunidad` int(10) UNSIGNED NOT NULL,
  `idregional` int(10) UNSIGNED NOT NULL,
  `idtematica` int(10) UNSIGNED NOT NULL,
  `cantidad_actual` decimal(18,2) NOT NULL,
  `cantidad_salida` decimal(18,2) NOT NULL,
  `costo` decimal(18,2) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `correlativo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid_registra` int(10) UNSIGNED NOT NULL,
  `userid_actualiza` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tematicas`
--

CREATE TABLE `tematicas` (
  `id` int(10) UNSIGNED NOT NULL,
  `tematica` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo_inicial` decimal(18,2) NOT NULL,
  `saldo_actual` decimal(18,2) NOT NULL,
  `costo` decimal(18,2) NOT NULL,
  `userid_registra` int(10) UNSIGNED NOT NULL,
  `userid_actualiza` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id` int(10) UNSIGNED NOT NULL,
  `unidad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `us_ci` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `us_nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `us_paterno` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `us_materno` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `us_genero` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `us_cuenta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `us_tipo` enum('ADMINISTRADOR','USUARIO') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `us_estado` tinyint(1) NOT NULL DEFAULT '1',
  `us_obs` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `us_estadociv` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `us_condicion` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `us_sueldo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `us_cargo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `us_direccion` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `us_unidad` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `us_ci`, `us_nombre`, `us_paterno`, `us_materno`, `us_genero`, `email`, `us_cuenta`, `us_tipo`, `password`, `us_estado`, `us_obs`, `remember_token`, `created_at`, `updated_at`, `us_estadociv`, `us_condicion`, `us_sueldo`, `us_cargo`, `us_direccion`, `us_unidad`) VALUES
(1, '0', 'Administrador', 'Correos', 'Correos', 'Masculino', 'infocorreos@gmail.com', 'admin.correos', 'ADMINISTRADOR', '$2y$10$D2ZwWpwlzA8Ahr/XLoFU2O0MePQQ/QRY9Ks5dFar0863OxKlSHADW', 1, NULL, '1WEezw7bkLz0zfUok8tAWqId9zn8G4NF3d3R4MULEl8OJ0pC9CjE8wmC1yzw', '2017-11-27 15:53:28', '2018-06-14 15:54:20', 'SOLTERO', 'PERMANENTE', '0', 'Administrador', 'DIRECCION', 'LEGAL'),
(2, '6746059', 'Juan Carlos', 'Achoo', 'Ayala', 'Masculino', 'juancarlos.achoayala@gmail.com', 'juan.achoo', 'ADMINISTRADOR', '$2y$10$1s5YlAdfxhdSNzc/eCTkvO7HQphcL.86Ma.TxcDm7ZsFBkV5MJwAS', 1, NULL, 'CUbjAYryhHlGwKdQ54yt6FZXuCIZmQHRdHzhXDUV3rwCbvvr7DFUBJoTNvNA', '2018-06-14 19:25:57', '2018-06-14 19:25:57', 'SOLTERO', 'PERMANENTE', '8460', 'redes y sistemas', 'DIRECCION', 'LEGAL');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `correlativos`
--
ALTER TABLE `correlativos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingresos_idtematica_foreign` (`idtematica`),
  ADD KEY `ingresos_userid_registra_foreign` (`userid_registra`),
  ADD KEY `ingresos_userid_actualiza_foreign` (`userid_actualiza`);

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
-- Indices de la tabla `regionales`
--
ALTER TABLE `regionales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regionales_regional_unique` (`regional`),
  ADD KEY `regionales_idunidad_foreign` (`idunidad`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salidas_idunidad_foreign` (`idunidad`),
  ADD KEY `salidas_idregional_foreign` (`idregional`),
  ADD KEY `salidas_idtematica_foreign` (`idtematica`),
  ADD KEY `salidas_userid_registra_foreign` (`userid_registra`),
  ADD KEY `salidas_userid_actualiza_foreign` (`userid_actualiza`);

--
-- Indices de la tabla `tematicas`
--
ALTER TABLE `tematicas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tematicas_tematica_unique` (`tematica`),
  ADD KEY `tematicas_userid_registra_foreign` (`userid_registra`),
  ADD KEY `tematicas_userid_actualiza_foreign` (`userid_actualiza`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unidades_unidad_unique` (`unidad`);

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
-- AUTO_INCREMENT de la tabla `correlativos`
--
ALTER TABLE `correlativos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `regionales`
--
ALTER TABLE `regionales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tematicas`
--
ALTER TABLE `tematicas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_idtematica_foreign` FOREIGN KEY (`idtematica`) REFERENCES `tematicas` (`id`),
  ADD CONSTRAINT `ingresos_userid_actualiza_foreign` FOREIGN KEY (`userid_actualiza`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ingresos_userid_registra_foreign` FOREIGN KEY (`userid_registra`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `regionales`
--
ALTER TABLE `regionales`
  ADD CONSTRAINT `regionales_idunidad_foreign` FOREIGN KEY (`idunidad`) REFERENCES `unidades` (`id`);

--
-- Filtros para la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD CONSTRAINT `salidas_idregional_foreign` FOREIGN KEY (`idregional`) REFERENCES `regionales` (`id`),
  ADD CONSTRAINT `salidas_idtematica_foreign` FOREIGN KEY (`idtematica`) REFERENCES `tematicas` (`id`),
  ADD CONSTRAINT `salidas_idunidad_foreign` FOREIGN KEY (`idunidad`) REFERENCES `unidades` (`id`),
  ADD CONSTRAINT `salidas_userid_actualiza_foreign` FOREIGN KEY (`userid_actualiza`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `salidas_userid_registra_foreign` FOREIGN KEY (`userid_registra`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tematicas`
--
ALTER TABLE `tematicas`
  ADD CONSTRAINT `tematicas_userid_actualiza_foreign` FOREIGN KEY (`userid_actualiza`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tematicas_userid_registra_foreign` FOREIGN KEY (`userid_registra`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
