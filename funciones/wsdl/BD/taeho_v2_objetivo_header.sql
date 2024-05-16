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
-- Table structure for table `objetivo_header`
--

DROP TABLE IF EXISTS `objetivo_header`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `objetivo_header` (
  `idObjetivoHeader` int NOT NULL AUTO_INCREMENT,
  `nombreObjetivo` varchar(45) DEFAULT NULL,
  `versionObjetivo` varchar(45) DEFAULT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  `creadoPor` varchar(45) DEFAULT NULL,
  `activo` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`idObjetivoHeader`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objetivo_header`
--

LOCK TABLES `objetivo_header` WRITE;
/*!40000 ALTER TABLE `objetivo_header` DISABLE KEYS */;
INSERT INTO `objetivo_header` VALUES (1,'PROGRAMA DE MOTRICIDAD FINA INICIAL','1','2024-05-13 00:00:00','admin','1');
/*!40000 ALTER TABLE `objetivo_header` ENABLE KEYS */;
UNLOCK TABLES;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  