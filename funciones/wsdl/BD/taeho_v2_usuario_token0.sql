-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: taeho_v2
-- ------------------------------------------------------
-- Server version	8.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `usuario_token`
--

DROP TABLE IF EXISTS `usuario_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_token` (
  `idusuaio_token` int NOT NULL AUTO_INCREMENT,
  `loginUsuario` varchar(45) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `sede` int DEFAULT NULL,
  PRIMARY KEY (`idusuaio_token`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_token`
--

LOCK TABLES `usuario_token` WRITE;
/*!40000 ALTER TABLE `usuario_token` DISABLE KEYS */;
INSERT INTO `usuario_token` VALUES (87,'jsantana','25cc5c260e5779bf4884d35d6d02ae94','1','2024-05-13 22:29:00',1),(88,'jsantana','6900b34be0ee69825c1e7f4ed35ad1e1','1','2024-05-14 16:58:00',1),(89,'jsantana','d073c87820061b14499c9fe0475ef0d1','1','2024-05-14 21:20:00',1),(90,'jsantana','9849a5d316e462f7d375afa2d5fccb94','1','2024-05-15 17:02:00',1),(91,'jsantana','0d78a53107a53f53e2d93a3348df6006','1','2024-05-15 17:52:00',1),(92,'jsantana','aeac02454281be566aa36c908b1d9af6','1','2024-05-15 19:09:00',1);
/*!40000 ALTER TABLE `usuario_token` ENABLE KEYS */;
UNLOCK TABLES;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  