-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: dbestampitas
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.30-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `correlativos`
--

DROP TABLE IF EXISTS `correlativos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `correlativos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cite` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` int(11) NOT NULL,
  `gestion` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `correlativos`
--

LOCK TABLES `correlativos` WRITE;
/*!40000 ALTER TABLE `correlativos` DISABLE KEYS */;
INSERT INTO `correlativos` VALUES (1,'ABC/CITE/NRO/',6,2018,'CORRELATIVO PARA ENTREGAR LAS TEMATICAS A NIVEL NACIONAL',1,'2018-06-24 04:00:00','2018-06-24 04:00:00'),(2,'ABC/INGRESO/CITE/NRO/',3,2018,'CORRELATIVO PARA ENTREGAR LAS TEMATICAS A NIVEL NACIONAL INGRESO',1,'2018-06-24 04:00:00','2018-07-09 07:57:54');
/*!40000 ALTER TABLE `correlativos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingresos`
--

DROP TABLE IF EXISTS `ingresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingresos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cite_ingreso` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'cite de ingreso de tematicas tomadas de la tabla correlativos con el id 2',
  `cantidad_nueva` decimal(18,2) NOT NULL,
  `cantidad_actual` decimal(18,2) NOT NULL,
  `cantidad_total` decimal(18,2) NOT NULL,
  `idtematica` int(10) unsigned NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `userid_registra` int(10) unsigned NOT NULL,
  `userid_actualiza` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ingresos_idtematica_foreign` (`idtematica`),
  KEY `ingresos_userid_registra_foreign` (`userid_registra`),
  KEY `ingresos_userid_actualiza_foreign` (`userid_actualiza`),
  CONSTRAINT `ingresos_idtematica_foreign` FOREIGN KEY (`idtematica`) REFERENCES `tematicas` (`id`),
  CONSTRAINT `ingresos_userid_actualiza_foreign` FOREIGN KEY (`userid_actualiza`) REFERENCES `users` (`id`),
  CONSTRAINT `ingresos_userid_registra_foreign` FOREIGN KEY (`userid_registra`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingresos`
--

LOCK TABLES `ingresos` WRITE;
/*!40000 ALTER TABLE `ingresos` DISABLE KEYS */;
INSERT INTO `ingresos` VALUES (2,'',7.00,61.00,68.00,1,0,NULL,1,1,'2018-06-24 14:55:29','2018-06-24 14:55:29'),(4,'',6.00,68.00,74.00,1,0,NULL,1,1,'2018-06-24 15:35:29','2018-06-24 15:35:29'),(5,'',10.00,74.00,84.00,1,0,NULL,1,1,'2018-06-24 15:42:12','2018-06-24 15:42:12'),(6,'',11.00,84.00,95.00,1,0,NULL,1,1,'2018-06-24 15:43:27','2018-06-24 15:43:27'),(7,'',6.00,95.00,101.00,1,0,NULL,1,1,'2018-06-24 15:43:54','2018-06-24 15:43:54'),(8,'ABC/INGRESO/CITE/NRO/ 000001/2018',66.00,93.00,159.00,1,0,NULL,1,1,'2018-07-09 07:55:01','2018-07-09 07:55:01'),(9,'ABC/INGRESO/CITE/NRO/ 000001/2018',88.00,22.00,110.00,3,0,NULL,1,1,'2018-07-09 07:55:01','2018-07-09 07:55:01'),(10,'ABC/INGRESO/CITE/NRO/ 000002/2018',77.00,110.00,187.00,3,1,NULL,1,1,'2018-07-09 07:57:54','2018-07-09 07:57:54'),(11,'ABC/INGRESO/CITE/NRO/ 000002/2018',99.00,100.00,199.00,2,1,NULL,1,1,'2018-07-09 07:57:54','2018-07-09 07:57:54'),(12,'ABC/INGRESO/CITE/NRO/ 000002/2018',45.00,159.00,204.00,1,1,NULL,1,1,'2018-07-09 07:57:54','2018-07-09 07:57:54');
/*!40000 ALTER TABLE `ingresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(15,'2018_06_19_234841_create_tematica_table',2),(16,'2018_06_20_001011_create_correlativo_table',3),(17,'2018_06_20_001654_create_unidad_table',4),(18,'2018_06_20_001825_create_regional_table',5),(22,'2018_06_20_002442_create_ingreso_table',6),(23,'2018_06_20_003332_create_salida_table',6),(24,'2018_07_02_143939_create_reversiones_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('edwincon85@hotmail.com','$2y$10$oi7dON/9aWYtygr5EVpm2uGuXjGDMXu/5Y0tteVMKMTBZ/NtzNJee','2017-11-01 21:03:38'),('sistemas@zaire.com.bo','$2y$10$wM6g.FXZAz3Pn33Xy265Ae05IEMfEBpSdyrC3Q/t3PdpC/395LgzK','2017-11-01 21:24:40');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regionales`
--

DROP TABLE IF EXISTS `regionales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regionales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `regional` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `idunidad` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regionales_regional_unique` (`regional`),
  KEY `regionales_idunidad_foreign` (`idunidad`),
  CONSTRAINT `regionales_idunidad_foreign` FOREIGN KEY (`idunidad`) REFERENCES `unidades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regionales`
--

LOCK TABLES `regionales` WRITE;
/*!40000 ALTER TABLE `regionales` DISABLE KEYS */;
INSERT INTO `regionales` VALUES (1,'REGIONAL SANTA CRUZ',1,1,'2018-06-24 04:00:00','2018-06-24 04:00:00');
/*!40000 ALTER TABLE `regionales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reversiones`
--

DROP TABLE IF EXISTS `reversiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reversiones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_reversion` date NOT NULL,
  `cite_manual` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idtematica` int(10) unsigned NOT NULL,
  `cantidad_actual` decimal(18,2) NOT NULL,
  `cantidad_reversion` decimal(18,2) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `userid_registra` int(10) unsigned NOT NULL,
  `userid_actualiza` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reversiones_idtematica_foreign` (`idtematica`),
  KEY `reversiones_userid_registra_foreign` (`userid_registra`),
  KEY `reversiones_userid_actualiza_foreign` (`userid_actualiza`),
  CONSTRAINT `reversiones_idtematica_foreign` FOREIGN KEY (`idtematica`) REFERENCES `tematicas` (`id`),
  CONSTRAINT `reversiones_userid_actualiza_foreign` FOREIGN KEY (`userid_actualiza`) REFERENCES `users` (`id`),
  CONSTRAINT `reversiones_userid_registra_foreign` FOREIGN KEY (`userid_registra`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reversiones`
--

LOCK TABLES `reversiones` WRITE;
/*!40000 ALTER TABLE `reversiones` DISABLE KEYS */;
INSERT INTO `reversiones` VALUES (1,'2018-07-03','MI CITE MANUAL 2',1,71.00,5.00,76.00,0,NULL,1,1,'2018-07-03 04:51:52','2018-07-03 04:51:52'),(2,'2018-07-03','MI CITE MANUAL 3',1,76.00,8.00,84.00,0,'MI CITE MANUAL 3 MI CITE MANUAL 3MI CITE MANUAL 3',1,1,'2018-07-03 05:03:35','2018-07-03 05:03:35'),(3,'2018-07-03','MI CITE MANUAL 4',1,84.00,9.00,93.00,1,'MANUAL 4 MANUAL 4',1,1,'2018-07-03 05:11:16','2018-07-03 05:11:16');
/*!40000 ALTER TABLE `reversiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salidas`
--

DROP TABLE IF EXISTS `salidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salidas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha_salida` date NOT NULL,
  `cite_manual` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idunidad` int(10) unsigned NOT NULL,
  `idregional` int(10) unsigned NOT NULL,
  `idtematica` int(10) unsigned NOT NULL,
  `cantidad_actual` decimal(18,2) NOT NULL,
  `cantidad_salida` decimal(18,2) NOT NULL,
  `costo` decimal(18,2) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `correlativo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `userid_registra` int(10) unsigned NOT NULL,
  `userid_actualiza` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salidas_idunidad_foreign` (`idunidad`),
  KEY `salidas_idregional_foreign` (`idregional`),
  KEY `salidas_idtematica_foreign` (`idtematica`),
  KEY `salidas_userid_registra_foreign` (`userid_registra`),
  KEY `salidas_userid_actualiza_foreign` (`userid_actualiza`),
  CONSTRAINT `salidas_idregional_foreign` FOREIGN KEY (`idregional`) REFERENCES `regionales` (`id`),
  CONSTRAINT `salidas_idtematica_foreign` FOREIGN KEY (`idtematica`) REFERENCES `tematicas` (`id`),
  CONSTRAINT `salidas_idunidad_foreign` FOREIGN KEY (`idunidad`) REFERENCES `unidades` (`id`),
  CONSTRAINT `salidas_userid_actualiza_foreign` FOREIGN KEY (`userid_actualiza`) REFERENCES `users` (`id`),
  CONSTRAINT `salidas_userid_registra_foreign` FOREIGN KEY (`userid_registra`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salidas`
--

LOCK TABLES `salidas` WRITE;
/*!40000 ALTER TABLE `salidas` DISABLE KEYS */;
INSERT INTO `salidas` VALUES (1,'2018-06-25','MI CITE MANUAL',1,1,1,101.00,5.00,2.00,10.00,'ABC/CITE/NRO/000003/2018',0,NULL,1,1,'2018-06-24 23:45:14','2018-06-24 23:45:14'),(2,'2018-06-26','MI CITE MANUAL 2',1,1,1,96.00,8.00,3.00,24.00,'ABC/CITE/NRO/000003/2018',0,NULL,1,1,'2018-06-24 23:58:09','2018-06-24 23:58:09'),(3,'2018-06-26','MI CITE MANUAL 3',1,1,1,88.00,12.00,4.00,48.00,'ABC/CITE/NRO/000004/2018',0,NULL,1,1,'2018-06-25 00:10:33','2018-06-25 00:10:33'),(4,'2018-06-27','MI CITE MANUAL 4',1,1,1,76.00,5.00,3.00,15.00,'ABC/CITE/NRO/000005/2018',1,NULL,1,1,'2018-06-25 00:13:33','2018-06-25 00:13:33');
/*!40000 ALTER TABLE `salidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tematicas`
--

DROP TABLE IF EXISTS `tematicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tematicas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tematica` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo_inicial` decimal(18,2) NOT NULL,
  `saldo_actual` decimal(18,2) NOT NULL,
  `costo` decimal(18,2) NOT NULL,
  `userid_registra` int(10) unsigned NOT NULL,
  `userid_actualiza` int(10) unsigned NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tematicas_tematica_unique` (`tematica`),
  KEY `tematicas_userid_registra_foreign` (`userid_registra`),
  KEY `tematicas_userid_actualiza_foreign` (`userid_actualiza`),
  CONSTRAINT `tematicas_userid_actualiza_foreign` FOREIGN KEY (`userid_actualiza`) REFERENCES `users` (`id`),
  CONSTRAINT `tematicas_userid_registra_foreign` FOREIGN KEY (`userid_registra`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tematicas`
--

LOCK TABLES `tematicas` WRITE;
/*!40000 ALTER TABLE `tematicas` DISABLE KEYS */;
INSERT INTO `tematicas` VALUES (1,'PAJARITOS',20.00,204.00,2.00,1,1,1,'2018-06-22 04:00:00','2018-06-22 04:00:00'),(2,'SELLOS 2',20.00,199.00,2.00,1,1,1,'2018-06-22 04:00:00','2018-06-22 04:00:00'),(3,'SELLOS 3',22.00,187.00,2.00,1,1,1,'2018-06-22 04:00:00','2018-06-22 04:00:00');
/*!40000 ALTER TABLE `tematicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidades`
--

DROP TABLE IF EXISTS `unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unidad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unidades_unidad_unique` (`unidad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidades`
--

LOCK TABLES `unidades` WRITE;
/*!40000 ALTER TABLE `unidades` DISABLE KEYS */;
INSERT INTO `unidades` VALUES (1,'DIRECCION GENERAL EJECUTIVA',1,'2018-06-21 04:00:00','2018-06-21 04:00:00');
/*!40000 ALTER TABLE `unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `us_unidad` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'0','Administrador','Correos','Correos','Masculino','infocorreos@gmail.com','admin.correos','ADMINISTRADOR','$2y$10$D2ZwWpwlzA8Ahr/XLoFU2O0MePQQ/QRY9Ks5dFar0863OxKlSHADW',1,NULL,'yv2DmneDze3wg49kHAQU1dvukgiteDrQM3xo5CA9v10JjfKotKItxqeNjulM','2017-11-27 15:53:28','2018-06-14 15:54:20','SOLTERO','PERMANENTE','0','Administrador','DIRECCION','LEGAL'),(2,'6746059','Juan Carlos','Achoo','Ayala','Masculino','juancarlos.achoayala@gmail.com','juan.achoo','ADMINISTRADOR','$2y$10$1s5YlAdfxhdSNzc/eCTkvO7HQphcL.86Ma.TxcDm7ZsFBkV5MJwAS',1,NULL,'CUbjAYryhHlGwKdQ54yt6FZXuCIZmQHRdHzhXDUV3rwCbvvr7DFUBJoTNvNA','2018-06-14 19:25:57','2018-06-14 19:25:57','SOLTERO','PERMANENTE','8460','redes y sistemas','DIRECCION','LEGAL');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-09  4:02:03
