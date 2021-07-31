

CREATE DATABASE IF NOT EXISTS test;

USE test;

# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 8.0.20)
# Database: test
# Generation Time: 2021-07-31 22:40:43 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table usuario
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(100) DEFAULT NULL,
  `token` varchar(300) DEFAULT NULL,
  `fecha_ultima_modificacion_contrasena` datetime DEFAULT NULL,
  `fecha_ultimo_acceso` datetime DEFAULT NULL,
  `active` int DEFAULT NULL,
  `deleted` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modify_by` int DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;

INSERT INTO `usuario` (`id`, `nombre_completo`, `correo`, `contrasena`, `token`, `fecha_ultima_modificacion_contrasena`, `fecha_ultimo_acceso`, `active`, `deleted`, `created_by`, `created_date`, `modify_by`, `modify_date`)
VALUES
	(1,'Alfonso Juarez','admin@gmail.com','c4ca4238a0b923820dcc509a6f75849b','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJmZWNoYSI6IjIwMjEtMDctMzEgMjI6MzU6MzIifQ.0pXHmBn_xMgndYEyX3STHH2RFbNOO0kUByZvUFMJhic',NULL,NULL,1,0,NULL,NULL,1,'2021-07-31 17:35:32'),
	(2,'Alfonos','admin@gmail.com2','c4ca4238a0b923820dcc509a6f75849b',NULL,NULL,NULL,1,0,0,'2021-07-31 17:31:30',NULL,NULL),
	(3,'Alfonos','admin3@gmail.com2','c4ca4238a0b923820dcc509a6f75849b',NULL,NULL,NULL,1,0,0,'2021-07-31 17:32:05',NULL,NULL),
	(4,'Alfonos','admin4@gmail.com2','c4ca4238a0b923820dcc509a6f75849b',NULL,NULL,NULL,1,0,0,'2021-07-31 17:32:28',NULL,NULL),
	(5,'Alfonos','admin5@gmail.com2','c4ca4238a0b923820dcc509a6f75849b',NULL,NULL,NULL,1,0,0,'2021-07-31 17:32:53',NULL,NULL),
	(6,'Alfonos','admin6@gmail.com2','c4ca4238a0b923820dcc509a6f75849b',NULL,NULL,NULL,1,0,0,'2021-07-31 17:33:03',NULL,NULL),
	(7,'Alfonos','admin7@gmail.com2','c4ca4238a0b923820dcc509a6f75849b','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6NywiZmVjaGEiOiIyMDIxLTA3LTMxIDIyOjMzOjI2In0.BUG4ltWzzzzTDpR_rL8rNk9KLalFCZGtBKV4ctecuXM',NULL,NULL,1,0,0,'2021-07-31 17:33:26',7,'2021-07-31 17:33:26'),
	(8,'Alfonos','admin8@gmail.com2','c4ca4238a0b923820dcc509a6f75849b','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6OCwiZmVjaGEiOiIyMDIxLTA3LTMxIDIyOjMzOjM5In0.F4D7MiQ1w8QBPRy_cxOtgMyhbwPemeuATfXD4VOztd0',NULL,NULL,1,0,0,'2021-07-31 17:33:39',8,'2021-07-31 17:33:39'),
	(9,'Jose Alfonso Guerrero Juarez','adm10in@gmail.com','c4ca4238a0b923820dcc509a6f75849b','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6OSwiZmVjaGEiOiIyMDIxLTA3LTMxIDIyOjMzOjU3In0.BkRKyoCV5A794GUrJ62P1xTsBAIbo8yJmJVrErfdYzU',NULL,NULL,1,0,0,'2021-07-31 17:33:57',9,'2021-07-31 17:35:10');

/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
