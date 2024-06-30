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
-- Table structure for table `representantes`
--

DROP TABLE IF EXISTS `representantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `representantes` (
  `idRepresentante` int NOT NULL AUTO_INCREMENT,
  `nombreRepresentante` varchar(45) DEFAULT NULL,
  `apellidoRepresentante` varchar(45) DEFAULT NULL,
  `cedulaRepresentante` varchar(45) DEFAULT NULL,
  `profesionRepresentante` varchar(45) DEFAULT NULL,
  `lugarTrabajoRepresentante` varchar(45) DEFAULT NULL,
  `correoRepresentante` varchar(45) DEFAULT NULL,
  `telefonoRepresentante` varchar(45) DEFAULT NULL,
  `parentescoRepresentante` varchar(45) DEFAULT NULL,
  `retirarAprendiz` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `razonSocialRepresentante` varchar(45) DEFAULT NULL,
  `rifRepresentante` varchar(45) DEFAULT NULL,
  `direccionFiscalRepresentante` varchar(45) DEFAULT NULL,
  `activoRepresentante` varchar(45) DEFAULT NULL,
  `creadoPor` varchar(45) DEFAULT NULL,
  `fechaCreacion` datetime DEFAULT NULL,
  PRIMARY KEY (`idRepresentante`),
  UNIQUE KEY `cedulaRepresentante_UNIQUE` (`cedulaRepresentante`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `representantes`
--

LOCK TABLES `representantes` WRITE;
/*!40000 ALTER TABLE `representantes` DISABLE KEYS */;
INSERT INTO `representantes` VALUES (1,'Leidert Y.','Parra','16965218','Lic','Pequiven','leidertparra@gmail.com','04122852922','Madre','1',NULL,'','','1','','2024-05-11 00:00:00'),(2,'Jesus F','Santana','13336768','Ing','Particular','jfsantana77@gmail.com','04244380137','Padre','1',NULL,'','','1','','2024-05-15 00:00:00'),(3,'Dessy',NULL,'14125465',NULL,'Cuidadora',NULL,'04242424244','Cuidador(a)','0',NULL,NULL,NULL,'1','admin','2024-05-06 00:00:00');
/*!40000 ALTER TABLE `representantes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-30 13:40:14
