-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-07-2018 a las 07:14:02
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_INGRESOS` (IN `ingresoID` INT, IN `tematicaID` INT, IN `cantidad_nueva` DECIMAL(18,2))  BEGIN
	UPDATE tematicas
    SET saldo_actual = saldo_actual + cantidad_nueva
    WHERE tematicas.id = tematicaID;
    
	IF (SELECT count(*) FROM ingresos WHERE idtematica = tematicaID AND estado = true) > 1 THEN
		UPDATE ingresos
		SET ingresos.estado = FALSE
		WHERE ingresos.idtematica = tematicaID AND
			  ingresos.id <> ingresoID;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_SALIDAS_CORRELATIVO` (IN `salidaID` INT, IN `tematicaID` INT, IN `cantidad_salida` DECIMAL(18,2), IN `correlativoID` INT)  BEGIN
	UPDATE correlativos
    SET valor = valor + 1
    WHERE correlativos.id = correlativoID AND correlativos.estado=TRUE;
    
    UPDATE tematicas
    SET tematicas.saldo_actual = tematicas.saldo_actual - cantidad_salida
    WHERE tematicas.id = tematicaID;
    
    IF (SELECT COUNT(*) FROM salidas WHERE idtematica=tematicaID AND estado=TRUE)> 1 THEN
		UPDATE salidas
        SET salidas.estado=FALSE
        WHERE salidas.idtematica = tematicaID AND
			  salidas.id <> salidaID;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_TEMATICA_REVERSION` (IN `reversionID` INT, IN `tematicaID` INT, IN `cantidad_reversion` DECIMAL(18,2))  BEGIN
	UPDATE tematicas
    SET saldo_actual = saldo_actual + cantidad_reversion
    WHERE tematicas.id = tematicaID;
    
    UPDATE reversiones
    SET estado = false
    where reversiones.idtematica = tematicaID AND reversiones.id<>reversionID;
END$$

DELIMITER ;

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

--
-- Volcado de datos para la tabla `correlativos`
--

INSERT INTO `correlativos` (`id`, `cite`, `valor`, `gestion`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'ABC/CITE/NRO/', 6, 2018, 'CORRELATIVO PARA ENTREGAR LAS TEMATICAS A NIVEL NACIONAL', 1, '2018-06-24 04:00:00', '2018-06-24 04:00:00');

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
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `userid_registra` int(10) UNSIGNED NOT NULL,
  `userid_actualiza` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id`, `cantidad_nueva`, `cantidad_actual`, `cantidad_total`, `idtematica`, `estado`, `observaciones`, `userid_registra`, `userid_actualiza`, `created_at`, `updated_at`) VALUES
(2, '7.00', '61.00', '68.00', 1, 0, NULL, 1, 1, '2018-06-24 14:55:29', '2018-06-24 14:55:29'),
(4, '6.00', '68.00', '74.00', 1, 0, NULL, 1, 1, '2018-06-24 15:35:29', '2018-06-24 15:35:29'),
(5, '10.00', '74.00', '84.00', 1, 0, NULL, 1, 1, '2018-06-24 15:42:12', '2018-06-24 15:42:12'),
(6, '11.00', '84.00', '95.00', 1, 0, NULL, 1, 1, '2018-06-24 15:43:27', '2018-06-24 15:43:27'),
(7, '6.00', '95.00', '101.00', 1, 1, NULL, 1, 1, '2018-06-24 15:43:54', '2018-06-24 15:43:54');

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
(22, '2018_06_20_002442_create_ingreso_table', 6),
(23, '2018_06_20_003332_create_salida_table', 6),
(24, '2018_07_02_143939_create_reversiones_table', 7);

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

--
-- Volcado de datos para la tabla `regionales`
--

INSERT INTO `regionales` (`id`, `regional`, `estado`, `idunidad`, `created_at`, `updated_at`) VALUES
(1, 'REGIONAL SANTA CRUZ', 1, 1, '2018-06-24 04:00:00', '2018-06-24 04:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reversiones`
--

CREATE TABLE `reversiones` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha_reversion` date NOT NULL,
  `cite_manual` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idtematica` int(10) UNSIGNED NOT NULL,
  `cantidad_actual` decimal(18,2) NOT NULL,
  `cantidad_reversion` decimal(18,2) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `userid_registra` int(10) UNSIGNED NOT NULL,
  `userid_actualiza` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reversiones`
--

INSERT INTO `reversiones` (`id`, `fecha_reversion`, `cite_manual`, `idtematica`, `cantidad_actual`, `cantidad_reversion`, `total`, `estado`, `observaciones`, `userid_registra`, `userid_actualiza`, `created_at`, `updated_at`) VALUES
(1, '2018-07-03', 'MI CITE MANUAL 2', 1, '71.00', '5.00', '76.00', 0, NULL, 1, 1, '2018-07-03 04:51:52', '2018-07-03 04:51:52'),
(2, '2018-07-03', 'MI CITE MANUAL 3', 1, '76.00', '8.00', '84.00', 0, 'MI CITE MANUAL 3 MI CITE MANUAL 3MI CITE MANUAL 3', 1, 1, '2018-07-03 05:03:35', '2018-07-03 05:03:35'),
(3, '2018-07-03', 'MI CITE MANUAL 4', 1, '84.00', '9.00', '93.00', 1, 'MANUAL 4 MANUAL 4', 1, 1, '2018-07-03 05:11:16', '2018-07-03 05:11:16');

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
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `userid_registra` int(10) UNSIGNED NOT NULL,
  `userid_actualiza` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`id`, `fecha_salida`, `cite_manual`, `idunidad`, `idregional`, `idtematica`, `cantidad_actual`, `cantidad_salida`, `costo`, `total`, `correlativo`, `estado`, `observaciones`, `userid_registra`, `userid_actualiza`, `created_at`, `updated_at`) VALUES
(1, '2018-06-25', 'MI CITE MANUAL', 1, 1, 1, '101.00', '5.00', '2.00', '10.00', 'ABC/CITE/NRO/000003/2018', 0, NULL, 1, 1, '2018-06-24 23:45:14', '2018-06-24 23:45:14'),
(2, '2018-06-26', 'MI CITE MANUAL 2', 1, 1, 1, '96.00', '8.00', '3.00', '24.00', 'ABC/CITE/NRO/000003/2018', 0, NULL, 1, 1, '2018-06-24 23:58:09', '2018-06-24 23:58:09'),
(3, '2018-06-26', 'MI CITE MANUAL 3', 1, 1, 1, '88.00', '12.00', '4.00', '48.00', 'ABC/CITE/NRO/000004/2018', 0, NULL, 1, 1, '2018-06-25 00:10:33', '2018-06-25 00:10:33'),
(4, '2018-06-27', 'MI CITE MANUAL 4', 1, 1, 1, '76.00', '5.00', '3.00', '15.00', 'ABC/CITE/NRO/000005/2018', 1, NULL, 1, 1, '2018-06-25 00:13:33', '2018-06-25 00:13:33');

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

--
-- Volcado de datos para la tabla `tematicas`
--

INSERT INTO `tematicas` (`id`, `tematica`, `saldo_inicial`, `saldo_actual`, `costo`, `userid_registra`, `userid_actualiza`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'PAJARITOS', '20.00', '93.00', '2.00', 1, 1, 1, '2018-06-22 04:00:00', '2018-06-22 04:00:00');

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

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id`, `unidad`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'DIRECCION GENERAL EJECUTIVA', 1, '2018-06-21 04:00:00', '2018-06-21 04:00:00');

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
(1, '0', 'Administrador', 'Correos', 'Correos', 'Masculino', 'infocorreos@gmail.com', 'admin.correos', 'ADMINISTRADOR', '$2y$10$D2ZwWpwlzA8Ahr/XLoFU2O0MePQQ/QRY9Ks5dFar0863OxKlSHADW', 1, NULL, 'yv2DmneDze3wg49kHAQU1dvukgiteDrQM3xo5CA9v10JjfKotKItxqeNjulM', '2017-11-27 15:53:28', '2018-06-14 15:54:20', 'SOLTERO', 'PERMANENTE', '0', 'Administrador', 'DIRECCION', 'LEGAL'),
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
-- Indices de la tabla `reversiones`
--
ALTER TABLE `reversiones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reversiones_idtematica_foreign` (`idtematica`),
  ADD KEY `reversiones_userid_registra_foreign` (`userid_registra`),
  ADD KEY `reversiones_userid_actualiza_foreign` (`userid_actualiza`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `regionales`
--
ALTER TABLE `regionales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reversiones`
--
ALTER TABLE `reversiones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tematicas`
--
ALTER TABLE `tematicas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Filtros para la tabla `reversiones`
--
ALTER TABLE `reversiones`
  ADD CONSTRAINT `reversiones_idtematica_foreign` FOREIGN KEY (`idtematica`) REFERENCES `tematicas` (`id`),
  ADD CONSTRAINT `reversiones_userid_actualiza_foreign` FOREIGN KEY (`userid_actualiza`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reversiones_userid_registra_foreign` FOREIGN KEY (`userid_registra`) REFERENCES `users` (`id`);

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
