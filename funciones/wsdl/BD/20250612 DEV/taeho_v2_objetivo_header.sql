-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: taeho_v2
-- ------------------------------------------------------
-- Server version	8.3.0

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
  `nombreObjetivo` varchar(250) DEFAULT NULL,
  `observacionObjetivo` text,
  `fechaCreacion` datetime DEFAULT NULL,
  `creadoPor` varchar(45) DEFAULT NULL,
  `activo` varchar(1) DEFAULT NULL,
  `nivelObjetivo` int DEFAULT NULL,
  `idAreaObjetivo` int DEFAULT NULL,
  PRIMARY KEY (`idObjetivoHeader`),
  KEY `idArea_idx` (`idAreaObjetivo`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objetivo_header`
--

LOCK TABLES `objetivo_header` WRITE;
/*!40000 ALTER TABLE `objetivo_header` DISABLE KEYS */;
INSERT INTO `objetivo_header` VALUES (27,'FUNCIONES EJECUTIVAS  ','<p>Descripcion del objetivo de Area cognitiva (FUNCIONES EJECTUVOAS )</p>','2024-09-12 00:00:00','jsantana','1',2,1),(28,'MATERNAL (Sala Cuna)','<p>Descipcion de programa de Area cognitiva (01 MATERNAL (Sala Cuna))</p>','2024-09-12 00:00:00','jsantana','1',3,1),(29,'NIVEL -  MEDIO MENOR','<p>descripcion del programa de area cognitiva 02 NIVEL -  MEDIO MENOR</p>','2024-09-12 00:00:00','jsantana','1',4,1),(30,'NIVEL -  MEDIO MAYOR','<p>03 NIVEL -  MEDIO MAYOR<br></p>','2024-09-12 00:00:00','jsantana','1',5,1),(31,'NIVEL- KINDER','<p>04 NIVEL- KINDER<br></p>','2024-09-12 00:00:00','jsantana','1',6,1),(32,'01 BASICO (1er grado)','<p>05 01BASICO (1er grado)<br></p>','2024-09-12 00:00:00','jsantana','1',7,1),(33,'02 BASICO (2er grado)','<p>06 02BASICO (2er grado)<br></p>','2024-09-12 00:00:00','jsantana','1',8,1),(34,'03 BASICO (3er grado)','<p>07 03BASICO (3er grado)<br></p>','2024-09-12 00:00:00','jsantana','1',9,1),(35,'04 BASICO (4er grado)','<p>08 04BASICO (4er grado)<br></p>','2024-09-12 00:00:00','jsantana','1',10,1),(36,'05 BASICO (5er grado)','<p>09 05BASICO (5er grado)<br></p>','2024-09-12 00:00:00','jsantana','1',11,1),(37,'06 BASICO (6er grado)','<p>10 06BASICO (6er grado)<br></p>','2024-09-12 00:00:00','jsantana','1',12,1),(38,'07 BASICO (7mo grado)','<p>11 07BASICO (7mo grado)<br></p>','2024-09-12 00:00:00','jsantana','1',13,1),(39,'08 BASICO (8vo grado)','<p>12 08BASICO (8vo grado)<br></p>','2024-09-12 00:00:00','jsantana','1',14,1),(40,'','','2024-11-01 00:00:00','jsantana','1',0,0);
/*!40000 ALTER TABLE `objetivo_header` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-12  8:50:55
