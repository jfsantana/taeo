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
-- Table structure for table `evaluacion_detalle`
--

DROP TABLE IF EXISTS `evaluacion_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evaluacion_detalle` (
  `idDetalleEvaluacion` int NOT NULL AUTO_INCREMENT,
  `idItemEvaluacion` int DEFAULT NULL,
  `detalleEvalaacion` varchar(255) DEFAULT NULL,
  `evaluacion_detalle` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDetalleEvaluacion`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluacion_detalle`
--

LOCK TABLES `evaluacion_detalle` WRITE;
/*!40000 ALTER TABLE `evaluacion_detalle` DISABLE KEYS */;
INSERT INTO `evaluacion_detalle` VALUES (1,1,'Expresa con gestos cuando no quiere mas','SA'),(2,1,'Atiende al oír su nombre ','SA'),(32,11,'demo de creacion de evaluacion','AP'),(25,15,'pro','SA'),(24,14,'prueba de otro nivel;','AP'),(23,13,'se evaluo tal cosa','AT'),(22,13,'demo servici','AT'),(21,13,'insert serv','AT'),(20,13,'fino','AT'),(19,12,'AREA 6','AP'),(16,9,'AREA3','AP'),(15,8,'prueba area 2','AP'),(26,16,'vamos a lograr','AP'),(27,17,'acritud hioo','SA'),(28,18,'le gustan las morenas','SA'),(29,19,'awdaasd','AT'),(30,20,'corbnitivo 1','AT'),(31,10,'ejemp[lo de llevado de cuadro','AP');
/*!40000 ALTER TABLE `evaluacion_detalle` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-12  8:50:57
